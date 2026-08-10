# Netlify — JavaScript API Reference

## create_site

Create a new Netlify site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name for the site |
| `custom_domain` | string | no | Custom domain to assign to the site |
| `repo` | object | no | Repository configuration for continuous deployment |
| `body` | object | no | Additional site configuration fields |

### Example

```js
var result = app.integrations.netlify.create_site({
  name: "agent-preview",
  body: {
    password: "preview-password",
  }
})

console.log("Created site: " + result.id)
```
---

## list_sites

List all Netlify sites.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | no | Filter by site name |
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of sites per page (default: 30) |

### Examples

```js
// List all sites
var result = app.integrations.netlify.list_sites({})

for (const site of (result.sites)) {
  console.log(site.name + " (" + site.state + ") - " + site.url)
}
```
```js
// Filter by name
var result = app.integrations.netlify.list_sites({
  name: "my-site",
})
```
---

## get_site

Get detailed information about a specific Netlify site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The site identifier or site name (e.g., "abc123" or "mysite.netlify.app") |

### Examples

```js
var result = app.integrations.netlify.get_site({
  site_id: "abc123-def456",
})

console.log("Site: " + result.name)
console.log("URL: " + result.ssl_url)
console.log("State: " + result.state)
console.log("Custom domain: " + (result.custom_domain || "none"))
```
---

## delete_site

Delete a Netlify site permanently.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The Netlify site ID to delete |

### Example

```js
app.integrations.netlify.delete_site({
  site_id: "abc123-def456",
})
```
---

## create_deploy

Trigger a new deploy for a Netlify site. The deploy body should follow Netlify's deploy API shape, such as file digests for atomic deploys or deploy options supported by the API.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The Netlify site ID |
| `title` | string | no | Deploy title, sent as a Netlify API query parameter |
| `branch` | string | no | Branch to deploy |
| `framework` | string | no | Framework override |
| `body` | object | no | Additional deploy body fields |

### Example

```js
var result = app.integrations.netlify.create_deploy({
  site_id: "abc123-def456",
  title: "Agent deploy",
  body: {
    async: true,
  }
})

console.log("Deploy: " + result.id + " " + result.state)
```
---

## list_deploys

List deploys for a Netlify site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The site identifier |
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of deploys per page (default: 30) |

### Examples

```js
var result = app.integrations.netlify.list_deploys({
  site_id: "abc123-def456",
})

for (const deploy of (result.deploys)) {
  console.log(deploy.state + " - " + (deploy.branch || "unknown") + " @ " + deploy.created_at)
}
```
---

## get_deploy

Get detailed information about a specific Netlify deploy.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `deploy_id` | string | yes | The deploy identifier |

### Examples

```js
var result = app.integrations.netlify.get_deploy({
  deploy_id: "789xyz",
})

console.log("State: " + result.state)
console.log("Branch: " + (result.branch || "unknown"))
console.log("Deploy time: " + (result.deploy_time || 0) + "s")
console.log("URL: " + (result.deploy_url || "N/A"))
```
---

## list_forms

List all forms for a Netlify site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The site identifier |

### Examples

```js
var result = app.integrations.netlify.list_forms({
  site_id: "abc123-def456",
})

for (const form of (result.forms)) {
  console.log(form.name + " - " + form.submission_count + " submissions")
}
```
---

## list_dns_zones

List all DNS zones configured in Netlify.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Number of DNS zones per page |

### Examples

```js
var result = app.integrations.netlify.list_dns_zones({})

for (const zone of (result.dns_zones)) {
  console.log(zone.name + " (" + (zone.domain || "N/A") + ")")
  for (const ns of (zone.nameservers)) {
    console.log("  NS: " + ns)
  }
}
```
---

## get_current_user

Get details of the currently authenticated Netlify user.

### Parameters

None.

### Examples

```js
var result = app.integrations.netlify.get_current_user({})

console.log("User: " + (result.full_name || result.email))
console.log("Email: " + result.email)
console.log("Sites: " + (result.site_count || 0))
```
---

## Multi-Account Usage

If you have multiple Netlify accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.netlify.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.netlify.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.netlify.production.function_name({ /* parameters */ })
app.integrations.netlify.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
