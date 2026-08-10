# Helicone

Namespace: `helicone`

Helicone provides LLM observability, request analytics, user feedback, user metrics, and an OpenAI-compatible AI Gateway. This integration uses `Authorization: Bearer <HELICONE_API_KEY>`.

## Request Analytics

Use `helicone_query_requests` to query the request table with the ClickHouse-optimized endpoint.

```js
var rows = helicone.query_requests({
  body: {
    filter: {},
    limit: 10,
    offset: 0,
    sort: { created_at: "desc" },
  }
})
```
Use `helicone_query_requests_by_ids` when you already know request IDs, and `helicone_get_request` for one request.

## Feedback And Users

Submit feedback with:

```js
helicone.submit_feedback({
  request_id: "request-uuid",
  body: { rating: true },
})
```
Use `helicone_query_user_metrics` and `helicone_query_user_metrics_overview` for user analytics. Their `body` objects are passed directly to Helicone's official query schemas.

## AI Gateway

`helicone_list_gateway_models` calls `GET /v1/models` on the AI Gateway.

`helicone_gateway_chat_completions` and `helicone_gateway_responses` forward OpenAI-compatible request bodies through Helicone's AI Gateway:

```js
var response = helicone.gateway_chat_completions({
  body: {
    model: "openai/gpt-4o-mini",
    messages: [
      { role: "user", content: "Summarize this trace." }
    ]
  }
})
```
## Coverage Notes

This package covers documented request query/lookup, request feedback, user metrics, gateway model listing, chat completions, and responses. Helicone also documents prompts, datasets, webhooks, experiments, security, caching, and provider-routing behavior; those should be added as endpoint-specific tools before calling this integration complete against the full Helicone platform.
