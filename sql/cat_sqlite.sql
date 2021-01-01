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
