# Binance Integration

Use the `binance` integration to call Binance Spot REST API endpoints for public market data, trading, account data, wallet, margin, sub-account, savings, staking, mining, convert, fiat, NFT, loan, broker, and other `/api/*` and `/sapi/*` resources.

This package is generated from Binance's official `binance-api-swagger` OpenAPI file and exposes 340 Binance Spot operations. Public endpoints can run without credentials. API-key endpoints require `api_key`. Signed endpoints require both `api_key` and `api_secret`; the integration adds `timestamp` when omitted and signs the query with HMAC SHA256.

## Authentication

- Public market-data endpoints use no credentials.
- API-key endpoints send `X-MBX-APIKEY`.
- Signed endpoints send `X-MBX-APIKEY`, auto-fill `timestamp` when omitted, and append `signature` computed from the query string using `api_secret`.
- `url` defaults to `https://api.binance.com`. Use Binance's testnet or regional URL only when the endpoint family supports it.

## Request Shape

Path, query, and header parameters are exposed as snake_case tool parameters. Binance POST and DELETE endpoints in this API primarily use query-string parameters, matching the official Swagger file. Do not manually pass `signature`; the service signs signed endpoints for you.

## Return Shape

Responses are returned as decoded JSON from Binance. API errors are converted to tool errors using Binance's `msg` field when available.

## Examples

```js
var time = app.integrations.binance.get_api_v3_time({})

var ticker = app.integrations.binance.get_api_v3_ticker_price({
  symbol: "BNBUSDT",
})

var account = app.integrations.binance.get_api_v3_account({
  recv_window: 5000,
})
```
Use fake API keys and public symbols in tests and examples. Never store real Binance API keys, API secrets, account IDs, order IDs, balances, wallet addresses, or signed query strings in fixtures or JavaScript examples.
