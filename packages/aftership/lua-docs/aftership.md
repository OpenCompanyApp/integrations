# AfterShip

Namespace: `aftership`

Use this integration to manage AfterShip Tracking API records, detect couriers,
work with courier connections, and request estimated delivery date predictions.

## Authentication

AfterShip requires `api_key`. The integration sends it as the `as-api-key`
header and uses the versioned Tracking API base path.

## Tools

- Trackings: `aftership_list_trackings`, `aftership_create_tracking`,
  `aftership_get_tracking`, `aftership_update_tracking`,
  `aftership_delete_tracking`, `aftership_retrack_tracking`,
  `aftership_mark_tracking_completed`.
- Couriers: `aftership_list_couriers`, `aftership_detect_courier`.
- Courier connections: `aftership_list_courier_connections`,
  `aftership_create_courier_connections`, `aftership_get_courier_connection`,
  `aftership_update_courier_connection`,
  `aftership_delete_courier_connection`.
- Estimated delivery date: `aftership_predict_estimated_delivery_date`,
  `aftership_batch_predict_estimated_delivery_date`.

## Return Notes

Responses keep AfterShip's upstream envelope and field names. Do not include
real customer emails, phone numbers, addresses, order IDs, or tracking numbers
in tests, fixtures, or public docs.

For create/update tracking tools, you may pass either a full `tracking` object
or top-level fields such as `tracking_number`, `slug`, `title`, and
`destination_country_region`; the integration wraps top-level fields in the
AfterShip `tracking` envelope.

## Examples

```lua
local created = tools.aftership_create_tracking({
  tracking_number = "TEST123456789",
  slug = "usps",
  title = "Order TEST-1001",
  destination_country_region = "USA"
})

local couriers = tools.aftership_detect_courier({
  tracking_number = "TEST123456789",
  destination_country_region = "USA"
})

local active = tools.aftership_list_trackings({
  delivery_status = "InTransit",
  limit = 20
})
```
