<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Rename a Tally workspace.
 */
class TallyUpdateWorkspace extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_update_workspace';
    }

    public function description(): string
    {
        return 'Rename a Tally workspace.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally workspace ID.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'New workspace name.'],
        ];
    }

    /**
     * Execute the update workspace request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateWorkspace(
            $this->requiredString($args, 'workspace_id', 'Workspace ID'),
            $this->requiredString($args, 'name', 'Name'),
        ));
    }
}
