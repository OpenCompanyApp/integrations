# Replicate — Lua API Reference

## list_predictions

List recent Replicate predictions.

### Parameters

None.

### Example

```lua
local result = app.integrations["replicate"].list_predictions({})

for _, prediction in ipairs(result.results) do
  print(prediction.id .. " - " .. prediction.status)
end
```

---

## get_prediction

Get detailed information about a specific prediction.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `prediction_id` | string | yes | The unique prediction identifier |

### Example

```lua
local prediction = app.integrations["replicate"].get_prediction({
  prediction_id = "abc123def456"
})

print("Status: " .. prediction.status)
print("Model: " .. prediction.version)
if prediction.output then
  print("Output: " .. vim.inspect(prediction.output))
end
```

---

## create_prediction

Create a new prediction using a model version.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `version` | string | yes | The model version ID (hex string) |
| `input` | object | yes | Model input values (varies by model) |
| `webhook` | string | no | URL to receive POST notifications on completion |
| `webhook_events` | array | no | List of webhook events (e.g., `{"output", "completed"}`) |

### Example

```lua
local prediction = app.integrations["replicate"].create_prediction({
  version = "5c7d5dc6dd8bf75c1acaa8565735e7986bc5fc6681734b58f0b7ef5f02a3ca2e",
  input = {
    prompt = "A beautiful sunset over the ocean",
    num_outputs = 1
  },
  webhook = "https://example.com/webhook",
  webhook_events = { "completed" }
})

print("Prediction ID: " .. prediction.id)
print("Status: " .. prediction.status)
```

---

## list_models

List available Replicate models.

### Parameters

None.

### Example

```lua
local result = app.integrations["replicate"].list_models({})

for _, model in ipairs(result.results) do
  print(model.owner .. "/" .. model.name .. ": " .. model.description)
end
```

---

## get_model

Get detailed information about a specific model.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model_owner` | string | yes | The model owner (user or organization) |
| `model_name` | string | yes | The model name |

### Example

```lua
local model = app.integrations["replicate"].get_model({
  model_owner = "stability-ai",
  model_name = "stable-diffusion"
})

print("Owner: " .. model.owner)
print("Name: " .. model.name)
print("Description: " .. model.description)
if model.latest_version then
  print("Latest version: " .. model.latest_version.id)
end
```

---

## list_collections

List curated model collections on Replicate.

### Parameters

None.

### Example

```lua
local result = app.integrations["replicate"].list_collections({})

for _, collection in ipairs(result.results) do
  print(collection.slug .. ": " .. collection.description)
end
```

---

## get_current_user

Get the current user's profile and billing information.

### Parameters

None.

### Example

```lua
local user = app.integrations["replicate"].get_current_user({})

print("Name: " .. user.name)
print("Username: " .. user.username)
```

---

## Multi-Account Usage

If you have multiple Replicate accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["replicate"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["replicate"].default.function_name({...})

-- Named accounts
app.integrations["replicate"].production.function_name({...})
app.integrations["replicate"].staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
