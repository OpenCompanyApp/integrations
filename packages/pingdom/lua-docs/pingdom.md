# Pingdom — Lua API Reference

## list_checks

List all uptime checks in Pingdom. Returns check IDs, names, hostnames, statuses, and last test times.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of checks to return (default: 100) |
| `offset` | integer | no | Offset for pagination (default: 0) |
| `status` | string | no | Filter by status: `"up"`, `"down"`, `"paused"`, `"unknown"` |
| `tags` | string | no | Filter by tag (comma-separated) |

### Example

```lua
local result = app.integrations.pingdom.list_checks({})

for _, check in ipairs(result.checks) do
  print(check.name .. " (" .. check.hostname .. "): " .. check.status)
end
```

---

## get_check

Get detailed information about a specific Pingdom uptime check.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `check_id` | integer | yes | The ID of the check to retrieve |

### Example

```lua
local result = app.integrations.pingdom.get_check({
  check_id = 12345
})

print("Name: " .. result.check.name)
print("Status: " .. result.check.status)
print("Last response time: " .. (result.check.last_response_time or "N/A") .. "ms")
```

---

## create_check

Create a new uptime check in Pingdom. Supports HTTP, HTTPS, TCP, ping, DNS, UDP, SMTP, POP3, and IMAP check types.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name of the check |
| `host` | string | yes | Target hostname or IP address |
| `type` | string | yes | Check type: `"http"`, `"https"`, `"tcp"`, `"ping"`, `"dns"`, `"udp"`, `"smtp"`, `"pop3"`, `"imap"` |
| `resolution` | integer | no | Check interval in minutes (1, 5, 15, 30, 60). Default: 5 |
| `url` | string | no | URL path for HTTP/HTTPS checks (e.g., `"/health"`) |
| `port` | integer | no | Target port for TCP/UDP checks |
| `tags` | string | no | Comma-separated tags for the check |
| `send_string` | string | no | String to send for TCP/UDP checks |
| `expect_string` | string | no | Expected response string for TCP checks |
| `contactids` | string | no | Comma-separated contact IDs to alert |

### Example

```lua
local result = app.integrations.pingdom.create_check({
  name = "My Website",
  host = "example.com",
  type = "https",
  url = "/health",
  resolution = 5,
  tags = "production,website"
})

print("Created check ID: " .. result.check.id)
```

---

## list_results

List summary results for a Pingdom uptime check. Returns response times and status summaries.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `check_id` | integer | yes | The ID of the check |
| `from` | integer | no | Start timestamp (Unix epoch) |
| `to` | integer | no | End timestamp (Unix epoch) |
| `limit` | integer | no | Maximum number of results to return |
| `offset` | integer | no | Offset for pagination |

### Example

```lua
local result = app.integrations.pingdom.list_results({
  check_id = 12345,
  limit = 50
})

for _, r in ipairs(result.results) do
  print(r.status .. " - " .. r.responsetime .. "ms")
end
```

---

## get_results

Get detailed test results for a Pingdom uptime check, including individual probe responses and response times.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `check_id` | integer | yes | The ID of the check |
| `from` | integer | no | Start timestamp (Unix epoch) |
| `to` | integer | no | End timestamp (Unix epoch) |
| `limit` | integer | no | Maximum number of results to return |
| `offset` | integer | no | Offset for pagination |
| `probes` | string | no | Comma-separated probe IDs to filter by |
| `status` | string | no | Filter by result status: `"up"`, `"down"`, `"unconfirmed_down"` |

### Example

```lua
-- Get results from the last 24 hours
local now = os.time()
local result = app.integrations.pingdom.get_results({
  check_id = 12345,
  from = now - 86400,
  to = now,
  status = "down"
})

print("Found " .. result.count .. " downtime events")
```

---

## list_alerts

List alerts for the Pingdom account. Returns alert details including check ID, contact, and alert type.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of alerts to return (default: 100) |
| `offset` | integer | no | Offset for pagination (default: 0) |
| `check_id` | integer | no | Filter alerts by check ID |
| `status` | string | no | Filter by alert status: `"sent"`, `"not_sent"`, `"scheduled"` |

### Example

```lua
local result = app.integrations.pingdom.list_alerts({
  limit = 20,
  status = "sent"
})

for _, alert in ipairs(result.alerts) do
  print("Check " .. alert.checkid .. ": " .. alert.status)
end
```

---

## get_current_user

Get details of the currently authenticated Pingdom user, including account info and credits.

### Parameters

None.

### Example

```lua
local result = app.integrations.pingdom.get_current_user({})

print("Account: " .. result.name)
print("Email: " .. (result.email or "N/A"))
print("Credits: " .. (result.credits or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Pingdom accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.pingdom.function_name({...})

-- Explicit default (portable across setups)
app.integrations.pingdom.default.function_name({...})

-- Named accounts
app.integrations.pingdom.work.function_name({...})
app.integrations.pingdom.production.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
