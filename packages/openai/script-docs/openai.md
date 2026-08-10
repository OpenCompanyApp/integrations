# OpenAI — JavaScript API Reference

## openai_chat_completion

Generate a chat completion using GPT models.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model` | string | yes | Model ID (e.g., `"gpt-4o"`, `"gpt-4o-mini"`, `"gpt-4-turbo"`). |
| `messages` | array | yes | Array of message objects, each with `"role"` (`system`, `user`, `assistant`) and `"content"`. |
| `temperature` | number | no | Sampling temperature between 0 and 2. Higher values produce more random output. |
| `max_tokens` | integer | no | Maximum number of tokens to generate in the response. |
| `top_p` | number | no | Nucleus sampling parameter. Use temperature or top_p, but not both. |
| `frequency_penalty` | number | no | Penalty for frequent tokens (-2.0 to 2.0). |
| `presence_penalty` | number | no | Penalty for new tokens (-2.0 to 2.0). |
| `response_format` | object | no | Response format, e.g. `{"type": "json_object"}` for JSON output. |

## openai_create_embedding

Generate an embedding vector for text input.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model` | string | yes | Embedding model ID (e.g., `"text-embedding-3-small"`, `"text-embedding-3-large"`). |
| `input` | string | yes | Text string or array of strings to embed. |

## openai_create_image

Generate an image using DALL·E.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `prompt` | string | yes | Text description of the desired image. |
| `model` | string | no | Model ID (e.g., `"dall-e-3"`, `"dall-e-2"`). Default: `"dall-e-2"`. |
| `n` | integer | no | Number of images to generate (1–10 for DALL·E 2, only 1 for DALL·E 3). |
| `size` | string | no | Image size: `"256x256"`, `"512x512"`, `"1024x1024"`, `"1024x1792"`, `"1792x1024"`. |
| `quality` | string | no | Image quality: `"standard"` or `"hd"` (DALL·E 3 only). |
| `style` | string | no | Image style: `"vivid"` or `"natural"` (DALL·E 3 only). |
| `response_format` | string | no | Response format: `"url"` or `"b64_json"`. |

## openai_transcribe_audio

Transcribe audio using Whisper.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_content` | string | yes | Base64-encoded audio file content. |
| `filename` | string | yes | Filename with extension (e.g., `"audio.mp3"`, `"recording.wav"`). |
| `model` | string | yes | Model to use for transcription (e.g., `"whisper-1"`). |
| `language` | string | no | ISO 639-1 language code (e.g., `"en"`, `"fr"`, `"de"`). |
| `response_format` | string | no | Output format: `"json"`, `"text"`, `"srt"`, `"verbose_json"`, `"vtt"`. |

## openai_text_to_speech

Generate speech audio from text.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model` | string | yes | TTS model ID (e.g., `"tts-1"`, `"tts-1-hd"`). |
| `input` | string | yes | Text to convert to speech (max 4096 characters). |
| `voice` | string | yes | Voice to use: `"alloy"`, `"echo"`, `"fable"`, `"onyx"`, `"nova"`, or `"shimmer"`. |
| `speed` | number | no | Speed of speech (0.25 to 4.0). Default: 1.0. |
| `response_format` | string | no | Audio format: `"mp3"`, `"opus"`, `"aac"`, `"flac"`, `"wav"`. Default: `"mp3"`. |

## openai_create_assistant

Create an OpenAI assistant.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model` | string | yes | Model ID (e.g., `"gpt-4o"`). |
| `name` | string | no | Name of the assistant. |
| `description` | string | no | Description of the assistant. |
| `instructions` | string | no | System instructions for the assistant. |
| `tools` | array | no | Array of tool objects the assistant can use (e.g., `code_interpreter`, `file_search`). |

## openai_list_assistants

List all OpenAI assistants.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of assistants to return (default 20, max 100). |

## openai_create_thread

Create a conversation thread.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `messages` | array | no | Initial messages for the thread. Each message has `"role"` and `"content"`. |

## openai_add_message_to_thread

Add a message to an existing thread.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `thread_id` | string | yes | The ID of the thread to add the message to. |
| `role` | string | yes | Role of the message sender: `"user"` or `"assistant"`. |
| `content` | string | yes | Text content of the message. |

## openai_list_thread_messages

List messages in a thread.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `thread_id` | string | yes | The ID of the thread to list messages from. |
| `limit` | integer | no | Number of messages to return (default 20, max 100). |

## openai_create_run

Start an assistant run on a thread.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `thread_id` | string | yes | The ID of the thread to run the assistant on. |
| `assistant_id` | string | yes | The ID of the assistant to use for this run. |
| `instructions` | string | no | Override the assistant's default instructions for this run. |

## openai_get_run

Get the status of a thread run.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `thread_id` | string | yes | The ID of the thread. |
| `run_id` | string | yes | The ID of the run to check. |

## openai_upload_file

Upload a file to OpenAI.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_content` | string | yes | Base64-encoded file content. |
| `filename` | string | yes | Filename with extension (e.g., `"data.jsonl"`, `"document.txt"`). |
| `purpose` | string | yes | Purpose of the file: `"assistants"`, `"assistants_output"`, `"batch"`, `"fine-tune"`, `"vision"`. |

## openai_list_files

List files uploaded to OpenAI.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `purpose` | string | no | Filter by purpose: `"assistants"`, `"assistants_output"`, `"batch"`, `"fine-tune"`, `"vision"`. |
| `limit` | integer | no | Number of files to return (default 20, max 10000). |

## openai_list_models

List available OpenAI models.

### Parameters

*No parameters required.*

## Examples

### Chat completion

```js
var result = app.integrations.openai.openai_chat_completion({
  model: "gpt-4o",
  messages: [
    { role: "system", content: "You are a helpful assistant." },
    { role: "user", content: "Explain quantum computing in one sentence." }
  ],
  temperature: 0.7,
  max_tokens: 100,
})
console.log(result.choices[0].message.content)
```
### Generate an image

```js
var result = app.integrations.openai.openai_create_image({
  model: "dall-e-3",
  prompt: "A sunset over a mountain lake in watercolor style",
  size: "1024x1024",
  quality: "hd",
})
```
### Create an embedding

```js
var result = app.integrations.openai.openai_create_embedding({
  model: "text-embedding-3-small",
  input: "The quick brown fox jumps over the lazy dog",
})
```
---

## Multi-Account Usage

If you have multiple openai accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.openai.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.openai.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.openai.work.function_name({ /* parameters */ })
app.integrations.openai.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
