<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Webex room.
 */
class WebexCreateRoom extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_create_room';
    }

    public function description(): string
    {
        return 'Create a Webex room or team room.';
    }

    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'Room title.'],
            'teamId' => ['type' => 'string', 'description' => 'Optional team ID for a team room.'],
            'classificationId' => ['type' => 'string', 'description' => 'Optional classification ID when enabled.'],
            'payload' => ['type' => 'object', 'description' => 'Additional official room fields.'],
        ];
    }

    /**
     * Create a room.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['title'])) {
                return ToolResult::error('title is required.');
            }

            $payload = is_array($args['payload'] ?? null) ? $args['payload'] : [];
            $payload = array_merge($payload, $this->only($args, ['title', 'teamId', 'classificationId']));

            return ToolResult::success($this->service->createRoom($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
