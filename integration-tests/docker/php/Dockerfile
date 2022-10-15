FROM sykescottages/php:8.1-cli

RUN apt-get -qq update && \
    apt-get -qq install -y \
    php8.1-mysql

RUN apt-get autoremove -y -q && \
    apt-get autoclean -y -q && \
    rm -rf /var/lib/apt/lists/*
