<?php

// Run `node -e "console.log(require('crypto').randomBytes(32).toString('hex'))"`
// in terminal to generate secret
define('APPLICATION_NAME', 'fitness-app');
define('JWT_SECRET', '77491c191e4de2bcfb0a2cd778d8c6017b0940436419fe1a5c99447daab0739f');


// Set database connection info here
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'fitness_app');