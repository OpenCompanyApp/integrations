<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Tally webhook subscription.
 */
class TallyDeleteWebhook extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_delete_webhook';
    }

    public function description(): string
    {
        return 'Delete a Tally webhook subscription by ID.';
    }

    public function parameters(): array
    {
        return [
            'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally webhook ID.'],
        ];
    }

    /**
     * Execute the delete webhook request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteWebhook(
            $this->requiredString($args, 'webhook_id', 'Webhook ID'),
        ));
    }
}
