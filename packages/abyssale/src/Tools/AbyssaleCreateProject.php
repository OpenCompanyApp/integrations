<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create an Abyssale project.
 */
class AbyssaleCreateProject extends AbstractAbyssaleTool implements Tool
{
    public function name(): string
    {
        return 'abyssale_create_project';
    }

    public function description(): string
    {
        return 'Create a project in the Abyssale workspace.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Project name, 2 to 100 characters.'],
        ];
    }

    /**
     * Execute the create project request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createProject(
            $this->requiredString($args, 'name', 'Name'),
        ));
    }
}
