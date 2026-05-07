# Brave Search

Namespace: `brave-search`

Use this integration for Brave's independent search APIs: web, LLM Context,
images, news, videos, places, local details, autosuggest, spellcheck, rich
callbacks, AI Answers, and legacy Summarizer retrieval.

## Authentication

Configure `api_key`. The integration sends it as the
`X-Subscription-Token` header required by Brave Search.

## Tools

- `brave_search_web`: web search. Use `summary=true` to request a legacy
  summarizer key, or `enable_rich_callback=true` to request a rich callback key.
- `brave_search_web_rich`: fetch rich results using a `callback_key`.
- `brave_search_llm_context`: GET `/llm/context` for LLM-ready grounding data.
- `brave_search_llm_context_post`: POST `/llm/context` for larger payloads.
- `brave_search_images`, `brave_search_news`, `brave_search_videos`: media and
  news search endpoints.
- `brave_search_places`: geographic place and POI search.
- `brave_search_local_pois`, `brave_search_local_descriptions`: fetch details
  for ephemeral POI IDs returned by web or place search.
- `brave_search_suggest`, `brave_search_spellcheck`: query assistance.
- `brave_search_answer`: OpenAI-compatible Brave Answers chat completions.
- `brave_search_summarizer*`: legacy Summarizer endpoints. Brave documents
  Summarizer as deprecated in favor of Answers; use only for existing flows.

## Return Notes

Responses keep Brave's upstream JSON shape. The integration does not rename
fields such as `web.results`, `grounding`, `sources`, `results`, `query`,
`summarizer`, `summary`, or OpenAI-compatible `choices`.

For local-aware web or LLM Context queries, pass location header values as
`loc_lat`, `loc_long`, `loc_city`, `loc_state`, `loc_state_name`,
`loc_country`, or `loc_postal_code`. POI IDs are ephemeral and expire after
about eight hours; do not store them as durable identifiers.

## Examples

```lua
local web = tools.brave_search_web({
  q = "site:github.com laravel queue monitoring",
  count = 10,
  freshness = "pm",
  extra_snippets = true
})

local context = tools.brave_search_llm_context({
  q = "current OpenTelemetry PHP instrumentation best practices",
  maximum_number_of_tokens = 4096,
  context_threshold_mode = "balanced"
})

local places = tools.brave_search_places({
  latitude = 37.7749,
  longitude = -122.4194,
  q = "coffee shops",
  radius = 1000,
  count = 5
})

local answer = tools.brave_search_answer({
  stream = false,
  messages = {
    { role = "user", content = "What changed in Brave Search API this year?" }
  }
})
```
