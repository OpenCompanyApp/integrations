<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a MailerLite form.
 */
class MailerLiteDeleteForm extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_delete_form';
    }

    public function description(): string
    {
        return 'Delete a form by ID.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'Form ID.'],
        ];
    }

    /**
     * Execute the form deletion.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteForm($this->required($args, 'form_id')));
    }
}
