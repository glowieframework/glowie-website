# Requirements

[toc]

### Minimum requirements
In order to run Glowie you will need a web server that meets the following requirements:

- PHP version **7.4** or higher with `curl`, `mbstring` and `openssl` extensions
- Apache version **2.4** or higher with `mod_rewrite` enabled
- Composer version **2.0** or higher

If you are planning to work with databases, you will also need:

- MySQL server version **5.7** or higher
- PHP extension `mysqli`

### Testing locally
If you want to test Glowie locally on your machine, we recommend using an Apache local web server like [XAMPP](https://apachefriends.org) or [Laragon](https://laragon.org).

Glowie is also bundled with a local PHP development server in [Firefly CLI](docs/%%version%%/extra/cli), but it **does not** includes a database server. It should not be used in production.