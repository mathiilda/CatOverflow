--
-- Users
--
DROP TABLE IF EXISTS Users;
CREATE TABLE Users (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "username" TEXT NOT NULL,
    "email" TEXT NOT NULL,
    "password" TEXT NOT NULL,
    "points" INTEGER DEFAULT 0 NOT NULL
);


--
-- Questions
--
DROP TABLE IF EXISTS Questions;
CREATE TABLE Questions (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "question" TEXT NOT NULL,
    "author" TEXT NOT NULL,
    "title" TEXT NOT NULL,
    "tags" TEXT,
    "date" INTEGER NOT NULL,
    "points" INTEGER DEFAULT 0 NOT NULL,
    "accepted" INTEGER DEFAULT 0 NOT NULL,
    "answered" INTEGER DEFAULT 0 NOT NULL
);


--
-- Answers
--
DROP TABLE IF EXISTS Answers;
CREATE TABLE Answers (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "questionId" INTEGER NOT NULL,
    "answer" TEXT NOT NULL,
    "author" TEXT NOT NULL,
    "tags" TEXT,
    "date" INTEGER,
    "points" INTEGER DEFAULT 0 NOT NULL,
    "accepted" INTEGER DEFAULT 0 NOT NULL
);


--
-- Comments
--
DROP TABLE IF EXISTS Comments;
CREATE TABLE Comments (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "answerId" INTEGER,
    "questionId" INTEGER,
    "comment" TEXT NOT NULL,
    "author" TEXT NOT NULL,
    "tags" TEXT,
    "date" INTEGER NOT,
    "points" INTEGER DEFAULT 0 NOT NULL
);
