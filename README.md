# AtomWriter

`\SarSam\AtomWriter` is simple atom writer library for PHP 5.4 or later. This component is licensed under MIT license.



## Quick demo


```php
$feed = new Feed();

$feed->title('title')
    ->subtitle('subtitle')
    ->link('http://example.org/')
    ->linkSelf('http://example.org/feed/')
    ->id('urn:uuid:60a76c80-d399-11d9-b91C-0003939e0af6')
    ->updated();   //updated_at


//entry
$entry = new Entry();
$entry
    ->title('title')
    ->link('http://example.org/2003/12/13/atom03')
    ->linkAlternate('http://example.org/2003/12/13/atom03.html')
    ->linkEdit('http://example.org/2003/12/13/atom03/edit')
    ->id('urn:uuid:1225c695-cfb8-4ebb-aaaa-80da344efa6a')
    ->updated(111)
    ->summary('Some text.')
    ->content('content')
    ->author([
        'name'  => 'author name',
        'email' => 'author email',
    ])
    ->appendTo($feed);

echo $feed; // or echo $feed->render();
```

Output:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
    <title>title</title>
    <subtitle>subtitle</subtitle>
    <link href="http://example.org/" />
    <link href="http://example.org/feed/" rel="self" />
    <id>urn:uuid:60a76c80-d399-11d9-b91C-0003939e0af6</id>
    <updated>2003-12-13T18:30:02Z</updated>
    
    <entry>
      <title>13 Cannabis Events to Join in 2018</title>
      <link href="http://example.org/2003/12/13/atom03" />
      <link rel="alternate" type="text/html" href="http://example.org/2003/12/13/atom03.html"/>
      <link rel="edit" href="http://example.org/2003/12/13/atom03/edit"/>
      <id>urn:uuid:1225c695-cfb8-4ebb-aaaa-80da344efa6a</id>
      <summary>Some text.</summary>
      <updated>2003-12-13T18:30:02Z</updated>
      <content>
        <div xmlns="http://www.w3.org/1999/xhtml">
              content
        </div>
      </content>
      <author>
        <name>author name</name>
        <email>author email</email>
      </author>
    </entry>
</feed>
```

## Installation

### Easy installation

You can install directly via [Composer](https://getcomposer.org/):

```bash
$ composer require sarsam/atom-feed-writer
```

### Manual installation

Add the following code to your `composer.json` file:

```json
{
	"require": {
		"sarsam/php-atom-writer": "dev-master"
	}
}
```

...and run composer to install it:

```bash
$ composer install
```

Finally, include `vendor/autoload.php` in your product:

```php
require_once 'vendor/autoload.php';
```