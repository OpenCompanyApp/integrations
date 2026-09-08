# Revolut — Ruby API Reference

## Overview

The Revolut integration provides tools for managing Revolut Business banking data — accounts, transactions, cards, and team members. All calls go through `app.integrations.revolut.<method>({ ... })`.

## Authentication

Revolut uses a **Bearer access token** (`oa_prod_...` or `oa_sandbox_...`). The token is sent via the `Authorization: Bearer <token>` header to the Revolut Business API.

Configure it in the integration settings under **Access Token**. Generate one in the **Revolut Business Developer Portal**. Use a token with only the permissions you need. Production uses `https://b2b.revolut.com/api/1.0`; sandbox uses `https://sandbox-b2b.revolut.com/api/1.0`.

## Accounts

### `app.integrations.revolut.list_accounts(...)`

List all Revolut business accounts. Returns account IDs, names, balances, and currency information.

```ruby
result = app.integrations.revolut.list_accounts()
```
### `app.integrations.revolut.get_account(...)`

Retrieve a Revolut account by ID with full details.

```ruby
account = app.integrations.revolut.get_account(id: "acc_abc123")
```
### `app.integrations.revolut.get_account_bank_details(...)`

Retrieve IBAN, BIC/SWIFT, local account identifiers, beneficiary data, and supported transfer schemes for an account.

```ruby
details = app.integrations.revolut.get_account_bank_details(account_id: "041c7846-4c5e-44af-b8f6-206f61e9f60a")
```
## Transactions

### `app.integrations.revolut.list_transactions(...)`

List Revolut transactions with optional filters. Supports filtering by account, date range, type, and pagination.

```ruby
# List recent transactions
result = app.integrations.revolut.list_transactions(count: 50)
# Returns: { transactions: { { id: "...", type: "card_payment", state: "completed", amount: -2500, currency: "GBP", description: "Office Supplies"} } }
# Filter by account and date range
result = app.integrations.revolut.list_transactions(account_id: "041c7846-4c5e-44af-b8f6-206f61e9f60a", from: "2026-01-01T00:00:00Z", to: "2026-03-31T23:59:59Z", count: 100)
# Filter by type
result = app.integrations.revolut.list_transactions(type: "card_payment", count: 25)
```
### `app.integrations.revolut.get_transaction(...)`

Retrieve a Revolut transaction by ID with full details including all legs.

```ruby
transaction = app.integrations.revolut.get_transaction(id: "tx_def456")
```
When you only have the request ID used for payment creation:

```ruby
transaction = app.integrations.revolut.get_transaction(id: "request-123", id_type: "request_id")
```
## Cards

### `app.integrations.revolut.list_cards(...)`

List all Revolut business cards. Returns card IDs, last 4 digits, status, and cardholder information.

```ruby
result = app.integrations.revolut.list_cards(limit: 50)
```
### `app.integrations.revolut.get_card(...)`

Retrieve a Revolut card by ID with full details including spending limits.

```ruby
card = app.integrations.revolut.get_card(id: "card_ghi789")
```
### `app.integrations.revolut.get_sensitive_card_details(...)`

Retrieve sensitive card details. This requires Revolut's `READ_SENSITIVE_CARD_DATA` scope and IP whitelisting. Prefer `get_card` unless PAN/CVV data is explicitly needed.

```ruby
details = app.integrations.revolut.get_sensitive_card_details(card_id: "card_ghi789")
```
## Team Members

### `app.integrations.revolut.list_team_members(...)`

List Revolut Business team members.

```ruby
members = app.integrations.revolut.list_team_members(limit: 100)
```
## Common Workflows

### Check balances across all accounts

```ruby
result = app.integrations.revolut.list_accounts()
result.accounts.each do |account|
  puts((account.name).to_s + ": " + (account.balance).to_s + " " + (account.currency).to_s)
end
```
### Find recent card payments

```ruby
result = app.integrations.revolut.list_transactions(type: "card_payment", count: 20)
result.transactions.each do |tx|
  if (tx.state == "completed")
    puts((tx.description).to_s + ": " + (tx.amount).to_s + " " + (tx.currency).to_s)
  end
end
```
### Review spending on a specific card

```ruby
# Step 1: Find the card
cards = app.integrations.revolut.list_cards()
my_card = nil
cards.cards.each do |c|
  if (c.last_four_digits == "4242")
    my_card = c
    break
  end
end
# Step 2: Get full card details with limits
if my_card
  details = app.integrations.revolut.get_card(id: my_card.id)
  # Review spending limits
  (details.spending_limits || []).each do |limit|
    puts((limit.amount).to_s + " " + (limit.currency).to_s + " / " + (limit.interval).to_s)
  end
end
```
### Verify account access

```ruby
accounts = app.integrations.revolut.list_accounts()
puts("Number of accounts: " + (accounts.accounts.length).to_s)
```
## Notes

- **Monetary amounts** are returned as numeric API values. Do not assume cents-only representation; preserve the value and currency returned by Revolut.
- **Transaction legs** — A transaction can have multiple legs (e.g., a currency conversion has a debit leg and a credit leg in different currencies).
- **Transaction states** — Common states include `pending`, `completed`, `declined`, `failed`, `reverted`.
- **Card types** — `"physical"` or `"virtual"`.
- **Date filters** — Use ISO 8601 format for date parameters: `"2026-01-01T00:00:00Z"`.
- **Error handling** — API errors include the HTTP status code and error message. Common errors: `401` (invalid or expired token), `403` (insufficient permissions), `404` (resource not found), `429` (rate limit exceeded).

---

## Multi-Account Usage

If you have multiple revolut accounts configured, use account-specific namespaces:

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
