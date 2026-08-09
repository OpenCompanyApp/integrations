# Cal.com Legacy Alias JavaScript Reference

Namespace: `cal-com`

This package is a legacy compatibility alias for the canonical `cal`
integration. New agents should use `app.integrations.cal`; existing callers can
continue using `app.integrations["cal-com"]` while hosts migrate credentials and
tool references.

The legacy tools delegate to the same Cal.com API v2 client as `cal` and use
the same bearer token types: Cal.com API keys prefixed with `cal_`, managed-user
access tokens, or OAuth access tokens.

## Legacy Tools

```js
var event_types = app.integrations["cal-com"].list_event_types({ limit: 20 })
var event_type = app.integrations["cal-com"].get_event_type({ id: 123 })
var bookings = app.integrations["cal-com"].list_bookings({ status: "upcoming" })
var booking = app.integrations["cal-com"].get_booking({ id: "booking_uid_or_id" })
var teams = app.integrations["cal-com"].list_teams({})
var me = app.integrations["cal-com"].get_current_user({})
```
Booking writes:

```js
var created = app.integrations["cal-com"].create_booking({
  event_type_id: 123,
  start: "2026-05-07T10:00:00Z",
  end: "2026-05-07T10:30:00Z",
  responses: {
    name: "Jane Example",
    email: "jane@example.test",
  },
})
```
Dedicated legacy tools accept snake_case parameters. Some old camelCase
parameters, such as `eventTypeId`, remain accepted for compatibility.
