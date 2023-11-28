CREATE TABLE questions (
    id SERIAL PRIMARY KEY,
    text TEXT NOT NULL
);

CREATE TABLE answers (
    id INTEGER PRIMARY KEY,
    text TEXT,
    question_id INTEGER,
    is_correct BOOLEAN
);
