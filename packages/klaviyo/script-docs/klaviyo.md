# Client for the Klaviyo v2 REST API covering profiles, events, lists, flows, and campaigns — Ruby API Reference

## klaviyo_create_event

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profile_id` | string | yes | The Klaviyo profile ID to associate the event with. |
| `event_name` | string | yes | The event name (metric name), e.g.  |
| `properties` | string | no | Event properties as key-value pairs. |
| `value` | number | no | Numeric value associated with the event (e.g. order total). |
| `time` | string | no | ISO 8601 timestamp of when the event occurred. |

### Example

```ruby
result = app.integrations.klaviyo.create_event(profile_id: "", event_name: "", properties: "")
```
## klaviyo_create_list

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name for the new list. |

### Example

```ruby
result = app.integrations.klaviyo.create_list(name: "")
```
## klaviyo_create_profile

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The profile\ |
| `phone_number` | string | no | Phone number in E.164 format (e.g. +1234567890). |
| `first_name` | string | no | First name of the profile. |
| `last_name` | string | no | Last name of the profile. |
| `properties` | string | no | Custom profile properties as key-value pairs. |

### Example

```ruby
result = app.integrations.klaviyo.create_profile(email: "", phone_number: "", first_name: "")
```
## klaviyo_get_event

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `event_id` | string | yes | The Klaviyo event ID. |

### Example

```ruby
result = app.integrations.klaviyo.get_event(event_id: "")
```
## klaviyo_get_flow

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `flow_id` | string | yes | The Klaviyo flow ID. |

### Example

```ruby
result = app.integrations.klaviyo.get_flow(flow_id: "")
```
## klaviyo_get_list

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The Klaviyo list ID. |

### Example

```ruby
result = app.integrations.klaviyo.get_list(list_id: "")
```
## klaviyo_get_profile

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profile_id` | string | yes | The Klaviyo profile ID. |

### Example

```ruby
result = app.integrations.klaviyo.get_profile(profile_id: "")
```
## klaviyo_list_campaigns

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of campaigns to return (default 20, max 100). |
| `page_cursor` | string | no | Pagination cursor from a previous response to fetch the next page. |

### Example

```ruby
result = app.integrations.klaviyo.list_campaigns(limit: 0, page_cursor: "")
```
## klaviyo_list_events

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `filter` | string | no | Klaviyo filter expression (e.g.  |
| `limit` | integer | no | Number of events to return (default 20, max 100). |
| `page_cursor` | string | no | Pagination cursor from a previous response to fetch the next page. |

### Example

```ruby
result = app.integrations.klaviyo.list_events(filter: "", limit: 0, page_cursor: "")
```
## klaviyo_list_flows

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of flows to return (default 20, max 100). |
| `page_cursor` | string | no | Pagination cursor from a previous response to fetch the next page. |

### Example

```ruby
result = app.integrations.klaviyo.list_flows(limit: 0, page_cursor: "")
```
## klaviyo_list_list_profiles

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The Klaviyo list ID. |
| `limit` | integer | no | Number of profiles to return (default 20, max 100). |
| `page_cursor` | string | no | Pagination cursor from a previous response to fetch the next page. |

### Example

```ruby
result = app.integrations.klaviyo.list_list_profiles(list_id: "", limit: 0, page_cursor: "")
```
## klaviyo_list_lists

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of lists to return (default 20, max 100). |
| `page_cursor` | string | no | Pagination cursor from a previous response to fetch the next page. |

### Example

```ruby
result = app.integrations.klaviyo.list_lists(limit: 0, page_cursor: "")
```
## klaviyo_list_profiles

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of profiles to return (default 20, max 100). |
| `page_cursor` | string | no | Pagination cursor from a previous response to fetch the next page. |

### Example

```ruby
result = app.integrations.klaviyo.list_profiles(limit: 0, page_cursor: "")
```
## klaviyo_subscribe_profile

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The Klaviyo list ID to subscribe the profile to. |
| `email` | string | yes | The subscriber\ |
| `phone_number` | string | no | Phone number in E.164 format. |
| `consented_at` | string | no | ISO 8601 timestamp of when consent was given. |

### Example

```ruby
result = app.integrations.klaviyo.subscribe_profile(list_id: "", email: "", phone_number: "")
```
## klaviyo_update_profile

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profile_id` | string | yes | The Klaviyo profile ID to update. |
| `email` | string | no | New email address for the profile. |
| `phone_number` | string | no | New phone number in E.164 format. |
| `first_name` | string | no | Updated first name. |
| `last_name` | string | no | Updated last name. |
| `properties` | string | no | Custom profile properties to update as key-value pairs. |

### Example

```ruby
result = app.integrations.klaviyo.update_profile(profile_id: "", email: "", phone_number: "")
```
---

## Multi-Account Usage

If you have multiple klaviyo accounts configured, use account-specific namespaces:

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
