# Bitly — Lua API Reference

## shorten_link

Shorten a long URL into a Bitlink.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `long_url` | string | yes | The long URL to shorten |
| `domain` | string | no | Custom short domain (e.g., `"bit.ly"`, `"j.mp"`) |
| `group_guid` | string | no | GUID of the group to associate the link with |

### Example

```lua
local result = app.integrations.bitly.shorten_link({
  long_url = "https://example.com/very/long/path?param=value"
})

print("Short URL: " .. result.link)
print("ID: " .. result.id)
```

---

## get_link

Retrieve details for an existing Bitlink.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `bitlink` | string | yes | Bitlink identifier (e.g., `"bit.ly/abc123"`) |

### Example

```lua
local result = app.integrations.bitly.get_link({
  bitlink = "bit.ly/abc123"
})

print("Long URL: " .. result.long_url)
print("Title: " .. (result.title or "(none)"))
print("Created: " .. result.created_at)
```

---

## update_link

Update a Bitlink's metadata — title, archived status, or tags.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `bitlink` | string | yes | Bitlink identifier (e.g., `"bit.ly/abc123"`) |
| `title` | string | no | Descriptive title for the link |
| `archived` | boolean | no | `true` to archive, `false` to restore |
| `tags` | array | no | Array of tags (e.g., `{"marketing", "campaign"}`) |

### Example

```lua
local result = app.integrations.bitly.update_link({
  bitlink = "bit.ly/abc123",
  title = "Q1 Campaign Link",
  tags = {"marketing", "q1"}
})
```

---

## get_clicks

Get click metrics for a Bitlink over a time range.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `bitlink` | string | yes | Bitlink identifier (e.g., `"bit.ly/abc123"`) |
| `unit` | string | no | Time unit: `"minute"`, `"hour"`, `"day"`, `"week"`, `"month"` (default: `"day"`) |
| `units` | integer | no | Number of units to return. `-1` for all (default: `-1`) |
| `unit_reference` | string | no | ISO 8601 timestamp reference point (e.g., `"2026-01-01T00:00:00+0000"`) |

### Example

```lua
-- Get clicks for the last 30 days
local result = app.integrations.bitly.get_clicks({
  bitlink = "bit.ly/abc123",
  unit = "day",
  units = 30
})

for _, click in ipairs(result.link_clicks) do
  print(click.date .. ": " .. click.clicks .. " clicks")
end
```

---

## list_groups

List all groups in the Bitly account. Groups organize links and are required when creating new Bitlinks in specific organizations.

### Parameters

None.

### Example

```lua
local result = app.integrations.bitly.list_groups()

for _, group in ipairs(result.groups) do
  print(group.guid .. ": " .. group.name)
end
```

---

## get_group

Retrieve details for a specific Bitly group.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `group_guid` | string | yes | The GUID of the group |

### Example

```lua
local result = app.integrations.bitly.get_group({
  group_guid = "Bk1abcDefGhi"
})

print("Group: " .. result.name)
print("Organization: " .. result.organization_guid)
```

---

## create_bitlink

Create a new Bitlink with full metadata (title, tags, custom domain). Use this instead of `shorten_link` when you need to set metadata at creation time.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `long_url` | string | yes | The destination URL |
| `title` | string | no | Descriptive title for the link |
| `tags` | array | no | Array of tags (e.g., `{"marketing"}`) |
| `domain` | string | no | Custom short domain (e.g., `"bit.ly"`) |
| `group_guid` | string | no | GUID of the group to associate the link with |

### Example

```lua
local result = app.integrations.bitly.create_bitlink({
  long_url = "https://example.com/landing-page",
  title = "Q1 Landing Page",
  tags = {"marketing", "q1"},
  domain = "bit.ly"
})

print("Created: " .. result.link)
```

---

## get_current_user

Get the authenticated user's Bitly profile. Useful for verifying the connection is working.

### Parameters

None.

### Example

```lua
local result = app.integrations.bitly.get_current_user()

print("Logged in as: " .. result.login)
print("Name: " .. (result.name or "(none)"))
```

---

## Multi-Account Usage

If you have multiple Bitly accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.bitly.shorten_link({ long_url = "https://example.com" })

-- Explicit default (portable across setups)
app.integrations.bitly.default.shorten_link({ long_url = "https://example.com" })

-- Named accounts
app.integrations.bitly.marketing.shorten_link({ long_url = "https://example.com" })
app.integrations.bitly.social.shorten_link({ long_url = "https://example.com" })
```

All functions are identical across accounts — only the credentials differ.
