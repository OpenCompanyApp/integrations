<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add tags to a Zendesk ticket (appends to existing tags).
 */
class ZendeskAddTags implements Tool
{
    /**
     * @param  ZendeskService  $service  The Zendesk API client
     */
    public function __construct(
        private ZendeskService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_add_tags';
    }

    public function description(): string
    {
        return 'Add tags to a Zendesk ticket. These tags are appended to the existing tags on the ticket.';
    }

    public function parameters(): array
    {
        return [
            'ticket_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ticket ID to add tags to.'],
            'tags' => ['type' => 'array', 'required' => true, 'description' => 'Array of tag strings to add. Example: ["urgent", "billing"].'],
        ];
    }

    /**
     * Add tags to the specified Zendesk ticket.
     *
     * @param  array<string, mixed>  $args  Tool arguments (ticket_id, tags)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Zendesk is not configured. Missing email, API token, or subdomain.');
        }

        $ticketId = $args['ticket_id'] ?? '';
        $tags = $args['tags'] ?? [];

        if (empty($ticketId)) {
            return ToolResult::error('Ticket ID is required.');
        }

        if (empty($tags) || ! is_array($tags)) {
            return ToolResult::error('Tags array is required.');
        }

        try {
            $result = $this->service->addTags((int) $ticketId, $tags);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
