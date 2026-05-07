# Google Apps Script

Google Apps Script tools are exposed under `app.integrations.google_apps_script`. This package is generated from Google's official Apps Script v1 Discovery document and exposes 16 REST methods.

Use it for automation workflows: create script projects, get and update source content, manage deployments and versions, inspect metrics and process history, and run deployed script functions.

Each method-specific tool accepts Discovery path parameters as top-level arguments, known query parameters as top-level shortcuts or inside `query`, and request resources inside `body`. Pass script IDs, deployment IDs, and version numbers exactly as returned by Apps Script or Drive.

## Examples

```lua
local project = app.integrations.google_apps_script.google_apps_script_projects_get({
  scriptId = "script-id"
})

local content = app.integrations.google_apps_script.google_apps_script_projects_get_content({
  scriptId = "script-id"
})

local execution = app.integrations.google_apps_script.google_apps_script_scripts_run({
  scriptId = "script-id",
  body = {
    function = "main",
    parameters = { "argument" }
  }
})
```

Returned data is the parsed JSON response from the Apps Script API. Empty successful responses return `{ success = true, status = <http_status> }`.

Apps Script execution uses the OAuth scopes required by the script itself. Project content and deployment operations require Apps Script API access and permissions on the target script project.