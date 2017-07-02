# Abby\BackpackKnowledgebase

An admin panel for knowledgebase / wiki on Laravel 5, using [Backpack\CRUD](https://github.com/Laravel-Backpack/crud).

## Install

#### Installation type (B) - package

Write this later..

1) In your terminal, run:

``` bash
$ composer require abby/backpack-knowledgebase
```

2) Then add the service providers to your config/app.php file:

```
Abby\Knowledgebase\KnowledgebaseServiceProvider::class,
```

3) Publish the migration:

```
php artisan vendor:publish --provider="Abby\Knowledgebase\KnowledgebaseServiceProvider"
```

4) Run the migration to have the database table we need:

```
php artisan migrate
```

5) [optional] Add a menu item for it in resources/views/vendor/backpack/base/inc/sidebar.blade.php or menu.blade.php:

```html
<!-- Spaces, Articles - Knowledgebase -->
  <li class="treeview">
    <a href="#"><i class="fa fa-book"></i> <span>Knowledgebase</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/knowledgebase/spaces') }}"><i class="fa fa-folder"></i> <span>Spaces</span></a></li>
      <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/knowledgebase/articles') }}"><i class="fa fa-file-text"></i> <span>Articles</span></a></li>
    </ul>
  </li>
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Security

If you discover any security related issues, please email me@abbyjanke.com instead of using the issue tracker.

## Credits

- [Abby Janke][link-author]
- [Cristian Tabacitu][link-tabacitu]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: https://github.com/AbbyJanke
[link-tabacitu]: https://github.com/tabacitu
[link-contributors]: ../../contributors
