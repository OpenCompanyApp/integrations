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
local result = app.integrations["huggingface"].list_models({
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
local result = app.integrations["huggingface"].list_models({
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
local model = app.integrations["huggingface"].get_model({
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
local datasets = app.integrations["huggingface"].list_datasets({
  search = "sentiment",
  sort = "downloads",
  limit = 10
})

for _, ds in ipairs(datasets) do
  print(ds.id .. " — " .. ds.downloads .. " downloads")
end
```

---

## get_dataset

Get detailed information about a specific dataset.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `dataset_id` | string | yes | The dataset ID (e.g. `"mozilla-foundation/common_voice_17_0"`) |

### Example

```lua
local dataset = app.integrations["huggingface"].get_dataset({
  dataset_id = "imdb"
})

print(dataset.id)
print(dataset.downloads .. " downloads")
print(dataset.likes .. " likes")
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
local spaces = app.integrations["huggingface"].list_spaces({
  search = "chat",
  sort = "likes",
  limit = 10
})

for _, space in ipairs(spaces) do
  print(space.id .. " — " .. (space.likes or 0) .. " likes")
end
```

---

## get_space

Get detailed information about a specific Space.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `space_id` | string | yes | The Space ID (e.g. `"stabilityai/stable-diffusion-3.5"`) |

### Example

```lua
local space = app.integrations["huggingface"].get_space({
  space_id = "stabilityai/stable-diffusion-3.5"
})

print(space.id)
print(space.sdk .. " SDK")
print(space.runtime.stage)
```

---

## get_current_user

Get the authenticated user's profile information.

### Parameters

None.

### Example

```lua
local user = app.integrations["huggingface"].get_current_user({})

print("Name: " .. user.fullname)
print("Username: " .. user.name)
print("Type: " .. user.type)
```

---

## Multi-Account Usage

If you have multiple Hugging Face accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["huggingface"].list_models({})

-- Explicit default (portable across setups)
app.integrations["huggingface"].default.list_models({})

-- Named accounts
app.integrations["huggingface"].work.list_models({})
app.integrations["huggingface"].research.list_models({})
```

All functions are identical across accounts — only the credentials differ.
