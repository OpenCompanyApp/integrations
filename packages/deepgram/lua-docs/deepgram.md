# Deepgram

Namespace: `deepgram`

Deepgram provides speech-to-text, text intelligence, text-to-speech, and management APIs. This integration uses `Authorization: Token <API_KEY>` and defaults to `https://api.deepgram.com/v1`.

## Speech To Text

Use `deepgram_transcribe_url` for hosted media:

```lua
local result = deepgram.transcribe_url({
  body = { url = "https://example.test/audio.wav" },
  model = "nova-3",
  smart_format = true,
  diarize = true,
  utterances = true
})
```

Use `deepgram_transcribe_audio` when the host has already read audio bytes:

```lua
local result = deepgram.transcribe_audio({
  content = audio_bytes,
  content_type = "audio/wav",
  model = "nova-3",
  smart_format = true
})
```

The REST tools cover prerecorded transcription. Deepgram live transcription and live TTS are WebSocket APIs and are not exposed by this JSON tool package.

## Text Intelligence

Use `deepgram_analyze_text` for summaries, topics, intents, and sentiment.

```lua
local analysis = deepgram.analyze_text({
  body = { text = "Customer transcript goes here." },
  summarize = true,
  sentiment = true,
  topics = true,
  intents = true
})
```

## Text To Speech

Use `deepgram_speak` to generate speech from text. The response returns `content_type` and `audio_base64`.

```lua
local audio = deepgram.speak({
  body = { text = "Hello from Deepgram." },
  model = "aura-2-thalia-en"
})
```

## Models And Project Management

Model tools:

- `deepgram_list_models`
- `deepgram_get_model`
- `deepgram_list_project_models`
- `deepgram_get_project_model`

Project tools:

- `deepgram_list_projects`
- `deepgram_get_project`
- `deepgram_update_project`
- `deepgram_list_project_keys`
- `deepgram_create_project_key`
- `deepgram_delete_project_key`
- `deepgram_list_project_balances`
- `deepgram_get_project_balance`
- `deepgram_get_usage_breakdown`
- `deepgram_get_project_request`

Create/update tools accept a `body` object matching Deepgram's official request schema. Use fake values in tests and docs; never commit real project IDs, API keys, or request IDs.
