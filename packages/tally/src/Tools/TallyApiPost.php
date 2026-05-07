<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a documented Tally POST endpoint that is not yet wrapped by a named tool.
 */
class TallyApiPost extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_api_post';
    }

    public function description(): string
    {
        return 'Call a documented Tally POST API path. Prefer named Tally tools when one exists.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'API path, for example /webhooks.'],
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
            is_array($args['payload'] ?? null) ? $args['payload'] : [],
        ));
    }
}
