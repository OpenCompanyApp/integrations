# Voyage AI — JavaScript API Reference

The `voyage-ai` integration exposes Voyage AI's official inference, files, and batch APIs for retrieval workflows.

Use it for text embeddings, contextualized chunk embeddings, multimodal embeddings, reranking, batch input/output files, and long-running batch inference jobs. Responses are returned in Voyage AI's native JSON shape unless the endpoint returns raw file content.

## create_embedding

Create text embeddings.

Required parameters:

- `input`: string or string array.
- `model`: model name, such as `voyage-4`, `voyage-4-large`, `voyage-4-lite`, or `voyage-code-3`.

Optional parameters:

- `input_type`: `query` or `document`.
- `truncation`: boolean.
- `output_dimension`: integer.
- `output_dtype`: `float`, `int8`, `uint8`, `binary`, or `ubinary`.
- `encoding_format`: `base64`.

```js
var result = app.integrations["voyage-ai"].create_embedding({
  input: ["Install guide", "API reference"],
  model: "voyage-4",
  input_type: "document",
  output_dimension: 1024,
})
```
## create_contextualized_embeddings

Create embeddings where chunks in each inner list are encoded with context from neighboring chunks.

Required parameters:

- `inputs`: array of string arrays.
- `model`: usually `voyage-context-3`.

Optional parameters: `input_type`, `output_dimension`, `output_dtype`, `encoding_format`.

```js
var result = app.integrations["voyage-ai"].create_contextualized_embeddings({
  inputs: [
    ["Intro chunk", "Setup chunk", "API chunk"]
  ],
  model: "voyage-context-3",
  input_type: "document",
})
```
## create_multimodal_embeddings

Create embeddings from interleaved text, image, and video content blocks.

Required parameters:

- `inputs`: array of objects with `content` arrays.
- `model`: usually `voyage-multimodal-3.5`.

Optional parameters: `input_type`, `truncation`, `output_encoding`.

```js
var result = app.integrations["voyage-ai"].create_multimodal_embeddings({
  model: "voyage-multimodal-3.5",
  inputs: [
    {
      content: [
        {type: "text", text: "This is a product screenshot."},
        {type: "image_url", image_url: "https://example.test/screenshot.png"}
      ]
    }
  ]
})
```
For URL-based image or video inputs, Voyage applies URL safety constraints such as redirect limits, required content-length headers, and robots.txt handling.

## rerank

Rerank documents for a query.

Required parameters:

- `query`: query string.
- `documents`: array of document strings.
- `model`: usually `rerank-2.5` or `rerank-2.5-lite`.

Optional parameters:

- `top_k`: number of results to return.
- `return_documents`: include document text in each result.
- `truncation`: boolean.

```js
var ranked = app.integrations["voyage-ai"].rerank({
  query: "How do I upload files?",
  documents: ["Use the Files API.", "Use the Billing API."],
  model: "rerank-2.5",
  top_k: 1,
  return_documents: true,
})
```
## upload_file

Upload JSONL content for the Batch API. `purpose` must be `batch`.

```js
var file = app.integrations["voyage-ai"].upload_file({
  filename: "batch-input.jsonl",
  content: '{"custom_id":"row-1","body":{"input":"hello"}}' + "\n",
  purpose: "batch",
})
```
## list_files

List files with optional `purpose`, `limit`, `order`, and `after`.

```js
var files = app.integrations["voyage-ai"].list_files({
  purpose: "batch",
  limit: 20,
  order: "desc",
})
```
## retrieve_file

Retrieve file metadata by `file_id`.

```js
var file = app.integrations["voyage-ai"].retrieve_file({
  file_id: "file_abc123",
})
```
## retrieve_file_content

Retrieve file content, usually batch output or error JSONL.

```js
var content = app.integrations["voyage-ai"].retrieve_file_content({
  file_id: "file_output123",
  accept: "text/plain",
})
```
## delete_file

Delete one file by `file_id`.

```js
app.integrations["voyage-ai"].delete_file({
  file_id: "file_abc123",
})
```
## bulk_delete_files

Delete multiple files atomically. Voyage requires every ID to be valid or none are deleted.

```js
app.integrations["voyage-ai"].bulk_delete_files({
  file_ids: ["file_abc123", "file_def456"],
})
```
## create_batch

Create a batch inference job. Supported `endpoint` values are `v1/embeddings`, `v1/contextualizedembeddings`, and `v1/rerank`. `completion_window` must currently be `12h`.

```js
var batch = app.integrations["voyage-ai"].create_batch({
  endpoint: "v1/embeddings",
  input_file_id: "file_abc123",
  completion_window: "12h",
  request_params: {
    model: "voyage-4",
    input_type: "document",
  },
  metadata: {
    corpus: "docs",
  }
})
```
## list_batches

List batch jobs with optional `limit` and `after`.

```js
var batches = app.integrations["voyage-ai"].list_batches({
  limit: 20,
})
```
## retrieve_batch

Retrieve a batch job by `batch_id`. Completed batches include output and error file IDs when available.

```js
var batch = app.integrations["voyage-ai"].retrieve_batch({
  batch_id: "batch_abc123",
})
```
## cancel_batch

Cancel a validating or in-progress batch job.

```js
app.integrations["voyage-ai"].cancel_batch({
  batch_id: "batch_abc123",
})
```
## Multi-Account Usage

If multiple Voyage AI accounts are configured, use account-specific namespaces:

```js
app.integrations["voyage-ai"].create_embedding({ /* parameters */ })
app.integrations["voyage-ai"].default.create_embedding({ /* parameters */ })
app.integrations["voyage-ai"].research.create_embedding({ /* parameters */ })
```