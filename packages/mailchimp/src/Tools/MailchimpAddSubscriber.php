<?php

namespace OpenCompany\Integrations\Mailchimp\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mailchimp\MailchimpService;

/**
 * Add or update a subscriber in a Mailchimp audience (upsert).
 */
class MailchimpAddSubscriber implements Tool
{
    /** @param MailchimpService $service The Mailchimp API client */
    public function __construct(
        private MailchimpService $service,
    ) {}

    public function name(): string
    {
        return 'mailchimp_add_subscriber';
    }

    public function description(): string
    {
        return <<<'MD'
        Add a new subscriber or update an existing one in a Mailchimp audience.
        Uses a PUT upsert based on the subscriber's email address (MD5 hash).
        Optionally set merge fields and initial tags.
        Returns the subscriber record with their ID and status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'list_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The audience (list) ID to add the subscriber to.',
            ],
            'email' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The subscriber\'s email address.',
            ],
            'status' => [
                'type' => 'string',
                'description' => 'Subscription status: subscribed, unsubscribed, cleaned, or pending.',
                'default' => 'subscribed',
                'enum' => ['subscribed', 'unsubscribed', 'cleaned', 'pending'],
            ],
            'merge_fields' => [
                'type' => 'object',
                'description' => 'Merge field values (e.g. {"FNAME": "John", "LNAME": "Doe"}).',
            ],
            'tags' => [
                'type' => 'array',
                'description' => 'Tag names to apply to the subscriber.',
                'items' => ['type' => 'string'],
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

            $result = $this->service->addSubscriber(
                listId: $listId,
                email: $email,
                status: $args['status'] ?? 'subscribed',
                mergeFields: $args['merge_fields'] ?? [],
                tags: $args['tags'] ?? [],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
