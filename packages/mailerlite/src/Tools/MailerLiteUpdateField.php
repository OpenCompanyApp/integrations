<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a custom subscriber field in MailerLite.
 */
class MailerLiteUpdateField extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_update_field';
    }

    public function description(): string
    {
        return 'Update a custom field name.';
    }

    public function parameters(): array
    {
        return [
            'field_id' => ['type' => 'string', 'required' => true, 'description' => 'Field ID.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Updated field name.'],
        ];
    }

    /**
     * Execute the field update.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateField(
            $this->required($args, 'field_id'),
            ['name' => $this->required($args, 'name')],
        ));
    }
}
