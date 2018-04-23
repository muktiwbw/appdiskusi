# About
AppDiskusi adalah suatu aplikasi diskusi sederhana sebagai pembelajaran CRUD dasar dan REST API pada framework Laravel.

# Endpoint

## Register
Digunakan untuk mendaftarkan user baru.

### Endpoint
```
POST https://appdiskusi-react.herokuapp.com/api/register
```

### Request Body
```
{
    "username":"prefered_username",
    "email":"prefered_email",
    "password":"prefered_password",
    "first_name":"prefered_first_name",
    "last_name":"prefered_last_name"
}
```

### Response
```
{
    "id":"created_user_id",
    "username":"prefered_username",
    "email":"prefered_email",
    "first_name":"prefered_first_name",
    "last_name":"prefered_last_name",
    "created_at":"user_creation_date"
}
```
---
## Login
Digunakan untuk autentikasi user.

### Endpoint
```
POST https://appdiskusi-react.herokuapp.com/api/login
```

### Request Body
```
{
    "username":"user_username",
    "password":"user_password"
}
```

### Response
```
{
    "id":"created_user_id",
    "api_token":"user_api_token"
}
```
---
## User Info
Digunakan untuk mendapatkan info user.

### Endpoint
```
GET https://appdiskusi-react.herokuapp.com/api/info/{api_token}/{user_id}
```

### Response
```
{
    "id":"user_id",
    "username":"user_username",
    "email":"user_email",
    "name":"user_name",
    "created_at":"user_creation_date",
}
```
---
## User's Questions
Digunakan untuk mendapatkan pertanyaan-pertanyaan yang dibuat oleh user.

### Endpoint
```
GET https://appdiskusi-react.herokuapp.com/api/questions/{api_token}/{user_id}
```

### Response
```
[
    {
        "id":"question_id",
        "title":"question_title",
        "text":"question_text",
        "user_id":"question_user_id",
        "created_at":"user_creation_date"
    }
]
```
---
## Create Question
Digunakan untuk membuat pertanyaan baru.

### Endpoint
```
POST https://appdiskusi-react.herokuapp.com/api/question/store
```
### Request Body
```
{
    "api_token":"user_api_token",
    "title":"question_title",
    "text":"question_text"
}
```

### Response
```
{
    "message":"Pertanyaan berhasil dibuat",
    "data":{
        "id":"question_id",
        "title":"question_title",
        "text":"question_text",
        "user_id":"question_user_id",
        "created_at":"user_creation_date"
    }
}
```
---
## Read Single Question
Digunakan untuk menampilkan detail pertanyaan disertai dengan jawaban-jawaban pada pertanyaan tersebut.

### Endpoint
```
GET https://appdiskusi-react.herokuapp.com/api/question/show/{api_token}/{question_id}
```

### Response
```
{
    "id":"question_id",
    "title":"question_title",
    "text":"question_text",
    "user":{
        "id":"author_id",
        "email":"author_email",
        "username":"author_username"
    },
    "answers":[
        {
            "id":"answer_id",
            "text":"answer_text",
            "user_id":"author_id",
            "question_id":"answer_question_id",
            "created_at":"answer_creation_date",
            "updated_at":"answer_manipulation_date"
        }
    ],
    "created_at":"question_creation_date",
    "updated_at":"question_manipulation_date"
}
```
---
## Read All Question
Digunakan untuk menampilkan semua pertanyaan yang tersimpan pada database.

### Endpoint
```
GET https://appdiskusi-react.herokuapp.com/api/question/index/{api_token}
```


### Response
```
[
    {
        "id":"question_id",
        "title":"question_title",
        "text":"question_text",
        "user":"author_id",
        "created_at":"question_creation_date",
        "updated_at":"question_manipulation_date"
    }
]
```
---
## Update Question
Digunakan untuk mengedit pertanyaan.

### Endpoint
```
POST https://appdiskusi-react.herokuapp.com/api/question/update
```
### Request Body
```
{
    "api_token":"user_api_token",
    "question_id":"question_id",
    "title":"new_question_title",
    "text":"new_question_text"
}
```

### Response
```
{
    "message":"Data berhasil diupdate",
    "data":{
        "id":"question_id",
        "title":"question_title",
        "text":"question_text",
        "user":"author_id",
        "created_at":"question_creation_date",
        "updated_at":"question_manipulation_date"
    }
}
```
---
## Delete Question
Digunakan untuk menghapus pertanyaan.

### Endpoint
```
POST https://appdiskusi-react.herokuapp.com/api/question/destroy
```
### Request Body
```
{
    "api_token":"user_api_token",
    "question_id":"question_id"
}
```

### Response
```
{
    "message":"Data berhasil dihapus",
    "data":{
        "id":"question_id",
        "title":"question_title",
        "text":"question_text",
        "user":"author_id",
        "created_at":"question_creation_date",
        "updated_at":"question_manipulation_date"
    }
}
```
---
## Create Answer
Digunakan untuk membuat jawaban.

### Endpoint
```
POST https://appdiskusi-react.herokuapp.com/api/answer/store
```
### Request Body
```
{
    "api_token":"user_api_token",
    "question_id":"question_id",
    "text":"answer_text"
}
```

### Response
```
{
    "id":"answer_id",
    "text":"answer_text",
    "user_id":"author_id",
    "question_id":"answer_question_id",
    "created_at":"answer_creation_date",
    "updated_at":"answer_manipulation_date"
}
```
---
## Update Answer
Digunakan untuk mengedit jawaban.

### Endpoint
```
POST https://appdiskusi-react.herokuapp.com/api/answer/update
```
### Request Body
```
{
    "api_token":"user_api_token",
    "answer_id":"answer_id",
    "text":"new_answer_text"
}
```

### Response
```
{
    "message":"Jawaban berhasil diupdate",
    "data":{
        "id":"answer_id",
        "text":"answer_text",
        "user_id":"author_id",
        "question_id":"answer_question_id",
        "created_at":"answer_creation_date",
        "updated_at":"answer_manipulation_date"
    }
}
```
---
## Delete Answer
Digunakan untuk menghapus jawaban.

### Endpoint
```
POST https://appdiskusi-react.herokuapp.com/api/answer/destroy
```
### Request Body
```
{
    "api_token":"user_api_token",
    "answer_id":"answer_id"
}
```

### Response
```
{
    "message":"Jawaban berhasil dihapus",
    "data":{
        "id":"answer_id",
        "text":"answer_text",
        "user_id":"author_id",
        "question_id":"answer_question_id",
        "created_at":"answer_creation_date",
        "updated_at":"answer_manipulation_date"
    }
}
```
---
## Vote
Digunakan untuk menambahkan vote pada pertanyaan.

### Endpoint
```
POST https://appdiskusi-react.herokuapp.com/api/vote
```
### Request Body
```
{
    "api_token":"user_api_token",
    "question_id":"question_id",
    "type":"up/down"
}
```

### Response
```
{
    "message":"Vote berhasil ditambahkan",
    "data":{
        "id":"answer_id",
        "type":"vote_type",
        "user_id":"author_id",
        "question_id":"answer_question_id",
        "created_at":"answer_creation_date",
        "updated_at":"answer_manipulation_date"
    }
}
```
---
## Unvote
Digunakan untuk menghapus vote pada pertanyaan.

### Endpoint
```
POST https://appdiskusi-react.herokuapp.com/api/unvote
```
### Request Body
```
{
    "api_token":"user_api_token",
    "question_id":"question_id"
}
```

### Response
```
{
    "message":"Vote berhasil dihapus",
    "data":{
        "id":"answer_id",
        "type":"vote_type",
        "user_id":"author_id",
        "question_id":"answer_question_id",
        "created_at":"answer_creation_date",
        "updated_at":"answer_manipulation_date"
    }
}
```
