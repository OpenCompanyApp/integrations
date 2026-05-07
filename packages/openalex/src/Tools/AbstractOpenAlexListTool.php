<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OpenAlex\OpenAlexService;

/**
 * Shared executor for OpenAlex entity list endpoints.
 *
 * Child tools bind a specific entity slug while this class handles common
 * list/search/filter/sort/page/sample/group_by arguments.
 */
abstract class AbstractOpenAlexListTool implements Tool
{
    protected const NAME = '';
    protected const ENTITY = '';
    protected const LABEL = '';

    /**
     * @param  OpenAlexService  $service  OpenAlex API client.
     */
    public function __construct(protected OpenAlexService $service) {}

    public function name(): string
    {
        return static::NAME;
    }

    public function description(): string
    {
        return 'List, search, filter, sort, page, sample, or group OpenAlex '.static::LABEL.'.';
    }

    public function parameters(): array
    {
        return [
            'search' => ['type' => 'string', 'required' => false, 'description' => 'Full-text search query.'],
            'filter' => ['type' => ['string', 'object'], 'required' => false, 'description' => 'OpenAlex filter string, or object converted to field:value comma syntax.'],
            'sort' => ['type' => 'string', 'required' => false, 'description' => 'Sort expression such as cited_by_count:desc or works_count:desc.'],
            'per_page' => ['type' => 'integer', 'required' => false, 'description' => 'Results per page, max 100.'],
            'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number for basic paging.'],
            'cursor' => ['type' => 'string', 'required' => false, 'description' => 'Cursor for deep paging; use * to start.'],
            'sample' => ['type' => 'integer', 'required' => false, 'description' => 'Random sample size.'],
            'seed' => ['type' => 'integer', 'required' => false, 'description' => 'Seed for deterministic sampling.'],
            'select' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields to return. Arrays are sent comma-separated.', 'items' => ['type' => 'string']],
            'group_by' => ['type' => 'string', 'required' => false, 'description' => 'Aggregate by an OpenAlex field.'],
            'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official OpenAlex query parameters. Top-level arguments override duplicate keys.'],
        ];
    }

    /**
     * Execute the OpenAlex entity list endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $query = isset($args['query']) && is_array($args['query']) ? $args['query'] : [];
            unset($args['query']);

            return ToolResult::success($this->service->list(static::ENTITY, array_merge($query, $args)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
