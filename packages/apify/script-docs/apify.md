# Apify Integration

Apify provides web scraping, browser automation, actor execution, and storage APIs. This package exposes generated tools from the official Apify OpenAPI document at `https://docs.apify.com/api/openapi.json`.

## Configuration

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `api_token` | secret | Yes | Apify API token sent as a Bearer token. |
| `url` | url | No | API base URL. Default is `https://api.apify.com`. Existing `https://api.apify.com/v2` values are also supported. |

## Usage Pattern

Tool names are generated from official Apify operation IDs:

- `apify_acts_get`
- `apify_act_runs_post`
- `apify_actor_task_runs_post`
- `apify_dataset_items_get`
- `apify_key_value_store_record_get`
- `apify_webhook_dispatches_get`

Path and query parameters are exposed as snake_case tool arguments. JSON request payloads are passed through `body` with Apify's official field names.

```js
apify_act_runs_post({
  actor_id: "apify/web-scraper",
  query: {
    waitForFinish: 60,
  },
  body: {
    startUrls: [
      { url: "https://example.test" }
    ]
  }
})
```
```js
apify_actor_run_get({
  run_id: "run_123",
})
```
```js
apify_dataset_items_get({
  dataset_id: "dataset_123",
  clean: true,
  format: "json",
  limit: 100,
})
```
```js
apify_key_value_store_record_get({
  store_id: "store_123",
  record_key: "OUTPUT",
})
```
Additional documented query parameters can be passed exactly as named through `query`.

```js
apify_acts_get({
  query: {
    offset: 0,
    limit: 20,
    my: true,
  }
})
```
## Return Shape

JSON responses are returned as parsed Apify response objects. Non-JSON responses, such as logs or exported dataset formats, are returned as:

```js
const example = {
  body: "...",
  content_type: "text/plain",
}
```
`204 No Content` responses return an empty object. Errors are normalized into tool errors that include the Apify HTTP status and message when available.

## Notes

- This package covers the official Apify API v2 OpenAPI operations: actors, builds, runs, actor tasks, default run storages, datasets, key-value stores, request queues, request locks, logs, schedules, tools, users, webhooks, and webhook dispatches.
- Actor-specific OpenAPI definitions are available through Apify's actor/build OpenAPI endpoints; those describe individual actors and are separate from this platform API package.
- Use fake actor IDs, run IDs, dataset IDs, store IDs, URLs, and tokens in tests and examples.
