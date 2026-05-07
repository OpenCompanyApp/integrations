<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all workspaces accessible to the authenticated Tally user.
 */
class TallyListWorkspaces extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_list_workspaces';
    }

    public function description(): string
    {
        return 'List all workspaces accessible to the authenticated Tally user. Returns workspace names, IDs, and member info.';
    }

    public function parameters(): array
    {
        return [
            'page' => [
                'type' => 'integer',
                'description' => 'Page number for pagination.',
            ],
        ];
    }

    /**
     * Execute the list workspaces request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listWorkspaces(
            $this->params($args, ['page']),
        ));
    }
}
