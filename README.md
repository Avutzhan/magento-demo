#Magento Demo
###Desription

Quick review of Magento 2

###Set Up

1. Magento quick installation video (not good but better than nothing) [link](https://www.youtube.com/watch?v=FF31XC1NNOU&t=891s)
2. Set up server for magento [link](https://magemastery.net/blog/how-to-setup-ubuntu-server-for-magento-2-open-source)
3. Don't forget about permissions
4. Don't forget to create db and change installation configuration variables like db username db password etc
5. ```php bin/magento admin:user:unlock``` admin you can unlock admin
6. ```php bin/magento admin:user:create --admin-user dautov --admin-password Dautov123456+ --admin-email dautov92@list.ru --admin-firstname abu --admin-lastname bakar ``` you can create new admin
7. My local host http://magento-demo.local/admin_1gusyd/ admin panel
8. ```sudo bin/magento module:disable Magento_TwoFactorAuth``` disable oauth
9. Don't forget to create access keys
10. Install from quick start documentation username and pass are access keys
11. Phpstorm can't open magento project can't see root directories and files [link](https://stackoverflow.com/questions/48065971/phpstorm-not-showing-project-files-in-project-view)
12. logs in var/log/system.log
