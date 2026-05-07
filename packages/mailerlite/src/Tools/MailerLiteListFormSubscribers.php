<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List subscribers who signed up through a MailerLite form.
 */
class MailerLiteListFormSubscribers extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_list_form_subscribers';
    }

    public function description(): string
    {
        return 'List subscribers who signed up to a specific form.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'Form ID.'],
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum rows to return.'],
        ];
    }

    /**
     * Execute the form subscriber listing.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listFormSubscribers(
            $this->required($args, 'form_id'),
            $this->only($args, ['page', 'limit']),
        ));
    }
}
