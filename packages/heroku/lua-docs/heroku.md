# Heroku — Lua API Reference

## list_apps

List all Heroku apps the authenticated user has access to.

### Parameters

None.

### Example

```lua
local result = app.integrations.heroku.list_apps({})

for _, app in ipairs(result) do
  print(app.name .. " (" .. app.region.name .. ") - " .. app.web_url)
end
```

---

## get_app

Get details for a specific Heroku app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The app ID or name (e.g., `"my-app"` or the UUID) |

### Example

```lua
local result = app.integrations.heroku.get_app({ app_id = "my-app" })
print(result.name .. " - " .. result.stack .. " - " .. result.git_url)
```

---

## list_dynos

List all dynos for a given Heroku app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The app ID or name |

### Example

```lua
local result = app.integrations.heroku.list_dynos({ app_id = "my-app" })

for _, dyno in ipairs(result) do
  print(dyno.name .. " (" .. dyno.type .. ") - " .. dyno.state .. " - size: " .. dyno.size)
end
```

---

## list_addons

List all add-ons attached to a given Heroku app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The app ID or name |

### Example

```lua
local result = app.integrations.heroku.list_addons({ app_id = "my-app" })

for _, addon in ipairs(result) do
  print(addon.name .. " (" .. addon.plan.name .. ") - " .. addon.state)
end
```

---

## list_domains

List all domains for a given Heroku app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The app ID or name |

### Example

```lua
local result = app.integrations.heroku.list_domains({ app_id = "my-app" })

for _, domain in ipairs(result) do
  print(domain.hostname .. " (" .. domain.kind .. ") - " .. domain.status)
end
```

---

## list_collaborators

List all collaborators for a given Heroku app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The app ID or name |

### Example

```lua
local result = app.integrations.heroku.list_collaborators({ app_id = "my-app" })

for _, collab in ipairs(result) do
  print(collab.user.email .. " - role: " .. collab.role)
end
```

---

## get_current_user

Get the current authenticated account information.

### Parameters

None.

### Example

```lua
local result = app.integrations.heroku.get_current_user({})
print("Account: " .. result.email .. " - verified: " .. tostring(result.verified))
```

---

## Multi-Account Usage

If you have multiple Heroku accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.heroku.list_apps({})

-- Explicit default (portable across setups)
app.integrations.heroku.default.list_apps({})

-- Named accounts
app.integrations.heroku.production.list_apps({})
app.integrations.heroku.staging.list_apps({})
```

All functions are identical across accounts — only the credentials differ.
