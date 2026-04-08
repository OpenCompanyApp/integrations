<?php

namespace OpenCompany\Integrations\Perplexity\Tools;

use OpenCompany\Integrations\Perplexity\PerplexityService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PerplexityAsk implements Tool
{
    public function __construct(
        private PerplexityService $service,
    ) {}

    public function name(): string
    {
        return 'perplexity_ask';
    }

    public function description(): string
    {
        return 'Ask Perplexity AI a question and get a concise answer with cited sources. Best for factual queries, research, and knowledge questions.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'The question or prompt to ask Perplexity AI.'],
            'model' => ['type' => 'string', 'description' => 'Model to use: "sonar", "sonar-pro", "sonar-reasoning", or "sonar-reasoning-pro". Defaults to "sonar".'],
            'temperature' => ['type' => 'number', 'description' => 'Sampling temperature (0.0–2.0). Lower values are more focused. Defaults to 0.2.'],
            'max_tokens' => ['type' => 'integer', 'description' => 'Maximum number of tokens in the response.'],
            'search_domain_filter' => ['type' => 'array', 'description' => 'List of domains to limit search results to (e.g., ["wikipedia.org"]).'],
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

            $query = $args['query'];

            if (empty($query) || !is_string($query)) {
                return ToolResult::error('query must be a non-empty string.');
            }

            $options = [];

            if (isset($args['model'])) {
                $options['model'] = $args['model'];
            }
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

            $result = $this->service->ask($query, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
