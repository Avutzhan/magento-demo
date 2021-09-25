#Magento Course

###Geekhub flow
* 15 students
* weekly hometasks
* 3 failures
* slack for coding disscussions
* github account
* code review pull requests

###Environment
* Windows best for games but Ubuntu best for coding
* Best browser is Chrome [triks](https://www.thegeekstuff.com/2012/04/chrome-browser-tips/)
* Best ide for magento is phpstorm
* magento 2.2.x requirements

###Install Magento2
1. By composer i'am used it
2. download zip file
3. git clone

change permissions
[perms](https://devdocs.magento.com/guides/v2.2/config-guide/prod/prod_file-sys-perms.html)

####my tasks:

1. install and set up virtual box [tutorial](https://tecadmin.net/install-virtualbox-on-ubuntu-18-04/) **installed and set up was done** <br>
ошибка с установкой [удаляем vm полностью](https://askubuntu.com/questions/703746/how-to-completely-remove-virtualbox) <br>
ошибка virtualbox была в том что kernel не имел валидных headers так как я по тупости в прошлый раз обновился  <br>
до какогото паленого кернеля и не обновил хедеры а я бы и не смог так как на такой кернел не было хедеров <br>
пришлось просто откатиться на старый кернель. Чтобы откатиться нужно было вызвать GRUB меню во время загрузки и там уже
выбирать кернель <br>

2. install change graphic card driver **done** ``` поиск => программы и обновления => доп драйверы ```

3. fix reboot and switch off ubuntu 18 **done** 
```shell
sudo nano /etc/default/grub
GRUB_CMDLINE_LINUX_DEFAULT="quiet splash acpi=force"
sudo update-grub2
```
my grub
```shell
 If you change this file, run 'update-grub' afterwards to update
# /boot/grub/grub.cfg.
# For full documentation of the options in this file, see:
#   info -f grub -n 'Simple configuration'

#GRUB_DEFAULT=0
GRUB_DEFAULT=saved
GRUB_SAVEDEFAULT=true
GRUB_TIMEOUT_STYLE=hidden
GRUB_TIMEOUT=0
GRUB_DISTRIBUTOR=`lsb_release -i -s 2> /dev/null || echo Debian`
GRUB_CMDLINE_LINUX_DEFAULT="quiet splash acpi=force"
GRUB_CMDLINE_LINUX=""

# Uncomment to enable BadRAM filtering, modify to suit your needs
# This works with Linux (no patch required) and with any kernel that obtains
# the memory map information from GRUB (GNU Mach, kernel of FreeBSD ...)
#GRUB_BADRAM="0x01234567,0xfefefefe,0x89abcdef,0xefefefef"

# Uncomment to disable graphical terminal (grub-pc only)
#GRUB_TERMINAL=console

# The resolution used on graphical terminal
# note that you can use only modes which your graphic card supports via VBE
# you can see them in real GRUB with the command `vbeinfo'
#GRUB_GFXMODE=640x480

# Uncomment if you don't want GRUB to pass "root=UUID=xxx" parameter to Linux
#GRUB_DISABLE_LINUX_UUID=true

# Uncomment to disable generation of recovery mode menu entries
#GRUB_DISABLE_RECOVERY="true"

# Uncomment to get a beep at grub start
#GRUB_INIT_TUNE="480 440 1"

```
[grub fix](https://askubuntu.com/questions/87409/i-cant-get-grub-menu-to-show-up-during-boot)  
[advanced options](https://askubuntu.com/questions/1014634/how-to-access-advanced-options-in-grub)
[change default kernel](https://unix.stackexchange.com/questions/198003/set-default-kernel-in-grub)
5. create vm with ubuntu 18 **done** <br> 
[tutorial](https://www.toptechskills.com/linux-tutorials-courses/how-to-install-ubuntu-1804-bionic-virtualbox/) 
6. set up ubuntu 18 

```shell
# create directories and change permissions and ownerships
sudo mkdir -p /misc/apps /misc/db /misc/share/ssl
sudo chmod 777 -R /misc/
sudo chown ${USER}:${USER} -R /misc

# add repository with various php versions
sudo add-apt-repository ppa:ondrej/php -y

# install google chrome repository
wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | sudo apt-key add -
sudo sh -c 'echo "deb http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google-chrome.list'
sudo apt-get update
sudo apt-get upgrade -y
sudo apt-get install net-tools -y 

# other google chrome install
#wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb
#sudo dpkg -i google-chrome-stable_current_amd64.deb

# install sublime tex
sudo snap install sublime-text --classic

# install vim
sudo apt-get install vim -y

# install git ang git gui
sudo apt-get install git git-gui -y

# install curl
echo apt-get install curl -y

# install mysql analogs mariadb, percona

echo 'mysql-server mysql-server/root_password password root' | sudo debconf-set-selections
echo 'mysql-server mysql-server/root_password_again password root' | sudo debconf-set-selections
sudo apt-get install mysql-client mysql-server -y

# install apache2 web server and set up permissions
sudo apt0get install apache2 -y
sudo sed -i "s/export APACHE_RUN_USER=www-data/export APACHE_RUN_USER=$USER/g" /etc/apache2/envvars
sudo sed -i "s/export APACHE_RUN_GROUP=www-data/export APACHE_RUN_GROUP=$USER/g" /etc/apache2/envvars
echo "ServerName localhost" | sudo tee -a /etc/apache2/apache2.conf > /dev/null
sudo a2enmod rewrite proxy proxy_http ssl headers deflate
sudo service apache2 restart

# install PHP 7.1 and modules, enable modules
sudo apt-get install php7.1 libapache2-mod-php7.1 -y
sudo apt-get install php7.1-bz2 php7.1-bcmath php7.1-common php7.1-curl php7.1-gd php7.1-imap
php7.1-intl php7.1-mbstring php7.1-mcrypt php7.1-mysql php7.1-recode php7.1-soap php7.1-xml php7.1-xmlrpc 
php7.1-zip -y

# Install PHP common packages
sudo apt-get install php-pear php-imagick php-memcached php-ssh2 php-xdebug composer -y
sudo service apache2 restart

# во время обновления системы все настройки сервера ini затераются чтобы это предотвратить пишем 
# свой конфиг который каждый раз исполняется в конце других конфигов сервера 
# и он постоянно создает нам тот конфиг кторый нам нужен
IniDirs=/etc/php/*/*/conf.d/
for IniDir in ${IniDirs};
do
  echo "Creating ${IniDir}/999-custom-config.ini"
echo "error_reporting = E_ALL & ~E_DEPRECATED
display_errors = On 
display_startup_errors = On
ignore_repeated_errors = On 
cgi.fix_pathinfo=1 
max_execution_time = 3600
memory_limit = 1G 
session.gc_maxlifetime = 84600

xdebug.remote_enable=1 
xdebug.remote_handler=dbgp
xdebug.remote_mode=req
xdebug.remote_host=127.0.0.1
xdebug.remote_port=9000
xdebug.max_nesting_level=256
" | sudo tee -a ${IniDir}999-custom-config.ini > /dev/null
done

# Disabling php modules: opcache
sudo phpdismod opcache

# Enabling php modules: mbstring mcrypt
sudo phpenmod mbstring mcrypt xdebug
# if returns error or warnings check this steps 
# install PHP 7.1 and modules, enable modules
# Install PHP common packages
sudo service apache2 restart

# XDEBUG_CONFIG is important for CLI debugging
echo "
export XDEBUG_CONFIG=\"idekey=PHPSTORM\"
" | sudo tee -a /etc/bash.bashrc > /dev/null

# install phpmyadmin
echo 'phpmyadmin phpmyadmin/dbconfig-install boolean true' | sudo debconf-set-selections
echo 'phpmyadmin phpmyadmin/app-password-confirm password root' | sudo debconf-set-selections
echo 'phpmyadmin phpmyadmin/mysql/admin-pass password root' | sudo debconf-set-selections
echo 'phpmyadmin phpmyadmin/mysql/app-pass password root' | sudo debconf-set-selections
echo 'phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2' | sudo debconf-set-selections
sudo apt-get install phpmyadmin -y
sudo ln -s /usr/share/phpmyadmin /var/www/html/phpmyadmin
echo "\$cfg['LoginCookieValidity'] = 84600;" | sudo tee -a /etc/phpmyadmin/config.inc.php > /dev/null
sudo service apache2 restart

# install Node Package Manager and grunt tasker
curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash 
sudo apt-get install nodejs -y 
sudo npm install -g grunt-cli

# install google chrome
sudo apt-get install google-chrome-stable -y 

# install ClipIt clipboard manager
sudo apt-get install clipit -y

# install slack messenger
sudo snap install slack --classic

# install phpstorm eap 
sudo snap install phpstorm --classic --edge

# fix max file watches for phpstorm to be able to work with projects containing huge amount of 
echo "fs.inotify.max_user_watches = 524288" | sudo tee -a /etc/sysctl.conf > /dev/null
 
```

7. set up magento in ubuntu with best practices
8. ssl sertificate and apache configs

```shell
DOMAIN="$1"
if [ -z "$DOMAIN" ]; then
  echo "Usage: $(basename $0) <domain>"
  exit 11
fi

fail_if_error() {
  [ $1 != 0 ] && {
    unset PASSPHRASE
    exit 10
  }
}

# Generate a passphrase
export PASSPHRASE=$(head -c 500 /dev/urandom | tr -dc a-z0-9A-Z | head -c 128; echo)

# Certificate details; replace items in angle brackets with your own info
subj="
C=US
ST=OR
O=Blah
localityName=Portland
commonName=$DOMAIN
organizationalUnitName=Blah Blah
emailAddress=admin@example.com
"

# Generate the server private key
openssl genrsa -des3 -out $DOMAIN.key -passout env:PASSPHRASE 2048
fail_if_error $?

# Generate the CSR
openssl req \
    -new \
    -batch \
    -subj "$(echo -n "$subj" | tr "\n" "/")" \
    -key $DOMAIN.key \
    -out $DOMAIN.csr \
    -passin env:PASSPHRASE
fail_if_error $?
cp $DOMAIN.key $DOMAIN.key.org
fail_if_error $?

# Strip the password so we don't have to type it every time we restart Apache
openssl rsa -in $DOMAIN.key.org -out $DOMAIN.key -passin env:PASSPHRASE
fail_if_error $?

# Generate the cert (good for 10 years)
openssl x509 -req -days 3650 -in $DOMAIN.csr -signkey $DOMAIN.key -out $DOMAIN.crt
fail_if_error $?
```

https://www.youtube.com/watch?v=EClSvEazoX8&list=PLHUtYy2KmWG1VC4vm8q3c_4U5X2CvOz5t

https://www.google.com/search?q=bash+script+for+ubuntu+self-signed+certificate+ubuntu&sxsrf=AOaemvI-ViP16A5TPQIRXaVq4GDZkeMG7A%3A1632486309777&ei=pcNNYbbvLsnKrgSGm5GQBg&oq=bash+script+for+ubuntu+self-signed+certificate+ubuntu&gs_lcp=Cgdnd3Mtd2l6EAM6BwgAEEcQsAM6BwgjELACECc6BggAEA0QHjoICAAQDRAFEB5KBAhBGABQq98JWO2DCmCNiApoAnACeACAAe8BiAHFIpIBBjAuMTcuNpgBAKABAcgBCMABAQ&sclient=gws-wiz&ved=0ahUKEwj21eC0zZfzAhVJpYsKHYZNBGIQ4dUDCA4&uact=5

https://gist.github.com/adamrunner/285746ca0f22b0f2e10192427e0b703c


```shell
<VirtualHost *:80>
  ServerName magento-226.local
  ServerAlias www.magento-226.local
  DocumentRoot /misc/apps/magento-226/
  ServerAdmin dautov92@list.ru
  UseCanonicalName Off
  ErrorLog /misc/apps/magento-226/var/log/error_http.log
  <Directory /misc/apps/magento-226/>
    AllowOverride All
    Require all granted
  </Directory>
</VirtualHost>

<VirtuakHost *:443>
  ServerName magento-226.local
  ServerAlias www.magento-226.local
  DocumentRoot /misc/apps/magento-226/
  ServerAdmin dautov92@list.ru
  UseCanonicalName off
  ErrorLog /misc/apps/magento-226/var/log/error_http.log
  <Directory /misc/apps/magento-226/>
    AllowOverride All
    Require all granted
  </Directory>
  <IfModule ssl_module>
    SSLEngine on
    SSLCertificateFile /misc/share/ssl/magento-226.local/magento-226.local.crt
    SSLCertificateKeyFile /misc/share/ssl/magento-226.local/magento-226.local.key
    SetEnvIf User-Agent ".*MSIE.*" nokeepalive ssl-unclean-shutdown
  </IfModule>
</VirtuakHost>
```

```
mysql> grant all on magento_226.* to 'magento_226'@'localhost' identified by 'magento_226';
Query OK, 0 rows affected, 1 warning (0,02 sec)
```
