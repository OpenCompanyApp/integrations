<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send a GET request to a relative Fellow API path.
 */
class FellowApiGet extends AbstractFellowTool implements Tool
{
    public function name(): string
    {
        return 'fellow_api_get';
    }

    public function description(): string
    {
        return 'Call a relative Fellow API GET path for documented endpoints without a first-class tool.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative path such as /me. Absolute URLs are rejected.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    /**
     * Execute the generic GET tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path, params).
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiGet(
            $this->requiredString($args, 'path'),
            $args['params'] ?? [],
        ));
    }
}
