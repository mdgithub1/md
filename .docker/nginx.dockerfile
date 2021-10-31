FROM sdmd/base-nginx-php-fpm8.0-bullseye
LABEL Description="API application build on the top of base nginx-php-base (fpm)" \
      Version="1.0"

ARG APP_PATH
ARG APP_ENV
ARG SERVER_NAME

ENV APP_ENV=${APP_ENV} \
    APP_PATH=${APP_PATH} \
    SERVER_NAME=${SERVER_NAME}

USER root

WORKDIR ${APP_PATH}

# Copy app
COPY --chown=${APP_USER}:${APP_GROUP} . .
RUN chmod -R 775 bootstrap/cache \
    && \
# PHP default configuration
    if [ ${APP_ENV} = "production" ] || [ ${APP_ENV} = "staging" ]; then \
        mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"; \
    else \
        mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"; \
    fi \
    && \
# Nginx
    sed -i "/server_name localhost;/c \    server_name ${SERVER_NAME};" /etc/nginx/sites-available/default && \
    sed -i "/root \/var\/www\/html\/;/c \    root ${APP_PATH}/public;" /etc/nginx/sites-available/default \
    && \
# SSL - N/A
# SSH - N/A \
# Composer install
    if [ ${APP_ENV} = "production" ]; then \
        composer install --ansi --no-interaction --no-scripts --no-dev; \
    else \
        composer install --ansi --no-interaction; \
    fi

# Custom entrypoint to run the app as scheduler or queue worker
COPY ./.docker/docker-entrypoint /usr/local/bin/

ENTRYPOINT ["docker-entrypoint"]
