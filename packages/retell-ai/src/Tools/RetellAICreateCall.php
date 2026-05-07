<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

use OpenCompany\Integrations\RetellAI\RetellAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new AI-powered phone call using a Retell AI agent.
 *
 * This tool initiates an outbound phone call using a configured voice agent.
 * You can attach custom metadata to the call for tracking and context.
 */
class RetellAICreateCall implements Tool
{
    /**
     * @param  RetellAIService  $service  The Retell AI API client.
     */
    public function __construct(
        private RetellAIService $service,
    ) {}

    public function name(): string
    {
        return 'retell_ai_create_call';
    }

    public function description(): string
    {
        return 'Create a new AI-powered phone call using a Retell AI voice agent. Specify the agent ID and optional metadata to attach context to the call.';
    }

    public function parameters(): array
    {
        return [
            'agent_id' => ['type' => 'string', 'required' => true, 'description' => 'The Retell AI agent ID to use for the call (e.g., "agent_17a9b81c3c0").'],
            'metadata' => ['type' => 'object', 'description' => 'Optional key-value metadata to attach to the call for tracking and context (e.g., {"customer_id": "12345", "campaign": "onboarding"}).'],
            'options' => ['type' => 'object', 'description' => 'Additional create-phone-call fields such as from_number, to_number, override_agent_id, and retell_llm_dynamic_variables.'],
        ];
    }

    /**
     * Create a phone call.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Retell AI integration is not configured.');
            }

            $agentId = $args['agent_id'] ?? '';
            $metadata = is_array($args['metadata'] ?? null) ? $args['metadata'] : [];
            $options = is_array($args['options'] ?? null) ? $args['options'] : [];

            if (empty($agentId)) {
                return ToolResult::error('agent_id is required.');
            }

            $result = $this->service->createCall($agentId, $metadata, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
