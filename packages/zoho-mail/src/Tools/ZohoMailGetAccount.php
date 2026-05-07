<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a Zoho Mail account.
 */
class ZohoMailGetAccount extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_get_account'; }

    public function description(): string { return 'Get details for a specific Zoho Mail account.'; }

    public function parameters(): array { return ['accountId' => ['type' => 'string', 'required' => true, 'description' => 'Zoho Mail account ID.']]; }

    /**
     * Get account details.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getAccount($this->requiredString($args, 'accountId')));
    }
}
