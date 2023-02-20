import requests
import time
from bs4 import BeautifulSoup
import json
def scrape_jobs(url):
	# Make a request to the website
	response = requests.get(url)

	# Check if the request was successful
	if response.status_code == 200:
	    # Parse the HTML content of the page
	    soup = BeautifulSoup(response.text, "html.parser")
	    # Store data for saving in json file
	    job_json = []
	    company_json = []
	    # Find the <div> tag with class "job-list-2"
	    # This class can be changed from the website to prevent scraping		
	    lists = soup.find("div", {"class": "job-list-2"})

	    # Find all the <div> tags with class "job-item-2"
	    # This class can be changed from the website to prevent scraping
	    jobs = lists.find_all("div", {"class": "job-item-2"})

	    # Loop through each job
	    for job in jobs:
	        # Find the <h3> tag within the job
	        h3 = job.find("h3")

	        # Extract the job link
	        job_link = h3.find("a").get("href")

	        # Check if the link starts with "https://www.topcv.vn/viec-lam/"
	        # And avoid the job link is broken
	        if job_link.startswith("https://www.topcv.vn/viec-lam/") and job_link != "https://www.topcv.vn/viec-lam/":
	            # Make a request to the job link
	            job_response = requests.get(job_link)

	            # Check if the request was successful
	            if job_response.status_code == 200:
	                # Parse the HTML content of the job page
	                job_soup = BeautifulSoup(job_response.text, "html.parser")
	                # # Simulate a click on the close button to ignore the pop-up
	                # if soup.find('button', {'class': 'btn btn-close'}):
	                # 	close_button = soup.find('button', {'class': 'btn btn-close'})
	                # 	print(close_button)
	                # 	if close_button is not None:
	                # 		close_button.click()
	                
	                # Find the <h1> tag with class "job-title"
	                job_title = job_soup.find("h1", {"class": "job-title"})

	                # Check if the job title was found
	                if job_title:
	                    # Extract the text from the <h1> tag and remove any whitespace characters
	                    job_title_text = job_title.text.strip().split("\n")[0]
	                else:
	                    # Set the job title text to an empty string if it was not found
	                    job_title_text = ""

	                # Find the <a> tag with class "company-title"
	                #company_title = job_soup.find("a", {"class": "company-title"})
	                company_title = job_soup.find("a", {"href": True, "class": "text-dark-blue"})

	                # Check if the company title was found
	                if company_title:
	                    # Extract the text from the <a> tag and remove any whitespace characters
	                    company_title_text = company_title.text.strip().split("\n")[0]
	                else:
	                    # Set the company title text to an empty string if it was not found
	                    company_title_text = ""
	                # Get company logo link
	                company_logo_soup = job_soup.find("div", {"class": "box-company-logo"})
	                company_logo_link = company_logo_soup.find("img")['src']
	                # Get Job Info
	                boxes = job_soup.find("div", {"class": "box-main"})
	                # print(boxes)
	                infos = boxes.find_all("div", {"class": "box-item"})
	                info_data = []
	                for info in infos:
	                	tmp = []
	                	title_info = info.find("strong").text.strip()
	                	detail_info = info.find("span").text.strip()
	                	tmp.append(title_info)
	                	tmp.append(detail_info)
	                	info_data.append(tmp)
	                info_data = {item[0]: item[1] for item in info_data}
	                # Extract the text from the <div> tag class job-deadline
	                deadline = job_soup.find("div", {"class": "job-deadline"}).text.strip()[-10:]
	                list_address = job_soup.find("div", {"class": "box-address"})
	                work_addresses = list_address.find_all("div", {"style": "margin-bottom: 10px"})
	                data_addresses = []
	                for address in work_addresses:
	                	data_addresses.append(address.text.strip()[2:])

	                skills_set = job_soup.find("div", {"class": "skill"})
	                skills_data = []
	                if skills_set is not None:
		                skills = skills_set.find_all("a")
		                for skill in skills:
		                	skills_data.append(skill.text.strip())
	                # job_data = job_soup.find("div", {"class": "job-data"})
	                # Get company details
	                company_details_soup = job_soup.find("div", {"class": "box-info-company box-white"})
	                company_link = company_details_soup.find("a", {"href": True}).get("href")
	                box_info = company_details_soup.find("div", {"class": "box-info"})
	                box_items = box_info.find_all("div", {"class": "box-item"})
	                company_data_titles = []
	                company_data_contents = []
	                company_data = []
	                for item in box_items:
	                	title = item.find("p", {"class": "title"}).text.strip()
	                	content = item.find("span", {"class": "content"}).text.strip()
	                	company_data_titles.append(title)
	                	company_data_contents.append(content)
	                	# print(title, content)
	                	#company_data_contents.append(company_infos.find("span", {"class": "content"}).text.strip())
	                	#print(company_infos.find("p", {"class": "title"}).text.strip())
	                	#print(company_infos.find("span", {"class": "content"}).text.strip())
	                # Combine company data
	                # print(company_data_titles)
	                company_data = dict(zip(company_data_titles, company_data_contents))
	                # Get job details
	                job_data_soup = job_soup.find("div", {"class": "job-data"})
	                job_data_h3_text = []
	                # Extract all h3 in job data and append to a list
	                job_data_h3 = job_data_soup.find_all("h3")
	                for job_data_h3_item in job_data_h3:
	                	job_data_h3_text.append(job_data_h3_item.text.strip())
	                # Remove the last h3 (How to apply)
	                job_data_h3_text = job_data_h3_text[:-1]
	                # Extract all content in job data
	                job_data_content_text = []
	                job_data_contents = job_data_soup.find_all("div", {"class": "content-tab"})
	                for item in job_data_contents:
	                	job_data_content_text.append(item.text.strip())
	                # Combine h3 with relative content for saving
	                job_details = []
	                job_details = dict(zip(job_data_h3_text, job_data_content_text))
	                #Print the job title
	                print(f"{job_title_text}")
	                #Save for json file
	                job_json.append({
	                	'title': job_title_text,
	                	'job_link': job_link,
	                	'company': company_title_text,
	                	'deadline': deadline,
	                	'overview': info_data,
	                	'addresses': data_addresses,
	                	'skills': skills_data,
	                	'job_details': job_details
	                })
	                company_json.append({
	                	'name': company_title_text,
	                	'company_logo_link': company_logo_link,
	                	'company_link': company_link,
	                	'company details': company_data
	                	})
	# Json file saving
	with open('jobs_data.json', 'a', encoding='utf-8') as fj:
	    json.dump(job_json, fj, ensure_ascii=False, indent=4)
	with open('companies_data.json', 'a', encoding='utf-8') as fc:
		json.dump(company_json, fc, ensure_ascii=False, indent=4)

url = 'https://www.topcv.vn/viec-lam-it'
# Set page = 1 if had not crawl before
# there a page number 39 has broken jobs, need to jump over and continue from 40th
page = 40
while True:
	scrape_jobs(url + f'?page={page}')
	print(page)
	page += 1
	time.sleep(3)