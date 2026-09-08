# Anthropic (Claude) - Ruby API Reference

Namespace: `app.integrations["anthropic"]`

This integration covers the public Anthropic Messages, token counting, models,
Message Batches, and beta Files APIs. Organization, user, workspace, and API-key
administration tools require the optional `admin_key` credential.

## Messages

### create_message

Create a Claude message with the same JSON payload shape as `POST /v1/messages`.

Required: `model`, `messages`

Common optional fields: `max_tokens`, `system`, `temperature`, `top_p`,
`stop_sequences`, `tools`, `tool_choice`, `thinking`, `metadata`, `stream`.

```ruby
result = app.integrations.anthropic.create_message(model: "claude-sonnet-4-20250514", max_tokens: 256, messages: [{role: "user", content: "Summarize prompt caching in one paragraph."}])
puts(result.id)
puts(result.usage.input_tokens)
```
### count_message_tokens

Count input tokens for a Messages API payload without creating a message.

```ruby
result = app.integrations.anthropic.count_message_tokens(payload: {model: "claude-sonnet-4-20250514", messages: [{role: "user", content: "Hello, Claude"}]})
puts(result.input_tokens)
```
### list_messages

Deprecated compatibility alias. Anthropic does not expose a message-history
listing endpoint. This tool returns an explicit unsupported-capability error;
use `list_message_batches` for batch job history.

## Message Batches

Message Batch results are JSONL and are returned as `{ content_type, body }`.
Rows are not guaranteed to be in request order; match them by `custom_id`.

```ruby
batch = app.integrations.anthropic.create_message_batch(payload: {requests: [{custom_id: "example-1", params: {model: "claude-sonnet-4-20250514", max_tokens: 128, messages: [{role: "user", content: "Write one sentence about CI."}]}}]})
current = app.integrations.anthropic.get_message_batch(id: batch.id)
puts(current.processing_status)
```
Available batch tools:

- `create_message_batch({ payload = { requests = ... } })`
- `list_message_batches({ query = { limit = 20 } })`
- `get_message_batch({ id = "msgbatch_..." })`
- `cancel_message_batch({ id = "msgbatch_..." })`
- `delete_message_batch({ id = "msgbatch_..." })`
- `get_message_batch_results({ id = "msgbatch_..." })`

## Models

```ruby
models = app.integrations.anthropic.list_models(limit: 20)
(models.data || []).each do |model|
  puts((model.id).to_s + " - " + (model.display_name).to_s)
end
sonnet = app.integrations.anthropic.get_model(id: "claude-sonnet-4-20250514")
```
## Files API

Files API operations use the required beta header internally:
`anthropic-beta: files-api-2025-04-14`.

Uploaded files can be referenced from Messages payloads using content block
sources with `{ type = "file", file_id = "file_..." }`. Downloading is only
available for files Anthropic marks as downloadable, such as code-execution
outputs.

```ruby
files = app.integrations.anthropic.list_files(query: {limit: 20})
file = app.integrations.anthropic.get_file(id: "file_011example")
content = app.integrations.anthropic.download_file(id: "file_011downloadable")
puts(content.content_type)
```
Available file tools:

- `list_files({ query = { limit = 20 } })`
- `get_file({ id = "file_..." })`
- `delete_file({ id = "file_..." })`
- `download_file({ id = "file_..." })`

## Admin API

The following tools require `admin_key`, not a normal workspace API key.
Admin API is unavailable for individual accounts.

```ruby
org = app.integrations.anthropic.get_organization()
users = app.integrations.anthropic.list_users(query: {limit: 20})
keys = app.integrations.anthropic.list_api_keys(query: {limit: 20, status: "active"})
```
Available Admin API tools:

- `get_organization({})`
- `list_workspaces({ limit = 20, include_archived = false })`
- `get_workspace({ id = "wrkspc_..." })`
- `list_users({ query = { limit = 20 } })`
- `get_user({ id = "user_..." })`
- `update_user({ id = "user_...", payload = { role = "developer" } })`
- `remove_user({ id = "user_..." })`
- `list_api_keys({ query = { limit = 20 } })`
- `get_api_key({ id = "apikey_..." })`

`get_current_user({})` is kept as a backward-compatible alias for
`get_organization({})`; Anthropic does not expose a `/users/me` endpoint.

## Multi-Account Usage

```ruby
app.integrations.anthropic.create_message()
app.integrations.anthropic.default.create_message()
app.integrations.anthropic.work.create_message()
```
All functions are identical across accounts. Only the credentials differ.
