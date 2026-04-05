<?php

namespace OpenCompany\Integrations\Freshdesk\Tools;

use OpenCompany\Integrations\Freshdesk\FreshdeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all helpdesk agents from Freshdesk.
 */
class FreshdeskListAgents implements Tool
{
    public function __construct(
        private FreshdeskService $service,
    ) {}

    public function name(): string
    {
        return 'freshdesk_list_agents';
    }

    public function description(): string
    {
        return 'List all helpdesk agents. Returns agent details including name, email, availability, and group memberships.';
    }

    public function parameters(): array
    {
        return [
            'page'     => ['type' => 'integer', 'description' => 'Page number (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Results per page (max: 100, default: 30).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshdesk integration is not configured.');
            }

            $params = array_filter([
                'page'     => $args['page'] ?? null,
                'per_page' => $args['per_page'] ?? null,
            ], fn ($v) => $v !== null);

            $result = $this->service->listAgents($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
