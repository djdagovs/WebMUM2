![LOGO](https://github.com/beli3ver/WebMUM2/blob/master/img/logoBig.png?raw=true)

WebMUM2
=======

This is a GUI Web Interface to configure a Postfix & Dovecot Mailserver.

This GUI is not only working with one setup. It based on Thomas Leister' Tutorial for the [Debian Stretch Mailserver], but you can use it with any setup.

Only the database Layout is important.

Installation
------------

First of all check your database layout, if it fetch this layout.

Then copy the config example file:

```bash
cp config/config.php.example config/config.php
```

Then change the following parts

```php
    "base_url"  => "http://localhost/webmum",
    "mysql_host"    => "localhost",
    "mysql_user"    => "vmail",
    "mysql_password"    => "vmail",
    "mysql_database"    => "vmail",
    "admin_mail"        => array("mail@example.de","mail2@example.de"),
```

Database Layout
---------------

```sql
CREATE TABLE `domains` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `domain` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY (`domain`)
);
CREATE TABLE `accounts` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `username` varchar(64) NOT NULL,
    `domain` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `quota` int unsigned DEFAULT '0',
    `enabled` boolean DEFAULT '0',
    `sendonly` boolean DEFAULT '0',
    PRIMARY KEY (id),
    UNIQUE KEY (`username`, `domain`),
    FOREIGN KEY (`domain`) REFERENCES `domains` (`domain`)
);
CREATE TABLE `aliases` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `source_username` varchar(64) NOT NULL,
    `source_domain` varchar(255) NOT NULL,
    `destination_username` varchar(64) NOT NULL,
    `destination_domain` varchar(255) NOT NULL,
    `enabled` boolean DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY (`source_username`, `source_domain`, `destination_username`, `destination_domain`),
    FOREIGN KEY (`source_domain`) REFERENCES `domains` (`domain`)
);
CREATE TABLE `tlspolicies` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `domain` varchar(255) NOT NULL,
    `policy` enum('none', 'may', 'encrypt', 'dane', 'dane-only', 'fingerprint', 'verify', 'secure') NOT NULL,
    `params` varchar(255),
    PRIMARY KEY (`id`),
    UNIQUE KEY (`domain`)
);
```

  [Debian Stretch Mailserver]: https://thomas-leister.de/mailserver-debian-stretch/
