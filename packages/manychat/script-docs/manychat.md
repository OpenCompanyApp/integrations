# Manychat - JavaScript API Reference

Namespace: `app.integrations.manychat`

Use this integration for Manychat Account Public API operations. Responses are decoded Manychat JSON. Most endpoints return a top-level `status` and `data` object or list.

## Account And Flows

```js
var page = app.integrations.manychat.get_page_info({})
var flows = app.integrations.manychat.list_flows({})
```
`get_flow` is a compatibility helper. Manychat documents `getFlows`, not a single-flow endpoint, so this tool searches the list response by namespace or ID.

```js
var flow = app.integrations.manychat.get_flow({page_id: "content20260101000000"})
```
## Tags

```js
var tags = app.integrations.manychat.list_tags({})

var created = app.integrations.manychat.create_tag({
  name: "VIP",
})

app.integrations.manychat.remove_tag({tag_id: 123})
app.integrations.manychat.remove_tag_by_name({tag_name: "VIP"})
```
## Fields

```js
var custom_fields = app.integrations.manychat.list_custom_fields({})

var field = app.integrations.manychat.create_custom_field({
  caption: "Lead status",
  type: "text",
  description: "CRM qualification status",
})

var bot_fields = app.integrations.manychat.list_bot_fields({})

app.integrations.manychat.set_bot_field({
  field_id: 456,
  field_value: "open",
})
```
## Sending

Use `send_content` for direct content payloads and `send_flow` to trigger an existing automation flow.

```js
var sent = app.integrations.manychat.send_content({
  subscriber_id: 123456,
  data: {
    version: "v2",
    content: {
      type: "text",
      messages: [
        {type: "text", text: "Hello from an agent"}
      ]
    }
  }
})

var flow = app.integrations.manychat.send_flow({
  subscriber_id: 123456,
  flow_ns: "content20260101000000",
})
```
`send_message` remains as a compatibility alias for older scripts. New scripts should use `send_content`.

## Subscribers

```js
var subscriber = app.integrations.manychat.get_subscriber_info({
  subscriber_id: 123456,
})

var matches = app.integrations.manychat.find_subscriber_by_name({
  name: "Example User",
})

app.integrations.manychat.add_subscriber_tag({
  subscriber_id: 123456,
  tag_id: 111,
})

app.integrations.manychat.remove_subscriber_tag({
  subscriber_id: 123456,
  tag_id: 111,
})

app.integrations.manychat.set_subscriber_custom_field({
  subscriber_id: 123456,
  field_id: 222,
  field_value: "qualified",
})
```
Create or update subscribers with the payload shape documented by Manychat:

```js
var created = app.integrations.manychat.create_subscriber({
  data: {
    first_name: "Example",
    last_name: "User",
    email: "user@example.test",
    has_opt_in_email: true,
  }
})

var updated = app.integrations.manychat.update_subscriber({
  data: {
    subscriber_id: 123456,
    email: "new-address@example.test",
    has_opt_in_email: true,
  }
})
```
## Generic API Helpers

Use generic helpers only for documented Manychat endpoints that do not yet have a dedicated tool. `path` must be relative to the configured API base URL; absolute URLs are rejected.

```js
var topics = app.integrations.manychat.api_get({
  path: "/fb/page/getOtnTopics",
})

var tagged = app.integrations.manychat.api_post({
  path: "/fb/subscriber/addTagByName",
  body: {
    subscriber_id: 123456,
    tag_name: "VIP",
  }
})
```
## Multi-Account Usage

```js
app.integrations.manychat.list_flows({})
app.integrations.manychat.default.list_flows({})
app.integrations.manychat.work.add_subscriber_tag({
  subscriber_id: 123456,
  tag_id: 111,
})
```
The function names are identical across accounts; only stored API keys differ.
