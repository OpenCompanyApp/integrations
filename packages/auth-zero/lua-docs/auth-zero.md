# Auth0 — Lua API Reference

## list_users

List users in the Auth0 tenant. Supports search with Lucene syntax, pagination, and sorting.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page index (zero-based). Default: 0. |
| `per_page` | integer | no | Number of results per page. Default: 50, max: 100. |
| `q` | string | no | Lucene search query (e.g. `"email:*@example.com"`). |
| `sort` | string | no | Field to sort by, with optional direction (e.g. `"created_at:-1"` or `"name:1"`). |

### Examples

```lua
local users = app.integrations["auth-zero"].list_users({
  per_page = 10,
  q = 'email:*@example.com'
})

for _, user in ipairs(users) do
  print(user.email .. " — " .. (user.name or "no name"))
end
```

```lua
-- Paginate through all users
local page = 0
local all_users = {}

repeat
  local batch = app.integrations["auth-zero"].list_users({
    page = page,
    per_page = 100
  })
  for _, u in ipairs(batch) do
    table.insert(all_users, u)
  end
  page = page + 1
until #batch < 100
```

---

## get_user

Retrieve a single Auth0 user by their user ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Auth0 user identifier (e.g. `"auth0|abc123"`, `"google-oauth2|xyz"`). |

### Examples

```lua
local user = app.integrations["auth-zero"].get_user({
  id = "auth0|507f1f77bcf86cd799439010"
})

print(user.email)
print(user.name)
print(user.created_at)
```

---

## create_user

Create a new user in Auth0. Requires email, password, and the connection name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Email address for the new user. |
| `password` | string | yes | Password for the new user (must meet connection requirements). |
| `connection` | string | yes | The database connection name (e.g. `"Username-Password-Authentication"`). |
| `name` | string | no | Full name of the user. |

### Examples

```lua
local user = app.integrations["auth-zero"].create_user({
  email = "jane@example.com",
  password = "S3cur3P@ssw0rd!",
  connection = "Username-Password-Authentication",
  name = "Jane Doe"
})

print("Created user: " .. user.user_id)
```

---

## list_connections

List identity connections configured in the Auth0 tenant. Optionally filter by strategy.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `strategy` | string | no | Filter by connection strategy (e.g. `"auth0"`, `"google-oauth2"`, `"samlp"`, `"oidc"`). |

### Examples

```lua
local connections = app.integrations["auth-zero"].list_connections()

for _, conn in ipairs(connections) do
  print(conn.name .. " (" .. conn.strategy .. ")")
end
```

```lua
-- Only database connections
local db_conns = app.integrations["auth-zero"].list_connections({
  strategy = "auth0"
})
```

---

## list_roles

List roles defined in the Auth0 tenant with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page index (zero-based). Default: 0. |
| `per_page` | integer | no | Number of results per page. Default: 50. |

### Examples

```lua
local roles = app.integrations["auth-zero"].list_roles()

for _, role in ipairs(roles) do
  print(role.name .. ": " .. (role.description or "no description"))
end
```

---

## get_tenant_settings

Retrieve the Auth0 tenant settings (session lifetime, idle timeout, default directory, etc.).

### Parameters

None.

### Examples

```lua
local settings = app.integrations["auth-zero"].get_tenant_settings()

print("Session lifetime: " .. settings.session_lifetime .. " hours")
print("Idle timeout: " .. (settings.idle_session_lifetime or "none"))
```

---

## get_current_user

Retrieve the profile of the currently authenticated user. Also serves as a health check for the Auth0 connection.

### Parameters

None.

### Examples

```lua
local me = app.integrations["auth-zero"].get_current_user()

print("Token valid. Health check passed.")
```

---

## Multi-Account Usage

If you have multiple auth-zero accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["auth-zero"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["auth-zero"].default.function_name({...})

-- Named accounts
app.integrations["auth-zero"].production.function_name({...})
app.integrations["auth-zero"].staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
