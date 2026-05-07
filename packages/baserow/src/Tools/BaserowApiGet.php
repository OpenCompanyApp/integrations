<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Perform a raw GET request to a relative Baserow API path.
 */
class BaserowApiGet extends AbstractBaserowTool
{
    public function name(): string
    {
        return 'baserow_api_get';
    }

    public function description(): string
    {
        return 'Call a relative Baserow API path with GET for supported endpoints not covered by a dedicated tool.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path, for example /api/database/fields/table/42/.'],
            'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
        ];
    }

    /**
     * Execute a raw GET request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiGet(
            $this->requiredString($args, 'path'),
            $this->arrayArg($args, 'query')
        ));
    }
}
