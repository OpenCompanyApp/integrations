# Hunter.io — Ruby API Reference

## domain_search

Search for professional email addresses associated with a domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain` | string | yes | The domain to search (e.g., `"example.com"`) |
| `limit` | integer | no | Maximum number of results (default: 10, max: 100) |
| `offset` | integer | no | Number of results to skip for pagination |
| `type` | string | no | Filter by email type: `"personal"` or `"generic"` |

### Example

```ruby
result = app.integrations.hunter.domain_search(domain: "example.com", limit: 20)
result.data.emails.each do |email|
  puts((email.value).to_s + " - " + ((email.first_name || "")).to_s + " " + ((email.last_name || "")).to_s)
end
```
---

## email_finder

Find the most likely email address for a person based on their name and company domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain` | string | yes | The company domain (e.g., `"example.com"`) |
| `first_name` | string | no | The person's first name |
| `last_name` | string | no | The person's last name |

### Example

```ruby
result = app.integrations.hunter.email_finder(domain: "example.com", first_name: "John", last_name: "Doe")
puts("Email: " + (result.data.email).to_s)
puts("Confidence: " + (result.data.score).to_s + "%")
```
---

## email_verifier

Verify the deliverability of an email address.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The email address to verify |

### Example

```ruby
result = app.integrations.hunter.email_verifier(email: "john@example.com")
puts("Result: " + (result.data.result).to_s)
# deliverable, undeliverable, risky, unknown
puts("Confidence: " + (result.data.score).to_s + "%")
```
---

## email_count

Get the number of email addresses found for a domain. This endpoint does not consume API credits.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain` | string | yes | The domain to count emails for |

### Example

```ruby
result = app.integrations.hunter.email_count(domain: "example.com")
puts("Total emails: " + (result.data.total).to_s)
puts("Personal: " + (result.data.personal).to_s)
puts("Generic: " + (result.data.generic).to_s)
```
---

## list_leads

List leads stored in your Hunter.io account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of leads to return (default: 20, max: 100) |
| `offset` | integer | no | Number of leads to skip for pagination |

### Example

```ruby
result = app.integrations.hunter.list_leads(limit: 50, offset: 0)
result.data.leads.each do |lead|
  puts((lead.id).to_s + ": " + (lead.email).to_s + " - " + ((lead.first_name || "")).to_s + " " + ((lead.last_name || "")).to_s)
end
```
---

## get_lead

Retrieve a single lead by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The lead ID |

### Example

```ruby
result = app.integrations.hunter.get_lead(id: 12345)
puts("Email: " + (result.data.email).to_s)
puts("Name: " + ((result.data.first_name || "")).to_s + " " + ((result.data.last_name || "")).to_s)
```
---

## create_lead

Create a new lead in Hunter.io.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The lead's email address |
| `first_name` | string | no | The lead's first name |
| `last_name` | string | no | The lead's last name |
| `list_id` | integer | no | ID of the lead list to add this lead to |

### Example

```ruby
result = app.integrations.hunter.create_lead(email: "john@example.com", first_name: "John", last_name: "Doe", list_id: 42)
puts("Created lead: " + (result.data.id).to_s)
```
---

## get_current_user

Get account information and API usage for the authenticated Hunter.io user.

### Parameters

None.

### Example

```ruby
result = app.integrations.hunter.get_current_user()
puts("Account: " + (result.data.email).to_s)
puts("Plan: " + (result.data.plan_name).to_s)
puts("Requests used: " + (result.data.usage.requests.used).to_s + " / " + (result.data.usage.requests.limit).to_s)
```
---

## Multi-Account Usage

If you have multiple Hunter.io accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.hunter.domain_search(domain: "example.com")
# Explicit default (portable across setups)
app.integrations.hunter.default.domain_search(domain: "example.com")
# Named accounts
app.integrations.hunter.work.domain_search(domain: "example.com")
app.integrations.hunter.personal.domain_search(domain: "example.com")
```
All functions are identical across accounts — only the credentials differ.
