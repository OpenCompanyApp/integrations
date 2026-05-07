<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get metadata details for a Zoho Mail message.
 */
class ZohoMailGetMessageDetails extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_get_message_details'; }

    public function description(): string { return 'Get metadata details for a Zoho Mail message.'; }

    public function parameters(): array { return $this->messageParams(); }

    /**
     * Get message details.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getMessageDetails(
            $this->requiredString($args, 'accountId'),
            $this->requiredString($args, 'folderId'),
            $this->requiredString($args, 'messageId'),
        ));
    }

    /**
     * @return array<string, mixed>
     */
    private function messageParams(): array
    {
        return [
            'accountId' => ['type' => 'string', 'required' => true, 'description' => 'Zoho Mail account ID.'],
            'folderId' => ['type' => 'string', 'required' => true, 'description' => 'Folder ID.'],
            'messageId' => ['type' => 'string', 'required' => true, 'description' => 'Message ID.'],
        ];
    }
}
