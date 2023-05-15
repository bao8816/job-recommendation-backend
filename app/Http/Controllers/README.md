# Returned data

### Paginated data
<pre>
{
"error": false,
"message": "Successfully retrieved employer accounts",
"data": {
    "employerAccounts": {
        "current_page": 1,
        "data": [
            {
            "id": 1,
            "username": "emp1",
            "is_banned": 0,
            "locked_until": null
            },
            {
            "id": 2,
            "username": "emp2",
            "is_banned": 0,
            "locked_until": null
            }
        ],
        "first_page_url": "http://127.0.0.1:8001/api/companies/employers?page=1",
        "from": 1,
        "last_page": 3,
        "last_page_url": "http://127.0.0.1:8001/api/companies/employers?page=3",
        "links": [
            {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
            },
            {
            "url": "http://127.0.0.1:8001/api/companies/employers?page=1",
            "label": "1",
            "active": true
            },
            {
            "url": "http://127.0.0.1:8001/api/companies/employers?page=2",
            "label": "2",
            "active": false
            },
            {
            "url": "http://127.0.0.1:8001/api/companies/employers?page=3",
            "label": "3",
            "active": false
            },
            {
            "url": "http://127.0.0.1:8001/api/companies/employers?page=2",
            "label": "Next &raquo;",
            "active": false
            }
        ],
        "next_page_url": "http://127.0.0.1:8001/api/companies/employers?page=2",
        "path": "http://127.0.0.1:8001/api/companies/employers",
        "per_page": 2,
        "prev_page_url": null,
        "to": 2,
        "total": 6
        }
    },
    "status_code": 200
}
</pre>
