<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Zendesk ticket by ID.
 *
 * Returns the full ticket including description, comments, and metadata.
 */
class ZendeskGetTicket implements Tool
{
    /**
     * @param  ZendeskService  $service  The Zendesk API client
     */
    public function __construct(
        private ZendeskService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_get_ticket';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Zendesk ticket by its ID.
        Returns the full ticket including subject, description, status, priority, and metadata.
        MD;
    }

    public function parameters(): array
    {
        return [
            'ticket_id' => ['type' => 'string', 'required' => true, 'description' => 'Zendesk ticket ID.'],
        ];
    }

    /**
     * Retrieve a Zendesk ticket by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (ticket_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zendesk integration is not configured.');
            }

            $id = $args['ticket_id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('ticket_id is required.');
            }

            $result = $this->service->getTicket($id);

            $ticket = $result['ticket'] ?? $result;

            return ToolResult::success($ticket);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
