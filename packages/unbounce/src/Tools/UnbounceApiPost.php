<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a safe relative Unbounce API path with POST.
 */
class UnbounceApiPost extends AbstractUnbounceTool
{
    public function name(): string { return 'unbounce_api_post'; }

    public function description(): string { return 'Call a safe relative Unbounce API path with POST.'; }

    public function parameters(): array { return ['path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path.'], 'payload' => ['type' => 'object', 'description' => 'JSON request body.'], 'params' => ['type' => 'object', 'description' => 'Query parameters.']]; }

    /**
     * Call a POST path.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiPost($this->requiredString($args, 'path'), $this->arrayArg($args, 'payload'), $this->arrayArg($args, 'params')));
    }
}
