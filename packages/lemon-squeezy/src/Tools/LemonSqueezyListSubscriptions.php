<?php

namespace OpenCompany\Integrations\LemonSqueezy\Tools;

use OpenCompany\Integrations\LemonSqueezy\LemonSqueezyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Lemon Squeezy subscriptions.
 *
 * Supports Lemon Squeezy pagination controls.
 */
class LemonSqueezyListSubscriptions implements Tool
{
    /**
     * @param  LemonSqueezyService  $service  The Lemon Squeezy API client
     */
    public function __construct(
        private LemonSqueezyService $service,
    ) {}

    public function name(): string
    {
        return 'lemonsqueezy_list_subscriptions';
    }

    public function description(): string
    {
        return 'List all subscriptions in your Lemon Squeezy store. Returns subscription status, billing cycle, and customer info.';
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of subscriptions per page (default: 10, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    /**
     * List subscriptions from the configured Lemon Squeezy account.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page_size, page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lemon Squeezy integration is not configured.');
            }

            $pageSize = isset($args['page_size']) ? min((int) $args['page_size'], 100) : 10;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listSubscriptions($pageSize, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
