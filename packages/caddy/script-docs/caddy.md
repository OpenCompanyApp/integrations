# Caddy — JavaScript API Reference

## list_sites

List all Caddy sites.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of sites per page (default: 20) |

### Examples

```js
// List all sites
var result = app.integrations.caddy.list_sites({})

for (const site of (result.sites)) {
  console.log(site.name + " (" + site.status + ") - " + site.id)
}
```
```js
// Paginated listing
var result = app.integrations.caddy.list_sites({
  page: 2,
  per_page: 10,
})
```
---

## get_site

Get detailed information about a specific Caddy site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The site identifier |

### Examples

```js
var result = app.integrations.caddy.get_site({
  site_id: "abc123",
})

console.log("Site: " + result.name)
console.log("Status: " + result.status)
```
---

## create_site

Create a new site in Caddy.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The domain name for the site (e.g., "example.com") |
| `config` | object | no | Optional site configuration (Caddy JSON config or key-value pairs) |

### Examples

```js
// Create a basic site
var result = app.integrations.caddy.create_site({
  name: "mysite.example.com",
})

console.log(result.message)
console.log("Site ID: " + result.id)
```
```js
// Create a site with custom config
var result = app.integrations.caddy.create_site({
  name: "mysite.example.com",
  config: {
    auto_https: "on",
    log_format: "json",
  }
})
```
---

## delete_site

Delete a site from Caddy. This action is irreversible.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The site identifier to delete |

### Examples

```js
var result = app.integrations.caddy.delete_site({
  site_id: "abc123",
})

console.log(result.message)
```
---

## list_certificates

List all TLS certificates managed by Caddy.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of certificates per page (default: 20) |

### Examples

```js
// List all certificates
var result = app.integrations.caddy.list_certificates({})

for (const cert of (result.certificates)) {
  console.log(cert.domain + " expires: " + (cert.expires_at || "N/A"))
}
```
```js
// Paginated listing
var result = app.integrations.caddy.list_certificates({
  page: 1,
  per_page: 50,
})
```
---

## get_certificate

Get detailed information about a specific TLS certificate.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `certificate_id` | string | yes | The certificate identifier |

### Examples

```js
var result = app.integrations.caddy.get_certificate({
  certificate_id: "cert-abc123",
})

console.log("Domain: " + result.domain)
console.log("Issuer: " + (result.issuer || "N/A"))
console.log("Valid from: " + (result.not_before || "N/A"))
console.log("Expires: " + (result.not_after || "N/A"))
console.log("SANs: " + result.sans || {}.join(", "))
```
---

## get_current_user

Get details of the currently authenticated Caddy user.

### Parameters

None.

### Examples

```js
var result = app.integrations.caddy.get_current_user({})

console.log("User: " + result.username + " (" + result.email + ")")
```
---

## Multi-Account Usage

If you have multiple Caddy accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.caddy.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.caddy.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.caddy.production.function_name({ /* parameters */ })
app.integrations.caddy.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
