<?php

namespace OpenCompany\Integrations\Asana\Tools;

use OpenCompany\Integrations\Asana\AsanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List users in an Asana workspace.
 */
class AsanaListUsers implements Tool
{
    /**
     * @param  AsanaService  $service  The Asana API client
     */
    public function __construct(
        private AsanaService $service,
    ) {}

    public function name(): string
    {
        return 'asana_list_users';
    }

    public function description(): string
    {
        return 'List users in an Asana workspace.';
    }

    public function parameters(): array
    {
        return [
            'workspace' => ['type' => 'string',  'required' => true,  'description' => 'Workspace GID to filter users by.'],
            'limit'     => ['type' => 'integer', 'description' => 'Max number of users to return (1–100).'],
            'offset'    => ['type' => 'string',  'description' => 'Cursor for pagination from a previous response.'],
        ];
    }

    /**
     * Retrieve a list of users in the specified workspace.
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

            $users = $this->service->listUsers($params);

            return ToolResult::success($users);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
