# composer-environment-variables

Pre-configures any environment variable to be used through-out the composer command execution. Can
include environment variable values that are meant for composer itself or could be used to set env
flag for any other plugin that happens to execute.

## Configuration: overview

Environment variables can be defined as key value pairs in the project's composer.json

```json
{
  "extra": {
    "environment-variables": {}
  }
}
```

These values will be declared for system-wide use. The main idea of the module is to provide
a way to pre-configure any flags for any of the composer plugins in case the flag setting
has not been properly exposed to the end-user.
  
## Configuring variable

This example is based on forcing composer to always MIRROR local repositories to the vendor folder:

```json
{
  "extra": {
    "environment-variables": {
      "*": {
        "COMPOSER_MIRROR_PATH_REPOS": "1"
      } 
    }
  }
}
```

Which is equivalent to starting composer with

```shell
COMPOSER_MIRROR_PATH_REPOS=1 composer install
```
  
## Changelog 

_Changelog included in the composer.json of the package_
