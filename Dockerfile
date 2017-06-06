############################################################
# Dockerfile to build Redcap
# Based on Ubuntu
############################################################

FROM shajid99/docker_redcap_fresh

# Manually set up the apache environment variables
RUN mkdir -p /var/lock/apache2 /var/run/apache2 /etc/supervisor/conf.d/
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

# Expose apache.
#EXPOSE 80

# Make a directory
RUN mkdir -p /var/www/site

# Copy this repo into place.
ADD index.php /var/www/site

# Copy this repo into place.
ADD info.php /var/www/site

# Copy this repo into place.
ADD index.php /var/www/html

# ----------------------------------------------------------------
# TEST
# -----------------------------------------------------------------

ADD redcap /var/www/site/redcap-test
ADD database-test.php /var/www/site/redcap-test/database.php
ADD testemail.php /var/www/site/redcap-test/testemail.php

# Add Redcap cronjob
RUN echo "* * * * * /usr/bin/php /var/www/site/redcap-test/cron.php >> /var/log/cron-test.log 2>&1" | crontab -

# Add test images
ADD redcap-logo-large.png /var/www/site/redcap-test/redcap_v7.1.2/Resources/images/redcap-logo-large.png
ADD redcap-logo-medium.png /var/www/site/redcap-test/redcap_v7.1.2/Resources/images/redcap-logo-medium.png
ADD redcap-logo.png /var/www/site/redcap-test/redcap_v7.1.2/Resources/images/redcap-logo.png
ADD redcap-logo-small.png /var/www/site/redcap-test/redcap_v7.1.2/Resources/images/redcap-logo-small.png

# Add optimised for chrome image
ADD chrome.png /var/www/site/redcap-test/redcap_v7.1.2/Resources/images/
RUN sed -i.bkp '/print "<\/form>";/a print "<img src='\''/redcap-test/redcap_v7.1.2/Resources/images/chrome.png'\''>";' /var/www/site/redcap-test/redcap_v7.1.2/Config/init_functions.php

# ----------------------------------------------------------------
# LIVe
# -----------------------------------------------------------------

ADD redcap /var/www/site/redcap
ADD database.php /var/www/site/redcap/database.php
ADD testemail.php /var/www/site/redcap/testemail.php

# Add Redcap cronjob
RUN echo "* * * * * /usr/bin/php /var/www/site/redcap/cron.php >> /var/log/cron.log 2>&1" | crontab - 

# Add optimised for chrome image
ADD chrome.png /var/www/site/redcap/redcap_v7.1.2/Resources/images/
RUN sed -i.bkp '/print "<\/form>";/a print "<img src='\''/redcap/redcap_v7.1.2/Resources/images/chrome.png'\''>";' /var/www/site/redcap/redcap_v7.1.2/Config/init_functions.php













RUN echo "* * * * * /usr/bin/php /var/www/site/redcap-test/cron.php >> /var/log/cron-test.log 2>&1 \n * * * * * /usr/bin/php /var/www/site/redcap/cron.php >> /var/log/cron.log 2>&1" | crontab -

# house keeping
RUN chmod 777 -R /var/www/site/redcap-test/temp
RUN chmod 777 -R /var/www/site/redcap/temp
RUN chmod 777 -R /var/www/site/redcap-test/edocs/
RUN chmod 777 -R /var/www/site/redcap/edocs/

# php changes
RUN sed -i.bak 's/upload_max_filesize = 2M/upload_max_filesize = 32M/g' /etc/php/7.0/apache2/php.ini
RUN sed -i.bak 's/post_max_size = 8M/post_max_size = 32M/g' /etc/php/7.0/apache2/php.ini
RUN sed -i.bak 's/; max_input_vars = 1000/max_input_vars = 10000/g' /etc/php/7.0/apache2/php.ini
RUN sed -i.bak 's/SMTP = localhost/SMTP = 192.168.164.85/g' /etc/php/7.0/apache2/php.ini
RUN sed -i.bak 's/;sendmail_path =/sendmail_path = \x27\/usr\/sbin\/sendmail -t -i -freply@derbyhospitals.nhs.uk -Freply\x27/g' /etc/php/7.0/apache2/php.ini
RUN sed -i.bak 's/;mail.log = syslog/mail.log = syslog/g' /etc/php/7.0/apache2/php.ini

RUN sed -i.bak 's/mailhub=mail/mailhub=192.168.164.85:25\\\nUseSTARTTLS=YES\nFromLineOverride=YES/g' /etc/ssmtp/ssmtp.conf
RUN sed -i.bak 's/hostname=e7eddde82bec/hostname=redcap/g' /etc/ssmtp/ssmtp.conf
RUN sed -i.bak 's/# sSMTP aliases/root:me@192.168.164.85:25/g' /etc/ssmtp/revaliases

# supervisord config file
COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Update the default apache site with the config we created.
ADD apache-config.conf /etc/apache2/sites-enabled/000-default.conf

# Setup supervisord
CMD /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
