<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a MailerLite webhook.
 */
class MailerLiteUpdateWebhook extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_update_webhook';
    }

    public function description(): string
    {
        return 'Update webhook name, events, callback URL, enabled state, or batchable flag.';
    }

    public function parameters(): array
    {
        return [
            'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'Webhook ID.'],
            'name' => ['type' => 'string', 'description' => 'Webhook name.'],
            'events' => ['type' => 'array', 'description' => 'Webhook event names.'],
            'url' => ['type' => 'string', 'description' => 'Webhook callback URL.'],
            'enabled' => ['type' => 'boolean', 'description' => 'Whether the webhook is enabled.'],
            'batchable' => ['type' => 'boolean', 'description' => 'Batchable flag.'],
            'payload' => ['type' => 'object', 'description' => 'Full webhook update payload.'],
        ];
    }

    /**
     * Execute the webhook update.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateWebhook(
            $this->required($args, 'webhook_id'),
            $this->payload($args, ['name', 'events', 'url', 'enabled', 'batchable']),
        ));
    }
}
