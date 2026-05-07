<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Webex team.
 */
class WebexCreateTeam extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_create_team';
    }

    public function description(): string
    {
        return 'Create a Webex team.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Team name.'],
            'payload' => ['type' => 'object', 'description' => 'Additional official team fields.'],
        ];
    }

    /**
     * Create a team.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['name'])) {
                return ToolResult::error('name is required.');
            }

            $payload = is_array($args['payload'] ?? null) ? $args['payload'] : [];
            $payload['name'] = $args['name'];

            return ToolResult::success($this->service->createTeam($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
