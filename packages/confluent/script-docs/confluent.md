# Confluent Cloud - JavaScript API Reference

Namespace: `app.integrations.confluent`

This package exposes 486 generated tools from Confluent's official Cloud API OpenAPI document at `https://docs.confluent.io/cloud/current/openapi.yaml`. It covers the published Confluent Cloud API groups, including IAM, organizations, Kafka, Schema Registry, Connect, Flink, networking, billing, catalog, stream sharing, provider integrations, Tableflow, artifacts, and related Cloud resources.

## Authentication

Confluent Cloud API keys use HTTP Basic authentication with `api_key` and `api_secret`. OAuth, STS, external, partner, or resource-specific bearer credentials can be supplied as `access_token`. The legacy `api_token` field is still accepted as a bearer token for hosts that already configured it.

## Common Operations

```js
var environments = app.integrations.confluent.list_environments({ page_size: 10 })
var clusters = app.integrations.confluent.list_clusters({ environment: "env-abc123" })

var topics = app.integrations.confluent.list_topics({ cluster_id: "lkc-abc123" })
var topic = app.integrations.confluent.get_topic({
  cluster_id: "lkc-abc123",
  topic_name: "orders",
})

app.integrations.confluent.create_topic({
  cluster_id: "lkc-abc123",
  topic_name: "orders",
  partitions_count: 6,
})
```
## Generated Tool Shape

Tool names follow the upstream operation name, normalized to snake_case with a `confluent_` prefix in metadata and exposed without the prefix in JavaScript. Existing common names such as `list_topics`, `get_topic`, `create_topic`, `list_clusters`, `get_cluster`, and `list_environments` are preserved where they map to official endpoints.

Path parameters with a single resource id accept `id` for convenience. Specific generated parameter names such as `cluster_id`, `topic_name`, `environment`, `id`, `name`, and API-group-specific identifiers are also accepted when the upstream path needs them.

Request bodies can be passed as `body = { ... }`. For convenience, generated tools also collect loose arguments that are not path, query, or header parameters into the JSON body.

## Coverage Notes

Confluent documents different API groups with different versions rather than a single API version. This integration intentionally uses the combined official Cloud API source and does not expose undocumented endpoints such as the old hand-written `/users/me` health check.

## Multi-Account Usage

```js
app.integrations.confluent.list_environments({})
app.integrations.confluent.production.list_topics({ cluster_id: "lkc-prod" })
app.integrations.confluent.staging.list_topics({ cluster_id: "lkc-staging" })
```
All functions are identical across accounts; only the resolved credentials differ.
