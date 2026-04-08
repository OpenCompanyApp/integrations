# Moosend — Lua API Reference

## list_mailing_lists

List all mailing lists in your Moosend account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of mailing lists to return (default: 10). |
| `offset` | integer | no | Offset for pagination (default: 0). |

### Example

```lua
local result = app.integrations.moosend.list_mailing_lists({
  limit = 20,
  offset = 0
})

for _, list in ipairs(result.MailingLists) do
  print(list.Name .. " (ID: " .. list.ID .. ") — " .. list.ActiveMemberCount .. " active subscribers")
end
```

---

## get_mailing_list

Get detailed information about a specific mailing list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The mailing list ID. |

### Example

```lua
local result = app.integrations.moosend.get_mailing_list({
  id = "abc123-def456"
})

local list = result.MailingList
print("List: " .. list.Name)
print("Active subscribers: " .. list.ActiveMemberCount)
print("Unsubscribed: " .. list.UnsubscribedMemberCount)
```

---

## create_mailing_list

Create a new mailing list in Moosend.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name for the new mailing list. |

### Example

```lua
local result = app.integrations.moosend.create_mailing_list({
  name = "Newsletter Subscribers"
})

print("Created list with ID: " .. result.MailingList.ID)
```

---

## list_subscribers

List subscribers for a specific mailing list. Supports filtering by status and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The mailing list ID to retrieve subscribers for. |
| `limit` | integer | no | Maximum number of subscribers to return (default: 10). |
| `page` | integer | no | Page number for pagination (default: 1). |
| `status` | string | no | Filter by status: `"Subscribed"`, `"Unsubscribed"`, `"Bounced"`, `"Removed"`. |

### Example

```lua
local result = app.integrations.moosend.list_subscribers({
  list_id = "abc123-def456",
  limit = 50,
  page = 1,
  status = "Subscribed"
})

for _, sub in ipairs(result.Subscribers) do
  print(sub.Email .. " — " .. (sub.Name or "N/A"))
end
```

---

## add_subscriber

Add a new subscriber to a Moosend mailing list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The mailing list ID to add the subscriber to. |
| `email` | string | yes | The subscriber's email address. |
| `name` | string | no | The subscriber's name. |

### Example

```lua
local result = app.integrations.moosend.add_subscriber({
  list_id = "abc123-def456",
  email = "user@example.com",
  name = "Jane Doe"
})

print("Added subscriber ID: " .. result.Subscriber.ID)
```

---

## list_campaigns

List all email campaigns in your Moosend account. Supports filtering by status and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of campaigns to return (default: 10). |
| `page` | integer | no | Page number for pagination (default: 1). |
| `status` | string | no | Filter by status: `"Sent"`, `"Draft"`, `"Scheduled"`, `"Sending"`. |

### Example

```lua
local result = app.integrations.moosend.list_campaigns({
  limit = 20,
  page = 1,
  status = "Sent"
})

for _, campaign in ipairs(result.Campaigns) do
  print(campaign.Name .. " — Subject: " .. campaign.Subject .. " — Status: " .. campaign.Status)
end
```

---

## get_current_user

Get the current authenticated Moosend user. Useful as a health check to verify API connectivity.

### Parameters

None.

### Example

```lua
local result = app.integrations.moosend.get_current_user({})

print("User: " .. result.User.Email)
print("Account: " .. result.User.Company)
```

---

## Multi-Account Usage

If you have multiple Moosend accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.moosend.function_name({...})

-- Explicit default (portable across setups)
app.integrations.moosend.default.function_name({...})

-- Named accounts
app.integrations.moosend.work.function_name({...})
app.integrations.moosend.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
