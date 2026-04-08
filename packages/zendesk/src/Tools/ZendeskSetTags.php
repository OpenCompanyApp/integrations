<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Set tags on a Zendesk ticket (replaces all existing tags).
 */
class ZendeskSetTags implements Tool
{
    /**
     * @param  ZendeskService  $service  The Zendesk API client
     */
    public function __construct(
        private ZendeskService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_set_tags';
    }

    public function description(): string
    {
        return 'Set tags on a Zendesk ticket. This replaces all existing tags on the ticket with the provided tags.';
    }

    public function parameters(): array
    {
        return [
            'ticket_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ticket ID to set tags on.'],
            'tags' => ['type' => 'array', 'required' => true, 'description' => 'Array of tag strings to set (replaces all existing). Example: ["urgent", "billing"].'],
        ];
    }

    /**
     * Set tags on the specified Zendesk ticket, replacing all existing tags.
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
            $result = $this->service->setTags((int) $ticketId, $tags);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
