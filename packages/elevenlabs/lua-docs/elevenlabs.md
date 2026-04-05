# ElevenLabs — Lua API Reference

## text_to_speech

Convert text to speech audio using an ElevenLabs voice.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `voice_id` | string | yes | Voice identifier (use `list_voices` to discover) |
| `text` | string | yes | The text to convert to speech |
| `model_id` | string | no | Model ID (default: `"eleven_multilingual_v2"`) |
| `stability` | number | no | Voice stability 0.0–1.0 (higher = less random) |
| `similarity_boost` | number | no | Voice similarity 0.0–1.0 (higher = more like original) |
| `style` | number | no | Style exaggeration 0.0–1.0 |
| `use_speaker_boost` | boolean | no | Enable speaker boost for enhanced clarity |

### Common Model IDs

| Model ID | Description |
|----------|-------------|
| `eleven_multilingual_v2` | Multilingual v2 (default, 29 languages) |
| `eleven_turbo_v2_5` | Turbo v2.5 (low latency, English) |
| `eleven_monolingual_v1` | Monolingual v1 (English only) |
| `eleven_turbo_v2` | Turbo v2 (low latency) |

### Response

Returns a table with `audio` (base64-encoded audio, content type, and size) and a human-readable `message`.

### Example

```lua
local result = app.integrations.elevenlabs.text_to_speech({
  voice_id = "21m00Tcm4TlvDq8ikWAM",
  text = "Hello! Welcome to our application.",
  model_id = "eleven_multilingual_v2",
  stability = 0.5,
  similarity_boost = 0.75
})

print(result.message)
-- "Generated 24576 bytes of audio (audio/mpeg) using voice 21m00Tcm4TlvDq8ikWAM and model eleven_multilingual_v2."
```

---

## list_voices

List all available voices in your ElevenLabs account.

### Parameters

None.

### Example

```lua
local result = app.integrations.elevenlabs.list_voices({})

for _, voice in ipairs(result.voices) do
  print(voice.name .. " (" .. voice.voice_id .. ") — " .. voice.category)
end
```

---

## get_voice

Get detailed information about a specific voice.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `voice_id` | string | yes | The voice identifier |

### Example

```lua
local result = app.integrations.elevenlabs.get_voice({
  voice_id = "21m00Tcm4TlvDq8ikWAM"
})

print(result.name)
print(result.category)
```

---

## create_voice

Create a new cloned voice.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name for the new voice |
| `files` | array | no | Audio sample file paths or base64-encoded audio strings |
| `description` | string | no | Optional description of the voice |

### Example

```lua
local result = app.integrations.elevenlabs.create_voice({
  name = "My Custom Voice",
  description = "Warm female narrator",
  files = { "/path/to/sample1.mp3", "/path/to/sample2.mp3" }
})

print(result.message)
-- "Voice 'My Custom Voice' created successfully."
```

---

## delete_voice

Permanently delete a voice. This action cannot be undone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `voice_id` | string | yes | The voice identifier to delete |

### Example

```lua
local result = app.integrations.elevenlabs.delete_voice({
  voice_id = "abc123def456"
})

print(result)
-- "Voice 'abc123def456' has been deleted."
```

---

## get_models

List all available text-to-speech models.

### Parameters

None.

### Example

```lua
local result = app.integrations.elevenlabs.get_models({})

for _, model in ipairs(result.models) do
  print(model.model_id .. " — " .. model.name)
end
```

---

## get_history

Browse your generation history with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Items per page (default: 20, max: 100) |
| `start_after` | integer | no | History item ID to start after (cursor) |

### Example

```lua
-- First page
local result = app.integrations.elevenlabs.get_history({
  page_size = 10
})

for _, item in ipairs(result.history) do
  print(item.text .. " — " .. item.voice_name)
end

-- Next page
if result.hasMore then
  local next = app.integrations.elevenlabs.get_history({
    page_size = 10,
    start_after = result.last_history_item_id
  })
end
```

---

## get_current_user

Get your ElevenLabs account details including subscription and usage.

### Parameters

None.

### Example

```lua
local result = app.integrations.elevenlabs.get_current_user({})

print(result.first_name)
print(result.subscription.tier)
print(result.subscription.character_count .. " / " .. result.subscription.character_limit .. " characters used")
```

---

## Multi-Account Usage

If you have multiple ElevenLabs accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.elevenlabs.function_name({...})

-- Explicit default (portable across setups)
app.integrations.elevenlabs.default.function_name({...})

-- Named accounts
app.integrations.elevenlabs.production.function_name({...})
app.integrations.elevenlabs.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
