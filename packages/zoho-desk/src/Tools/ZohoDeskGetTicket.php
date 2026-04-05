<?php

namespace OpenCompany\Integrations\ZohoDesk\Tools;

use OpenCompany\Integrations\ZohoDesk\ZohoDeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: zohodesk_get_ticket
 *
 * Get a single support ticket from Zoho Desk by its ID.
 */
class ZohoDeskGetTicket implements Tool
{
    /**
     * @param  ZohoDeskService  $service  The Zoho Desk API service instance.
     */
    public function __construct(
        private ZohoDeskService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'zohodesk_get_ticket';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get a single Zoho Desk support ticket by ID with full details including subject, description, status, priority, and contact info.';
    }

    /**
     * The parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'ticketId' => ['type' => 'string', 'required' => true, 'description' => 'The Zoho Desk ticket ID.'],
        ];
    }

    /**
     * Execute the tool — fetch a single ticket from Zoho Desk.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho Desk integration is not configured.');
            }

            if (empty($args['ticketId'])) {
                return ToolResult::error('ticketId is required.');
            }

            $result = $this->service->getTicket($args['ticketId']);

            $ticket = $result['data'] ?? $result;

            return ToolResult::success(is_array($ticket) ? $ticket : [$ticket]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
