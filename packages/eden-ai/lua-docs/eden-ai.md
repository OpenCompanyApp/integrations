# Eden AI — Lua API Reference

## generate_text

Generate text using AI models through Eden AI.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `providers` | string | yes | Comma-separated providers (e.g., `"openai"`, `"openai,anthropic"`) |
| `text` | string | no* | Prompt text for single-turn generation |
| `conversation` | array | no* | Multi-turn conversation with `{role, message}` objects |
| `temperature` | number | no | Sampling temperature (0.0–1.0), default 0.0 |
| `max_tokens` | integer | no | Maximum tokens in response |
| `fallback_providers` | string | no | Comma-separated fallback providers |

*Either `text` or `conversation` is required.

### Available Providers

`openai`, `anthropic`, `google`, `mistral`, `cohere`, `meta`

### Examples

#### Simple text generation

```lua
local result = app.integrations["eden-ai"].generate_text({
  providers = "openai",
  text = "Explain quantum computing in one paragraph.",
  temperature = 0.7,
  max_tokens = 256
})

for _, r in ipairs(result.results) do
  print(r.provider .. ": " .. r.text)
end
```

#### Multi-provider generation

```lua
local result = app.integrations["eden-ai"].generate_text({
  providers = "openai,anthropic",
  text = "Write a haiku about programming.",
  temperature = 0.8
})
```

#### Multi-turn conversation

```lua
local result = app.integrations["eden-ai"].generate_text({
  providers = "openai",
  conversation = {
    { role = "system", message = "You are a helpful coding assistant." },
    { role = "user", message = "How do I sort a table in Lua?" }
  }
})
```

---

## analyze_image

Analyze images for content, objects, and features.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `providers` | string | yes | Comma-separated providers (e.g., `"google"`) |
| `image_url` | string | no* | URL of the image to analyze |
| `image_base64` | string | no* | Base64-encoded image data |
| `features` | array | no | Analysis features to request |
| `fallback_providers` | string | no | Comma-separated fallback providers |

*Either `image_url` or `image_base64` is required.

### Example

```lua
local result = app.integrations["eden-ai"].analyze_image({
  providers = "google",
  image_url = "https://example.com/photo.jpg",
  features = { "explicit_content", "object_detection" }
})
```

---

## translate_text

Translate text between languages.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `providers` | string | yes | Comma-separated providers (e.g., `"google"`, `"deepl"`) |
| `text` | string | yes | Text to translate |
| `target_language` | string | yes | Target language code (e.g., `"fr"`, `"de"`, `"ja"`) |
| `source_language` | string | no | Source language code. Omit to auto-detect. |
| `fallback_providers` | string | no | Comma-separated fallback providers |

### Example

```lua
local result = app.integrations["eden-ai"].translate_text({
  providers = "google",
  text = "Hello, world!",
  target_language = "fr"
})

for _, r in ipairs(result.results) do
  print(r.provider .. ": " .. r.translation)
end
```

---

## transcribe_audio

Convert audio or video to text.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `providers` | string | yes | Comma-separated providers (e.g., `"openai"`) |
| `audio_url` | string | no* | URL of the audio file |
| `audio_base64` | string | no* | Base64-encoded audio data |
| `language` | string | no | Language code. Omit for auto-detection. |
| `speakers` | integer | no | Number of speakers for diarization |
| `fallback_providers` | string | no | Comma-separated fallback providers |

*Either `audio_url` or `audio_base64` is required.

### Example

```lua
local result = app.integrations["eden-ai"].transcribe_audio({
  providers = "openai",
  audio_url = "https://example.com/recording.mp3",
  language = "en"
})

for _, r in ipairs(result.results) do
  print(r.provider .. ": " .. r.transcription)
end
```

---

## ocr

Extract text from images and documents. This is an asynchronous operation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `providers` | string | yes | Comma-separated providers (e.g., `"google"`) |
| `document_url` | string | no* | URL of the document to process |
| `document_base64` | string | no* | Base64-encoded document data |
| `language` | string | no | Language hint for better accuracy |
| `fallback_providers` | string | no | Comma-separated fallback providers |

*Either `document_url` or `document_base64` is required.

### Example

```lua
local result = app.integrations["eden-ai"].ocr({
  providers = "google",
  document_url = "https://example.com/invoice.pdf"
})

-- Async: returns a job ID
print("Job ID: " .. result.jobId)
print("Status: " .. result.status)
```

---

## get_current_user

Get the authenticated user's account information.

### Parameters

None.

### Example

```lua
local result = app.integrations["eden-ai"].get_current_user({})
print("Email: " .. result.email)
print("Plan: " .. (result.plan or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Eden AI accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["eden-ai"].generate_text({...})

-- Explicit default (portable across setups)
app.integrations["eden-ai"].default.generate_text({...})

-- Named accounts
app.integrations["eden-ai"].work.generate_text({...})
app.integrations["eden-ai"].personal.generate_text({...})
```

All functions are identical across accounts — only the credentials differ.
