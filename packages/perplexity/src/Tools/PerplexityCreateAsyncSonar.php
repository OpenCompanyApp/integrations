<?php

namespace OpenCompany\Integrations\Perplexity\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Perplexity\PerplexityService;

/**
 * Submit a Perplexity asynchronous Sonar chat request.
 *
 * Useful for long-running models such as deep research where the response is polled later.
 */
class PerplexityCreateAsyncSonar implements Tool
{
    /**
     * @param  PerplexityService  $service  The Perplexity API client.
     */
    public function __construct(
        private PerplexityService $service,
    ) {}

    public function name(): string
    {
        return 'perplexity_create_async_sonar';
    }

    public function description(): string
    {
        return 'Submit an asynchronous Sonar chat completion request and return the request id/status for later polling.';
    }

    public function parameters(): array
    {
        return [
            'messages' => ['type' => 'array', 'description' => 'Array of message objects. Required unless query is provided.'],
            'query' => ['type' => 'string', 'description' => 'Convenience single user query. Used only when messages is omitted.'],
            'model' => ['type' => 'string', 'description' => 'Sonar model to use. Defaults to "sonar-deep-research".'],
            'idempotency_key' => ['type' => 'string', 'description' => 'Optional unique key to prevent duplicate async requests.'],
            'max_tokens' => ['type' => 'integer', 'description' => 'Maximum number of completion tokens.'],
            'temperature' => ['type' => 'number', 'description' => 'Sampling temperature between 0 and 2.'],
            'web_search_options' => ['type' => 'object', 'description' => 'Current Perplexity web search options object.'],
            'reasoning_effort' => ['type' => 'string', 'description' => 'Reasoning effort for supported models: "minimal", "low", "medium", or "high".'],
        ];
    }

    /**
     * Submit an asynchronous Sonar request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Perplexity integration is not configured.');
            }

            $messages = $args['messages'] ?? null;
            if ($messages === null && isset($args['query']) && is_string($args['query']) && $args['query'] !== '') {
                $messages = [['role' => 'user', 'content' => $args['query']]];
            }

            if (! is_array($messages) || $messages === []) {
                return ToolResult::error('messages must be a non-empty array, or query must be a non-empty string.');
            }

            $request = [
                'model' => $args['model'] ?? 'sonar-deep-research',
                'messages' => $messages,
            ];

            foreach (['max_tokens', 'temperature', 'web_search_options', 'reasoning_effort'] as $key) {
                if (array_key_exists($key, $args)) {
                    $request[$key] = $args[$key];
                }
            }

            return ToolResult::success($this->service->createAsyncSonar($request, $args['idempotency_key'] ?? null));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
