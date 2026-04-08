<?php

namespace OpenCompany\Integrations\Chargify\Tools;

use OpenCompany\Integrations\Chargify\ChargifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List subscriptions from Chargify with optional state filtering and pagination.
 *
 * Returns an array of subscription objects including customer info, product details,
 * current billing period, and subscription state.
 */
class ChargifyListSubscriptions implements Tool
{
    public function __construct(
        private ChargifyService $service,
    ) {}

    public function name(): string
    {
        return 'chargify_list_subscriptions';
    }

    public function description(): string
    {
        return 'List subscriptions from Chargify. Supports filtering by state (active, past_due, canceled, expired, trial, etc.) and pagination.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page, max 200 (default: 20).'],
            'state' => ['type' => 'string', 'description' => 'Filter by subscription state: active, past_due, canceled, expired, trial, on_hold, pending, deferred, etc.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chargify integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 20;
            $state = $args['state'] ?? null;

            $result = $this->service->listSubscriptions($page, $perPage, $state);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
