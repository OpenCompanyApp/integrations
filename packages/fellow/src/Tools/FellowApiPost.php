<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send a POST request to a relative Fellow API path.
 */
class FellowApiPost extends AbstractFellowTool implements Tool
{
    public function name(): string
    {
        return 'fellow_api_post';
    }

    public function description(): string
    {
        return 'Call a relative Fellow API POST path for documented endpoints without a first-class tool.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative path such as /notes. Absolute URLs are rejected.'],
            'payload' => ['type' => 'object', 'description' => 'JSON request body.'],
        ];
    }

    /**
     * Execute the generic POST tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path, payload).
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiPost(
            $this->requiredString($args, 'path'),
            $args['payload'] ?? [],
        ));
    }
}
