# Microsoft Bookings

Namespace: `microsoft-bookings`

This integration exposes Microsoft Bookings through the official Microsoft Graph v1.0 OpenAPI metadata. It covers booking businesses, appointments, calendar view, customers, custom questions, staff members, services, staff availability, publish/unpublish actions, and booking currencies.

## Authentication

Provide a Microsoft Graph OAuth access token with the Bookings permissions required by the operation, such as `Bookings.Read.All`, `Bookings.ReadWrite.All`, or appointment-specific Bookings permissions.

## Usage notes

- Start with `microsoft_bookings_list_booking_businesses` to discover business IDs.
- Use appointment, service, customer, and staff tools with `booking_business_id` once you know the business.
- OData parameters are normalized without the `$` prefix: `select`, `expand`, `filter`, `orderby`, `top`, `skip`, `search`, and `count`.
- Write endpoints accept a `body` object only when the official OpenAPI operation declares a request body.
- Pass `prefer` when a Graph Bookings endpoint supports a `Prefer` header.

## Example

```lua
local businesses = microsoft_bookings_list_booking_businesses({ top = 10 })
local appointments = microsoft_bookings_booking_businesses_list_appointments({ booking_business_id = "business-id", top = 25 })
local availability = microsoft_bookings_booking_businesses_booking_business_get_staff_availability({ booking_business_id = "business-id", body = { staffIds = { "staff-id" } } })
```
