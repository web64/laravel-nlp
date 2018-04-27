# Laravel NLP
A simple wrapper for PHP-NLP-Client and OpenCalais NLP tools.

## Installation

```
$ composer require web64/laravel-nlp
```

## Requirements

## Included Tools

* Article Extraction
* Language Detection
* Entity Extraction (Named Entity Recognition)
* Sentiment Analysis
* 

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

### Sentiment Analysis

### Concepts
### Embeddings

## More

For other Laravel NLP packages, check out:
 - https://github.com/AntoineAugusti/laravel-sentiment-analysis
 - https://github.com/michaeljhopkins/Laravel-Aylien-Wrapper
 - https://github.com/findbrok/laravel-personality-insights


 ## Contribute
