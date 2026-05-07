<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Abyssale projects.
 */
class AbyssaleListProjects extends AbstractAbyssaleTool implements Tool
{
    public function name(): string
    {
        return 'abyssale_list_projects';
    }

    public function description(): string
    {
        return 'List projects in the Abyssale workspace.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list projects request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listProjects());
    }
}
