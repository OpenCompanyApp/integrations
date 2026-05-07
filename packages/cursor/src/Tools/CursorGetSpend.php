<?php

namespace OpenCompany\Integrations\Cursor\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Cursor\CursorService;

/**
 * Get Cursor team spending data for the current calendar month.
 */
class CursorGetSpend implements Tool
{
    /**
     * @param  CursorService  $service  The Cursor Admin API client.
     */
    public function __construct(private CursorService $service) {}

    public function name(): string
    {
        return 'cursor_get_spend';
    }

    public function description(): string
    {
        return 'Get Cursor team spending data with optional search, sorting, and pagination.';
    }

    public function parameters(): array
    {
        return [
            'search_term' => ['type' => 'string', 'description' => 'Search user names and emails.'],
            'sort_by' => ['type' => 'string', 'description' => 'Sort by amount, date, or user.'],
            'sort_direction' => ['type' => 'string', 'description' => 'Sort direction: asc or desc.'],
            'page' => ['type' => 'integer', 'description' => 'Page number, 1-indexed.'],
            'page_size' => ['type' => 'integer', 'description' => 'Results per page.'],
        ];
    }

    /**
     * Execute the tool and return spend data.
     *
     * @param  array<string, mixed>  $args  Tool arguments (search_term, sort_by, sort_direction, page, page_size).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Cursor integration is not configured.');
            }

            $params = $this->mapParams($args);

            return ToolResult::success($this->service->getSpend($params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * @param  array<string, mixed>  $args
     * @return array<string, mixed>
     */
    private function mapParams(array $args): array
    {
        $mapping = [
            'search_term' => 'searchTerm',
            'sort_by' => 'sortBy',
            'sort_direction' => 'sortDirection',
            'page' => 'page',
            'page_size' => 'pageSize',
        ];

        $params = [];
        foreach ($mapping as $arg => $api) {
            if (isset($args[$arg])) {
                $params[$api] = in_array($arg, ['page', 'page_size'], true) ? (int) $args[$arg] : $args[$arg];
            }
        }

        return $params;
    }
}
