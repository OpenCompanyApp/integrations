<?php

namespace OpenCompany\Integrations\Smartsheet\Tools;

use OpenCompany\Integrations\Smartsheet\SmartsheetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search across Smartsheet sheets, reports, and templates.
 */
class SmartsheetSearch implements Tool
{
    /**
     * Create a new SmartsheetSearch tool instance.
     *
     * @param SmartsheetService $service The Smartsheet API client.
     */
    public function __construct(private SmartsheetService $service) {}

    /**
     * Get the tool name identifier.
     *
     * @return string The tool name.
     */
    public function name(): string
    {
        return 'smartsheet_search';
    }

    /**
     * Get the human-readable tool description.
     *
     * @return string The tool description.
     */
    public function description(): string
    {
        return 'Search across Smartsheet sheets, reports, and templates for matching content.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'query' => [
                'type' => 'string',
                'description' => 'The search query string.',
                'required' => true,
            ],
            'location' => [
                'type' => 'string',
                'description' => 'Optional location scope for the search (e.g., "sheet", "workspace").',
                'required' => false,
            ],
            'limit' => [
                'type' => 'integer',
                'description' => 'Maximum number of search results to return (default 100).',
                'required' => false,
            ],
        ];
    }

    /**
     * Execute the search tool.
     *
     * @param array<string, mixed> $args Tool arguments containing 'query' and optional 'location' and 'limit'.
     * @return ToolResult The result containing the search results or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Smartsheet integration is not configured.');
            }

            $query = $args['query'] ?? '';
            if (empty($query)) {
                return ToolResult::error('query is required.');
            }

            $location = $args['location'] ?? null;
            $limit = (int) ($args['limit'] ?? 100);

            $result = $this->service->search($query, $location, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
