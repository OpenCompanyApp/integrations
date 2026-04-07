<?php

namespace OpenCompany\Integrations\Render2\Tools;

use OpenCompany\Integrations\Render2\RenderService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RenderCreateService implements Tool
{
    public function __construct(
        private RenderService $service,
    ) {}

    public function name(): string
    {
        return 'render_create_service';
    }

    public function description(): string
    {
        return 'Create a new service on Render. Supports web services, background workers, cron jobs, and private services.';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Service type: "web_service", "background_worker", "cron_job", or "private_service".'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name for the service.'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The Git repository URL (e.g., "https://github.com/user/repo").'],
            'branch' => ['type' => 'string', 'description' => 'The Git branch to deploy (default: "main").'],
            'region' => ['type' => 'string', 'description' => 'Region slug (e.g., "oregon", "ohio", "frankfurt", "singapore").'],
            'plan' => ['type' => 'string', 'description' => 'Plan type: "starter", "standard", "pro", "pro_plus" (default: "starter").'],
            'runtime' => ['type' => 'string', 'description' => 'Runtime for the service (e.g., "node", "python", "ruby", "docker").'],
            'build_command' => ['type' => 'string', 'description' => 'Shell command to build the service.'],
            'start_command' => ['type' => 'string', 'description' => 'Shell command to start the service.'],
            'env_vars' => ['type' => 'object', 'description' => 'Environment variables as key-value pairs.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Render integration is not configured.');
            }

            $params = [
                'type' => $args['type'],
                'name' => $args['name'],
                'repo' => $args['repo'],
            ];

            // Optional parameters
            foreach (['branch', 'region', 'plan', 'runtime', 'build_command', 'start_command', 'env_vars'] as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->createService($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
