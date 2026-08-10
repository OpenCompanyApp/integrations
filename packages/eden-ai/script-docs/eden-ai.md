# Eden AI JavaScript API Reference

Namespace: `app.integrations.eden_ai`

Eden AI V3 is the current API. Use the V3 tools for new work; the V2 tools remain available for legacy accounts.

## V3 Chat

```js
var result = app.integrations.eden_ai.chat_completions({
  model: "openai/gpt-4o",
  messages: [
    { role: "user", content: "Write a concise summary." }
  ],
  fallbacks: [ "anthropic/claude-3-5-sonnet-latest" ],
  temperature: 0.2,
})
```
`chat_completions` accepts OpenAI-compatible parameters through `extra`, including tools, response format, web search options, reasoning effort, and image configuration.

## V3 Models And Discovery

```js
var models = app.integrations.eden_ai.list_models()

var features = app.integrations.eden_ai.list_features()

var moderation = app.integrations.eden_ai.get_feature_info({
  feature_path: "text/moderation",
})
```
## V3 Universal AI

```js
var result = app.integrations.eden_ai.universal_ai({
  model: "text/moderation/openai",
  input: {
    text: "Text to classify",
  },
  fallbacks: [ "text/moderation/google" ],
})
```
For async features:

```js
var job = app.integrations.eden_ai.universal_ai_async({
  model: "ocr/ocr_async/amazon",
  input: {
    file: "https://example.test/document.pdf",
  }
})

var result = app.integrations.eden_ai.get_universal_ai_job({
  job_id: job.public_job_id,
})
```
## V3 Files

```js
var file = app.integrations.eden_ai.upload_file({
  file_path: "/tmp/document.pdf",
  purpose: "ocr-processing",
})
```
`delete_all_uploaded_files()` permanently deletes every V3 uploaded file for the authenticated user.

## Legacy V2 Tools

Existing V2 helpers are still available:

```js
app.integrations.eden_ai.generate_text({
  providers: "openai",
  text: "Write a product blurb.",
})

app.integrations.eden_ai.translate_text({
  providers: "google",
  text: "Hello",
  target_language: "fr",
})
```
Legacy helpers include `generate_text`, `analyze_image`, `translate_text`, `transcribe_audio`, `ocr`, and `get_current_user`.

## Generic API Helpers

```js
var v3 = app.integrations.eden_ai.v3_api_get({
  path: "/models",
})

var legacy = app.integrations.eden_ai.api_post({
  path: "/text/sentiment_analysis",
  body: {
    providers: "openai",
    text: "Great product",
  }
})
```
Absolute URLs are rejected; pass paths relative to `/v3` for V3 helpers and `/v2` for legacy helpers.

## Multi-Account Usage

```js
app.integrations.eden_ai.list_models()
app.integrations.eden_ai.default.list_models()
app.integrations.eden_ai.production.list_models()
```