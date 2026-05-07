<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Duplicate a workspace template into an Abyssale project.
 */
class AbyssaleDuplicateWorkspaceTemplate extends AbstractAbyssaleTool implements Tool
{
    public function name(): string
    {
        return 'abyssale_duplicate_workspace_template';
    }

    public function description(): string
    {
        return 'Duplicate a workspace template into a project.';
    }

    public function parameters(): array
    {
        return [
            'company_template_id' => ['type' => 'string', 'required' => true, 'description' => 'Workspace template UUID.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'Target project UUID.'],
            'name' => ['type' => 'string', 'description' => 'Optional custom name for the duplicated design.'],
        ];
    }

    /**
     * Execute the duplicate workspace template request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->duplicateWorkspaceTemplate(
            $this->requiredString($args, 'company_template_id', 'Company template ID'),
            $this->requiredString($args, 'project_id', 'Project ID'),
            $this->optionalString($args, 'name'),
        ));
    }
}
