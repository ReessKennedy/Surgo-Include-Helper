## What ⚡
Pull in commonly used code snippets in a simple, atomic way. 

## Why Atomic 🤷‍♂️
Writing a large number of functions to one file might initially feel efficient, especially if you group them into a file with related functions like "time" but then you move on to another project and realize you need to do lots of the same basic stuff but all the stuff from previous projects is buried in long files and it takes quite a bit of time to pull out the bits you need. 

It gets even worse if you have many projects and you've been using the all-functions-to-one-file method for each of them and they all use different variants of the same function and you're not sure which variant is best and again waste lots of time trying to look through and find what you need. 

A better way: Just put each function into its own file. It will live here like a lego block that does one thing and hopefully does it well! It takes some input and returns some output. 

With this include method, using the code here, you can include this lego block in hundreds of projects and if you make a refinement to the way this one lego block works you can update it in this one place and all your hundreds of projects can immediately benefit from this without needing to evaluate the update within the context of each program. 

I used to think that there would be some serious performance loss to including so many files within an app but I've found that the main thing that slows wep apps down are http calls, especially to many domains, and including many files on the same server with includes is still pretty fast. Plus, if you wish, you can use this method during development and then use a function merge tool to combine the functions for production use. 

## Impact of AI 🤖
I started using this method before AI came on to the seem and it's true that sometimes, now, it's easier to just ask AI to write out something to solve an issue you're having and allow it to choose the functions and I am, as a result, refining my little garden of key functions less but I still believe in this method. 

I am also working to see if I can teach my AI all about the functions I use and that are already stored in my garden and tell it to just use these when it can and to improve these functions as well. If I can get this to go it will still mean the tools I use will be easier to use and maintain. 

## How 📋
Just include the file somehow in your project
```php
require('surgo_atomic_includes.php');  
```

And then go for it with something like this 
```php
$incs = 	
array(
	'api_requests',  // Annotation about this .. 
	'surgo_table_td',	
	'surgo_table_css_1',
	'pretty_array',
	'surgo_inputs',
	'time_ago',
	'time_ago2',
	'time_test',
	'debug'
);
surgo_include('path/to/my/snippets',$incs);
```

Since this is often used in development it can also output a html look at the includes being used in an app at the top, like seeing all the pieces of the building block. 

