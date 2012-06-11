#!/bin/bash
#cp files from testing env to git

#replace string
replace "http://helloworld123.elasticbeanstalk.com/" "http://helloworld123.elasticbeanstalk.com/" -- pages/*
replace "http://helloworld123.elasticbeanstalk.com/" "http://helloworld123.elasticbeanstalk.com/" -- *
#update cloud with git content
git add .
git commit -m "awdwa"
git aws.push
