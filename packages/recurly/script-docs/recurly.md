# Recurly — Ruby API Reference

## recurly_list_accounts

List billing accounts from Recurly. Supports filtering by email and state, with cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of accounts to return (default: 20, max: 200). |
| `cursor` | string | no | Cursor for pagination — pass the value from a previous response to get the next page. |
| `email` | string | no | Filter accounts by email address. |
| `state` | string | no | Filter by account state: `"active"`, `"closed"`, or `"inactive"`. |

### Example

```ruby
result = app.integrations.recurly.list_accounts(limit: 10, state: "active")
result.data.each do |account|
  puts((account.code).to_s + ": " + ((account.email || "no email")).to_s)
end
```
---

## recurly_get_account

Get details of a specific Recurly billing account by its ID or account code.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The account ID or account code (e.g., `"code-123"` or a UUID). |

### Example

```ruby
result = app.integrations.recurly.get_account(id: "code-123")
puts("Account: " + (result.code).to_s)
puts("Email: " + ((result.email || "N/A")).to_s)
puts("State: " + (result.state).to_s)
```
---

## recurly_create_account

Create a new billing account in Recurly with a unique account code, email, and name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `code` | string | yes | A unique identifier for the account (e.g., `"cust-001"`). |
| `email` | string | no | The account email address. |
| `first_name` | string | no | The account holder's first name. |
| `last_name` | string | no | The account holder's last name. |

### Example

```ruby
result = app.integrations.recurly.create_account(code: "cust-001", email: "john@example.com", first_name: "John", last_name: "Doe")
puts("Created account: " + (result.code).to_s)
```
---

## recurly_list_subscriptions

List subscriptions from Recurly. Supports filtering by account and state, with cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of subscriptions to return (default: 20, max: 200). |
| `cursor` | string | no | Cursor for pagination — pass the value from a previous response to get the next page. |
| `account_id` | string | no | Filter subscriptions by account ID or account code. |
| `state` | string | no | Filter by subscription state: `"active"`, `"canceled"`, `"expired"`, `"future"`, `"paused"`, or `"trial"`. |

### Example

```ruby
result = app.integrations.recurly.list_subscriptions(limit: 10, state: "active")
result.data.each do |sub|
  puts((sub.uuid).to_s + " — " + (sub.state).to_s + " — " + (((sub.plan && sub.plan.code) || "no plan")).to_s)
end
```
### Filter by account

```ruby
result = app.integrations.recurly.list_subscriptions(account_id: "code-123", state: "active")
```
---

## recurly_get_subscription

Get details of a specific Recurly subscription by its UUID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The subscription UUID. |

### Example

```ruby
result = app.integrations.recurly.get_subscription(id: "37c0a116-3b3a-4f57-bf32-45a1c8e0e6d8")
puts("State: " + (result.state).to_s)
puts("Plan: " + (((result.plan && result.plan.code) || "N/A")).to_s)
puts("Amount: " + (((result.unit_amount && (result.unit_amount).to_s) || "N/A")).to_s)
```
---

## recurly_list_plans

List billing plans from Recurly. Supports cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of plans to return (default: 20, max: 200). |
| `cursor` | string | no | Cursor for pagination — pass the value from a previous response to get the next page. |

### Example

```ruby
result = app.integrations.recurly.list_plans(limit: 50)
result.data.each do |plan|
  puts((plan.code).to_s + ": " + (plan.name).to_s + " — $" + (((plan.currencies[0].unit_amount / 100)).to_s).to_s)
end
```
---

## recurly_get_current_user

Verify the Recurly API connection by fetching the first account. Useful as a health check.

### Parameters

This tool takes no parameters.

### Example

```ruby
result = app.integrations.recurly.health_check()
if (result.data && (result.data.length > 0))
  puts("Connected! First account: " + (result.data[0].code).to_s)
else
  puts("Connected, but no accounts found.")
end
```
---

## Multi-Account Usage

If you have multiple Recurly accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
