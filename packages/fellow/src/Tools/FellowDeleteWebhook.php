<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Fellow webhook endpoint.
 */
class FellowDeleteWebhook extends AbstractFellowTool implements Tool
{
    public function name(): string
    {
        return 'fellow_delete_webhook';
    }

    public function description(): string
    {
        return 'Delete a Fellow webhook endpoint by ID.';
    }

    public function parameters(): array
    {
        return [
            'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'Fellow webhook ID.'],
        ];
    }

    /**
     * Execute the delete webhook tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (webhook_id).
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteWebhook($this->requiredString($args, 'webhook_id')));
    }
}
