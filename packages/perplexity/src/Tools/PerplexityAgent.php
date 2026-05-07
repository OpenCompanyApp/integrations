<?php

namespace OpenCompany\Integrations\Perplexity\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Perplexity\PerplexityService;

/**
 * Create a Perplexity Agent API response.
 *
 * Supports Perplexity's response-style endpoint for web-search and reasoning workflows.
 */
class PerplexityAgent implements Tool
{
    /**
     * @param  PerplexityService  $service  The Perplexity API client.
     */
    public function __construct(
        private PerplexityService $service,
    ) {}

    public function name(): string
    {
        return 'perplexity_agent';
    }

    public function description(): string
    {
        return 'Create a Perplexity Agent API response for an input prompt with optional model and tool configuration.';
    }

    public function parameters(): array
    {
        return [
            'input' => ['type' => 'string', 'required' => true, 'description' => 'Input prompt for the Agent API.'],
            'model' => ['type' => 'string', 'description' => 'Optional Agent API model id from list_models.'],
            'instructions' => ['type' => 'string', 'description' => 'Optional high-level instructions for the agent response.'],
            'tools' => ['type' => 'array', 'description' => 'Optional Agent API tools array.'],
            'temperature' => ['type' => 'number', 'description' => 'Optional sampling temperature.'],
            'max_output_tokens' => ['type' => 'integer', 'description' => 'Optional maximum output tokens.'],
        ];
    }

    /**
     * Create an Agent API response.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Perplexity integration is not configured.');
            }

            if (empty($args['input'])) {
                return ToolResult::error('input is required.');
            }

            $payload = ['input' => $args['input']];
            foreach (['model', 'instructions', 'tools', 'temperature', 'max_output_tokens'] as $key) {
                if (array_key_exists($key, $args)) {
                    $payload[$key] = $args[$key];
                }
            }

            return ToolResult::success($this->service->agent($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
