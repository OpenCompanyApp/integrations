<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific Tally form by its ID.
 */
class TallyGetForm extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_get_form';
    }

    public function description(): string
    {
        return 'Get full details of a specific Tally form by its ID, including form structure, fields, and settings.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Tally form ID (e.g., "mVlBRN").',
            ],
        ];
    }

    /**
     * Execute the get form request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (form_id).
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getForm(
            $this->requiredString($args, 'form_id', 'Form ID'),
        ));
    }
}
