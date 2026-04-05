<?php

namespace OpenCompany\Integrations\Figma\Tools;

use OpenCompany\Integrations\Figma\FigmaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List files in a Figma project.
 *
 * Returns all files in the specified project, with optional
 * branch data inclusion.
 */
class FigmaGetProjectFiles implements Tool
{
    /**
     * @param  FigmaService  $service  The Figma API client
     */
    public function __construct(
        private FigmaService $service,
    ) {}

    public function name(): string
    {
        return 'figma_get_project_files';
    }

    public function description(): string
    {
        return 'List all files in a Figma project.';
    }

    public function parameters(): array
    {
        return [
            'project_id'   => ['type' => 'string', 'required' => true, 'description' => 'The Figma project ID.'],
            'branch_data'  => ['type' => 'boolean', 'description' => 'If true, include branch metadata for each file.'],
        ];
    }

    /**
     * List files in a Figma project.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, branch_data)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Figma integration is not configured.');
            }

            $projectId = $args['project_id'] ?? '';

            if (empty($projectId)) {
                return ToolResult::error('project_id is required.');
            }

            $params = [];

            if (isset($args['branch_data'])) {
                $params['branch_data'] = (bool) $args['branch_data'];
            }

            $result = $this->service->getProjectFiles($projectId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
