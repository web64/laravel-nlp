<?php

namespace Web64\LaravelNlp;


class LaravelNlp extends \Web64\Nlp\NlpClient
{
    private $opencalais_key;
    private $corenlp_host;

    public function __construct($config)
    {
        if ( !empty($config['opencalais_key']) )
            $this->opencalais_key = $config['opencalais_key'];

        if ( !empty($config['corenlp_host']) )
            $this->corenlp_host = $config['corenlp_host'];

        parent::__construct($config['hosts'], $config['debug']);
    }

    public function concepts( $word )
    {
        return (new \Web64\Nlp\MsConceptGraph)->get( $word );
    }

    public function article( $url )
    {
        return $this->newspaper( $url );
    }

    public function translate($text, $source_lang = null, $target_lang = null)
    {
        $translator = new  \Stichoza\GoogleTranslate\GoogleTranslate;

        if ( $source_lang )
            $translator->setSource($source_lang); 
        
        if ( $target_lang )
            $translator->setTarget($target_lang); 

        return $translator->translate( $text );
    }

    public function entities( $text, $language = 'en' )
    {
        $response = $this->polyglot_entities($text, $language);

        if ( $response )
            return $response->getEntities();
    }
    

    public function entitiy_types( $text, $language = 'en' )
    {
        $response = $this->polyglot_entities($text, $language);

        if ( $response )
            return $response->getEntityTypes();
    }

    public function opencalais( $text )
    {
        if ( empty($this->opencalais_key) )
            throw new \Exception("Missing OpenCalais API key in configuration.");

        $oc = new \OpenCalais\OpenCalais( $this->opencalais_key );
        return $oc->getEntities( $text );
    }

    public function corenlp_entities($text)
    {
        if ( empty($this->corenlp_host) )
            throw new \Exception("Missing CoreNLP host in configuration.");

        return (new \Web64\Nlp\CoreNlp($this->corenlp_host))->entities($text);
    }
}
