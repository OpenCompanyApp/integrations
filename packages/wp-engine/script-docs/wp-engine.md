# WP Engine — JavaScript API Reference

## list_sites

List WP Engine sites with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of sites per page (default: 100) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```js
// List sites
var result = app.integrations["wp-engine"].wp_engine_list_sites({
  limit: 10,
  page: 1,
})

for (const site of (result.sites)) {
  console.log(site.id + ": " + site.name + " (" + site.status + ")")
}
```
---

## get_site

Get details for a specific WP Engine site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The site ID |

### Examples

```js
var result = app.integrations["wp-engine"].wp_engine_get_site({ id: "12345" })
console.log(result.name)
console.log(result.status)
console.log(result.created_at)
```
---

## list_installs

List WP Engine installs with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of installs per page (default: 100) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```js
// List installs
var result = app.integrations["wp-engine"].wp_engine_list_installs({
  limit: 10,
  page: 1,
})

for (const install of (result.installs)) {
  console.log(install.id + ": " + install.name + " - " + install.environment)
}
```
---

## get_install

Get details for a specific WP Engine install.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The install ID |

### Examples

```js
var result = app.integrations["wp-engine"].wp_engine_get_install({ id: "67890" })
console.log(result.name)
console.log(result.environment)
console.log(result.php_version)
console.log(result.status)
```
---

## list_domains

List domains across WP Engine installs.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of domains per page (default: 100) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```js
var result = app.integrations["wp-engine"].wp_engine_list_domains({
  limit: 50,
  page: 1,
})

for (const domain of (result.domains)) {
  console.log(domain.name + " -> " + domain.installs_id)
}
```
---

## list_users

List WP Engine users with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of users per page (default: 100) |
| `page` | integer | no | Page number for pagination (1-indexed, default: 1) |

### Examples

```js
var result = app.integrations["wp-engine"].wp_engine_list_users({
  limit: 10,
  page: 1,
})

for (const user of (result.users)) {
  console.log(user.id + ": " + user.email + " (" + user.role + ")")
}
```
---

## get_current_user

Get the profile of the currently authenticated user.

### Parameters

None.

### Examples

```js
var result = app.integrations["wp-engine"].wp_engine_get_current_user({})
console.log("Logged in as: " + result.email + " (" + result.id + ")")
```
---

## Multi-Account Usage

If you have multiple WP Engine accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["wp-engine"].wp_engine_function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations["wp-engine"].default.wp_engine_function_name({ /* parameters */ })

// Named accounts
app.integrations["wp-engine"].production.wp_engine_function_name({ /* parameters */ })
app.integrations["wp-engine"].staging.wp_engine_function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
