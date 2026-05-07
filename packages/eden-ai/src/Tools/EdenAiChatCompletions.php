<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

/**
 * Create a V3 OpenAI-compatible chat completion through Eden AI.
 */
class EdenAiChatCompletions extends AbstractEdenAiTool
{
    public const NAME = 'edenai_chat_completions';
    public const DESCRIPTION = 'Create a V3 OpenAI-compatible chat completion through Eden AI.';
    public const PARAMETERS = [
        'model' => ['type' => 'string', 'required' => true, 'description' => 'Model ID such as openai/gpt-4o or anthropic/claude-sonnet-4-5.'],
        'messages' => ['type' => 'array', 'required' => true, 'description' => 'OpenAI-compatible message objects.'],
        'fallbacks' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Fallback model IDs to try in order.'],
        'temperature' => ['type' => 'number', 'description' => 'Sampling temperature.'],
        'max_tokens' => ['type' => 'integer', 'description' => 'Maximum generated tokens.'],
        'extra' => ['type' => 'object', 'description' => 'Additional chat completion parameters.'],
    ];

    /**
     * Create a chat completion.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        $body = $this->arrayArg($args, 'extra') + [
            'model' => $this->requiredString($args, 'model', 'model'),
            'messages' => $this->requiredArray($args, 'messages', 'messages'),
        ];

        foreach (['fallbacks', 'temperature', 'max_tokens'] as $key) {
            if (array_key_exists($key, $args)) {
                $body[$key] = $args[$key];
            }
        }

        return $this->service->chatCompletions($body);
    }
}
