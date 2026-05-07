<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List MailerLite automations.
 */
class MailerLiteListAutomations extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_list_automations';
    }

    public function description(): string
    {
        return 'List automations with optional enabled, name, and group filters.';
    }

    public function parameters(): array
    {
        return [
            'filter[enabled]' => ['type' => 'boolean', 'description' => 'Filter active or inactive automations.'],
            'filter[name]' => ['type' => 'string', 'description' => 'Partial name filter.'],
            'filter[group]' => ['type' => 'string', 'description' => 'Group ID filter.'],
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum rows to return.'],
        ];
    }

    /**
     * Execute the automations listing.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listAutomations($this->only($args, [
            'filter[enabled]', 'filter[name]', 'filter[group]', 'page', 'limit',
        ])));
    }
}
