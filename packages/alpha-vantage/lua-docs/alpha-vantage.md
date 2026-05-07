# Alpha Vantage

Namespace: `alpha_vantage`

The Alpha Vantage integration uses the official query API at `https://www.alphavantage.co/query`. Every tool maps to one official `function` value and requires an Alpha Vantage API key.

## Common Tool Families

- Equity time series: `alpha_vantage_time_series_intraday`, `alpha_vantage_time_series_daily`, weekly/monthly variants, `alpha_vantage_global_quote`, and `alpha_vantage_realtime_bulk_quotes`.
- Discovery and market status: `alpha_vantage_symbol_search`, `alpha_vantage_listing_status`, and `alpha_vantage_market_status`.
- Options: realtime and historical options, put/call ratios, and volume/open-interest ratios.
- Intelligence: `alpha_vantage_news_sentiment`, earnings-call transcripts, top gainers/losers, and analytics windows.
- Fundamentals: overview, ETF profile, statements, earnings, estimates, dividends, splits, insider transactions, institutional holdings, and shares outstanding.
- FX and crypto: currency exchange rates, FX time series, crypto intraday, and digital currency daily/weekly/monthly endpoints.
- Commodities and economics: WTI, Brent, natural gas, metals, agriculture, GDP, CPI, inflation, unemployment, treasury yields, and other macro indicators.
- Technical indicators: SMA, EMA, RSI, MACD, BBANDS, VWAP, STOCH, ADX, ATR, OBV, and the other Alpha Vantage indicator functions.

## Notes For Agents

Free Alpha Vantage keys are rate limited, and some endpoints require premium entitlement. If the API returns a `Note`, `Information`, or `Error Message`, the tool reports that as an error instead of returning a misleading success.

Many endpoints support `datatype = "csv"`. CSV responses are returned as `{ body, status, content_type }`. JSON responses are returned as the decoded Alpha Vantage payload.

Use `query` for endpoint-specific parameters that are not listed directly by the tool. Arrays are sent as comma-separated values.

Examples use fake values:

```lua
local quote = alpha_vantage.global_quote({
  symbol = "IBM"
})

local bars = alpha_vantage.time_series_intraday({
  symbol = "IBM",
  interval = "5min",
  outputsize = "compact"
})

local news = alpha_vantage.news_sentiment({
  tickers = "IBM",
  topics = "technology",
  limit = 10
})

local rsi = alpha_vantage.rsi({
  symbol = "IBM",
  interval = "daily",
  time_period = 14,
  series_type = "close"
})
```
