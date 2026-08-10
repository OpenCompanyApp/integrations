# Bugsnag Integration

Namespace: `app.integrations.bugsnag`

Use this integration to access Bugsnag error-monitoring data, inspect projects and releases, manage error workflow data, report builds and sessions, and create privacy export requests.

## Common Workflows

### Find Organizations And Projects

```js
var orgs = app.integrations.bugsnag.list_organizations({})

var projects = app.integrations.bugsnag.list_organization_projects({
  organization_id: "org_id",
})
```
Most Data Access API endpoints use Bugsnag IDs from these responses.

### List And Filter Errors

```js
var errors = app.integrations.bugsnag.list_errors({
  project_id: "project_id",
  query: {
    ["filters[error.status][][value]"]: "open",
    ["filters[error.status][][type]"]: "eq"
  }
})
```
Bugsnag exposes many filters using bracketed query parameter names. Put those filters in the `query` object so the integration sends them unchanged.

### Inspect Trends And Pivots

```js
var trend = app.integrations.bugsnag.get_project_trend({
  project_id: "project_id",
  resolution: "30m",
  query: {
    ["filters[event.since][][value]"]: "1d",
    ["filters[event.since][][type]"]: "eq"
  }
})

var users = app.integrations.bugsnag.list_pivot_values({
  project_id: "project_id",
  error_id: "error_id",
  pivot: "user.id",
})
```
### Create Privacy Event Data Requests

```js
var request = app.integrations.bugsnag.create_organization_event_data_request({
  organization_id: "org_id",
  query: {
    report_type: "gdpr",
    ["filters[user.id][][value]"]: "user_123",
    ["filters[user.id][][type]"]: "eq"
  }
})
```
Poll `get_organization_event_data_request` or `get_project_event_data_request` until Bugsnag returns a completed request URL.

### Build And Session Reporting

```js
var build = app.integrations.bugsnag.notify_build({
  payload: {
    apiKey: "project_api_key",
    appVersion: "1.2.3",
    releaseStage: "production",
  }
})

var session = app.integrations.bugsnag.report_session({
  payload: {
    apiKey: "project_api_key",
    notifier: { name: "custom-agent", version: "1.0.0", url: "https://example.test" },
    sessions: {},
  }
})
```
The build, session, and error-reporting APIs use project API keys in their payloads. The configured integration token is still used for this package's HTTP client.

## Coverage Notes

Focused tools cover authenticated user lookup, organizations, organization projects, collaborators, teams, projects, errors, events, trends, pivots, releases, GDPR and CCPA event data requests, error reporting, build reporting, session reporting, and raw Data Access API escape hatches.

The Bugsnag Data Access API v2 requires the `X-Version: 2` header. The integration sends it automatically for Data Access API tools.
