<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Set LINE webhook endpoint.
 *
 * Updates the configured webhook endpoint URL for the channel.
 */
class LineSetWebhookEndpoint implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_set_webhook_endpoint';
    }

    public function description(): string
    {
        return 'Set the LINE channel webhook endpoint URL.';
    }

    public function parameters(): array
    {
        return ['endpoint' => ['type' => 'string', 'required' => true, 'description' => 'HTTPS webhook endpoint URL.']];
    }

    /**
     * Set webhook endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->setWebhookEndpoint((string) ($args['endpoint'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
