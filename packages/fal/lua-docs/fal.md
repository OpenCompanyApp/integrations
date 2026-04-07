# fal.ai — Lua API Reference

## list_models

List available fal.ai models.

### Parameters

None.

### Example

```lua
local result = app.integrations["fal"].list_models({})

for _, model in ipairs(result) do
  print(model.id .. ": " .. model.description)
end
```

---

## submit_request

Submit a generation request to a fal.ai model.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model_id` | string | yes | The model identifier (e.g., `"fal-ai/flux/schnell"`) |
| `input` | object | yes | Model input values (e.g., prompt, image_url) |
| `webhook_url` | string | no | URL to receive POST notifications on completion |

### Example

```lua
local result = app.integrations["fal"].submit_request({
  model_id = "fal-ai/flux/schnell",
  input = {
    prompt = "A beautiful sunset over the ocean, cinematic lighting",
    image_size = "landscape_16_9",
    num_images = 1
  }
})

print("Request ID: " .. result.request_id)
```

---

## get_request_status

Get the status of a submitted fal.ai request.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model_id` | string | yes | The model identifier used when submitting |
| `request_id` | string | yes | The request ID returned by `submit_request` |

### Example

```lua
local status = app.integrations["fal"].get_request_status({
  model_id = "fal-ai/flux/schnell",
  request_id = "abc123-def456"
})

print("Status: " .. status.status)
if status.queue_position then
  print("Queue position: " .. status.queue_position)
end
```

---

## get_result

Get the result of a completed fal.ai request.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model_id` | string | yes | The model identifier used when submitting |
| `request_id` | string | yes | The request ID returned by `submit_request` |

### Example

```lua
local result = app.integrations["fal"].get_result({
  model_id = "fal-ai/flux/schnell",
  request_id = "abc123-def456"
})

if result.images then
  for _, image in ipairs(result.images) do
    print("Image URL: " .. image.url)
  end
end

if result.video then
  print("Video URL: " .. result.video.url)
end
```

---

## list_files

List files stored in fal.ai storage.

### Parameters

None.

### Example

```lua
local result = app.integrations["fal"].list_files({})

for _, file in ipairs(result) do
  print(file.file_name .. " — " .. file.url)
end
```

---

## upload_file

Upload a file to fal.ai storage for use as model input.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_path` | string | yes | The local file path to upload |
| `file_name` | string | no | Custom file name for the upload |

### Example

```lua
local result = app.integrations["fal"].upload_file({
  file_path = "/path/to/reference-image.png",
  file_name = "reference.png"
})

print("Uploaded file URL: " .. result.url)
```

---

## get_current_user

Get the current fal.ai user profile and account information.

### Parameters

None.

### Example

```lua
local user = app.integrations["fal"].get_current_user({})

print("Name: " .. user.name)
print("Email: " .. user.email)
```

---

## Multi-Account Usage

If you have multiple fal.ai accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["fal"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["fal"].default.function_name({...})

-- Named accounts
app.integrations["fal"].production.function_name({...})
app.integrations["fal"].staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
