# Fireworks AI

Namespace: `fireworks-ai`

Fireworks AI provides OpenAI-compatible inference, Anthropic-compatible
messages, responses, embeddings, reranking, image generation workflows, account
management, datasets, models, deployments, LoRAs, fine-tuning, batch inference,
evaluations, users, API keys, quotas, and secrets.

Default API root: `https://api.fireworks.ai`

## Usage notes

- The tools map the current API reference pages from the official Fireworks docs
  index. Each tool corresponds to one documented operation.
- Inference tools use paths under `/inference/v1`, for example
  `fireworks_ai_chat_completions`, `fireworks_ai_completions`,
  `fireworks_ai_create_response`, `fireworks_ai_create_embeddings`, and
  `fireworks_ai_rerank_documents`.
- Management tools use paths under `/v1/accounts/...` and usually require
  `account_id` plus the relevant resource ID.
- Write tools accept a `body` object that matches the official Fireworks API
  schema for that endpoint.
- List and get tools accept an optional `query` object for documented query
  parameters such as pagination.
- Streaming responses are returned as normal HTTP response bodies. Hosts that
  need token-by-token streaming should wrap the endpoint with a streaming
  transport outside the Lua bridge.

## Common tools

- `fireworks_ai_chat_completions`
- `fireworks_ai_completions`
- `fireworks_ai_create_response`
- `fireworks_ai_create_embeddings`
- `fireworks_ai_rerank_documents`
- `fireworks_ai_anthropic_messages`
- `fireworks_ai_generate_a_new_image_from_a_text_prompt`
- `fireworks_ai_generate_or_edit_image_using_flux_kontext`
- `fireworks_ai_get_generated_image_from_flux_kontex`
- `fireworks_ai_list_models`
- `fireworks_ai_create_supervised_fine_tuning_job`
- `fireworks_ai_create_reinforcement_fine_tuning_job`
- `fireworks_ai_create_batch_inference_job`
- `fireworks_ai_create_deployment`
- `fireworks_ai_create_dataset`

## Examples

Chat completion:

```lua
local response = fireworks_ai_chat_completions({
  body = {
    model = "accounts/fireworks/models/deepseek-v3p1",
    messages = {
      { role = "user", content = "Write a concise changelog entry." }
    }
  }
})
```

Create embeddings:

```lua
local embeddings = fireworks_ai_create_embeddings({
  body = {
    model = "nomic-ai/nomic-embed-text-v1.5",
    input = { "hello", "world" }
  }
})
```

List account models:

```lua
local models = fireworks_ai_list_models({
  account_id = "example-account",
  query = { page_size = 20 }
})
```

Create a dataset:

```lua
local dataset = fireworks_ai_create_dataset({
  account_id = "example-account",
  body = {
    datasetId = "example-dataset",
    dataset = {
      displayName = "Example dataset"
    }
  }
})
```

## Coverage notes

This package covers the API reference pages published in the official Fireworks
docs index at implementation time, excluding the non-endpoint introduction page.
Tool names are normalized for common inference operations while preserving the
documented HTTP method and path internally.
