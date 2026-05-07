# Svix

Namespace: `app.integrations.svix`

Svix tools use the official Svix REST API. Configure `auth_token`; set `url`
only for self-hosted Svix or a test proxy. Tool names follow the API operation
names where possible, and each tool description includes the official HTTP
endpoint and operation id.

## Common Webhook Operations

```lua
local apps = app.integrations.svix.list_applications({
  limit = 10
})

local app = app.integrations.svix.create_application({
  get_if_exists = true,
  payload = {
    name = "Example tenant",
    uid = "tenant_123"
  }
})

local endpoint = app.integrations.svix.create_endpoint({
  app_id = app.id,
  idempotency_key = "setup-tenant-123-endpoint",
  payload = {
    url = "https://example.test/webhooks/svix",
    version = 1,
    description = "Primary receiver",
    filterTypes = { "user.created", "user.deleted" }
  }
})

local message = app.integrations.svix.create_message({
  app_id = app.id,
  idempotency_key = "msg-user-123-created",
  payload = {
    eventType = "user.created",
    payload = {
      id = "user_123",
      email = "user@example.test"
    }
  }
})
```

## Event Types

```lua
local event_types = app.integrations.svix.list_event_types({
  limit = 50,
  include_archived = false
})

local event_type = app.integrations.svix.create_event_type({
  payload = {
    name = "invoice.paid",
    description = "An invoice was paid"
  }
})
```

## Delivery Inspection And Replay

```lua
local messages = app.integrations.svix.list_messages({
  app_id = "app_123",
  limit = 25,
  with_content = true
})

local attempts = app.integrations.svix.list_attempts_by_msg({
  app_id = "app_123",
  msg_id = "msg_123"
})

local replay = app.integrations.svix.resend_webhook({
  app_id = "app_123",
  msg_id = "msg_123",
  endpoint_id = "ep_123",
  idempotency_key = "replay-msg-123-ep-123"
})
```

## Streams And Ingest

The integration also exposes Svix Streams and Ingest APIs:

```lua
local stream = app.integrations.svix.create_stream({
  payload = {
    name = "Audit stream",
    uid = "audit"
  }
})

local sink = app.integrations.svix.create_sink({
  stream_id = stream.id,
  payload = {
    name = "Warehouse",
    type = "webhook",
    config = {
      url = "https://example.test/ingest"
    }
  }
})

local source = app.integrations.svix.create_ingest_source({
  payload = {
    name = "Inbound partner",
    uid = "partner_123"
  }
})
```

## Argument Shape

Path and query parameters are top-level snake_case arguments. Header parameters
are also top-level snake_case arguments, so the Svix `idempotency-key` header is
`idempotency_key`.

Write operations accept a `payload` object for the JSON body. Tools also accept:

- `query`: extra documented query parameters
- `headers`: extra HTTP headers

Responses are the parsed Svix JSON response. Empty responses return
`{ success = true, status = 204 }`.

## Multi-Account Usage

```lua
app.integrations.svix.list_applications({ limit = 10 })
app.integrations.svix.default.list_applications({ limit = 10 })
app.integrations.svix.production.list_applications({ limit = 10 })
```

All account namespaces expose the same tool names. Only the credentials differ.
