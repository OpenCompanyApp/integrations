<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

use OpenCompany\Integrations\EdenAi\EdenAiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generate text using AI models through Eden AI.
 *
 * Sends a text generation request to one or more AI providers via the
 * Eden AI aggregation API. Supports providers like OpenAI, Anthropic,
 * Google, Mistral, Cohere, and more.
 */
class EdenAiGenerateText implements Tool
{
    public function __construct(
        private EdenAiService $service,
    ) {}

    public function name(): string
    {
        return 'edenai_generate_text';
    }

    public function description(): string
    {
        return 'Generate text using AI models via Eden AI. Supports providers like OpenAI (GPT-4), Anthropic (Claude), Google (Gemini), Mistral, Cohere, and more. You can send a single prompt or a conversation history.';
    }

    public function parameters(): array
    {
        return [
            'providers' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated list of AI providers (e.g., "openai", "openai,anthropic", "google"). Use "openai" for GPT-4, "anthropic" for Claude, "google" for Gemini, "mistral" for Mistral, "cohere" for Cohere.'],
            'text' => ['type' => 'string', 'description' => 'The prompt text to send to the AI. Use this for simple single-turn generation.'],
            'conversation' => ['type' => 'array', 'description' => 'Conversation history as an array of message objects with "role" (system, user, assistant) and "message" keys. Use this for multi-turn conversations.'],
            'temperature' => ['type' => 'number', 'description' => 'Sampling temperature (0.0–1.0). Higher values increase randomness. Default: 0.0.'],
            'max_tokens' => ['type' => 'integer', 'description' => 'Maximum number of tokens to generate in the response.'],
            'fallback_providers' => ['type' => 'string', 'description' => 'Comma-separated list of fallback providers if the primary provider fails.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Eden AI integration is not configured.');
            }

            $body = [
                'providers' => $args['providers'],
            ];

            if (isset($args['text'])) {
                $body['text'] = $args['text'];
            } elseif (isset($args['conversation'])) {
                $body['conversation'] = $args['conversation'];
            } else {
                return ToolResult::error('Either "text" or "conversation" is required.');
            }

            if (isset($args['temperature'])) {
                $body['temperature'] = (float) $args['temperature'];
            }

            if (isset($args['max_tokens'])) {
                $body['max_tokens'] = (int) $args['max_tokens'];
            }

            if (isset($args['fallback_providers'])) {
                $body['fallback_providers'] = $args['fallback_providers'];
            }

            $result = $this->service->generateText($body);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the text generation response.
     *
     * @param  array<string, mixed>  $result  Raw API response.
     * @return array<string, mixed> Formatted response with provider results.
     */
    private function formatResponse(array $result): array
    {
        $response = [];

        foreach ($result as $providerKey => $providerResult) {
            if (!is_array($providerResult)) {
                continue;
            }

            $entry = [
                'provider' => $providerKey,
            ];

            if (isset($providerResult['generated_text'])) {
                $entry['text'] = $providerResult['generated_text'];
            }

            if (isset($providerResult['status'])) {
                $entry['status'] = $providerResult['status'];
            }

            if (isset($providerResult['cost'])) {
                $entry['cost'] = $providerResult['cost'];
            }

            if (isset($providerResult['error'])) {
                $entry['error'] = $providerResult['error'];
            }

            $response[] = $entry;
        }

        return [
            'results' => $response,
            'providerCount' => count($response),
        ];
    }
}
