<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Tally webhook subscription.
 */
class TallyCreateWebhook extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_create_webhook';
    }

    public function description(): string
    {
        return 'Create a Tally webhook subscription for a form.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'Form ID to subscribe to.'],
            'url' => ['type' => 'string', 'required' => true, 'description' => 'Webhook target URL.'],
            'event_types' => ['type' => 'array', 'required' => true, 'description' => 'Event types to receive.', 'items' => ['type' => 'string']],
            'signing_secret' => ['type' => 'string', 'description' => 'Optional webhook signing secret.'],
            'http_headers' => ['type' => 'array', 'description' => 'Optional custom headers.', 'items' => ['type' => 'object']],
            'external_subscriber' => ['type' => 'string', 'description' => 'Optional external subscriber identifier.'],
        ];
    }

    /**
     * Execute the create webhook request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createWebhook(array_merge(
            [
                'formId' => $this->requiredString($args, 'form_id', 'Form ID'),
                'url' => $this->requiredString($args, 'url', 'URL'),
                'eventTypes' => is_array($args['event_types'] ?? null) ? $args['event_types'] : throw new \InvalidArgumentException('Event types are required.'),
            ],
            $this->mappedPayload($args, [
                'signing_secret' => 'signingSecret',
                'http_headers' => 'httpHeaders',
                'external_subscriber' => 'externalSubscriber',
            ]),
        )));
    }
}
