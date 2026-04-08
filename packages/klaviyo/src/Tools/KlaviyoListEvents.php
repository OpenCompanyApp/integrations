<?php

namespace OpenCompany\Integrations\Klaviyo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Klaviyo\KlaviyoService;

/**
 * List Klaviyo events with optional filtering and cursor-based pagination.
 */
class KlaviyoListEvents implements Tool
{
    /** @param KlaviyoService $service The Klaviyo API client */
    public function __construct(
        private KlaviyoService $service,
    ) {}

    public function name(): string
    {
        return 'klaviyo_list_events';
    }

    public function description(): string
    {
        return <<<'MD'
        List events in Klaviyo with optional filtering and cursor-based pagination.
        Supports Klaviyo filter expressions (e.g. "greater-than(timestamp,2024-01-01)")
        to narrow results. Use page_cursor to paginate through large result sets.
        MD;
    }

    public function parameters(): array
    {
        return [
            'filter' => [
                'type' => 'string',
                'description' => 'Klaviyo filter expression (e.g. "greater-than(timestamp,2024-01-01)").',
            ],
            'limit' => [
                'type' => 'integer',
                'description' => 'Number of events to return (default 20, max 100).',
                'default' => 20,
            ],
            'page_cursor' => [
                'type' => 'string',
                'description' => 'Pagination cursor from a previous response to fetch the next page.',
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Klaviyo integration is not configured.');
            }

            $result = $this->service->listEvents(
                filter: $args['filter'] ?? null,
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                pageCursor: $args['page_cursor'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
