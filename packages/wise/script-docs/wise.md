# Wise — Ruby API Reference

## list_profiles

List all Wise profiles (personal and business) for the authenticated user.

### Parameters

None.

### Example

```ruby
result = app.integrations.wise.list_profiles()
result.each do |profile|
  puts((profile.id).to_s + ": " + (profile.type).to_s + " — " + (profile.firstName).to_s + " " + (profile.lastName).to_s)
end
```
---

## get_profile

Get details of a specific Wise profile by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profile_id` | integer | yes | The Wise profile ID. |

### Example

```ruby
result = app.integrations.wise.get_profile(profile_id: 123456)
puts("Type: " + (result.type).to_s)
puts("Name: " + (result.firstName).to_s + " " + (result.lastName).to_s)
```
---

## list_balances

List multi-currency account balances for a Wise profile.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profile_id` | integer | yes | The Wise profile ID to list balances for. |
| `types` | string | no | Comma-separated balance types. Defaults to `STANDARD,SAVINGS`. |

### Example

```ruby
result = app.integrations.wise.list_balances(profile_id: 123456, types: "STANDARD,SAVINGS")
result.each do |account|
  account.balances.each do |balance|
    puts((balance.currency).to_s + ": " + (balance.amount.value).to_s)
  end
end
```
---

## list_transfers

List Wise transfers with optional filtering by profile, status, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of transfers to return. |
| `offset` | integer | no | Number of transfers to skip for pagination. |
| `profile_id` | integer | no | Filter transfers by profile ID. Sent to Wise as `profile`. |
| `status` | string | no | Filter by transfer status (e.g. `incoming_payment_waiting`, `processing`, `funds_converted`, `funds_refunded`, `outgoing_payment_sent`). |

### Example

```ruby
# List recent transfers
result = app.integrations.wise.list_transfers(limit: 10)
result.each do |transfer|
  puts((transfer.id).to_s + ": " + (transfer.sourceCurrency).to_s + " " + (transfer.sourceAmount).to_s + " -> " + (transfer.targetCurrency).to_s)
end
```
```ruby
# Filter by status
result = app.integrations.wise.list_transfers(status: "outgoing_payment_sent", profile_id: 123456)
```
---

## get_transfer

Get details of a specific Wise transfer by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `transfer_id` | integer | yes | The Wise transfer ID. |

### Example

```ruby
result = app.integrations.wise.get_transfer(transfer_id: 789012)
puts("Status: " + (result.status).to_s)
puts("Amount: " + (result.sourceCurrency).to_s + " " + (result.sourceAmount).to_s)
puts("Rate: " + (result.rate).to_s)
```
---

## create_transfer

Create a new money transfer on Wise.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `target_account` | integer | yes | Target account ID (recipient account to credit). |
| `quote_uuid` | string | yes | V2 quote UUID for this transfer. |
| `customer_transaction_id` | string | yes | UUID used by Wise for idempotency. Reuse it when retrying the same create request. |
| `source_account` | integer | no | Optional refund recipient source account ID. |
| `reference` | string | no | Payment reference or description for the transfer. |
| `details` | object | no | Additional transfer details returned by Wise transfer-requirements. |

### Example

```ruby
result = app.integrations.wise.create_transfer(target_account: 222222, quote_uuid: "11111111-2222-3333-4444-555555555555", customer_transaction_id: "aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee", reference: "Invoice #1234")
puts("Transfer ID: " + (result.id).to_s)
puts("Status: " + (result.status).to_s)
```
---

## get_current_user

Get details of the currently authenticated Wise user.

### Parameters

None.

### Example

```ruby
result = app.integrations.wise.get_current_user()
puts("Name: " + (result.firstName).to_s + " " + (result.lastName).to_s)
puts("Email: " + (result.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Wise accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
