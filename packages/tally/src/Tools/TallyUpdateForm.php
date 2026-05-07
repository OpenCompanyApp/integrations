<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update mutable fields on a Tally form.
 */
class TallyUpdateForm extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_update_form';
    }

    public function description(): string
    {
        return 'Update a Tally form name, status, blocks, or settings.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally form ID.'],
            'name' => ['type' => 'string', 'description' => 'New form name.'],
            'status' => ['type' => 'string', 'description' => 'New form status.'],
            'blocks' => ['type' => 'array', 'description' => 'Updated Tally blocks.', 'items' => ['type' => 'object']],
            'settings' => ['type' => 'object', 'description' => 'Updated Tally settings.'],
        ];
    }

    /**
     * Execute the update form request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateForm(
            $this->requiredString($args, 'form_id', 'Form ID'),
            $this->params($args, ['name', 'status', 'blocks', 'settings']),
        ));
    }
}
