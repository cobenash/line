
## SUMMARY
Integration module with SDK of the LINE Messaging API for PHP.
For a full description of the module, visit the project page:
  http://drupal.org/project/line
To submit bug reports and feature suggestions, or to track changes:
  http://drupal.org/project/issues/line

## REQUIREMENTS

* line-bot-sdk-php
  https://github.com/line/line-bot-sdk-php

## INSTALLATION

1. Execute 'composer update' from the site's root directory (this will download
   the line-bot-sdk-php sdk).

2. Install the module as usual, see http://drupal.org/node/70151 for further
   information.

## CONFIGURATION

* Configure user permissions at Administer >> User management >> Access
  control >> line module.

  Only users with the "administer line settings" permission are allowed to
  access the module configuration page.

* Enable the line-bot-sdk-php SDK at Administer >> Site
  configuration >> LINE.

## ROADMAP
1. Create Message API config entities, and allow the website can integrate 
   with multiple LINE ChatBot.
2. Generate webhookl url for each message api config entities.
3. Provide response message function for each message api config entity.
4. Provide Multiple Message format.


## CREDITS

Maintainers:
* Eleo Basili (eleonel) - https://drupal.org/u/eleonel
* Victor Yang (cobenash) - https://www.drupal.org/u/cobenash

## SPONSORED
* Spinetta (http://spinetta.tech).
* HelloSanta (https://www.hellosanta.com.tw/).
