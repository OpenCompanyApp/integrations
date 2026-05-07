<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Zoho Mail folder.
 */
class ZohoMailUpdateFolder extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_update_folder'; }

    public function description(): string { return 'Update, rename, move, empty, or toggle IMAP for a Zoho Mail folder.'; }

    public function parameters(): array { return ['accountId' => ['type' => 'string', 'required' => true, 'description' => 'Account ID.'], 'folderId' => ['type' => 'string', 'required' => true, 'description' => 'Folder ID.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Folder update payload.']]; }

    /**
     * Update a folder.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateFolder($this->requiredString($args, 'accountId'), $this->requiredString($args, 'folderId'), $this->arrayArg($args, 'payload')));
    }
}
