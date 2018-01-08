# Installation
```bash
composer require iankov/asset-v
```

Publish config file
```bash
php artisan vendor:publish --tag=assetv_config
```

## Usage
Run console command to find file modifications and update file version number.
Every time file changes it will get a version number incremented by 1
```bash
php artisan assetv:update
```

Use it just as regular `asset()` function in your laravel application
```html
<script src="{{ asset_v('/js/app.js') }}"></script>
```

It will make a url with version tail like this
```html
<script src="http://example.com/js/app.js?v2"></script>
```