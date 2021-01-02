<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop flex flex-row",
 
    // Here comes the menu items
    "items" => [
        [
            "text" => "Home",
            "url" => "home",
            "title" => "Home.",
        ],
        [
            "text" => "Questions",
            "url" => "questions",
            "title" => "All questions.",
        ],
        [
            "text" => "Answers",
            "url" => "answers",
            "title" => "All answers.",
        ],
        [
            "text" => "Tags",
            "url" => "tags",
            "title" => "All tags.",
        ],
        [
            "text" => "Users",
            "url" => "users",
            "title" => "All users.",
        ],
        [
            "text" => "About",
            "url" => "about",
            "title" => "About this webpage.",
        ],
        [
            "text" => $_POST["user"] ?? "My profile",
            "url" => "profile?user=" . $_SESSION["user"],
            "title" => "My profile.",
            "img" => "img/favicon.png",
            "imgAlt" => "My profile-picture."
        ],
    ],
];
