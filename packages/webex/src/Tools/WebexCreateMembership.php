<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a person to a Webex room.
 */
class WebexCreateMembership extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_create_membership';
    }

    public function description(): string
    {
        return 'Create a Webex room membership by room ID and person ID or email.';
    }

    public function parameters(): array
    {
        return [
            'roomId' => ['type' => 'string', 'required' => true, 'description' => 'Room ID.'],
            'personId' => ['type' => 'string', 'description' => 'Person ID to add.'],
            'personEmail' => ['type' => 'string', 'description' => 'Person email to add.'],
            'isModerator' => ['type' => 'boolean', 'description' => 'Whether the person should be a moderator.'],
            'payload' => ['type' => 'object', 'description' => 'Additional official membership fields.'],
        ];
    }

    /**
     * Create a room membership.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['roomId'])) {
                return ToolResult::error('roomId is required.');
            }
            if (empty($args['personId']) && empty($args['personEmail'])) {
                return ToolResult::error('personId or personEmail is required.');
            }

            $payload = is_array($args['payload'] ?? null) ? $args['payload'] : [];
            $payload = array_merge($payload, $this->only($args, ['roomId', 'personId', 'personEmail', 'isModerator']));

            return ToolResult::success($this->service->createMembership($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
