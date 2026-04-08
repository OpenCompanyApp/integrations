# New Relic — Lua API Reference

## list_applications

List APM applications in the configured New Relic account.

### Parameters

None.

### Example

```lua
local result = app.integrations.newrelic.list_applications({})

for _, app in ipairs(result) do
  print(app.name .. " (" .. app.applicationId .. ") - " .. app.healthStatus)
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

```lua
local result = app.integrations.newrelic.get_application({
  application_id = 12345678
})

print("Name: " .. result.name)
print("Language: " .. result.language)
print("Health: " .. result.healthStatus)
```

---

## list_deployments

List deployment markers for a New Relic APM application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `application_guid` | string | yes | The entity GUID of the application |

### Example

```lua
local result = app.integrations.newrelic.list_deployments({
  application_guid = "MxJ9MxNNTU2NjIxFExWFxBfEFBVXxBYU"
})

for _, dep in ipairs(result) do
  print(dep.revision .. " by " .. dep.user .. " at " .. dep.timestamp)
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

```lua
local result = app.integrations.newrelic.create_deployment({
  application_guid = "MxJ9MxNNTU2NjIxFExWFxBfEFBVXxBYU",
  revision = "abc123def456",
  description = "Release v2.5.0",
  user = "deploy-bot",
  changelog = "feat: add user dashboard"
})

print("Deployment created: " .. result.guid)
```

---

## list_alert_policies

List alert policies in the configured New Relic account.

### Parameters

None.

### Example

```lua
local result = app.integrations.newrelic.list_alert_policies({})

for _, policy in ipairs(result) do
  print(policy.name .. " (ID: " .. policy.id .. ")")
end
```

---

## list_dashboards

List dashboards in the configured New Relic account.

### Parameters

None.

### Example

```lua
local result = app.integrations.newrelic.list_dashboards({})

for _, dash in ipairs(result) do
  print(dash.title .. " - owner: " .. (dash.owner.email or "unknown"))
end
```

---

## get_current_user

Get the profile of the currently authenticated New Relic user.

### Parameters

None.

### Example

```lua
local result = app.integrations.newrelic.get_current_user({})
print("User: " .. result.actor.user.name)
print("Email: " .. result.actor.user.email)
```

---

## Multi-Account Usage

If you have multiple New Relic accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.newrelic.function_name({...})

-- Explicit default (portable across setups)
app.integrations.newrelic.default.function_name({...})

-- Named accounts
app.integrations.newrelic.production.function_name({...})
app.integrations.newrelic.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
