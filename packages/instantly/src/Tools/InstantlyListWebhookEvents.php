<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List webhook events.
 */
class InstantlyListWebhookEvents implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_list_webhook_events';
    }

    public function description(): string
    {
        return 'List webhook events.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Items per page (1-100)'],
            'starting_after' => ['type' => 'string', 'required' => false, 'description' => 'Pagination cursor'],
            'success' => ['type' => 'boolean', 'required' => false, 'description' => 'Filter by success'],
            'from' => ['type' => 'string', 'required' => false, 'description' => 'Start date (YYYY-MM-DD)'],
            'to' => ['type' => 'string', 'required' => false, 'description' => 'End date (YYYY-MM-DD)'],
            'search' => ['type' => 'string', 'required' => false, 'description' => 'Search by URL or email'],
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

            $params = []; foreach (['limit','starting_after','success','from','to','search'] as $k) if (isset($args[$k])) $params[$k] = $args[$k]; $result = $this->service->listWebhookEvents($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
