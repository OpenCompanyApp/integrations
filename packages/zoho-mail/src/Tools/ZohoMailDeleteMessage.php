<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Zoho Mail message by account, folder, and message ID.
 */
class ZohoMailDeleteMessage extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_delete_message'; }

    public function description(): string { return 'Delete a Zoho Mail message by account, folder, and message ID.'; }

    public function parameters(): array
    {
        return [
            'accountId' => ['type' => 'string', 'required' => true, 'description' => 'Zoho Mail account ID.'],
            'folderId' => ['type' => 'string', 'required' => true, 'description' => 'Folder ID.'],
            'messageId' => ['type' => 'string', 'required' => true, 'description' => 'Message ID.'],
        ];
    }

    /**
     * Delete a message.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteMessage(
            $this->requiredString($args, 'accountId'),
            $this->requiredString($args, 'folderId'),
            $this->requiredString($args, 'messageId'),
        ));
    }
}
