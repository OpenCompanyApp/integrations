# ManyChat — Lua API Reference

## list_flows

List all flows (pages) in your ManyChat account.

### Parameters

No parameters required.

### Response

Returns an array of flow objects with IDs, names, and status.

---

## get_flow

Get details of a specific ManyChat flow (page) by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The flow (page) ID to retrieve |

### Response

Returns the full flow configuration including nodes, connections, and messaging content.

---

## send_message

Send a message to a subscriber via ManyChat's Social messaging API.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subscriber_id` | string | yes | The ManyChat subscriber ID to send the message to |
| `message` | object | yes | The message payload (text, buttons, cards, etc.) |
| `message_type` | string | no | Channel: `"instagram"`, `"messenger"`, `"whatsapp"`, or `"sms"` |

### Message Format

The `message` object supports various content types:

```lua
-- Simple text message
message = {
    text = "Hello from ManyChat!"
}

-- Text with buttons
message = {
    text = "Choose an option:",
    buttons = {
        {
            type = "url",
            caption = "Visit Website",
            url = "https://example.com"
        },
        {
            type = "postback",
            caption = "Get Started",
            payload = "GET_STARTED"
        }
    }
}
```

---

## list_tags

List all tags in your ManyChat account.

### Parameters

No parameters required.

### Response

Returns an array of tag objects with IDs and names.

---

## create_tag

Create a new tag in ManyChat.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name for the new tag |

### Response

Returns the created tag object with ID and name.

---

## get_current_user

Get the currently authenticated ManyChat user profile.

### Parameters

No parameters required.

### Response

Returns account details including user name, email, plan type, and connected channels.

---

## Examples

### List all flows

```lua
local result = app.integrations.manychat.list_flows({})

for _, flow in ipairs(result.data or {}) do
    print(flow.id .. ": " .. flow.name)
end
```

### Get a specific flow

```lua
local result = app.integrations.manychat.get_flow({
    page_id = "123456"
})

print("Flow: " .. result.data.name)
```

### Send a text message

```lua
local result = app.integrations.manychat.send_message({
    subscriber_id = "789012",
    message = {
        text = "Hello! This is a message from our AI assistant."
    }
})

print("Message sent: " .. tostring(result.success))
```

### Send a message with buttons

```lua
local result = app.integrations.manychat.send_message({
    subscriber_id = "789012",
    message = {
        text = "What would you like to do?",
        buttons = {
            {
                type = "url",
                caption = "Visit Shop",
                url = "https://shop.example.com"
            },
            {
                type = "postback",
                caption = "Talk to Agent",
                payload = "AGENT_HANDOFF"
            }
        }
    }
})
```

### List all tags

```lua
local result = app.integrations.manychat.list_tags({})

for _, tag in ipairs(result.data or {}) do
    print(tag.id .. ": " .. tag.name)
end
```

### Create a new tag

```lua
local result = app.integrations.manychat.create_tag({
    name = "VIP Customer"
})

print("Created tag: " .. result.data.name)
```

### Get current user info

```lua
local result = app.integrations.manychat.get_current_user({})

print("Account: " .. result.data.first_name .. " " .. result.data.last_name)
print("Plan: " .. (result.data.plan or "unknown"))
```

---

## Multi-Account Usage

If you have multiple ManyChat accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.manychat.function_name({...})

-- Explicit default (portable across setups)
app.integrations.manychat.default.function_name({...})

-- Named accounts
app.integrations.manychat.work.function_name({...})
app.integrations.manychat.client_a.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
