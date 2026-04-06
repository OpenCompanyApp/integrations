<?php

namespace OpenCompany\Integrations\Vercel\Tools;

use OpenCompany\Integrations\Vercel\VercelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Vercel projects.
 *
 * Returns project names, IDs, frameworks, and linked repositories.
 * Wraps <code>GET /v9/projects</code>.
 */
class VercelListProjects implements Tool
{
    public function __construct(
        private VercelService $service,
    ) {}

    public function name(): string
    {
        return 'vercel_list_projects';
    }

    public function description(): string
    {
        return 'List all Vercel projects. Returns project names, IDs, framework, linked Git repository, and deployment URLs.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of projects to return (default: 20, max: 100).'],
            'from' => ['type' => 'string', 'description' => 'Pagination cursor — continue from a previous response.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vercel integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = min((int) $args['limit'], 100);
            }

            if (isset($args['from'])) {
                $params['from'] = $args['from'];
            }

            $result = $this->service->listProjects($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
