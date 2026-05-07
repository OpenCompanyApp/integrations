<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search Zoho Mail messages using the messages/search endpoint.
 */
class ZohoMailSearchMessages extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_search_messages'; }

    public function description(): string { return 'Search messages in a Zoho Mail account using official search parameters.'; }

    public function parameters(): array
    {
        return [
            'accountId' => ['type' => 'string', 'required' => true, 'description' => 'Zoho Mail account ID.'],
            'params' => ['type' => 'object', 'description' => 'Zoho Mail message search query parameters.'],
        ];
    }

    /**
     * Search messages.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->searchMessages(
            $this->requiredString($args, 'accountId'),
            $this->arrayArg($args, 'params'),
        ));
    }
}
