# Unbounce — Lua API Reference

## list_pages

List landing pages in Unbounce.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of pages to return (default: 50, max: 1000). |
| `offset` | integer | no | Offset for pagination (default: 0). |
| `sort` | string | no | Sort order. Prefix with `-` for descending (e.g., `"created_at"`, `"-created_at"`). |

### Example

```lua
local result = app.integrations.unbounce.list_pages({
  limit = 20,
  offset = 0,
  sort = "-created_at"
})

for _, page in ipairs(result.pages) do
  print(page.name .. " — " .. page.url)
end
```

---

## get_page

Get details of a specific landing page.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The Unbounce page ID. |

### Example

```lua
local page = app.integrations.unbounce.get_page({
  page_id = "a2834fde-1234-5678-abcd-1234567890ab"
})

print("Page: " .. page.name)
print("URL: " .. page.url)
print("Visitors: " .. page.visitors)
print("Conversions: " .. page.conversions)
```

---

## list_leads

List form submissions (leads) for a specific page.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_id` | string | yes | The Unbounce page ID to list leads for. |
| `limit` | integer | no | Maximum number of leads to return (default: 50, max: 1000). |
| `offset` | integer | no | Offset for pagination (default: 0). |

### Example

```lua
local result = app.integrations.unbounce.list_leads({
  page_id = "a2834fde-1234-5678-abcd-1234567890ab",
  limit = 25,
  offset = 0
})

for _, lead in ipairs(result.leads) do
  print(lead.form_data.email .. " submitted at " .. lead.created_at)
end
```

---

## get_lead

Get details of a specific lead (form submission).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `lead_id` | string | yes | The Unbounce lead ID. |

### Example

```lua
local lead = app.integrations.unbounce.get_lead({
  lead_id = "b3945gef-2345-6789-bcde-2345678901bc"
})

print("Email: " .. lead.form_data.email)
print("Name: " .. lead.form_data.first_name .. " " .. lead.form_data.last_name)
print("Submitted: " .. lead.created_at)
```

---

## list_sub_accounts

List sub-accounts in Unbounce.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of sub-accounts to return (default: 50, max: 1000). |
| `offset` | integer | no | Offset for pagination (default: 0). |

### Example

```lua
local result = app.integrations.unbounce.list_sub_accounts({
  limit = 20
})

for _, account in ipairs(result.sub_accounts) do
  print(account.name .. " (ID: " .. account.id .. ")")
end
```

---

## get_current_user

Get the currently authenticated Unbounce user profile.

### Parameters

None.

### Example

```lua
local user = app.integrations.unbounce.get_current_user({})

print("Logged in as: " .. user.first_name .. " " .. user.last_name)
print("Email: " .. user.email)
```

---

## Multi-Account Usage

If you have multiple Unbounce accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.unbounce.list_pages({})

-- Explicit default (portable across setups)
app.integrations.unbounce.default.list_pages({})

-- Named accounts
app.integrations.unbounce.client_a.list_pages({})
app.integrations.unbounce.client_b.list_pages({})
```

All functions are identical across accounts — only the credentials differ.
