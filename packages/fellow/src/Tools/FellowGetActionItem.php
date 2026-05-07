<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Fellow action item by ID.
 */
class FellowGetActionItem extends AbstractFellowTool implements Tool
{
    public function name(): string
    {
        return 'fellow_get_action_item';
    }

    public function description(): string
    {
        return 'Retrieve a Fellow action item by ID.';
    }

    public function parameters(): array
    {
        return [
            'action_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Fellow action item ID.'],
        ];
    }

    /**
     * Execute the get action item tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (action_item_id).
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getActionItem($this->requiredString($args, 'action_item_id')));
    }
}
