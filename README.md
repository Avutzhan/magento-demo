#Magento Demo
###Desription

Quick review of Magento 2

###Set Up

1. Magento quick installation video (not good but better than nothing) [link](https://www.youtube.com/watch?v=FF31XC1NNOU&t=891s)
2. Set up server for magento [link](https://magemastery.net/blog/how-to-setup-ubuntu-server-for-magento-2-open-source)
3. Don't forget about permissions
4. Don't forget to create db and change installation configuration variables like db username db password etc
7. My local host http://magento-demo.local/admin_1gusyd/ admin panel
9. Don't forget to create access keys
10. Install from quick start documentation username and pass are access keys
11. Phpstorm can't open magento project can't see root directories and files [link](https://stackoverflow.com/questions/48065971/phpstorm-not-showing-project-files-in-project-view)
12. logs in var/log/system.log

###Magento CLI

5. ```php bin/magento admin:user:unlock``` admin you can unlock admin
6. ```php bin/magento admin:user:create --admin-user dautov --admin-password Dautov123456+ --admin-email dautov92@list.ru --admin-firstname abu --admin-lastname bakar ``` you can create new admin
7. ```sudo bin/magento module:disable Magento_TwoFactorAuth``` disable oauth
8. ```sudo bin/magento c:c``` update like -> 9.
9. ```sudo bin/magento setup:upgrade``` update like composer dump autoload
10. ```sudo bin/magento| grep schema``` поиск команд схема
11. ```sudo bin/magento| grep white``` поиск с white
12. ```sudo bin/magento setup:db-declaration:generate-whitelist --module-name Inchoo_Blog``` result Inchoo\Blog\etc\db_schema_whitelist.json file
13. ```sudo bin/magento setup:upgrade --dry-run=1```
14. ```sudo chmod -R 777 var/ generated/ pub/static/ pub/media/``` rights
15. ```sudo chown avutzhan:avutzhan generated/``` user of folder
16. ```sudo bin/magento setup:di:compile``` recompile di if need

###Errors

1. Error with edit content page. I was not able to edit page. There is classes in magento must be generated in generated folder if they are not generated then returns error. They can't be generated because of right of folder and user.
