# Pingdom — Ruby API Reference

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

```ruby
result = app.integrations.pingdom.list_checks()
result.checks.each do |check|
  puts((check.name).to_s + " (" + (check.hostname).to_s + "): " + (check.status).to_s)
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

```ruby
result = app.integrations.pingdom.get_check(check_id: 12345)
puts("Name: " + (result.check.name).to_s)
puts("Status: " + (result.check.status).to_s)
puts("Last response time: " + ((result.check.last_response_time || "N/A")).to_s + "ms")
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

```ruby
result = app.integrations.pingdom.create_check(name: "My Website", host: "example.com", type: "https", url: "/health", resolution: 5, tags: "production,website")
puts("Created check ID: " + (result.check.id).to_s)
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

```ruby
result = app.integrations.pingdom.list_results(check_id: 12345, limit: 50)
result.results.each do |r|
  puts((r.status).to_s + " - " + (r.responsetime).to_s + "ms")
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

```ruby
# Explicit example timestamp. Supply an appropriate timestamp as data; there is no ambient clock.
example_unix_seconds = 1767225600
# Get results from the last 24 hours
now = (((example_unix_seconds * 1000) / 1000)).floor
result = app.integrations.pingdom.get_results(check_id: 12345, from: (now - 86400), to: now, status: "down")
puts("Found " + (result.count).to_s + " downtime events")
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

```ruby
result = app.integrations.pingdom.list_alerts(limit: 20, status: "sent")
result.alerts.each do |alert|
  puts("Check " + (alert.checkid).to_s + ": " + (alert.status).to_s)
end
```
---

## get_current_user

Get details of the currently authenticated Pingdom user, including account info and credits.

### Parameters

None.

### Example

```ruby
result = app.integrations.pingdom.get_current_user()
puts("Account: " + (result.name).to_s)
puts("Email: " + ((result.email || "N/A")).to_s)
puts("Credits: " + ((result.credits || "N/A")).to_s)
```
---

## Multi-Account Usage

If you have multiple Pingdom accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
