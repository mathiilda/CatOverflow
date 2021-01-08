<?php
/**
 * Configuration file for page which can create and put together web pages
 * from a collection of views. Through configuration you can add the
 * standard parts of the page, such as header, navbar, footer, stylesheets,
 * javascripts and more.
 */

$url = strtok($_SERVER["REQUEST_URI"] ?? "/dbwebb-extra/ramverk1/me/kmom10/CatOverflow/htdocs/", '?');
$urlLocal = "/dbwebb-extra/ramverk1/me/kmom10/CatOverflow/htdocs/";
$urlLocalIndex = "/dbwebb-extra/ramverk1/me/kmom10/CatOverflow/htdocs/index";
$urlServer = "/~mabw19/dbwebb-kurser/ramverk1/me/kmom10/CatOverflow/htdocs/";
$urlServerIndex = "/~mabw19/dbwebb-kurser/ramverk1/me/kmom10/CatOverflow/htdocs/index";

if ($url == $urlLocal || $url == $urlLocalIndex || $url == $urlServer || $url == $urlServerIndex) {
    return [
        "layout" => [
            "region" => "layout",
            "template" => "anax/v2/layout/dbwebb_se",
            "data" => [
                "baseTitle" => " | CatOverflow",
                "bodyClass" => null,
                "favicon" => "img/favicon.png",
                "htmlClass" => null,
                "lang" => "sv",
                "stylesheets" => [
                    // "css/dbwebb-se.min.css",
                    "https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"
                ],
                "javascripts" => [
                    "js/responsive-menu.js",
                    "https://kit.fontawesome.com/cf84b74235.js"
                ],
            ],
        ],
    ];
}

return [
    // This layout view is the base for rendering the page, it decides on where
    // all the other views are rendered.
    "layout" => [
        "region" => "layout",
        "template" => "anax/v2/layout/dbwebb_se",
        "data" => [
            "baseTitle" => " | CatOverflow",
            "bodyClass" => null,
            "favicon" => "img/favicon.png",
            "htmlClass" => null,
            "lang" => "sv",
            "stylesheets" => [
                // "css/dbwebb-se.min.css",
                "css/addition.css",
                "https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"
            ],
            "javascripts" => [
                "js/responsive-menu.js",
                "https://kit.fontawesome.com/cf84b74235.js"
            ],
        ],
    ],

    // These views are always loaded into the collection of views.
    "views" => [
        [
            "region" => "header-col-1",
            "template" => "anax/v2/header/site_logo_text",
            "data" => [
                "homeLink"      => "home",
                "siteLogoText"  => "CatOverflow",
                "siteLogoTextIcon" => "image/favicon.png?width=60",
                "siteLogoTextIconAlt" => "Cat-logo",
            ],
        ],
        [
            "region" => "header-col-2",
            "template" => "anax/v2/navbar/navbar_submenus",
            "data" => [
                "navbarConfig" => require __DIR__ . "/navbar/header.php",
            ],
        ],
        // [
        //     "region" => "header-col-3",
        //     "template" => "anax/v2/navbar/responsive_submenus",
        //     "data" => [
        //         "navbarConfig" => require __DIR__ . "/navbar/responsive.php",
        //     ],
        // ],
        [
            "region" => "footer",
            "template" => "anax/v2/columns/multiple_columns",
            "data" => [
                "class"  => "footer-column",
                "columns" => [
                    [
                        "template" => "anax/v2/block/default",
                        "contentRoute" => "block/footer-col-1",
                    ],
                    [
                        "template" => "anax/v2/block/default",
                        "contentRoute" => "block/footer-col-2",
                    ],
                    [
                        "template" => "anax/v2/block/default",
                        "contentRoute" => "block/footer-col-3",
                    ]
                ]
            ],
            "sort" => 1
        ],
        [
            "region" => "footer",
            "template" => "anax/v2/block/default",
            "data" => [
                "class"  => "site-footer",
                "contentRoute" => "block/footer",
            ],
            "sort" => 2
        ],
    ],
];
