# Together AI — Ruby API Reference

## list_models

List all available AI models on Together AI.

### Parameters

None.

### Example

```ruby
result = app.call("integrations.together-ai.list_models")
result.each do |model|
  puts((model.id).to_s + " — " + (model.type).to_s)
end
```
---

## create_completion

Create a chat completion using a Together AI model.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model` | string | yes | The model ID (e.g. `"meta-llama/Llama-3.3-70B-Instruct-Turbo"`) |
| `messages` | array | yes | Array of message objects with `"role"` (system, user, assistant) and `"content"` |
| `max_tokens` | integer | no | Maximum tokens to generate in the response |
| `temperature` | number | no | Sampling temperature (0.0–2.0). Defaults to 0.7 |
| `top_p` | number | no | Nucleus sampling threshold (0.0–1.0). Defaults to 0.7 |
| `top_k` | integer | no | Top-k sampling parameter |
| `frequency_penalty` | number | no | Penalize tokens based on frequency (-2.0 to 2.0) |
| `presence_penalty` | number | no | Penalize tokens based on presence (-2.0 to 2.0) |
| `stop` | array | no | Array of stop sequences |

### Examples

```ruby
# Simple chat completion
result = app.call("integrations.together-ai.create_completion", model: "meta-llama/Llama-3.3-70B-Instruct-Turbo", messages: [{role: "user", content: "What is the meaning of life?"}], max_tokens: 256, temperature: 0.7)
puts(result.choices[0].message.content)
```
```ruby
# Multi-turn conversation
result = app.call("integrations.together-ai.create_completion", model: "mistralai/Mixtral-8x7B-Instruct-v0.1", messages: [{role: "system", content: "You are a helpful assistant."}, {role: "user", content: "Explain quantum computing in simple terms."}], max_tokens: 512, temperature: 0.5)
```
---

## list_fine_tunes

List all fine-tuning jobs on Together AI.

### Parameters

None.

### Example

```ruby
result = app.call("integrations.together-ai.list_fine_tunes")
result.each do |job|
  puts((job.id).to_s + " — " + (job.status).to_s + " — " + (job.model_name).to_s)
end
```
---

## get_fine_tune

Get details of a specific fine-tuning job.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fine_tune_id` | string | yes | The fine-tuning job ID (e.g. `"ft-abc123"`) |

### Example

```ruby
job = app.call("integrations.together-ai.fine_tune", fine_tune_id: "ft-abc123")
puts("Status: " + (job.status).to_s)
puts("Model: " + (job.model_name).to_s)
puts("Output: " + ((job.output_model_name || "pending")).to_s)
```
---

## list_files

List all files uploaded to Together AI.

### Parameters

None.

### Example

```ruby
result = app.call("integrations.together-ai.list_files")
result.each do |file|
  puts((file.id).to_s + " — " + (file.filename).to_s + " (" + (file.bytes).to_s + " bytes)")
end
```
---

## get_file

Get details of a specific file.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_id` | string | yes | The file ID to retrieve |

### Example

```ruby
file = app.call("integrations.together-ai.file", file_id: "file-abc123")
puts("Name: " + (file.filename).to_s)
puts("Size: " + (file.bytes).to_s + " bytes")
puts("Purpose: " + (file.purpose).to_s)
```
---

## get_current_user

Get the authenticated user's account information.

### Parameters

None.

### Example

```ruby
user = app.call("integrations.together-ai.current_user")
puts("Name: " + ((user.name || "unknown")).to_s)
puts("Email: " + ((user.email || "unknown")).to_s)
```
---

## Multi-Account Usage

If you have multiple Together AI accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.call("integrations.together-ai.list_models")
# Explicit default (portable across setups)
app.call("integrations.together-ai.default.list_models")
# Named accounts
app.call("integrations.together-ai.work.list_models")
app.call("integrations.together-ai.research.list_models")
```
All functions are identical across accounts — only the credentials differ.
