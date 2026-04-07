<?php

namespace OpenCompany\Integrations\Teamwork\Tools;

use OpenCompany\Integrations\Teamwork\TeamworkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a Teamwork project.
 */
class TeamworkGetProject implements Tool
{
    /**
     * @param  TeamworkService  $service  The Teamwork API client
     */
    public function __construct(
        private TeamworkService $service,
    ) {}

    public function name(): string
    {
        return 'teamwork_get_project';
    }

    public function description(): string
    {
        return 'Get detailed information about a Teamwork project.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The project ID.'],
        ];
    }

    /**
     * Retrieve a project by its ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Teamwork integration is not configured.');
            }

            $id = $args['id'] ?? '';

            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $project = $this->service->getProject((int) $id);

            return ToolResult::success($project);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
