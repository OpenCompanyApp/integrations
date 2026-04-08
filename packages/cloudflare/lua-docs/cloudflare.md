# Cloudflare — Lua API Reference

## list_zones

List all Cloudflare zones (domains).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | no | Filter by zone name (e.g., "example.com") |
| `status` | string | no | Filter by status: active, pending, initializing, moved, deleted, deactivated |
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of zones per page (default: 20, max: 50) |

### Examples

```lua
-- List all zones
local result = app.integrations.cloudflare.list_zones({})

for _, zone in ipairs(result.zones) do
  print(zone.name .. " (" .. zone.status .. ") - " .. zone.id)
end
```

```lua
-- Filter by name
local result = app.integrations.cloudflare.list_zones({
  name = "example.com"
})
```

---

## get_zone

Get detailed information about a specific Cloudflare zone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `zone_id` | string | yes | The zone identifier |

### Examples

```lua
local result = app.integrations.cloudflare.get_zone({
  zone_id = "023e105f4ecef8ad9ca31a8372d0c353"
})

print("Zone: " .. result.name)
print("Status: " .. result.status)
print("Plan: " .. result.plan)
```

---

## list_dns_records

List DNS records for a Cloudflare zone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `zone_id` | string | yes | The zone identifier |
| `type` | string | no | Filter by record type: A, AAAA, CNAME, MX, TXT, NS, SRV, etc. |
| `name` | string | no | Filter by record name |
| `content` | string | no | Filter by record content |
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of records per page (default: 20, max: 100) |

### Examples

```lua
-- List all DNS records
local result = app.integrations.cloudflare.list_dns_records({
  zone_id = "023e105f4ecef8ad9ca31a8372d0c353"
})

for _, record in ipairs(result.records) do
  print(record.type .. " " .. record.name .. " -> " .. record.content)
end
```

```lua
-- Filter A records only
local result = app.integrations.cloudflare.list_dns_records({
  zone_id = "023e105f4ecef8ad9ca31a8372d0c353",
  type = "A"
})
```

---

## create_dns_record

Create a new DNS record in a Cloudflare zone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `zone_id` | string | yes | The zone identifier |
| `type` | string | yes | DNS record type: A, AAAA, CNAME, MX, TXT, NS, SRV, etc. |
| `name` | string | yes | DNS record name (e.g., "www.example.com" or "@") |
| `content` | string | yes | DNS record content (e.g., "192.0.2.1") |
| `ttl` | integer | no | Time to live in seconds (1 = Auto, default: 1) |
| `proxied` | boolean | no | Whether proxied through Cloudflare (default: false) |

### Examples

```lua
-- Create an A record proxied through Cloudflare
local result = app.integrations.cloudflare.create_dns_record({
  zone_id = "023e105f4ecef8ad9ca31a8372d0c353",
  type = "A",
  name = "www.example.com",
  content = "192.0.2.1",
  ttl = 1,
  proxied = true
})

print(result.message)
```

```lua
-- Create a CNAME record
local result = app.integrations.cloudflare.create_dns_record({
  zone_id = "023e105f4ecef8ad9ca31a8372d0c353",
  type = "CNAME",
  name = "blog.example.com",
  content = "example.github.io",
  ttl = 3600,
  proxied = false
})
```

---

## list_page_rules

List page rules for a Cloudflare zone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `zone_id` | string | yes | The zone identifier |
| `status` | string | no | Filter by status: active, disabled |
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Number of rules per page |

### Examples

```lua
local result = app.integrations.cloudflare.list_page_rules({
  zone_id = "023e105f4ecef8ad9ca31a8372d0c353"
})

for _, rule in ipairs(result.rules) do
  print("Priority " .. rule.priority .. ": " .. rule.status)
  for _, target in ipairs(rule.targets) do
    print("  Target: " .. target.target)
  end
end
```

---

## get_analytics

Get analytics dashboard data for a Cloudflare zone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `zone_id` | string | yes | The zone identifier |
| `since` | string | no | Start time: ISO 8601 or relative like "-30d", "-7d", "-24h" (default: "-30d") |
| `until` | string | no | End time: ISO 8601 or "now" (default: "now") |
| `continuous` | string | no | Include continuous data: "true" or "false" (default: "true") |

### Examples

```lua
-- Last 30 days
local result = app.integrations.cloudflare.get_analytics({
  zone_id = "023e105f4ecef8ad9ca31a8372d0c353"
})

print("Total requests: " .. (result.totals.requests or 0))
print("Total bandwidth: " .. (result.totals.bandwidth or 0))
print("Total threats: " .. (result.totals.threats or 0))
print("Total pageviews: " .. (result.totals.pageviews or 0))
```

```lua
-- Last 7 days
local result = app.integrations.cloudflare.get_analytics({
  zone_id = "023e105f4ecef8ad9ca31a8372d0c353",
  since = "-7d",
  until = "now"
})

-- Timeseries data
for _, entry in ipairs(result.timeseries or {}) do
  print(entry.until .. ": " .. (entry.requests or 0) .. " requests")
end
```

---

## get_current_user

Get details of the currently authenticated Cloudflare user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.cloudflare.get_current_user({})

print("User: " .. result.username .. " (" .. result.email .. ")")
print("2FA enabled: " .. tostring(result.two_factor_authentication))
```

---

## Multi-Account Usage

If you have multiple Cloudflare accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.cloudflare.function_name({...})

-- Explicit default (portable across setups)
app.integrations.cloudflare.default.function_name({...})

-- Named accounts
app.integrations.cloudflare.production.function_name({...})
app.integrations.cloudflare.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
