<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a RingCentral message store record.
 */
class RingCentralDeleteMessage extends AbstractRingCentralTool implements Tool
{
    public function name(): string
    {
        return 'ringcentral_delete_message';
    }

    public function description(): string
    {
        return 'Delete a message from the authenticated extension\'s RingCentral message store.';
    }

    public function parameters(): array
    {
        return [
            'message_id' => ['type' => 'string', 'required' => true, 'description' => 'Message record ID.'],
        ];
    }

    /**
     * Delete a message record.
     *
     * @param  array<string, mixed>  $args  Tool arguments (message_id)
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
