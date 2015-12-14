#!/usr/bin/env bash

##############################################################################
###    ASSIGN SCRIPT VARIABLES
##############################################################################
TAG=$1
PROFILE=$2
SCENARIO_NAME=$3

##############################################################################
###    HELP OPTION
##############################################################################
if [ "$1" == "-h" ]; then
  printf 'To execute all tests on firefox:\nsh run-behat.sh regression firefox\n'
  printf '\nTo execute all tests on chrome:\nsh run-behat.sh regression chrome\n'
  printf '\nTo execute a specific named test:\nsh run-behat.sh regression firefox \"name_of_test\"\n'
  exit 0
fi

##############################################################################
###    SHELL SCRIPT MUST ALWAYS BE PASSED THE TAG AND PROFILE VARIABLES
##############################################################################
if [ -z $PROFILE ] || [ -z $TAG ]
then
   printf 'ERROR: Expected Tag followed by Profile.\nE.g. sh run-behat.sh <tag> <profile>\n'
   exit 0
fi

##############################################################################
###    SYNC BEHAT_FILES PRIOR TO EXECUTION
##############################################################################
rsync ../../Behat_Files/*.yml features/..
rsync ../../Behat_Files/features/*.feature features/
rsync ../../Behat_Files/pages/*.php pages/
rsync ../../Behat_Files/contexts/*.php features/bootstrap
rsync ../../Behat_Files/images/*.* images

##############################################################################
###    BACKUP RESULT FILES
##############################################################################
mv ../Results/Behat/*.html ../Results/Behat/History

##############################################################################
###    TEST EXECUTION
##############################################################################
if [ $PROFILE = "firefox" ] || [ $PROFILE = "chrome"  ]
then
   sh ../Servers/start_selenium_server.sh;
   if [ ! -z "$SCENARIO_NAME" ]
   then
      bin/behat --tags=@$TAG -p $PROFILE --name="$SCENARIO_NAME" -f html -f pretty
   else
      bin/behat --tags=@$TAG -p $PROFILE -f html -f pretty
   fi
fi

if [ $PROFILE = "phantomjs" ]
then
   sh ../Servers/start_phantomjs_webdriver.sh;
   bin/behat --tags=@$TAG -p $PROFILE
fi

##############################################################################
###    TEARDOWN
##############################################################################
# Remove YML config
rm behat.yml

# Remove all files in 'pages'
cd pages
ls * | grep -v .gitkeep | xargs rm -rf
cd ..

# Remove all files in 'images'
cd images
ls * | grep -v .gitkeep | xargs rm -rf
cd ..

# Remove all files in 'features' except Helper.feature
cd features
ls * | grep -v Helper.feature | xargs rm -rf
cd ..

# Remove all files in 'bootstrap' except HelperContext.php
cd features/bootstrap
ls * | grep -v HelperContext.php | xargs rm -rf
cd ../..

#  Stop PhantomJS webdriver.
if [ $PROFILE = "phantomjs" ]
then
   sh ../Servers/stop_phantomjs_webdriver.sh
fi

#  Stop Selenium server.
if [ $PROFILE = "firefox" ] || [ $PROFILE = "chrome"  ]
then
   sh ../Servers/stop_selenium_server.sh
fi