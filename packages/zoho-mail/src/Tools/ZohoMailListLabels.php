<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List labels for a Zoho Mail account.
 */
class ZohoMailListLabels extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_list_labels'; }

    public function description(): string { return 'List labels for a Zoho Mail account.'; }

    public function parameters(): array { return ['accountId' => ['type' => 'string', 'required' => true, 'description' => 'Zoho Mail account ID.']]; }

    /**
     * List labels.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listLabels($this->requiredString($args, 'accountId')));
    }
}
