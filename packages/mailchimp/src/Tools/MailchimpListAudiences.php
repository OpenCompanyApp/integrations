<?php

namespace OpenCompany\Integrations\Mailchimp\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mailchimp\MailchimpService;

/**
 * List all Mailchimp audiences with offset-based pagination.
 */
class MailchimpListAudiences implements Tool
{
    /** @param MailchimpService $service The Mailchimp API client */
    public function __construct(
        private MailchimpService $service,
    ) {}

    public function name(): string
    {
        return 'mailchimp_list_audiences';
    }

    public function description(): string
    {
        return <<<'MD'
        List all audiences (lists) in the connected Mailchimp account.
        Returns each audience's ID, name, subscriber count, and other metadata.
        Supports offset-based pagination via the count and offset parameters.
        MD;
    }

    public function parameters(): array
    {
        return [
            'count' => [
                'type' => 'integer',
                'description' => 'Number of audiences to return (max 1000).',
                'default' => 100,
            ],
            'offset' => [
                'type' => 'integer',
                'description' => 'Number of audiences to skip for pagination.',
                'default' => 0,
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

            $result = $this->service->listAudiences(
                count: (int) ($args['count'] ?? 100),
                offset: (int) ($args['offset'] ?? 0),
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
