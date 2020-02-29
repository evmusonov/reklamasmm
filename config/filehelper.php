<?php

return [
    'documentExtensions' => ['pdf', 'docx', 'xslx'],
    'imageExtensions'    => ['jpeg', 'png', 'gif'],
    'pathToStorage'      => $_SERVER['DOCUMENT_ROOT'] . '/storage',
    'versions' => [
        '200x200' => [
            'width'   => 200,
            'height'  => 200,
            'quality' => 100,
        ],
    ],
];