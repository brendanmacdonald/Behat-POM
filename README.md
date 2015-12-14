# Behat-POM

AUTOMATION TESTS
======================

Tool setup
==========
1. Install Behat:
    - ./bootstrap-D7.sh (to test on Drupal 7)
    or
    - ./bootstrap-D8.sh (to test on Drupal 8)
    
2. Modify your local Behat configuration file. 
Inside 'Behat/behat.local.yml', update:
    - the base_url to your local site url
    - the 'drupal_root' value to the path to your local drupal installation.
       

Install chromedriver (optional step):
1. Download chromedriver from http://chromedriver.storage.googleapis.com/index.html?path=2.17/
2. Save it to /usr/local/bin


Test Execution
==============
1. Open a terminal window.
2. Navigate to <LOCAL DRUPAL INSTALL>/cw_test/Behat
3. To execute the tests, select one of the following options based on the format 'sh run-behat.sh <tag> <profile>':
    - ./run-behat.sh regression firefox
    or
    - ./run-behat.sh regression chrome


Test Results
============
The results of all tests will be stored in <LOCAL DRUPAL INSTALL>/cw_test/Results.

