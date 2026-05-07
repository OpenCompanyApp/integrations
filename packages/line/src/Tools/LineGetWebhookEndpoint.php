<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Get LINE webhook endpoint settings.
 *
 * Returns the current webhook endpoint URL and active status.
 */
class LineGetWebhookEndpoint implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_get_webhook_endpoint';
    }

    public function description(): string
    {
        return 'Get LINE channel webhook endpoint information.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get webhook endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->getWebhookEndpoint());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
