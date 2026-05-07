<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Fellow webhook by ID.
 */
class FellowGetWebhook extends AbstractFellowTool implements Tool
{
    public function name(): string
    {
        return 'fellow_get_webhook';
    }

    public function description(): string
    {
        return 'Retrieve a Fellow webhook by ID.';
    }

    public function parameters(): array
    {
        return [
            'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'Fellow webhook ID.'],
        ];
    }

    /**
     * Execute the get webhook tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (webhook_id).
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getWebhook($this->requiredString($args, 'webhook_id')));
    }
}
