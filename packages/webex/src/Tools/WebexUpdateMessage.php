<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Webex message.
 */
class WebexUpdateMessage extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_update_message';
    }

    public function description(): string
    {
        return 'Update an existing Webex message with text, markdown, or official message fields.';
    }

    public function parameters(): array
    {
        return [
            'message_id' => ['type' => 'string', 'required' => true, 'description' => 'Message ID.'],
            'text' => ['type' => 'string', 'description' => 'Plain-text message content.'],
            'markdown' => ['type' => 'string', 'description' => 'Markdown message content.'],
            'payload' => ['type' => 'object', 'description' => 'Additional official message update fields.'],
        ];
    }

    /**
     * Update a message.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['message_id'])) {
                return ToolResult::error('message_id is required.');
            }

            $payload = is_array($args['payload'] ?? null) ? $args['payload'] : [];
            $payload = array_merge($payload, $this->only($args, ['text', 'markdown']));
            if ($payload === []) {
                return ToolResult::error('At least one update field is required.');
            }

            return ToolResult::success($this->service->updateMessage((string) $args['message_id'], $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
