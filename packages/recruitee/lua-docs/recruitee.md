# Recruitee — Lua API Reference

## list_offers

List job offers (open positions) from Recruitee with optional status filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: `"open"`, `"closed"`, or `"draft"`. Omit for all. |
| `page` | integer | no | Page number for pagination (default: 1). |
| `limit` | integer | no | Results per page (default: 20, max: 100). |

### Example

```lua
-- List all open positions
local result = app.integrations.recruitee.list_offers({
  status = "open"
})

for _, offer in ipairs(result.offers) do
  print(offer.title .. " (" .. offer.status .. ")")
end
```

```lua
-- Paginate through all offers
local result = app.integrations.recruitee.list_offers({
  page = 2,
  limit = 50
})
```

---

## get_offer

Get details for a specific job offer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The offer ID to retrieve. |

### Example

```lua
local result = app.integrations.recruitee.get_offer({
  id = 12345
})

print(result.offer.title)
print(result.offer.description)
print(result.offer.status)
print(result.offer.location)
```

---

## list_candidates

List candidates from Recruitee with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1). |
| `limit` | integer | no | Results per page (default: 20, max: 100). |

### Example

```lua
-- List recent candidates
local result = app.integrations.recruitee.list_candidates({
  limit = 10
})

for _, candidate in ipairs(result.candidates) do
  print(candidate.name .. " <" .. candidate.email .. ">")
end
```

---

## get_candidate

Get details for a specific candidate.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The candidate ID to retrieve. |

### Example

```lua
local result = app.integrations.recruitee.get_candidate({
  id = 67890
})

print(result.candidate.name)
print(result.candidate.email)
print(result.candidate.phone)
```

---

## list_departments

List all departments in Recruitee.

### Parameters

None.

### Example

```lua
local result = app.integrations.recruitee.list_departments()

for _, dept in ipairs(result.departments) do
  print(dept.name .. " (ID: " .. dept.id .. ")")
end
```

---

## get_current_user

Get the currently authenticated Recruitee user.

### Parameters

None.

### Example

```lua
local result = app.integrations.recruitee.get_current_user()

print("Logged in as: " .. result.first_name .. " " .. result.last_name)
print("Email: " .. result.email)
print("Role: " .. result.role)
```

---

## Multi-Account Usage

If you have multiple Recruitee accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.recruitee.list_offers({...})

-- Explicit default (portable across setups)
app.integrations.recruitee.default.list_offers({...})

-- Named accounts
app.integrations.recruitee.production.list_offers({...})
app.integrations.recruitee.staging.list_offers({...})
```

All functions are identical across accounts — only the credentials differ.
