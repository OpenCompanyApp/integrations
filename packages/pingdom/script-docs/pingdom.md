# Pingdom — JavaScript API Reference

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

```js
var result = app.integrations.pingdom.list_checks({})

for (const check of (result.checks)) {
  console.log(check.name + " (" + check.hostname + "): " + check.status)
}
```
---

## get_check

Get detailed information about a specific Pingdom uptime check.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `check_id` | integer | yes | The ID of the check to retrieve |

### Example

```js
var result = app.integrations.pingdom.get_check({
  check_id: 12345,
})

console.log("Name: " + result.check.name)
console.log("Status: " + result.check.status)
console.log("Last response time: " + (result.check.last_response_time || "N/A") + "ms")
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

```js
var result = app.integrations.pingdom.create_check({
  name: "My Website",
  host: "example.com",
  type: "https",
  url: "/health",
  resolution: 5,
  tags: "production,website",
})

console.log("Created check ID: " + result.check.id)
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

```js
var result = app.integrations.pingdom.list_results({
  check_id: 12345,
  limit: 50,
})

for (const r of (result.results)) {
  console.log(r.status + " - " + r.responsetime + "ms")
}
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

```js
// Get results from the last 24 hours
var now = Math.floor(Date.now() / 1000)
var result = app.integrations.pingdom.get_results({
  check_id: 12345,
  from: now - 86400,
  to: now,
  status: "down",
})

console.log("Found " + result.count + " downtime events")
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

```js
var result = app.integrations.pingdom.list_alerts({
  limit: 20,
  status: "sent",
})

for (const alert of (result.alerts)) {
  console.log("Check " + alert.checkid + ": " + alert.status)
}
```
---

## get_current_user

Get details of the currently authenticated Pingdom user, including account info and credits.

### Parameters

None.

### Example

```js
var result = app.integrations.pingdom.get_current_user({})

console.log("Account: " + result.name)
console.log("Email: " + (result.email || "N/A"))
console.log("Credits: " + (result.credits || "N/A"))
```
---

## Multi-Account Usage

If you have multiple Pingdom accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.pingdom.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.pingdom.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.pingdom.work.function_name({ /* parameters */ })
app.integrations.pingdom.production.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
