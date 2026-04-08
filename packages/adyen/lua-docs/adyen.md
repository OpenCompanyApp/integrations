# Adyen Integration

Adyen is a global payments platform that enables businesses to accept, process, and settle payments across online, mobile, and in-store channels.

## Configuration

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `api_key` | secret | Yes | Your Adyen API key. Generate one in the Customer Area under **Developers → API Credentials**. |
| `merchant_account` | text | Yes | Your Adyen merchant account code (e.g., `YourCompanyECOM`). |
| `url` | url | No | API base URL. Use `https://checkout-test.adyen.com` for test, `https://checkout-live.adyen.com` for live. |

## Authentication

All requests use the `x-API-key` header for authentication. The API key must have the appropriate permissions (role) for the endpoints you intend to use.

## Tools

### adyen_list_transactions

List transactions from the Adyen transaction feed.

**Parameters:**

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | No | Page number for pagination (starts at 1). |
| `size` | integer | No | Number of transactions per page (default: 20). |

**Example:**

```lua
adyen_list_transactions({ page = 1, size = 50 })
```

---

### adyen_get_transaction

Get details of a specific transaction by its PSP reference.

**Parameters:**

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `psp_reference` | string | Yes | The PSP reference of the transaction. |

**Example:**

```lua
adyen_get_transaction({ psp_reference = "8535296650153317" })
```

---

### adyen_make_payment

Initiate a payment through Adyen. The merchant account is auto-injected.

**Parameters:**

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `amount` | object | Yes | Amount object with `value` (minor units) and `currency`. E.g., `{ value = "1000", currency = "EUR" }`. |
| `payment_method` | object | Yes | Payment method details (type, card details, etc.). |
| `reference` | string | No | Custom reference (e.g., order number). |
| `return_url` | string | No | Redirect URL after payment. |
| `shopper_reference` | string | No | Unique shopper ID for recurring payments. |
| `shopper_email` | string | No | Shopper email address. |

**Example:**

```lua
adyen_make_payment({
    amount = { value = "1000", currency = "EUR" },
    payment_method = { type = "scheme" },
    reference = "ORDER-123"
})
```

---

### adyen_capture_payment

Capture a previously authorized payment. The merchant account is auto-injected.

**Parameters:**

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `psp_reference` | string | Yes | The PSP reference of the authorized payment. |
| `amount` | object | Yes | Capture amount with `value` (minor units) and `currency`. |

**Example:**

```lua
adyen_capture_payment({
    psp_reference = "8535296650153317",
    amount = { value = "1000", currency = "EUR" }
})
```

---

### adyen_refund_payment

Refund a captured or settled payment. The merchant account is auto-injected.

**Parameters:**

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `psp_reference` | string | Yes | The PSP reference of the payment to refund. |
| `amount` | object | Yes | Refund amount with `value` (minor units) and `currency`. |

**Example:**

```lua
adyen_refund_payment({
    psp_reference = "8535296650153317",
    amount = { value = "1000", currency = "EUR" }
})
```

---

### adyen_list_stores

List stores for the configured merchant account. The merchant account is auto-injected.

**Parameters:**

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | No | Maximum number of stores to return. |
| `page` | string | No | Pagination cursor from a previous response. |

**Example:**

```lua
adyen_list_stores({ limit = 20 })
```

---

### adyen_get_current_user

Verify Adyen API connectivity and get merchant account information. Useful as a health check.

**Parameters:** None.

**Example:**

```lua
adyen_get_current_user()
```

---

## Notes

- Amount values are in **minor units**: `1000` = €10.00, `500` = $5.00.
- The `psp_reference` is Adyen's unique identifier for each payment/transaction.
- Always test with the `checkout-test.adyen.com` base URL before switching to live.
