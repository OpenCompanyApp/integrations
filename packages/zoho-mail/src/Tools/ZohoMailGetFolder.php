<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get one Zoho Mail folder.
 */
class ZohoMailGetFolder extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_get_folder'; }

    public function description(): string { return 'Get one Zoho Mail folder by ID.'; }

    public function parameters(): array { return ['accountId' => ['type' => 'string', 'required' => true, 'description' => 'Account ID.'], 'folderId' => ['type' => 'string', 'required' => true, 'description' => 'Folder ID.']]; }

    /**
     * Get folder details.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getFolder($this->requiredString($args, 'accountId'), $this->requiredString($args, 'folderId')));
    }
}
