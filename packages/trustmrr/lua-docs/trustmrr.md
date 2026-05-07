# TrustMRR - Lua API Reference

Namespace: `app.integrations.trustmrr`

The TrustMRR API currently documents two endpoints: list startups and get startup by slug. This integration covers both endpoints. List results are returned as `startups`, `total`, `page`, and `has_more`; detail results return the startup `data` object directly. All monetary values are USD cents.

## trustmrr_list_startups

Browse and filter startups with verified revenue on TrustMRR. Filter by sale status, category, revenue range, MRR, growth, or asking price. All monetary values are in USD cents (e.g. 100000 = $1,000).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sort` | string | no | Sort order. Options: `revenue-desc` (default), `revenue-asc`, `price-desc`, `price-asc`, `multiple-asc`, `multiple-desc`, `growth-desc`, `growth-asc`, `listed-desc`, `listed-asc`, `best-deal`. |
| `on_sale` | boolean | no | Filter by sale status. `true` = only for sale, `false` = only not for sale. Omit for all. |
| `category` | string | no | Filter by category: `ai`, `saas`, `developer-tools`, `fintech`, `marketing`, `ecommerce`, `productivity`, `design-tools`, `no-code`, `analytics`, `crypto-web3`, `education`, `health-fitness`, `social-media`, `content-creation`, `sales`, `customer-support`, `recruiting`, `real-estate`, `travel`, `legal`, `security`, `iot-hardware`, `green-tech`, `entertainment`, `games`, `community`, `news-magazines`, `utilities`, `marketplace`, `mobile-apps`. |
| `x_handle` | string | no | Filter by founder's X (Twitter) handle. Omit the `@` symbol. |
| `min_revenue` | number | no | Minimum last-30-days revenue in USD cents (e.g. `100000` = $1,000). |
| `max_revenue` | number | no | Maximum last-30-days revenue in USD cents. |
| `min_mrr` | number | no | Minimum monthly recurring revenue in USD cents. |
| `max_mrr` | number | no | Maximum monthly recurring revenue in USD cents. |
| `min_growth` | number | no | Minimum 30-day revenue growth as decimal (e.g. `0.1` = 10%). |
| `max_growth` | number | no | Maximum 30-day revenue growth as decimal. |
| `min_price` | number | no | Minimum asking price in USD cents (e.g. `1000000` = $10,000). |
| `max_price` | number | no | Maximum asking price in USD cents. |
| `page` | integer | no | Page number for pagination (default: 1). |
| `limit` | integer | no | Results per page, 1–50 (default: 10). |

### Example

```lua
local result = app.integrations.trustmrr.trustmrr_list_startups({
  category = "saas",
  on_sale = true,
  min_revenue = 50000,
  sort = "revenue-desc",
  limit = 10
})

for _, startup in ipairs(result.startups) do
  print(startup.name .. " - MRR: $" .. (startup.revenue.mrr / 100))
end
```

## trustmrr_get_startup

Get full details for a single startup on TrustMRR by its slug. Returns revenue data, tech stack, cofounders, social metrics, asking price, and more. Use the slug from the list startups tool.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `slug` | string | yes | The startup's URL-friendly identifier (e.g. `"shipfast"`). Get this from the list startups tool. |

### Example

```lua
local result = app.integrations.trustmrr.trustmrr_get_startup({
  slug = "shipfast"
})

print(result.name)
print("Revenue: $" .. (result.revenue.last30Days / 100))
print("MRR: $" .. (result.revenue.mrr / 100))
```

---

## Multi-Account Usage

If you have multiple trustmrr accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.trustmrr.function_name({...})

-- Explicit default (portable across setups)
app.integrations.trustmrr.default.function_name({...})

-- Named accounts
app.integrations.trustmrr.work.function_name({...})
app.integrations.trustmrr.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
