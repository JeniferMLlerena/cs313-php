/*POSTGRESQL PSQL DATA TYPES*/

CREATE TABLE users
(
    id SERIAL PRIMARY KEY
    , username VARCHAR(50) UNIQUE NOT NULL
    , password VARCHAR(50) NOT NULL
);

/*DROP TABLE users si queremos eliminar una table*/
CREATE TABLE speaker
(
    id SERIAL PRIMARY KEY
    , name VARCHAR(100) UNIQUE NOT NULL
);

CREATE TABLE sessions
(
    id SERIAL PRIMARY KEY
    , month SMALLINT NOT NULL
    , year SMALLINT NOT NULL
);

CREATE TABLE sessions
(
    id SERIAL PRIMARY KEY
    , content TEXT
    , date DATE NOT NULL DEFAULT NOW()
    , user_id INT NOT NULL REFERENCES users(id)
    , speaker_id INT NOT NULL REFERENCES speakers(id)
    , session_id INT NOT NULL REFERENCES sessions(id)
);  

/* \d notes to display the table settings*/