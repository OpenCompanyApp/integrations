# ShipEngine

Namespace: `shipengine`

ShipEngine tools map one-to-one to the official ShipEngine OpenAPI 3.0 operation set. ShipEngine's public docs note that the service is being rebranded as ShipStation API, while existing ShipEngine endpoints continue to function unchanged.

Authentication uses an API key. The integration sends the configured key as the `API-Key` header.

## Request Shape

- Path and query parameters use snake_case tool keys while preserving ShipEngine's official HTTP parameter names internally.
- JSON payload endpoints accept a `body` object matching the documented ShipEngine request schema for that operation.
- Array query parameters use ShipEngine's OpenAPI serialization hints. Most arrays are repeated query keys; parameters marked `explode: false`, such as `refund_status`, are sent as comma-separated values.
- Returned data is the decoded ShipEngine JSON response. Empty successful responses return `{ success, status }`.

## Common Tools

- `shipengine_list_account_settings`: List Account Settings (`GET /v1/account/settings`)
- `shipengine_list_account_images`: List Account Images (`GET /v1/account/settings/images`)
- `shipengine_create_account_image`: Create an Account Image (`POST /v1/account/settings/images`)
- `shipengine_get_account_settings_images_by_id`: Get Account Image By ID (`GET /v1/account/settings/images/{label_image_id}`)
- `shipengine_update_account_settings_images_by_id`: Update Account Image By ID (`PUT /v1/account/settings/images/{label_image_id}`)
- `shipengine_delete_account_image_by_id`: Delete Account Image By Id (`DELETE /v1/account/settings/images/{label_image_id}`)
- `shipengine_parse_address`: Parse an address (`PUT /v1/addresses/recognize`)
- `shipengine_validate_address`: Validate An Address (`POST /v1/addresses/validate`)
- `shipengine_list_batches`: List Batches (`GET /v1/batches`)
- `shipengine_create_batch`: Create A Batch (`POST /v1/batches`)
- `shipengine_get_batch_by_external_id`: Get Batch By External ID (`GET /v1/batches/external_batch_id/{external_batch_id}`)
- `shipengine_delete_batch`: Delete Batch By Id (`DELETE /v1/batches/{batch_id}`)
- `shipengine_get_batch_by_id`: Get Batch By ID (`GET /v1/batches/{batch_id}`)
- `shipengine_update_batch`: Update Batch By Id (`PUT /v1/batches/{batch_id}`)

## Examples

```lua
local carriers = shipengine.shipengine_list_carriers({})

local shipments = shipengine.shipengine_list_shipments({
  shipment_status = "pending",
  page = 1,
  page_size = 25
})

local rates = shipengine.shipengine_calculate_rates({
  body = {
    rate_options = { carrier_ids = { "se-123456" } },
    shipment = {
      validate_address = "no_validation",
      ship_to = { name = "Receiver", address_line1 = "123 Example St", city_locality = "Austin", state_province = "TX", postal_code = "78701", country_code = "US" },
      ship_from = { name = "Sender", address_line1 = "456 Example Ave", city_locality = "Austin", state_province = "TX", postal_code = "78702", country_code = "US" },
      packages = { { weight = { value = 1, unit = "pound" } } }
    }
  }
})
```

Use sandbox or test credentials when validating label-purchase workflows. Some write operations can create billable shipments, labels, carrier connections, or insurance changes in live accounts.
