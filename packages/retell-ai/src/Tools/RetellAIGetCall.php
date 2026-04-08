<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

use OpenCompany\Integrations\RetellAI\RetellAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve details for a specific phone call by its ID.
 *
 * Returns call status, duration, transcript, and other metadata
 * for a previously created call.
 */
class RetellAIGetCall implements Tool
{
    public function __construct(
        private RetellAIService $service,
    ) {}

    public function name(): string
    {
        return 'retell_ai_get_call';
    }

    public function description(): string
    {
        return 'Retrieve details for a specific phone call by its ID. Returns call status, duration, transcript, and associated metadata.';
    }

    public function parameters(): array
    {
        return [
            'call_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the call to retrieve (e.g., "call_17a9b81c3c0").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Retell AI integration is not configured.');
            }

            $callId = $args['call_id'];

            if (empty($callId)) {
                return ToolResult::error('call_id is required.');
            }

            $result = $this->service->getCall($callId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
