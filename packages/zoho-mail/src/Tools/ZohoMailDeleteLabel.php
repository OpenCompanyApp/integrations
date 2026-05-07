<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Zoho Mail label.
 */
class ZohoMailDeleteLabel extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_delete_label'; }

    public function description(): string { return 'Delete a Zoho Mail label.'; }

    public function parameters(): array { return ['accountId' => ['type' => 'string', 'required' => true, 'description' => 'Account ID.'], 'labelId' => ['type' => 'string', 'required' => true, 'description' => 'Label ID.']]; }

    /**
     * Delete a label.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteLabel($this->requiredString($args, 'accountId'), $this->requiredString($args, 'labelId')));
    }
}
