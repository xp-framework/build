XP Build
========
The XP Build system is based on GitHub commit hooks listening for tag creations.

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

* * *

Internals
---------
The system receives a commit hook, which is published to a message queue. 
The payload is as follows:

```json
{ 
  "owner" 	: "thekid",
  "repo"  	: "xp-experiments", 
  "tag"   	: "r5.9.0RC3",
  "version" : "5.9.0RC3",
  "user"  	: "thekid" 
}
```

A subscriber listens to this message queue, downloads the `ChangeLog` and
a zipfile, and creates the release build, copying the generated files into 
a specified target directory.

Testing
-------
Before you start, add a configuration file named `mq.ini` to `etc/dev/`:

```ini
[endpoint]
host=mq.example.com
port=61613
user="user"
pass="password"

[queue]
destination=/queue/xp.build.dev
```

Then, as this is written in XP Language, you need to compile the sources:

```sh
$ xcc -o dist/ -sp src/main/xp/ src/
```

### Testing the Webhook
Fire up our local webserver:

```sh
$ xpws
[xpws-dev#4180] running @ localhost:8080. Press <Enter> to exit
```

Then open another shell and:

```sh
$ curl -X POST -d @commit-payload.data http://localhost:8080/hook
# The webserver logfile will read "Ignoring ..."

$ curl -X POST -d @tag-payload.data http://localhost:8080/hook
# This will actually trigger a build
```

### Directly trigger a build
Use the xpcli utility provided:

```sh
$ xpcli -c etc/dev/ net.xp_framework.build.subscriber.TriggerBuild thekid/xp-framework r5.9.0RC5
```


Finally, use the subscriber:

```sh
$ xpcli -c etc/dev/ net.xp_framework.build.subscriber.XarRelease
```

See also
--------
* http://requestb.in - for testing HTTP requests
* https://help.github.com/articles/post-receive-hooks - hooks payload