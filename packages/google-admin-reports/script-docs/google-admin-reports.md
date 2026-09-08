# Google Admin Reports

Google Admin Reports tools are exposed under `app.integrations.google_admin_reports`. This package is generated from Google's official Admin SDK Reports API Discovery document and exposes 6 REST methods.

Use it for Workspace audit and reporting workflows: activity logs, user usage reports, customer usage reports, entity usage reports, activity watch channels, and channel stop.

## Examples

```ruby
activity = app.call("integrations.google-admin-reports.activities_list", user_key: "all", application_name: "login", max_results: 10)
usage = app.call("integrations.google-admin-reports.customer_usage_get", date: "2026-05-01")
```
Returned data is the parsed JSON response from the Admin SDK Reports API. Reports access requires administrator privileges and the appropriate readonly or audit scopes.