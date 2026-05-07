<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Tally webhook subscription.
 */
class TallyUpdateWebhook extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_update_webhook';
    }

    public function description(): string
    {
        return 'Update a Tally webhook target, event types, headers, signing secret, or enabled state.';
    }

    public function parameters(): array
    {
        return [
            'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally webhook ID.'],
            'form_id' => ['type' => 'string', 'description' => 'Form ID the webhook belongs to.'],
            'url' => ['type' => 'string', 'description' => 'Webhook target URL.'],
            'event_types' => ['type' => 'array', 'description' => 'Event types to receive.', 'items' => ['type' => 'string']],
            'is_enabled' => ['type' => 'boolean', 'description' => 'Whether the webhook is enabled.'],
            'signing_secret' => ['type' => 'string', 'description' => 'Optional webhook signing secret.'],
            'http_headers' => ['type' => 'array', 'description' => 'Optional custom headers.', 'items' => ['type' => 'object']],
        ];
    }

    /**
     * Execute the update webhook request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateWebhook(
            $this->requiredString($args, 'webhook_id', 'Webhook ID'),
            array_merge(
                $this->params($args, ['url']),
                $this->mappedPayload($args, [
                    'form_id' => 'formId',
                    'event_types' => 'eventTypes',
                    'is_enabled' => 'isEnabled',
                    'signing_secret' => 'signingSecret',
                    'http_headers' => 'httpHeaders',
                ]),
            ),
        ));
    }
}
