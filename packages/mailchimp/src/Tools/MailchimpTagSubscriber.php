<?php

namespace OpenCompany\Integrations\Mailchimp\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mailchimp\MailchimpService;

/**
 * Add or remove tags on a Mailchimp subscriber.
 */
class MailchimpTagSubscriber implements Tool
{
    /** @param MailchimpService $service The Mailchimp API client */
    public function __construct(
        private MailchimpService $service,
    ) {}

    public function name(): string
    {
        return 'mailchimp_tag_subscriber';
    }

    public function description(): string
    {
        return <<<'MD'
        Add or remove tags on a Mailchimp subscriber.
        Provide an array of tags, each with a name and status ("active" to add, "inactive" to remove).
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
            'tags' => [
                'type' => 'array',
                'required' => true,
                'description' => 'Array of tag objects, each with "name" and "status" ("active" or "inactive").',
                'items' => [
                    'type' => 'object',
                    'properties' => [
                        'name' => ['type' => 'string', 'description' => 'Tag name.'],
                        'status' => ['type' => 'string', 'description' => '"active" to add the tag, "inactive" to remove it.', 'enum' => ['active', 'inactive']],
                    ],
                ],
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

            $tags = $args['tags'] ?? [];
            if (empty($tags)) {
                return ToolResult::error('The "tags" parameter is required.');
            }

            $this->service->tagSubscriber($listId, $email, $tags);

            return ToolResult::success([
                'message' => "Tags updated for subscriber {$email} in list {$listId}.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
