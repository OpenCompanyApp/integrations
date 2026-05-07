<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Perform a raw PATCH request to a relative Baserow API path.
 */
class BaserowApiPatch extends AbstractBaserowTool
{
    public function name(): string
    {
        return 'baserow_api_patch';
    }

    public function description(): string
    {
        return 'Call a relative Baserow API path with PATCH for supported endpoints not covered by a dedicated tool.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path.'],
            'payload' => ['type' => 'object', 'description' => 'JSON request body.'],
            'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
        ];
    }

    /**
     * Execute a raw PATCH request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiPatch(
            $this->requiredString($args, 'path'),
            $this->arrayArg($args, 'payload'),
            $this->arrayArg($args, 'query')
        ));
    }
}
