<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a MailerLite webhook.
 */
class MailerLiteDeleteWebhook extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_delete_webhook';
    }

    public function description(): string
    {
        return 'Delete a webhook by ID.';
    }

    public function parameters(): array
    {
        return [
            'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'Webhook ID.'],
        ];
    }

    /**
     * Execute the webhook deletion.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteWebhook($this->required($args, 'webhook_id')));
    }
}
