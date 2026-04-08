# Clerk — Lua API Reference

## clerk_list_users

List users from Clerk with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of users to return (default: 10, max: 500). |
| `offset` | integer | no | Number of users to skip for pagination. |
| `email_address` | string | no | Filter users by email address. |
| `phone_number` | string | no | Filter users by phone number. |
| `query` | string | no | Search query to filter users by name, email, or username. |
| `order_by` | string | no | Sort order: `"+created_at"` (ascending) or `"-created_at"` (descending). |

### Examples

```lua
-- List all users
local result = app.integrations.clerk.list_users({})

-- Search for a user by name or email
local result = app.integrations.clerk.list_users({
  query = "john"
})

-- Paginate through users
local result = app.integrations.clerk.list_users({
  limit = 50,
  offset = 100,
  order_by = "-created_at"
})
```

---

## clerk_get_user

Retrieve a single Clerk user by their ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Clerk user ID (e.g., `"user_2abc123"`). |

### Examples

```lua
local result = app.integrations.clerk.get_user({
  id = "user_2abc123"
})
```

---

## clerk_create_user

Create a new user in Clerk.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email_address` | array | yes | Array of email addresses for the user. At least one is required. |
| `first_name` | string | no | The user's first name. |
| `last_name` | string | no | The user's last name. |
| `password` | string | no | The user's password (minimum 8 characters). |
| `username` | string | no | The user's username. |

### Examples

```lua
-- Create a user with email and name
local result = app.integrations.clerk.create_user({
  email_address = { "john@example.com" },
  first_name = "John",
  last_name = "Doe",
  password = "securepassword123"
})

-- Create a user with multiple emails
local result = app.integrations.clerk.create_user({
  email_address = { "john@work.com", "john@personal.com" },
  first_name = "John",
  username = "johndoe"
})
```

---

## clerk_update_user

Update an existing Clerk user's profile.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Clerk user ID to update. |
| `first_name` | string | no | Updated first name. |
| `last_name` | string | no | Updated last name. |
| `username` | string | no | Updated username. |

### Examples

```lua
-- Update a user's name
local result = app.integrations.clerk.update_user({
  id = "user_2abc123",
  first_name = "Jane",
  last_name = "Smith"
})

-- Update username only
local result = app.integrations.clerk.update_user({
  id = "user_2abc123",
  username = "janesmith"
})
```

---

## clerk_delete_user

Delete a user from Clerk. This action is irreversible.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Clerk user ID to delete. |

### Examples

```lua
local result = app.integrations.clerk.delete_user({
  id = "user_2abc123"
})
```

---

## clerk_list_organizations

List organizations from Clerk with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of organizations to return (default: 10, max: 500). |
| `offset` | integer | no | Number of organizations to skip for pagination. |
| `query` | string | no | Search query to filter organizations by name. |

### Examples

```lua
-- List all organizations
local result = app.integrations.clerk.list_organizations({})

-- Search for an organization
local result = app.integrations.clerk.list_organizations({
  query = "Acme"
})

-- Paginate
local result = app.integrations.clerk.list_organizations({
  limit = 50,
  offset = 0
})
```

---

## clerk_get_current_user

Health check — verify Clerk API connectivity by fetching the first user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.clerk.get_current_user({})
if result.connected then
  print("Clerk API is reachable")
end
```

---

## Multi-Account Usage

If you have multiple Clerk applications configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.clerk.function_name({})

-- Explicit default (portable across setups)
app.integrations.clerk.default.function_name({})

-- Named accounts
app.integrations.clerk.production.function_name({})
app.integrations.clerk.staging.function_name({})
```

All functions are identical across accounts — only the credentials differ.
