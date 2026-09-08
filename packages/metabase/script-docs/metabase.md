# Metabase — Ruby API Reference

## list_dashboards

List all dashboards available in Metabase.

### Parameters

None.

### Returns

```ruby
example = {dashboards: [{id: 1, name: "Sales Overview"}, {id: 2, name: "Marketing KPIs"}], count: 2}
```
### Example

```ruby
result = app.integrations.metabase.list_dashboards()
result.dashboards.each do |db|
  puts((db.id).to_s + ": " + (db.name).to_s)
end
```
---

## get_dashboard

Get a single Metabase dashboard by ID, including all cards, layout, and parameters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The dashboard ID |

### Example

```ruby
result = app.integrations.metabase.get_dashboard(id: 1)
puts("Dashboard: " + (result.name).to_s)
puts("Cards: " + (result.ordered_cards.length).to_s)
result.ordered_cards.each do |item|
  card = item.card
  if card
    puts("  Card " + (card.id).to_s + ": " + (card.name).to_s)
  end
end
```
---

## list_cards

List all cards (saved questions) in Metabase.

### Parameters

None.

### Returns

```ruby
example = {cards: [{id: 10, name: "Revenue by Month", display: "bar"}, {id: 11, name: "Active Users", display: "scalar"}], count: 2}
```
### Example

```ruby
result = app.integrations.metabase.list_cards()
result.cards.each do |card|
  puts((card.id).to_s + ": " + (card.name).to_s + " (" + ((card.display || "?")).to_s + ")")
end
```
---

## get_card

Get the full definition of a card (question) by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The card (question) ID |

### Example

```ruby
result = app.integrations.metabase.get_card(id: 10)
puts("Name: " + (result.name).to_s)
puts("Display: " + (result.display).to_s)
puts("Database: " + ((result.database_id || "unknown")).to_s)
```
---

## query_card

Execute a saved card (question) and return the query results.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The card (question) ID to execute |

### Returns

```ruby
example = {rows: [{month: "2026-01", revenue: 42000}, {month: "2026-02", revenue: 51000}], rowCount: 2, columns: ["month", "revenue"]}
```
### Example

```ruby
result = app.integrations.metabase.query_card(id: 10)
puts("Columns: " + (result.columns.join(", ")).to_s)
puts("Rows: " + (result.rowCount).to_s)
result.rows.each do |row|
  puts((row.month).to_s + ": $" + (row.revenue).to_s)
end
```
---

## list_databases

List all databases connected to Metabase.

### Parameters

None.

### Returns

```ruby
example = {databases: [{id: 1, name: "Production DB", engine: "postgres"}, {id: 2, name: "Analytics Warehouse", engine: "bigquery"}], count: 2}
```
### Example

```ruby
result = app.integrations.metabase.list_databases()
result.databases.each do |db|
  puts((db.id).to_s + ": " + (db.name).to_s + " (" + (db.engine).to_s + ")")
end
```
---

## get_database

Get detailed metadata for a database, including tables and fields.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The database ID |

### Example

```ruby
result = app.integrations.metabase.get_database(id: 1)
puts("Database: " + (result.name).to_s)
puts("Engine: " + (result.engine).to_s)
(result.tables || []).each do |table|
  puts("  Table: " + (table.name).to_s + " (" + (table.fields.length).to_s + " fields)")
  (table.fields || []).each do |field|
    puts("    - " + (field.name).to_s + " (" + (field.base_type).to_s + ")")
  end
end
```
---

## get_current_user

Get the currently authenticated Metabase user profile.

### Parameters

None.

### Example

```ruby
result = app.integrations.metabase.get_current_user()
puts("User: " + (result.common_name).to_s)
puts("Email: " + (result.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Metabase instances configured, use account-specific namespaces:

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
