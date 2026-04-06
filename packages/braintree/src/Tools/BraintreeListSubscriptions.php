<?php

namespace OpenCompany\Integrations\Braintree\Tools;

use OpenCompany\Integrations\Braintree\BraintreeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BraintreeListSubscriptions implements Tool
{
    public function __construct(
        private BraintreeService $service,
    ) {}

    public function name(): string
    {
        return 'braintree_list_subscriptions';
    }

    public function description(): string
    {
        return 'List subscriptions in Braintree. Returns subscription details including plan, status, billing dates, and price.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of subscriptions to return (default: 10, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'status' => ['type' => 'string', 'description' => 'Filter by subscription status: active, past_due, canceled, expired, pending.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Braintree integration is not configured. Missing access token or merchant ID.');
            }

            $limit = isset($args['limit']) ? min((int) $args['limit'], 100) : 10;
            $page = isset($args['page']) ? max((int) $args['page'], 1) : 1;
            $status = $args['status'] ?? null;

            $result = $this->service->listSubscriptions($limit, $page, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
