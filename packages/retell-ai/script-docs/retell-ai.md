# Retell AI - Ruby API Reference

Namespace: `app.integrations.retell_ai`

Retell uses API-root paths for agents, phone numbers, LLMs, and voices, while calls use `/v2/...` paths. This integration normalizes older `/v2` base URL configs back to `https://api.retellai.com`.

## Calls

```ruby
call = app.call("integrations.retell-ai.create_phone_call", agent_id: "agent_123", metadata: {customer_id: "cus_123"}, options: {from_number: "+14155550100", to_number: "+14155550199"})
web_call = app.call("integrations.retell-ai.create_web_call", data: {agent_id: "agent_123"})
calls = app.call("integrations.retell-ai.list_calls", filter: {agent_id: "agent_123"})
details = app.call("integrations.retell-ai.get_call", call_id: "call_123")
app.call("integrations.retell-ai.update_call", call_id: "call_123", metadata: {reviewed: true})
app.call("integrations.retell-ai.stop_call", call_id: "call_123")
app.call("integrations.retell-ai.delete_call", call_id: "call_123")
```
## Agents

```ruby
agents = app.call("integrations.retell-ai.list_agents")
agent = app.call("integrations.retell-ai.get_agent", agent_id: "agent_123")
created = app.call("integrations.retell-ai.create_agent", voice_id: "11labs-Adrian", prompt: "You are a helpful appointment scheduling agent.", options: {agent_name: "Scheduling Agent"})
app.call("integrations.retell-ai.update_agent", agent_id: "agent_123", data: {agent_name: "Updated Agent"})
app.call("integrations.retell-ai.delete_agent", agent_id: "agent_123")
```
## Phone Numbers

```ruby
numbers = app.call("integrations.retell-ai.list_phone_numbers")
number = app.call("integrations.retell-ai.get_phone_number", phone_number: "+14155550100")
app.call("integrations.retell-ai.update_phone_number", phone_number: "+14155550100", data: {inbound_agent_id: "agent_123"})
```
## LLMs And Voices

```ruby
llms = app.call("integrations.retell-ai.list_llms")
llm = app.call("integrations.retell-ai.get_llm", llm_id: "llm_123")
voices = app.call("integrations.retell-ai.list_voices")
voice = app.call("integrations.retell-ai.get_voice", voice_id: "11labs-Adrian")
```
## Generic API Helpers

Use generic helpers only for documented Retell endpoints that do not yet have a dedicated tool. `path` must be relative to the configured API base URL; absolute URLs are rejected.

```ruby
flows = app.call("integrations.retell-ai.api_get", path: "/list-conversation-flows")
created_llm = app.call("integrations.retell-ai.api_post", path: "/create-retell-llm", body: {general_prompt: "You are a concise support agent."})
updated = app.call("integrations.retell-ai.api_patch", path: "/update-agent/agent_123", body: {agent_name: "Updated Agent"})
deleted = app.call("integrations.retell-ai.api_delete", path: "/delete-retell-llm/llm_123")
```
## Multi-Account Usage

```ruby
app.call("integrations.retell-ai.list_agents")
app.call("integrations.retell-ai.default.list_agents")
app.call("integrations.retell-ai.production.list_calls", filter: {agent_id: "agent_123"})
```
All account namespaces expose the same tools; only stored API keys differ.
