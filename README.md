Amazon S3 Media Storage Bundle for Oro Platform
===============================================

Info
-----
- composer name: aligent/orocommerce-s3mediabundle

Description
-----------
This bundle provides configuration for using S3 buckets for media storage in Oro Platform 
by configuring the KNPGaufrette Bundle.  It will work with both OroCommerce and OroCRM 
versions based on Oro Platform 4.0.0 and later.  For older versions pf OroCommerce use one 
of the 1.x releases of this module.

### Parameters
```
    amazon_s3.bucket_name: s3-bucket-name
    amazon_s3.region: ap-southeast-2
    amazon_s3.key: USER_KEY
    amazon_s3.secret: SUPER_SECRET
```

The key and secret are optional in an ECS environment, as the ECS credentials provider is 
used as a fallback if neither of them exist. 


Installation Instructions
-------------------------
1. Install this module via Composer

        composer require aligent/orocommerce-s3mediabundle

1. Create the parameters (above) in your parameters.yml.

1. Clear cache
        
        php bin/console cache:clear --env=prod
        
AWS Setup
---------

1. Create an Amazon S3 bucket.  Default settings and permissions are fine, 
there is no need for the bucket to be public.

1. Create the following IAM Customer Managed Policy (which grants full 
access to a single S3 bucket) substituting NameOfBucketHere with your S3 
bucket's name:

        {
            "Version": "2012-10-17",
            "Statement": [
                {
                    "Effect": "Allow",
                    "Action": "s3:*",
                    "Resource": [
                        "arn:aws:s3:::NameOfBucketHere",
                        "arn:aws:s3:::NameOfBucketHere/*"
                    ]
                }
            ]
        }

1. Create an IAM user, directly attach your new policy and generate Access and 
Secret keys.  Insert those values into your parameters.yml (see above), clear 
cache and you're good to go!

Upgrading OroCommerce Enterprise to 3.1.12, 4.1 or 1.6.45
-------
Oro have migrated the media cache directory structure so that images with the same filters will be shared across websites, reducing the size of the media cache.
Unfortunately if you have a large amount of images stored on S3 using this bundle the core Migration can take a LONG time to migrate to the new structure.
We have provided a command that can be run locally to copy the images to the new directory structure. This way you can pre-move the images and manually mark that migration as being run.

Usage:
```
$ bin/console aligent:s3:migrate-website-images some-bucket-name AWS_KEY AWS_SECRET ap-southeast-2 --env=prod
```

Once the images have been copied to the new path, you can mark the core Oro\Bundle\MultiWebsiteBundle\Migrations\Data\ORM\MigrateFilteredAttachments 
and Oro\Bundle\AttachmentBundle\Migrations\Data\ORM\MigrateFilteredAttachments data migrations as run in the database (By performing a manual insert into the oro_migrations_data table) 
and deploy the new version. After the deploy is complete, you can delete all the images from their old path.
 
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

Update for Oro Platform 4.0 by Jim O'Halloran <jim.ohalloran@incore.com.au>

Licence
-------
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)

Copyright
---------
(c) 2018-19 Aligent Consulting
