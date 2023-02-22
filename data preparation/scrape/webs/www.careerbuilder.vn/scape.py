import requests
import time
from bs4 import BeautifulSoup
import json

def scrape_jobs(url):
	#print(url)
	# Make a request to the website
	response = requests.get(url)
	# Check if the request was successful
	if response.status_code == 200:
    	# Parse the HTML content of the page
	    soup = BeautifulSoup(response.text, "html.parser")
	    print(soup)
	    # Store data for saving in json file
	    job_json = []
	    company_json = []
	    lists = soup.find("div", {"class": "jobs-side-list"})
	    jobs = lists.find_all("div", {"class": "job-item"})
	    for job in jobs:
	    	job_link_soup = job.find("a", {"class": "job_link"})
	    	job_link = job_link_soup.get("href")
	    	print(job)
	    	if job_link.startswith("https://careerbuilder.vn/vi/tim-viec-lam/"):
	    		# Make a request to the job link
	            job_response = requests.get(job_link)
	            # Check if the request was successful
	            print('a')
	            if job_response.status_code == 200:
	            	# Parse the HTML content of the job page
	                job_soup = BeautifulSoup(job_response.text, "html.parser")
	                # Find the <h1> tag with class "title"
	                job_title = job_soup.find("h1", {"class": "title"}).text.strip()
	                company_title = job_soup.find("a", {"class": "employer job-company-name"}).text.strip()
	                print(job_title, company_title)


url = 'https://careerbuilder.vn/viec-lam/cntt-phan-mem-c1-trang'
page = 1
while True:
	scrape_jobs(url + f'-{page}-vi.html')
	print(page)
	page += 1
	time.sleep(3)