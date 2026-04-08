<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

use OpenCompany\Integrations\GoogleGemini\GeminiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GeminiGenerateContent implements Tool
{
    public function __construct(
        private GeminiService $service,
    ) {}

    public function name(): string
    {
        return 'gemini_generate_content';
    }

    public function description(): string
    {
        return 'Generate content using a Gemini model. Send text prompts and receive AI-generated responses. Supports configurable generation parameters like temperature, topP, and maxOutputTokens.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The model resource name (e.g., "models/gemini-2.0-flash" or "models/gemini-pro").'],
            'contents' => ['type' => 'array', 'required' => true, 'description' => 'Array of content parts. Each entry should have a "role" ("user" or "model") and "parts" array with objects like {"text": "Your prompt here"}.'],
            'temperature' => ['type' => 'number', 'description' => 'Controls randomness in generation (0.0–2.0). Lower values are more deterministic, higher values more creative.'],
            'topP' => ['type' => 'number', 'description' => 'Nucleus sampling parameter (0.0–1.0). Limits cumulative probability of tokens considered.'],
            'maxOutputTokens' => ['type' => 'integer', 'description' => 'Maximum number of tokens to generate in the response.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Gemini integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Model id is required.');
            }

            if (empty($args['contents'])) {
                return ToolResult::error('contents is required.');
            }

            $generationConfig = [];
            if (isset($args['temperature'])) {
                $generationConfig['temperature'] = (float) $args['temperature'];
            }
            if (isset($args['topP'])) {
                $generationConfig['topP'] = (float) $args['topP'];
            }
            if (isset($args['maxOutputTokens'])) {
                $generationConfig['maxOutputTokens'] = (int) $args['maxOutputTokens'];
            }

            $result = $this->service->generateContent(
                $args['id'],
                $args['contents'],
                $generationConfig,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
