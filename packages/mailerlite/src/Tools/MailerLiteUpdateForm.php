<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a MailerLite form.
 */
class MailerLiteUpdateForm extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_update_form';
    }

    public function description(): string
    {
        return 'Update a form. Use payload for the full MailerLite form update body.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'Form ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Form update payload.'],
        ];
    }

    /**
     * Execute the form update.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateForm(
            $this->required($args, 'form_id'),
            $this->required($args, 'payload'),
        ));
    }
}
