<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List delivery events for a Tally webhook.
 */
class TallyListWebhookEvents extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_list_webhook_events';
    }

    public function description(): string
    {
        return 'List delivery events for a Tally webhook.';
    }

    public function parameters(): array
    {
        return [
            'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally webhook ID.'],
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
        ];
    }

    /**
     * Execute the list webhook events request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listWebhookEvents(
            $this->requiredString($args, 'webhook_id', 'Webhook ID'),
            $this->params($args, ['page']),
        ));
    }
}
