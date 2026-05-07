# Google Admin Reports

Google Admin Reports tools are exposed under `app.integrations.google_admin_reports`. This package is generated from Google's official Admin SDK Reports API Discovery document and exposes 6 REST methods.

Use it for Workspace audit and reporting workflows: activity logs, user usage reports, customer usage reports, entity usage reports, activity watch channels, and channel stop.

## Examples

```lua
local activity = app.integrations.google_admin_reports.google_admin_reports_activities_list({
  userKey = "all",
  applicationName = "login",
  maxResults = 10
})

local usage = app.integrations.google_admin_reports.google_admin_reports_customer_usage_reports_get({
  date = "2026-05-01"
})
```

Returned data is the parsed JSON response from the Admin SDK Reports API. Reports access requires administrator privileges and the appropriate readonly or audit scopes.