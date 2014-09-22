XP Build
========
The XP Build system is based on Travis-CI deployments. To release an XP Framework module, simply create a tag and push it.

Usage
-----
Releasing a release candidate is as easy as:

```sh
$ git tag -a v6.0.0RC1 -m "6.0.0, Release Candidate 1"
$ git push origin v6.0.0RC1
```

To release a final version, make sure you've edited the `ChangeLog.md` file before
and have added a release marker above the entries as follows:

```markdown
## 6.0.0 / 2014-12-14

* Added ...
* Fixed ...
* Implemented ...
```

Errors
------
If an error occurs, you can undo by deleting and retagging:

```sh
 $ git tag -d v6.0.0RC1
 $ git push origin :refs/tags/v6.0.0RC1
```

Setup
-----
* Add xpbot to your repository
* [Encrypt](http://docs.travis-ci.com/user/encryption-keys/) the OAuth token with your repo
* Add the following lines to your .travis.yml:

```yml
before_deploy:
  - export REL=`echo $TRAVIS_TAG | sed -e 's/^v//g'`
  - export MOD=`echo $TRAVIS_REPO_SLUG | cut -d '/' -f 2`
  - wget https://github.com/xp-framework/build/releases/download/v3.0.0alpha1/travis.xar
  - ./xp -cp travis.xar net.xp_framework.build.Travis . $MOD $REL

deploy:
  provider: releases
  file:
    - xp-$MOD-$REL.xar
    - xp-$MOD-test-$REL.xar
    - glue.json
  skip_cleanup: true
  on:
    repo: $TRAVIS_REPO_SLUG
    tags: true
    all_branches: true
    php: 5.4
  api_key:
    secure: "... encrypted OAuth token here ..."
```