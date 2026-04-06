<?php

namespace OpenCompany\Integrations\Retell\Tools;

use OpenCompany\Integrations\Retell\RetellService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: retell_create_phone_call
 *
 * Initiate a new AI-powered phone call via Retell AI.
 *
 * @see https://docs.retellai.com/api-reference/create-phone-call
 */
class RetellCreatePhoneCall implements Tool
{
    /**
     * Create a new RetellCreatePhoneCall tool instance.
     */
    public function __construct(
        private RetellService $service,
    ) {}

    /**
     * The tool identifier used for registration and routing.
     */
    public function name(): string
    {
        return 'retell_create_phone_call';
    }

    /**
     * Human-readable description shown to AI agents and in tool listings.
     */
    public function description(): string
    {
        return 'Create a new AI-powered phone call using a Retell AI agent. The agent will handle the conversation automatically.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'agent_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the Retell AI agent to use for the call.'],
            'metadata' => ['type' => 'object', 'description' => 'Optional metadata to attach to the call (e.g., customer info, call purpose). Pass as a JSON object.'],
            'retell_llm_dynamic_variables' => ['type' => 'object', 'description' => 'Optional dynamic variables to inject into the agent\'s LLM prompt at runtime. Pass as a JSON object with string key-value pairs.'],
        ];
    }

    /**
     * Execute the create-phone-call tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Retell AI integration is not configured.');
            }

            if (empty($args['agent_id'])) {
                return ToolResult::error('agent_id is required.');
            }

            $metadata = null;
            if (isset($args['metadata'])) {
                $metadata = is_string($args['metadata'])
                    ? json_decode($args['metadata'], true)
                    : $args['metadata'];
            }

            $dynamicVariables = null;
            if (isset($args['retell_llm_dynamic_variables'])) {
                $dynamicVariables = is_string($args['retell_llm_dynamic_variables'])
                    ? json_decode($args['retell_llm_dynamic_variables'], true)
                    : $args['retell_llm_dynamic_variables'];
            }

            $result = $this->service->createPhoneCall(
                agentId: $args['agent_id'],
                metadata: $metadata,
                retellLlmDynamicVariables: $dynamicVariables,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
