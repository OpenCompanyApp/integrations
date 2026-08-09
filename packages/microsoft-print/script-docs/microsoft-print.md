# Microsoft Universal Print

Namespace: `microsoft-print`

This integration exposes Microsoft Universal Print operations from Microsoft Graph v1.0 for agents that need to inspect or manage printers, printer shares, print jobs, job documents, connectors, services, task triggers, and task definitions.

## Source Coverage

- Source OpenAPI: `https://raw.githubusercontent.com/microsoftgraph/msgraph-metadata/master/openapi/v1.0/openapi.yaml`
- Documentation: `https://learn.microsoft.com/en-us/graph/api/resources/print?view=graph-rest-1.0`
- Generated operations: `142`
- Included path families: `/print`

## Authentication

Configure `access_token` with a Microsoft Graph OAuth token. Use least-privilege permissions for the operation being called, such as `Printer.Read.All`, `Printer.ReadWrite.All`, `PrintJob.Read.All`, `PrintJob.ReadWrite.All`, `PrintConnector.Read.All`, or related Microsoft Graph scopes.

## Usage Notes

- Tool parameters use snake_case. For example, Graph path parameter `user-id` becomes `user_id`.
- OData options are exposed as `top`, `skip`, `search`, `filter`, `orderby`, `select`, `expand`, and `count`.
- Advanced queries may require `consistency_level = "eventual"` and may also require `count = true`.
- Conditional update and delete operations can pass `if_match` for the Microsoft Graph `If-Match` header.
- Request bodies are passed as `body` objects and should match the official Microsoft Graph schema for the endpoint.

## Example

```js
var printers = tools.microsoft_print_print_list_printers({
  top: 10,
  select: "id,displayName,status",
  consistency_level: "eventual",
})
```