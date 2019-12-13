#!/usr/bin/env python

"""
LAMP StackScript
    
    Author: Ricardo N Feliciano <rfeliciano@linode.com>
    Version: 1.0.0.0
    Requirements:
        - ss://linode/python-library <ssinclude StackScriptID="3">
        - ss://linode/apache <ssinclude StackScriptID="5">
        - ss://linode/mysql <ssinclude StackScriptID="7">
        - ss://linode/php <ssinclude StackScriptID="8">

This StackScript both deploys and provides a library of functions for
creating a LAMP stack. The functions in this StackScript are designed to be 
run across Linode's core distributions:
    - Ubuntu
    - CentOS
    - Debian
    - Fedora

StackScript User-Defined Variables (UDF): 

<UDF name="db_root_password" label="MySQL/MariaDB root password" />
<UDF name="db_name" label="Create Database" default="" example="create this empty database" />
"""

import os
import subprocess
import sys

try: # we'll need to rename included StackScripts before we can import them
    os.rename("/root/ssinclude-3", "/root/pythonlib.py")
    os.rename("/root/ssinclude-5", "/root/apache.py")
    os.rename("/root/ssinclude-7", "/root/mysql.py")
    os.rename("/root/ssinclude-8", "/root/php.py")
except:
    pass

import pythonlib
import apache
import mysql
import php


def main():
    """Install Apache, MySQL/MariaDB, and PHP."""
    # add logging support
    pythonlib.init()
    
    if os.environ['DB_ROOT_PASSWORD'] != "":
        db_root_password = os.environ['DB_ROOT_PASSWORD']
    else:
        db_root_password = False
    
    if os.environ['DB_NAME'] != "":
        db_name = os.environ['DB_NAME']
    else:
        db_name = False

    pythonlib.system_update()
    apache.httpd_install()
    mysql.mysql_install(db_root_password, db_name)
    php.php_install()
    php.php_install_module_common()
    php.php_install_module("mbstring")

    pythonlib.system_package_install("epel-release");

    subprocess.call(["yum", "install", "-y", "phpmyadmin"])
    subprocess.call(["ln", "-s", "/usr/share/phpMyAdmin /var/www/html/_myadmin_"])

    subprocess.call(["yum", "install", "-y", "vsftpd"])
    subprocess.call(["echo", "'anonymous_enable=NO' >> ", "/etc/vsftpd/vsftpd.conf"])
    subprocess.call(["echo", "'local_enable=YES' >> ", "/etc/vsftpd/vsftpd.conf"])
    subprocess.call(["echo", "'chroot_local_user=YES' >> ", "/etc/vsftpd/vsftpd.conf"])

    pythonlib.end()


if __name__ == "__main__":
    sys.exit(main())