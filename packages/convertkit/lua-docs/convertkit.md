# ConvertKit — Lua API Reference

## list_subscribers

List subscribers from your ConvertKit account with pagination and sorting.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (starts at 1, default: 1) |
| `per_page` | integer | no | Results per page (max 50, default: 50) |
| `sort_order` | string | no | Sort direction: `"asc"` (oldest first) or `"desc"` (newest first, default) |

### Example

```lua
local result = app.integrations.convertkit.list_subscribers({
  page = 1,
  per_page = 25,
  sort_order = "desc"
})

for _, sub in ipairs(result.subscribers) do
  print(sub.email_address .. " — " .. (sub.first_name or "N/A"))
end
```

---

## get_subscriber

Get details for a single subscriber by their ConvertKit subscriber ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subscriber_id` | integer | yes | The ConvertKit subscriber ID |

### Example

```lua
local result = app.integrations.convertkit.get_subscriber({
  subscriber_id = 12345
})

print(result.subscriber.email_address)
print(result.subscriber.state)
```

---

## create_subscriber

Create or update a subscriber in ConvertKit by email address.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Subscriber email address |
| `first_name` | string | no | Subscriber first name |
| `fields` | object | no | Custom field values as key-value pairs |

### Example

```lua
local result = app.integrations.convertkit.create_subscriber({
  email = "alice@example.com",
  first_name = "Alice",
  fields = { company = "Acme Inc" }
})

print("Created subscriber: " .. result.subscriber.email_address)
```

---

## list_tags

List all tags in your ConvertKit account.

### Parameters

None.

### Example

```lua
local result = app.integrations.convertkit.list_tags({})

for _, tag in ipairs(result.tags) do
  print(tag.id .. ": " .. tag.name)
end
```

---

## create_tag

Create a new tag in ConvertKit.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name for the new tag |

### Example

```lua
local result = app.integrations.convertkit.create_tag({
  name = "VIP Customer"
})

print("Created tag: " .. result.tag.name .. " (ID: " .. result.tag.id .. ")")
```

---

## tag_subscriber

Add a tag to a subscriber by email. Creates the subscriber if they don't exist.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `tag_id` | integer | yes | The tag ID (use `list_tags` to find IDs) |
| `email` | string | yes | Subscriber email address |
| `first_name` | string | no | Subscriber first name (used if creating new subscriber) |

### Example

```lua
local result = app.integrations.convertkit.tag_subscriber({
  tag_id = 99887,
  email = "bob@example.com",
  first_name = "Bob"
})
```

---

## untag_subscriber

Remove a tag from a subscriber by email.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `tag_id` | integer | yes | The tag ID to remove (use `list_tags` to find IDs) |
| `email` | string | yes | Subscriber email address |

### Example

```lua
local result = app.integrations.convertkit.untag_subscriber({
  tag_id = 99887,
  email = "bob@example.com"
})
```

---

## list_forms

List all forms in your ConvertKit account.

### Parameters

None.

### Example

```lua
local result = app.integrations.convertkit.list_forms({})

for _, form in ipairs(result.forms) do
  print(form.id .. ": " .. form.name)
end
```

---

## subscribe_to_form

Subscribe an email address to a ConvertKit form.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | integer | yes | The form ID (use `list_forms` to find IDs) |
| `email` | string | yes | Subscriber email address |
| `first_name` | string | no | Subscriber first name |

### Example

```lua
local result = app.integrations.convertkit.subscribe_to_form({
  form_id = 55443,
  email = "carol@example.com",
  first_name = "Carol"
})
```

---

## list_sequences

List all sequences (courses) in your ConvertKit account.

### Parameters

None.

### Example

```lua
local result = app.integrations.convertkit.list_sequences({})

for _, seq in ipairs(result.courses) do
  print(seq.id .. ": " .. seq.name)
end
```

---

## Multi-Account Usage

If you have multiple ConvertKit accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.convertkit.list_subscribers({...})

-- Explicit default (portable across setups)
app.integrations.convertkit.default.list_subscribers({...})

-- Named accounts
app.integrations.convertkit.work.list_subscribers({...})
app.integrations.convertkit.personal.list_subscribers({...})
```

All functions are identical across accounts — only the credentials differ.
