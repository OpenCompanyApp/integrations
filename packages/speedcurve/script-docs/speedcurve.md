# SpeedCurve — Ruby API Reference

## list_sites

List all monitored sites in SpeedCurve.

### Parameters

None.

### Example

```ruby
result = app.integrations.speedcurve.list_sites()
result.sites.each do |site|
  puts((site.site_id).to_s + ": " + (site.name).to_s)
end
```
---

## get_site

Get detailed information about a specific SpeedCurve site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | integer | yes | The SpeedCurve site ID |

### Example

```ruby
result = app.integrations.speedcurve.get_site(site_id: 12345)
puts("Site: " + (result.site.name).to_s)
(result.urls || []).each do |url|
  puts("  URL: " + (url.url).to_s)
end
```
---

## list_tests

List recent synthetic test results. Optionally filter by site, browser, or region.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | integer | no | Filter by site ID |
| `url_id` | integer | no | Filter by URL ID |
| `browser` | string | no | Filter by browser (e.g., `"Chrome"`, `"Firefox"`) |
| `region` | string | no | Filter by region (e.g., `"us-east-1"`, `"eu-west-1"`) |
| `days` | integer | no | Number of days of test history to return |

### Example

```ruby
result = app.integrations.speedcurve.list_tests(site_id: 12345, days: 7)
(result.tests || []).each do |test|
  puts("Test " + (test.test_id).to_s + " — LCP: " + ((test.largest_contentful_paint || "N/A")).to_s)
end
```
---

## get_test

Get detailed results for a specific synthetic test run.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `test_id` | integer | yes | The SpeedCurve test ID |

### Example

```ruby
result = app.integrations.speedcurve.get_test(test_id: 67890)
puts("URL: " + (result.url).to_s)
puts("LCP: " + ((result.largest_contentful_paint || "N/A")).to_s)
puts("FID: " + ((result.first_input_delay || "N/A")).to_s)
puts("CLS: " + ((result.cumulative_layout_shift || "N/A")).to_s)
```
---

## list_deployments

List recent deployments and their performance impact.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | integer | no | Filter by site ID |
| `limit` | integer | no | Maximum number of deployments to return |

### Example

```ruby
result = app.integrations.speedcurve.list_deployments(site_id: 12345, limit: 10)
(result.deployments || []).each do |deploy|
  puts((deploy.deploy_id).to_s + ": " + ((deploy.note || "No note")).to_s + " — " + (deploy.status).to_s)
end
```
---

## create_deployment

Register a new deployment to trigger synthetic tests.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | integer | yes | The SpeedCurve site ID to deploy to |
| `note` | string | no | Description of the deployment (e.g., `"Deploy v2.3.1"`) |
| `detail` | string | no | Additional details (e.g., git commit SHA or changelog URL) |

### Example

```ruby
result = app.integrations.speedcurve.create_deployment(site_id: 12345, note: "Deploy v2.3.1 — new checkout flow", detail: "commit: abc123def")
puts("Deployment created: " + (result.deploy_id).to_s)
```
---

## get_current_user

Get details about the authenticated SpeedCurve user. Useful for verifying credentials.

### Parameters

None.

### Example

```ruby
result = app.integrations.speedcurve.get_current_user()
puts("User: " + (result.name).to_s)
puts("Email: " + (result.email).to_s)
puts("Account: " + ((result.account || "N/A")).to_s)
```
---

## Multi-Account Usage

If you have multiple SpeedCurve accounts configured, use account-specific namespaces:

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
