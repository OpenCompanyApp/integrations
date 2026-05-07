# Bland AI Lua Reference

This integration targets Bland AI's documented v1 and v2 API surfaces. Configure the base URL as `https://api.bland.ai` unless Bland provides a regional endpoint. The service sends the API key in the `authorization` header.

## Calls

```lua
local call = app.integrations.blandai.make_call({
  phone_number = "+12223334444",
  task = "Confirm the appointment time and summarize any requested changes.",
  voice = "maya",
  record = true,
  wait_for_greeting = true,
  request_data = {
    customer_name = "Ada"
  },
  webhook = "https://example.test/bland-webhook"
})
```

You can use `pathway_id` instead of `task` for conversational pathway calls.

```lua
local calls = app.integrations.blandai.list_calls({
  limit = 20,
  batch_id = "batch_123"
})

local detail = app.integrations.blandai.get_call({
  call_id = "call_123"
})

app.integrations.blandai.stop_call({ call_id = "call_123" })
app.integrations.blandai.stop_all_active_calls({})
```

## Analysis

```lua
local result = app.integrations.blandai.analyze_call({
  call_id = "call_123",
  goal = "Understand the call outcome",
  questions = {
    { "Who answered the call?", "human or voicemail" },
    { "Did the customer confirm the appointment?", "boolean" }
  }
})
```

## Batches

```lua
local batch = app.integrations.blandai.create_batch({
  name = "Appointment reminders",
  phone_numbers = {
    { phone_number = "+12223334444", request_data = { customer_name = "Ada" } }
  },
  call_params = {
    task = "Remind the customer about their appointment.",
    voice = "maya"
  }
})

local batches = app.integrations.blandai.list_batches({
  take = 25,
  skip = 0
})
```

Passing `sequence` turns a batch into a campaign with retries.

## Voices

```lua
local voices = app.integrations.blandai.list_voices({})
local voice = app.integrations.blandai.get_voice({ voice_id = "maya" })
```

## Knowledge Bases

```lua
local bases = app.integrations.blandai.list_knowledge_bases({
  limit = 20
})

local kb = app.integrations.blandai.create_text_knowledge_base({
  name = "Support FAQ",
  description = "Refund and shipping policy answers",
  text = "Refunds are available within 30 days..."
})

app.integrations.blandai.update_knowledge_base({
  knowledge_base_id = "kb_123",
  name = "Updated Support FAQ"
})

local answer = app.integrations.blandai.chat_knowledge_base({
  knowledge_base_id = "kb_123",
  messages = {
    { role = "user", content = "What is the refund policy?" }
  }
})
```

## Custom Tools

```lua
local tool = app.integrations.blandai.create_tool({
  name = "lookup_order",
  description = "Look up order status",
  url = "https://example.test/orders",
  method = "GET",
  query = {
    order_id = "{{order_id}}"
  }
})
```

## Account Check

`get_current_user` is retained for compatibility. Bland AI does not expose a dedicated current-user endpoint in the documented public API, so this performs a lightweight call-list check.

```lua
local result = app.integrations.blandai.get_current_user({})
```

## Multi-Account Usage

```lua
app.integrations.blandai.make_call({...})
app.integrations.blandai.default.make_call({...})
app.integrations.blandai.sales.make_call({...})
```
