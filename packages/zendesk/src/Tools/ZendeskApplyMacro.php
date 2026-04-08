<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Apply a macro to a Zendesk ticket.
 */
class ZendeskApplyMacro implements Tool
{
    /**
     * @param  ZendeskService  $service  The Zendesk API client
     */
    public function __construct(
        private ZendeskService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_apply_macro';
    }

    public function description(): string
    {
        return 'Apply a macro to a Zendesk ticket. The macro actions will be applied to the ticket.';
    }

    public function parameters(): array
    {
        return [
            'ticket_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ticket ID to apply the macro to.'],
            'macro_id' => ['type' => 'integer', 'required' => true, 'description' => 'The macro ID to apply.'],
        ];
    }

    /**
     * Apply a macro to the specified Zendesk ticket.
     *
     * @param  array<string, mixed>  $args  Tool arguments (ticket_id, macro_id)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Zendesk is not configured. Missing email, API token, or subdomain.');
        }

        $ticketId = $args['ticket_id'] ?? '';
        $macroId = $args['macro_id'] ?? '';

        if (empty($ticketId)) {
            return ToolResult::error('Ticket ID is required.');
        }

        if (empty($macroId)) {
            return ToolResult::error('Macro ID is required.');
        }

        try {
            $result = $this->service->applyMacro((int) $ticketId, (int) $macroId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
