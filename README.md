XP Build
========
The XP Build system is based on GitHub commit hooks listening for tag creations.

* * *
To release the XP Framework, see (https://github.com/xp-framework/xp-framework/wiki/Building-a-release)[the XP Framework Wiki].
* * *

Usage
-----
Releasing a release candidate is as easy as:

```sh
$ git tag -a r5.9.0RC3 -m "- Release 5.9.0RC3"
$ git push origin r5.9.0RC3
```

To release a final version, make sure you've edited the `ChangeLog` file before
and have added a release marker as follows:

```
Version 5.9.0, released 2013-03-18
----------------------------------
Git commit: ccfc987dcabfac36dab6d7544a22476d3b556231
```

If the ChangeLog is missing or unparseable, an empty ChangeLog will be used.

Errors
------
If an error occurs, you can undo by deleting and retagging:

```sh
 $ git tag -d r5.9.0RC3
 $ git push origin :refs/tags/r5.9.0RC3
```

Setup
-----
Use `http://webservices.xp-framework.net/hook` as web hook for the repository.

Influencing the build
---------------------
Per default, the build suite expects to find the source folder `src` 
and the `ChangeLog` file in the top level of your repository. If you
need to change this, add a file `xpbuild.json` to your repository
containing the following:

```json
{
  "base"     : "core"
}
```

By default, the files will be called `xp-[REPO]-[VERSION].xar` and
`xp-[REPO]-test-[VERSION].xar`. This can also be changed:

```json
{
  "base"     : "core",
  "naming"   : {
    "main"     : "xp-rt-{VERSION}.xar",
    "test"     : "xp-test-{VERSION}.xar"
  }
}
```

More information
-----------------
* [Internals](https://github.com/xp-framework/build/wiki/Internals)
* [Testing](https://github.com/xp-framework/build/wiki/Testing)
