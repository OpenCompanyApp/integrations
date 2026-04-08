<?php

namespace OpenCompany\Integrations\Freshdesk\Tools;

use OpenCompany\Integrations\Freshdesk\FreshdeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific helpdesk agent by ID.
 */
class FreshdeskGetAgent implements Tool
{
    public function __construct(
        private FreshdeskService $service,
    ) {}

    public function name(): string
    {
        return 'freshdesk_get_agent';
    }

    public function description(): string
    {
        return 'Get details of a specific helpdesk agent including name, email, role, availability, and group assignments.';
    }

    public function parameters(): array
    {
        return [
            'agent_id' => ['type' => 'integer', 'required' => true, 'description' => 'The agent ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshdesk integration is not configured.');
            }

            $agentId = (int) ($args['agent_id'] ?? 0);
            if ($agentId <= 0) {
                return ToolResult::error('agent_id is required and must be a positive integer.');
            }

            $result = $this->service->getAgent($agentId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
