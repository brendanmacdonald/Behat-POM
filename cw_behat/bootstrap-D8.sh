#!/bin/sh

#  Get Selenium Server.
wget http://selenium-release.storage.googleapis.com/2.48/selenium-server-standalone-2.48.2.jar -O Servers/selenium.jar

#  Install Behat via Composer.
export COMPOSER_HOME = "./"
composer install -d Behat
rm -rf Behat/.htaccess

#   Remove the guzzlehttp/promises and guzzlehttp/psr folders (not required for Drupal 8 testing)
rm -rf Behat/vendor/guzzlehttp/promises
rm -rf Behat/vendor/guzzlehttp/psr7

#  Generate new composer autoload files.
cd Behat
composer dump-autoload
cd ..

#  Create a local behat configuration file.
cat > Behat/behat.local.yml << EOF
default:
  extensions:
    Behat\MinkExtension:
      base_url: http://
    Drupal\DrupalExtension:
      drupal:
        drupal_root: /Applications/MAMP/htdocs/
EOF
