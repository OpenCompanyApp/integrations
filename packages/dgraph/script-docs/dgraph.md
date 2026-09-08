# Dgraph — Ruby API Reference

All tools are accessed via `app.integrations.dgraph.{tool_key}({params})`.

---

## dgraph_list_schema

List the full GraphQL schema from Dgraph. Returns all types, their fields, and field types. Useful for understanding the overall data model.

### Parameters

This tool takes no parameters.

### Example

```ruby
result = app.integrations.dgraph.list_schema()
result.schema.types.each do |t|
  puts(t.name)
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

```ruby
result = app.integrations.dgraph.get_schema(type_name: "User")
result.schema.types[0].fields.each do |field|
  puts((field.name).to_s + ": " + ((field.type.name || "unknown")).to_s)
end
```
---

## dgraph_list_types

List all types defined in the Dgraph GraphQL schema. Returns type names for all user-defined and system types available in the database.

### Parameters

This tool takes no parameters.

### Example

```ruby
result = app.integrations.dgraph.list_types()
result.schema.types.each do |t|
  puts(t.name)
end
```
---

## dgraph_list_indexes

List all indexes defined in the Dgraph schema. Returns types with their fields and directives, allowing you to identify indexed fields and their index types.

### Parameters

This tool takes no parameters.

### Example

```ruby
result = app.integrations.dgraph.list_indexes()
result.schema.types.each do |t|
  (t.fields || []).each do |field|
    (field.directives || []).each do |dir|
      if (dir.name == "dgraph")
        puts((t.name).to_s + "." + (field.name).to_s + " (indexed)")
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

```ruby
node = app.integrations.dgraph.get_node(type: "User", id: "0x123")
puts(node.getUser.id)
puts(node.getUser.name)
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

```ruby
result = app.integrations.dgraph.mutate(mutation: "\n    mutation AddUser($name: String!, $email: String!) {\n      addUser(input: [{ name: $name, email: $email }]) {\n        user {\n          id\n          name\n        }\n      }\n    }\n  ", variables: {name: "Alice", email: "alice@example.com"})
puts("Created user: " + (result.addUser.user[0].id).to_s)
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

```ruby
result = app.integrations.dgraph.drop_mutation(mutation: "\n    mutation DeleteUser($id: ID!) {\n      deleteUser(filter: { id: [$id] }) {\n        user {\n          id\n        }\n      }\n    }\n  ", variables: {id: "0x123"})
puts("Deleted user")
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

```ruby
result = app.integrations.dgraph.query(query: "\n    query($name: String) {\n      queryUser(filter: { name: { eq: $name } }) {\n        id\n        name\n        email\n      }\n    }\n  ", variables: {name: "Alice"})
result.queryUser.each do |user|
  puts((user.name).to_s + " <" + (user.email).to_s + ">")
end
```
---

## dgraph_get_current_user

Get the current authenticated Dgraph user identity. Verifies the configured bearer token and returns the associated user information.

### Parameters

This tool takes no parameters.

### Example

```ruby
user = app.integrations.dgraph.get_current_user()
puts("User: " + ((user.currentUser.name || "unknown")).to_s)
puts("Email: " + ((user.currentUser.email || "unknown")).to_s)
```
---

## Multi-Account Usage

If you have multiple Dgraph accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
