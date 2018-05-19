# Laravel NLP
A simple wrapper for PHP-NLP-Client for accessing Python and Java NLP libraries.

## Installation

```
$ composer require web64/laravel-nlp
```

## Requirements

## NLP Server
This package requires a running instance of the NLP Server [https://github.com/web64/nlpserver]

## Included Tools

* Article Extraction
* Language Detection
* Entity Extraction (Named Entity Recognition)
* Sentiment Analysis
* Summarization
* Translation
* Embeddings - Neighbouring Words

## Usage

### Language Detection
```php
use Web64\LaravelNlp\Facades\NLP;

$lang = NLP::language("What language is this?");
// 'en'
```

### Article Extraction
```php
use Web64\LaravelNlp\Facades\NLP;

$article = NLP::article("https://medium.com/@taylorotwell/wildcard-letsencrypt-certificates-on-forge-d3bdec43692a");
print_r($article);
/*
[
     "article_html" => "<div><h1 name="9022" id="9022" class="graf graf--h3 graf--leading graf--title">Wildcard LetsEncrypt Certificates on&#160;Forge</h1>...",
     "authors" => ["Taylor Otwell"],
     "canonical_url" => "https://medium.com/@taylorotwell/wildcard-letsencrypt-certificates-on-forge-d3bdec43692a",
     "meta_data" => [ ... ],
     "meta_description" => "Today we’re happy to announce support for wildcard LetsEncrypt certificates on Laravel Forge…",
     "publish_date" => "2018-03-16 13:43:54",
     "text" => "Wildcard LetsEncrypt Certificates on Forge...",
     "title" => "Wildcard LetsEncrypt Certificates on Forge – Taylor Otwell – Medium",
     "top_image" => "https://cdn-images-1.medium.com/max/1200/1*y1yKkIQqGHcpOmsObR7WIQ.png",
]
*/
```

### Entity Extraction
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
### Sentiment Analysis
```php
$sentiment = NLP::sentiment( "This is great!" );
// 1

$sentiment = NLP::sentiment( "I hate this product" );
// -1
```
### Summarization
### Translation
Second parameter is the source language. Language will be automatically detected if left as NULL

```php
$translated_text = NLP::translate("Mange er opprørt etter avsløringene om at persondata for 87 millioner Facebook-brukere skal være på avveie", null, 'pt');
// 'Muitas pessoas estão chateadas após a divulgação de que os dados pessoais de 87 milhões de usuários do Facebook devem estar fora de ordem'
```

### Concepts
### Embeddings

## More

For other Laravel NLP packages, check out:
 - https://github.com/AntoineAugusti/laravel-sentiment-analysis
 - https://github.com/michaeljhopkins/Laravel-Aylien-Wrapper
 - https://github.com/findbrok/laravel-personality-insights


 ## Contribute
