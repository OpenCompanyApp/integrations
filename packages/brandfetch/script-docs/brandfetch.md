# Brandfetch Ruby API Reference

Namespace: `app.integrations.brandfetch`

This integration targets Brandfetch's current APIs:

- Brand API at `https://api.brandfetch.io/v2/brands/...`
- Brand Search API at `https://api.brandfetch.io/v2/search/...`
- Transaction API at `https://api.brandfetch.io/v2/brands/transaction`
- Logo API CDN URLs at `https://cdn.brandfetch.io/...`

## Examples

Get a brand by explicit domain:

```ruby
brand = app.integrations.brandfetch.get_by_domain(domain: "brandfetch.com")
```
Search brands:

```ruby
results = app.integrations.brandfetch.search(query: "Nike")
```
Enrich a transaction:

```ruby
merchant = app.integrations.brandfetch.enrich_transaction(transaction_label: "STARBUCKS 1523 OMAHA NE", country_code: "US")
```
Build a logo URL:

```ruby
logo = app.integrations.brandfetch.logo_url(identifier: "nike.com", options: {width: 400, height: 400, theme: "dark", type: "icon"})
```
## Raw API Helpers

```ruby
result = app.integrations.brandfetch.api_get(path: "/v2/brands/domain/brandfetch.com")
```
Raw helper paths must be relative. Absolute URLs and parent-directory paths are
rejected.
