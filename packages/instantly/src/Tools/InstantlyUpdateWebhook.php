<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a webhook.
 */
class InstantlyUpdateWebhook implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_update_webhook';
    }

    public function description(): string
    {
        return 'Update a webhook.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Webhook ID'],
            'target_hook_url' => ['type' => 'string', 'required' => false, 'description' => 'Target URL'],
            'event_type' => ['type' => 'string', 'required' => false, 'description' => 'Event type'],
            'campaign' => ['type' => 'string', 'required' => false, 'description' => 'Campaign ID'],
            'name' => ['type' => 'string', 'required' => false, 'description' => 'Webhook name'],
            'custom_interest_value' => ['type' => 'integer', 'required' => false, 'description' => 'Custom interest value'],
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

            $body = []; foreach (['target_hook_url','event_type','campaign','name','custom_interest_value'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; $result = $this->service->updateWebhook($args['id'], $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
