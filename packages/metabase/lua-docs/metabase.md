# Metabase — Lua API Reference

## list_dashboards

List all dashboards available in Metabase.

### Parameters

None.

### Returns

```lua
{
  dashboards = {
    { id = 1, name = "Sales Overview", ... },
    { id = 2, name = "Marketing KPIs", ... },
  },
  count = 2
}
```

### Example

```lua
local result = app.integrations.metabase.list_dashboards()

for _, db in ipairs(result.dashboards) do
  print(db.id .. ": " .. db.name)
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

```lua
local result = app.integrations.metabase.get_dashboard({ id = 1 })

print("Dashboard: " .. result.name)
print("Cards: " .. #result.ordered_cards)

for _, item in ipairs(result.ordered_cards) do
  local card = item.card
  if card then
    print("  Card " .. card.id .. ": " .. card.name)
  end
end
```

---

## list_cards

List all cards (saved questions) in Metabase.

### Parameters

None.

### Returns

```lua
{
  cards = {
    { id = 10, name = "Revenue by Month", display = "bar", ... },
    { id = 11, name = "Active Users", display = "scalar", ... },
  },
  count = 2
}
```

### Example

```lua
local result = app.integrations.metabase.list_cards()

for _, card in ipairs(result.cards) do
  print(card.id .. ": " .. card.name .. " (" .. (card.display or "?") .. ")")
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

```lua
local result = app.integrations.metabase.get_card({ id = 10 })

print("Name: " .. result.name)
print("Display: " .. result.display)
print("Database: " .. (result.database_id or "unknown"))
```

---

## query_card

Execute a saved card (question) and return the query results.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The card (question) ID to execute |

### Returns

```lua
{
  rows = {
    { month = "2026-01", revenue = 42000 },
    { month = "2026-02", revenue = 51000 },
  },
  rowCount = 2,
  columns = { "month", "revenue" }
}
```

### Example

```lua
local result = app.integrations.metabase.query_card({ id = 10 })

print("Columns: " .. table.concat(result.columns, ", "))
print("Rows: " .. result.rowCount)

for _, row in ipairs(result.rows) do
  print(row.month .. ": $" .. row.revenue)
end
```

---

## list_databases

List all databases connected to Metabase.

### Parameters

None.

### Returns

```lua
{
  databases = {
    { id = 1, name = "Production DB", engine = "postgres", ... },
    { id = 2, name = "Analytics Warehouse", engine = "bigquery", ... },
  },
  count = 2
}
```

### Example

```lua
local result = app.integrations.metabase.list_databases()

for _, db in ipairs(result.databases) do
  print(db.id .. ": " .. db.name .. " (" .. db.engine .. ")")
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

```lua
local result = app.integrations.metabase.get_database({ id = 1 })

print("Database: " .. result.name)
print("Engine: " .. result.engine)

for _, table in ipairs(result.tables or {}) do
  print("  Table: " .. table.name .. " (" .. #table.fields .. " fields)")
  for _, field in ipairs(table.fields or {}) do
    print("    - " .. field.name .. " (" .. field.base_type .. ")")
  end
end
```

---

## get_current_user

Get the currently authenticated Metabase user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.metabase.get_current_user()

print("User: " .. result.common_name)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Metabase instances configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.metabase.function_name({...})

-- Explicit default (portable across setups)
app.integrations.metabase.default.function_name({...})

-- Named accounts
app.integrations.metabase.production.function_name({...})
app.integrations.metabase.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
