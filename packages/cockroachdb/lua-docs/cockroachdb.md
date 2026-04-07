# CockroachDB — Lua API Reference

## list_clusters

List all CockroachDB clusters in the organization.

### Parameters

None.

### Example

```lua
local result = app.integrations.cockroachdb.list_clusters({})

for _, cluster in ipairs(result.clusters) do
  print(cluster.name .. " (" .. cluster.status .. ") - " .. cluster.cloud_provider)
end
```

---

## get_cluster

Get details for a specific CockroachDB cluster.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cluster_id` | string | yes | The cluster ID |

### Example

```lua
local result = app.integrations.cockroachdb.get_cluster({ cluster_id = "abc123-def456" })
local c = result.cluster
print(c.name .. " - " .. c.cloud_provider .. " - " .. c.status)
```

---

## create_cluster

Create a new CockroachDB cluster.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Cluster name (e.g., `"my-app-prod"`) |
| `cloud_provider` | string | yes | Cloud provider: `"GCP"`, `"AWS"`, or `"AZURE"` |
| `region` | string | yes | Region (e.g., `"us-east-1"`, `"europe-west1"`) |
| `plan` | string | no | Plan type: `"SERVERLESS"` or `"DEDICATED"` (default: `"SERVERLESS"`) |
| `spend_limit` | integer | no | Monthly spend limit in cents for serverless clusters |
| `cluster_version` | string | no | CockroachDB version (e.g., `"v23.2"`) |

### Common Cloud Providers & Regions

- **AWS**: `us-east-1`, `us-west-2`, `eu-west-1`, `ap-southeast-1`
- **GCP**: `us-east1`, `us-west1`, `europe-west1`, `asia-east1`
- **AZURE**: `eastus`, `westus2`, `westeurope`, `southeastasia`

### Example

```lua
local result = app.integrations.cockroachdb.create_cluster({
  name = "my-app-prod",
  cloud_provider = "AWS",
  region = "us-east-1",
  plan = "SERVERLESS",
  spend_limit = 1000
})

print("Created cluster: " .. result.cluster.id)
```

---

## list_databases

List all databases in a CockroachDB cluster.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cluster_id` | string | yes | The cluster ID |

### Example

```lua
local result = app.integrations.cockroachdb.list_databases({ cluster_id = "abc123-def456" })

for _, db in ipairs(result.databases) do
  print(db.name)
end
```

---

## get_database

Get details for a specific database in a CockroachDB cluster.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cluster_id` | string | yes | The cluster ID |
| `database_name` | string | yes | The database name |

### Example

```lua
local result = app.integrations.cockroachdb.get_database({
  cluster_id = "abc123-def456",
  database_name = "mydb"
})

print(result.database.name)
```

---

## list_users

List all SQL users in a CockroachDB cluster.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cluster_id` | string | yes | The cluster ID |

### Example

```lua
local result = app.integrations.cockroachdb.list_users({ cluster_id = "abc123-def456" })

for _, user in ipairs(result.users) do
  print(user.name)
end
```

---

## get_current_user

Get the current authenticated CockroachDB Cloud user information.

### Parameters

None.

### Example

```lua
local result = app.integrations.cockroachdb.get_current_user({})
print("User: " .. result.user.email)
```

---

## Multi-Account Usage

If you have multiple CockroachDB Cloud accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.cockroachdb.list_clusters({})

-- Explicit default (portable across setups)
app.integrations.cockroachdb.default.list_clusters({})

-- Named accounts
app.integrations.cockroachdb.production.list_clusters({})
app.integrations.cockroachdb.staging.list_clusters({})
```

All functions are identical across accounts — only the credentials differ.
