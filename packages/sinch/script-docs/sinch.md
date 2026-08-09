# Client for the Sinch SMS API — JavaScript API Reference

## sinch_list_messages

List inbound and outbound SMS messages from Sinch. Supports filtering by direction, recipient, sender, and date range.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `direction` | string | no | Filter by direction: "mt" (mobile terminated / outbound) or "mo" (mobile originated / inbound). |
| `to` | string | no | Filter by destination phone number (E.164 format). |
| `from` | string | no | Filter by originating phone number or sender (E.164 format). |
| `start_date` | string | no | Start date for filtering (ISO 8601 format, e.g. 2024-01-01T00:00:00Z). |
| `end_date` | string | no | End date for filtering (ISO 8601 format, e.g. 2024-12-31T23:59:59Z). |
| `page` | integer | no | Page number for pagination (default 0). |
| `page_size` | integer | no | Number of results per page (default 30, max 100). |

### Example

```js
var result = app.integrations.sinch.sinch_list_messages({
  direction: "mt",
  page: 0,
  page_size: 30,
})
```
## sinch_send_sms

Send an SMS message to one or more recipients via Sinch. Requires sender phone number, recipient(s), and message body.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from` | string | yes | Sender phone number or alphanumeric sender ID (E.164 format for numbers). |
| `to` | array | yes | Array of recipient phone numbers in E.164 format (e.g. ["+1234567890"]). |
| `body` | string | yes | The SMS message body text. |
| `delivery_report` | string | no | Delivery report type: "none", "summary", or "full" (default "none"). |
| `expire_at` | string | no | Message expiration time in ISO 8601 format. |
| `send_at` | string | no | Scheduled send time in ISO 8601 format. |

### Example

```js
var result = app.integrations.sinch.sinch_send_sms({
  from: "+1234567890",
  to: ["+1987654321"],
  body: "Hello from Sinch!",
})
```
## sinch_list_phone_numbers

List all rented phone numbers in your Sinch account with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default 0). |
| `page_size` | integer | no | Number of results per page (default 30, max 100). |

### Example

```js
var result = app.integrations.sinch.sinch_list_phone_numbers({
  page: 0,
  page_size: 30,
})
```
## sinch_get_phone_number

Get details for a specific phone number in your Sinch account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `phone_number` | string | yes | The phone number to look up (E.164 format, e.g. "+1234567890"). |

### Example

```js
var result = app.integrations.sinch.sinch_get_phone_number({
  phone_number: "+1234567890",
})
```
## sinch_list_groups

List all groups in your Sinch account with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default 0). |
| `page_size` | integer | no | Number of results per page (default 30, max 100). |

### Example

```js
var result = app.integrations.sinch.sinch_list_groups({
  page: 0,
  page_size: 30,
})
```
## sinch_get_group

Get details for a specific group in your Sinch account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `group_id` | string | yes | The unique identifier of the group. |

### Example

```js
var result = app.integrations.sinch.sinch_get_group({
  group_id: "group_abc123",
})
```
## sinch_list_batches

List all message batches in your Sinch account with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default 0). |
| `page_size` | integer | no | Number of results per page (default 30, max 100). |

### Example

```js
var result = app.integrations.sinch.sinch_list_batches({
  page: 0,
  page_size: 30,
})
```
---

## Multi-Account Usage

If you have multiple sinch accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.sinch.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.sinch.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.sinch.work.function_name({ /* parameters */ })
app.integrations.sinch.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
