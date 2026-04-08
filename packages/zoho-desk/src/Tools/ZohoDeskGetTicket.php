<?php

namespace OpenCompany\Integrations\ZohoDesk\Tools;

use OpenCompany\Integrations\ZohoDesk\ZohoDeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ZohoDeskGetTicket implements Tool
{
    public function __construct(
        private ZohoDeskService $service,
    ) {}

    public function name(): string
    {
        return 'zohodesk_get_ticket';
    }

    public function description(): string
    {
        return 'Get full details of a specific support ticket by its ID, including subject, description, status, priority, assignee, contact info, and custom fields.';
    }

    public function parameters(): array
    {
        return [
            'ticketId' => ['type' => 'string', 'required' => true, 'description' => 'The ticket ID to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Desk integration is not configured.');
            }

            if (empty($args['ticketId'])) {
                return ToolResult::error('ticketId is required.');
            }

            $result = $this->service->getTicket($args['ticketId']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
