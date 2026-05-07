<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a MailerLite webhook.
 */
class MailerLiteCreateWebhook extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_create_webhook';
    }

    public function description(): string
    {
        return 'Create a webhook subscription for subscriber or campaign events.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'description' => 'Webhook name.'],
            'events' => ['type' => 'array', 'required' => true, 'description' => 'Webhook event names.'],
            'url' => ['type' => 'string', 'required' => true, 'description' => 'Webhook callback URL.'],
            'enabled' => ['type' => 'boolean', 'description' => 'Whether the webhook is enabled.'],
            'batchable' => ['type' => 'boolean', 'description' => 'Required for campaign.open, campaign.click, and subscriber.deleted events.'],
            'payload' => ['type' => 'object', 'description' => 'Full webhook payload.'],
        ];
    }

    /**
     * Execute the webhook creation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createWebhook($this->payload($args, [
            'name', 'events', 'url', 'enabled', 'batchable',
        ])));
    }
}
