<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get attachment content for a Zoho Mail message.
 */
class ZohoMailGetAttachmentContent extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_get_attachment_content'; }

    public function description(): string { return 'Get attachment content for a Zoho Mail message.'; }

    public function parameters(): array
    {
        return [
            'accountId' => ['type' => 'string', 'required' => true, 'description' => 'Zoho Mail account ID.'],
            'folderId' => ['type' => 'string', 'required' => true, 'description' => 'Folder ID.'],
            'messageId' => ['type' => 'string', 'required' => true, 'description' => 'Message ID.'],
            'attachmentId' => ['type' => 'string', 'required' => true, 'description' => 'Attachment ID.'],
        ];
    }

    /**
     * Get attachment content.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getAttachmentContent(
            $this->requiredString($args, 'accountId'),
            $this->requiredString($args, 'folderId'),
            $this->requiredString($args, 'messageId'),
            $this->requiredString($args, 'attachmentId'),
        ));
    }
}
