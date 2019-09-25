# Warcott API Client
- Client - consumes API
    - Fieldsets
    - Mapping
    - Fields

## Warcott resources
- [API Documentation](https://documenter.getpostman.com/view/2144961/6fSW6LQ)
- [API Postman collection](https://www.getpostman.com/collections/5857160ac88f047d124f)
- [Warcott AWW Calculator APIs](https://documenter.getpostman.com/view/2144961/RWEmHG34)
- [Postman Warcott AWW Calculator Collection](https://www.getpostman.com/collections/37983b43a86013af1a67)

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