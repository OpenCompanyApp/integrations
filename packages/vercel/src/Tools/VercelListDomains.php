<?php

namespace OpenCompany\Integrations\Vercel\Tools;

use OpenCompany\Integrations\Vercel\VercelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List domains for a Vercel project.
 *
 * Returns domain names, verification status, and DNS configuration.
 * Wraps <code>GET /v9/projects/{id}/domains</code>.
 */
class VercelListDomains implements Tool
{
    public function __construct(
        private VercelService $service,
    ) {}

    public function name(): string
    {
        return 'vercel_list_domains';
    }

    public function description(): string
    {
        return 'List all domains configured for a Vercel project, including verification status and DNS records.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project ID or name to list domains for.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vercel integration is not configured.');
            }

            $result = $this->service->listDomains($args['project_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
