<?php

namespace OpenCompany\Integrations\Freshservice\Tools;

use OpenCompany\Integrations\Freshservice\FreshserviceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshserviceDeleteTicket implements Tool
{
    /**
     * Create a new FreshserviceDeleteTicket tool instance.
     */
    public function __construct(
        private FreshserviceService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'freshservice_delete_ticket';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Delete a support ticket from Freshservice. This action permanently removes the ticket and its conversations.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'ticket_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ticket display ID to delete.'],
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

            $this->service->deleteTicket((int) $args['ticket_id']);

            return ToolResult::success("Ticket {$args['ticket_id']} has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
