# Zendesk Marketing — Lua API Reference

## list_campaigns

List all email marketing campaigns in your Zendesk account.

### Parameters

None.

### Example

```lua
local result = app.integrations["zend"].list_campaigns()

for _, campaign in ipairs(result) do
  print(campaign.subject .. " (" .. campaign.status .. ")")
end
```

---

## get_campaign

Get detailed information about a specific email marketing campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The campaign ID |

### Example

```lua
local result = app.integrations["zend"].get_campaign({
  campaign_id = "abc123"
})

print("Subject: " .. result.subject)
print("Status: " .. result.status)
```

---

## create_campaign

Create a new email marketing campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subject` | string | yes | The campaign email subject line |
| `content` | string | no | The HTML content of the campaign email |
| `list_ids` | array | no | Array of subscriber list IDs to target |
| `from_name` | string | no | The sender name for the campaign |
| `from_email` | string | no | The sender email address for the campaign |

### Example

```lua
local result = app.integrations["zend"].create_campaign({
  subject = "Monthly Newsletter",
  content = "<h1>Hello!</h1>",
  list_ids = { "list_abc", "list_def" },
  from_name = "Marketing Team",
  from_email = "marketing@example.com"
})

print("Created campaign: " .. result.id)
```

---

## list_lists

List all subscriber lists in your Zendesk account.

### Parameters

None.

### Example

```lua
local result = app.integrations["zend"].list_lists()

for _, list in ipairs(result) do
  print(list.name .. " (" .. list.id .. ")")
end
```

---

## get_list

Get detailed information about a specific subscriber list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The subscriber list ID |

### Example

```lua
local result = app.integrations["zend"].get_list({
  list_id = "abc123"
})

print("List: " .. result.name)
print("Subscribers: " .. result.subscriber_count)
```

---

## list_subscribers

List subscribers on a Zendesk list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | no | The subscriber list ID to filter by |
| `page` | integer | no | Page number for pagination (default: 1) |
| `page_size` | integer | no | Number of subscribers per page (default: 100) |

### Example

```lua
local result = app.integrations["zend"].list_subscribers({
  list_id = "abc123",
  page = 1,
  page_size = 50
})

for _, sub in ipairs(result.data) do
  print(sub.email .. " - " .. sub.name)
end
```

---

## get_subscribers

Get detailed information about a specific subscriber.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subscriber_id` | string | yes | The subscriber ID |

### Example

```lua
local result = app.integrations["zend"].get_subscribers({
  subscriber_id = "sub_abc123"
})

print("Email: " .. result.email)
print("Name: " .. result.name)
print("Status: " .. result.status)
```

---

## get_current_user

Get the authenticated user's Zendesk account details.

### Parameters

None.

### Example

```lua
local result = app.integrations["zend"].get_current_user()

print("Account: " .. result.email)
print("Name: " .. result.name)
```

---

## Multi-Account Usage

If you have multiple Zendesk accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["zend"].list_lists({})

-- Explicit default (portable across setups)
app.integrations["zend"].default.list_lists({})

-- Named accounts
app.integrations["zend"].marketing.list_lists({})
app.integrations["zend"].transactional.list_lists({})
```

All functions are identical across accounts — only the credentials differ.
