<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get headers for a Zoho Mail message.
 */
class ZohoMailGetMessageHeaders extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_get_message_headers'; }

    public function description(): string { return 'Get email headers for a Zoho Mail message.'; }

    public function parameters(): array
    {
        return [
            'accountId' => ['type' => 'string', 'required' => true, 'description' => 'Zoho Mail account ID.'],
            'folderId' => ['type' => 'string', 'required' => true, 'description' => 'Folder ID.'],
            'messageId' => ['type' => 'string', 'required' => true, 'description' => 'Message ID.'],
        ];
    }

    /**
     * Get message headers.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getMessageHeaders(
            $this->requiredString($args, 'accountId'),
            $this->requiredString($args, 'folderId'),
            $this->requiredString($args, 'messageId'),
        ));
    }
}
