<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update Zoho Mail messages through the updatemessage endpoint.
 */
class ZohoMailUpdateMessages extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_update_messages'; }

    public function description(): string { return 'Update messages with an official Zoho Mail updatemessage payload, including read/unread, move, flag, labels, archive, or spam modes.'; }

    public function parameters(): array
    {
        return [
            'accountId' => ['type' => 'string', 'required' => true, 'description' => 'Zoho Mail account ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Update payload including mode and messageId or threadId arrays.'],
        ];
    }

    /**
     * Update messages.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateMessages(
            $this->requiredString($args, 'accountId'),
            $this->arrayArg($args, 'payload'),
        ));
    }
}
