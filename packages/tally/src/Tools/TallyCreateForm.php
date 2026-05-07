<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Tally form.
 */
class TallyCreateForm extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_create_form';
    }

    public function description(): string
    {
        return 'Create a new Tally form using blocks, settings, a workspace, a template, and an optional initial status.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'description' => 'Workspace ID to create the form in.'],
            'template_id' => ['type' => 'string', 'description' => 'Template ID to base the form on.'],
            'status' => ['type' => 'string', 'description' => 'Initial form status.'],
            'blocks' => ['type' => 'array', 'description' => 'Tally block payloads.', 'items' => ['type' => 'object']],
            'settings' => ['type' => 'object', 'description' => 'Tally form settings.'],
        ];
    }

    /**
     * Execute the create form request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createForm(
            array_merge(
                $this->params($args, ['status', 'blocks', 'settings']),
                $this->mappedPayload($args, ['workspace_id' => 'workspaceId', 'template_id' => 'templateId']),
            ),
        ));
    }
}
