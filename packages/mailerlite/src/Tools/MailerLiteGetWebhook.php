<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch a MailerLite webhook by ID.
 */
class MailerLiteGetWebhook extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_get_webhook';
    }

    public function description(): string
    {
        return 'Get a webhook by ID.';
    }

    public function parameters(): array
    {
        return [
            'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'Webhook ID.'],
        ];
    }

    /**
     * Execute the webhook fetch.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getWebhook($this->required($args, 'webhook_id')));
    }
}
