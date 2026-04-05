# Splitwise — Lua API Reference

## list_expenses

List shared expenses for the current user with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `group_id` | integer | no | Filter expenses by group ID |
| `friend_id` | integer | no | Filter expenses by friend ID |
| `dated_after` | string | no | Only expenses after this date (ISO 8601, e.g., `"2025-01-01"`) |
| `dated_before` | string | no | Only expenses before this date (ISO 8601, e.g., `"2025-12-31"`) |
| `limit` | integer | no | Number of expenses to return (default: 20) |
| `offset` | integer | no | Offset for pagination (default: 0) |

### Examples

```lua
-- List recent expenses
local result = app.integrations.splitwise.list_expenses({})
for _, expense in ipairs(result.expenses) do
  print(expense.description .. ": $" .. expense.cost)
end

-- Filter by group and date range
local result = app.integrations.splitwise.list_expenses({
  group_id = 12345,
  dated_after = "2025-01-01",
  dated_before = "2025-03-31",
  limit = 50
})
```

---

## get_expense

Get detailed information about a specific expense.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The expense ID to retrieve |

### Examples

```lua
local result = app.integrations.splitwise.get_expense({ id = 98765 })
local expense = result.expense
print(expense.description .. " — $" .. expense.cost)
for _, user in ipairs(expense.users) do
  print("  " .. user.user.first_name .. " owes: $" .. user.owed_share)
end
```

---

## create_expense

Create a new shared expense in Splitwise.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cost` | string | yes | Total cost of the expense (e.g., `"45.50"`) |
| `description` | string | yes | Description of the expense |
| `users` | array | yes | Array of users sharing the expense. Each user needs `user_id` (integer) and optionally `owed_share` (string). If `owed_share` is omitted, cost is split equally. |
| `group_id` | integer | no | Group ID to assign the expense to |
| `currency_code` | string | no | Three-letter currency code (e.g., `"USD"`, `"EUR"`) |
| `date` | string | no | Date in ISO 8601 format (e.g., `"2025-01-15"`) |
| `category_id` | integer | no | Category ID (e.g., 18 = Food, 9 = Entertainment) |
| `details` | string | no | Additional notes about the expense |

### Examples

```lua
-- Split equally between two users
local result = app.integrations.splitwise.create_expense({
  cost = "60.00",
  description = "Dinner at Italian restaurant",
  users = {
    { user_id = 11111 },
    { user_id = 22222 }
  },
  currency_code = "USD"
})
print("Created expense ID: " .. result.expenses[1].id)

-- Custom split amounts
local result = app.integrations.splitwise.create_expense({
  cost = "100.00",
  description = "Hotel room",
  users = {
    { user_id = 11111, owed_share = "60.00" },
    { user_id = 22222, owed_share = "40.00" }
  },
  group_id = 12345,
  category_id = 13
})

-- Expense in a group with date
local result = app.integrations.splitwise.create_expense({
  cost = "25.50",
  description = "Lunch",
  users = {
    { user_id = 11111 },
    { user_id = 22222 },
    { user_id = 33333 }
  },
  group_id = 12345,
  date = "2025-03-15",
  currency_code = "EUR"
})
```

---

## list_groups

List all groups the current user belongs to.

### Parameters

None.

### Examples

```lua
local result = app.integrations.splitwise.list_groups({})
for _, group in ipairs(result.groups) do
  print(group.name .. " (" .. #group.members .. " members)")
end
```

---

## get_group

Get detailed information about a specific group, including members and balances.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The group ID to retrieve |

### Examples

```lua
local result = app.integrations.splitwise.get_group({ id = 12345 })
local group = result.group
print("Group: " .. group.name)
for _, member in ipairs(group.members) do
  print("  " .. member.first_name .. " — balance: $" .. member.balance)
end
```

---

## list_friends

List all friends with current balance information.

### Parameters

None.

### Examples

```lua
local result = app.integrations.splitwise.list_friends({})
for _, friend in ipairs(result.friends) do
  local balance = friend.balance[1] and friend.balance[1].amount or "0.00"
  print(friend.first_name .. " " .. friend.last_name .. " — balance: $" .. balance)
end
```

---

## get_current_user

Get the authenticated user's profile information.

### Parameters

None.

### Examples

```lua
local result = app.integrations.splitwise.get_current_user({})
local user = result.user
print("Logged in as: " .. user.first_name .. " " .. user.last_name)
print("Email: " .. user.email)
print("Default currency: " .. user.default_currency)
```

---

## Multi-Account Usage

If you have multiple Splitwise accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.splitwise.list_expenses({...})

-- Explicit default (portable across setups)
app.integrations.splitwise.default.list_expenses({...})

-- Named accounts
app.integrations.splitwise.work.list_expenses({...})
app.integrations.splitwise.personal.list_expenses({...})
```

All functions are identical across accounts — only the credentials differ.
