<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a custom subscriber field in MailerLite.
 */
class MailerLiteDeleteField extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_delete_field';
    }

    public function description(): string
    {
        return 'Delete a custom subscriber field by ID.';
    }

    public function parameters(): array
    {
        return [
            'field_id' => ['type' => 'string', 'required' => true, 'description' => 'Field ID.'],
        ];
    }

    /**
     * Execute the field deletion.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteField($this->required($args, 'field_id')));
    }
}
