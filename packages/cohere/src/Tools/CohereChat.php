<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generate a response with Cohere v2 Chat.
 *
 * Supports messages, documents, tool definitions, JSON response format,
 * safety controls, sampling controls, and reasoning configuration.
 */
class CohereChat extends AbstractCohereTool implements Tool
{
    public function name(): string
    {
        return 'cohere_chat';
    }

    public function description(): string
    {
        return 'Generate a non-streaming response with Cohere v2 Chat. Supports messages, documents, tools, citations, JSON response format, safety mode, sampling controls, and reasoning configuration.';
    }

    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'required' => true, 'description' => 'Cohere chat model ID, for example command-a-03-2025.'],
            'messages' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'object'], 'description' => 'Chronological chat messages with user, assistant, system, or tool roles.'],
            'stream' => ['type' => 'boolean', 'description' => 'Must be false or omitted. Streaming SSE is not supported by this tool.'],
            'tools' => ['type' => 'array', 'items' => ['type' => 'object'], 'description' => 'Tool/function definitions available to the model.'],
            'documents' => ['type' => 'array', 'description' => 'Relevant documents as strings or objects for citation-aware generation.'],
            'citation_options' => ['type' => 'object', 'description' => 'Citation generation options.'],
            'response_format' => ['type' => 'object', 'description' => 'Response format control, such as json_object with optional JSON schema.'],
            'safety_mode' => ['type' => 'string', 'enum' => ['CONTEXTUAL', 'STRICT', 'OFF'], 'description' => 'Safety instruction mode for compatible models.'],
            'max_tokens' => ['type' => 'integer', 'description' => 'Maximum output tokens.'],
            'stop_sequences' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Up to five stop strings.'],
            'temperature' => ['type' => 'number', 'description' => 'Sampling temperature.'],
            'seed' => ['type' => 'integer', 'description' => 'Best-effort deterministic seed.'],
            'frequency_penalty' => ['type' => 'number', 'description' => 'Penalty for repeated token frequency.'],
            'presence_penalty' => ['type' => 'number', 'description' => 'Penalty for already-present tokens.'],
            'k' => ['type' => 'integer', 'description' => 'Top-k sampling control.'],
            'p' => ['type' => 'number', 'description' => 'Top-p sampling control.'],
            'logprobs' => ['type' => 'boolean', 'description' => 'Include token log probabilities when supported.'],
            'tool_choice' => ['type' => 'string', 'enum' => ['REQUIRED', 'NONE'], 'description' => 'Force tool use or direct response for compatible models.'],
            'thinking' => ['type' => 'object', 'description' => 'Reasoning feature configuration for supported models.'],
            'priority' => ['type' => 'integer', 'description' => 'Priority from 0 to 999, where lower values are handled earlier.'],
            'strict_tools' => ['type' => 'boolean', 'description' => 'Force tool calls to follow the supplied tool schema strictly.'],
        ];
    }

    /**
     * Execute the Cohere Chat API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments matching Cohere v2 Chat parameters.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cohere integration is not configured.');
            }

            if (($args['stream'] ?? false) === true) {
                return ToolResult::error('stream=true is not supported. Use non-streaming JSON responses with this tool.');
            }

            $this->assertEnum('safety_mode', $args['safety_mode'] ?? null, ['CONTEXTUAL', 'STRICT', 'OFF']);
            $this->assertEnum('tool_choice', $args['tool_choice'] ?? null, ['REQUIRED', 'NONE']);

            $payload = $this->only($args, [
                'model',
                'messages',
                'stream',
                'tools',
                'documents',
                'citation_options',
                'response_format',
                'safety_mode',
                'max_tokens',
                'stop_sequences',
                'temperature',
                'seed',
                'frequency_penalty',
                'presence_penalty',
                'k',
                'p',
                'logprobs',
                'tool_choice',
                'thinking',
                'priority',
                'strict_tools',
            ]);
            $payload['model'] = $this->requireString($args, 'model');
            $payload['messages'] = $this->requireArray($args, 'messages');
            $payload['stream'] = false;

            return ToolResult::success($this->service->chat($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
