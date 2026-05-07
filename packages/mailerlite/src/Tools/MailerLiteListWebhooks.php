<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List MailerLite webhooks.
 */
class MailerLiteListWebhooks extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_list_webhooks';
    }

    public function description(): string
    {
        return 'List configured webhooks.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum rows to return.'],
        ];
    }

    /**
     * Execute the webhook listing.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listWebhooks($this->only($args, ['page', 'limit'])));
    }
}
