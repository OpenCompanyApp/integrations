# AssemblyAI — Lua API Reference

Namespace: `app.integrations.assemblyai`

This integration covers AssemblyAI's REST JSON APIs for pre-recorded transcription, transcript exports, temporary Streaming STT tokens, and LLM Gateway chat completions.

## Transcripts

```lua
local created = app.integrations.assemblyai.transcribe({
  audio_url = "https://example.test/meeting.mp3",
  speech_models = { "universal-3-pro", "universal-2" },
  speaker_labels = true,
  sentiment_analysis = true,
  auto_chapters = true
})

local transcript = app.integrations.assemblyai.get_transcript({
  id = created.id
})

local list = app.integrations.assemblyai.list_transcripts({
  limit = 10,
  after_id = "previous_transcript_id"
})
```

`transcribe` forwards AssemblyAI transcript options such as language detection, speech models, diarization, summarization, content safety, PII redaction, custom spelling, keyterms, webhooks, and audio start/end offsets.

## Transcript Exports

```lua
local paragraphs = app.integrations.assemblyai.get_paragraphs({
  id = "transcript_id"
})

local sentences = app.integrations.assemblyai.get_sentences({
  id = "transcript_id"
})

local subtitles = app.integrations.assemblyai.get_subtitles({
  id = "transcript_id",
  format = "vtt",
  chars_per_caption = 40
})

print(subtitles.content)
```

Use `get_redacted_audio` only for transcripts created with `redact_pii_audio = true`.

```lua
local redacted = app.integrations.assemblyai.get_redacted_audio({
  id = "transcript_id"
})
```

## Delete Transcript

```lua
local deleted = app.integrations.assemblyai.delete_transcript({
  id = "transcript_id"
})
```

Deleting a transcript removes transcript data and any uploaded file associated with that transcript.

## Upload

```lua
local upload = app.integrations.assemblyai.upload({
  file_path = "/tmp/recording.mp3"
})

local created = app.integrations.assemblyai.transcribe({
  audio_url = upload.upload_url
})
```

## Streaming Token

```lua
local token = app.integrations.assemblyai.create_streaming_token({
  expires_in_seconds = 60,
  max_session_duration_seconds = 3600
})
```

Use the returned token as the `token` query parameter when connecting to `wss://streaming.assemblyai.com/v3/ws`.

## LLM Gateway Chat

```lua
local response = app.integrations.assemblyai.llm_gateway_chat({
  model = "claude-sonnet-4-5-20250929",
  prompt = "Summarize this meeting transcript in five bullets.",
  max_tokens = 1000,
  temperature = 0.2
})

print(response.choices[1].message.content)
```

You can pass `messages`, `tools`, `tool_choice`, `response_format`, `fallbacks`, and `fallback_config` using the current AssemblyAI LLM Gateway shape.

## Multi-Account Usage

```lua
app.integrations.assemblyai.transcribe({...})
app.integrations.assemblyai.default.transcribe({...})
app.integrations.assemblyai.production.transcribe({...})
```
