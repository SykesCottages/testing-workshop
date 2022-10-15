<?php

return [
    'mysqli' => new mysqli(
        getenv('MYSQL_HOST'),
        getenv('MYSQL_USER'),
        getenv('MYSQL_PASSWORD'),
        getenv('MYSQL_DATABASE')
    )
];
