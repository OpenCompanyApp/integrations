<?php

namespace OpenCompany\Integrations\Perplexity\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Perplexity\PerplexityService;

/**
 * Retrieve one asynchronous Perplexity Sonar chat request.
 */
class PerplexityGetAsyncSonar implements Tool
{
    /**
     * @param  PerplexityService  $service  The Perplexity API client.
     */
    public function __construct(
        private PerplexityService $service,
    ) {}

    public function name(): string
    {
        return 'perplexity_get_async_sonar';
    }

    public function description(): string
    {
        return 'Retrieve status and response data for a Perplexity asynchronous Sonar request.';
    }

    public function parameters(): array
    {
        return [
            'request_id' => ['type' => 'string', 'required' => true, 'description' => 'Async Sonar request id returned by create_async_sonar.'],
        ];
    }

    /**
     * Retrieve an asynchronous Sonar request by id.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Perplexity integration is not configured.');
            }

            $requestId = $args['request_id'] ?? null;
            if (! is_string($requestId) || $requestId === '') {
                return ToolResult::error('request_id must be a non-empty string.');
            }

            return ToolResult::success($this->service->getAsyncSonar($requestId));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
