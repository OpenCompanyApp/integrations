<?php

namespace OpenCompany\Integrations\Perplexity\Tools;

use OpenCompany\Integrations\Perplexity\PerplexityService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PerplexityChat implements Tool
{
    public function __construct(
        private PerplexityService $service,
    ) {}

    public function name(): string
    {
        return 'perplexity_chat';
    }

    public function description(): string
    {
        return 'Send messages to Perplexity AI for a chat completion response. Supports multi-turn conversations with message history. Returns the assistant response with optional citations and search results.';
    }

    public function parameters(): array
    {
        return [
            'messages' => ['type' => 'array', 'required' => true, 'description' => 'Array of message objects, each with "role" (system, user, or assistant) and "content" (string). Example: [{"role": "user", "content": "What is AI?"}].'],
            'model' => ['type' => 'string', 'description' => 'Model to use: "sonar" (fast, lightweight), "sonar-pro" (advanced), "sonar-reasoning" (reasoning), or "sonar-reasoning-pro" (advanced reasoning). Defaults to "sonar".'],
            'temperature' => ['type' => 'number', 'description' => 'Sampling temperature (0.0–2.0). Lower values are more focused, higher values more creative. Defaults to 0.2.'],
            'max_tokens' => ['type' => 'integer', 'description' => 'Maximum number of tokens in the response.'],
            'search_domain_filter' => ['type' => 'array', 'description' => 'List of domains to limit search results to (e.g., ["wikipedia.org"]). Pass empty array to exclude, or omit for no filter.'],
            'return_images' => ['type' => 'boolean', 'description' => 'Whether to return images in the response. Defaults to false.'],
            'return_related_questions' => ['type' => 'boolean', 'description' => 'Whether to return related questions. Defaults to false.'],
            'search_recency_filter' => ['type' => 'string', 'description' => 'Filter search results by recency: "month", "week", "day", or "hour".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Perplexity integration is not configured.');
            }

            $messages = $args['messages'];

            if (!is_array($messages) || empty($messages)) {
                return ToolResult::error('messages must be a non-empty array of message objects.');
            }

            $model = $args['model'] ?? 'sonar';
            $options = [];

            if (isset($args['temperature'])) {
                $options['temperature'] = (float) $args['temperature'];
            }
            if (isset($args['max_tokens'])) {
                $options['max_tokens'] = (int) $args['max_tokens'];
            }
            if (isset($args['search_domain_filter'])) {
                $options['search_domain_filter'] = $args['search_domain_filter'];
            }
            if (isset($args['return_images'])) {
                $options['return_images'] = (bool) $args['return_images'];
            }
            if (isset($args['return_related_questions'])) {
                $options['return_related_questions'] = (bool) $args['return_related_questions'];
            }
            if (isset($args['search_recency_filter'])) {
                $options['search_recency_filter'] = $args['search_recency_filter'];
            }

            $result = $this->service->chat($messages, $model, $options);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
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

        // Extract the assistant message content
        $choices = $result['choices'] ?? [];
        if (!empty($choices)) {
            $choice = $choices[0];
            $message = $choice['message'] ?? [];
            $response['content'] = $message['content'] ?? '';
            $response['role'] = $message['role'] ?? 'assistant';
            $response['finish_reason'] = $choice['finish_reason'] ?? '';
        }

        // Usage statistics
        $usage = $result['usage'] ?? [];
        if (!empty($usage)) {
            $response['usage'] = [
                'prompt_tokens' => $usage['prompt_tokens'] ?? 0,
                'completion_tokens' => $usage['completion_tokens'] ?? 0,
                'total_tokens' => $usage['total_tokens'] ?? 0,
            ];
        }

        // Citations
        if (isset($result['citations'])) {
            $response['citations'] = $result['citations'];
        }

        // Search results
        if (isset($result['search_results'])) {
            $response['search_results'] = $result['search_results'];
        }

        return $response;
    }
}
