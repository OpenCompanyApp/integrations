# Eventbrite — Ruby API Reference

## list_events

List events for the configured Eventbrite organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: `live`, `draft`, `started`, `ended`, `completed`, `canceled`, or `all` |
| `order_by` | string | no | Sort order: `start_asc`, `start_desc`, `created_asc`, `created_desc`, `name_asc` |
| `page` | integer | no | Page number for pagination (default: 1) |
| `continuation` | string | no | Continuation token from a previous response |

### Examples

```ruby
result = app.integrations.eventbrite.list(status: "live", order_by: "start_asc")
result.events.each do |event|
  puts((event.name).to_s + " — " + (event.start).to_s)
end
```
```ruby
# Paginate through all events
result = app.integrations.eventbrite.list(status: "all", page: 2)
```
---

## get_event

Get full details for a single event by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `event_id` | string | yes | The Eventbrite event ID |

### Example

```ruby
result = app.integrations.eventbrite.get(event_id: "123456789")
puts(result.name.text)
puts(result.description.html)
puts(result.venue.name)
```
---

## create_event

Create a new event on Eventbrite.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Event title |
| `start_utc` | string | yes | Start time in UTC (ISO 8601, e.g. `"2026-06-15T18:00:00Z"`) |
| `end_utc` | string | yes | End time in UTC (ISO 8601, e.g. `"2026-06-15T21:00:00Z"`) |
| `currency` | string | yes | Three-letter currency code (`USD`, `EUR`, `GBP`, etc.) |
| `description` | string | no | HTML description of the event |
| `summary` | string | no | Short plaintext summary (max 140 chars) |
| `timezone` | string | no | Event timezone (e.g. `"America/New_York"`) |
| `venue_id` | string | no | ID of an existing venue (omit for online events) |
| `online_event` | boolean | no | Set to `true` for a virtual event |
| `listed` | boolean | no | Publicly listed (default: `true`) |
| `capacity` | integer | no | Maximum number of attendees |

### Example

```ruby
result = app.integrations.eventbrite.create(name: "Annual Tech Meetup 2026", start_utc: "2026-06-15T18:00:00Z", end_utc: "2026-06-15T21:00:00Z", currency: "USD", timezone: "America/New_York", venue_id: "987654321", description: "<p>Join us for an evening of tech talks && networking.</p>", capacity: 200, listed: true)
puts("Created event ID: " + (result.id).to_s)
```
### Create an online event

```ruby
result = app.integrations.eventbrite.create(name: "Webinar: AI in Production", start_utc: "2026-07-01T14:00:00Z", end_utc: "2026-07-01T15:30:00Z", currency: "EUR", online_event: true, summary: "Learn how to deploy AI agents in production environments")
```
---

## update_event

Update an existing event. Only the fields you provide will be changed.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `event_id` | string | yes | The event ID to update |
| `name` | string | no | New event title |
| `start_utc` | string | no | New start time in UTC |
| `end_utc` | string | no | New end time in UTC |
| `description` | string | no | New HTML description |
| `summary` | string | no | New short summary |
| `timezone` | string | no | New timezone |
| `venue_id` | string | no | New venue ID |
| `online_event` | boolean | no | Toggle online/in-person |
| `listed` | boolean | no | Toggle public listing |
| `status` | string | no | `"live"` to publish, `"draft"` to unpublish |
| `capacity` | integer | no | New max attendees |
| `currency` | string | no | New currency code |

### Example

```ruby
# Publish a draft event
result = app.integrations.eventbrite.update(event_id: "123456789", status: "live")
# Change venue and capacity
result = app.integrations.eventbrite.update(event_id: "123456789", venue_id: "111222333", capacity: 500)
```
---

## list_attendees

List attendees for an event with profile information and ticket details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `event_id` | string | yes | The Eventbrite event ID |
| `status` | string | no | Filter: `"attending"`, `"not_attending"`, or `"all"` (default: `"attending"`) |
| `page` | integer | no | Page number (default: 1) |
| `continuation` | string | no | Continuation token for pagination |

### Example

```ruby
result = app.integrations.eventbrite.list_attendees(event_id: "123456789")
result.attendees.each do |attendee|
  puts((attendee.name).to_s + " — " + (attendee.email).to_s + " — " + (attendee.ticket_class_name).to_s)
end
```
```ruby
# Filter to not attending
result = app.integrations.eventbrite.list_attendees(event_id: "123456789", status: "not_attending")
```
---

## get_attendee

Get full details for a single attendee.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `event_id` | string | yes | The Eventbrite event ID |
| `attendee_id` | string | yes | The attendee ID |

### Example

```ruby
result = app.integrations.eventbrite.get_attendee(event_id: "123456789", attendee_id: "456789012")
puts(result.profile.first_name)
puts(result.profile.email)
puts(result.status)
puts(result.checked_in)
```
---

## list_venues

List venues for the configured organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `continuation` | string | no | Continuation token |

### Example

```ruby
result = app.integrations.eventbrite.list_venues()
result.venues.each do |venue|
  puts((venue.name).to_s + " — " + (venue.city).to_s + ", " + (venue.country).to_s)
end
```
---

## create_venue

Create a new venue for events.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Venue name |
| `address_1` | string | yes | Street address |
| `city` | string | yes | City |
| `country` | string | yes | Two-letter country code (`US`, `GB`, `NL`, etc.) |
| `region` | string | no | State or region |
| `postal_code` | string | no | ZIP or postal code |
| `latitude` | string | no | Latitude for map |
| `longitude` | string | no | Longitude for map |
| `capacity` | integer | no | Maximum capacity |

### Example

```ruby
result = app.integrations.eventbrite.create_venue(name: "Grand Ballroom", address_1: "123 Main Street", city: "San Francisco", region: "California", postal_code: "94102", country: "US", capacity: 500)
puts("Created venue ID: " + (result.id).to_s)
```
---

## get_current_user

Get the currently authenticated Eventbrite user profile.

### Parameters

None.

### Example

```ruby
result = app.integrations.eventbrite.get_current_user()
puts("Logged in as: " + (result.name).to_s)
puts("Emails: " + (JSON.generate(result.emails)).to_s)
```
---

## Multi-Account Usage

If you have multiple Eventbrite accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.eventbrite.list()
# Explicit default (portable across setups)
app.integrations.eventbrite.default.list()
# Named accounts
app.integrations.eventbrite.work.list()
app.integrations.eventbrite.personal.list()
```
All functions are identical across accounts — only the credentials differ.
