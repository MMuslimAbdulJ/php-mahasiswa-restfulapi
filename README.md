# API Spec

## Create Mahasiswa

Request :

- Method : POST
- Endpoint : `api/mahasiswa`
- Header :
  - Content-Type : application/json
  - Accept : application/json
- Body :

```json
{
  "nim": "string, unique, (9)",
  "nama": "string",
  "fakultas": "string",
  "prodi": "string"
}
```

Response :

```json
{
  "code": "number",
  "status": "string",
  "data": {
    "nim": "string, unique, (9)",
    "nama": "string",
    "fakultas": "string",
    "prodi": "string"
  }
}
```

## Get Mahasiswa

Request :

- Method : GET
- Endpoint : `api/mahasiswa/{nim_mahasiswa}`
- Header :
  - Accept : appliaction/json

Response :

```json
{
  "code": "number",
  "status": "string",
  "data": {
    "nim": "string, unique, (9)",
    "nama": "string",
    "fakultas": "string",
    "prodi": "string"
  }
}
```

## Update Mahasiswa

Request :

- Method : PUT/PATCH
- Endpoint : `api/mahasiswa/{nim_mahasiswa}`
- Header :
  - Content-Type : application/json
  - Accept : application/json
- Body :

```json
{
  "nama": "string",
  "fakultas": "string",
  "prodi": "string"
}
```

Response :

```json
{
  "code": "number",
  "status": "string",
  "data": {
    "nim": "string, unique, (9)",
    "nama": "string",
    "fakultas": "string",
    "prodi": "string"
  }
}
```

## Delete Mahasiswa

Request :

- Method : DELETE
- Endpoint : `api/mahasiswa/{nim_mahasiswa}`
- Header :
  - Accept : application/json

Response :

```json
{
  "code": "number",
  "status": "string"
}
```
