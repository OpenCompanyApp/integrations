<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a safe relative Zoho Mail API path with PUT.
 */
class ZohoMailApiPut extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_api_put'; }

    public function description(): string { return 'Call a safe relative Zoho Mail API path with PUT.'; }

    public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path.'], 'payload' => ['type' => 'object', 'description' => 'JSON request body.'], 'params' => ['type' => 'object', 'description' => 'Query parameters.']]; }

    /**
     * Call a PUT path.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiPut($this->requiredString($args, 'path'), $this->arrayArg($args, 'payload'), $this->arrayArg($args, 'params')));
    }
}
