# PHP Stream API

This library is based upon the Stream-Api from Java and the Array-Prototype from Javascript

(https://docs.oracle.com/javase/8/docs/api/?java/util/stream/Stream.html)

(https://developer.mozilla.org/de/docs/Web/JavaScript/Reference/Global_Objects/Array/map)

Im publishing this library because I'm using it in almost all of my PHP-Projects.

## Dependencies
1. PHP >= 5
2. PHPUnit for development

## Usage

You can transform any traditional Array into a Stream either like that.
Stream-methods that return single elements from an array wrap those into Cells (compare Java optional).

Those values inside can be accessed via ```$cell->unwrap()``` or ```$celll->orElse($default)```.

unwrapping a cell with a null value inside throws a "NoElementException"


```PHP
use Stream/Stream;
$array = [1,2,3,4,5,6,7,8,9,10];
$stream = new Stream($array);
```
or like that

```PHP
use Stream/Stream;
$array = [1,2,3,4,5,6,7,8,9,10];
$stream = Stream::asStream($array);
```

The most functions from the Java Stream Api are implemented. 

## Examples

#### get the first even number from an array
```PHP
$array = [1,2,3,4,5,6,7,8,9,10];
$onlyEvenNumbers = Stream::asStream($array)->filter(function($v){return $v%2==0;});
$firstEvenNumber = $onlyEvenNumbers->first()->unwrap();
```
or in one line
```PHP
$onlyEvenNumbers = Stream::asStream([1,2,3,4,5,6,7,8,9,10])->filter(function($v){return $v%2==0;})->first()->unwrap();
```

#### square all numbers in an array

```PHP
$array = [1,2,3,4,5,6,7,8,9,10];
$quares = Stream::asStream($array)->map(function($v){return $v*$v;});
```

#### Print all numbers in an array

```PHP
$array = [1,2,3,4,5,6,7,8,9,10];
Stream::asStream($array)->forEach(function($v){echo $v;});
```


## License

MIT