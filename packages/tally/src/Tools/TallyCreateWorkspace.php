<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Tally workspace.
 */
class TallyCreateWorkspace extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_create_workspace';
    }

    public function description(): string
    {
        return 'Create a Tally workspace by name.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Workspace name.'],
        ];
    }

    /**
     * Execute the create workspace request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createWorkspace(
            $this->requiredString($args, 'name', 'Name'),
        ));
    }
}
