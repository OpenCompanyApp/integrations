# Eventbrite — JavaScript API Reference

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

```js
var result = app.integrations.eventbrite.list_events({
  status: "live",
  order_by: "start_asc",
})

for (const event of (result.events)) {
  console.log(event.name + " — " + event.start)
}
```
```js
// Paginate through all events
var result = app.integrations.eventbrite.list_events({
  status: "all",
  page: 2,
})
```
---

## get_event

Get full details for a single event by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `event_id` | string | yes | The Eventbrite event ID |

### Example

```js
var result = app.integrations.eventbrite.get_event({
  event_id: "123456789",
})

console.log(result.name.text)
console.log(result.description.html)
console.log(result.venue.name)
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

```js
var result = app.integrations.eventbrite.create_event({
  name: "Annual Tech Meetup 2026",
  start_utc: "2026-06-15T18:00:00Z",
  end_utc: "2026-06-15T21:00:00Z",
  currency: "USD",
  timezone: "America/New_York",
  venue_id: "987654321",
  description: "<p>Join us for an evening of tech talks && networking.</p>",
  capacity: 200,
  listed: true,
})

console.log("Created event ID: " + result.id)
```
### Create an online event

```js
var result = app.integrations.eventbrite.create_event({
  name: "Webinar: AI in Production",
  start_utc: "2026-07-01T14:00:00Z",
  end_utc: "2026-07-01T15:30:00Z",
  currency: "EUR",
  online_event: true,
  summary: "Learn how to deploy AI agents in production environments",
})
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

```js
// Publish a draft event
var result = app.integrations.eventbrite.update_event({
  event_id: "123456789",
  status: "live",
})

// Change venue and capacity
var result = app.integrations.eventbrite.update_event({
  event_id: "123456789",
  venue_id: "111222333",
  capacity: 500,
})
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

```js
var result = app.integrations.eventbrite.list_attendees({
  event_id: "123456789",
})

for (const attendee of (result.attendees)) {
  console.log(attendee.name + " — " + attendee.email + " — " + attendee.ticket_class_name)
}
```
```js
// Filter to not attending
var result = app.integrations.eventbrite.list_attendees({
  event_id: "123456789",
  status: "not_attending",
})
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

```js
var result = app.integrations.eventbrite.get_attendee({
  event_id: "123456789",
  attendee_id: "456789012",
})

console.log(result.profile.first_name)
console.log(result.profile.email)
console.log(result.status)
console.log(result.checked_in)
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

```js
var result = app.integrations.eventbrite.list_venues({})

for (const venue of (result.venues)) {
  console.log(venue.name + " — " + venue.city + ", " + venue.country)
}
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

```js
var result = app.integrations.eventbrite.create_venue({
  name: "Grand Ballroom",
  address_1: "123 Main Street",
  city: "San Francisco",
  region: "California",
  postal_code: "94102",
  country: "US",
  capacity: 500,
})

console.log("Created venue ID: " + result.id)
```
---

## get_current_user

Get the currently authenticated Eventbrite user profile.

### Parameters

None.

### Example

```js
var result = app.integrations.eventbrite.get_current_user({})

console.log("Logged in as: " + result.name)
console.log("Emails: " + vim.inspect(result.emails))
```
---

## Multi-Account Usage

If you have multiple Eventbrite accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.eventbrite.list_events({})

// Explicit default (portable across setups)
app.integrations.eventbrite.default.list_events({})

// Named accounts
app.integrations.eventbrite.work.list_events({})
app.integrations.eventbrite.personal.list_events({})
```
All functions are identical across accounts — only the credentials differ.
