<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a documented Abyssale POST endpoint not yet wrapped by a named tool.
 */
class AbyssaleApiPost extends AbstractAbyssaleTool implements Tool
{
    public function name(): string
    {
        return 'abyssale_api_post';
    }

    public function description(): string
    {
        return 'Call a documented Abyssale POST API path. Prefer named tools when one exists.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'API path, for example /projects.'],
            'payload' => ['type' => 'object', 'description' => 'JSON request body.'],
        ];
    }

    /**
     * Execute the generic POST request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiPost(
            $this->requiredString($args, 'path', 'Path'),
            $this->arrayArg($args, 'payload'),
        ));
    }
}
