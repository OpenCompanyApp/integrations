<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the original MIME representation of a Zoho Mail message.
 */
class ZohoMailGetOriginalMessage extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_get_original_message'; }

    public function description(): string { return 'Get the original MIME representation of a Zoho Mail message.'; }

    public function parameters(): array
    {
        return [
            'accountId' => ['type' => 'string', 'required' => true, 'description' => 'Zoho Mail account ID.'],
            'messageId' => ['type' => 'string', 'required' => true, 'description' => 'Message ID.'],
        ];
    }

    /**
     * Get original MIME message.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getOriginalMessage(
            $this->requiredString($args, 'accountId'),
            $this->requiredString($args, 'messageId'),
        ));
    }
}
