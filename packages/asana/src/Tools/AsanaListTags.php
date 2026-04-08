<?php

namespace OpenCompany\Integrations\Asana\Tools;

use OpenCompany\Integrations\Asana\AsanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List tags in an Asana workspace.
 */
class AsanaListTags implements Tool
{
    /**
     * @param  AsanaService  $service  The Asana API client
     */
    public function __construct(
        private AsanaService $service,
    ) {}

    public function name(): string
    {
        return 'asana_list_tags';
    }

    public function description(): string
    {
        return 'List tags in an Asana workspace.';
    }

    public function parameters(): array
    {
        return [
            'workspace' => ['type' => 'string',  'required' => true,  'description' => 'Workspace GID to filter tags by.'],
            'limit'     => ['type' => 'integer', 'description' => 'Max number of tags to return (1–100).'],
            'offset'    => ['type' => 'string',  'description' => 'Cursor for pagination from a previous response.'],
        ];
    }

    /**
     * Retrieve a list of tags in the specified workspace.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workspace, limit, offset)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Asana integration is not configured.');
            }

            $workspace = $args['workspace'] ?? '';

            if (empty($workspace)) {
                return ToolResult::error('workspace is required.');
            }

            $params = ['workspace' => $workspace];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = $args['offset'];
            }

            $tags = $this->service->listTags($params);

            return ToolResult::success($tags);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
