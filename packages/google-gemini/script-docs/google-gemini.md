# Google Gemini

Google Gemini tools are exposed under `app.integrations.google_gemini`. This package is generated from Google's official Gemini API v1beta Discovery document and exposes 79 REST methods.

## Coverage

- Source: `https://generativelanguage.googleapis.com/$discovery/rest?version=v1beta`
- Read tools: 29
- Write tools: 50
- Media upload tools: 2
- Base URL: `https://generativelanguage.googleapis.com`

## Usage Notes

Pass resource names such as `models/gemini-2.5-pro`, `files/...`, `cachedContents/...`, `tunedModels/...`, `corpora/...`, or `fileSearchStores/...` exactly as Google documents them. Path parameters using `{+name}`, `{+model}`, `{+parent}`, or `{+fileSearchStoreName}` preserve slash-delimited resource names. Request bodies go inside `body`. Upload endpoints accept `file_path`, optional `mime_type`, and optional metadata in `body`; the integration sends multipart upload requests with `uploadType=multipart`.

Streaming endpoints are exposed as ordinary POST tools and return the HTTP JSON response shape available to the host HTTP client; hosts that need incremental streaming should wrap those endpoints separately.

## Tools

- `google_gemini_cached_contents_patch` - PATCH /v1beta/{+name}
- `google_gemini_cached_contents_create` - POST /v1beta/cachedContents
- `google_gemini_cached_contents_get` - GET /v1beta/{+name}
- `google_gemini_cached_contents_list` - GET /v1beta/cachedContents
- `google_gemini_cached_contents_delete` - DELETE /v1beta/{+name}
- `google_gemini_file_search_stores_create` - POST /v1beta/fileSearchStores
- `google_gemini_file_search_stores_get` - GET /v1beta/{+name}
- `google_gemini_file_search_stores_delete` - DELETE /v1beta/{+name}
- `google_gemini_file_search_stores_import_file` - POST /v1beta/{+fileSearchStoreName}:importFile
- `google_gemini_file_search_stores_list` - GET /v1beta/fileSearchStores
- `google_gemini_file_search_stores_operations_get` - GET /v1beta/{+name}
- `google_gemini_file_search_stores_documents_delete` - DELETE /v1beta/{+name}
- `google_gemini_file_search_stores_documents_get` - GET /v1beta/{+name}
- `google_gemini_file_search_stores_documents_list` - GET /v1beta/{+parent}/documents
- `google_gemini_file_search_stores_upload_operations_get` - GET /v1beta/{+name}
- `google_gemini_batches_cancel` - POST /v1beta/{+name}:cancel
- `google_gemini_batches_get` - GET /v1beta/{+name}
- `google_gemini_batches_list` - GET /v1beta/{+name}
- `google_gemini_batches_delete` - DELETE /v1beta/{+name}
- `google_gemini_batches_update_generate_content_batch` - PATCH /v1beta/{+name}:updateGenerateContentBatch
- `google_gemini_batches_update_embed_content_batch` - PATCH /v1beta/{+name}:updateEmbedContentBatch
- `google_gemini_dynamic_stream_generate_content` - POST /v1beta/{+model}:streamGenerateContent
- `google_gemini_dynamic_generate_content` - POST /v1beta/{+model}:generateContent
- `google_gemini_media_upload` - POST /v1beta/files (media upload)
- `google_gemini_media_upload_to_file_search_store` - POST /v1beta/{+fileSearchStoreName}:uploadToFileSearchStore (media upload)
- `google_gemini_corpora_list` - GET /v1beta/corpora
- `google_gemini_corpora_create` - POST /v1beta/corpora
- `google_gemini_corpora_get` - GET /v1beta/{+name}
- `google_gemini_corpora_delete` - DELETE /v1beta/{+name}
- `google_gemini_corpora_operations_get` - GET /v1beta/{+name}
- `google_gemini_corpora_permissions_delete` - DELETE /v1beta/{+name}
- `google_gemini_corpora_permissions_list` - GET /v1beta/{+parent}/permissions
- `google_gemini_corpora_permissions_create` - POST /v1beta/{+parent}/permissions
- `google_gemini_corpora_permissions_get` - GET /v1beta/{+name}
- `google_gemini_corpora_permissions_patch` - PATCH /v1beta/{+name}
- `google_gemini_files_register` - POST /v1beta/files:register
- `google_gemini_files_list` - GET /v1beta/files
- `google_gemini_files_get` - GET /v1beta/{+name}
- `google_gemini_files_delete` - DELETE /v1beta/{+name}
- `google_gemini_tuned_models_stream_generate_content` - POST /v1beta/{+model}:streamGenerateContent
- `google_gemini_tuned_models_batch_generate_content` - POST /v1beta/{+model}:batchGenerateContent
- `google_gemini_tuned_models_get` - GET /v1beta/{+name}
- `google_gemini_tuned_models_create` - POST /v1beta/tunedModels
- `google_gemini_tuned_models_list` - GET /v1beta/tunedModels
- `google_gemini_tuned_models_generate_text` - POST /v1beta/{+model}:generateText
- `google_gemini_tuned_models_delete` - DELETE /v1beta/{+name}
- `google_gemini_tuned_models_patch` - PATCH /v1beta/{+name}
- `google_gemini_tuned_models_async_batch_embed_content` - POST /v1beta/{+model}:asyncBatchEmbedContent
- `google_gemini_tuned_models_generate_content` - POST /v1beta/{+model}:generateContent
- `google_gemini_tuned_models_transfer_ownership` - POST /v1beta/{+name}:transferOwnership
- `google_gemini_tuned_models_operations_list` - GET /v1beta/{+name}/operations
- `google_gemini_tuned_models_operations_get` - GET /v1beta/{+name}
- `google_gemini_tuned_models_permissions_delete` - DELETE /v1beta/{+name}
- `google_gemini_tuned_models_permissions_list` - GET /v1beta/{+parent}/permissions
- `google_gemini_tuned_models_permissions_create` - POST /v1beta/{+parent}/permissions
- `google_gemini_tuned_models_permissions_get` - GET /v1beta/{+name}
- `google_gemini_tuned_models_permissions_patch` - PATCH /v1beta/{+name}
- `google_gemini_models_generate_content` - POST /v1beta/{+model}:generateContent
- `google_gemini_models_generate_message` - POST /v1beta/{+model}:generateMessage
- `google_gemini_models_predict` - POST /v1beta/{+model}:predict
- `google_gemini_models_embed_content` - POST /v1beta/{+model}:embedContent
- `google_gemini_models_list` - GET /v1beta/models
- `google_gemini_models_batch_embed_text` - POST /v1beta/{+model}:batchEmbedText
- `google_gemini_models_async_batch_embed_content` - POST /v1beta/{+model}:asyncBatchEmbedContent
- `google_gemini_models_count_message_tokens` - POST /v1beta/{+model}:countMessageTokens
- `google_gemini_models_count_tokens` - POST /v1beta/{+model}:countTokens
- `google_gemini_models_predict_long_running` - POST /v1beta/{+model}:predictLongRunning
- `google_gemini_models_generate_text` - POST /v1beta/{+model}:generateText
- `google_gemini_models_count_text_tokens` - POST /v1beta/{+model}:countTextTokens
- `google_gemini_models_embed_text` - POST /v1beta/{+model}:embedText
- `google_gemini_models_generate_answer` - POST /v1beta/{+model}:generateAnswer
- `google_gemini_models_batch_embed_contents` - POST /v1beta/{+model}:batchEmbedContents
- `google_gemini_models_stream_generate_content` - POST /v1beta/{+model}:streamGenerateContent
- `google_gemini_models_batch_generate_content` - POST /v1beta/{+model}:batchGenerateContent
- `google_gemini_models_get` - GET /v1beta/{+name}
- `google_gemini_models_operations_get` - GET /v1beta/{+name}
- `google_gemini_models_operations_list` - GET /v1beta/{+name}/operations
- `google_gemini_generated_files_list` - GET /v1beta/generatedFiles
- `google_gemini_generated_files_operations_get` - GET /v1beta/{+name}

## Examples

```js
var response = app.integrations.google_gemini.google_gemini_models_generate_content({
  model: "models/gemini-2.5-pro",
  body: { contents: [ { parts: [ { text: "Write a concise summary" } ] } ] },
})

var models = app.integrations.google_gemini.google_gemini_models_list({ pageSize: 10 })
```
Responses are decoded Gemini API JSON responses, or `{ success = true, status = ... }` for successful empty responses.
