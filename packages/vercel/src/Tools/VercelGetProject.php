<?php

namespace OpenCompany\Integrations\Vercel\Tools;

use OpenCompany\Integrations\Vercel\VercelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Vercel project.
 *
 * Returns project configuration, framework, environment variables,
 * linked repository, deployment URLs, and more.
 * Wraps <code>GET /v9/projects/{id}</code>.
 */
class VercelGetProject implements Tool
{
    public function __construct(
        private VercelService $service,
    ) {}

    public function name(): string
    {
        return 'vercel_get_project';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Vercel project, including its framework, environment variables, linked Git repository, and deployment configuration.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The project ID or name.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vercel integration is not configured.');
            }

            $result = $this->service->getProject($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
