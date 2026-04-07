<?php

namespace OpenCompany\Integrations\Transifex\Tools;

use OpenCompany\Integrations\Transifex\TransifexService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific Transifex resource.
 */
class TransifexGetResource implements Tool
{
    public function __construct(
        private TransifexService $service,
    ) {}

    public function name(): string
    {
        return 'transifex_get_resource';
    }

    public function description(): string
    {
        return 'Get details of a specific Transifex resource including its name, type, word count, string count, and translation progress.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project slug or ID (e.g., "my-project-slug").'],
            'resource_id' => ['type' => 'string', 'required' => true, 'description' => 'The resource slug or ID (e.g., "my-resource-slug").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Transifex integration is not configured.');
            }

            $projectId = $args['project_id'] ?? '';
            $resourceId = $args['resource_id'] ?? '';

            if (empty($projectId)) {
                return ToolResult::error('Project ID is required.');
            }
            if (empty($resourceId)) {
                return ToolResult::error('Resource ID is required.');
            }

            $result = $this->service->getResource($projectId, $resourceId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
