<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a safe relative Unbounce API path with DELETE.
 */
class UnbounceApiDelete extends AbstractUnbounceTool
{
    public function name(): string { return 'unbounce_api_delete'; }

    public function description(): string { return 'Call a safe relative Unbounce API path with DELETE.'; }

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
