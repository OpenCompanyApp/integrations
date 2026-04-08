# Dgraph — Lua API Reference

All tools are accessed via `app.integrations.dgraph.{tool_key}({params})`.

---

## dgraph_list_schema

List the full GraphQL schema from Dgraph. Returns all types, their fields, and field types. Useful for understanding the overall data model.

### Parameters

This tool takes no parameters.

### Example

```lua
local result = app.integrations.dgraph.dgraph_list_schema()

for _, t in ipairs(result.schema.types) do
  print(t.name)
end
```

---

## dgraph_get_schema

Get the GraphQL schema for a specific type in Dgraph. Returns the type definition including all fields and their types.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type_name` | string | yes | The GraphQL type name to retrieve the schema for |

### Example

```lua
local result = app.integrations.dgraph.dgraph_get_schema({
  type_name = "User"
})

for _, field in ipairs(result.schema.types[1].fields) do
  print(field.name .. ": " .. (field.type.name or "unknown"))
end
```

---

## dgraph_list_types

List all types defined in the Dgraph GraphQL schema. Returns type names for all user-defined and system types available in the database.

### Parameters

This tool takes no parameters.

### Example

```lua
local result = app.integrations.dgraph.dgraph_list_types()

for _, t in ipairs(result.schema.types) do
  print(t.name)
end
```

---

## dgraph_list_indexes

List all indexes defined in the Dgraph schema. Returns types with their fields and directives, allowing you to identify indexed fields and their index types.

### Parameters

This tool takes no parameters.

### Example

```lua
local result = app.integrations.dgraph.dgraph_list_indexes()

for _, t in ipairs(result.schema.types) do
  for _, field in ipairs(t.fields or {}) do
    for _, dir in ipairs(field.directives or {}) do
      if dir.name == "dgraph" then
        print(t.name .. "." .. field.name .. " (indexed)")
      end
    end
  end
end
```

---

## dgraph_get_node

Get a specific node from Dgraph by providing its type and ID. Returns the node data including all populated fields.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | yes | The GraphQL type of the node (e.g., `"User"`, `"Post"`) |
| `id` | string | yes | The unique ID of the node to retrieve |

### Example

```lua
local node = app.integrations.dgraph.dgraph_get_node({
  type = "User",
  id = "0x123"
})

print(node.getUser.id)
print(node.getUser.name)
```

---

## dgraph_mutate

Execute a GraphQL mutation to add or update data in Dgraph. Provide the full GraphQL mutation string and optional variables.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `mutation` | string | yes | The GraphQL mutation string to execute |
| `variables` | object | no | Optional variables object for the mutation |

### Example

```lua
local result = app.integrations.dgraph.dgraph_mutate({
  mutation = [[
    mutation AddUser($name: String!, $email: String!) {
      addUser(input: [{ name: $name, email: $email }]) {
        user {
          id
          name
        }
      }
    }
  ]],
  variables = {
    name = "Alice",
    email = "alice@example.com"
  }
})

print("Created user: " .. result.addUser.user[1].id)
```

---

## dgraph_drop_mutation

Execute a GraphQL drop/delete mutation to remove data from Dgraph. Use with caution as this permanently removes data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `mutation` | string | yes | The GraphQL drop/delete mutation string to execute |
| `variables` | object | no | Optional variables object for the mutation |

### Example

```lua
local result = app.integrations.dgraph.dgraph_drop_mutation({
  mutation = [[
    mutation DeleteUser($id: ID!) {
      deleteUser(filter: { id: [$id] }) {
        user {
          id
        }
      }
    }
  ]],
  variables = {
    id = "0x123"
  }
})

print("Deleted user")
```

---

## dgraph_query

Execute a custom GraphQL query against Dgraph. Provide the full GraphQL query string and optional variables. Supports filtering, pagination, sorting, and nested traversals.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | The GraphQL query string to execute |
| `variables` | object | no | Optional variables object for the query |

### Example

```lua
local result = app.integrations.dgraph.dgraph_query({
  query = [[
    query($name: String) {
      queryUser(filter: { name: { eq: $name } }) {
        id
        name
        email
      }
    }
  ]],
  variables = {
    name = "Alice"
  }
})

for _, user in ipairs(result.queryUser) do
  print(user.name .. " <" .. user.email .. ">")
end
```

---

## dgraph_get_current_user

Get the current authenticated Dgraph user identity. Verifies the configured bearer token and returns the associated user information.

### Parameters

This tool takes no parameters.

### Example

```lua
local user = app.integrations.dgraph.dgraph_get_current_user()

print("User: " .. (user.currentUser.name or "unknown"))
print("Email: " .. (user.currentUser.email or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Dgraph accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.dgraph.function_name({...})

-- Explicit default (portable across setups)
app.integrations.dgraph.default.function_name({...})

-- Named accounts
app.integrations.dgraph.production.function_name({...})
app.integrations.dgraph.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
