<?php

namespace OpenCompany\Integrations\Freshservice\Tools;

use OpenCompany\Integrations\Freshservice\FreshserviceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshserviceGetTicket implements Tool
{
    /**
     * Create a new FreshserviceGetTicket tool instance.
     */
    public function __construct(
        private FreshserviceService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'freshservice_get_ticket';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get full details of a specific Freshservice ticket by its ID, including description, status, priority, requester, assigned agent, and custom fields.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'ticket_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ticket display ID.'],
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

            $result = $this->service->getTicket((int) $args['ticket_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
