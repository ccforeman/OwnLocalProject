# OwnLocalProject
This project is a REST API that serves business data as JSON to requesting clients.

# Endpoints

## GET /businesses
Returns a list of businesses with the pagination data included in the JSON object.

##### Parameters for Pagination

    page_start

Optional.
The starting record of the list of business you fetch.
Default = 0.

    amount

Optional.
The amount of businesses that will be retrieved.
Default = 50.
Max = 1000.

###### Example
    GET http://example.com/businesses?page_start=100&amount=500

## GET /business/{id}
Returns the business specified by {id}.

    {id}

Numerical value that represents the id of the desired business

###### Example

    GET http://example.com/business/17
