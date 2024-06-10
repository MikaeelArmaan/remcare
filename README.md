
----------------------------------------------------------------------------------------------------
##################################################################################
---------------------------------------------------------------------------------------------------------

GET /api/patients

{
    {
        "id": 1,
        "name": "Norval",
        "last_name": "Johns",
        "email": "mcdermott.donald@example.net",
        "dob": "1998-06-09",
        "phone": "1-408-359-3213",
        "group": "A",
        "created_at": "2024-06-10T07:41:49.000000Z",
        "updated_at": "2024-06-10T07:41:49.000000Z"
    },
    {
        "id": 2,
        "name": "Salma",
        "last_name": "Lynch",
        "email": "psenger@example.net",
        "dob": "2015-10-12",
        "phone": "(308) 245-4726",
        "group": "C",
        "created_at": "2024-06-10T07:41:49.000000Z",
        "updated_at": "2024-06-10T07:41:49.000000Z"
    },
}

GET /api/patients/{id}
Authorization 
Response
{
    "id": 2,
    "name": "Salma",
    "last_name": "Lynch",
    "email": "psenger@example.net",
    "dob": "2015-10-12",
    "phone": "(308) 245-4726",
    "group": "C",
    "created_at": "2024-06-10T07:41:49.000000Z",
    "updated_at": "2024-06-10T07:41:49.000000Z"
}

POST /api/patients

Request Body
{
    "name": "Arman",
    "last_name": "khan",
    "email": "armaant@gmail.com",
    "dob": "06/10/2024"
}

Response (Success): HTTP Status Code 201 (Created)
{
    "id": 3,
    "name": "Alice Brown",
    "age": 35,
    "risk_group": "Low Risk"
}

Response (Error): HTTP Status Code 422 (Unprocessable Entity)
json
{
    "message": "The given data was invalid.",
    "errors": {
        "name": ["The name field is required."],
        "age": ["The age field must be a number."],
        "risk_group": ["The risk group field is required."]
    }
}


PUT /api/patients/{id}
Request Body
{
    "name": "Alice Brown",
    "age": 36,
    "risk_group": "Medium Risk"
}

Response (Success): HTTP Status Code 200 (OK)
{
    "id": 3,
    "name": "Alice Brown",
    "age": 36,
    "risk_group": "Medium Risk"
}

Response (Error): HTTP Status Code 404 (Not Found)
{
    "message": "Patient not found."
}


DELETE /api/patients/{id}
Response (Success): HTTP Status Code 200 
{
    "success": "Patient Deleted"
}

Response (Error/Fail): HTTP Status Code 404 (Not Found)
{
    "message": "Patient not found."
}