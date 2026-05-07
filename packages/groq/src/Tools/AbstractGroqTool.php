<?php

namespace OpenCompany\Integrations\Groq\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Groq\GroqService;

/**
 * Shared executor for straightforward Groq service-backed tools.
 *
 * Child classes declare argument mapping and the GroqService method to call.
 */
abstract class AbstractGroqTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const METHOD = '';
    protected const ARGUMENTS = [];
    protected const REQUIRED = [];
    protected const USE_QUERY = false;
    protected const USE_PAYLOAD = false;

    /**
     * @param  GroqService  $service  Groq API client.
     */
    public function __construct(protected GroqService $service) {}

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
                'description' => 'Query string parameters supported by the Groq endpoint.',
            ];
        }

        if (static::USE_PAYLOAD) {
            $parameters['payload'] = [
                'type' => 'object',
                'required' => in_array('payload', static::REQUIRED, true),
                'description' => 'JSON request payload supported by the Groq endpoint.',
            ];
        }

        return $parameters;
    }

    /**
     * Execute the mapped Groq API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Groq integration is not configured.');
            }

            foreach (static::REQUIRED as $required) {
                if (!isset($args[$required]) || $args[$required] === '') {
                    return ToolResult::error("{$required} is required.");
                }
            }

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

            $method = static::METHOD;

            return ToolResult::success($this->service->{$method}(...$parameters));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
