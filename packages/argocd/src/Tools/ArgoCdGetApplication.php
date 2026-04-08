<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

use OpenCompany\Integrations\ArgoCd\ArgoCdService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Argo CD application.
 */
class ArgoCdGetApplication implements Tool
{
    /** @param  ArgoCdService  $service  The Argo CD API client */
    public function __construct(
        private ArgoCdService $service,
    ) {}

    public function name(): string
    {
        return 'argocd_get_application';
    }

    public function description(): string
    {
        return 'Get details for a specific Argo CD application, including sync status, health, source, and destination.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Argo CD application.'],
            'project' => ['type' => 'string', 'description' => 'The project the application belongs to (optional, used for disambiguation).'],
            'refresh' => ['type' => 'string', 'description' => 'Force a refresh of the application state. Set to "true" or "hard" to refresh before returning.'],
        ];
    }

    /**
     * Get an Argo CD application by name.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, project, refresh)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Argo CD is not configured. Missing Bearer token.');
        }

        $name = $args['name'] ?? '';

        if (empty($name)) {
            return ToolResult::error('Application name is required.');
        }

        try {
            $params = [];

            if (! empty($args['project'])) {
                $params['project'] = $args['project'];
            }

            if (! empty($args['refresh'])) {
                $params['refresh'] = $args['refresh'];
            }

            $result = $this->service->getApplication($name, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
