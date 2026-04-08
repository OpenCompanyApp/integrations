# Render — Lua API Reference

## list_services

List all services in the Render account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of services per page (default: 20, max: 100) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Example

```lua
local result = app.integrations.render2.list_services({
  limit = 50
})

for _, svc in ipairs(result.services) do
  print(svc.name .. " (" .. svc.type .. ") - " .. svc.status)
end
```

---

## get_service

Get details for a specific Render service.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `service_id` | string | yes | The service ID (e.g., `"srv-cabc12345678"`) |

### Example

```lua
local result = app.integrations.render2.get_service({ service_id = "srv-cabc12345678" })
local svc = result.service
print(svc.name .. " - " .. svc.type .. " - " .. svc.url)
```

---

## create_service

Create a new service on Render.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | yes | Service type: `"web_service"`, `"background_worker"`, `"cron_job"`, or `"private_service"` |
| `name` | string | yes | Name for the service |
| `repo` | string | yes | Git repository URL (e.g., `"https://github.com/user/repo"`) |
| `branch` | string | no | Git branch to deploy (default: `"main"`) |
| `region` | string | no | Region: `"oregon"`, `"ohio"`, `"frankfurt"`, `"singapore"` |
| `plan` | string | no | Plan: `"starter"`, `"standard"`, `"pro"`, `"pro_plus"` |
| `runtime` | string | no | Runtime: `"node"`, `"python"`, `"ruby"`, `"docker"` |
| `build_command` | string | no | Shell command to build |
| `start_command` | string | no | Shell command to start |
| `env_vars` | object | no | Environment variables as key-value pairs |

### Example

```lua
local result = app.integrations.render2.create_service({
  type = "web_service",
  name = "my-api",
  repo = "https://github.com/myorg/my-api",
  branch = "main",
  region = "oregon",
  plan = "starter",
  build_command = "npm run build",
  start_command = "npm start",
  env_vars = {
    NODE_ENV = "production"
  }
})

print("Created service: " .. result.service.id)
```

---

## list_deploys

List deploys for a specific Render service.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `service_id` | string | yes | The service ID |
| `limit` | integer | no | Number of deploys per page (default: 20, max: 100) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Example

```lua
local result = app.integrations.render2.list_deploys({
  service_id = "srv-cabc12345678",
  limit = 10
})

for _, deploy in ipairs(result.deploys) do
  print(deploy.id .. " - " .. deploy.status .. " - " .. (deploy.commit.message or ""))
end
```

---

## get_deploy

Get details for a specific deploy.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `deploy_id` | string | yes | The deploy ID (e.g., `"dep-cabc12345678"`) |

### Example

```lua
local result = app.integrations.render2.get_deploy({ deploy_id = "dep-cabc12345678" })
local d = result.deploy
print(d.status .. " - " .. d.commit.id .. ": " .. d.commit.message)
```

---

## list_jobs

List jobs for a specific Render service.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `service_id` | string | yes | The service ID |
| `limit` | integer | no | Number of jobs per page (default: 20, max: 100) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Example

```lua
local result = app.integrations.render2.list_jobs({
  service_id = "srv-cabc12345678",
  limit = 10
})

for _, job in ipairs(result.jobs) do
  print(job.id .. " - " .. job.status .. " - " .. job.startCommand)
end
```

---

## get_current_user

Get the current authenticated account information.

### Parameters

None.

### Example

```lua
local result = app.integrations.render2.get_current_user({})
print("Account: " .. result.email .. " (" .. result.id .. ")")
```

---

## Multi-Account Usage

If you have multiple Render accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.render2.list_services({})

-- Explicit default (portable across setups)
app.integrations.render2.default.list_services({})

-- Named accounts
app.integrations.render2.production.list_services({})
app.integrations.render2.staging.list_services({})
```

All functions are identical across accounts — only the credentials differ.
