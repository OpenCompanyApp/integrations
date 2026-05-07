<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List MailerLite signup forms by type.
 */
class MailerLiteListForms extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_list_forms';
    }

    public function description(): string
    {
        return 'List forms by type: popup, embedded, or promotion.';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'enum' => ['popup', 'embedded', 'promotion'], 'description' => 'Form type.'],
            'filter[name]' => ['type' => 'string', 'description' => 'Partial name filter.'],
            'sort' => ['type' => 'string', 'description' => 'Sort field, optionally prefixed with minus for descending order.'],
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum rows to return.'],
        ];
    }

    /**
     * Execute the forms listing.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listForms(
            $this->required($args, 'type'),
            $this->only($args, ['filter[name]', 'sort', 'page', 'limit']),
        ));
    }
}
