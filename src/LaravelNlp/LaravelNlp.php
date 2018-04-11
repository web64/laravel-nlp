<?php


namespace Web64\LaravelNlp;

use PHPUnit\Framework\Constraint\Exception;


class LaravelNlp extends \Web64\Nlp\NlpClient
{
    private $opencalais_key;

    public function __construct($config)
    {
        //dd( $config );
        if ( !empty($config['opencalais_key']) )
            $this->opencalais_key = $config['opencalais_key'];

        parent::__construct($config['hosts'], $config['debug']);

    }

    public function entities( $text, $language )
    {
        $response = $this->polyglot($text, $language);

        if ( $response )
            return $response->getEntities();
    }

    public function opencalais( $text )
    {
        if ( empty($this->opencalais_key) )
            throw new \Exception("Missing OpenCalais API key in configuration.");

        $oc = new \OpenCalais\OpenCalais( $this->opencalais_key );
        return $oc->getEntities( $text );
    }
}
