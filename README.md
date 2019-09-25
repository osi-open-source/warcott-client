# Warcott API Client
- Client - consumes API
    - Fieldsets
    - Mapping
    - Fields

## Installation
Simply add the following line to your `composer.json` and run install/update:

    "osi-open-source/warcott-client": "*"
    
## Configuration

Publish the package config files to enter your credentials

    php artisan vendor:publish --tag=warcott

## Usage
You can use Facade, alias or helper functions
```php
\Warcott\Support\Facades\WarcottClient::getDataset(['domainKey']); 
\WarcottClient::getDataset(['domainKey']); 
warcottDataset([]); 

\Warcott\Support\Facades\WarcottClient::getMapping('domainKey', $data); 
\WarcottClient::getMapping('domainKey', $data); 
warcottMap('domainKey', $data)
```