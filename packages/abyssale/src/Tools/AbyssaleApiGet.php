<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a documented Abyssale GET endpoint not yet wrapped by a named tool.
 */
class AbyssaleApiGet extends AbstractAbyssaleTool implements Tool
{
    public function name(): string
    {
        return 'abyssale_api_get';
    }

    public function description(): string
    {
        return 'Call a documented Abyssale GET API path. Prefer named tools when one exists.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'API path, for example /designs.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    /**
     * Execute the generic GET request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiGet(
            $this->requiredString($args, 'path', 'Path'),
            $this->arrayArg($args, 'params'),
        ));
    }
}
