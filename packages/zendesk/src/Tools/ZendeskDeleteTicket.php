<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Zendesk ticket.
 */
class ZendeskDeleteTicket implements Tool
{
    /**
     * @param  ZendeskService  $service  The Zendesk API client
     */
    public function __construct(
        private ZendeskService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_delete_ticket';
    }

    public function description(): string
    {
        return 'Delete a Zendesk ticket by its ID. This action is irreversible.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The ticket ID to delete.'],
        ];
    }

    /**
     * Delete the specified Zendesk ticket.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Zendesk is not configured. Missing email, API token, or subdomain.');
        }

        $id = $args['id'] ?? '';

        if (empty($id)) {
            return ToolResult::error('Ticket ID is required.');
        }

        try {
            $result = $this->service->deleteTicket((int) $id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
