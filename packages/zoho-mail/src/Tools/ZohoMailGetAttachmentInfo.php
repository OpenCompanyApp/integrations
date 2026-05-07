<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get attachment metadata for a Zoho Mail message.
 */
class ZohoMailGetAttachmentInfo extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_get_attachment_info'; }

    public function description(): string { return 'Get attachment metadata for a Zoho Mail message.'; }

    public function parameters(): array
    {
        return [
            'accountId' => ['type' => 'string', 'required' => true, 'description' => 'Zoho Mail account ID.'],
            'folderId' => ['type' => 'string', 'required' => true, 'description' => 'Folder ID.'],
            'messageId' => ['type' => 'string', 'required' => true, 'description' => 'Message ID.'],
        ];
    }

    /**
     * Get attachment metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getAttachmentInfo(
            $this->requiredString($args, 'accountId'),
            $this->requiredString($args, 'folderId'),
            $this->requiredString($args, 'messageId'),
        ));
    }
}
