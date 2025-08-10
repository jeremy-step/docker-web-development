ARG USE_SSL="false"

FROM httpd:2.4-alpine AS ssl-false

ARG SERVER_NAME

WORKDIR /var/www/html/

COPY ./.docker/src/httpd/conf/httpd.conf /usr/local/apache2/conf/httpd-custom.conf


FROM ssl-false AS ssl-true

COPY ./.docker/src/httpd/conf/httpd-ssl.conf /usr/local/apache2/conf/httpd-custom-ssl.conf

RUN printf "\n\nInclude conf/httpd-custom-ssl.conf\n\n" >> /usr/local/apache2/conf/httpd-custom.conf && \
    apk add --update openssl && \
    openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /usr/local/apache2/conf/server.key \
    -subj "/C=US/CN=${SERVER_NAME}" \
    -addext "subjectAltName=DNS:*.${SERVER_NAME}" \
    -out /usr/local/apache2/conf/server.crt


FROM ssl-${USE_SSL} AS base

RUN sed -i -e "s#{{SERVER_NAME}}#${SERVER_NAME}#g" /usr/local/apache2/conf/httpd-custom.conf && \
    printf "\n\nInclude conf/httpd-custom.conf\n\n" >> /usr/local/apache2/conf/httpd.conf