#!/bin/bash

# Let's make sure that yum-presto is installed:
sudo apt-get install -y software-properties-common python-software-properties

sudo add-apt-repository -y ppa:ondrej/mysql-5.6

sudo apt-get -y update


# Let's install our LAMP stack by starting with Apache:
sudo apt-get install -y apache2
sudo systemctl start apache2

sudo echo "Apache2 installed <br/>" > /var/www/html/index.html

sudo debconf-set-selections <<< 'mysql-server-5.6 mysql-server/root_password password N>PQ\V,gRqU/#g?5GN{3'
sudo debconf-set-selections <<< 'mysql-server-5.6 mysql-server/root_password_again password N>PQ\V,gRqU/#g?5GN{3'
sudo apt -y install mysql-server-5.6 mysql-client-5.6



sudo echo "Mysql installed  <br/>" >> /var/www/html/index.html

#set MySql Password
sudo echo "Mysql root password set to Asdf1234$  <br/>" >> /var/www/html/index.html

sudo systemctl start mysql
sudo echo "Mysql Started <br/>" >> /var/www/html/index.html

# Install PHP 5.6
sudo echo "Instaling PHP7.0 <br/>" >> /var/www/html/index.html
sudo apt-get install -y php php-pear libapache2-mod-php php-common php-mbstring php-mysql php-curl php-gd php-intl php-pear php-imagick php-imap php-mcrypt php-memcache php-pspell php-recode php-snmp php-tidy php-xmlrpc php-xsl php-json php-iconv php-soap php-zip

sudo echo "PHP 5.6 Installed <br/>" >> /var/www/html/index.html

sudo echo "Instaling PHP-7.0 Fast-CGI <br/>" >> /var/www/html/index.html
sudo apt-get install -y php-fpm

sudo echo "PHP7.0 Fast-CGI Installed <br/>" >> /var/www/html/index.html

sudo echo "Creating New Vhost config file /etc/apache2/sites-available/default.conf<br/>" >> /var/www/html/index.html

sudo touch /etc/apache2/sites-available/default.conf
sudo echo "<VirtualHost *:80>" >> /etc/apache2/sites-available/default.conf
sudo echo "        ServerAdmin webmaster@localhost" >> /etc/apache2/sites-available/default.conf
sudo echo "        DocumentRoot /var/www/html" >> /etc/apache2/sites-available/default.conf
sudo echo "        ErrorLog ${APACHE_LOG_DIR}/error.log" >> /etc/apache2/sites-available/default.conf

sudo echo "        <Directory /var/www/html>" >> /etc/apache2/sites-available/default.conf
sudo echo "                Options Indexes FollowSymLinks MultiViews" >> /etc/apache2/sites-available/default.conf
sudo echo "                AllowOverride All" >> /etc/apache2/sites-available/default.conf
sudo echo "                Order allow,deny" >> /etc/apache2/sites-available/default.conf
sudo echo "                allow from all" >> /etc/apache2/sites-available/default.conf
sudo echo "        </Directory>" >> /etc/apache2/sites-available/default.conf

sudo echo "        <FilesMatch '\.php$'>" >> /etc/apache2/sites-available/default.conf
sudo echo "           SetHandler 'proxy:fcgi://127.0.0.1:9000/'" >> /etc/apache2/sites-available/default.conf
sudo echo "        </FilesMatch>" >> /etc/apache2/sites-available/default.conf
sudo echo "</VirtualHost>" >> /etc/apache2/sites-available/default.conf

sudo echo "Vhost config file Done<br/>" >> /var/www/html/index.html

sudo a2dissite 000-default
sudo a2ensite default

sudo echo "New  Vhost config activated<br/>" >> /var/www/html/index.html
systemctl restart php7.0-fpm apache2


sudo echo "Saved Settings for  PHP-7.0 Fast-CGI in '/etc/apache2/conf-available/php7.0-fpm.conf' <br/>" >> /var/www/html/index.html

sudo sed -i 's$listen = /run/php/php7.0-fpm.sock$listen = 127.0.0.1:9000$g' /etc/php/7.0/fpm/pool.d/www.conf


sudo echo "Saved Settings for  PHP-7.0 Fast-CGI in '/etc/php/7.0/fpm/pool.d/www.conf' <br/>" >> /var/www/html/index.html
sudo a2enmod proxy_fcgi 
sudo echo "proxy_fcgi Enabled <br/>" >> /var/www/html/index.html

systemctl restart php7.0-fpm apache2

sudo echo "<?php phpinfo();?>" > /var/www/html/info.php
sudo echo "info.php file created <br/>" >> /var/www/html/index.html

sudo echo "Installing PhpMyAdmin <br/>" >> /var/www/html/index.html

sudo debconf-set-selections <<< 'phpmyadmin phpmyadmin/dbconfig-install boolean true'
sudo debconf-set-selections <<< 'phpmyadmin phpmyadmin/app-password-confirm password Asdf1234$'
sudo debconf-set-selections <<< 'phpmyadmin phpmyadmin/mysql/admin-pass password Asdf1234$'
sudo debconf-set-selections <<< 'phpmyadmin phpmyadmin/mysql/app-pass password Asdf1234$'
sudo debconf-set-selections <<< 'phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2'
sudo apt-get install -y phpmyadmin


sudo echo "Installed phpmyadmin <br/>" >> /var/www/html/index.html
sudo ln -s /usr/share/phpmyadmin /var/www/html/_myadmin_

sudo echo "PhpMyAdmin link created in document root <br/>" >> /var/www/html/index.html


sudo apt-get install -y vsftpd

sudo echo "Instaling VSFTPD <br/>" >> /var/www/html/index.html

sudo systemctl start vsftpd

sudo echo "Installed VSFTPD and Started<br/>" >> /var/www/html/index.html
sudo echo "Creating user for FTP  <br/>" >> /var/www/html/index.html
sudo echo "-----Usernmae : ftp_admin<br/>" >> /var/www/html/index.html
sudo echo "-----Password : Dilshan@123<br/>" >> /var/www/html/index.html
useradd ftp_admin -d /var/www/html && echo ftp_admin:Dilshan@123 | chpasswd --crypt-method=SHA512

sudo echo "Configuring VSFTPD Server<br/>" >> /var/www/html/index.html
sudo echo 'ftp_admin' > /etc/vsftpd_users
sudo echo 'local_umask=022' >> /etc/vsftpd.conf
sudo echo 'write_enable=YES' >> /etc/vsftpd.conf
sudo echo 'chroot_local_user=YES' >> /etc/vsftpd.conf
sudo echo 'chroot_local_user=YES' >> /etc/vsftpd.conf
sudo echo 'pam_service_name=ftp' >> /etc/vsftpd.conf


sudo echo 'pasv_enable=YES' >> /etc/vsftpd.conf
sudo echo 'pasv_max_port=12000' >> /etc/vsftpd.conf
sudo echo 'pasv_max_port=12100' >> /etc/vsftpd.conf
sudo echo 'port_enable=YES' >> /etc/vsftpd.conf
sudo echo 'listen_port=21' >> /etc/vsftpd.conf
sudo echo 'pasv_addr_resolve=YES' >> /etc/vsftpd.conf
sudo echo 'write_enable=YES' >> /etc/vsftpd.conf

sudo echo 'userlist_deny=NO' >> /etc/vsftpd.conf
sudo echo 'userlist_file=/etc/vsftpd_users' >> /etc/vsftpd.conf
sudo echo 'userlist_enable=YES' >> /etc/vsftpd.conf
sudo echo 'tcp_wrappers=YES' >> /etc/vsftpd.conf
sudo echo 'allow_writeable_chroot=YES' >> /etc/vsftpd.conf
sudo echo "Configured VSFTPD Server<br/>" >> /var/www/html/index.html

sudo systemctl restart vsftpd


sudo echo "VSFTPD Server stated <br/>" >> /var/www/html/index.html

echo ""
echo "Finished with setup!"
echo ""
echo "You can verify that PHP is successfully installed with the following command: php -v"
echo "You should see output like the following:"
echo ""
echo "PHP 5.6.4 (cli) (built: Dec 19 2014 10:17:51)"
echo "Copyright (c) 1997-2014 The PHP Group"
echo "Zend Engine v2.6.0, Copyright (c) 1998-2014 Zend Technologies"
echo ""
echo "If you are using CentOS 7, you can restart Apache with this command:"
echo "sudo systemctl restart httpd"
echo ""
echo "The MySQL account currently has no password, so be sure to set one."
echo "You can find info on securing your MySQL installation here: http://dev.mysql.com/doc/refman/5.6/en/postinstallation.html"
echo ""
echo "Happy development!"
echo ""