# Cohere

Namespace: `cohere`

Cohere exposes AI models for chat, embeddings, reranking, tokenization, asynchronous embed jobs, datasets, audio transcription, and legacy classification.

## Common Usage

Use `cohere_chat` for non-streaming v2 Chat responses. The tool always sends `stream=false`; SSE streaming is intentionally unsupported in this integration because the host tool runtime expects JSON responses.

```lua
local response = cohere.chat({
  model = "command-a-03-2025",
  messages = {
    { role = "user", content = "Summarize the launch notes in one paragraph." }
  },
  max_tokens = 300
})
```

Use `cohere_embed` for v2 embeddings. Set `input_type` to match the downstream use case:

- `search_document` for indexed documents
- `search_query` for user queries
- `classification` for classifier features
- `clustering` for clustering workflows
- `image` for image inputs

```lua
local vectors = cohere.embed({
  model = "embed-v4.0",
  input_type = "search_document",
  texts = { "Shipping policy", "Refund policy" },
  embedding_types = { "float" }
})
```

Use `cohere_rerank` after retrieval to sort candidate documents by relevance.

```lua
local ranked = cohere.rerank({
  model = "rerank-v4.0-pro",
  query = "Where is billing history?",
  documents = {
    "Invoices are available in Account > Billing.",
    "API keys can be rotated in Settings."
  },
  top_n = 1
})
```

## Datasets And Embed Jobs

Create a dataset with `cohere_create_dataset`, then start a batch embedding run with `cohere_create_embed_job`. For embed jobs, Cohere expects a validated dataset of type `embed-input`.

```lua
local dataset = cohere.create_dataset({
  name = "docs",
  type = "embed-input",
  filename = "docs.jsonl",
  content = "{\"text\":\"Billing docs\"}\n"
})

local job = cohere.create_embed_job({
  model = "embed-english-v3.0",
  dataset_id = dataset.id,
  input_type = "search_document"
})
```

Poll with `cohere_get_embed_job`; completed jobs expose `output_dataset_id` in the normalized Cohere response. `cohere_cancel_embed_job` cancels active jobs, but Cohere may still bill for work already processed and partial results are not returned.

## Audio

`cohere_create_audio_transcription` sends multipart file content to v2 Audio Transcriptions. Provide the audio bytes through the host file-reading flow before calling the tool. Supported filename extensions include `flac`, `mp3`, `mpeg`, `mpga`, `ogg`, and `wav`.

## Models And Tokens

`cohere_list_models` supports `page_size`, `page_token`, `endpoint`, and `default_only`. Use `cohere_get_model` to inspect endpoint compatibility, deprecation state, context length, features, and sampling defaults.

`cohere_tokenize` and `cohere_detokenize` use the tokenizer for the provided model.

## Deprecated Classify

`cohere_classify` is exposed for compatibility, but Cohere marks v1 Classify as deprecated. Prefer chat or embedding-based classification for new workflows unless you are using an existing fine-tuned classify model.

## Return Shapes

The integration returns Cohere's JSON response shapes directly after successful calls. Common response fields include:

- Chat: `id`, `finish_reason`, `message`, `usage`
- Embed: `embeddings`, `texts` or image/mixed metadata, `meta`
- Rerank: `results`, each with `index` and `relevance_score`
- Models: `models` plus `next_page_token`, or a single model object
- Datasets: `datasets`, `dataset`, `id`, or `organization_usage`
- Embed jobs: `job_id`, `status`, `input_dataset_id`, `output_dataset_id`, `meta`
- Audio transcription: `text`

All examples use fake or generic data and are safe to publish.
