<?php

namespace OpenCompany\Integrations\Mailchimp\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mailchimp\MailchimpService;

/**
 * Create a new Mailchimp audience (list).
 */
class MailchimpCreateAudience implements Tool
{
    /** @param MailchimpService $service The Mailchimp API client */
    public function __construct(
        private MailchimpService $service,
    ) {}

    public function name(): string
    {
        return 'mailchimp_create_audience';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new audience (list) in Mailchimp.
        Requires a name, contact information, permission reminder, and campaign defaults.
        Returns the newly created audience with its ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'name' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The name of the audience.',
            ],
            'contact' => [
                'type' => 'object',
                'required' => true,
                'description' => 'Contact information for the audience (company, address1, city, state, zip, country).',
                'properties' => [
                    'company' => ['type' => 'string', 'description' => 'Company name.'],
                    'address1' => ['type' => 'string', 'description' => 'Street address.'],
                    'city' => ['type' => 'string', 'description' => 'City.'],
                    'state' => ['type' => 'string', 'description' => 'State or province.'],
                    'zip' => ['type' => 'string', 'description' => 'Postal / ZIP code.'],
                    'country' => ['type' => 'string', 'description' => 'Country code (e.g. US).'],
                ],
            ],
            'permission_reminder' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Permission reminder text explaining why the subscriber is on this list.',
            ],
            'email_type_option' => [
                'type' => 'boolean',
                'description' => 'Whether to allow subscribers to choose HTML or plain-text email.',
                'default' => false,
            ],
            'campaign_defaults' => [
                'type' => 'object',
                'required' => true,
                'description' => 'Default values for campaigns created from this audience.',
                'properties' => [
                    'from_name' => ['type' => 'string', 'description' => 'Default "from" name.'],
                    'from_email' => ['type' => 'string', 'description' => 'Default "from" email address.'],
                    'subject' => ['type' => 'string', 'description' => 'Default email subject.'],
                    'language' => ['type' => 'string', 'description' => 'Default language code (e.g. en).'],
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

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('The "name" parameter is required.');
            }

            $contact = $args['contact'] ?? [];
            if (empty($contact)) {
                return ToolResult::error('The "contact" parameter is required.');
            }

            $permissionReminder = $args['permission_reminder'] ?? '';
            if (empty($permissionReminder)) {
                return ToolResult::error('The "permission_reminder" parameter is required.');
            }

            $campaignDefaults = $args['campaign_defaults'] ?? [];
            if (empty($campaignDefaults)) {
                return ToolResult::error('The "campaign_defaults" parameter is required.');
            }

            $payload = [
                'name' => $name,
                'contact' => $contact,
                'permission_reminder' => $permissionReminder,
                'email_type_option' => (bool) ($args['email_type_option'] ?? false),
                'campaign_defaults' => $campaignDefaults,
            ];

            $result = $this->service->createAudience($payload);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
