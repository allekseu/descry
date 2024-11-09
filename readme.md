<p>
    <picture>
        <img src=https://img.shields.io/badge/PHP-8.3-%237A86B8?logo=php&logoColor=FFF />
    </picture>
    <picture>
        <img src=https://img.shields.io/badge/Laravel-11-%23FF2D20?logo=laravel&logoColor=FFF />
    </picture>
</p>

> [!NOTE]
> This package is currently a <ins>__work in progress__</ins>.

# __DESCRY__

> [!CAUTION]
> This package is entirely based upon Korean TV and radio stations unprotected and undocumented APIs, used to power their <ins>__public, free-to-air__</ins>, live VOD services. As such, it <ins>__may become broken or obsolete at any moment__</ins>, should said stations make changes to them.

## __DESCRIPTION__

__Descry__ is a package wrapper of free-to-air Korean television and radio stations APIs for the Laravel framework.

Broadcasters like <a href="https://www.kbs.co.kr/" target="_blank">KBS</a>, <a href="https://www.ebs.co.kr/" target="_blank">EBS</a>, <a href="https://www.imbc.com/" target="_blank">MBC</a> or <a href="https://www.ktv.go.kr/" target="_blank">KTV</a> expose their APIs and streams to clients without protection beyond SSL verifications. Descry serves as an intermediary layer between these APIs and the Laravel framework by calling, sanitizing and formatting the unorganized, unstandardized and sometimes cryptic JSON responses.

## __REQUIREMENTS__
- PHP 8.3 is required as Descry makes use of <a href="https://www.php.net/releases/8.3/en.php#typed_class_constants" target="_blank">typed class constants</a>.
- Descry is thought for the Laravel framework. However, the package is self-contained and should work with pretty much anything else as it requires the illuminate/support and illuminate/http dependencies.

## __USAGE__

The package provides a set of facades, resources and parameters DTOs to directly interface with it in your controllers. The end output should be a json response.

```php
use Descry\Facades\KBS;
use Descry\KBS\Parameters;
use Descry\KBS\Resources\StreamResource;

return StreamResource::make(
    KBS::getStream(
        Parameters::hydrate($request->toArray())
    )
)->response();
```

## __LIMITATIONS__
- If a Descry formatted response returns null (or an empty array where applicable) for a value, it either means that:
    - The information does not exist. There's nothing to do.
    - The API changed. Please report it as an issue.
- Response times, beyond necessary treatment by the wrapper, are entirely dependent on stations servers.
