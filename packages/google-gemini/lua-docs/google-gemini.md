# Google Gemini — Lua API Reference

## list_models

List available Gemini AI models.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Max models per page (default: 50, max: 100) |
| `pageToken` | string | no | Token from a previous response for pagination |

### Example

```lua
local result = app.integrations["google-gemini"].list_models({
  pageSize = 10
})

for _, model in ipairs(result.models) do
  print(model.name .. " — " .. model.displayName)
end
```

---

## get_model

Get detailed information about a specific Gemini model.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Model resource name, e.g. `"models/gemini-2.0-flash"` |

### Example

```lua
local result = app.integrations["google-gemini"].get_model({
  id = "models/gemini-2.0-flash"
})

print("Model: " .. result.displayName)
print("Input token limit: " .. result.inputTokenLimit)
print("Output token limit: " .. result.outputTokenLimit)
```

---

## generate_content

Generate content using a Gemini model.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Model resource name, e.g. `"models/gemini-2.0-flash"` |
| `contents` | array | yes | Array of content messages with `role` and `parts` |
| `temperature` | number | no | Randomness control (0.0–2.0) |
| `topP` | number | no | Nucleus sampling (0.0–1.0) |
| `maxOutputTokens` | integer | no | Max tokens in the response |

### Content Format

The `contents` array contains message objects:

```lua
{
  { role = "user", parts = { { text = "Your prompt here" } } }
}
```

For multi-turn conversations:

```lua
{
  { role = "user", parts = { { text = "Hello!" } } },
  { role = "model", parts = { { text = "Hi there!" } } },
  { role = "user", parts = { { text = "Tell me more." } } }
}
```

### Example

```lua
local result = app.integrations["google-gemini"].generate_content({
  id = "models/gemini-2.0-flash",
  contents = {
    { role = "user", parts = { { text = "Write a haiku about programming." } } }
  },
  temperature = 0.7,
  maxOutputTokens = 100
})

for _, candidate in ipairs(result.candidates) do
  for _, part in ipairs(candidate.content.parts) do
    print(part.text)
  end
end
```

---

## list_files

List files uploaded to the Gemini File API.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Max files per page (default: 50, max: 100) |
| `pageToken` | string | no | Token from a previous response for pagination |

### Example

```lua
local result = app.integrations["google-gemini"].list_files({
  pageSize = 10
})

for _, file in ipairs(result.files) do
  print(file.name .. " — " .. file.mimeType .. " (" .. file.sizeBytes .. " bytes)")
end
```

---

## get_file

Get metadata for an uploaded file.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | File resource name, e.g. `"files/abc123"` |

### Example

```lua
local result = app.integrations["google-gemini"].get_file({
  id = "files/abc123"
})

print("File: " .. result.displayName)
print("MIME: " .. result.mimeType)
print("State: " .. result.state)
```

---

## list_tuned_models

List tuned (fine-tuned) Gemini models.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Max models per page (default: 50, max: 100) |
| `pageToken` | string | no | Token from a previous response for pagination |

### Example

```lua
local result = app.integrations["google-gemini"].list_tuned_models({
  pageSize = 10
})

for _, model in ipairs(result.tunedModels) do
  print(model.name .. " — base: " .. (model.baseModel or "unknown"))
end
```

---

## get_current_user

Get information about the currently authenticated user.

### Parameters

None.

### Example

```lua
local result = app.integrations["google-gemini"].get_current_user({})

print("User: " .. (result.name or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Google Gemini accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["google-gemini"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["google-gemini"].default.function_name({...})

-- Named accounts
app.integrations["google-gemini"].work.function_name({...})
app.integrations["google-gemini"].personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
