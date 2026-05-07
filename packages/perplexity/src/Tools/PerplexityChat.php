<?php

namespace OpenCompany\Integrations\Perplexity\Tools;

use OpenCompany\Integrations\Perplexity\PerplexityService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Perplexity Sonar chat completion.
 *
 * Supports multi-turn messages, search controls, citations, and normalized response output.
 */
class PerplexityChat implements Tool
{
    /**
     * @param  PerplexityService  $service  The Perplexity API client.
     */
    public function __construct(
        private PerplexityService $service,
    ) {}

    public function name(): string
    {
        return 'perplexity_chat';
    }

    public function description(): string
    {
        return 'Create a Perplexity Sonar chat completion. Supports multi-turn conversations, web search controls, citations, images, and related questions.';
    }

    public function parameters(): array
    {
        return [
            'messages' => ['type' => 'array', 'required' => true, 'description' => 'Array of message objects, each with "role" (system, user, or assistant) and "content" (string). Example: [{"role": "user", "content": "What is AI?"}].'],
            'model' => ['type' => 'string', 'description' => 'Sonar model to use. Common values: "sonar", "sonar-pro", "sonar-deep-research", "sonar-reasoning-pro". Defaults to "sonar".'],
            'temperature' => ['type' => 'number', 'description' => 'Sampling temperature (0.0–2.0). Lower values are more focused, higher values more creative. Defaults to 0.2.'],
            'top_p' => ['type' => 'number', 'description' => 'Nucleus sampling value between 0 and 1.'],
            'max_tokens' => ['type' => 'integer', 'description' => 'Maximum number of tokens in the response.'],
            'stop' => ['type' => 'array', 'description' => 'Stop sequence string or array of stop sequences.'],
            'response_format' => ['type' => 'object', 'description' => 'Optional response format object, including JSON schema formats supported by Sonar.'],
            'web_search_options' => ['type' => 'object', 'description' => 'Current Perplexity web search options object. Use this for advanced search/image/date filters.'],
            'search_mode' => ['type' => 'string', 'description' => 'Convenience web search option: "web", "academic", or "sec".'],
            'search_domain_filter' => ['type' => 'array', 'description' => 'Convenience web search option: domains to limit search results to (e.g., ["wikipedia.org"]).'],
            'search_language_filter' => ['type' => 'array', 'description' => 'Convenience web search option: ISO 639-1 language codes.'],
            'search_recency_filter' => ['type' => 'string', 'description' => 'Convenience web search option: "hour", "day", "week", "month", or "year".'],
            'return_images' => ['type' => 'boolean', 'description' => 'Convenience web search option: include image results.'],
            'return_related_questions' => ['type' => 'boolean', 'description' => 'Convenience web search option: include related questions.'],
            'disable_search' => ['type' => 'boolean', 'description' => 'Convenience web search option: disable web search.'],
            'reasoning_effort' => ['type' => 'string', 'description' => 'Reasoning effort for supported models: "minimal", "low", "medium", or "high".'],
            'language_preference' => ['type' => 'string', 'description' => 'Preferred response language as an ISO 639-1 code.'],
        ];
    }

    /**
     * Create a Sonar chat completion from message arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Perplexity integration is not configured.');
            }

            $messages = $args['messages'] ?? null;

            if (! is_array($messages) || empty($messages)) {
                return ToolResult::error('messages must be a non-empty array of message objects.');
            }

            $model = $args['model'] ?? 'sonar';
            $options = $this->buildOptions($args);

            $result = $this->service->chat($messages, $model, $options);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Build Sonar request options from tool arguments.
     *
     * @param  array<string, mixed>  $args
     * @return array<string, mixed>
     */
    private function buildOptions(array $args): array
    {
        $options = [];

        foreach (['temperature', 'top_p', 'max_tokens', 'stop', 'response_format', 'reasoning_effort', 'language_preference'] as $key) {
            if (array_key_exists($key, $args)) {
                $options[$key] = $args[$key];
            }
        }

        $webSearchOptions = $args['web_search_options'] ?? [];
        $webKeys = [
            'search_mode',
            'search_domain_filter',
            'search_language_filter',
            'search_recency_filter',
            'return_images',
            'return_related_questions',
            'disable_search',
        ];

        foreach ($webKeys as $key) {
            if (array_key_exists($key, $args)) {
                $webSearchOptions[$key] = $args[$key];
            }
        }

        if ($webSearchOptions !== []) {
            $options['web_search_options'] = $webSearchOptions;
        }

        return $options;
    }

    /**
     * Format the chat completion response.
     *
     * @param  array<string, mixed>  $result
     * @return array<string, mixed>
     */
    private function formatResponse(array $result): array
    {
        $response = [];

        $response['model'] = $result['model'] ?? '';
        $response['id'] = $result['id'] ?? '';

        $choices = $result['choices'] ?? [];
        if (! empty($choices)) {
            $choice = $choices[0];
            $message = $choice['message'] ?? [];
            $response['content'] = $message['content'] ?? '';
            $response['role'] = $message['role'] ?? 'assistant';
            $response['finish_reason'] = $choice['finish_reason'] ?? '';
        }

        $usage = $result['usage'] ?? [];
        if (! empty($usage)) {
            $response['usage'] = [
                'prompt_tokens' => $usage['prompt_tokens'] ?? 0,
                'completion_tokens' => $usage['completion_tokens'] ?? 0,
                'total_tokens' => $usage['total_tokens'] ?? 0,
                'cost' => $usage['cost'] ?? null,
            ];
        }

        if (isset($result['citations'])) {
            $response['citations'] = $result['citations'];
        }

        if (isset($result['search_results'])) {
            $response['search_results'] = $result['search_results'];
        }

        if (isset($result['images'])) {
            $response['images'] = $result['images'];
        }

        if (isset($result['related_questions'])) {
            $response['related_questions'] = $result['related_questions'];
        }

        return $response;
    }
}
