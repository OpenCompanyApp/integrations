# TeamCity

TeamCity tools are available under `app.integrations.teamcity`.

Use this integration to inspect TeamCity projects, build configurations, builds, queue state, agents, users, groups, investigations, problems, changes, and VCS roots. The integration talks to the TeamCity REST API under `/app/rest`, sends JSON `Accept` and `Content-Type` headers, and uses bearer-token authentication.

## Common Patterns

Get server details:

```js
var server = app.integrations.teamcity.teamcity_get_server_info({})
```
List recent failed builds:

```js
var builds = app.integrations.teamcity.teamcity_list_builds({
  locator: "status:FAILURE,count:10",
  fields: "build(id,number,status,state,webUrl,buildTypeId)",
})
```
Trigger a build:

```js
var queued = app.integrations.teamcity.teamcity_queue_build({
  payload: {
    buildType: { id: "Project_Build" },
    branchName: "main",
  }
})
```
Cancel a running build:

```js
app.integrations.teamcity.teamcity_cancel_build({
  locator: "id:12345",
  payload: {
    comment: "Canceled by automation",
    readdIntoQueue: false,
  }
})
```
Pause the build queue:

```js
app.integrations.teamcity.teamcity_set_queue_paused({
  paused: true,
  reason: "Maintenance window",
})
```
## Locator Notes

TeamCity uses locators heavily. Prefer explicit locators such as `id:ProjectId`, `id:BuildTypeId`, `id:12345`, `username:ada`, or compound build locators like `buildType:id:Project_Build,status:SUCCESS,count:20`.

For list tools, `locator` is sent as the TeamCity query parameter. For get, cancel, delete, artifact, statistics, tag, pin, agent, and user tools, `locator` is used as the path locator.

## Raw API Helpers

Use raw helpers only when a named tool does not cover the endpoint:

```js
var result = app.integrations.teamcity.teamcity_api_get({
  path: "/projects",
  query: { fields: "project(id,name,href)" },
})
```
Raw paths must be relative. `/app/rest/projects` and `/projects` are both accepted; full external URLs are rejected.

## Response Shape

JSON responses are returned as TeamCity provides them. Empty successful responses return `{ success = true }`. Plain text responses return `{ value = "..." }`.

## Safety

- All examples use fake project and build IDs.
- Tool access depends on the permissions granted to the TeamCity token.
- Destructive operations such as deleting projects or builds should use explicit locators.
- Some TeamCity deployments restrict endpoints by server version, license, plugin availability, or project permissions. Use `teamcity_api_get` for newer long-tail endpoints when a named tool is not available.
