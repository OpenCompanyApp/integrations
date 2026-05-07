<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retry a failed Tally webhook delivery event.
 */
class TallyRetryWebhookEvent extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_retry_webhook_event';
    }

    public function description(): string
    {
        return 'Retry a Tally webhook delivery event.';
    }

    public function parameters(): array
    {
        return [
            'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally webhook ID.'],
            'event_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally webhook event ID.'],
        ];
    }

    /**
     * Execute the retry webhook event request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->retryWebhookEvent(
            $this->requiredString($args, 'webhook_id', 'Webhook ID'),
            $this->requiredString($args, 'event_id', 'Event ID'),
        ));
    }
}
