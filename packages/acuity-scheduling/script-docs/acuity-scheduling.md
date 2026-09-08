# Acuity Scheduling Ruby Reference

Namespace: `acuity-scheduling`

Acuity Scheduling tools target the API v1 base URL
`https://acuityscheduling.com/api/v1`. For one Acuity account, configure Basic
Auth with numeric `user_id` and `api_key`. OAuth bearer tokens are also
supported for multi-user applications.

## Core Appointments

```ruby
appointments = app.call("integrations.acuity-scheduling.list_appointments", min_date: "2026-05-01", max_date: "2026-05-31", direction: "ASC")
appointment = app.call("integrations.acuity-scheduling.get_appointment", id: 12345)
payments = app.call("integrations.acuity-scheduling.list_appointment_payments", id: 12345)
```
Create, update, cancel, and reschedule appointments:

```ruby
created = app.call("integrations.acuity-scheduling.create_appointment", body: {datetime: "2026-05-07T10:00:00-0400", appointmentTypeID: 123, firstName: "Jane", lastName: "Example", email: "jane@example.test", timezone: "America/New_York"})
updated = app.call("integrations.acuity-scheduling.update_appointment", id: 12345, body: {notes: "Prefers video call."})
rescheduled = app.call("integrations.acuity-scheduling.reschedule_appointment", id: 12345, body: {datetime: "2026-05-08T10:00:00-0400", admin: true, noEmail: true})
cancelled = app.call("integrations.acuity-scheduling.cancel_appointment", id: 12345)
```
## Clients And Setup Data

```ruby
clients = app.call("integrations.acuity-scheduling.list_clients", email: "jane@example.test")
client = app.call("integrations.acuity-scheduling.create_client", body: {firstName: "Jane", lastName: "Example", email: "jane@example.test"})
calendars = app.call("integrations.acuity-scheduling.list_calendars")
types = app.call("integrations.acuity-scheduling.list_appointment_types")
forms = app.call("integrations.acuity-scheduling.list_forms")
```
## Availability

Use dates and times together when building a booking flow.

```ruby
dates = app.call("integrations.acuity-scheduling.get_availability_dates", params: {appointmentTypeID: 123, month: "2026-05"})
times = app.call("integrations.acuity-scheduling.get_availability", appointment_type_id: 123, date: "2026-05-07", timezone: "America/New_York")
classes = app.call("integrations.acuity-scheduling.get_availability_classes", params: {month: "2026-05"})
```
## Store, Blocks, And Webhooks

```ruby
products = app.call("integrations.acuity-scheduling.list_products")
orders = app.call("integrations.acuity-scheduling.list_orders")
order = app.call("integrations.acuity-scheduling.get_order", id: 987)
certificate = app.call("integrations.acuity-scheduling.create_certificate", body: {productID: 55, email: "jane@example.test"})
block = app.call("integrations.acuity-scheduling.create_block", body: {calendarID: 1, start: "2026-05-07T13:00:00-0400", end: "2026-05-07T14:00:00-0400"})
webhooks = app.call("integrations.acuity-scheduling.list_webhooks")
webhook = app.call("integrations.acuity-scheduling.create_webhook", body: {event: "appointment.scheduled", target: "https://example.test/acuity"})
```
## Generic API

Use generic tools for Acuity API v1 endpoints without dedicated wrappers:

```ruby
result = app.call("integrations.acuity-scheduling.api_get", path: "/forms")
posted = app.call("integrations.acuity-scheduling.api_post", path: "/webhooks", body: {event: "appointment.changed", target: "https://example.test/acuity"})
```
Generic write tools:

- `api_post({ path, body })`
- `api_put({ path, body })`
- `api_delete({ path, body })`
