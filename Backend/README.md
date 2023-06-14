# grok Backend Api

## Available Api Resources

### POST /auth

This resource authenticates an email, password against NOAA's ldap authentication.  

All responses include 'error' and 'authenticated' attributes.  
A successful response will also include 'token' attribute, which is stored server-side in the session cookie.

Example request:
POST https://nefsctest.nmfs.local/grok/html/Backend/public/index.php/api/auth?email=first.lastname@noaa.gov&password=1W2q4R9V8  

Example response (fail):
{
    "error": true,
    "authenticated": false
}

Example response (success):
{
  "error": false,
  "authenticated": true,
  "username": "thomas.liebert",
  "token": "G8tmytdgOf02775TZtTwwRiaMDNLMxnz6iwandGa"
}


### GET /select_aptions/{fieldname}  

This resource returns valid values for common fields/ database columns. Available fieldnames include:  
  - disposition_code
  - dnum
  - grade_code
  - obsid
  - port  
  - species_itis  
  - vessel_permit_num  
  - weight_uom  

This resource REQUIRES a valid X-API-TOKEN header value to be set when submitting (obtained when authenticating via GET /auth resource).

Example request:
GET https://nefsctest.nmfs.local/grok/html/Backend/public/index.php/api/select_options/dnum  

Example response (fail):
{
  "error": true,
  "message": "not authorized"
}  

Example response (success):
[
    {
        "column_name": "DNUM",
        "name": "UNKNOWN",
        "value": 0,
        "descr": "UNKNOWN"
    },
    {
        "column_name": "DNUM",
        "name": "DAVE HANDRIGAN SEAFOODS INC",
        "value": 913,
        "descr": "DAVE HANDRIGAN SEAFOODS INC"
    },
    {
        "column_name": "DNUM",
        "name": "OCEAN CREST SEAFOODS INC",
        "value": 998,
        "descr": "OCEAN CREST SEAFOODS INC"
    }
]

## Change log  

[2023-06-14]
  - Initial deployement: POST /auth and GET /select_options
