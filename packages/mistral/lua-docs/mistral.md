# Mistral AI

Namespace: `mistral`

Mistral AI provides language models, agents, conversations, OCR, files,
fine-tuning, batch inference, audio, and document libraries. This integration
uses the Mistral REST API with `Authorization: Bearer <api_key>`.

Default API URL: `https://api.mistral.ai`

## Usage notes

- Write endpoints accept a `body` object that matches the official Mistral API
  request schema. This keeps the tools aligned with the current OpenAPI spec as
  fields change.
- List endpoints accept a `query` object for pagination and filters.
- Multipart endpoints use `file_path` plus optional `body` fields:
  `mistral_upload_file` and `mistral_upload_library_document`.
- Binary responses such as generated speech, file downloads, and voice samples
  are returned as a `body` string with `content_type` and `status` metadata when
  the API does not return JSON.
- Stream-style endpoints are exposed as normal request/response tools that
  return the response body. Hosts that need incremental streaming should wrap
  those endpoints with a streaming transport outside the Lua bridge.

## Core inference

- `mistral_list_models`, `mistral_retrieve_model`, `mistral_delete_model`
- `mistral_chat_completions`, `mistral_fim_completions`,
  `mistral_agents_completions`
- `mistral_embeddings`
- `mistral_moderations`, `mistral_chat_moderations`
- `mistral_ocr`
- `mistral_classifications`, `mistral_chat_classifications`

## Agents and conversations

- `mistral_start_conversation`, `mistral_list_conversations`,
  `mistral_get_conversation`, `mistral_delete_conversation`,
  `mistral_append_conversation`, `mistral_conversation_history`,
  `mistral_conversation_messages`, `mistral_restart_conversation`
- `mistral_create_agent`, `mistral_list_agents`, `mistral_get_agent`,
  `mistral_update_agent`, `mistral_delete_agent`,
  `mistral_update_agent_version`, `mistral_list_agent_versions`,
  `mistral_get_agent_version`, `mistral_upsert_agent_alias`,
  `mistral_list_agent_aliases`, `mistral_delete_agent_alias`

## Files, fine-tuning, and batch

- `mistral_upload_file`, `mistral_list_files`, `mistral_retrieve_file`,
  `mistral_delete_file`, `mistral_download_file`, `mistral_get_file_url`
- `mistral_list_fine_tuning_jobs`, `mistral_create_fine_tuning_job`,
  `mistral_get_fine_tuning_job`, `mistral_cancel_fine_tuning_job`,
  `mistral_start_fine_tuning_job`, `mistral_update_fine_tuned_model`,
  `mistral_archive_fine_tuned_model`, `mistral_unarchive_fine_tuned_model`
- `mistral_list_batch_jobs`, `mistral_create_batch_job`,
  `mistral_get_batch_job`, `mistral_cancel_batch_job`

## Audio and libraries

- `mistral_transcribe_audio`, `mistral_speech`
- `mistral_list_voices`, `mistral_create_voice`, `mistral_get_voice`,
  `mistral_update_voice`, `mistral_delete_voice`, `mistral_get_voice_sample`
- `mistral_list_libraries`, `mistral_create_library`, `mistral_get_library`,
  `mistral_update_library`, `mistral_delete_library`
- `mistral_list_library_documents`, `mistral_upload_library_document`,
  `mistral_get_library_document`, `mistral_update_library_document`,
  `mistral_delete_library_document`, `mistral_get_library_document_text`,
  `mistral_get_library_document_status`,
  `mistral_get_library_document_signed_url`,
  `mistral_get_library_document_extracted_text_url`,
  `mistral_reprocess_library_document`
- `mistral_list_library_shares`, `mistral_create_library_share`,
  `mistral_delete_library_share`

## Observability and workflows

- Chat completion event search, ID search, event lookup, similar events, field
  lookup, field option lookup, option counting, and live event judging.
- Judges: create, list, get, update, delete, and live judging.
- Campaigns: create, list, get, delete, status, and selected events.
- Observability datasets: create, list, get, update, delete, records, imports,
  JSONL export, import task lookup, record lookup, bulk delete, live judging,
  payload update, and property update.
- Workflows: executions, history, signals, queries, terminate/cancel/reset,
  trace endpoints, event streams, metrics, runs, schedules, deployments,
  registrations, execute, update, archive, and unarchive.

## Examples

Chat completion:

```lua
local response = mistral_chat_completions({
  body = {
    model = "mistral-small-latest",
    messages = {
      { role = "user", content = "Write a concise status update." }
    }
  }
})
```

OCR from a document URL:

```lua
local result = mistral_ocr({
  body = {
    model = "mistral-ocr-latest",
    document = {
      type = "document_url",
      document_url = "https://example.test/sample.pdf"
    }
  }
})
```

Upload a batch JSONL file:

```lua
local uploaded = mistral_upload_file({
  file_path = "/tmp/batch.jsonl",
  body = { purpose = "batch" }
})
```

Create a batch job:

```lua
local job = mistral_create_batch_job({
  body = {
    input_files = { "file-id" },
    endpoint = "/v1/chat/completions",
    model = "mistral-small-latest"
  }
})
```

Upload a library document:

```lua
local document = mistral_upload_library_document({
  library_id = "library-id",
  file_path = "/tmp/knowledge.pdf",
  body = { name = "Knowledge PDF" }
})
```

## Coverage notes

This package maps the current official OpenAPI REST surface into one operation
per tool, excluding duplicate documentation-only anchors where the spec repeats
the same path for streaming examples. High-risk workflow and observability write
tools are exposed because they are official API operations; configure host write
policies accordingly.
