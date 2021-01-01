<?php
/**
 * Config file for Database.
 *
 * Example for SQLite.
 *  "dsn" => "sqlite::memory:",
 *  "dsn" => "sqlite:$path",
 *
 */
return [
    "dsn"             => "sqlite:" . ANAX_INSTALL_PATH . "/data/db.sqlite",
    "username"        => null,
    "password"        => null,
    "driver_options"  => null,
    "fetch_mode"      => \PDO::FETCH_OBJ,
    "table_prefix"    => null,
    "session_key"     => "Anax\Database",
    "emulate_prepares" => false,

    // True to be very verbose during development
    "verbose"         => false,
];