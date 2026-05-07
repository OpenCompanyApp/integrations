<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Webex message.
 */
class WebexDeleteMessage extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_delete_message';
    }

    public function description(): string
    {
        return 'Delete a Webex message by message ID.';
    }

    public function parameters(): array
    {
        return [
            'message_id' => ['type' => 'string', 'required' => true, 'description' => 'Message ID.'],
        ];
    }

    /**
     * Delete a message.
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

            return ToolResult::success($this->service->deleteMessage((string) $args['message_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
