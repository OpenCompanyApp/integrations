<?php

namespace OpenCompany\Integrations\Transifex\Tools;

use OpenCompany\Integrations\Transifex\TransifexService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List resources (source files) in a Transifex project.
 */
class TransifexListResources implements Tool
{
    public function __construct(
        private TransifexService $service,
    ) {}

    public function name(): string
    {
        return 'transifex_list_resources';
    }

    public function description(): string
    {
        return 'List all resources (source files) in a Transifex project. Returns resource slugs, names, types, and word/string counts.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project slug or ID (e.g., "my-project-slug").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Transifex integration is not configured.');
            }

            $projectId = $args['project_id'] ?? '';
            if (empty($projectId)) {
                return ToolResult::error('Project ID is required.');
            }

            $result = $this->service->listResources($projectId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
