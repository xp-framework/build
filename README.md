XP Build
========
The XP Build system is based on GitHub commit hooks and therefore exists as an API.

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

Testing
-------
First, fire up our local webserver

```sh
$ xpws
[xpws-dev#4180] running @ localhost:8080. Press <Enter> to exit
```

Then open another shell and:

```sh
$ curl -X POST -d @commit-payload.data -H 'Content-Type: application/x-www-form-urlencoded' http://localhost:8080/hook

$ curl -X POST -d @tag-payload.data -H 'Content-Type: application/x-www-form-urlencoded' http://localhost:8080/hook
```

Finally, use the subscriber:

```sh
$ xpcli -c etc/dev/ net.xp_framework.build.subscriber.XarRelease
```

See also
--------
* http://requestb.in - for testing HTTP requests
* https://help.github.com/articles/post-receive-hooks - hooks payload