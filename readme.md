<p>
    <img src=https://img.shields.io/badge/PHP-8.3-%237A86B8?logo=php&logoColor=FFF />
    <img src=https://img.shields.io/badge/Laravel-11-%23FF2D20?logo=laravel&logoColor=FFF />
</p>

> [!NOTE]
> This package is currently a <ins>__work in progress__</ins>.

# __DESCRY__

> [!CAUTION]
> This package is entirely based upon Korean TV and radio stations unprotected and undocumented APIs, used to power their <ins>__public, free-to-air__</ins>, live VOD services. As such, it <ins>__may become broken or obsolete at any moment__</ins>, should said stations make changes to them.

## __DESCRIPTION__

__Descry__ is a package wrapper of free-to-air Korean television and radio stations APIs for the Laravel framework.

Broadcasters like KBS, EBS, MBC or KTV expose their APIs and streams to clients without protection beyond SSL verifications. Descry serves as an intermediary layer between these APIs and the Laravel framework by calling, sanitizing, scrapping (only when necessary) and formatting the unorganized, unstandardized and sometimes cryptic JSON responses.

## __USAGE__

The package provides a set of facades, resources and parameters DTOs to directly interface with it in your controllers.

```php
use Descry\Facades\KBS;
use Descry\KBS\Resources\StreamResource;
use Descry\KBS\Utils\Parameters;

return StreamResource::make(
    KBS::getStream(
        Parameters::hydrate($request->toArray())
    )
)->response();
```

## __LIMITATIONS__
- If a Descry formatted response returns null (or an empty array where applicable) for a value, it either means that:
    - The information does not exist
    - The API changed
- Response times, beyond necessary treatment by the wrapper, are entirely dependent on stations servers.
    - [ :exclamation: May be removed ] Descry makes an additional call on manifest URLs to determine if they are DRM protected. These calls can take a few seconds, and are thus cached for 60 minutes.
