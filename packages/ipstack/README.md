# Integration: IPstack

IPstack geolocation integration for OpenCompany and KosmoKrator agents. The package maps to the official IPstack endpoint shapes instead of separate pseudo-tools for response sections.

## Authentication

Configure:

- `api_key`: IPstack access key.
- `url`: API base URL. Defaults to `https://api.ipstack.com`.

## Tools

| Tool | Type | Operation |
| --- | --- | --- |
| `ipstack_lookup_ip` | read | `GET /{ip}` |
| `ipstack_lookup_bulk` | read | `GET /{ip1},{ip2}` |
| `ipstack_lookup_requester` | read | `GET /check` |

Optional lookup parameters include `fields`, `language`, `hostname`, and `security`. HTTPS, bulk lookup, hostname lookup, and security fields can depend on the selected IPstack plan.

## Source

- API documentation: https://ipstack.com/documentation
