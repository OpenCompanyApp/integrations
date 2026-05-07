# Groq Lua API Reference

Groq exposes OpenAI-compatible inference endpoints plus Groq-specific batch, file, and closed-beta fine-tuning APIs.

Namespace: `app.integrations["groq"]`

## Common Usage

Use chat completions for normal conversational requests:

```lua
local result = app.integrations["groq"].create_completion({
  model = "llama-3.3-70b-versatile",
  messages = {
    { role = "system", content = "You are concise." },
    { role = "user", content = "Summarize this paragraph." }
  },
  temperature = 0.2,
  max_tokens = 120
})

print(result.choices[1].message.content)
```

Use payload-based tools when the upstream endpoint has a richer request body:

```lua
local response = app.integrations["groq"].create_response({
  payload = {
    model = "openai/gpt-oss-20b",
    input = "Draft a release note."
  }
})

local transcription = app.integrations["groq"].create_transcription({
  payload = {
    model = "whisper-large-v3",
    url = "https://example.test/audio/sample.wav",
    response_format = "json"
  }
})
```

For local audio or batch file uploads, use `file_path` inside the payload or as the file upload argument. The path must be readable by the host running the integration.

## Tool Groups

### Models and Inference

- `list_models({})`
- `get_model({ model = "llama-3.3-70b-versatile" })`
- `create_completion({ model = "...", messages = {...}, temperature = 0.2 })`
- `create_response({ payload = {...} })`

### Audio

- `create_transcription({ payload = { model = "whisper-large-v3", url = "https://example.test/audio.wav" } })`
- `create_translation({ payload = { model = "whisper-large-v3", file_path = "/tmp/audio.wav" } })`
- `create_speech({ payload = { model = "playai-tts", voice = "...", input = "Text to speak" } })`

Speech and downloaded file content may return non-JSON bodies as:

```lua
{
  content_type = "audio/wav",
  body_base64 = "..."
}
```

### Batches and Files

- `upload_file({ file_path = "/tmp/batch.jsonl", purpose = "batch" })`
- `list_files({ purpose = "batch" })`
- `get_file({ file_id = "file_123" })`
- `download_file({ file_id = "file_123" })`
- `delete_file({ file_id = "file_123" })`
- `create_batch({ payload = { input_file_id = "file_123", endpoint = "/v1/chat/completions", completion_window = "24h" } })`
- `list_batches({ query = { limit = 20 } })`
- `get_batch({ batch_id = "batch_123" })`
- `cancel_batch({ batch_id = "batch_123" })`

### Fine Tuning

Groq fine tuning is a closed beta API. These tools expose the documented endpoints, but accounts without access will receive Groq API authorization or availability errors.

- `list_fine_tunings({})`
- `create_fine_tuning({ payload = { input_file_id = "file_123", name = "test-1", type = "lora", base_model = "llama-3.1-8b-instant" } })`
- `get_fine_tuning({ id = "fine_tune_123" })`
- `delete_fine_tuning({ id = "fine_tune_123" })`

## Removed Legacy Assumptions

The previous package exposed conversation message and current-user tools for endpoints that are not documented in Groq's current API reference. They are no longer registered in the provider. Use chat completions or responses with explicit message history, and use `list_models` for a lightweight credential check.

## Return Shapes

Most tools return Groq's decoded JSON response unchanged so agents can access endpoint-specific fields like `choices`, `usage`, `data`, `request_counts`, file metadata, and fine-tuning job objects.

## Multi-Account Usage

```lua
app.integrations["groq"].list_models({})
app.integrations["groq"].default.list_models({})
app.integrations["groq"].work.list_models({})
```

All accounts expose the same tool names. Only credentials and optional base URL differ.
