<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Mark a Fellow action item complete or incomplete.
 */
class FellowMarkActionItemComplete extends AbstractFellowTool implements Tool
{
    public function name(): string
    {
        return 'fellow_mark_action_item_complete';
    }

    public function description(): string
    {
        return 'Mark a Fellow action item complete or incomplete.';
    }

    public function parameters(): array
    {
        return [
            'action_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Fellow action item ID.'],
            'completed' => ['type' => 'boolean', 'required' => true, 'description' => 'Whether the action item should be complete.'],
        ];
    }

    /**
     * Execute the completion-state update tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (action_item_id, completed).
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->markActionItemComplete(
            $this->requiredString($args, 'action_item_id'),
            (bool) ($args['completed'] ?? false),
        ));
    }
}
