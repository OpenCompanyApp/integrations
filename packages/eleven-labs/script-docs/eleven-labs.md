# ElevenLabs Legacy Ruby API Reference

This legacy `eleven-labs` namespace is kept for compatibility. Prefer the canonical `elevenlabs` integration namespace for new automations because it exposes broader ElevenLabs API coverage.

## list_voices

List available ElevenLabs voices.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of voices per page (default: 20) |
| `page` | integer | no | Page number, 1-based (default: 1) |

### Example

```ruby
result = app.call("integrations.eleven-labs.list_voices", limit: 10, page: 1)
result.voices.each do |voice|
  puts((voice.name).to_s + " (" + (voice.voice_id).to_s + ")")
end
```
---

## get_voice

Get detailed information about a specific voice.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `voice_id` | string | yes | The unique voice identifier |

### Example

```ruby
voice = app.call("integrations.eleven-labs.get_voice", voice_id: "21m00Tcm4TlvDq8ikWAM")
puts(voice.name)
puts(voice.labels.accent)
puts(voice.labels.gender)
```
---

## generate_speech

Generate speech audio from text using an ElevenLabs voice.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `text` | string | yes | The text to convert to speech |
| `voice_id` | string | yes | The voice identifier |
| `model_id` | string | no | Model ID (default: `"eleven_multilingual_v2"`) |
| `stability` | number | no | Voice stability 0.0-1.0 (higher = more consistent) |
| `similarity_boost` | number | no | Similarity boost 0.0-1.0 (higher = closer to original voice) |

### Example

```ruby
result = app.call("integrations.eleven-labs.generate_speech", text: "Hello! Welcome to our platform.", voice_id: "21m00Tcm4TlvDq8ikWAM", model_id: "eleven_multilingual_v2", stability: 0.5, similarity_boost: 0.75)
```
---

## generate_sound

Generate a sound effect from a text description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `text` | string | yes | Description of the sound to generate |
| `model_id` | string | no | Model ID (default: `"eleven_sound_generation_v1"`) |

### Example

```ruby
result = app.call("integrations.eleven-labs.generate_sound", text: "Thunder rumbling in the distance with light rain")
```
---

## list_models

List available ElevenLabs models.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of models per page (default: 20) |
| `page` | integer | no | Page number, 1-based (default: 1) |

### Example

```ruby
result = app.call("integrations.eleven-labs.list_models", limit: 50)
result.each do |model|
  puts((model.model_id).to_s + ": " + (model.name).to_s)
end
```
---

## get_current_user

Get the current user's profile and subscription information.

### Parameters

None.

### Example

```ruby
user = app.call("integrations.eleven-labs.get_current_user")
puts("User: " + (user.first_name).to_s + " " + (user.last_name).to_s)
puts("Tier: " + (user.subscription.tier).to_s)
puts("Characters used: " + (user.subscription.character_count).to_s)
puts("Character limit: " + (user.subscription.character_limit).to_s)
```
---

## Multi-Account Usage

If you have multiple ElevenLabs accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts. Only the credentials differ.
