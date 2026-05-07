# CoinMarketCap Integration

Use the `coinmarketcap` integration to fetch cryptocurrency market data, listings, quotes, metadata, OHLCV history, exchange data, global metrics, DEX token and pair data, holder analytics, content, community trends, CMC indices, and utility endpoints.

This package is generated from CoinMarketCap's official API documentation and endpoint-level API Summary blocks. It exposes 91 CoinMarketCap Pro API operations across market data, DEX data, utilities, and documented deprecated compatibility endpoints.

## Authentication

Set `api_key` to a CoinMarketCap Pro API key. Requests send `X-CMC_PRO_API_KEY`, `Accept: application/json`, and `Accept-Encoding: deflate, gzip` to `https://pro-api.coinmarketcap.com` by default.

## Request Shape

Query parameters are exposed as snake_case tool parameters using the official API summary names. POST endpoints also accept a `body` object matching the CoinMarketCap endpoint schema. Comma-separated CoinMarketCap parameters such as `id`, `symbol`, `slug`, `convert`, and `aux` should be passed as strings exactly as documented by CoinMarketCap.

## Return Shape

Responses are returned as decoded JSON from CoinMarketCap. Successful responses usually contain `data` and `status`; API errors are converted to tool errors using `status.error_message` when available.

## Examples

```lua
local quotes = app.integrations.coinmarketcap.get_v3_cryptocurrency_quotes_latest({
  symbol = "BTC,ETH",
  convert = "USD"
})

local listings = app.integrations.coinmarketcap.get_v3_cryptocurrency_listings_latest({
  start = 1,
  limit = 10,
  convert = "USD"
})

local key = app.integrations.coinmarketcap.get_v1_key_info({})
```

Use fake API keys and public asset symbols in tests and examples. Never store real CoinMarketCap API keys, customer account metadata, or paid-plan response snapshots in fixtures or Lua examples.
