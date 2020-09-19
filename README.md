# Laravel NLP

<p align="center">
  <img src="http://cdn.web64.com/nlp-norway/laravel-nlp-6.png" width="400">
</p>

A simple wrapper for the [PHP-NLP-Client](https://github.com/web64/php-nlp-client) library for accessing Python and Java NLP libraries and external NLP APIs.

## Installation

```bash
$ composer require web64/laravel-nlp
```

Plese follow the instructions here to install the NLP Server and CoreNLP server:

- https://github.com/web64/nlpserver
- https://github.com/web64/php-nlp-client

If you want to use Opencalais, get a token by registering [here](http://www.opencalais.com/) and read their [terms of service](http://www.opencalais.com/open-calais-terms-of-service/)

## Configuration

Add `NLPSERVER_URL` to your `.env` file to specify the location of where the NLP Server is running.
If you want to use [CoreNLP](https://stanfordnlp.github.io/CoreNLP/download.html) or [Opencalais](http://www.opencalais.com/) also fill inn those details in .env.

```
NLPSERVER_URL="http://localhost:6400/"
CORENLP_HOST="http://localhost:9000/"
OPENCALAIS_KEY=
```

Alternatively, update the nlp.php configuration file.

```bash
# Publish nlp.php config file
$ php artisan vendor:publish --provider="Web64\LaravelNlp\NlpServiceProvider"
```

## Quick Start

```php
use Web64\LaravelNlp\Facades\NLP;

// Get Article content and metadata
$article = NLP::article($url);

// Detect language
$lang = NLP::language("What language is this?");

// Entity Extraction
$entities = NLP::entities( $text, 'en' );

// Sentiment analysis
$sentiment = NLP::sentiment( $text, 'en' );

// Translage text to Portuguese
$translated_text = NLP::translate($text, null, 'pt');
```

## NLP Server

This package requires a running instance of the NLP Server (https://github.com/web64/nlpserver) for most of the functionality to work.
See the documentation for installation instructions of the NLP Server.

## Included NLP Tools

- [Language Detection](#language-detection)
- [Article Extraction](#article-extraction)
- [Entity Extraction (Named Entity Recognition)](#entity-extraction-with-polyglot)
- [Sentiment Analysis](#sentiment-analysis)
- [Summarization](#summarization)
- [Translation](#translation)
- [Neighbouring Words](#neighbouring-words)
- [Concepts](#concepts)

## Usage

Include the class to use the NLP facade.

```php
use Web64\LaravelNlp\Facades\NLP;
```

### Language Detection

```php
$lang = NLP::language("What language is this?");
// 'en'
```

### Article Extraction

```php
$article = NLP::article("https://medium.com/@taylorotwell/wildcard-letsencrypt-certificates-on-forge-d3bdec43692a");
dump($article);
/*
[
    "article_html" => "<div><h1 name="9022" id="9022" class="graf graf--h3 graf--leading raf--title">Wildcard LetsEncrypt Certificates on&#160;Forge</h1>...",
    "authors" => ["Taylor Otwell"],
    "canonical_url" => https://medium.com/@taylorotwell/wildcard-letsencrypt-certificates-on-forge-d3bdec43692a",
    "meta_data" => [ ... ],
    "meta_description" => "Today we’re happy to announce support for wildcard LetsEncrypt certificates on Laravel Forge…",
    "publish_date" => "2018-03-16 13:43:54",
    "text" => "Wildcard LetsEncrypt Certificates on Forge...",
    "title" => "Wildcard LetsEncrypt Certificates on Forge – Taylor Otwell – Medium",
    "top_image" => "https://cdn-images-1.medium.com/max/1200/1*y1yKkIQqGHcpOmsObR7WIQ.png",
]
*/
```

### Entity Extraction with Polyglot

This function uses the [Polyglot](https://polyglot.readthedocs.io/en/latest/Installation.html) library which supports entity extraction for 40 languages.
Make sure you have downloaded the language models for the languages you are using.

For English and other major European languages use [Spacy](https://spacy.io/usage/) or [CoreNLP](https://stanfordnlp.github.io/CoreNLP/download.html) for best results.

```php
$text = "Barack Hussein Obama is an American politician who served as the 44th President of the United States from January 20, 2009 to January 20, 2017. Before that, he served in the Illinois State Senate from 1997 until 2004.";

$entities = NLP::entities( $text, 'en' );
/*
Array
(
    [0] => Barack Hussein Obama
    [1] => American
    [2] => United States
    [3] => Illinois
)
*/
```

## Entity Extraction with Spacy

A running NLP Server provides access to Spacy's entity extraction.

Spacy has language models for English, German, Spanish, Portuguese, French, Italian and Dutch.

```php
$entities = NLP::spacy_entities($text, 'en' );
/*
array:4 [
  "DATE" => array:1 [
    0 => "1857"
  ]
  "GPE" => array:3 [
    0 => "Kentucky"
    1 => "the United States"
    2 => "the Confederate States of America"
  ]
  "NORP" => array:1 [
    0 => "Breckinridge  "
  ]
  "PERSON" => array:2 [
    0 => "John C. Breckinridge"
    1 => "James Buchanan's"
  ]
]
*/
```

### Entitiy extraction with CoreNLP

[CoreNLP](https://github.com/web64/php-nlp-client#corenlp---entity-extraction-ner) provides very good entoty extraction for English texts.

To use this function you need a running instance of the CoreNLP server. [See installation inststructions](https://github.com/web64/php-nlp-client#corenlp---entity-extraction-ner)

Specify the URL of the CoreNLP server in `CORENLP_HOST` in .env or `config/nlp/php`.

```php
$entities = NLP::corenlp_entities($text);
/*
array:6 [
  "PERSON" => array:3 [
    0 => "John C. Breckinridge"
    1 => "James Buchanan"
  ]
  "STATE_OR_PROVINCE" => array:1 [
    0 => "Kentucky"
  ]
  "COUNTRY" => array:1 [
    0 => "United States"
  ]
  "ORGANIZATION" => array:1 [
    0 => "Confederate States of America"
  ]
  "DATE" => array:1 [
    0 => "1857"
  ]
  "TITLE" => array:1 [
    0 => "vice president"
  ]
]
*/
```

### Sentiment Analysis

This will return a value ranging from -1 to +1, where > 0 is considered to have a positive sentiment and everython < 0 has a negative sentiment.

Provide the language code as the second parameter to specify the language of the text. (default='en').

```php
$sentiment = NLP::sentiment( "This is great!" );
// 1

$sentiment = NLP::sentiment( "I hate this product", 'en' );
// -1
```

### Summarization

This will take a long text and return a summary of what is considered to be the most important sentences.
An optional max. number of words can be speficied.

```php
$summary = NLP::summarize($long_text);
$summary = NLP::summarize($long_text, $max_word_count) ;

```

### Translation

Second parameter is the source language. Language will be automatically detected if left as NULL

```php
$translated_text = NLP::translate($text, $from_lang, $to_lang);

$translated_text = NLP::translate("Mange er opprørt etter avsløringene om at persondata for 87 millioner Facebook-brukere skal være på avveie", null, 'pt');
// 'Muitas pessoas estão chateadas após a divulgação de que os dados pessoais de 87 milhões de usuários do Facebook devem estar fora de ordem'
```

### Neighbouring Words

This uses word embeddings to find related words from the one given.

```php
$words = NLP::neighbours( 'president');
dump( $words );
/*
array:10 [
  0 => "chairman"
  1 => "vice-president"
  2 => "President"
  3 => "Chairman"
  4 => "Vice-President"
]
*/

// ensure polyglot language model is installed: polyglot download LANG:no
$norwegian_words = NLP::neighbours( 'president', 'no');
/*
array:10 [
  0 => "visepresident"
  1 => "presidenten"
  2 => "statsminister"
  3 => "utenriksminister"
  4 => "finansminister"
]
*/
```

### Concepts

This uses Microsoft Concept Graph For Short Text Understanding: https://concept.research.microsoft.com/

An array of related concepts will be returned.

```php
$concepts = NLP::concepts( 'php' );

/*
array:10 [
  "language" => 0.40301612064483
  "technology" => 0.19656786271451
  "programming language" => 0.14456578263131
  "open source technology" => 0.057202288091524
  "scripting language" => 0.049921996879875
  "server side language" => 0.044201768070723
  "web technology" => 0.031201248049922
  "server-side language" => 0.027561102444098
]
*/
```

## More

For other Laravel NLP packages, check out:

- https://github.com/AntoineAugusti/laravel-sentiment-analysis
- https://github.com/michaeljhopkins/Laravel-Aylien-Wrapper
- https://github.com/findbrok/laravel-personality-insights

## Contribute

Get in touch if you have any feedback or ideas on how to improve this package or the documentation.
