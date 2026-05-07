<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch a MailerLite form by ID.
 */
class MailerLiteGetForm extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_get_form';
    }

    public function description(): string
    {
        return 'Get a form by ID.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'Form ID.'],
        ];
    }

    /**
     * Execute the form fetch.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getForm($this->required($args, 'form_id')));
    }
}
