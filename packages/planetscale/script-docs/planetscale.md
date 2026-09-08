# PlanetScale — Ruby API Reference

## list_databases

List databases in a PlanetScale organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | yes | The organization name |
| `page` | integer | no | Page number (1-based, default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |

### Example

```ruby
result = app.integrations.planetscale.list_databases(organization: "my-org", page: 1, limit: 10)
result.data.each do |db|
  puts((db.name).to_s + ": " + (db.state).to_s)
end
```
---

## get_database

Get details of a specific PlanetScale database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | yes | The organization name |
| `database` | string | yes | The database name |

### Example

```ruby
result = app.integrations.planetscale.get_database(organization: "my-org", database: "my-database")
puts("State: " + (result.state).to_s)
puts("Region: " + (result.region.slug).to_s)
puts("Branches: " + (result.branches).to_s)
```
---

## create_database

Create a new database in a PlanetScale organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | yes | The organization name |
| `name` | string | yes | The database name (lowercase, hyphens allowed) |
| `region` | string | no | The region slug (e.g., "us-east-1") |
| `notes` | string | no | Optional notes about the database |

### Example

```ruby
result = app.integrations.planetscale.create_database(organization: "my-org", name: "my-new-database", region: "us-east-1", notes: "Production database for project X")
puts("Created (Unix seconds): " + (result.name).to_s)
puts("State: " + (result.state).to_s)
```
---

## list_branches

List branches of a PlanetScale database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | yes | The organization name |
| `database` | string | yes | The database name |
| `page` | integer | no | Page number (1-based, default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |

### Example

```ruby
result = app.integrations.planetscale.list_branches(organization: "my-org", database: "my-database")
result.data.each do |branch|
  puts((branch.name).to_s + " (" + (branch.role).to_s + ")")
end
```
---

## get_branch

Get details of a specific branch of a PlanetScale database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | yes | The organization name |
| `database` | string | yes | The database name |
| `branch` | string | yes | The branch name |

### Example

```ruby
result = app.integrations.planetscale.get_branch(organization: "my-org", database: "my-database", branch: "main")
puts("Role: " + (result.role).to_s)
puts("Ready: " + ((result.ready).to_s).to_s)
puts("Region: " + (result.region.slug).to_s)
```
---

## list_organizations

List organizations the authenticated user belongs to.

### Parameters

None.

### Example

```ruby
result = app.integrations.planetscale.list_organizations()
result.data.each do |org|
  puts((org.name).to_s + " (" + (org.slug).to_s + ")")
end
```
---

## get_current_user

Get the profile of the currently authenticated user.

### Parameters

None.

### Example

```ruby
result = app.integrations.planetscale.get_current_user()
puts("User: " + ((result.first_name || "")).to_s + " " + ((result.last_name || "")).to_s)
puts("Email: " + (result.email).to_s)
```
---

## Multi-Account Usage

If you have multiple PlanetScale accounts configured, use account-specific namespaces:

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
