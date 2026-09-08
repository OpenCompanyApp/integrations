# Segment — Ruby API Reference

## identify

Identify a user in Segment with their traits. Links metadata about a user to a known userId.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `userId` | string | yes | The unique identifier for the user in your database |
| `traits` | object | no | Key-value pairs of user traits (e.g., name, email, plan, role, company) |

### Examples

```ruby
# Identify a user with traits
app.integrations.segment.identify_user(user_id: "user-42", traits: {name: "Jane Doe", email: "jane@example.com", plan: "pro", role: "admin"})
```
```ruby
# Update a user's plan
app.integrations.segment.identify_user(user_id: "user-42", traits: {plan: "enterprise", upgraded_at: "2026-04-05"})
```
---

## track

Track a custom event for a user in Segment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `event` | string | yes | The name of the event (e.g., "Order Completed") |
| `userId` | string | yes | The unique identifier for the user |
| `properties` | object | no | Key-value pairs of event properties |

### Examples

```ruby
# Track a purchase event
app.integrations.segment.track_event(event: "Order Completed", user_id: "user-42", properties: {revenue: 99.99, currency: "USD", productId: "widget-3000", quantity: 2})
```
```ruby
# Track a button click
app.integrations.segment.track_event(event: "CTA Clicked", user_id: "user-42", properties: {button: "Upgrade to Pro", page: "/pricing"})
```
---

## page

Record a page view in Segment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name of the page viewed |
| `userId` | string | yes | The unique identifier for the user |
| `properties` | object | no | Key-value pairs of page properties (url, referrer, title, path) |

### Examples

```ruby
# Record a page view
app.integrations.segment.page_view(name: "Product Listing", user_id: "user-42", properties: {url: "/products/widgets", category: "Widgets", referrer: "https://google.com"})
```
---

## group

Associate a user with a group (organization, company, account) in Segment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `groupId` | string | yes | The unique identifier for the group |
| `userId` | string | yes | The unique identifier for the user |
| `traits` | object | no | Key-value pairs of group traits (name, plan, industry) |

### Examples

```ruby
# Add user to an organization
app.integrations.segment.group(group_id: "org-123", user_id: "user-42", traits: {name: "Acme Corp", plan: "enterprise", industry: "Technology", employee_count: 250})
```
---

## get_workspace

Get details of a Segment workspace by its slug. Requires an API token.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `slug` | string | yes | The workspace slug (e.g., "my-workspace") |

### Examples

```ruby
# Get workspace details
ws = app.integrations.segment.get_workspace(slug: "my-workspace")
puts(ws.name)
puts(ws.id)
```
---

## list_sources

List all sources in a Segment workspace. Requires an API token.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `slug` | string | yes | The workspace slug |

### Examples

```ruby
# List all sources
result = app.integrations.segment.list_sources(slug: "my-workspace")
(result.sources || []).each do |source|
  puts((source.name).to_s + " (" + (source.id).to_s + ")")
end
```
---

## get_source

Get details of a specific Segment source. Requires an API token.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `slug` | string | yes | The workspace slug |
| `id` | string | yes | The source ID |

### Examples

```ruby
# Get source details
source = app.integrations.segment.get_source(slug: "my-workspace", id: "abc123")
puts(source.name)
puts(source.write_key)
```
---

## get_current_user

Get the currently authenticated Segment user. Requires an API token. Useful for verifying credentials.

### Parameters

None.

### Examples

```ruby
# Verify API token is working
user = app.integrations.segment.get_current_user()
puts("Authenticated as: " + (user.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Segment accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.segment.track_event()
# Explicit default (portable across setups)
app.integrations.segment.default.track_event()
# Named accounts
app.integrations.segment.production.track_event()
app.integrations.segment.staging.track_event()
```
All functions are identical across accounts — only the credentials differ.
