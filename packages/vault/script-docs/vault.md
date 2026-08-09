# HashiCorp Vault — JavaScript API Reference

## Overview

The HashiCorp Vault integration provides access to secrets management (KV v2), ACL policy management, and token introspection. All 7 tools are available under the `app.integrations.vault` namespace.

Every tool call accepts a single JavaScript object with named parameters and returns a JavaScript object with the API response data.

## Authentication

The Vault integration authenticates via a **Bearer token**. The token is sent in the `Authorization` header on every request.

To create a token:

```bash
vault token create -policy="my-policy" -ttl="24h"
```

Or obtain one from your Vault administrator.

Required token capabilities depend on the tools you use:

| Capability | Needed for |
|-----------|------------|
| `list` | Listing secrets |
| `read` | Getting secrets, policies, token info |
| `create` / `update` | Creating or updating secrets |
| `delete` | Deleting secrets and metadata |
| `sudo` | Some sys operations (policies) |

```js
// All calls use the same namespace — no per-call auth needed
var policies = app.integrations.vault.list_policies({})
```
## Secrets (KV v2)

### `app.integrations.vault.list_secrets({ engine_path, path })`

List secrets at a given path in a KV v2 secrets engine. Returns the keys (directory entries) at the specified path.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `engine_path` | string | no | Mount path of the KV v2 engine. Default: `"secret"` |
| `path` | string | no | Path within the secrets engine to list. Leave empty for root. |

```js
var result = app.integrations.vault.list_secrets({
  engine_path: "secret",
  path: "myapp",
})

for (const key of (result.data.keys)) {
  console.log(key)
}
```
### `app.integrations.vault.get_secret({ path, engine_path, version })`

Get a secret from a KV v2 secrets engine. Returns the secret data along with metadata (version, creation time, etc.).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `path` | string | yes | Path of the secret (e.g. `"myapp/database"`) |
| `engine_path` | string | no | Mount path of the KV v2 engine. Default: `"secret"` |
| `version` | integer | no | Specific version to retrieve. Default: latest |

```js
var result = app.integrations.vault.get_secret({
  path: "myapp/database",
})

var secret = result.data.data
console.log("Username: " + secret.username)
console.log("Password: " + secret.password)
console.log("Version: " + result.data.metadata.version)
```
Retrieve a specific version:

```js
var result = app.integrations.vault.get_secret({
  path: "myapp/database",
  version: 3,
})

console.log("Version 3 password: " + result.data.data.password)
```
### `app.integrations.vault.create_secret({ path, data, engine_path })`

Create or update a secret in a KV v2 secrets engine. This creates a new version of the secret.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `path` | string | yes | Path where the secret will be stored |
| `data` | table | yes | Key-value pairs for the secret data |
| `engine_path` | string | no | Mount path of the KV v2 engine. Default: `"secret"` |

```js
var result = app.integrations.vault.create_secret({
  path: "myapp/database",
  data: {
    username: "admin",
    password: "s3cret_p@ssw0rd",
    host: "db.example.com",
    port: 5432,
  },
})

console.log("Created version: " + result.data.version)
```
Store structured configuration:

```js
var result = app.integrations.vault.create_secret({
  path: "myapp/config",
  data: {
    debug: false,
    log_level: "info",
    max_connections: 100,
    allowed_origins: [ "https://example.com", "https://app.example.com" ],
  },
})
```
### `app.integrations.vault.delete_secret({ path, engine_path })`

Permanently delete all versions and metadata of a secret from a KV v2 secrets engine. This action is irreversible.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `path` | string | yes | Path of the secret to delete |
| `engine_path` | string | no | Mount path of the KV v2 engine. Default: `"secret"` |

```js
var result = app.integrations.vault.delete_secret({
  path: "myapp/database",
})

if (result.success) {
  console.log("Secret deleted successfully")
}
```
## Policies

### `app.integrations.vault.list_policies({})`

List all ACL policies configured in Vault. Returns an array of policy names.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```js
var result = app.integrations.vault.list_policies({})

for (const name of (result.data.policies)) {
  console.log(name)
}
```
### `app.integrations.vault.get_policy({ name })`

Get details of a specific ACL policy, including its name and HCL rules.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name of the ACL policy to retrieve |

```js
var result = app.integrations.vault.get_policy({
  name: "my-app-policy",
})

console.log("Policy: " + result.data.name)
console.log("Rules:\n" + result.data.rules)
```
## Token Information

### `app.integrations.vault.get_current_user({})`

Look up the current Vault token's information, including display name, associated policies, TTL, and metadata.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```js
var result = app.integrations.vault.get_current_user({})

var info = result.data
console.log("Display name: " + info.display_name)
console.log("Policies: " + info.policies.join(", "))
console.log("TTL: " + info.ttl + "s")
console.log("Renewable: " + String(info.renewable))
```
## Common Workflows

### Store and retrieve database credentials

```js
// 1. Store credentials
app.integrations.vault.create_secret({
  path: "production/database",
  data: {
    username: "app_user",
    password: "generated_secure_password",
    host: "prod-db.internal",
    port: 5432,
    database: "myapp",
  },
})

// 2. Retrieve credentials when needed
var result = app.integrations.vault.get_secret({
  path: "production/database",
})

var creds = result.data.data
var dsn = string.format("postgresql://%s:%s@%s:%d/%s",
  creds.username, creds.password, creds.host, creds.port, creds.database)
console.log("DSN: " + dsn)
```
### Rotate a secret

```js
var path = "production/api-key"

// 1. Read current secret (to verify it exists)
var current = app.integrations.vault.get_secret({ path: path })
console.log("Current version: " + current.data.metadata.version)

// 2. Write new secret (creates a new version)
var result = app.integrations.vault.create_secret({
  path: path,
  data: {
    api_key: "new_rotated_key_xyz",
    rotated_at: new Date().toISOString(),
  },
})

console.log("New version: " + result.data.version)
```
### Audit policies

```js
// List all policies and display their rules
var result = app.integrations.vault.list_policies({})

for (const name of (result.data.policies)) {
  if (name !== "root") {
    var policy = app.integrations.vault.get_policy({ name: name })
    console.log("=== " + name + " ===")
    console.log(policy.data.rules)
    console.log()
  }
}
```
### Verify token before operations

```js
// Check token validity and permissions before performing operations
var result = app.integrations.vault.get_current_user({})

var info = result.data
console.log("Token display name: " + info.display_name)
console.log("Token policies: " + info.policies.join(", "))

if (info.ttl < 300) {
  console.log("Warning: token expires in less than 5 minutes!")
}
```
## Response Structure

Vault API responses follow a consistent structure:

```js
// Secret responses wrap data in data.data (KV v2)
var result = app.integrations.vault.get_secret({ path: "myapp/config" })
// result.data.data        → the actual secret key-value pairs
// result.data.metadata   → version, created_time, deletion_time, etc.

// List responses return keys
var result = app.integrations.vault.list_secrets({ path: "myapp" })
// result.data.keys       → array of key names

// Policy list returns policy names
var result = app.integrations.vault.list_policies({})
// result.data.policies   → array of policy name strings

// Token lookup returns token metadata
var result = app.integrations.vault.get_current_user({})
// result.data            → display_name, policies, ttl, renewable, etc.
```
## Notes

- **KV v2 only**: This integration uses the KV v2 secrets engine API. Ensure your secrets engine is mounted as KV version 2.
- **Engine path**: The default engine path is `"secret"`. If your KV v2 engine is mounted at a different path, pass the `engine_path` parameter.
- **Versions**: KV v2 maintains version history. Use the `version` parameter in `get_secret` to retrieve specific versions. `delete_secret` permanently removes all versions and metadata.
- **Token TTL**: Vault tokens have a time-to-live. Use `get_current_user` to check remaining TTL and whether the token is renewable.
- **Capabilities**: Ensure your token has the required capabilities (read, list, create, update, delete) for the paths you intend to access.

---

## Multi-Account Usage

If you have multiple Vault accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.vault.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.vault.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.vault.production.function_name({ /* parameters */ })
app.integrations.vault.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
