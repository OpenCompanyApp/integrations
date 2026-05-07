<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Tally workspace.
 */
class TallyDeleteWorkspace extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_delete_workspace';
    }

    public function description(): string
    {
        return 'Delete a Tally workspace by ID.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally workspace ID.'],
        ];
    }

    /**
     * Execute the delete workspace request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteWorkspace(
            $this->requiredString($args, 'workspace_id', 'Workspace ID'),
        ));
    }
}
