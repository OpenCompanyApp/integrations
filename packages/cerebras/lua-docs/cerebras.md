# Cerebras

Namespace: `cerebras`

Cerebras provides ultra-fast OpenAI-compatible inference plus preview APIs for
batches, files, metrics, and dedicated endpoint/model management.

Default API URL: `https://api.cerebras.ai`

Metrics use the documented Cloud URL:
`https://cloud.cerebras.ai/api/v1/metrics/organizations/{organization_id}`.

## Usage notes

- `cerebras_chat_completions` and `cerebras_completions` accept a `body` object
  matching the Cerebras API schema.
- Batch tools map `/v1/batches` and currently support the documented
  `/v1/chat/completions` batch endpoint.
- File upload uses `file_path` plus optional multipart `body` fields such as
  `purpose`.
- Public model tools do not require path account IDs and support optional
  `query.format` values such as `openrouter` or `huggingface`.
- Dedicated endpoint management tools use `/management/v1/...` paths and are
  intended for accounts with the preview management API enabled.

## Tools

- `cerebras_chat_completions`, `cerebras_completions`
- `cerebras_list_models`, `cerebras_retrieve_model`
- `cerebras_list_public_models`, `cerebras_retrieve_public_model`
- `cerebras_create_batch`, `cerebras_list_batches`,
  `cerebras_retrieve_batch`, `cerebras_cancel_batch`
- `cerebras_upload_file`, `cerebras_list_files`, `cerebras_retrieve_file`,
  `cerebras_retrieve_file_content`, `cerebras_delete_file`
- `cerebras_retrieve_metrics`
- `cerebras_list_model_architectures`, `cerebras_list_model_versions`,
  `cerebras_upload_model_version`, `cerebras_retrieve_model_version_status`,
  `cerebras_delete_model_version`, `cerebras_update_model_version_aliases`
- `cerebras_list_endpoints`, `cerebras_retrieve_endpoint_status`,
  `cerebras_deploy_model_to_endpoint`

## Examples

Chat completion:

```lua
local response = cerebras_chat_completions({
  body = {
    model = "gpt-oss-120b",
    messages = {
      { role = "user", content = "Write a short release note." }
    }
  }
})
```

List public models in OpenRouter format:

```lua
local models = cerebras_list_public_models({
  query = { format = "openrouter" }
})
```

Upload a batch file:

```lua
local uploaded = cerebras_upload_file({
  file_path = "/tmp/cerebras-batch.jsonl",
  body = { purpose = "batch" }
})
```

Retrieve endpoint metrics:

```lua
local metrics = cerebras_retrieve_metrics({
  organization_id = "org_abc123"
})
```

## Coverage notes

This package covers the endpoint inventory published in the Cerebras docs index
at implementation time: inference, completions, models, public models, batch,
files, metrics, and the customer management OpenAPI spec. Non-endpoint guide
pages such as authentication, versions, capabilities, and cookbooks are covered
by docs, not executable tools.
