# Memberstack — Ruby API Reference

## list_members

List members with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Members per page (default: 50, max: 100) |
| `page` | integer | no | Page number, 1-based (default: 1) |

### Example

```ruby
result = app.integrations.memberstack.list(limit: 25, page: 1)
result.data.each do |member|
  puts((member.id).to_s + ": " + (member.email).to_s)
end
```
---

## get_member

Get a single member by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Memberstack member ID |

### Example

```ruby
result = app.integrations.memberstack.get(id: "mem_abc123")
puts(result.data.email)
puts(result.data.metadata.name)
```
---

## create_member

Create a new member.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Email address |
| `password` | string | no | Password for the member |
| `planId` | string | no | Plan ID to assign (use `list_plans` to find IDs) |
| `metadata` | object | no | Custom key-value metadata |

### Example

```ruby
result = app.integrations.memberstack.create(email: "newuser@example.com", password: "secure-password", plan_id: "pln_premium", metadata: {name: "Jane Doe", company: "Acme Inc"})
puts("Created member: " + (result.data.id).to_s)
```
---

## update_member

Update an existing member.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Memberstack member ID |
| `email` | string | no | New email address |
| `planId` | string | no | New plan ID to assign |
| `metadata` | object | no | Metadata to merge with existing values |

### Example

```ruby
result = app.integrations.memberstack.update(id: "mem_abc123", plan_id: "pln_enterprise", metadata: {role: "admin"})
```
---

## delete_member

Permanently delete a member.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Memberstack member ID |

### Example

```ruby
app.integrations.memberstack.delete(id: "mem_abc123")
```
---

## list_plans

List all membership plans.

### Parameters

None.

### Example

```ruby
result = app.integrations.memberstack.list_plans()
result.data.each do |plan|
  puts((plan.id).to_s + ": " + (plan.name).to_s + " ($" + (plan.price).to_s + ")")
end
```
---

## get_current_user

Get the currently authenticated user (verifies API credentials).

### Parameters

None.

### Example

```ruby
result = app.integrations.memberstack.get_current_user()
puts("Authenticated as: " + (result.data.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Memberstack accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.memberstack.list(limit: 10)
# Explicit default (portable across setups)
app.integrations.memberstack.default.list(limit: 10)
# Named accounts
app.integrations.memberstack.production.list(limit: 10)
app.integrations.memberstack.staging.list(limit: 10)
```
All functions are identical across accounts — only the credentials differ.
