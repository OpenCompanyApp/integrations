# Integration: Hetzner Cloud

Hetzner Cloud integration package for OpenCompany and KosmoKrator agents.

This package exposes generated tools from Hetzner's official Cloud API OpenAPI document. It covers servers, server actions, volumes, networks, firewalls, load balancers, floating IPs, primary IPs, SSH keys, certificates, images, ISOs, locations, datacenters, placement groups, pricing, DNS zones, DNS record sets, and action polling.

## Configuration

Required credentials:

- `access_token`: Hetzner Cloud project API token.
- `url`: API base URL. Defaults to `https://api.hetzner.cloud/v1`.

Read-only API tokens can call read tools. Read-write tokens are required for create, update, delete, and action tools.

## Tool Coverage

The generated tool catalog is built from:

```text
https://docs.hetzner.cloud/cloud.spec.json
```

Compatibility slugs that still map to official operations are preserved:

- `hetzner_list_servers`
- `hetzner_get_server`
- `hetzner_create_server`
- `hetzner_list_volumes`
- `hetzner_list_networks`
- `hetzner_list_ssh_keys`

The previous `hetzner_get_current_user` helper was removed because the current official Cloud API has no `/user` endpoint.

## Notes

Generated tools accept OpenAPI parameter names and snake_case aliases. JSON request bodies go in `body`; if `body` is omitted, loose non-path/query/header arguments become the body.
