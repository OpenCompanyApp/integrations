# BrowserStack

Namespace: `browserstack`

Use the BrowserStack integration to inspect and manage BrowserStack Automate and App Automate resources. Authentication uses BrowserStack HTTP Basic credentials: `username` and `access_key`.

## Common Workflows

- Use `browserstack_get_plan` to inspect allowed, running, and queued parallel sessions before scheduling test runs.
- Use `browserstack_list_browsers` to discover supported OS, browser, and real-device combinations.
- Use `browserstack_list_projects`, `browserstack_get_project`, `browserstack_update_project`, and `browserstack_delete_project` for Automate projects.
- Use `browserstack_list_builds`, `browserstack_update_build`, `browserstack_delete_build`, and `browserstack_delete_builds` for Automate builds.
- Use `browserstack_list_build_sessions`, `browserstack_get_session`, `browserstack_update_session`, `browserstack_delete_session`, `browserstack_get_session_logs`, and `browserstack_get_session_network_logs` for session results and debugging assets.
- Use `browserstack_upload_app`, `browserstack_list_recent_apps`, and `browserstack_delete_app` for App Automate app management.
- Use `browserstack_api_get`, `browserstack_api_post`, `browserstack_api_put`, and `browserstack_api_delete` for safe relative BrowserStack API paths not covered by first-class tools. Full URLs are rejected.

## Argument Notes

Automate tools use `project_id`, `build_id`, or `session_id` depending on the resource. App Automate app deletion uses `app_id`. `browserstack_list_recent_apps` accepts optional `custom_id`.

Write tools accept request bodies through `payload`. Read tools accept optional filters through `query`.

For `browserstack_upload_app`, pass a public app URL in `payload.url`; optional fields include `custom_id` and `ios_keychain_support`.

## Examples

```js
var plan = tools.browserstack_get_plan({})

var builds = tools.browserstack_list_builds({
  query: { limit: 20, status: "running" },
})

var session_logs = tools.browserstack_get_session_logs({
  session_id: "session-id",
})

var uploaded = tools.browserstack_upload_app({
  payload: {
    url: "https://example.test/app-debug.apk",
    custom_id: "SampleApp",
  }
})
```
## Return Shapes

The integration returns decoded BrowserStack JSON responses directly. Empty successful responses are normalized to:

```json
{"success": true}
```

Plain text responses such as session logs are normalized to:

```json
{"value": "raw response text"}
```

BrowserStack product APIs use different base hosts. Automate calls use `https://api.browserstack.com`; App Automate upload and recent-app calls use `https://api-cloud.browserstack.com`.
