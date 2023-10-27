# magento-saml-antireplay
SAML Extension for Magento2 which adds support to prevent Replay Attacks

It requires any of the following magento extensions:
- https://commercemarketplace.adobe.com/sixtomartin-onelogin-module-saml2.html (requires version >= 1.11.0)
- https://commercemarketplace.adobe.com/sixtomartin-onelogin-module-saml2-extend.html (requires version >= 1.11.0)

In order to install it via composer, execute:

```
composer require iamdigitalservices/onelogin-module-saml2-antireplay
```

Then execute:
```
php bin/magento cache:clean
php bin/magento module:enable Pitbulk_Antireplay
php bin/magento setup:upgrade
php bin/magento setup:upgrade
php bin/magento setup:di:compile
```

Time to time, execute the Magento CLI command to truncate the table that stores the Assertion IDs with:
```
php bin/magento antireplay:clean-assertions
``` 
