<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Perform a raw POST request to a relative Baserow API path.
 */
class BaserowApiPost extends AbstractBaserowTool
{
    public function name(): string
    {
        return 'baserow_api_post';
    }

    public function description(): string
    {
        return 'Call a relative Baserow API path with POST for supported endpoints not covered by a dedicated tool.';
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
     * Execute a raw POST request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiPost(
            $this->requiredString($args, 'path'),
            $this->arrayArg($args, 'payload'),
            $this->arrayArg($args, 'query')
        ));
    }
}
