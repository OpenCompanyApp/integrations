# Pipedrive — Lua API Reference

## list_deals

List deals in Pipedrive with optional filters for user, person, organization, and status.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | integer | no | Filter deals by assigned user ID |
| `person_id` | integer | no | Filter deals by person ID |
| `org_id` | integer | no | Filter deals by organization ID |
| `status` | string | no | Filter by status: `"open"`, `"won"`, `"lost"`, `"deleted"` |
| `limit` | integer | no | Max results (default: 25, max: 500) |
| `start` | integer | no | Pagination start offset (0-based) |

### Example

```lua
local result = app.integrations.pipedrive.list_deals({
  status = "open",
  limit = 10
})

for _, deal in ipairs(result.deals) do
  print(deal.id .. ": " .. deal.title .. " (" .. (deal.value or "0") .. " " .. (deal.currency or "") .. ")")
end
```

---

## get_deal

Get full details for a single deal by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The deal ID |

### Example

```lua
local deal = app.integrations.pipedrive.get_deal({
  id = 123
})

print(deal.title)
print("Value: " .. (deal.value or "0") .. " " .. (deal.currency or ""))
print("Status: " .. deal.status)
```

---

## create_deal

Create a new deal in Pipedrive.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | The deal title |
| `value` | number | no | Deal value (numeric) |
| `currency` | string | no | Currency code (e.g., `"USD"`, `"EUR"`) |
| `person_id` | integer | no | ID of the associated person |
| `org_id` | integer | no | ID of the associated organization |
| `stage_id` | integer | no | Pipeline stage ID |
| `pipeline_id` | integer | no | Pipeline ID (omit for default) |
| `status` | string | no | `"open"` (default), `"won"`, or `"lost"` |
| `probability` | number | no | Success probability (0–100) |
| `note` | string | no | Note to attach to the deal |

### Example

```lua
local deal = app.integrations.pipedrive.create_deal({
  title = "New Enterprise Deal",
  value = 50000,
  currency = "USD",
  org_id = 456,
  probability = 75
})

print("Created deal: " .. deal.id .. " - " .. deal.title)
```

---

## list_persons

List persons (contacts) in Pipedrive.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results (default: 25, max: 500) |
| `start` | integer | no | Pagination start offset (0-based) |

### Example

```lua
local result = app.integrations.pipedrive.list_persons({
  limit = 50
})

for _, person in ipairs(result.persons) do
  print(person.id .. ": " .. person.name)
end
```

---

## get_person

Get full details for a single person (contact) by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The person ID |

### Example

```lua
local person = app.integrations.pipedrive.get_person({
  id = 789
})

print(person.name)
if person.email then
  for _, email in ipairs(person.email) do
    print("  Email: " .. email.value)
  end
end
if person.phone then
  for _, phone in ipairs(person.phone) do
    print("  Phone: " .. phone.value)
  end
end
```

---

## list_organizations

List organizations in Pipedrive.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results (default: 25, max: 500) |
| `start` | integer | no | Pagination start offset (0-based) |

### Example

```lua
local result = app.integrations.pipedrive.list_organizations({
  limit = 50
})

for _, org in ipairs(result.organizations) do
  print(org.id .. ": " .. org.name)
end
```

---

## get_current_user

Get the authenticated user's profile.

### Parameters

None.

### Example

```lua
local user = app.integrations.pipedrive.get_current_user({})

print("Logged in as: " .. user.name)
print("Email: " .. user.email)
print("Company: " .. (user.company_name or ""))
```

---

## Multi-Account Usage

If you have multiple Pipedrive accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.pipedrive.function_name({...})

-- Explicit default (portable across setups)
app.integrations.pipedrive.default.function_name({...})

-- Named accounts
app.integrations.pipedrive.sales_team.function_name({...})
app.integrations.pipedrive.eu_team.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
