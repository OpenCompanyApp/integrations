# SpeedCurve — Lua API Reference

## list_sites

List all monitored sites in SpeedCurve.

### Parameters

None.

### Example

```lua
local result = app.integrations.speedcurve.list_sites({})

for _, site in ipairs(result.sites) do
  print(site.site_id .. ": " .. site.name)
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

```lua
local result = app.integrations.speedcurve.get_site({
  site_id = 12345
})

print("Site: " .. result.site.name)
for _, url in ipairs(result.urls or {}) do
  print("  URL: " .. url.url)
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

```lua
local result = app.integrations.speedcurve.list_tests({
  site_id = 12345,
  days = 7
})

for _, test in ipairs(result.tests or {}) do
  print("Test " .. test.test_id .. " — LCP: " .. (test.largest_contentful_paint or "N/A"))
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

```lua
local result = app.integrations.speedcurve.get_test({
  test_id = 67890
})

print("URL: " .. result.url)
print("LCP: " .. (result.largest_contentful_paint or "N/A"))
print("FID: " .. (result.first_input_delay or "N/A"))
print("CLS: " .. (result.cumulative_layout_shift or "N/A"))
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

```lua
local result = app.integrations.speedcurve.list_deployments({
  site_id = 12345,
  limit = 10
})

for _, deploy in ipairs(result.deployments or {}) do
  print(deploy.deploy_id .. ": " .. (deploy.note or "No note") .. " — " .. deploy.status)
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

```lua
local result = app.integrations.speedcurve.create_deployment({
  site_id = 12345,
  note = "Deploy v2.3.1 — new checkout flow",
  detail = "commit: abc123def"
})

print("Deployment created: " .. result.deploy_id)
```

---

## get_current_user

Get details about the authenticated SpeedCurve user. Useful for verifying credentials.

### Parameters

None.

### Example

```lua
local result = app.integrations.speedcurve.get_current_user({})

print("User: " .. result.name)
print("Email: " .. result.email)
print("Account: " .. (result.account or "N/A"))
```

---

## Multi-Account Usage

If you have multiple SpeedCurve accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.speedcurve.function_name({...})

-- Explicit default (portable across setups)
app.integrations.speedcurve.default.function_name({...})

-- Named accounts
app.integrations.speedcurve.production.function_name({...})
app.integrations.speedcurve.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
