<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new webhook subscription.
 */
class InstantlyCreateWebhook implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_create_webhook';
    }

    public function description(): string
    {
        return 'Create a new webhook subscription.';
    }

    public function parameters(): array
    {
        return [
            'target_hook_url' => ['type' => 'string', 'required' => true, 'description' => 'Target URL'],
            'event_type' => ['type' => 'string', 'required' => false, 'description' => 'Event type (e.g. lead_interested)'],
            'campaign' => ['type' => 'string', 'required' => false, 'description' => 'Campaign ID filter'],
            'name' => ['type' => 'string', 'required' => false, 'description' => 'Webhook name'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $body = ['target_hook_url' => $args['target_hook_url']]; foreach (['event_type','campaign','name'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; $result = $this->service->createWebhook($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
