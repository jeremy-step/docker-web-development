FROM httpd:2.4-alpine

WORKDIR /var/www/html/

COPY ./.docker/httpd/conf/httpd.conf /usr/local/apache2/conf/httpd-custom.conf

RUN printf "Include conf/httpd-custom.conf\n" >> /usr/local/apache2/conf/httpd.conf
