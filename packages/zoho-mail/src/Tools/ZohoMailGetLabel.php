<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a Zoho Mail label.
 */
class ZohoMailGetLabel extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_get_label'; }

    public function description(): string { return 'Get a Zoho Mail label by ID.'; }

    public function parameters(): array { return ['accountId' => ['type' => 'string', 'required' => true, 'description' => 'Account ID.'], 'labelId' => ['type' => 'string', 'required' => true, 'description' => 'Label ID.']]; }

    /**
     * Get a label.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getLabel($this->requiredString($args, 'accountId'), $this->requiredString($args, 'labelId')));
    }
}
