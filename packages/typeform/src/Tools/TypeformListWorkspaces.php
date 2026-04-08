<?php

namespace OpenCompany\Integrations\Typeform\Tools;

use OpenCompany\Integrations\Typeform\TypeformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Typeform workspaces.
 *
 * Supports pagination and text search filtering.
 */
class TypeformListWorkspaces implements Tool
{
    /**
     * @param  TypeformService  $service  The Typeform API client
     */
    public function __construct(
        private TypeformService $service,
    ) {}

    public function name(): string
    {
        return 'typeform_list_workspaces';
    }

    public function description(): string
    {
        return 'List Typeform workspaces with optional search.';
    }

    public function parameters(): array
    {
        return [
            'page'      => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of workspaces per page (default: 10, max: 200).'],
            'search'    => ['type' => 'string', 'description' => 'Search term to filter workspaces by name.'],
        ];
    }

    /**
     * List workspaces with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page, page_size, search)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Typeform integration is not configured.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['page_size'])) {
                $params['page_size'] = (int) $args['page_size'];
            }
            if (! empty($args['search'])) {
                $params['search'] = $args['search'];
            }

            $result = $this->service->listWorkspaces($params);

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
