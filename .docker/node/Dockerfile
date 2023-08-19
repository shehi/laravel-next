FROM cypress/factory
LABEL maintainer="Shahriyar Imanov <shehi@imanov.me>"

WORKDIR /var/www

ENV DEBIAN_FRONTEND noninteractive
ENV TERM xterm

RUN apt-get update -y \
    && apt-get install -y apt-utils \
    && apt-get upgrade -y \
    && mkdir -p /usr/share/man/man1 \
    && apt-get install -y \
        git \
        iproute2 \
        iputils-ping \
        locales \
        locales-all \
        nano \
        procps \
        sudo \
        telnet \
        unzip \
        wget

# Install sentry-cli
RUN curl -sL https://sentry.io/get-cli/ | sh

# Locale
RUN locale-gen en_US.UTF-8 && locale-gen de_DE.UTF-8 && dpkg-reconfigure locales
ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8

# Port for node --inspect
EXPOSE 9229

# Install mkcert
RUN apt-get install -y curl libnss3-tools \
    && curl -JLO "https://dl.filippo.io/mkcert/latest?for=linux/amd64" \
    && chmod +x mkcert-v*-linux-amd64 \
    && sudo cp mkcert-v*-linux-amd64 /usr/local/bin/mkcert \
    && apt-get remove -y curl

# Clean-up
RUN apt-get clean \
    && apt-get autoremove -y \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Adjusting node user further
RUN usermod -aG sudo node
RUN sed -i -e "s/%sudo.*/%sudo ALL=(ALL:ALL) NOPASSWD: ALL/g" /etc/sudoers
COPY profile /etc/profile
COPY profile /etc/bashrc

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
COPY fix-container-uid-gid.sh /usr/local/bin/fix-container-uid-gid.sh

USER node

RUN firefox --screenshot https://guildplanner.pro /dev/null \
    && mkcert -install

ENTRYPOINT ["docker-entrypoint.sh"]

CMD [ "node" ]
