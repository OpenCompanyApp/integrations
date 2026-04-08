<?php

namespace OpenCompany\Integrations\Asana\Tools;

use OpenCompany\Integrations\Asana\AsanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List sections in an Asana project.
 */
class AsanaListSections implements Tool
{
    /**
     * @param  AsanaService  $service  The Asana API client
     */
    public function __construct(
        private AsanaService $service,
    ) {}

    public function name(): string
    {
        return 'asana_list_sections';
    }

    public function description(): string
    {
        return 'List sections in an Asana project.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string',  'required' => true,  'description' => 'GID of the project to list sections for.'],
            'limit'      => ['type' => 'integer', 'description' => 'Max number of sections to return (1–100).'],
            'offset'     => ['type' => 'string',  'description' => 'Cursor for pagination from a previous response.'],
        ];
    }

    /**
     * Retrieve sections for the specified project.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, limit, offset)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Asana integration is not configured.');
            }

            $projectId = $args['project_id'] ?? '';

            if (empty($projectId)) {
                return ToolResult::error('project_id is required.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = $args['offset'];
            }

            $sections = $this->service->listSections($projectId, $params);

            return ToolResult::success($sections);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
