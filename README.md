XP Build
========
The XP Build system is based on GitHub commit hooks and therefore exists as an API.

Testing
-------
First, fire up our local webserver

```sh
$ xpws
[xpws-dev#4180] running @ localhost:8080. Press <Enter> to exit
```

Then open another shell and:

```sh
$ curl -X POST -d @commit-payload.data -H 'Content-Type: application/x-www-form-urlencoded' http://localhost:8080/releases

$ curl -X POST -d @tag-payload.data -H 'Content-Type: application/x-www-form-urlencoded' http://localhost:8080/releases
```

See also
--------
* http://requestb.in - for testing HTTP requests
* https://help.github.com/articles/post-receive-hooks - hooks payload