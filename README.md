Amazon S3 Media Storage Bundle for OroCommerce
==============================================

Facts
-----
- version: 1.0.0
- composer name: aligent/orocommerce-s3mediabundle

Description
-----------

This bundle provides configuration for using S3 buckets for media storage in OroCommerce 
by configuring the KNPGaufrette Bundle.  It could also be used in OroCRM with changes to 
Gaufrette's filesystem names in app.yml.

### Parameters
```
    amazon_s3.bucket_name: s3-bucket-name
    amazon_s3.region: ap-southeast-2
    amazon_s3.key: USER_KEY
    amazon_s3.secret: SUPER_SECRET
```

The key and secret are optional in a ECS environment, as the ECS credentials provider is 
used as a fallback if neither of them exist. 


Installation Instructions
-------------------------
1. Install this module via Composer

        composer require aligent/orocommerce-s3mediabundle

1. Create the parameters (above) in your parameters.yml.

1. Clear cache
        
        php app/console cache:clear --env=prod
        

Support
-------
If you have any issues with this bundle, please create a 
[pull request](https://github.com/aligent/orocommerce-s3mediabundle/pulls) 
with a failing test that demonstrates the problem you've found.  If you're really 
stuck, feel free to open [GitHub issue](https://github.com/aligent/orocommerce-s3mediabundle/issues).

Contribution
------------
Any contribution is highly appreciated. The best way to contribute code is to open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).

Developer
---------
Initial version by Adam Hall <adam.hall@aligent.com.au>.

Minor tweaks for OroCommerce 3.0 by Jim O'Halloran <jim@aligent.com.au>

Licence
-------
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)

Copyright
---------
(c) 2018 Aligent Consulting
