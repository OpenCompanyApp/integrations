# Hetzner Cloud Lua API Reference

Namespace: `hetzner`

This integration exposes generated coverage for the official Hetzner Cloud OpenAPI document at `https://docs.hetzner.cloud/cloud.spec.json`.

Authentication uses a Hetzner Cloud project API token. Read-only tokens can call `GET` tools. Read-write tokens are required for create, update, delete, and action tools.

## Common Tools

- `hetzner_list_servers` maps to `GET /servers`.
- `hetzner_get_server` maps to `GET /servers/{id}`.
- `hetzner_create_server` maps to `POST /servers`.
- `hetzner_list_volumes` maps to `GET /volumes`.
- `hetzner_list_networks` maps to `GET /networks`.
- `hetzner_list_ssh_keys` maps to `GET /ssh_keys`.

The generated catalog also covers actions, certificates, datacenters, firewalls, floating IPs, images, ISOs, load balancers, locations, networks, placement groups, primary IPs, pricing, server types, volumes, DNS zones, DNS record sets, and resource-specific action endpoints.

## Arguments

Path and query parameters use names from Hetzner's OpenAPI document. Snake-case aliases are also accepted.

For example, both `per_page` and `perPage` can be supplied when the upstream parameter is represented that way by a tool. Path IDs are URL encoded automatically.

Tools with a JSON request body accept a `body` table. If you omit `body`, non-path/query/header arguments are collected into the JSON body.

## Examples

```lua
local servers = hetzner.hetzner_list_servers({
  per_page = 25,
  page = 1
})
```

```lua
local server = hetzner.hetzner_get_server({
  id = 123456
})
```

```lua
local created = hetzner.hetzner_create_server({
  body = {
    name = "agent-demo",
    server_type = "cx22",
    image = "ubuntu-24.04",
    location = "fsn1",
    ssh_keys = { "agent-key" }
  }
})
```

```lua
local action = hetzner.hetzner_poweron_server({
  id = 123456
})
```

## Return Shapes

Responses are Hetzner Cloud's parsed JSON responses. Pagination responses usually include a `meta.pagination` object. Mutating endpoints often return an `action`, a resource object, or both depending on the endpoint.

Non-JSON responses return:

```lua
{
  body = "...",
  content_type = "text/plain"
}
```

The old `hetzner_get_current_user` helper is intentionally not part of the generated catalog because the current official Cloud API spec does not expose a `/user` endpoint. Use a lightweight read tool such as `hetzner_list_locations` to verify token access.
