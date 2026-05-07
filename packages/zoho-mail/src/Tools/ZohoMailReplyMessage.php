<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Reply to a Zoho Mail message.
 */
class ZohoMailReplyMessage extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_reply_message'; }

    public function description(): string { return 'Reply to an existing Zoho Mail message.'; }

    public function parameters(): array
    {
        return [
            'accountId' => ['type' => 'string', 'required' => true, 'description' => 'Zoho Mail account ID.'],
            'messageId' => ['type' => 'string', 'required' => true, 'description' => 'Message ID to reply to.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Reply payload accepted by Zoho Mail.'],
        ];
    }

    /**
     * Reply to a message.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->replyMessage(
            $this->requiredString($args, 'accountId'),
            $this->requiredString($args, 'messageId'),
            $this->arrayArg($args, 'payload'),
        ));
    }
}
