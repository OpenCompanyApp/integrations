<?php

namespace OpenCompany\Integrations\Mailchimp\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mailchimp\MailchimpService;

/**
 * Search for subscribers across Mailchimp audiences.
 */
class MailchimpSearchSubscribers implements Tool
{
    /** @param MailchimpService $service The Mailchimp API client */
    public function __construct(
        private MailchimpService $service,
    ) {}

    public function name(): string
    {
        return 'mailchimp_search_subscribers';
    }

    public function description(): string
    {
        return <<<'MD'
        Search for subscribers by email address or name across all audiences or within a specific list.
        Returns matching subscriber records with their list membership and status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'query' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Search query — email address, name, or other subscriber data.',
            ],
            'list_id' => [
                'type' => 'string',
                'description' => 'Optional audience (list) ID to scope the search.',
            ],
            'count' => [
                'type' => 'integer',
                'description' => 'Number of results to return.',
                'default' => 10,
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mailchimp integration is not configured.');
            }

            $query = $args['query'] ?? '';
            if (empty($query)) {
                return ToolResult::error('The "query" parameter is required.');
            }

            $result = $this->service->searchSubscribers(
                query: $query,
                listId: $args['list_id'] ?? null,
                count: (int) ($args['count'] ?? 10),
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
