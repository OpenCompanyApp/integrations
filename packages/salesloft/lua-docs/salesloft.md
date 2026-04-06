# Salesloft — Lua API Reference

## list_sequences

List call sequences from Salesloft with optional status filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of sequences to return per page (default: 25) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `status` | string | no | Filter by sequence status (e.g., `"active"`, `"paused"`) |

### Examples

#### List all active sequences

```lua
local result = app.integrations.salesloft.list_sequences({
  status = "active",
  limit = 50
})

for _, seq in ipairs(result.data) do
  print(seq.id .. ": " .. seq.name .. " (" .. seq.status .. ")")
end
```

#### Paginate through sequences

```lua
local result = app.integrations.salesloft.list_sequences({
  limit = 25,
  page = 2
})
```

---

## get_sequence

Get detailed information about a specific call sequence.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The sequence ID |

### Examples

#### Get a sequence by ID

```lua
local result = app.integrations.salesloft.get_sequence({
  id = 12345
})

print("Name: " .. result.data.name)
print("Status: " .. result.data.status)
print("Owner: " .. result.data.owner_id)
```

---

## create_sequence

Create a new call sequence in Salesloft.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name of the call sequence |
| `steps` | array | no | Array of step definitions for the sequence |
| `owner_id` | integer | no | ID of the user who will own this sequence |
| `status` | string | no | Initial status (e.g., `"active"`, `"paused"`) |
| `targets` | array | no | Array of target people or account IDs |

### Examples

#### Create a simple sequence

```lua
local result = app.integrations.salesloft.create_sequence({
  name = "Q1 Outreach Campaign",
  owner_id = 42,
  status = "active"
})

print("Created sequence: " .. result.data.id)
```

#### Create a sequence with steps and targets

```lua
local result = app.integrations.salesloft.create_sequence({
  name = "Follow-up Campaign",
  owner_id = 42,
  steps = {
    { type = "call", name = "Initial Call" },
    { type = "email", name = "Follow-up Email" }
  },
  targets = { 101, 102, 103 },
  status = "active"
})
```

---

## list_rules

List automation rules from Salesloft with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of rules to return per page (default: 25) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Examples

#### List all rules

```lua
local result = app.integrations.salesloft.list_rules({
  limit = 50
})

for _, rule in ipairs(result.data) do
  print(rule.id .. ": " .. rule.name)
end
```

---

## get_rule

Get detailed information about a specific automation rule.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The rule ID |

### Examples

#### Get a rule by ID

```lua
local result = app.integrations.salesloft.get_rule({
  id = 67890
})

print("Rule: " .. result.data.name)
```

---

## get_current_user

Get the profile of the currently authenticated Salesloft user. Useful for verifying credentials and identifying the connected account.

### Parameters

None.

### Examples

#### Get current user

```lua
local result = app.integrations.salesloft.get_current_user({})

print("User: " .. result.data.first_name .. " " .. result.data.last_name)
print("Email: " .. result.data.email)
```

---

## Multi-Account Usage

If you have multiple Salesloft accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.salesloft.list_sequences({...})

-- Explicit default (portable across setups)
app.integrations.salesloft.default.list_sequences({...})

-- Named accounts
app.integrations.salesloft.production.list_sequences({...})
app.integrations.salesloft.staging.list_sequences({...})
```

All functions are identical across accounts — only the credentials differ.
