<?php

namespace OpenCompany\Integrations\Sendgrid\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Sendgrid\SendgridService;

/**
 * Search SendGrid marketing contacts with a query string.
 */
class SendGridSearchContacts implements Tool
{
    /** @param SendgridService $service The SendGrid API client */
    public function __construct(
        private SendgridService $service,
    ) {}

    public function name(): string
    {
        return 'sendgrid_search_contacts';
    }

    public function description(): string
    {
        return <<<'MD'
        Search SendGrid marketing contacts using a query string.
        Example queries: "email LIKE '%@example.com'" or "first_name = 'John'".
        Returns matching contact records.
        MD;
    }

    public function parameters(): array
    {
        return [
            'query' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Search query expression (e.g., "email LIKE \'%@example.com\'").',
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('SendGrid integration is not configured.');
            }

            $query = $args['query'] ?? '';
            if (empty($query)) {
                return ToolResult::error('The "query" parameter is required.');
            }

            $result = $this->service->searchContacts(query: $query);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
