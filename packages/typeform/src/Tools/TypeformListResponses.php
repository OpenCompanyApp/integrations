<?php

namespace OpenCompany\Integrations\Typeform\Tools;

use OpenCompany\Integrations\Typeform\TypeformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List responses for a Typeform form.
 *
 * Supports date range filtering, completion status, sorting,
 * search queries, and pagination.
 */
class TypeformListResponses implements Tool
{
    /**
     * @param  TypeformService  $service  The Typeform API client
     */
    public function __construct(
        private TypeformService $service,
    ) {}

    public function name(): string
    {
        return 'typeform_list_responses';
    }

    public function description(): string
    {
        return 'List responses for a Typeform form with filtering by date, completion status, and search.';
    }

    public function parameters(): array
    {
        return [
            'form_id'   => ['type' => 'string', 'required' => true, 'description' => 'The unique ID of the Typeform form.'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of responses per page (default: 25, max: 1000).'],
            'after'     => ['type' => 'string', 'description' => 'Only responses submitted after this date (ISO 8601, e.g., "2024-01-01T00:00:00Z").'],
            'before'    => ['type' => 'string', 'description' => 'Only responses submitted before this date (ISO 8601).'],
            'completed' => ['type' => 'boolean', 'description' => 'Filter by completion status. "true" for completed, "false" for incomplete.'],
            'sort'      => ['type' => 'string', 'description' => 'Sort order for responses. e.g., "submitted_at,desc" or "submitted_at,asc".'],
            'query'     => ['type' => 'string', 'description' => 'Search query to filter responses by answers.'],
        ];
    }

    /**
     * List responses for a form with optional filtering.
     *
     * @param  array<string, mixed>  $args  Tool arguments (form_id, page_size, after, before, completed, sort, query)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Typeform integration is not configured.');
            }

            $formId = $args['form_id'] ?? '';

            if (empty($formId)) {
                return ToolResult::error('form_id is required.');
            }

            $params = [];

            if (isset($args['page_size'])) {
                $params['page_size'] = (int) $args['page_size'];
            }
            if (! empty($args['after'])) {
                $params['after'] = $args['after'];
            }
            if (! empty($args['before'])) {
                $params['before'] = $args['before'];
            }
            if (isset($args['completed'])) {
                $params['completed'] = $args['completed'] ? 'true' : 'false';
            }
            if (! empty($args['sort'])) {
                $params['sort'] = $args['sort'];
            }
            if (! empty($args['query'])) {
                $params['query'] = $args['query'];
            }

            $result = $this->service->listResponses($formId, $params);

            return ToolResult::success([
                'items' => $result['items'] ?? [],
                'total_count' => $result['total_count'] ?? 0,
                'page_count' => $result['page_count'] ?? 0,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
