# Adyen Integration

Adyen exposes official Checkout v72 and Management v3 operations generated from `Adyen/adyen-openapi`.

## Configuration

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `api_key` | secret | Yes | Adyen API key sent as `X-API-Key`. |
| `merchant_account` | text | No | Default merchant account or merchant ID. Used for Checkout `merchantAccount`, Management `merchantId` path parameters, and Management `merchantId` query parameters when omitted. |
| `company_id` | text | No | Default company ID for company-scoped Management API paths. |
| `url` | url | No | Checkout API base URL without version. Test default is `https://checkout-test.adyen.com`. Live URLs must use the Adyen live prefix URL without the version suffix. |
| `management_url` | url | No | Management API base URL without version. Test default is `https://management-test.adyen.com`. |

## Usage Pattern

Tool names are generated from the official service and operation ID:

- `adyen_checkout_post_payments`
- `adyen_checkout_get_payment_links_link_id`
- `adyen_management_get_merchants_merchant_id_stores`
- `adyen_management_post_merchants_merchant_id_webhooks`

Path and query parameters are exposed as snake_case tool arguments. JSON request payloads are passed through the `body` argument using Adyen's official field names.

```lua
adyen_checkout_post_payments({
  body = {
    amount = { value = 1000, currency = "EUR" },
    paymentMethod = { type = "scheme" },
    reference = "ORDER-123",
    returnUrl = "https://example.test/return"
  }
})
```

When `merchant_account` is configured, Checkout request bodies receive `merchantAccount` automatically if it is not already present.

```lua
adyen_checkout_post_payment_methods({
  body = {
    amount = { value = 1000, currency = "EUR" },
    countryCode = "NL",
    channel = "Web"
  }
})
```

Management paths accept explicit IDs or use configured defaults for common account identifiers.

```lua
adyen_management_get_merchants_merchant_id_stores({
  merchant_id = "MerchantECOM",
  page_size = 20
})

adyen_management_get_companies_company_id_users({
  company_id = "ExampleCompany"
})
```

Additional documented query parameters can be passed exactly as named through `query`.

```lua
adyen_management_get_stores({
  query = {
    merchantId = "MerchantECOM",
    pageSize = 50
  }
})
```

## Return Shape

Tools return the parsed JSON object from Adyen. `204 No Content` responses return an empty object. Errors are normalized into tool errors that include the Adyen HTTP status and message when available.

## Notes

- This package covers official Checkout v72 and Management v3 operations. Other Adyen API families such as Balance Platform, Transfers, Recurring, Payout, Terminal API, and webhooks are separate official specs and are not included in this package surface yet.
- The integration does not invent unsupported transaction lookup tools. Use Adyen webhooks, reports, Balance Platform, or Transfers APIs for transaction-level records outside Checkout.
- Do not put real card details, private shopper data, live merchant identifiers, or real API keys in tests or examples.
