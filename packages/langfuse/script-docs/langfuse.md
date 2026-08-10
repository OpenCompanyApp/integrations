# Langfuse

Namespace: `langfuse`

Langfuse is an LLM engineering and observability platform. This integration uses the Langfuse Public API with Basic Auth:

- username: project public key
- password: project secret key

The configured URL can be a Langfuse host such as `https://cloud.langfuse.com` or a full `/api/public` base URL for US, EU, HIPAA, or self-hosted deployments.

## Traces And Observability

Use `langfuse_ingest_batch` to submit tracing events. The `body` object is sent directly to `POST /api/public/ingestion`, so it must match the official Langfuse ingestion schema.

```js
langfuse.ingest_batch({
  body: {
    batch: [
      {
        id: "event-1",
        type: "trace-create",
        timestamp: "2026-01-01T00:00:00.000Z",
        body: {
          id: "trace-1",
          name: "support-agent",
          userId: "user-123",
        }
      }
    ]
  }
})
```
Query stored observability data with:

- `langfuse_list_traces`
- `langfuse_get_trace`
- `langfuse_list_observations`
- `langfuse_get_observation`
- `langfuse_list_sessions`
- `langfuse_get_session`

Delete operations such as `langfuse_delete_trace` are destructive.

## Scores And Metrics

Use `langfuse_create_score` for online evals, user feedback, moderation checks, or session-level quality signals. The body is passed to the official score creation endpoint.

`langfuse_list_scores` and `langfuse_get_score` use the v2 score read endpoints. `langfuse_delete_score` uses the public score delete endpoint.

Use `langfuse_metrics` for the v2 metrics API. The body is sent directly to the official metrics schema.

## Datasets And Prompt Management

Datasets:

- `langfuse_list_datasets`
- `langfuse_create_dataset`
- `langfuse_get_dataset`
- `langfuse_create_dataset_item`
- `langfuse_list_dataset_items`
- `langfuse_get_dataset_item`
- `langfuse_delete_dataset_item`
- `langfuse_create_dataset_run_item`
- `langfuse_list_dataset_run_items`

Prompts:

- `langfuse_list_prompts`
- `langfuse_create_prompt`
- `langfuse_get_prompt`
- `langfuse_delete_prompt`
- `langfuse_update_prompt_version`

For complex create/update operations, pass a `body` object matching the current Langfuse API reference. This avoids stale local field assumptions as Langfuse evolves its schemas.

## Comments And Model Definitions

Comments:

- `langfuse_create_comment`
- `langfuse_list_comments`
- `langfuse_get_comment`

Model definitions:

- `langfuse_list_models`
- `langfuse_create_model`
- `langfuse_get_model`
- `langfuse_delete_model`

## Coverage Notes

This package covers the project-level surfaces agents most often need: health, ingestion, traces, observations, scores, sessions, datasets, dataset items, dataset run items, prompts, comments, metrics, and model definitions.

The Langfuse OpenAPI spec also includes organization administration, SCIM, blob storage exports, annotation queues, LLM connections, media upload URLs, OpenTelemetry export, and unstable evaluator/evaluation-rule endpoints. Those should be added as endpoint-specific tools before calling this integration complete against the full Langfuse API.
