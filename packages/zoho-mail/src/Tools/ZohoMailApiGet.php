<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a safe relative Zoho Mail API path with GET.
 */
class ZohoMailApiGet extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_api_get'; }

    public function description(): string { return 'Call a safe relative Zoho Mail API path with GET.'; }

    public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path.'], 'params' => ['type' => 'object', 'description' => 'Query parameters.']]; }

    /**
     * Call a GET path.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiGet($this->requiredString($args, 'path'), $this->arrayArg($args, 'params')));
    }
}
