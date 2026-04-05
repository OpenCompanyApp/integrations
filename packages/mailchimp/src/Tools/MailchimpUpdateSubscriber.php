<?php

namespace OpenCompany\Integrations\Mailchimp\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mailchimp\MailchimpService;

/**
 * Update a subscriber's details in a Mailchimp audience.
 */
class MailchimpUpdateSubscriber implements Tool
{
    /** @param MailchimpService $service The Mailchimp API client */
    public function __construct(
        private MailchimpService $service,
    ) {}

    public function name(): string
    {
        return 'mailchimp_update_subscriber';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing subscriber's merge fields and/or status in a Mailchimp audience.
        Provide the subscriber's email address to identify the record.
        Returns the updated subscriber details.
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
            'email' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The subscriber\'s email address.',
            ],
            'merge_fields' => [
                'type' => 'object',
                'description' => 'Merge field values to update (e.g. {"FNAME": "Jane"}).',
            ],
            'status' => [
                'type' => 'string',
                'description' => 'New subscription status: subscribed, unsubscribed, cleaned, or pending.',
                'enum' => ['subscribed', 'unsubscribed', 'cleaned', 'pending'],
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

            $email = $args['email'] ?? '';
            if (empty($email)) {
                return ToolResult::error('The "email" parameter is required.');
            }

            $result = $this->service->updateSubscriber(
                listId: $listId,
                email: $email,
                mergeFields: $args['merge_fields'] ?? [],
                status: $args['status'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
