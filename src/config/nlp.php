<?php

return [

    // See instructions for setting up the NLP Server here: https://github.com/web64/nlpserver
    // Multiple hosts can be added 
    'hosts' => [
        env('NLPSERVER_URL', 'http://localhost:6400/'),
    ],


    // CoreNLP Server - See installation instructions:
    //  - https://stanfordnlp.github.io/CoreNLP/download.html
    //  - https://github.com/web64/php-nlp-client#running-the-corenlp-server
    'corenlp_host' => env('CORENLP_HOST', 'http://localhost:9000/'),


    // register fot API key here: http://www.opencalais.com/
    'opencalais_key' => env('OPENCALAIS_KEY'),


    // Verbose output
    'debug' => false,
];