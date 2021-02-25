# CDA symfony demo

### Assets init

```bash
#Install dependencies
yarn

#For dev
yarn watch 

#For prod
yarn build
```

### Generate fixtures

```bash
symfony console hautelook:fixtures:load --purge-with-truncate -n
```

### CK Editor init

```bash
 php bin/console ckeditor:install
 php bin/console assets:install public
```

### Fix api platform install error
https://github.com/api-platform/core/issues/4047

Replace

```php
    // if ($value) {
    //     ksort($value);
    // }
                
    if (is_array($value)) {
        ksort($value);
    } elseif ($value instanceof \ArrayObject) {
        $value->ksort();
    }
```

