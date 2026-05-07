<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

use OpenCompany\Integrations\Chargebee\ChargebeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list subscriptions from Chargebee with optional filtering and pagination.
 *
 * Supports filtering by subscription state and pagination via cursor-based offsets.
 */
class ChargebeeListSubscriptions implements Tool
{
    /**
     * Create a new ChargebeeListSubscriptions tool instance.
     *
     * @param  ChargebeeService  $service  The Chargebee API service.
     */
    public function __construct(
        private ChargebeeService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'chargebee_list_subscriptions';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'List subscriptions from Chargebee. Supports filtering by state (active, cancelled, non_renewing, paused, in_trial, future) and pagination. Returns subscription details including plan, status, and billing period.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of subscriptions to return per page (max 100, default 10).'],
            'page' => ['type' => 'string', 'description' => 'Pagination cursor. Pass the value from a previous response to get the next page.'],
            'state' => ['type' => 'string', 'description' => 'Filter by subscription state: active, cancelled, non_renewing, paused, in_trial, future.'],
        ];
    }

    /**
     * Execute the list subscriptions request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chargebee integration is not configured.');
            }

            $result = $this->service->listSubscriptions(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                page: $args['page'] ?? null,
                state: $args['state'] ?? null,
            );

            $subscriptions = $result['list'] ?? [];
            $nextOffset = $result['next_offset'] ?? null;

            $items = array_map(function (array $entry): array {
                return $entry['subscription'] ?? $entry;
            }, $subscriptions);

            $response = [
                'subscriptions' => $items,
                'count' => count($items),
            ];

            if ($nextOffset !== null) {
                $response['next_page'] = $nextOffset;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
