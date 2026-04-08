# Vultr — Lua API Reference

## list_instances

List all compute instances in the account.

### Parameters

None.

### Example

```lua
local result = app.integrations.vultr.list_instances({})

for _, instance in ipairs(result.instances) do
  print(instance.label .. " (" .. instance.status .. ") - " .. instance.plan .. " - " .. instance.main_ip)
end
```

---

## get_instance

Get details for a specific compute instance.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The instance ID |

### Example

```lua
local result = app.integrations.vultr.get_instance({ id = "abc12345-6789-def0-1234-567890abcdef" })
local i = result.instance
print(i.label .. " - " .. i.region .. " - " .. i.main_ip .. " - " .. i.os)
```

---

## list_plans

List all available hosting plans.

### Parameters

None.

### Example

```lua
local result = app.integrations.vultr.list_plans({})

for _, plan in ipairs(result.plans) do
  print(plan.id .. " - " .. plan.vcpu_count .. " vCPU / " .. plan.ram .. " MB - $" .. plan.monthly_cost .. "/mo")
end
```

---

## list_regions

List all available data center regions.

### Parameters

None.

### Example

```lua
local result = app.integrations.vultr.list_regions({})

for _, region in ipairs(result.regions) do
  print(region.id .. " - " .. region.city .. ", " .. region.country .. " (" .. region.continent .. ")")
end
```

---

## list_snapshots

List all snapshots in the account.

### Parameters

None.

### Example

```lua
local result = app.integrations.vultr.list_snapshots({})

for _, snap in ipairs(result.snapshots) do
  print(snap.id .. " - " .. snap.description .. " (" .. snap.size .. " MB) - " .. snap.status)
end
```

---

## list_ssh_keys

List all SSH keys in the account.

### Parameters

None.

### Example

```lua
local result = app.integrations.vultr.list_ssh_keys({})

for _, key in ipairs(result.ssh_keys) do
  print(key.id .. " - " .. key.name .. " - " .. key.date_created)
end
```

---

## get_current_user

Get the current authenticated account information.

### Parameters

None.

### Example

```lua
local result = app.integrations.vultr.get_current_user({})
print("Account: " .. result.account.email .. " - Balance: $" .. result.account.balance)
```

---

## Multi-Account Usage

If you have multiple Vultr accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.vultr.list_instances({})

-- Explicit default (portable across setups)
app.integrations.vultr.default.list_instances({})

-- Named accounts
app.integrations.vultr.production.list_instances({})
app.integrations.vultr.staging.list_instances({})
```

All functions are identical across accounts — only the credentials differ.
