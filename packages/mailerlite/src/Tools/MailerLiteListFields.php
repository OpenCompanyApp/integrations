<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List custom subscriber fields in MailerLite.
 */
class MailerLiteListFields extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_list_fields';
    }

    public function description(): string
    {
        return 'List custom subscriber fields.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum rows to return.'],
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
        ];
    }

    /**
     * Execute the fields listing.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listFields($this->only($args, ['limit', 'page'])));
    }
}
