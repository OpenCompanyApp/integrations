# ElevenLabs Legacy JavaScript API Reference

This legacy `eleven-labs` namespace is kept for compatibility. Prefer the canonical `elevenlabs` integration namespace for new automations because it exposes broader ElevenLabs API coverage.

## list_voices

List available ElevenLabs voices.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of voices per page (default: 20) |
| `page` | integer | no | Page number, 1-based (default: 1) |

### Example

```js
var result = app.integrations["eleven-labs"].list_voices({
  limit: 10,
  page: 1,
})

for (const voice of (result.voices)) {
  console.log(voice.name + " (" + voice.voice_id + ")")
}
```
---

## get_voice

Get detailed information about a specific voice.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `voice_id` | string | yes | The unique voice identifier |

### Example

```js
var voice = app.integrations["eleven-labs"].get_voice({
  voice_id: "21m00Tcm4TlvDq8ikWAM",
})

console.log(voice.name)
console.log(voice.labels.accent)
console.log(voice.labels.gender)
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

```js
var result = app.integrations["eleven-labs"].generate_speech({
  text: "Hello! Welcome to our platform.",
  voice_id: "21m00Tcm4TlvDq8ikWAM",
  model_id: "eleven_multilingual_v2",
  stability: 0.5,
  similarity_boost: 0.75,
})

// result.audio contains base64-encoded audio data
// result.content_type is the MIME type (e.g., "audio/mpeg")
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

```js
var result = app.integrations["eleven-labs"].generate_sound({
  text: "Thunder rumbling in the distance with light rain",
})

// result.audio contains base64-encoded audio data
// result.content_type is the MIME type
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

```js
var result = app.integrations["eleven-labs"].list_models({
  limit: 50,
})

for (const model of (result)) {
  console.log(model.model_id + ": " + model.name)
}
```
---

## get_current_user

Get the current user's profile and subscription information.

### Parameters

None.

### Example

```js
var user = app.integrations["eleven-labs"].get_current_user({})

console.log("User: " + user.first_name + " " + user.last_name)
console.log("Tier: " + user.subscription.tier)
console.log("Characters used: " + user.subscription.character_count)
console.log("Character limit: " + user.subscription.character_limit)
```
---

## Multi-Account Usage

If you have multiple ElevenLabs accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["eleven-labs"].function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations["eleven-labs"].default.function_name({ /* parameters */ })

// Named accounts
app.integrations["eleven-labs"].production.function_name({ /* parameters */ })
app.integrations["eleven-labs"].staging.function_name({ /* parameters */ })
```
All functions are identical across accounts. Only the credentials differ.
