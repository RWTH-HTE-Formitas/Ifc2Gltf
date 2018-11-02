FROM webdevops/php-nginx:latest

RUN wget -O /tmp/ifcconvert.zip https://github.com/IfcOpenShell/IfcOpenShell/releases/download/v0.5.0-preview2/IfcConvert-master-9ad68db-linux64.zip \
    && unzip /tmp/ifcconvert.zip -d /tmp \
    && ln -s /tmp/IfcConvert /usr/local/bin/IfcConvert

# https://github.com/KhronosGroup/COLLADA2GLTF
RUN wget -O /tmp/colladatogltf.zip https://github.com/KhronosGroup/COLLADA2GLTF/releases/download/v2.1.4/COLLADA2GLTF-v2.1.4-linux.zip \
    && unzip /tmp/colladatogltf.zip -d /tmp/colladatogltf \
    && ln -s /tmp/colladatogltf/COLLADA2GLTF-bin /usr/local/bin/COLLADA2GLTF-bin

COPY . /app

RUN composer self-update
RUN composer install --working-dir=/app --prefer-dist --no-progress --no-interaction

ENV WEB_DOCUMENT_ROOT=/app/public \
    WEB_DOCUMENT_INDEX=index.php
