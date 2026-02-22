# Block Theme Starter

A minimal WordPress block theme starter built for full site editing. It provides a clean foundation with basic templates, editor styles, and an organized class-based architecture.

## Requirements

- WordPress 6.9+
- PHP 5.7+
- Composer

## Getting Started

Install PHP dependencies:

```bash
composer install
```

## Theme Structure

```
block-theme-starter/
├── assets/
│   ├── css/            # Frontend and editor stylesheets
│   ├── fonts/          # Custom web fonts
│   ├── images/         # Theme images
│   └── js/             # Frontend scripts
├── classes/            # PHP classes (autoloaded via Composer)
├── parts/              # Block template parts (header, footer)
├── templates/          # Block templates (front-page, index, page)
├── functions.php       # Theme bootstrap
├── style.css           # Theme metadata
└── theme.json          # Global styles and settings
```

## Architecture

The theme uses Composer's classmap autoloading to manage PHP classes in the `classes/` directory. Modules are instantiated in `functions.php` and initialized via an `init()` method that registers WordPress hooks.

### Adding a Module

1. Create a new class file in `classes/` (e.g., `class-my-module.php`)
2. Use the `BTS` namespace and include a public `init()` method
3. Add the class to the `$bts_modules` array in `functions.php`
4. Run `composer dump-autoload`

## Code Standards

This theme uses [WordPress Coding Standards](https://github.com/WordPress/WordPress-Coding-Standards) via PHPCS.

```bash
# Lint
composer lint

# Auto-fix
composer format
```

## License

GPL-2.0-or-later
