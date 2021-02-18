# auto-shop

###Assets init
```bash
#Install dependencies
yarn

#For dev
yarn watch 

#For prod
yarn build
```


###Generate fixtures

```bash
symfony console hautelook:fixtures:load --purge-with-truncate -n
```

###CK Editor init

```bash
 php bin/console ckeditor:install
 php bin/console assets:install public
```
