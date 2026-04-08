# AssemblyAI — Lua API Reference

## transcribe

Submit an audio or video file URL for AI transcription.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `audio_url` | string | yes | URL of the audio/video file to transcribe, or an AssemblyAI upload URL |
| `language_code` | string | no | Language code (e.g., `"en_us"`, `"es"`, `"fr"`). Auto-detected if omitted |
| `speaker_labels` | boolean | no | Enable speaker diarization to identify who spoke when |
| `auto_chapters` | boolean | no | Automatically break the transcript into chapters |
| `entity_detection` | boolean | no | Detect entities (dates, locations, organizations) |
| `sentiment_analysis` | boolean | no | Analyze sentiment (positive, negative, neutral) per sentence |
| `summarization` | boolean | no | Generate a summary of the transcript |
| `punctuate` | boolean | no | Add punctuation to the transcript |
| `format_text` | boolean | no | Format text with capitalization and paragraphs |
| `webhook_url` | string | no | URL to receive a POST when the transcript completes |
| `custom_topics` | array | no | List of custom topics to detect |
| `topics` | array | no | Enable topic detection with built-in topics |

### Example

```lua
local result = app.integrations.assemblyai.transcribe({
  audio_url = "https://example.com/recording.mp3",
  speaker_labels = true,
  sentiment_analysis = true
})

print("Transcript ID: " .. result.id)
print("Status: " .. result.status)
-- Use assemblyai_get_transcript with the ID to retrieve results
```

---

## get_transcript

Retrieve a transcript by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The transcript ID returned by the transcribe tool |

### Example

```lua
local result = app.integrations.assemblyai.get_transcript({
  id = "abc123def456"
})

if result.status == "completed" then
  print("Text: " .. result.text)
  print("Confidence: " .. result.confidence)
elseif result.status == "processing" then
  print("Still processing. Try again in a few seconds.")
end
```

---

## list_transcripts

List transcripts with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results per page (default: 20, max: 200) |
| `status` | string | no | Filter by status: `"queued"`, `"processing"`, `"completed"`, `"error"` |
| `created_on` | string | no | Filter by creation date (e.g., `"gte:2025-01-01"`) |
| `before_id` | string | no | Pagination: return transcripts before this ID |
| `after_id` | string | no | Pagination: return transcripts after this ID |
| `throttled_only` | boolean | no | Only return throttled transcripts |

### Example

```lua
local result = app.integrations.assemblyai.list_transcripts({
  limit = 10,
  status = "completed"
})

for _, transcript in ipairs(result.page_details.transcripts_ids) do
  print("ID: " .. transcript)
end
```

---

## upload

Upload a local audio or video file. Returns a URL for use with the transcribe tool.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_path` | string | yes | Absolute path to the local file to upload |

### Example

```lua
local result = app.integrations.assemblyai.upload({
  file_path = "/tmp/recording.mp3"
})

-- Use the upload_url with the transcribe tool
local transcript = app.integrations.assemblyai.transcribe({
  audio_url = result.upload_url
})
print("Transcript ID: " .. transcript.id)
```

---

## get_lemons

Retrieve billing credits and usage information.

### Parameters

None.

### Example

```lua
local result = app.integrations.assemblyai.get_lemons({})

print("Credits remaining: " .. tostring(result.lemons_remaining))
```

---

## get_current_user

Get the authenticated user's profile and plan info.

### Parameters

None.

### Example

```lua
local result = app.integrations.assemblyai.get_current_user({})

print("Email: " .. result.email)
print("Plan: " .. (result.plan and result.plan.name or "unknown"))
```

---

## Multi-Account Usage

If you have multiple AssemblyAI accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.assemblyai.function_name({...})

-- Explicit default (portable across setups)
app.integrations.assemblyai.default.function_name({...})

-- Named accounts
app.integrations.assemblyai.work.function_name({...})
app.integrations.assemblyai.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
