<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Zoho Mail folder.
 */
class ZohoMailDeleteFolder extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_delete_folder'; }

    public function description(): string { return 'Delete a Zoho Mail folder by ID.'; }

    public function parameters(): array { return ['accountId' => ['type' => 'string', 'required' => true, 'description' => 'Account ID.'], 'folderId' => ['type' => 'string', 'required' => true, 'description' => 'Folder ID.']]; }

    /**
     * Delete a folder.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteFolder($this->requiredString($args, 'accountId'), $this->requiredString($args, 'folderId')));
    }
}
