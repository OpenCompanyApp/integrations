<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a safe relative Zoho Mail API path with DELETE.
 */
class ZohoMailApiDelete extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_api_delete'; }

    public function description(): string { return 'Call a safe relative Zoho Mail API path with DELETE.'; }

    public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path.'], 'params' => ['type' => 'object', 'description' => 'Query parameters.']]; }

    /**
     * Call a DELETE path.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiDelete($this->requiredString($args, 'path'), $this->arrayArg($args, 'params')));
    }
}
