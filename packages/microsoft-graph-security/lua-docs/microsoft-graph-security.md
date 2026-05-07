# Microsoft Graph Security

Namespace: `microsoft-graph-security`

This integration exposes the stable Microsoft Graph v1.0 `/security` API surface from the official Microsoft Graph OpenAPI metadata. It covers alerts, incidents, secure score, threat intelligence, eDiscovery cases, retention labels, subject rights requests, attack simulation, identity security, and data security and governance resources.

## Authentication

Provide a Microsoft Graph OAuth access token. The token must include the delegated or application permissions required by the operation you call, such as Microsoft Graph Security, Threat Intelligence, Secure Score, eDiscovery, Attack Simulation, or compliance permissions.

## Usage notes

- Start with `microsoft_graph_security_list_alerts_v2`, `microsoft_graph_security_list_incidents`, `microsoft_graph_security_list_secure_scores`, or threat intelligence list tools depending on the workflow.
- OData parameters are normalized without the `$` prefix: `select`, `expand`, `filter`, `orderby`, `top`, `skip`, `search`, and `count`.
- Use `consistency_level = "eventual"` when a Graph endpoint requires advanced query semantics.
- Write and action endpoints accept a `body` object matching the official Microsoft Graph request schema for that operation.
- Responses are decoded Graph JSON when available. Binary/report download endpoints return `body`, `status`, and `content_type` when Graph does not return JSON.

## Example

```lua
local incidents = microsoft_graph_security_list_incidents({ top = 10, filter = "status ne 'resolved'" })
local alert = microsoft_graph_security_get_alerts_v2({ alert_id = "alert-id", select = "id,title,severity,status" })
local scores = microsoft_graph_security_list_secure_scores({ top = 5 })
```
