FROM phpstorm/php-71-apache-xdebug-27


# INSTALL COMPOSER
RUN curl -s https://getcomposer.org/installer | php
RUN alias composer='php composer.phar'