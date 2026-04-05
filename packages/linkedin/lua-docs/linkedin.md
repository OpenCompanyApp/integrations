# LinkedIn — Lua API Reference

## get_profile

Get the authenticated user's full LinkedIn profile.

### Parameters

None.

### Example

```lua
local profile = app.integrations.linkedin.get_profile()

print("ID: " .. profile.id)
print("Name: " .. profile.localizedFirstName .. " " .. profile.localizedLastName)
```

---

## get_current_user

Get the authenticated user's basic LinkedIn identity. Useful for verifying who is authenticated.

### Parameters

None.

### Example

```lua
local user = app.integrations.linkedin.get_current_user()

print("Authenticated as: " .. user.localizedFirstName .. " " .. user.localizedLastName)
print("LinkedIn ID: " .. user.id)
```

---

## list_connections

List the authenticated user's 1st-degree LinkedIn connections.

### Parameters

None.

### Response Fields

| Field | Type | Description |
|-------|------|-------------|
| `elements` | array | List of connection objects |
| `_total` | integer | Total number of connections |
| `paging` | object | Pagination info (count, start, total) |

### Example

```lua
local result = app.integrations.linkedin.list_connections()

print("Total connections: " .. result._total)

for _, conn in ipairs(result.elements) do
  print(conn.id)
end
```

---

## create_post

Create and publish a post on LinkedIn on behalf of the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `text` | string | yes | The text content of the LinkedIn post |
| `author_urn` | string | no | Author URN (e.g., `"urn:li:person:ABC123"`). Defaults to the authenticated user. |
| `visibility` | string | no | `"PUBLIC"` or `"CONNECTIONS"`. Default: `"PUBLIC"` |

### Example

```lua
local result = app.integrations.linkedin.create_post({
  text = "Excited to share our latest product update! Check it out.",
  visibility = "PUBLIC"
})

print("Post created: " .. result.id)
```

### Post to connections only

```lua
local result = app.integrations.linkedin.create_post({
  text = "Internal team update — shipping v2.0 next week!",
  visibility = "CONNECTIONS"
})
```

---

## get_organization

Get a LinkedIn organization's details by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization_id` | string | yes | The LinkedIn organization ID (e.g., `"2414183"`) |

### Response Fields

| Field | Type | Description |
|-------|------|-------------|
| `id` | integer | Organization ID |
| `localizedName` | string | Organization name |
| `description` | object | Localized description |
| `website` | object | Localized website URL |
| `industry` | string | Industry classification |

### Example

```lua
local org = app.integrations.linkedin.get_organization({
  organization_id = "2414183"
})

print("Organization: " .. org.localizedName)
print("ID: " .. org.id)
```

---

## Multi-Account Usage

If you have multiple LinkedIn accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.linkedin.get_profile()

-- Explicit default (portable across setups)
app.integrations.linkedin.default.get_profile()

-- Named accounts
app.integrations.linkedin.work.get_profile()
app.integrations.linkedin.personal.get_profile()
```

All functions are identical across accounts — only the credentials differ.
