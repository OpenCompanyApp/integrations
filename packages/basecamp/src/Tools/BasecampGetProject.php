<?php

namespace OpenCompany\Integrations\Basecamp\Tools;

use OpenCompany\Integrations\Basecamp\BasecampService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: basecamp_get_project
 *
 * Retrieves details for a single Basecamp project by ID.
 *
 * @see https://github.com/basecamp/api/blob/master/sections/projects.md#get-a-project
 */
class BasecampGetProject implements Tool
{
    /**
     * @param  BasecampService  $service  The Basecamp API service instance.
     */
    public function __construct(
        private BasecampService $service,
    ) {}

    /**
     * Machine name of the tool.
     */
    public function name(): string
    {
        return 'basecamp_get_project';
    }

    /**
     * Human-readable description shown to AI agents.
     */
    public function description(): string
    {
        return 'Get details for a single Basecamp project by ID. Returns the project name, description, members, and metadata.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Basecamp project ID.'],
        ];
    }

    /**
     * Execute the tool — fetch a single project from Basecamp.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Basecamp integration is not configured.');
            }

            $projectId = (int) ($args['project_id'] ?? 0);

            if ($projectId <= 0) {
                return ToolResult::error('A valid project_id is required.');
            }

            $result = $this->service->getProject($projectId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
