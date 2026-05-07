<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a RingCentral message store record.
 */
class RingCentralUpdateMessage extends AbstractRingCentralTool implements Tool
{
    public function name(): string
    {
        return 'ringcentral_update_message';
    }

    public function description(): string
    {
        return 'Update a RingCentral message store record, commonly to set readStatus to Read or Unread.';
    }

    public function parameters(): array
    {
        return [
            'message_id' => ['type' => 'string', 'required' => true, 'description' => 'Message record ID.'],
            'readStatus' => ['type' => 'string', 'description' => 'Read or Unread.'],
            'payload' => ['type' => 'object', 'description' => 'Additional official message update fields.'],
        ];
    }

    /**
     * Update a message record.
     *
     * @param  array<string, mixed>  $args  Tool arguments (message_id, readStatus, payload)
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
            if (isset($args['readStatus'])) {
                $payload['readStatus'] = $args['readStatus'];
            }
            if ($payload === []) {
                return ToolResult::error('At least one update field is required.');
            }

            return ToolResult::success($this->service->updateMessage((string) $args['message_id'], $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
