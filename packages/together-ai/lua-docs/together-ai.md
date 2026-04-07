# Together AI — Lua API Reference

## list_models

List all available AI models on Together AI.

### Parameters

None.

### Example

```lua
local result = app.integrations["together-ai"].list_models({})

for _, model in ipairs(result) do
  print(model.id .. " — " .. model.type)
end
```

---

## create_completion

Create a chat completion using a Together AI model.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model` | string | yes | The model ID (e.g. `"meta-llama/Llama-3.3-70B-Instruct-Turbo"`) |
| `messages` | array | yes | Array of message objects with `"role"` (system, user, assistant) and `"content"` |
| `max_tokens` | integer | no | Maximum tokens to generate in the response |
| `temperature` | number | no | Sampling temperature (0.0–2.0). Defaults to 0.7 |
| `top_p` | number | no | Nucleus sampling threshold (0.0–1.0). Defaults to 0.7 |
| `top_k` | integer | no | Top-k sampling parameter |
| `frequency_penalty` | number | no | Penalize tokens based on frequency (-2.0 to 2.0) |
| `presence_penalty` | number | no | Penalize tokens based on presence (-2.0 to 2.0) |
| `stop` | array | no | Array of stop sequences |

### Examples

```lua
-- Simple chat completion
local result = app.integrations["together-ai"].create_completion({
  model = "meta-llama/Llama-3.3-70B-Instruct-Turbo",
  messages = {
    { role = "user", content = "What is the meaning of life?" }
  },
  max_tokens = 256,
  temperature = 0.7
})

print(result.choices[1].message.content)
```

```lua
-- Multi-turn conversation
local result = app.integrations["together-ai"].create_completion({
  model = "mistralai/Mixtral-8x7B-Instruct-v0.1",
  messages = {
    { role = "system", content = "You are a helpful assistant." },
    { role = "user", content = "Explain quantum computing in simple terms." }
  },
  max_tokens = 512,
  temperature = 0.5
})
```

---

## list_fine_tunes

List all fine-tuning jobs on Together AI.

### Parameters

None.

### Example

```lua
local result = app.integrations["together-ai"].list_fine_tunes({})

for _, job in ipairs(result) do
  print(job.id .. " — " .. job.status .. " — " .. job.model_name)
end
```

---

## get_fine_tune

Get details of a specific fine-tuning job.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fine_tune_id` | string | yes | The fine-tuning job ID (e.g. `"ft-abc123"`) |

### Example

```lua
local job = app.integrations["together-ai"].get_fine_tune({
  fine_tune_id = "ft-abc123"
})

print("Status: " .. job.status)
print("Model: " .. job.model_name)
print("Output: " .. (job.output_model_name or "pending"))
```

---

## list_files

List all files uploaded to Together AI.

### Parameters

None.

### Example

```lua
local result = app.integrations["together-ai"].list_files({})

for _, file in ipairs(result) do
  print(file.id .. " — " .. file.filename .. " (" .. file.bytes .. " bytes)")
end
```

---

## get_file

Get details of a specific file.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_id` | string | yes | The file ID to retrieve |

### Example

```lua
local file = app.integrations["together-ai"].get_file({
  file_id = "file-abc123"
})

print("Name: " .. file.filename)
print("Size: " .. file.bytes .. " bytes")
print("Purpose: " .. file.purpose)
```

---

## get_current_user

Get the authenticated user's account information.

### Parameters

None.

### Example

```lua
local user = app.integrations["together-ai"].get_current_user({})

print("Name: " .. (user.name or "unknown"))
print("Email: " .. (user.email or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Together AI accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["together-ai"].list_models({})

-- Explicit default (portable across setups)
app.integrations["together-ai"].default.list_models({})

-- Named accounts
app.integrations["together-ai"].work.list_models({})
app.integrations["together-ai"].research.list_models({})
```

All functions are identical across accounts — only the credentials differ.
