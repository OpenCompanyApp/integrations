<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Tally form.
 */
class TallyDeleteForm extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_delete_form';
    }

    public function description(): string
    {
        return 'Delete a Tally form by ID.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally form ID.'],
        ];
    }

    /**
     * Execute the delete form request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteForm(
            $this->requiredString($args, 'form_id', 'Form ID'),
        ));
    }
}
