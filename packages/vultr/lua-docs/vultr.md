# Vultr - Lua API Reference

Namespace: `app.integrations.vultr`

This package exposes 522 generated tools from Vultr's official API reference at `https://www.vultr.com/api/`. Requests use the configured Vultr API key as a bearer token against `https://api.vultr.com/v2` by default.

## Common Operations

```lua
local account = app.integrations.vultr.get_current_user({})
print(account.account.email)

local instances = app.integrations.vultr.list_instances({ per_page = 50 })
for _, instance in ipairs(instances.instances or {}) do
  print(instance.id .. " " .. instance.label .. " " .. instance.status)
end

local instance = app.integrations.vultr.get_instance({ id = "11111111-2222-3333-4444-555555555555" })
print(instance.instance.main_ip)

local plans = app.integrations.vultr.list_plans({ type = "vc2" })
local regions = app.integrations.vultr.list_regions({})
```

## Generated Tool Shape

Tool names follow the upstream operation name, normalized to snake_case with a `vultr_` prefix in metadata and exposed without the prefix in Lua. For example, the upstream `create-instance` operation is available as `app.integrations.vultr.create_instance(...)`.

Path parameters with a single resource id accept `id` for compatibility with the earlier hand-written tools. More specific generated names such as `instance_id`, `ssh_key_id`, `registry_id`, or `policy_id` are also accepted when the upstream path needs them.

Request bodies can be passed as `body = { ... }`. For convenience, generated tools also collect loose arguments that are not path, query, or header parameters into the JSON body.

```lua
local created = app.integrations.vultr.create_instance({
  region = "ewr",
  plan = "vc2-1c-1gb",
  os_id = 1743,
  label = "example-agent-node"
})

app.integrations.vultr.update_instance({
  id = created.instance.id,
  label = "renamed-agent-node"
})
```

## Coverage Notes

The generated catalog includes compute instances, bare metal, Kubernetes, managed databases, block storage, snapshots, backups, ISOs, plans, regions, VPCs, load balancers, firewalls, DNS, object storage, CDN, container registry, storage gateways, serverless inference, IAM, organizations, users, API keys, billing, and support tickets.

Vultr's Redoc spec includes newer IAM and organization paths displayed with `/v2/...` paths while the server URL is already `/v2`; the client normalizes that duplicate version segment when building URLs so generated calls match the curl examples in the official docs.

## Multi-Account Usage

```lua
app.integrations.vultr.list_instances({})
app.integrations.vultr.production.list_instances({})
app.integrations.vultr.staging.list_instances({})
```

All functions are identical across accounts; only the resolved credentials differ.
