<?php

namespace OpenCompany\Integrations\Mailchimp\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mailchimp\MailchimpService;

/**
 * Create a new Mailchimp campaign.
 */
class MailchimpCreateCampaign implements Tool
{
    /** @param MailchimpService $service The Mailchimp API client */
    public function __construct(
        private MailchimpService $service,
    ) {}

    public function name(): string
    {
        return 'mailchimp_create_campaign';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new campaign in Mailchimp.
        Requires a campaign type and the target list_id. Optional settings include subject line,
        title, from name, and reply-to address.
        Returns the newly created campaign with its ID and web_id.
        MD;
    }

    public function parameters(): array
    {
        return [
            'type' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Campaign type: regular, plaintext, absplit, rss, or variate.',
                'default' => 'regular',
                'enum' => ['regular', 'plaintext', 'absplit', 'rss', 'variate'],
            ],
            'list_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The audience (list) ID to send the campaign to.',
            ],
            'settings_subject' => [
                'type' => 'string',
                'description' => 'The email subject line.',
            ],
            'settings_title' => [
                'type' => 'string',
                'description' => 'Internal campaign title (visible in Mailchimp dashboard only).',
            ],
            'settings_from_name' => [
                'type' => 'string',
                'description' => 'The "from" name for the email.',
            ],
            'settings_reply_to' => [
                'type' => 'string',
                'description' => 'The reply-to email address.',
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

            $payload = [
                'type' => $args['type'] ?? 'regular',
                'recipients' => [
                    'list_id' => $listId,
                ],
            ];

            $settings = [];
            if (! empty($args['settings_subject'])) {
                $settings['subject_line'] = $args['settings_subject'];
            }
            if (! empty($args['settings_title'])) {
                $settings['title'] = $args['settings_title'];
            }
            if (! empty($args['settings_from_name'])) {
                $settings['from_name'] = $args['settings_from_name'];
            }
            if (! empty($args['settings_reply_to'])) {
                $settings['reply_to'] = $args['settings_reply_to'];
            }
            if (! empty($settings)) {
                $payload['settings'] = $settings;
            }

            $result = $this->service->createCampaign($payload);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
