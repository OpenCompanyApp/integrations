<?php

namespace OpenCompany\Integrations\Freshservice\Tools;

use OpenCompany\Integrations\Freshservice\FreshserviceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshserviceListAgents implements Tool
{
    /**
     * Create a new FreshserviceListAgents tool instance.
     */
    public function __construct(
        private FreshserviceService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'freshservice_list_agents';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List all agents (support staff) in the Freshservice account. Returns agent profiles including name, email, and availability.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'string', 'description' => 'Page cursor for pagination — pass the value from a previous response to get the next page.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshservice integration is not configured.');
            }

            $result = $this->service->listAgents(
                page: $args['page'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
