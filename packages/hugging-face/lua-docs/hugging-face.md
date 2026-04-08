# Hugging Face — Lua API Reference

## list_models

Search and list AI models on the Hugging Face Hub.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search query to filter models |
| `author` | string | no | Filter by organization or user |
| `task` | string | no | Filter by pipeline task (e.g. `"text-generation"`, `"image-classification"`) |
| `tags` | array | no | Filter by tags (e.g. `{"pytorch", "safetensors"}`) |
| `sort` | string | no | Sort order: `"downloads"`, `"likes"`, `"lastModified"`, `"created"` |
| `direction` | string | no | Sort direction: `"asc"` or `"desc"` |
| `limit` | integer | no | Results per page (default: 20, max: 500) |
| `offset` | integer | no | Offset for pagination |

### Common Tasks

`text-generation`, `text2text-generation`, `text-classification`, `token-classification`, `question-answering`, `summarization`, `translation`, `image-classification`, `image-generation`, `automatic-speech-recognition`, `feature-extraction`, `sentence-similarity`

### Examples

```lua
-- Top text-generation models
local result = app.integrations["hugging-face"].list_models({
  task = "text-generation",
  sort = "downloads",
  limit = 10
})

for _, model in ipairs(result) do
  print(model.id .. " — " .. model.downloads .. " downloads")
end
```

```lua
-- Search for a specific model
local result = app.integrations["hugging-face"].list_models({
  search = "bert-base",
  sort = "downloads",
  limit = 5
})
```

---

## get_model

Get detailed information about a specific model.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model_id` | string | yes | The model ID (e.g. `"meta-llama/Llama-3.3-70B-Instruct"`) |

### Example

```lua
local model = app.integrations["hugging-face"].get_model({
  model_id = "meta-llama/Llama-3.3-70B-Instruct"
})

print(model.id)
print(model.pipeline_tag)
print(model.downloads .. " downloads")
print(model.likes .. " likes")
```

---

## list_datasets

Search and list datasets on the Hugging Face Hub.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search query to filter datasets |
| `author` | string | no | Filter by organization or user |
| `tags` | array | no | Filter by tags |
| `sort` | string | no | Sort order: `"downloads"`, `"likes"`, `"lastModified"`, `"created"` |
| `direction` | string | no | Sort direction: `"asc"` or `"desc"` |
| `limit` | integer | no | Results per page (default: 20, max: 500) |
| `offset` | integer | no | Offset for pagination |

### Example

```lua
local datasets = app.integrations["hugging-face"].list_datasets({
  search = "sentiment",
  sort = "downloads",
  limit = 10
})

for _, ds in ipairs(datasets) do
  print(ds.id .. " — " .. ds.downloads .. " downloads")
end
```

---

## inference

Run inference on a model via the Hugging Face Inference API.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model_id` | string | yes | The model ID to run inference on |
| `inputs` | string | no | Input text for the model (for text tasks) |
| `parameters` | object | no | Model-specific parameters (e.g. `max_new_tokens`, `temperature`) |
| `data` | string | no | Base64-encoded data for image/audio tasks |

### Common Parameters for Text Generation

| Parameter | Type | Description |
|-----------|------|-------------|
| `max_new_tokens` | integer | Maximum tokens to generate |
| `temperature` | number | Sampling temperature (0.0–2.0) |
| `top_p` | number | Nucleus sampling threshold |
| `top_k` | integer | Top-k sampling |
| `repetition_penalty` | number | Penalty for repeated tokens |
| `do_sample` | boolean | Enable sampling (true) or greedy decoding (false) |

### Examples

```lua
-- Text generation
local result = app.integrations["hugging-face"].inference({
  model_id = "meta-llama/Llama-3.3-70B-Instruct",
  inputs = "What is the meaning of life?",
  parameters = {
    max_new_tokens = 100,
    temperature = 0.7
  }
})

for _, item in ipairs(result) do
  print(item.generated_text)
end
```

```lua
-- Summarization
local result = app.integrations["hugging-face"].inference({
  model_id = "facebook/bart-large-cnn",
  inputs = "The tower is 324 metres (1,063 ft) tall, about the same height as an 81-storey building..."
})

for _, item in ipairs(result) do
  print(item.summary_text)
end
```

```lua
-- Text classification (sentiment)
local result = app.integrations["hugging-face"].inference({
  model_id = "distilbert-base-uncased-finetuned-sst-2-english",
  inputs = "I love using Hugging Face!"
})

for _, item in ipairs(result) do
  for _, label in ipairs(item) do
    print(label.label .. ": " .. label.score)
  end
end
```

---

## list_spaces

Search and list Spaces on the Hugging Face Hub.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search query to filter Spaces |
| `author` | string | no | Filter by organization or user |
| `tags` | array | no | Filter by tags |
| `sort` | string | no | Sort order: `"downloads"`, `"likes"`, `"lastModified"`, `"created"` |
| `direction` | string | no | Sort direction: `"asc"` or `"desc"` |
| `limit` | integer | no | Results per page (default: 20, max: 500) |
| `offset` | integer | no | Offset for pagination |

### Example

```lua
local spaces = app.integrations["hugging-face"].list_spaces({
  search = "chat",
  sort = "likes",
  limit = 10
})

for _, space in ipairs(spaces) do
  print(space.id .. " — " .. (space.likes or 0) .. " likes")
end
```

---

## get_current_user

Get the authenticated user's profile information.

### Parameters

None.

### Example

```lua
local user = app.integrations["hugging-face"].get_current_user({})

print("Name: " .. user.fullname)
print("Username: " .. user.name)
print("Type: " .. user.type)
```

---

## Multi-Account Usage

If you have multiple Hugging Face accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["hugging-face"].list_models({})

-- Explicit default (portable across setups)
app.integrations["hugging-face"].default.list_models({})

-- Named accounts
app.integrations["hugging-face"].work.list_models({})
app.integrations["hugging-face"].research.list_models({})
```

All functions are identical across accounts — only the credentials differ.
