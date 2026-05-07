<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send an advanced SignNow invite payload.
 */
class SignNowSendFreeformInvite extends AbstractSignNowTool implements Tool
{
    public function name(): string
    {
        return 'signnow_send_freeform_invite';
    }

    public function description(): string
    {
        return 'Send a SignNow invite using a full official payload for advanced recipient, role, routing, and reminder setups.';
    }

    public function parameters(): array
    {
        return [
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Document ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Full official invite payload.'],
        ];
    }

    /**
     * Send a free-form invite.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['document_id'])) {
                return ToolResult::error('document_id is required.');
            }
            if (!is_array($args['payload'] ?? null) || $args['payload'] === []) {
                return ToolResult::error('payload is required.');
            }

            return ToolResult::success($this->service->sendFreeformInvite((string) $args['document_id'], $args['payload']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
