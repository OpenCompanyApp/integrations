# CoinGecko Ruby Reference

CoinGecko tools expose API v3 market, exchange, category, asset-platform, and public treasury data. Use CoinGecko IDs (`bitcoin`, `ethereum`) rather than ticker symbols (`BTC`, `ETH`).

## Common Discovery Flow

```ruby
search = app.integrations.coingecko.search(query: "solana")
coin_id = search.coins[0].id
categories = app.integrations.coingecko.categories()
platforms = app.integrations.coingecko.asset_platforms()
```
`list_coins` can return contract addresses when called with `include_platform = "true"`:

```ruby
coins = app.integrations.coingecko.list(params: {include_platform: "true"})
```
## Prices And Markets

```ruby
price = app.integrations.coingecko.price(ids: "bitcoin,ethereum", currencies: "usd,eur")
token_price = app.integrations.coingecko.token_price(asset_platform_id: "ethereum", contract_addresses: "0x0000000000000000000000000000000000000000", currencies: "usd")
markets = app.integrations.coingecko.markets(currency: "usd", category: "layer-1", per_page: "10", page: "1")
```
`price` and `simple_token_price` include market cap, 24h volume, 24h change, and last-updated fields where CoinGecko returns them.

## Coin Detail And History

```ruby
info = app.integrations.coingecko.info(id: "bitcoin")
tickers = app.integrations.coingecko.tickers(id: "bitcoin", params: {page: 1})
history_date = app.integrations.coingecko.history_date(id: "bitcoin", date: "30-12-2025")
chart = app.integrations.coingecko.market_chart(id: "bitcoin", currency: "usd", days: "30")
ohlc = app.integrations.coingecko.ohlc(id: "bitcoin", currency: "usd", days: "30")
```
The existing `info`, `markets`, `history`, `ohlc`, `search_coins`, `trending`, and `global` tools return normalized summaries to keep agent output small. New endpoint-family tools return CoinGecko's JSON shape directly.

## Exchanges

```ruby
exchanges = app.integrations.coingecko.exchanges(params: {per_page: 25, page: 1})
exchange = app.integrations.coingecko.exchange(id: "binance")
tickers = app.integrations.coingecko.exchange_tickers(id: "binance", params: {coin_ids: "bitcoin"})
volume = app.integrations.coingecko.exchange_volume_chart(id: "binance", days: "30")
```
Use `list_exchange_ids` to discover exchange IDs before calling exchange-specific tools.

## Categories, Rates, Global Data

```ruby
category_market = app.integrations.coingecko.category_markets(params: {order: "market_cap_desc"})
rates = app.integrations.coingecko.exchange_rates()
trending = app.integrations.coingecko.trending()
global = app.integrations.coingecko.global()
defi = app.integrations.coingecko.global_defi()
```
`exchange_rates` returns BTC-relative rates under `rates`.

## Asset Platforms And Token Lists

```ruby
platforms = app.integrations.coingecko.asset_platforms()
token_list = app.integrations.coingecko.token_list(asset_platform_id: "ethereum")
```
Use asset platform IDs for token-price and token-list calls.

## Public Treasury

```ruby
entities = app.integrations.coingecko.public_treasury_entities()
by_coin = app.integrations.coingecko.treasury_by(entity: "companies", coin_id: "bitcoin", params: {per_page: 25})
by_entity = app.integrations.coingecko.treasury_entity(entity_id: "strategy")
```
`entity` must be `companies` or `governments` for `public_treasury_by_coin`.

## Long-Tail GET Endpoints

Use `api_get` only for read-only CoinGecko API v3 endpoints that do not yet have a first-class tool, for example derivatives or NFT endpoints:

```ruby
derivatives = app.integrations.coingecko.api_get(path: "/derivatives", params: {})
```
`api_get` accepts relative API paths only. It does not call external URLs.
