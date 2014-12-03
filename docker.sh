#!/bin/bash

docker run -d -p 80:80 -v /home/cberkom/Sites/Sunbelt/twilio-redirect:/var/www/html tutum/apache-php
