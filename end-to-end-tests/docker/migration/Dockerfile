FROM sykescottages/base

RUN apt-get update && apt-get install -y mariadb-client

RUN apt-get autoremove -y -q && \
    apt-get autoclean -y -q && \
    rm -rf /var/lib/apt/lists/*

COPY entrypoint.sh /entrypoint.sh

ENTRYPOINT /entrypoint.sh
WORKDIR /sql