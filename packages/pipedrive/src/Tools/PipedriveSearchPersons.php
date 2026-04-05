<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search Pipedrive persons by term.
 *
 * Returns matching persons with their details.
 */
class PipedriveSearchPersons implements Tool
{
    /**
     * @param  PipedriveService  $service  The Pipedrive API client
     */
    public function __construct(
        private PipedriveService $service,
    ) {}

    public function name(): string
    {
        return 'pipedrive_search_persons';
    }

    public function description(): string
    {
        return 'Search for persons in Pipedrive by name, email, or other searchable fields.';
    }

    public function parameters(): array
    {
        return [
            'term'  => ['type' => 'string', 'required' => true, 'description' => 'Search term (name, email, etc.).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return (default 10).'],
        ];
    }

    /**
     * Search Pipedrive persons by term.
     *
     * @param  array<string, mixed>  $args  Tool arguments (term, limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pipedrive integration is not configured.');
            }

            $term = $args['term'] ?? '';
            if (empty($term)) {
                return ToolResult::error('term is required.');
            }

            $params = ['term' => $term];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->searchPersons($params);
            $items = $result['data'] ?? $result;

            return ToolResult::success($items);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
