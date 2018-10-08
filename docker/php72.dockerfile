FROM centos:7.4.1708

#install remi repository
RUN yum -y install http://rpms.famillecollet.com/enterprise/remi-release-7.rpm && yum clean all

#install php72
RUN yum -y install php72-runtime php72-php-cli php72-php-pear php72-php-pecl-memcached php72-php-pecl-redis php72-php-soap php72-php-pecl-jsonc php72-php-pecl-zip php72-php-xml php72-php-process php72 php72-php-pdo php72-php-pecl-msgpack php72-php-twig php72-php-gd php72-php-fpm php72-php-bcmath php72-php-common php72-php-pecl-igbinary php72-php-mbstring php72-php-mysqlnd php72-php-pecl-xdebug vim iproute tcpdump php72-php-gmp inotify-tools

RUN yum -y install openssl build-essential xorg libssl-dev fontconfig libXrender libXext xorg-x11-fonts-Type1 xorg-x11-fonts-75dpi freetype libpng zlib libjpeg-turbo wget

RUN wget https://downloads.wkhtmltopdf.org/0.12/0.12.5/wkhtmltox-0.12.5-1.centos7.x86_64.rpm

RUN rpm -Uvh wkhtmltox-0.12.5-1.centos7.x86_64.rpm 

RUN rm -f wkhtmltox-0.12.5-1.centos7.x86_64.rpm 

COPY ./15-xdebug.ini /etc/opt/remi/php72/php.d/15-xdebug.ini

RUN set -ex \
    && cd /etc/opt/remi/php72/ \
    && { \
        echo '[global]'; \
        echo 'error_log = /proc/self/fd/2'; \
        echo; \
        echo '[www]'; \
        echo '; if we send this to /proc/self/fd/1, it never appears'; \
        echo 'access.log = /proc/self/fd/2'; \
        echo; \
        echo 'clear_env = no'; \
        echo; \
        echo '; Ensure worker stdout and stderr are sent to the main error log.'; \
        echo 'catch_workers_output = yes'; \
        echo; \
        echo 'env[APPLICATION_ENV] = development'; \
    } | tee php-fpm.d/docker.conf \
     && sed -i "s|;*daemonize\s*=\s*yes|daemonize = no|g" php-fpm.conf \
     && sed -i -e "s|;*listen\s*=\s*127.0.0.1:9000|listen = [::]:9000|g" -e "s|listen.allowed_clients = 127.0.0.1|;listen.eallowed_clients = 127.0.0.1|g" php-fpm.d/www.conf \
     && sed -i -e "s|post_max_size = 8M|post_max_size = 15M|g" -e "s|upload_max_filesize = 2M|upload_max_filesize = 15M|g" php.ini \
     && { \
        echo 'xdebug.profiler_output_dir="/tmp"'; \
        echo; \
        echo 'xdebug.profiler_append="On"'; \
        echo; \
        echo 'xdebug.profiler_enable_trigger="On"'; \
        echo; \
        echo 'xdebug.profiler_output_name="%R-%u.trace"'; \
        echo; \
        echo 'xdebug.trace_options=1'; \
        echo; \
        echo 'xdebug.collect_params=4'; \
        echo; \
        echo 'xdebug.collect_return=1'; \
        echo; \
        echo 'xdebug.collect_vars=0'; \
        echo; \
        echo 'xdebug.profiler_enable=0'; \
    } | tee php.ini

EXPOSE 9000
ENTRYPOINT ["/opt/remi/php72/root/sbin/php-fpm"]
