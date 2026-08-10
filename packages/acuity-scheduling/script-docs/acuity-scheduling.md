# Acuity Scheduling JavaScript Reference

Namespace: `acuity-scheduling`

Acuity Scheduling tools target the API v1 base URL
`https://acuityscheduling.com/api/v1`. For one Acuity account, configure Basic
Auth with numeric `user_id` and `api_key`. OAuth bearer tokens are also
supported for multi-user applications.

## Core Appointments

```js
var appointments = app.integrations["acuity-scheduling"].list_appointments({
  minDate: "2026-05-01",
  maxDate: "2026-05-31",
  direction: "ASC",
})

var appointment = app.integrations["acuity-scheduling"].get_appointment({ id: 12345 })
var payments = app.integrations["acuity-scheduling"].list_appointment_payments({ id: 12345 })
```
Create, update, cancel, and reschedule appointments:

```js
var created = app.integrations["acuity-scheduling"].create_appointment({
  body: {
    datetime: "2026-05-07T10:00:00-0400",
    appointmentTypeID: 123,
    firstName: "Jane",
    lastName: "Example",
    email: "jane@example.test",
    timezone: "America/New_York",
  },
})

var updated = app.integrations["acuity-scheduling"].update_appointment({
  id: 12345,
  body: { notes: "Prefers video call." },
})

var rescheduled = app.integrations["acuity-scheduling"].reschedule_appointment({
  id: 12345,
  body: { datetime: "2026-05-08T10:00:00-0400", admin: true, noEmail: true },
})

var cancelled = app.integrations["acuity-scheduling"].cancel_appointment({ id: 12345 })
```
## Clients And Setup Data

```js
var clients = app.integrations["acuity-scheduling"].list_clients({
  email: "jane@example.test",
})

var client = app.integrations["acuity-scheduling"].create_client({
  body: { firstName: "Jane", lastName: "Example", email: "jane@example.test" },
})

var calendars = app.integrations["acuity-scheduling"].list_calendars({})
var types = app.integrations["acuity-scheduling"].list_appointment_types({})
var forms = app.integrations["acuity-scheduling"].list_forms({})
```
## Availability

Use dates and times together when building a booking flow.

```js
var dates = app.integrations["acuity-scheduling"].get_availability_dates({
  params: { appointmentTypeID: 123, month: "2026-05" },
})

var times = app.integrations["acuity-scheduling"].get_availability({
  appointmentTypeID: 123,
  date: "2026-05-07",
  timezone: "America/New_York",
})

var classes = app.integrations["acuity-scheduling"].get_availability_classes({
  params: { month: "2026-05" },
})
```
## Store, Blocks, And Webhooks

```js
var products = app.integrations["acuity-scheduling"].list_products({})
var orders = app.integrations["acuity-scheduling"].list_orders({})
var order = app.integrations["acuity-scheduling"].get_order({ id: 987 })

var certificate = app.integrations["acuity-scheduling"].create_certificate({
  body: { productID: 55, email: "jane@example.test" },
})

var block = app.integrations["acuity-scheduling"].create_block({
  body: { calendarID: 1, start: "2026-05-07T13:00:00-0400", end: "2026-05-07T14:00:00-0400" },
})

var webhooks = app.integrations["acuity-scheduling"].list_webhooks({})
var webhook = app.integrations["acuity-scheduling"].create_webhook({
  body: { event: "appointment.scheduled", target: "https://example.test/acuity" },
})
```
## Generic API

Use generic tools for Acuity API v1 endpoints without dedicated wrappers:

```js
var result = app.integrations["acuity-scheduling"].api_get({
  path: "/forms",
})

var posted = app.integrations["acuity-scheduling"].api_post({
  path: "/webhooks",
  body: { event: "appointment.changed", target: "https://example.test/acuity" },
})
```
Generic write tools:

- `api_post({ path, body })`
- `api_put({ path, body })`
- `api_delete({ path, body })`
