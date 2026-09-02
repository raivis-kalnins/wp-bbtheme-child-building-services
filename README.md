# WP BBTheme Child Building Services 3.7.0

Child theme for WP BBTheme. Built to use the shared Gutenberg/WP BBuilder design system and demo importer.

## Included
- Trade Service custom post type with trade and property-work taxonomies
- AJAX service finder with emergency, coverage and rate filters
- Trade Quote custom post type with structured job request form
- Demo plumbing, electrical, handyman and maintenance services
- BBuilder finder and proof patterns

## Requirements
- WordPress 6.6+
- PHP 8.0+
- Parent theme `wp-bbtheme` 3.7.0+
- WP BBuilder

## SCSS structure (3.8.10.9)

Frontend styles are split into `tokens`, `tools`, `base`, `header`, `footer`, `components`, `swiper`, `motion`, `forms`, `blog`, `quality`, `sector`, `responsive` and `features`. Fluid typography uses the suite `fluid-font()` mixin and explicit viewport guards rather than `clamp()`. The generated production CSS intentionally contains no `!important` declarations.

### Build compatibility

The child build is dependency-free and works with Yarn 1.22.x as well as newer Yarn versions. No Corepack step is required. Use:

```sh
yarn prod
```

The command runs `node tools/build.mjs` and rebuilds the hashed CSS/JS manifest directly.
