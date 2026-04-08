<?php

namespace OpenCompany\Integrations\Telnyx\Tools;

use OpenCompany\Integrations\Telnyx\TelnyxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific voice call on the Telnyx account.
 *
 * Returns call session details including participants, status, duration, and metadata.
 */
class TelnyxGetCall implements Tool
{
    /**
     * @param  TelnyxService  $service  The Telnyx API client
     */
    public function __construct(
        private TelnyxService $service,
    ) {}

    public function name(): string
    {
        return 'telnyx_get_call';
    }

    public function description(): string
    {
        return 'Get details for a specific voice call by its call session ID. Returns participants, status, duration, and call metadata.';
    }

    public function parameters(): array
    {
        return [
            'call_session_id' => ['type' => 'string', 'required' => true, 'description' => 'The Telnyx call session ID (e.g., "0ccc7b54-4e3a-4fa1-8c3f-5d2e3f4g5h6i").'],
        ];
    }

    /**
     * Get details for a specific voice call.
     *
     * @param  array<string, mixed>  $args  Tool arguments (call_session_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Telnyx integration is not configured.');
            }

            $callSessionId = $args['call_session_id'] ?? '';

            if (empty($callSessionId)) {
                return ToolResult::error('call_session_id is required.');
            }

            $result = $this->service->getCall($callSessionId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
