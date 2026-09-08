# Splitwise — Ruby API Reference

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

```ruby
# List recent expenses
result = app.integrations.splitwise.list_expenses()
result.expenses.each do |expense|
  puts((expense.description).to_s + ": $" + (expense.cost).to_s)
end
# Filter by group and date range
result = app.integrations.splitwise.list_expenses(group_id: 12345, dated_after: "2025-01-01", dated_before: "2025-03-31", limit: 50)
```
---

## get_expense

Get detailed information about a specific expense.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The expense ID to retrieve |

### Examples

```ruby
result = app.integrations.splitwise.get_expense(id: 98765)
expense = result.expense
puts((expense.description).to_s + " — $" + (expense.cost).to_s)
expense.users.each do |user|
  puts("  " + (user.user.first_name).to_s + " owes: $" + (user.owed_share).to_s)
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

```ruby
# Split equally between two users
result = app.integrations.splitwise.create_expense(cost: "60.00", description: "Dinner at Italian restaurant", users: [{user_id: 11111}, {user_id: 22222}], currency_code: "USD")
puts("Created expense ID: " + (result.expenses[0].id).to_s)
# Custom split amounts
result = app.integrations.splitwise.create_expense(cost: "100.00", description: "Hotel room", users: [{user_id: 11111, owed_share: "60.00"}, {user_id: 22222, owed_share: "40.00"}], group_id: 12345, category_id: 13)
# Expense in a group with date
result = app.integrations.splitwise.create_expense(cost: "25.50", description: "Lunch", users: [{user_id: 11111}, {user_id: 22222}, {user_id: 33333}], group_id: 12345, date: "2025-03-15", currency_code: "EUR")
```
---

## list_groups

List all groups the current user belongs to.

### Parameters

None.

### Examples

```ruby
result = app.integrations.splitwise.list_groups()
result.groups.each do |group|
  puts((group.name).to_s + " (" + (group.members.length).to_s + " members)")
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

```ruby
result = app.integrations.splitwise.get_group(id: 12345)
group = result.group
puts("Group: " + (group.name).to_s)
group.members.each do |member|
  puts("  " + (member.first_name).to_s + " — balance: $" + (member.balance).to_s)
end
```
---

## list_friends

List all friends with current balance information.

### Parameters

None.

### Examples

```ruby
result = app.integrations.splitwise.list_friends()
result.friends.each do |friend|
  balance = ((friend.balance[0] && friend.balance[0].amount) || "0.00")
  puts((friend.first_name).to_s + " " + (friend.last_name).to_s + " — balance: $" + (balance).to_s)
end
```
---

## get_current_user

Get the authenticated user's profile information.

### Parameters

None.

### Examples

```ruby
result = app.integrations.splitwise.get_current_user()
user = result.user
puts("Logged in as: " + (user.first_name).to_s + " " + (user.last_name).to_s)
puts("Email: " + (user.email).to_s)
puts("Default currency: " + (user.default_currency).to_s)
```
---

## Multi-Account Usage

If you have multiple Splitwise accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.splitwise.list_expenses()
# Explicit default (portable across setups)
app.integrations.splitwise.default.list_expenses()
# Named accounts
app.integrations.splitwise.work.list_expenses()
app.integrations.splitwise.personal.list_expenses()
```
All functions are identical across accounts — only the credentials differ.
