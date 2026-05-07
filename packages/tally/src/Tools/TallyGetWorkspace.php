<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch a Tally workspace by ID.
 */
class TallyGetWorkspace extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_get_workspace';
    }

    public function description(): string
    {
        return 'Get a Tally workspace by ID.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally workspace ID.'],
        ];
    }

    /**
     * Execute the get workspace request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getWorkspace(
            $this->requiredString($args, 'workspace_id', 'Workspace ID'),
        ));
    }
}
