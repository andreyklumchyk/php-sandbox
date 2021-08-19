PHP sandbox
===============

Using PHP create a simple Messenger application.

[Design](https://www.figma.com/****)
| [Prototype](https://www.figma.com/*****)

> This is a [GitHub template][9] repository, so you need to click on `Use this template` button above and do all the development in your own repository which uses this one as template only.




## Required features

1. Register account.
2. Send message to another account by name.
3. List of available chats with other accounts.
4. Messages history with specified account.



## Implementation requirements

1. Code should be documented with [phpdoc] and is able to generate documentation in a form of static website (you may deploy it on [GitHub Pages] as well).   
2. Code should be covered with unit tests.
3. [E2E (end-to-end) tests][2] should cover all the required features.
4. Frontend must work with backend throw [GraphQL]. 
5. Backend templates must use [Twig].  
6. Backend architecture should be [SOLID].  



### Deploying on [Heroku]

1. Create account on [Heroku] (if you don't have one).
2. Copy [Heroku] API key from the [account page][3].
3. Go to [Actions Secrets][4] settings in your GitHub repository.    ????
4. Add the following repository keys:
    - `HEROKU_API_KEY` - API key which you copied at step 2;
    - `HEROKU_EMAIL` - email with which you registered on [Heroku].
5. Go to ['Deploy signaling server to Heroku'][5] GitHub workflow.      TODO: change name
6. Run workflow on `master` branch.

Now your instance of a signaling server can be accessed at `wss://flutter-sandbox-{{ YOUR GITHUB USERNAME }}.herokuapp.com`.


### Example of interaction with server

1. ????




## Releasing

To release your application run `make release` command.

Or you can do it manually:

```bash
$ git tag -d latest
$ git tag latest
$ git push origin latest --force 
```

CI will build your application and create a release on GitHub automatically.




## Final demonstration

Once you finish the development, release the application to GitHub as described in the previous section.

Firstly, you should demonstrate that ????. TODO: some demonstration info

Please, before demonstration make sure that your [Heroku] instance is not [sleeping][10].




## Required assets  TODO: check

All the assets required for this application are located in the `assets/` directory.




## Final design of application

Final design of the implemented application may vary from the provided one. The provided design aims only to explain the expected result better.




## Useful links   TODO: add some links

- [*****](http://)




## Repository requirements


### Files

Repository __must NOT contain__ (so have them [Git-ignored] to avoid accidents):
- __configuration__ files __of__ developer's __local toolchain__ (unless this configuration is suitable for all project developers);
- __compilation/build results/artifacts__ of source code;
- any __caches or temporary files__;
- __configuration__ files __for running__ application (except examples or Dockerized development environment configurations which are the same for all project developers).

__For keeping an empty directory__ in a repository __use the `.gitkeep` file__ inside that directory.

#### Naming

__Start directory with `.`__ if it contains some __temporary files which do not require direct manipulations__ and are going to be omitted by tools (caches, temp files, etc.). This is a quite common practice (see `.git/`, `.idea/`, `.gradle/`, etc.).  
Also, __all temporary cache files__ must be __placed inside a `.cache/`__ top-level directory of the repository, unless this is impossible for somewhat reasons.

__To emphasize toolchain directories__ (ones which do not contain project sources itself, but rather contain files of a project toolchain) their __name may be started with `_`__, which will make them to "bubble-up" in a repository source tree, so will allow easily to distinguish them from actual project sources (both for humans and tools).


### Branches and tags

Every repository contains the following branches:

- `master` - __mainline version__ of the project. Any new project release is usually created from this branch. Developing directly in this branch is forbidden. It __accepts new changes via PRs (pull requests)__.

Any other possible branches and tags can be created and used by developers as they need.

#### Branch naming

[Git] branch name __must__ meet the following requirements:
- consist of __English words__;  
  👍 `fix-tests-failure`  
  🚫 `fix-defectum-probat`
- use __only dashes to separate words__;  
  👍 `fix-tests-failure`  
  🚫 `fix_tests_failure`
- use __[imperative mood][1] for verbs__;  
  👍 `fix-tests-failure`  
  🚫 `fixes-tests-failure`
- __start with the issue number__ when branch is related to some issue (but __DO NOT use PR (pull request) numbers__);  
  👍 `23-fix-tests-failure`  
  🚫 `fix-tests-failure`
- __reflect the meaning of branch changes__, not the initial problem.    
  👍 `23-fix-tests-failure`  
  🚫 `23-problem-with-failing-tests`


### Commits

Every __commit message must contain a short description__ of its changes that meet the following requirements:
- be __on English__ (no other language is allowed);
- __start with a capital letter__;
- has __no punctuation symbols at the end__ (like `;`, `:` or `.`);
- use __[imperative mood][1] for verbs__ (as if you are commanding someone: `Fix`, `Add`, `Change` instead of `Fixes`, `Added`, `Changing`);
- use __marked list for multiple changes__, prepended by __one summary line__ and __one blank line__, where each __list item__ must:
    - __start with a lowercase letter__;
    - has __no punctuation symbols at the end__.

##### 👍 Single-line commit message example

```
Update Employee salary algorithm
```

##### 👍 Multiple-line commit message example

```
Implement employees salary and ajax queries

- update Employee salary algorithm
- remove unused files from public/images/ dir
- implement ajax queries for /settings page
```

##### 🚫 Wrong commit message examples

- Summary line starts with a lowercase letter:

    ```
    update Employee salary algorithm
    ```

- Verb is not in the [imperative mood][1]:

    ```
    Updates Employee salary algorithm
    ```

- Unnecessary punctuation is present:

    ```
    Update Employee salary algorithm.
    ```

    ```
    Implement employees salary and ajax queries:
    
    - update Employee salary algorithm;
    - remove unused files from public/images/ dir.
    ```

- Missing blank line between the summary line and the marked list:

    ```
    Implement employees salary and ajax queries
    - update Employee salary algorithm
    - remove unused files from public/images/ dir
    ```

- Marked list is indented:

    ```
    Implement employees salary and ajax queries
    
      - update Employee salary algorithm
      - remove unused files from public/images/ dir
    ```

- Marked list items start with a capital letter:

    ```
    Implement employees salary and ajax queries
    
    - Update Employee salary algorithm
    - Remove unused files from public/images/ dir
    ```


### FCM (final commit message)

FCM (final commit message) is a commit message of a pull request to a `master` branch.

As it will be saved in a repository history forever, it has __extra requirements__ that __must__ be met:
- __contain references__ to related PR;
- do __not contain__ any non-relative helper markers (like `[skip ci]`);

__Common commit messages__ which are not FCM __must NOT contain any references__, because references create crosslinks in mentioned PRs, which leads to spamming issues/PRs with unnecessary information. Only saved in history forever commits are allowed to create such crosslinks.

If а PR contains some __side changes__ which are not directly relevant to the task, then such changes __must be described as a marked list in the `Additionally:` section (separated by a blank line)__ of a FCM.

##### 👍 FCM examples

```
Implement employees salary and ajax queries (#43, #54)

- update Employee salary algorithm
- remove unused files from public/images/ dir

Additionally:
- update Git ignoring rules for TOML files
```

##### 🚫 Wrong FCM examples

- Bad formatting of references:

    ```
    Implement employees salary and ajax queries(#43,#54)

    - update Employee salary algorithm
    - remove unused files from public/images/ dir
    ```

- Side changes are not separated:

    ```
    Implement employees salary and ajax queries (#43, #54)

    - update Employee salary algorithm
    - remove unused files from public/images/ dir
    - update Git ignoring rules for TOML files
    ```

- Bad formatting of side changes:

    ```
    Implement employees salary and ajax queries (#43, #54)

    - update Employee salary algorithm
    - remove unused files from public/images/ dir
    Additionally:
    - update Git ignoring rules for TOML files
    ```


### Merging

__All merges to the mainline__ project version (`master` branch) __must have an individual PR (pull request)__ and must be __done only in [fast-forward] manner__. This is required to keep mainline history linear, simple and clear.

To achieve [fast-forward merge][fast-forward], __all branch commits__ (which doesn't exist in mainline) __must be squashed and rebased onto the latest mainline commit__. Notable moments are:
- Before rebase __do not forget to merge your branch with latest mainline branch updates__, otherwise rebase result can break changes.

#### Squash merging steps

##### Using GitHub UI

Performing squash merge correctly can be quite tricky when doing manually. To avoid complexity and mistakes in a day-to-day routine the [GitHub UI squash merging][13] is the __most preferred way__ for merging and a __developer should use it whenever it's possible__.

0. Merge with latest `master` branch.

1. Click on `Squash and merge` button.

2. Paste first line of FCM to title field.

3. Paste FCM without first line to body field.

4. Click `Confirm squash and merge`.

- __First line__ of FCM must go __as a title__ of the squash commit and __everything after as a message__.

Squash merging via GitHub UI also preserves the whole branch commits history in the PR, which is good for history purposes.


### Pushing

Developer __must push all his changes__ to the remote __at the end of his working day__. This both prevents from accidental work losses and helps a lead to track developer's progress.


## Project requirements

All features of application should be added with PRs. __Direct push to `master` is forbidden.__


### Pull requests

PRs (pull requests) are created to make changes in the repository and to solve some problem (fix a bug, implement a task, provide an improvement, etc).

PR __must contain related changes only__. Any __other unrelated changes__ of repository must be done __via separate PR__. This rule keeps project history clear and unambiguous.

PR __name must__:
- __shortly and clearly describe its meaning__;
- __contain `Draft: ` prefix__ until PR is merged or closed.

Not merged or closed PRs should be in [draft mode][11].

PR __description must contain details of the solution__ (background/summary, solution description, notable moments, etc).

Project have [PR template][12] which standardize PRs. Developer must __use [PR template][12] whenever it's possible__.  
If there is no template for some rare case, then the PR must be formatted in the same manner as available templates.

PR cannot be assigned to nobody and __always must have an assigned developer__.

PR cannot go without any labels and __must have all required labels correctly applied__.


### Labels

Labels are used for issues/PRs classification, as they:
- reflect the current state of issue/PR;
- improve understanding of issue/PR, its purpose and application;
- provide advanced search of issues/PRs;
- allow to sum up statistics of how project is going on.

There are several label groups:
- Type labels declare what the current issue/PR actually represents. These labels are __mandatory__: each issue/PR must have at least one such label.
    - `feature` applies when something new is implemented (or is going to be implemented).
    - `enhancement` applies when changing of existing features is involved (improvement or bugfix).
    - `rollback` applies when some existing changes are going to be rolled back.
- `k::` labels describe what the current issue/PR is relevant to and which project aspects are involved. These labels are __mandatory__: each issue/PR must have at least one such label.
    - `k::ui` applies to UI (user interface) and UX (user experience) changes. Use it when end-user are directly affected by this changes.
    - `k::api` applies to API (application interface) changes. Use it when you're changing application interfaces, like: HTTP API method parameters, library exported interfaces, command-line interfaces, etc.
    - `k::deploy` applies to changes that involve application deployment. Use it when you're changing the way application is deployed.
    - `k::design` applies to changes of application architecture and implementation design. Use it when you're changing architecture and algorithms.
    - `k::documentation` applies to changes of project documentation.
    - `k::logging` applies to changes in application logs.
    - `k::performance` applies to application performance related changes.
    - `k::refactor` applies to refactor changes of existing code.
    - `k::security` applies to application security related changes.
    - `k::testing` applies to changes of project tests.
    - `k::toolchain` applies to changes of project toolchain.


## Code style

All PHP source code must follow [PSR Standards] official recommendations.


### `.editorconfig` rules

Project contains [`.editorconfig` file][7] with both general and project-specific code style rules.

__Applying `.editorconfig` rules is mandatory.__

Make sure that your IDE supports `.editorconfig` rules applying. For JetBrains IDE the [EditorConfig plugin][8] may be used.



[1]: https://en.wikipedia.org/wiki/Imperative_mood
[2]: https://www.browserstack.com/guide/end-to-end-testing
[3]: https://dashboard.heroku.com/account
[4]: /../../settings/secrets/actions
[5]: /../../actions/workflows/deploy-server.yml
[7]: http://editorconfig.org
[8]: https://plugins.jetbrains.com/phpStorm/plugin/7294-editorconfig
[9]: https://github.blog/2019-06-06-generate-new-repositories-with-repository-templates
[10]: https://devcenter.heroku.com/articles/free-dyno-hours#dyno-sleeping
[11]: https://docs.github.com/en/github/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/about-pull-requests#draft-pull-requests
[12]: https://docs.github.com/en/communities/using-templates-to-encourage-useful-issues-and-pull-requests/about-issue-and-pull-request-templates#pull-request-templates
[13]: https://docs.github.com/en/github/collaborating-with-pull-requests/incorporating-changes-from-a-pull-request/about-pull-request-merges#squash-and-merge-your-pull-request-commits


[fast-forward]: https://ariya.io/2013/09/fast-forward-git-merge
[Git]: https://git-scm.com
[Git-ignored]: https://git-scm.com/docs/gitignore
[GitHub Pages]: https://pages.github.com/
[GraphQL]: https://graphql.org/
[Heroku]: https://www.heroku.com
[phpdoc]: https://docs.phpdoc.org/
[PSR Standards]: https://www.php-fig.org/psr/
[SOLID]: https://simple.wikipedia.org/wiki/SOLID_(object-oriented_design)
[Twig]: https://twig.symfony.com/
