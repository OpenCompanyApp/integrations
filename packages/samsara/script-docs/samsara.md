# Samsara

Namespace: `samsara`

Samsara exposes fleet telematics, driver workflow, routing, address book, tag, document, maintenance, sensor, and user APIs. This package uses bearer-token authentication against the current REST API base URL `https://api.samsara.com` and keeps responses in Samsara's original JSON shape.

## Coverage

Core tools:

- Vehicles and drivers: list/get vehicles, list/get drivers, vehicle stats snapshot/history/feed
- Trailers and equipment: list/get/create/update/delete where supported, stats snapshot/history/feed
- Routes: list/get/create/update/delete route plans
- Addresses and tags: list/get/create/update/delete address book entries and tags
- Documents: list/get/create documents and list/get document types
- Maintenance: defects, defect history, defect types
- Sensors and users: list sensors, current user, list/get users
- Raw helpers: `samsara_api_get`, `samsara_api_post`, `samsara_api_patch`, `samsara_api_delete`

## Usage Notes

Samsara tokens are permissioned by endpoint category and by account license. A 401 usually means the token is missing or invalid. A 403 usually means the token exists but lacks the required endpoint permission or Samsara license.

Most list endpoints use cursor pagination with `after`, `limit`, and a `pagination.endCursor` value in the response. Many stats endpoints require `types`; pass either a comma-separated string or an array of strings. The integration preserves repeated query parameters when arrays are provided.

## Examples

```ruby
vehicles = app.integrations.samsara.list_vehicles(limit: 100)
stats = app.integrations.samsara.get_vehicle_stats(types: ["gps", "obdOdometerMeters"], vehicle_ids: ["vehicle-id"])
route = app.integrations.samsara.create_route(payload: {name: "Morning deliveries", driverId: "driver-id", stops: {}})
documents = app.integrations.samsara.list_documents(start_time: "2026-01-01T00:00:00Z", end_time: "2026-01-31T23:59:59Z")
```
Use raw helpers for newly released Samsara endpoints while staying scoped to the configured API host:

```ruby
users = app.integrations.samsara.api_get(path: "/users", limit: 50)
```
For feeds such as vehicle, trailer, or equipment stats, keep the `pagination.endCursor` and pass it as `after` on the next request. If `hasNextPage` is false, wait before polling again.
