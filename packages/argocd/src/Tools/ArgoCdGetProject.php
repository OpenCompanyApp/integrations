<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

use OpenCompany\Integrations\ArgoCd\ArgoCdService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Argo CD project.
 */
class ArgoCdGetProject implements Tool
{
    /** @param  ArgoCdService  $service  The Argo CD API client */
    public function __construct(
        private ArgoCdService $service,
    ) {}

    public function name(): string
    {
        return 'argocd_get_project';
    }

    public function description(): string
    {
        return 'Get details for a specific Argo CD project, including source/destination rules and cluster configurations.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Argo CD project.'],
        ];
    }

    /**
     * Get an Argo CD project by name.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Argo CD is not configured. Missing Bearer token.');
        }

        $name = $args['name'] ?? '';

        if (empty($name)) {
            return ToolResult::error('Project name is required.');
        }

        try {
            $result = $this->service->getProject($name);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
