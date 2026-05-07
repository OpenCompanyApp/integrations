# Hugging Face Lua API Reference

Namespace: `app.integrations["hugging-face"]`

This integration wraps the Hugging Face Hub API and the serverless Inference API. Repository IDs keep their owner slash, for example `meta-llama/Llama-3.3-70B-Instruct`.

## Discovery

Use `list_models`, `list_datasets`, and `list_spaces` for Hub search. Common filters include `search`, `author`, `tags`, `sort`, `direction`, `limit`, and `offset`. `list_models` also accepts `task`, which maps to the Hub `pipeline_tag` filter.

```lua
local models = app.integrations["hugging-face"].list_models({
  task = "text-generation",
  sort = "downloads",
  limit = 10
})
```

Use `get_model`, `get_dataset`, and `get_space` when you already have a repo ID and need metadata, tags, card data, likes, downloads, or file siblings.

```lua
local model = app.integrations["hugging-face"].get_model({
  model_id = "meta-llama/Llama-3.3-70B-Instruct"
})

local dataset = app.integrations["hugging-face"].get_dataset({
  dataset_id = "mozilla-foundation/common_voice_17_0"
})
```

## Repository Utilities

The repo tools accept `repo_type` as `models`, `datasets`, or `spaces`. Singular values like `model` are also accepted.

```lua
local refs = app.integrations["hugging-face"].list_refs({
  repo_type = "models",
  repo_id = "bert-base-uncased"
})

local commits = app.integrations["hugging-face"].list_commits({
  repo_type = "datasets",
  repo_id = "mozilla-foundation/common_voice_17_0",
  revision = "main"
})

local files = app.integrations["hugging-face"].list_tree({
  repo_type = "spaces",
  repo_id = "organization/demo-space",
  revision = "main",
  path = "src"
})
```

Use `get_scan_status` to inspect Hub security scan status for a model, dataset, or Space repository.

## Metadata Helpers

`list_model_tags` and `list_dataset_tags` return Hub tag dictionaries grouped by type. Use these before building filter-heavy searches. `list_space_hardware` returns the hardware options exposed by the Hub.

## Create Repositories

`create_repo` calls the official Hub repository creation endpoint. Use `type` values `model`, `dataset`, or `space`.

```lua
local repo = app.integrations["hugging-face"].create_repo({
  name = "demo-space",
  type = "space",
  private = true,
  sdk = "gradio"
})
```

## Inference

`inference` sends requests to the configured serverless model router. The response shape depends on the model task.

```lua
local result = app.integrations["hugging-face"].inference({
  model_id = "facebook/bart-large-cnn",
  inputs = "Long text to summarize...",
  parameters = {
    max_new_tokens = 128
  }
})
```

## Generic Hub API Calls

Use `api_get`, `api_post`, `api_put`, and `api_delete` for official relative Hub API paths that are not wrapped yet. Absolute URLs are rejected; pass paths such as `/models-tags-by-type`, not full URLs.

```lua
local tags = app.integrations["hugging-face"].api_get({
  path = "/models-tags-by-type"
})
```

## Account

`get_current_user` calls the current `/whoami-v2` endpoint and returns the authenticated account metadata.
