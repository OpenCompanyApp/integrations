<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send a PATCH request to a relative Fellow API path.
 */
class FellowApiPatch extends AbstractFellowTool implements Tool
{
    public function name(): string
    {
        return 'fellow_api_patch';
    }

    public function description(): string
    {
        return 'Call a relative Fellow API PATCH path for documented endpoints without a first-class tool.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative path such as /webhook/{id}. Absolute URLs are rejected.'],
            'payload' => ['type' => 'object', 'description' => 'JSON request body.'],
        ];
    }

    /**
     * Execute the generic PATCH tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path, payload).
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiPatch(
            $this->requiredString($args, 'path'),
            $args['payload'] ?? [],
        ));
    }
}
