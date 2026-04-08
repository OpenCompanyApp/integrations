<?php

namespace OpenCompany\Integrations\Retell\Tools;

use OpenCompany\Integrations\Retell\RetellService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: retell_get_call
 *
 * Retrieve details for a specific AI voice call from Retell AI.
 *
 * @see https://docs.retellai.com/api-reference/get-call
 */
class RetellGetCall implements Tool
{
    /**
     * Create a new RetellGetCall tool instance.
     */
    public function __construct(
        private RetellService $service,
    ) {}

    /**
     * The tool identifier used for registration and routing.
     */
    public function name(): string
    {
        return 'retell_get_call';
    }

    /**
     * Human-readable description shown to AI agents and in tool listings.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific AI voice call, including transcript, duration, and status.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'call_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the call (e.g., "call_abcdef123456").'],
        ];
    }

    /**
     * Execute the get-call tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Retell AI integration is not configured.');
            }

            if (empty($args['call_id'])) {
                return ToolResult::error('call_id is required.');
            }

            $result = $this->service->getCall($args['call_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
