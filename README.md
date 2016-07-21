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
