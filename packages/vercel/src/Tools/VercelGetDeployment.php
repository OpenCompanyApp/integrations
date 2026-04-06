<?php

namespace OpenCompany\Integrations\Vercel\Tools;

use OpenCompany\Integrations\Vercel\VercelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single deployment by ID.
 *
 * Returns full deployment details including status, URLs, build logs,
 * source information, and metadata.
 * Wraps <code>GET /v13/deployments/{id}</code>.
 */
class VercelGetDeployment implements Tool
{
    public function __construct(
        private VercelService $service,
    ) {}

    public function name(): string
    {
        return 'vercel_get_deployment';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Vercel deployment by its ID, including status, URL, build output, source, and timing.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The deployment ID (e.g., "dpl_xxxxxxxxxxxxxxxxxxxx").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vercel integration is not configured.');
            }

            $result = $this->service->getDeployment($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
