<?php

namespace OpenCompany\Integrations\Klaviyo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Klaviyo\KlaviyoService;

/**
 * List all Klaviyo lists with cursor-based pagination.
 */
class KlaviyoListLists implements Tool
{
    /** @param KlaviyoService $service The Klaviyo API client */
    public function __construct(
        private KlaviyoService $service,
    ) {}

    public function name(): string
    {
        return 'klaviyo_list_lists';
    }

    public function description(): string
    {
        return <<<'MD'
        List all lists in the connected Klaviyo account.
        Returns each list's ID, name, and other metadata.
        Use cursor-based pagination to iterate through large numbers of lists.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => [
                'type' => 'integer',
                'description' => 'Number of lists to return (default 20, max 100).',
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

            $result = $this->service->listLists(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                pageCursor: $args['page_cursor'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
