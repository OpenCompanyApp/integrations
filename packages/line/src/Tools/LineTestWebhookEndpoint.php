<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Test LINE webhook endpoint.
 *
 * Sends a test request to the configured or supplied webhook endpoint.
 */
class LineTestWebhookEndpoint implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_test_webhook_endpoint';
    }

    public function description(): string
    {
        return 'Test the LINE webhook endpoint.';
    }

    public function parameters(): array
    {
        return ['endpoint' => ['type' => 'string', 'description' => 'Optional endpoint URL to test.']];
    }

    /**
     * Test webhook endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->testWebhookEndpoint($args['endpoint'] ?? null));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
