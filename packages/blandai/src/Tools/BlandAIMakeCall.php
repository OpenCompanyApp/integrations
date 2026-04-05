<?php

namespace OpenCompany\Integrations\BlandAI\Tools;

use OpenCompany\Integrations\BlandAI\BlandAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: BlandAI Make Call
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
            'task' => ['type' => 'string', 'required' => true, 'description' => 'Instructions or task description for the AI agent to follow during the call.'],
            'voice' => ['type' => 'string', 'description' => 'Voice identifier to use for the call (e.g., a voice name or ID). Leave empty for the default voice.'],
            'wait_for_greeting' => ['type' => 'boolean', 'description' => 'Whether to wait for the callee to speak first before the AI begins (default: false).'],
            'record' => ['type' => 'boolean', 'description' => 'Whether to record the call (default: true).'],
            'max_duration' => ['type' => 'integer', 'description' => 'Maximum call duration in minutes.'],
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

            $phoneNumber = $args['phone_number'];
            $task = $args['task'];
            $voice = $args['voice'] ?? null;

            $options = [];
            if (isset($args['wait_for_greeting'])) {
                $options['wait_for_greeting'] = (bool) $args['wait_for_greeting'];
            }
            if (isset($args['record'])) {
                $options['record'] = (bool) $args['record'];
            }
            if (isset($args['max_duration'])) {
                $options['max_duration'] = (int) $args['max_duration'];
            }

            $result = $this->service->makeCall($phoneNumber, $task, $voice, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
