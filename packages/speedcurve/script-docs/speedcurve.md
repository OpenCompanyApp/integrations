# SpeedCurve — JavaScript API Reference

## list_sites

List all monitored sites in SpeedCurve.

### Parameters

None.

### Example

```js
var result = app.integrations.speedcurve.list_sites({})

for (const site of (result.sites)) {
  console.log(site.site_id + ": " + site.name)
}
```
---

## get_site

Get detailed information about a specific SpeedCurve site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | integer | yes | The SpeedCurve site ID |

### Example

```js
var result = app.integrations.speedcurve.get_site({
  site_id: 12345,
})

console.log("Site: " + result.site.name)
for (const url of (result.urls || [])) {
  console.log("  URL: " + url.url)
}
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

```js
var result = app.integrations.speedcurve.list_tests({
  site_id: 12345,
  days: 7,
})

for (const test of (result.tests || [])) {
  console.log("Test " + test.test_id + " — LCP: " + (test.largest_contentful_paint || "N/A"))
}
```
---

## get_test

Get detailed results for a specific synthetic test run.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `test_id` | integer | yes | The SpeedCurve test ID |

### Example

```js
var result = app.integrations.speedcurve.get_test({
  test_id: 67890,
})

console.log("URL: " + result.url)
console.log("LCP: " + (result.largest_contentful_paint || "N/A"))
console.log("FID: " + (result.first_input_delay || "N/A"))
console.log("CLS: " + (result.cumulative_layout_shift || "N/A"))
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

```js
var result = app.integrations.speedcurve.list_deployments({
  site_id: 12345,
  limit: 10,
})

for (const deploy of (result.deployments || [])) {
  console.log(deploy.deploy_id + ": " + (deploy.note || "No note") + " — " + deploy.status)
}
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

```js
var result = app.integrations.speedcurve.create_deployment({
  site_id: 12345,
  note: "Deploy v2.3.1 — new checkout flow",
  detail: "commit: abc123def",
})

console.log("Deployment created: " + result.deploy_id)
```
---

## get_current_user

Get details about the authenticated SpeedCurve user. Useful for verifying credentials.

### Parameters

None.

### Example

```js
var result = app.integrations.speedcurve.get_current_user({})

console.log("User: " + result.name)
console.log("Email: " + result.email)
console.log("Account: " + (result.account || "N/A"))
```
---

## Multi-Account Usage

If you have multiple SpeedCurve accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.speedcurve.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.speedcurve.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.speedcurve.production.function_name({ /* parameters */ })
app.integrations.speedcurve.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
