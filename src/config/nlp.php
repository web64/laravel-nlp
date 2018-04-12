<?php

return [
    // See instructions for setting up the NLP Server here: https://github.com/web64/nlpserver
    'hosts' => [
        'http://localhost:6400/',
    //  'http://server2:6400/', 
    ],


    // Verbose output
    'debug' => false,
    
    // register fot API key here: http://www.opencalais.com/
    'opencalais_key' => env('OPENCALAIS_KEY'),
];