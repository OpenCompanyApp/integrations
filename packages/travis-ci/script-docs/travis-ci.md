# Travis CI

Travis CI tools are available under `app.integrations.travis-ci`.

Use this integration to inspect repositories, builds, jobs, job logs, build requests, repository settings, and environment variables through Travis CI API V3. Requests include `Travis-API-Version: 3` and `Authorization: token <token>`.

## Repository References

Repository arguments accept:

- A numeric Travis repository id, such as `891`.
- An owner/name slug, such as `acme/web`.
- A provider/owner/name slug, such as `github/acme/web`.

Slug path parts are URL-encoded before calling Travis.

## Examples

List recent builds:

```js
var builds = app.integrations["travis-ci"].travis_ci_list_repository_builds({
  repository: "acme/web",
  query: {
    limit: 10,
    sort_by: "number:desc",
    include: "build.commit,build.jobs",
  }
})
```
Restart a failed build:

```js
app.integrations["travis-ci"].travis_ci_restart_build({
  build_id: 86601346,
})
```
Fetch a plain text job log:

```js
var log = app.integrations["travis-ci"].travis_ci_get_job_log({
  job_id: 86601347,
  plain_text: true,
})
```
Trigger a build request:

```js
var request = app.integrations["travis-ci"].travis_ci_create_request({
  repository: "acme/web",
  payload: {
    request: {
      branch: "main",
      message: "Triggered by agent",
    }
  }
})
```
## Raw API Helpers

Use raw helpers for newer or long-tail API V3 endpoints:

```js
var repo = app.integrations["travis-ci"].travis_ci_api_get({
  path: "/repo/891",
  query: { include: "repository.current_build" },
})
```
Raw paths must be relative. Full external URLs are rejected.

## Response Shape

JSON responses are returned as Travis provides them. Empty successful responses return `{ success = true }`. Plain text logs return `{ value = "..." }`.

## Safety

- Examples use fake ids and repository names.
- Tool access depends on the permissions granted to the Travis token.
- Debug jobs are only available on supported Travis hosts and repositories.
- Environment variable values may be sensitive; avoid returning or storing secrets in downstream logs.
