<?php

namespace OpenCompany\Integrations\Mailchimp\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mailchimp\MailchimpService;

/**
 * List all segments for a Mailchimp audience.
 */
class MailchimpListSegments implements Tool
{
    /** @param MailchimpService $service The Mailchimp API client */
    public function __construct(
        private MailchimpService $service,
    ) {}

    public function name(): string
    {
        return 'mailchimp_list_segments';
    }

    public function description(): string
    {
        return <<<'MD'
        List all segments (static and dynamic) for a Mailchimp audience.
        Returns each segment's ID, name, type, and member count.
        MD;
    }

    public function parameters(): array
    {
        return [
            'list_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The audience (list) ID.',
            ],
            'count' => [
                'type' => 'integer',
                'description' => 'Number of segments to return.',
                'default' => 100,
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

            $listId = $args['list_id'] ?? '';
            if (empty($listId)) {
                return ToolResult::error('The "list_id" parameter is required.');
            }

            $result = $this->service->listSegments(
                listId: $listId,
                count: (int) ($args['count'] ?? 100),
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
