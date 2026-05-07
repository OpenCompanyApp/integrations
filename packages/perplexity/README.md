# Integration: Perplexity

Perplexity integration for OpenCompany agents: Sonar chat, one-shot answers, web search, async research, Agent API responses, embeddings, contextualized embeddings, and Agent API model discovery.

## Configuration

This integration requires a Perplexity API key.

```php
return [
    'perplexity' => [
        'api_key' => env('PERPLEXITY_API_KEY'),
        'url' => env('PERPLEXITY_URL', 'https://api.perplexity.ai'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `perplexity_chat` | read | Create a Sonar chat completion with citations and search metadata |
| `perplexity_ask` | read | Ask a one-shot question through Sonar chat |
| `perplexity_search` | read | Search the web and retrieve relevant page contents |
| `perplexity_create_async_sonar` | read | Submit a long-running asynchronous Sonar request |
| `perplexity_list_async_sonar` | read | List asynchronous Sonar requests |
| `perplexity_get_async_sonar` | read | Retrieve one asynchronous Sonar request by id |
| `perplexity_agent` | read | Create a Perplexity Agent API response |
| `perplexity_embeddings` | read | Create embeddings for one or more texts |
| `perplexity_contextualized_embeddings` | read | Create contextualized embeddings for grouped document chunks |
| `perplexity_list_models` | read | List Agent API models |

## Service Usage

```php
use OpenCompany\Integrations\Perplexity\PerplexityService;

$service = app(PerplexityService::class);

$chat = $service->chat([
    ['role' => 'user', 'content' => 'What is the Perplexity Sonar API?'],
], 'sonar');

$answer = $service->ask('What changed in the current Sonar API?');

$results = $service->search([
    'query' => 'Perplexity embeddings API',
    'max_results' => 5,
]);

$async = $service->createAsyncSonar([
    'model' => 'sonar-deep-research',
    'messages' => [
        ['role' => 'user', 'content' => 'Research search-grounded LLM APIs.'],
    ],
]);

$models = $service->listModels();
```

## Endpoint Notes

This package maps to the current documented Perplexity paths:

- `POST /v1/sonar`
- `POST /search`
- `POST /v1/async/sonar`
- `GET /v1/async/sonar`
- `GET /v1/async/sonar/{id}`
- `POST /v1/agent`
- `POST /v1/embeddings`
- `POST /v1/contextualizedembeddings`
- `GET /v1/models`

`perplexity_ask` is a compatibility convenience tool built on `POST /v1/sonar`; there is no separate upstream `/ask` tool endpoint.
