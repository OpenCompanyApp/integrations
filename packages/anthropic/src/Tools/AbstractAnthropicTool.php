<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Anthropic\AnthropicService;

/**
 * Shared executor for straightforward Anthropic service-backed tools.
 *
 * Child classes declare operation metadata, required arguments, and whether
 * a request uses a query array or JSON payload.
 */
abstract class AbstractAnthropicTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const METHOD = '';
    protected const ARGUMENTS = [];
    protected const REQUIRED = [];
    protected const USE_QUERY = false;
    protected const USE_PAYLOAD = false;
    protected const ADMIN = false;

    /**
     * @param  AnthropicService  $service  The Anthropic API client.
     */
    public function __construct(
        protected AnthropicService $service,
    ) {}

    public function name(): string
    {
        return static::NAME;
    }

    public function description(): string
    {
        return static::DESCRIPTION;
    }

    public function parameters(): array
    {
        $parameters = [];

        foreach (static::ARGUMENTS as $argument) {
            $parameters[$argument] = [
                'type' => 'string',
                'required' => in_array($argument, static::REQUIRED, true),
                'description' => str_replace('_', ' ', ucfirst($argument)).'.',
            ];
        }

        if (static::USE_QUERY) {
            $parameters['query'] = [
                'type' => 'object',
                'required' => in_array('query', static::REQUIRED, true),
                'description' => 'Query parameters such as limit, before_id, after_id, status, or filters supported by the endpoint.',
            ];
        }

        if (static::USE_PAYLOAD) {
            $parameters['payload'] = [
                'type' => 'object',
                'required' => in_array('payload', static::REQUIRED, true),
                'description' => 'JSON request body for the Anthropic endpoint.',
            ];
        }

        return $parameters;
    }

    /**
     * Execute the Anthropic API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (static::ADMIN && !$this->service->isAdminConfigured()) {
                return ToolResult::error('Anthropic Admin API key is not configured.');
            }

            if (!static::ADMIN && !$this->service->isConfigured()) {
                return ToolResult::error('Anthropic integration is not configured.');
            }

            foreach (static::REQUIRED as $required) {
                if (!isset($args[$required]) || $args[$required] === '') {
                    return ToolResult::error("{$required} is required.");
                }
            }

            $method = static::METHOD;
            $parameters = [];

            foreach (static::ARGUMENTS as $argument) {
                $parameters[] = $args[$argument] ?? '';
            }

            if (static::USE_QUERY) {
                $parameters[] = $args['query'] ?? [];
            }

            if (static::USE_PAYLOAD) {
                $parameters[] = $args['payload'] ?? [];
            }

            return ToolResult::success($this->service->{$method}(...$parameters));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
