<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get one Webex message by ID.
 */
class WebexGetMessage extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_get_message';
    }

    public function description(): string
    {
        return 'Get details for one Webex message by message ID.';
    }

    public function parameters(): array
    {
        return [
            'message_id' => ['type' => 'string', 'required' => true, 'description' => 'Message ID.'],
        ];
    }

    /**
     * Fetch one message.
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

            return ToolResult::success($this->service->getMessage((string) $args['message_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
