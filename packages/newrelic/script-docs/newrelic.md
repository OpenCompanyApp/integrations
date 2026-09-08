# New Relic — Ruby API Reference

## list_applications

List APM applications in the configured New Relic account.

### Parameters

None.

### Example

```ruby
result = app.integrations.newrelic.list_applications()
result.each do |app|
  puts((app.name).to_s + " (" + (app.applicationId).to_s + ") - " + (app.healthStatus).to_s)
end
```
---

## get_application

Get details of a specific APM application by its application ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `application_id` | integer | yes | The New Relic application ID |

### Example

```ruby
result = app.integrations.newrelic.get_application(application_id: 12345678)
puts("Name: " + (result.name).to_s)
puts("Language: " + (result.language).to_s)
puts("Health: " + (result.healthStatus).to_s)
```
---

## list_deployments

List deployment markers for a New Relic APM application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `application_guid` | string | yes | The entity GUID of the application |

### Example

```ruby
result = app.integrations.newrelic.list_deployments(application_guid: "MxJ9MxNNTU2NjIxFExWFxBfEFBVXxBYU")
result.each do |dep|
  puts((dep.revision).to_s + " by " + (dep.user).to_s + " at " + (dep.timestamp).to_s)
end
```
---

## create_deployment

Record a new deployment marker in New Relic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `application_guid` | string | yes | The entity GUID of the application |
| `revision` | string | yes | Deployment revision (e.g. commit SHA, version) |
| `description` | string | no | Description of the deployment |
| `user` | string | no | User who triggered the deployment |
| `changelog` | string | no | Changelog or commit message |

### Example

```ruby
result = app.integrations.newrelic.create_deployment(application_guid: "MxJ9MxNNTU2NjIxFExWFxBfEFBVXxBYU", revision: "abc123def456", description: "Release v2.5.0", user: "deploy-bot", changelog: "feat: add user dashboard")
puts("Deployment created: " + (result.guid).to_s)
```
---

## list_alert_policies

List alert policies in the configured New Relic account.

### Parameters

None.

### Example

```ruby
result = app.integrations.newrelic.list_alert_policies()
result.each do |policy|
  puts((policy.name).to_s + " (ID: " + (policy.id).to_s + ")")
end
```
---

## list_dashboards

List dashboards in the configured New Relic account.

### Parameters

None.

### Example

```ruby
result = app.integrations.newrelic.list_dashboards()
result.each do |dash|
  puts((dash.title).to_s + " - owner: " + ((dash.owner.email || "unknown")).to_s)
end
```
---

## get_current_user

Get the profile of the currently authenticated New Relic user.

### Parameters

None.

### Example

```ruby
result = app.integrations.newrelic.get_current_user()
puts("User: " + (result.actor.user.name).to_s)
puts("Email: " + (result.actor.user.email).to_s)
```
---

## Multi-Account Usage

If you have multiple New Relic accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
