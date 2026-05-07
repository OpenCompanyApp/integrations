<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Archive a Fellow action item by marking it as won't do.
 */
class FellowArchiveActionItem extends AbstractFellowTool implements Tool
{
    public function name(): string
    {
        return 'fellow_archive_action_item';
    }

    public function description(): string
    {
        return 'Archive a Fellow action item by marking it as won\'t do.';
    }

    public function parameters(): array
    {
        return [
            'action_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Fellow action item ID.'],
        ];
    }

    /**
     * Execute the archive action item tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (action_item_id).
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->archiveActionItem($this->requiredString($args, 'action_item_id')));
    }
}
