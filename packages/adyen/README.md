# Adyen Integration

Generated Laravel integration for official Adyen Checkout v72 and Management v3 OpenAPI operations.

## Coverage

- Checkout v72: payments, payment methods, sessions, payment links, stored payment methods, Apple Pay sessions, donations, orders, and payment modifications.
- Management v3: companies, merchants, stores, terminals, users, API credentials, allowed origins, payment method settings, payout settings, split configurations, terminal settings, orders, and webhooks.

Source specifications:

- `https://github.com/Adyen/adyen-openapi/blob/main/json/CheckoutService-v72.json`
- `https://github.com/Adyen/adyen-openapi/blob/main/json/ManagementService-v3.json`

## Configuration

Requests use the `X-API-Key` header. Configure `merchant_account` and `company_id` when you want the integration to fill common Adyen path/query/body account identifiers automatically.

See `lua-docs/adyen.md` for tool naming, argument, and return-shape notes.
