# Dgraph — JavaScript API Reference

All tools are accessed via `app.integrations.dgraph.{tool_key}({params})`.

---

## dgraph_list_schema

List the full GraphQL schema from Dgraph. Returns all types, their fields, and field types. Useful for understanding the overall data model.

### Parameters

This tool takes no parameters.

### Example

```js
var result = app.integrations.dgraph.dgraph_list_schema()

for (const t of (result.schema.types)) {
  console.log(t.name)
}
```
---

## dgraph_get_schema

Get the GraphQL schema for a specific type in Dgraph. Returns the type definition including all fields and their types.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type_name` | string | yes | The GraphQL type name to retrieve the schema for |

### Example

```js
var result = app.integrations.dgraph.dgraph_get_schema({
  type_name: "User",
})

for (const field of (result.schema.types[0].fields)) {
  console.log(field.name + ": " + (field.type.name || "unknown"))
}
```
---

## dgraph_list_types

List all types defined in the Dgraph GraphQL schema. Returns type names for all user-defined and system types available in the database.

### Parameters

This tool takes no parameters.

### Example

```js
var result = app.integrations.dgraph.dgraph_list_types()

for (const t of (result.schema.types)) {
  console.log(t.name)
}
```
---

## dgraph_list_indexes

List all indexes defined in the Dgraph schema. Returns types with their fields and directives, allowing you to identify indexed fields and their index types.

### Parameters

This tool takes no parameters.

### Example

```js
var result = app.integrations.dgraph.dgraph_list_indexes()

for (const t of (result.schema.types)) {
  for (const field of (t.fields || [])) {
    for (const dir of (field.directives || [])) {
      if (dir.name === "dgraph") {
        console.log(t.name + "." + field.name + " (indexed)")
      }
    }
  }
}
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

```js
var node = app.integrations.dgraph.dgraph_get_node({
  type: "User",
  id: "0x123",
})

console.log(node.getUser.id)
console.log(node.getUser.name)
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

```js
var result = app.integrations.dgraph.dgraph_mutate({
  mutation: String.raw`,
    mutation AddUser($name: String!, $email: String!) {
      addUser(input: [{ name: $name, email: $email }]) {
        user {
          id
          name
        }
      }
    }
  `,
  variables: {
    name: "Alice",
    email: "alice@example.com",
  }
})

console.log("Created user: " + result.addUser.user[0].id)
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

```js
var result = app.integrations.dgraph.dgraph_drop_mutation({
  mutation: String.raw`,
    mutation DeleteUser($id: ID!) {
      deleteUser(filter: { id: [$id] }) {
        user {
          id
        }
      }
    }
  `,
  variables: {
    id: "0x123",
  }
})

console.log("Deleted user")
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

```js
var result = app.integrations.dgraph.dgraph_query({
  query: String.raw`,
    query($name: String) {
      queryUser(filter: { name: { eq: $name } }) {
        id
        name
        email
      }
    }
  `,
  variables: {
    name: "Alice",
  }
})

for (const user of (result.queryUser)) {
  console.log(user.name + " <" + user.email + ">")
}
```
---

## dgraph_get_current_user

Get the current authenticated Dgraph user identity. Verifies the configured bearer token and returns the associated user information.

### Parameters

This tool takes no parameters.

### Example

```js
var user = app.integrations.dgraph.dgraph_get_current_user()

console.log("User: " + (user.currentUser.name || "unknown"))
console.log("Email: " + (user.currentUser.email || "unknown"))
```
---

## Multi-Account Usage

If you have multiple Dgraph accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.dgraph.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.dgraph.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.dgraph.production.function_name({ /* parameters */ })
app.integrations.dgraph.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
