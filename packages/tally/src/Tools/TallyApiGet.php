<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a documented Tally GET endpoint that is not yet wrapped by a named tool.
 */
class TallyApiGet extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_api_get';
    }

    public function description(): string
    {
        return 'Call a documented Tally GET API path. Prefer named Tally tools when one exists.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'API path, for example /forms.'],
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
            is_array($args['params'] ?? null) ? $args['params'] : [],
        ));
    }
}
