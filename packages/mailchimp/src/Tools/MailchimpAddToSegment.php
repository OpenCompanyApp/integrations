<?php

namespace OpenCompany\Integrations\Mailchimp\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mailchimp\MailchimpService;

/**
 * Add a subscriber to a Mailchimp static segment.
 */
class MailchimpAddToSegment implements Tool
{
    /** @param MailchimpService $service The Mailchimp API client */
    public function __construct(
        private MailchimpService $service,
    ) {}

    public function name(): string
    {
        return 'mailchimp_add_to_segment';
    }

    public function description(): string
    {
        return <<<'MD'
        Add a subscriber to a Mailchimp static segment by email address.
        The segment must be a static (not dynamic) segment.
        Returns the segment membership details.
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
            'segment_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The segment ID to add the subscriber to.',
            ],
            'email' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The subscriber\'s email address.',
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

            $segmentId = $args['segment_id'] ?? '';
            if (empty($segmentId)) {
                return ToolResult::error('The "segment_id" parameter is required.');
            }

            $email = $args['email'] ?? '';
            if (empty($email)) {
                return ToolResult::error('The "email" parameter is required.');
            }

            $result = $this->service->addToSegment($listId, $segmentId, $email);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
