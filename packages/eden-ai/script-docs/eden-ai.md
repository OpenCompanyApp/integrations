# Eden AI Ruby API Reference

Namespace: `app.integrations.eden_ai`

Eden AI V3 is the current API. Use the V3 tools for new work; the V2 tools remain available for legacy accounts.

## V3 Chat

```ruby
result = app.call("integrations.eden-ai.chat_completions", model: "openai/gpt-4o", messages: [{role: "user", content: "Write a concise summary."}], fallbacks: ["anthropic/claude-3-5-sonnet-latest"], temperature: 0.2)
```
`chat_completions` accepts OpenAI-compatible parameters through `extra`, including tools, response format, web search options, reasoning effort, and image configuration.

## V3 Models And Discovery

```ruby
models = app.call("integrations.eden-ai.list_models")
features = app.call("integrations.eden-ai.list_features")
moderation = app.call("integrations.eden-ai.get_feature_info", feature_path: "text/moderation")
```
## V3 Universal AI

```ruby
result = app.call("integrations.eden-ai.universal", model: "text/moderation/openai", input: {text: "Text to classify"}, fallbacks: ["text/moderation/google"])
```
For async features:

```ruby
job = app.call("integrations.eden-ai.universal_async", model: "ocr/ocr_async/amazon", input: {file: "https://example.test/document.pdf"})
result = app.call("integrations.eden-ai.get_universal_job", job_id: job.public_job_id)
```
## V3 Files

```ruby
file = app.call("integrations.eden-ai.upload_file", file_path: "/tmp/document.pdf", purpose: "ocr-processing")
```
`delete_all_uploaded_files()` permanently deletes every V3 uploaded file for the authenticated user.

## Legacy V2 Tools

Existing V2 helpers are still available:

```ruby
app.call("integrations.eden-ai.generate_text", providers: "openai", text: "Write a product blurb.")
app.call("integrations.eden-ai.translate_text", providers: "google", text: "Hello", target_language: "fr")
```
Legacy helpers include `generate_text`, `analyze_image`, `translate_text`, `transcribe_audio`, `ocr`, and `get_current_user`.

## Generic API Helpers

```ruby
v3 = app.call("integrations.eden-ai.v3_api_get", path: "/models")
legacy = app.call("integrations.eden-ai.v2_api_post", path: "/text/sentiment_analysis", body: {providers: "openai", text: "Great product"})
```
Absolute URLs are rejected; pass paths relative to `/v3` for V3 helpers and `/v2` for legacy helpers.

## Multi-Account Usage

```ruby
app.call("integrations.eden-ai.list_models")
app.call("integrations.eden-ai.default.list_models")
app.call("integrations.eden-ai.production.list_models")
```