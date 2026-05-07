<?php

namespace OpenCompany\Integrations\Devin\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Devin\DevinService;

/**
 * Request insight generation for a Devin session.
 *
 * Uses the current v3 session insights generation endpoint.
 */
class DevinGenerateSessionInsights implements Tool
{
    /**
     * @param  DevinService  $service  The Devin API client.
     */
    public function __construct(
        private DevinService $service,
    ) {}

    public function name(): string
    {
        return 'devin_generate_session_insights';
    }

    public function description(): string
    {
        return 'Generate insights for a Devin v3 session.';
    }

    public function parameters(): array
    {
        return [
            'session_id' => ['type' => 'string', 'required' => true, 'description' => 'The Devin session ID.'],
        ];
    }

    /**
     * Generate session insights.
     *
     * @param  array<string, mixed>  $args  Tool arguments (session_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Devin integration is not configured.');
            }

            return ToolResult::success($this->service->generateSessionInsights($args['session_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
