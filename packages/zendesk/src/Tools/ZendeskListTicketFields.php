<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List custom and system ticket fields in Zendesk.
 */
class ZendeskListTicketFields implements Tool
{
    /**
     * @param  ZendeskService  $service  The Zendesk API client
     */
    public function __construct(
        private ZendeskService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_list_ticket_fields';
    }

    public function description(): string
    {
        return 'List all custom and system ticket fields in Zendesk. Returns field IDs, titles, types, and options.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List all Zendesk ticket fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Zendesk is not configured. Missing email, API token, or subdomain.');
        }

        try {
            $result = $this->service->listTicketFields();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
