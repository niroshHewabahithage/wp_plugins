#!/bin/bash
#
# setup-lamp-stack-on-cent-os-7.sh
#
# Sets up a LAMP stack environment using CentOS 7, PHP 5.6, MySQL 5.6, and Apache.
# Also installs PHPUnit and XDebug.
#
# Copyright (c) 2014-2015 Michael Dichirico (https://github.com/mdichirico)
# This software/script is released under the terms of the MIT license (http://en.wikipedia.org/wiki/MIT_License).
# 
# INSTRUCTIONS FOR USE:
# 1. Copy this shell script to your home directory or the /tmp directory.
# 2. Make it executable with the following command: 
#      chmod a+x setup-lamp-stack-on-cent-os-7.sh
# 3. Execute the script as a sudo user:
#      sudo ./setup-lamp-stack-on-cent-os-7.sh
#
#
# IMPORTANT: as of this writing on 2015-01-11, this shell script will support
# CentOS 6.4, 6.5, and 7. It has not been tested on a release greater than
# v7. That is 7 flat, not 7.1, 7.x.
#
# If you wish to use this script with a version of CentOS greater than v7 such as
# 7.1 or higher when they come out, you have to edit this script to be sure that the IUS and EPEL
# repositories correctly use the repos needed for newer versions of CentOS. The
# same applies to all other areas in this file where there is a check for an exact
# version of CentOS before doing a download and/or installation.
#
# It's important to point out that this script assumes that none of the binaries 
# that are to be installed are already present on the target server. If you already
# have the EPEL repository installed on your target server, you should first remove it
# by following the instructions in this link:
#
# http://www.cyberciti.biz/faq/centos-redhat-fedora-linux-remote-yum-repo-configuration/
#



# Since this script needs to be runnable on either CentOS7 or CentOS6, we need to first 
# check which version of CentOS that we are running and place that into a variable.
# Knowing the version of CentOS is important because some shell commands that had
# worked in CentOS 6 or earlier no longer work under CentOS 7
RELEASE=`cat /etc/redhat-release`
isCentOs7=false
isCentOs65=false
isCentOs64=false
isCentOs6=false
SUBSTR=`echo $RELEASE|cut -c1-22`
SUBSTR2=`echo $RELEASE|cut -c1-26`

if [ "$SUBSTR" == "CentOS Linux release 7" ]
then
    isCentOs7=true
elif [ "$SUBSTR2" == "CentOS release 6.5 (Final)" ]
then 
    isCentOs65=true

elif [ "$SUBSTR2" == "CentOS release 6.4 (Final)" ]
then 
    isCentOs64=true
else
    isCentOs6=true
fi

# TODO: add a check for versions earlier than 6.5

if [ "$isCentOs7" == true ]
then
    echo "I am CentOS 7"
elif [ "$isCentOs65" == true ]
then
    echo "I am CentOS 6.5"
elif [ "$isCentOs64" == true ]
then 
    echo "I am CentOS 6.4"
else
    echo "I am CentOS 6"
fi

CWD=`pwd`

# Let's make sure that yum-presto is installed:
sudo yum install -y yum-presto

# Let's make sure that mlocate (locate command) is installed as it makes much easier when searching in Linux:
sudo yum install -y mlocate

# Although not needed specifically for running a LAMP stack, I like to use vim, so let's make sure it is installed:
sudo yum install -y vim

# This shell script makes use of wget, so let's make sure it is installed:
sudo yum install -y wget

# it is important to sometimes work with content in a certain format, so let's be sure to install the following:
sudo yum install -y html2text

# This script makes use of 'sed' so let's make sure it is installed. While
# we're at it, let's also install 'awk'. It's most likely that these packages
# are already installed, but let's be sure. By the way, yes it is 'gawk' as the 
# pacakge name:
sudo yum install -y sed
sudo yum install -y gawk

# Let's make sure that we have the EPEL and IUS repositories installed.
# This will allow us to use newer binaries than are found in the standard CentOS repositories.
# http://www.rackspace.com/knowledge_center/article/install-epel-and-additional-repositories-on-centos-and-red-hat
sudo yum install -y epel-release
if [ "$isCentOs7" != true ]
then
    # The following is needed to get the epel repository to work correctly. Here is
    # a link with more information: http://stackoverflow.com/questions/26734777/yum-error-cannot-retrieve-metalink-for-repository-epel-please-verify-its-path
    sudo sed -i "s/mirrorlist=https/mirrorlist=http/" /etc/yum.repos.d/epel.repo
fi

if [ "$isCentOs7" == true ]
then
    sudo wget -N http://dl.iuscommunity.org/pub/ius/stable/CentOS/7/x86_64/ius-release-1.0-13.ius.centos7.noarch.rpm
    sudo rpm -Uvh ius-release*.rpm
else
    # Please note that v6.5, 6.4, etc. are all covered by the following repository:
    sudo wget -N http://dl.iuscommunity.org/pub/ius/stable/CentOS/6/x86_64/ius-release-1.0-13.ius.centos6.noarch.rpm
    sudo rpm -Uvh ius-release*.rpm
fi

# Let's make sure that openssl is installed:
sudo yum install -y openssl

# Let's make sure that curl is installed:
sudo yum install -y curl

# Let's make sure we have a C/C++ compiler installed:
sudo yum install -y gcc

# Let's make sure we have the latest version of bash installed, which
# are patched to protect againt the shellshock bug. Here is an article explaning
# how to check if your bash is vulnerable: http://security.stackexchange.com/questions/68168/is-there-a-short-command-to-test-if-my-server-is-secure-against-the-shellshock-b
sudo yum update -y bash

# Let's make sure that firewalld is installed:
sudo yum install -y firewalld
sudo systemctl start firewalld

# Install and set-up NTP daemon:
if [ "$isCentOs7" == true ]; then
    sudo yum install -y ntp
    sudo firewall-cmd --add-service=ntp --permanent
    sudo firewall-cmd --reload

    sudo systemctl start ntpd
fi

# Let's install our LAMP stack by starting with Apache:
sudo yum install -y httpd mod_ssl openssh
if [ "$isCentOs7" == true ]
then
    sudo systemctl start httpd
else
    sudo service httpd start
fi

sudo echo "Apache2 installed <br/>" > /var/www/html/index.html

# Install MySQL:
if [ "$isCentOs7" == true ]
then
    sudo wget -N http://dev.mysql.com/get/mysql-community-release-el7-5.noarch.rpm
    sudo yum localinstall -y mysql-community-release-el7-5.noarch.rpm
    sudo yum install -y mysql-community-server

    sudo systemctl start mysqld
elif [ "$isCentOs65" == true ]
then
    sudo wget -N https://repo.mysql.com/mysql-community-release-el6-5.noarch.rpm
    sudo yum localinstall -y mysql-community-release-el6-5.noarch.rpm
    sudo yum install -y mysql-community-server

    sudo service mysqld start
elif [ "$isCentOs64" == true ]
then
    sudo wget -N https://repo.mysql.com/mysql-community-release-el6-4.noarch.rpm
    sudo yum localinstall -y mysql-community-release-el6-4.noarch.rpm
    sudo yum install -y mysql-community-server

    sudo service mysqld start
else
    sudo wget -N https://repo.mysql.com/mysql-community-release-el6.rpm
    sudo yum localinstall -y mysql-community-release-el6.rpm
    sudo yum install -y mysql-community-server
    sudo service mysqld start
fi

sudo echo "Mysql installed  <br/>" >> /var/www/html/index.html
sudo echo "Mysql Started <br/>" >> /var/www/html/index.html


#set MySql Password

mysqladmin -u root --password="" password "Asdf1234$"

sudo echo "Mysql root password set to Asdf1234$  <br/>" >> /var/www/html/index.html

# We need to edit the my.cnf and make sure that it is using utf8 as the default charset:
MYCNF=`sudo find /etc -name my.cnf -print`
INSERT1='skip-character-set-client-handshake'
INSERT2='collation-server=utf8_unicode_ci'
INSERT3='character-set-server=utf8'
INSERT5="default_time_zone='+00:00'"
# We also want to allow remote connections:
INSERT4='bind-address=127.0.0.1'
sudo sed -i "/\[mysqld\]/a$INSERT1\n$INSERT2\n$INSERT3\n$INSERT4\n$INSERT5" "$MYCNF"
# comment out the statement 'skip-networking' is commented out:
sudo sed -i 's/skip-networking/# skip-networking/' "$MYCNF"

# Make sure that we restart MySQL so the changes take effect 
if [ "$isCentOs7" == true ]
then
    sudo systemctl restart mysqld
else
    sudo service mysqld restart
fi

sudo echo "Mysql Server restarted  <br/>" >> /var/www/html/index.html
# Open port 3306 for remote connections to MySQL:
if [ "$isCentOs7" == true ]
then
    sudo firewall-cmd --zone=public --add-port=3306/tcp --permanent
    sudo firewall-cmd --reload
else
    sudo iptables -A INPUT -p tcp -m tcp --dport 3306 -j ACCEPT
    sudo service iptables save
    sudo service iptables restart
fi
sudo echo "Port 3306 opened for remotr Login  <br/>" >> /var/www/html/index.html

# We need to also make sure that ports 80 and 443 are open for the web:
# Port 80:
if [ "$isCentOs7" == true ]
then
    sudo firewall-cmd --zone=public --add-port=80/tcp --permanent
    sudo firewall-cmd --reload
else
    sudo iptables -A INPUT -p tcp -m tcp --dport 80 -j ACCEPT
    sudo service iptables save
    sudo service iptables restart
fi

# Port 443:
if [ "$isCentOs7" == true ]
then
    sudo firewall-cmd --zone=public --add-port=443/tcp --permanent
    sudo firewall-cmd --reload
else
    sudo iptables -A INPUT -p tcp -m tcp --dport 443 -j ACCEPT
    sudo service iptables save
    sudo service iptables restart
fi

sudo echo "ports 80 and 443 are open for the web <br/>" >> /var/www/html/index.html




# Install PHP 5.6
sudo echo "Instaling PHP 5.6 <br/>" >> /var/www/html/index.html
sudo yum install -y php php-pear libapache2-mod-php php-common php-mbstring php-mysql php-curl php-gd php-intl php-pear php-imagick php-imap php-mcrypt php-memcache php-pspell php-recode php-snmp php-tidy php-xmlrpc php-xsl php-json php-iconv php-soap php-zip --skip-broken

sudo echo "PHP 5.6 Installed <br/>" >> /var/www/html/index.html

sudo echo "Instaling PHP-5.6 Fast-CGI <br/>" >> /var/www/html/index.html
sudo yum install -y php-fpm

sudo echo "PHP5.6 Fast-CGI Installed <br/>" >> /var/www/html/index.html
sudo sed -i 's$SetHandler application/x-httpd-php$SetHandler "proxy:fcgi://127.0.0.1:9000"$g' /etc/httpd/conf.d/php.conf

sudo systemctl start php-fpm 
sudo systemctl enable php-fpm 

# Restart Apache
if [ "$isCentOs7" == true ]
then
    sudo systemctl restart php-fpm httpd 
else
    sudo service php-fpm restart
	sudo service httpd restart
fi

sudo echo "<?php phpinfo();?>" > /var/www/html/info.php
sudo echo "info.php file created <br/>" >> /var/www/html/index.html

# Make sure that when the server boots up that both Apache and MySQL start automatically:
if [ "$isCentOs7" == true ]
then
    sudo systemctl enable httpd
    sudo systemctl enable mysqld
else
    sudo chkconfig httpd on
    sudo chkconfig mysqld on
fi

# Restart PhpMyAdmin

sudo echo "Installing PhpMyAdmin <br/>" >> /var/www/html/index.html
sudo yum install -y epel-release
sudo yum install -y phpmyadmin

sudo echo "Installed PhpMyAdmin <br/>" >> /var/www/html/index.html
sudo ln -s /usr/share/phpMyAdmin /var/www/html/_myadmin_

sudo echo "PhpMyAdmin link created in document root <br/>" >> /var/www/html/index.html


sudo yum install -y vsftpd

sudo echo "Instaling VSFTPD <br/>" >> /var/www/html/index.html

if [ "$isCentOs7" == true ]
then
    sudo firewall-cmd --zone=public --add-port=20-21/tcp --permanent
	sudo firewall-cmd --zone=public --add-port=12000-12100/udp --permanen
    sudo firewall-cmd --reload
else
    sudo iptables -A INPUT -p tcp -m tcp --dport 21 -j ACCEPT
    sudo service iptables save
    sudo service iptables restart
fi

sudo echo "Installed VSFTPD <br/>" >> /var/www/html/index.html
sudo echo "Creating user for FTP  <br/>" >> /var/www/html/index.html
sudo echo "-----Usernmae : ftp_admin<br/>" >> /var/www/html/index.html
sudo echo "-----Password : Dilshan@123<br/>" >> /var/www/html/index.html
sudo useradd ftp_admin -p Dilshan@123 -r -d /var/www/html/
sudo echo Dilshan@123 | passwd ftp_admin --stdin

sudo echo "Configuring VSFTPD Server<br/>" >> /var/www/html/index.html
sudo echo 'ftp_admin' >> /etc/vsftpd/user_list
sudo echo 'anonymous_enable=NO' >> /etc/vsftpd/vsftpd.conf
sudo echo 'ascii_upload_enable=YES' >> /etc/vsftpd/vsftpd.conf
sudo echo 'ascii_download_enable=YES' >> /etc/vsftpd/vsftpd.conf
sudo echo 'local_enable=YES' >> /etc/vsftpd/vsftpd.conf
sudo echo 'chroot_local_user=YES' >> /etc/vsftpd/vsftpd.conf
sudo echo 'pam_service_name=vsftpd' >> /etc/vsftpd/vsftpd.conf

sudo echo 'pasv_enable=YES' >> /etc/vsftpd/vsftpd.conf
sudo echo 'pasv_max_port=12000' >> /etc/vsftpd/vsftpd.conf
sudo echo 'pasv_max_port=12100' >> /etc/vsftpd/vsftpd.conf
sudo echo 'port_enable=YES' >> /etc/vsftpd/vsftpd.conf
sudo echo 'listen_port=21' >> /etc/vsftpd/vsftpd.conf
sudo echo 'pasv_addr_resolve=YES' >> /etc/vsftpd/vsftpd.conf
sudo echo 'write_enable=YES' >> /etc/vsftpd/vsftpd.conf

sudo echo 'userlist_deny=NO' >> /etc/vsftpd/vsftpd.conf
sudo echo 'userlist_file=/etc/vsftpd/user_list' >> /etc/vsftpd/vsftpd.conf
sudo echo 'userlist_enable=YES' >> /etc/vsftpd/vsftpd.conf
sudo echo 'tcp_wrappers=YES' >> /etc/vsftpd/vsftpd.conf
sudo echo "Configured VSFTPD Server<br/>" >> /var/www/html/index.html

# Restart Vsftpd
if [ "$isCentOs7" == true ]
then
    sudo systemctl start vsftpd
else
    sudo service vsftpd start
fi

sudo echo "VSFTPD Server stated <br/>" >> /var/www/html/index.html

sudo yum install -y unzip

cd /var/www/html

sudo wget https://wordpress.org/latest.zip

sudo unzip latest.zip

sudo mv wordpress/* ./

sudo rm latest.zip
sudo rm index.html


PASS=2p859ryjsdlfhldfyo923478ryowe89ryuofh
DBNAME='wp_db_98521'

sudo mysql -uroot -pwg9wz[FjzJbJCVPA -e "create database $DBNAME"
sudo mysql -uroot -pwg9wz[FjzJbJCVPA -e "CREATE USER $DBNAME@localhost IDENTIFIED BY '$PASS'"
sudo mysql -uroot -pwg9wz[FjzJbJCVPA -e "GRANT ALL PRIVILEGES ON $DBNAME.* TO $DBNAME@localhost"
sudo mysql -uroot -pwg9wz[FjzJbJCVPA -e "FLUSH PRIVILEGES;"

sudo cp wp-config-sample.php wp-config.php

sudo sed -i "s/database_name_here/$DBNAME/g" wp-config.php
sudo sed -i "s/username_here/$DBNAME/g" wp-config.php
sudo sed -i "s/password_here/$PASS/g" wp-config.php



sudo echo "define('FS_METHOD','direct');" >> /var/www/html/wp-config.php

perl -i -pe'
  BEGIN {
    @chars = ("a" .. "z", "A" .. "Z", 0 .. 9);
    push @chars, split //, "!@#$%^&*()-_ []{}<>~\`+=,.;:/?|";
    sub salt { join "", map $chars[ rand @chars ], 1 .. 64 }
  }
  s/put your unique phrase here/salt()/ge
' wp-config.php

sudo mkdir wp-content/uploads
sudo chmod 775 wp-content/uploads



