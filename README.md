# Joomla Sitemap Component
## Instalacja
Instalujemy za pomocą [Joomla Startup](https://github.com/mikoweb/Joomla-Startup).
W pliku update.custom.json dodaj:

```json
"require": {
    ...
    "mikoweb/joomla-sitemap-component": "dev-master"
}
```

Wykonaj polecenie:

`php joomla.php packages:update`

W pliku `config/components.yml`:

```yaml
components:
  com_rapidsitemap:
    enabled: true
```

W pliku `config/routing.yml`

```yaml
com_rapidsitemap:
    resource: "components/com_rapidsitemap/routing.yml"
    prefix: /
```

Tworzenie tabel w bazie danych:

`bin/doctrine orm:schema-tool:update --force --dump-sql`

## Tworzenie nowej pozycji menu

![step 1](https://raw.github.com/mikoweb/joomla-sitemap-component/master/attachment/01.png)
![step 1](https://raw.github.com/mikoweb/joomla-sitemap-component/master/attachment/02.png)
![step 1](https://raw.github.com/mikoweb/joomla-sitemap-component/master/attachment/03.png)
