# ElevenLabs Ruby API Reference

Namespace: `app.integrations.elevenlabs`

ElevenLabs tools use the v1 API at `https://api.elevenlabs.io/v1` with `xi-api-key` authentication. Binary audio responses are returned as base64 plus content metadata so agents can save or pass them to downstream tools.

## Speech Generation

```ruby
audio = app.integrations.elevenlabs.text_speech(voice_id: "21m00Tcm4TlvDq8ikWAM", text: "Hello from ElevenLabs.", model_id: "eleven_multilingual_v2", stability: 0.5, similarity_boost: 0.75)
timed = app.integrations.elevenlabs.text_speech_with_timestamps(voice_id: "21m00Tcm4TlvDq8ikWAM", text: "This line needs captions.", body: {model_id: "eleven_multilingual_v2", seed: 1234}, query: {output_format: "mp3_44100_128"})
```
`text_to_speech_with_timestamps` returns `audio_base64`, `alignment`, and `normalized_alignment`.

## Speech To Speech And Speech To Text

```ruby
changed = app.integrations.elevenlabs.speech_speech(voice_id: "21m00Tcm4TlvDq8ikWAM", audio_path: "/tmp/source.wav", fields: {model_id: "eleven_multilingual_sts_v2", remove_background_noise: true})
transcript = app.integrations.elevenlabs.speech_text(audio_path: "/tmp/interview.mp3", fields: {model_id: "scribe_v1", diarize: true, keyterms: ["OpenCompany", "KosmoKrator"]})
```
Multipart tools require local file paths available to the host.

## Sound Effects And Isolation

```ruby
sfx = app.integrations.elevenlabs.create_sound_effect(text: "Spacious cinematic impact", duration_seconds: 2.5, prompt_influence: 0.4)
clean = app.integrations.elevenlabs.isolate_audio(audio_path: "/tmp/noisy.wav", fields: {file_format: "other"})
isolation_history = app.integrations.elevenlabs.list_audio_isolation_history(page_size: 50, search: "interview")
```
## Voices And Models

```ruby
voices = app.integrations.elevenlabs.list_voices()
voice = app.integrations.elevenlabs.get_voice(voice_id: "21m00Tcm4TlvDq8ikWAM")
settings = app.integrations.elevenlabs.get_voice_settings(voice_id: "21m00Tcm4TlvDq8ikWAM")
updated = app.integrations.elevenlabs.edit_voice_settings(voice_id: "21m00Tcm4TlvDq8ikWAM", settings: {stability: 0.55, similarity_boost: 0.8, use_speaker_boost: true})
models = app.integrations.elevenlabs.get_models()
```
`create_voice` accepts local sample file paths in `files`. `delete_voice` permanently removes a voice.

## History

```ruby
history = app.integrations.elevenlabs.get_history(page_size: 20)
item = app.integrations.elevenlabs.get_history_item(history_item_id: "hist_123")
audio = app.integrations.elevenlabs.get_history_item_audio(history_item_id: "hist_123")
```
`delete_history_item({ history_item_id = "..." })` deletes one history item.

## Dubbing

```ruby
dub = app.integrations.elevenlabs.create_dubbing(fields: {source_url: "https://example.test/source.mp4", target_lang: "es", source_lang: "en", name: "Spanish trailer dub"})
projects = app.integrations.elevenlabs.list_dubbings()
project = app.integrations.elevenlabs.get_dubbing(dubbing_id: dub.dubbing_id)
transcript = app.integrations.elevenlabs.get_dubbing_transcript(dubbing_id: dub.dubbing_id, language_code: "es", format_type: "json")
```
`create_dubbing` can also accept `files` with local paths for `file`, `csv_file`, `foreground_audio_file`, or `background_audio_file`.

## Account And Generic API

```ruby
user = app.integrations.elevenlabs.get_current_user()
subscription = app.integrations.elevenlabs.get_subscription()
raw = app.integrations.elevenlabs.api_get(path: "/voices", params: {show_legacy: true})
```
Generic helpers are `api_get`, `api_post`, and `api_delete`. Absolute URLs are rejected; pass paths relative to `/v1`.

## Multi-Account Usage

```ruby
app.integrations.elevenlabs.text_speech(voice_id: "...", text: "Hi")
app.integrations.elevenlabs.default.text_speech(voice_id: "...", text: "Hi")
app.integrations.elevenlabs.production.text_speech(voice_id: "...", text: "Hi")
```