# RunPod — Lua API Reference

## list_pods

List all GPU pods in your RunPod account.

### Parameters

None.

### Example

```lua
local result = app.integrations.runpod.list_pods({})

for _, pod in ipairs(result.pods) do
  print(pod.name .. " (ID: " .. pod.pod_id .. ") — " .. pod.status)
end
```

---

## get_pod

Get detailed information about a specific RunPod GPU pod.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pod_id` | string | yes | The RunPod pod ID |

### Example

```lua
local pod = app.integrations.runpod.get_pod({
  pod_id = "abc123def456"
})

print("Pod: " .. pod.name)
print("Status: " .. pod.status)
print("GPU: " .. pod.machine.gpuDisplayName)
```

---

## list_templates

List all available RunPod templates.

### Parameters

None.

### Example

```lua
local result = app.integrations.runpod.list_templates({})

for _, tmpl in ipairs(result.templates) do
  print(tmpl.name .. " — " .. (tmpl.image or "no image"))
end
```

---

## list_network_volumes

List all network volumes in your RunPod account.

### Parameters

None.

### Example

```lua
local result = app.integrations.runpod.list_network_volumes({})

for _, vol in ipairs(result.network_volumes) do
  print(vol.name .. " (" .. vol.size_in_gb .. " GB)")
end
```

---

## list_endpoints

List all RunPod endpoints.

### Parameters

None.

### Example

```lua
local result = app.integrations.runpod.list_endpoints({})

for _, ep in ipairs(result.endpoints) do
  print(ep.name .. " — " .. (ep.status or "unknown"))
end
```

---

## list_serverless

List all serverless endpoints in your RunPod account.

### Parameters

None.

### Example

```lua
local result = app.integrations.runpod.list_serverless({})

for _, sl in ipairs(result.serverless) do
  print(sl.name .. " — workers: " .. (sl.workers_min or 0) .. "-" .. (sl.workers_max or "?"))
end
```

---

## get_current_user

Get the profile of the currently authenticated RunPod user.

### Parameters

None.

### Example

```lua
local user = app.integrations.runpod.get_current_user({})
print("Logged in as: " .. (user.firstName or user.username or "Unknown"))
```

---

## Multi-Account Usage

If you have multiple RunPod accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.runpod.list_pods({})

-- Explicit default (portable across setups)
app.integrations.runpod.default.list_pods({})

-- Named accounts
app.integrations.runpod.work.list_pods({})
app.integrations.runpod.personal.get_pod({ pod_id = "abc123" })
```

All functions are identical across accounts — only the credentials differ.
