Messenger - zadanie testowe
===========================

Konfiguracja apache:

<VirtualHost *:80>
    ServerName messenger.local
    DocumentRoot /Users/marekrode/Documents/workspace/messenger/web/
    DirectoryIndex app.php

    SetEnv SYMFONY_ENV dev

    <Directory /Users/marekrode/Documents/workspace/messenger/web>
        Options Indexes FollowSymLinks Includes execCGI
        AllowOverride All
        Require all granted

        <IfModule mod_rewrite.c>
            Options -MultiViews
            RewriteEngine On
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteRule ^(.*)$ app.php [QSA,L]
        </IfModule>
    </Directory>

    <Directory /Users/marekrode/Documents/workspace/messenger/web/bundles>
        <IfModule mod_rewrite.c>
            RewriteEngine Off
        </IfModule>
    </Directory>

    ErrorLog /Users/marekrode/Documents/workspace/messenger/var/logs/project_error.log
    CustomLog /Users/marekrode/Documents/workspace/messenger/var/logs/project_access.log combined
</VirtualHost>

Może być pomocne wykonanie chmod -R +a na katalogy cache

Instalacja MongoDB
==================

Najpierw http://digitallyyours.in/2015/09/30/setting-up-mongodb-on-mac-osx-and-xampp/
W razie problemów http://apple.stackexchange.com/questions/211640/installation-failure-the-mongodb-driver-for-php-on-el-capitan

Wgranie przykładowych danych
============================

1. php bin/console doctrine:fixtures:load
2. php bin/console doctrine:mongodb:fixtures:load (przedtem trzeba uruchomić mongo cd mongodb/bin/, ./mongod)

Testy
=====

* Behat (vendor/bin/behat --init)
1. java -jar ~/Downloads/selenium-server-standalone-2.45.0.jar
2. vendor/bin/behat

Przydatne
=========

1. git clone https://github.com/mathiasbynens/dotfiles.git && cd dotfiles && source bootstrap.sh
2. https://gielberkers.com/setup-php-codesniffer-phpstorm-osx/
3. https://plugins.jetbrains.com/plugin/7320
4. brew install tig
5. brew install git-flow
6. https://coderwall.com/p/d3uo3w/git-gpg-know-thy-commits (jak się popsuje gdk)
7. https://github.com/dimsav/phpspec-reference