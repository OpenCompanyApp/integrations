<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Zoho Mail label.
 */
class ZohoMailUpdateLabel extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_update_label'; }

    public function description(): string { return 'Update a Zoho Mail label.'; }

    public function parameters(): array { return ['accountId' => ['type' => 'string', 'required' => true, 'description' => 'Account ID.'], 'labelId' => ['type' => 'string', 'required' => true, 'description' => 'Label ID.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Label update payload.']]; }

    /**
     * Update a label.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateLabel($this->requiredString($args, 'accountId'), $this->requiredString($args, 'labelId'), $this->arrayArg($args, 'payload')));
    }
}
