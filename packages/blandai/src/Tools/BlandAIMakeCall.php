<?php

namespace OpenCompany\Integrations\BlandAI\Tools;

use OpenCompany\Integrations\BlandAI\BlandAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send a Bland AI phone call.
 *
 * Initiates an AI-powered phone call via the BlandAI API.
 * The AI agent will follow the provided task instructions during the call
 * using the specified (or default) voice.
 */
class BlandAIMakeCall implements Tool
{
    public function __construct(
        private BlandAIService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'blandai_make_call';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Initiate an AI-powered phone call via BlandAI. The AI agent will follow the provided task instructions and speak using the specified voice.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'phone_number' => ['type' => 'string', 'required' => true, 'description' => 'The phone number to call in E.164 format (e.g., "+1234567890").'],
            'task' => ['type' => 'string', 'description' => 'Instructions or task description for the AI agent to follow during the call.'],
            'pathway_id' => ['type' => 'string', 'description' => 'Conversational pathway ID. Required when task is omitted.'],
            'voice' => ['type' => 'string', 'description' => 'Voice identifier to use for the call (e.g., a voice name or ID). Leave empty for the default voice.'],
            'first_sentence' => ['type' => 'string', 'description' => 'Optional first sentence the AI should say.'],
            'model' => ['type' => 'string', 'description' => 'Optional model name.'],
            'language' => ['type' => 'string', 'description' => 'Optional call language.'],
            'wait_for_greeting' => ['type' => 'boolean', 'description' => 'Whether to wait for the callee to speak first before the AI begins (default: false).'],
            'record' => ['type' => 'boolean', 'description' => 'Whether to record the call (default: true).'],
            'max_duration' => ['type' => 'integer', 'description' => 'Maximum call duration in minutes.'],
            'from' => ['type' => 'string', 'description' => 'Outbound caller ID number.'],
            'request_data' => ['type' => 'object', 'description' => 'Variables available to the call agent.'],
            'metadata' => ['type' => 'object', 'description' => 'Metadata stored with the call.'],
            'webhook' => ['type' => 'string', 'description' => 'Webhook URL for call events.'],
        ];
    }

    /**
     * Execute the tool — initiate a phone call.
     *
     * @param  array  $args  Tool arguments matching the parameter schema.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BlandAI integration is not configured.');
            }

            if (empty($args['phone_number'])) {
                return ToolResult::error('phone_number is required.');
            }
            if (empty($args['task']) && empty($args['pathway_id'])) {
                return ToolResult::error('Either task or pathway_id is required.');
            }

            $params = array_intersect_key($args, array_flip([
                'phone_number',
                'task',
                'pathway_id',
                'pathway_version',
                'voice',
                'first_sentence',
                'model',
                'language',
                'wait_for_greeting',
                'record',
                'max_duration',
                'from',
                'request_data',
                'metadata',
                'webhook',
                'tools',
                'transfer_phone_number',
                'summary_prompt',
                'keywords',
                'background_track',
                'noise_cancellation',
                'block_interruptions',
            ]));

            $result = $this->service->sendCall($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
