# Campaign Monitor — Lua API Reference

## list_campaigns

List all email campaigns in your Campaign Monitor account.

### Parameters

None.

### Example

```lua
local result = app.integrations["campaign-monitor"].list_campaigns()

for _, campaign in ipairs(result) do
  print(campaign.Subject .. " (" .. campaign.Status .. ")")
end
```

---

## get_campaign

Get detailed information about a specific email campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `campaign_id` | string | yes | The campaign ID |

### Example

```lua
local result = app.integrations["campaign-monitor"].get_campaign({
  campaign_id = "abc123"
})

print("Subject: " .. result.Subject)
print("Status: " .. result.Status)
```

---

## list_lists

List all subscriber lists in your Campaign Monitor account.

### Parameters

None.

### Example

```lua
local result = app.integrations["campaign-monitor"].list_lists()

for _, list in ipairs(result) do
  print(list.Name .. " (" .. list.ListID .. ")")
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
local result = app.integrations["campaign-monitor"].get_list({
  list_id = "abc123"
})

print("List: " .. result.Title)
print("Subscribers: " .. result.TotalActiveSubscribers)
```

---

## list_subscribers

List active subscribers on a Campaign Monitor list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The subscriber list ID |
| `page` | integer | no | Page number for pagination (default: 1) |
| `page_size` | integer | no | Number of subscribers per page (default: 100, max: 1000) |

### Example

```lua
local result = app.integrations["campaign-monitor"].list_subscribers({
  list_id = "abc123",
  page = 1,
  page_size = 50
})

for _, sub in ipairs(result.Results) do
  print(sub.EmailAddress .. " - " .. sub.Name)
end
```

---

## add_subscriber

Add a new subscriber to a Campaign Monitor list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The subscriber list ID |
| `email` | string | yes | The subscriber's email address |
| `name` | string | yes | The subscriber's full name |
| `resubscribe` | boolean | no | Re-subscribe if previously unsubscribed (default: true) |

### Example

```lua
local result = app.integrations["campaign-monitor"].add_subscriber({
  list_id = "abc123",
  email = "john@example.com",
  name = "John Doe"
})

print(result.message)
```

---

## get_current_user

Get the authenticated user's Campaign Monitor account details.

### Parameters

None.

### Example

```lua
local result = app.integrations["campaign-monitor"].get_current_user()

print("Account: " .. result.EmailAddress)
print("Name: " .. result.Name)
```

---

## Multi-Account Usage

If you have multiple Campaign Monitor accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["campaign-monitor"].list_lists({})

-- Explicit default (portable across setups)
app.integrations["campaign-monitor"].default.list_lists({})

-- Named accounts
app.integrations["campaign-monitor"].marketing.list_lists({})
app.integrations["campaign-monitor"].transactional.list_lists({})
```

All functions are identical across accounts — only the credentials differ.
