# boarding-passes
Sorter for boarding passes without departure/arrival information

## Description
Boarding Passes is a simple tool for sorting transportation tickets in a subsequent order and to output an itinerary that is human-readable.

## Prerequisites
- Apache
- PHP 7.2
- composer

## Installation
- Clone the git repository
- Install dependencies (composer install)
- Open application in the local browser (or use command php -a <file>)
- For customization update sample.json, but keep the structure

## Notes
The chosen design pattern for the application was the "Builder Pattern", which makes this example more extendable and easier to use, since subsequent method calling can be used for public methods. There are no unit tests, but they will be added in the future. Adherence to PSR-4 was considered as well.
