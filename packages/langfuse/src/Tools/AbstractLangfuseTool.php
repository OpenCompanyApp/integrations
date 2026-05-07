<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Langfuse\LangfuseService;

/**
 * Shared executor for Langfuse endpoint-specific tools.
 *
 * Keeps configured-state checks, query/body shaping, ID handling, and error
 * conversion consistent while each child class maps to one public API operation.
 */
abstract class AbstractLangfuseTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const SERVICE_METHOD = '';
    protected const MODE = 'none';
    protected const ID_KEY = '';
    protected const SECOND_ID_KEY = '';
    protected const QUERY_KEYS = [];

    /**
     * @param  LangfuseService  $service  Langfuse Public API client.
     */
    public function __construct(
        protected LangfuseService $service,
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
        return static::PARAMETERS;
    }

    /**
     * Execute the mapped Langfuse API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Langfuse integration is not configured.');
            }

            $method = static::SERVICE_METHOD;

            return ToolResult::success(match (static::MODE) {
                'query' => $this->service->{$method}($this->only($args, static::QUERY_KEYS)),
                'body' => $this->service->{$method}($this->body($args)),
                'id' => $this->service->{$method}($this->requireString($args, static::ID_KEY)),
                'id_query' => $this->service->{$method}($this->requireString($args, static::ID_KEY), $this->only($args, static::QUERY_KEYS)),
                'id_body' => $this->service->{$method}($this->requireString($args, static::ID_KEY), $this->body($args)),
                'two_ids_body' => $this->service->{$method}($this->requireString($args, static::ID_KEY), $this->requireString($args, static::SECOND_ID_KEY), $this->body($args)),
                default => $this->service->{$method}(),
            });
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Copy only recognized parameters from tool arguments to an API query.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  string[]  $keys  Query keys accepted by the endpoint.
     * @return array<string, mixed>
     */
    protected function only(array $args, array $keys): array
    {
        $payload = [];

        foreach ($keys as $key) {
            if (array_key_exists($key, $args) && $args[$key] !== null && $args[$key] !== '') {
                $payload[$key] = $args[$key];
            }
        }

        return $payload;
    }

    /**
     * Extract the official request body from args.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function body(array $args): array
    {
        $body = $args['body'] ?? null;

        if (!is_array($body) || $body === []) {
            throw new \InvalidArgumentException('body must be a non-empty object matching the Langfuse API request schema.');
        }

        return $body;
    }

    /**
     * Ensure a required string argument exists.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function requireString(array $args, string $key): string
    {
        $value = $args[$key] ?? null;

        if (is_int($value)) {
            return (string) $value;
        }

        if (!is_string($value) || trim($value) === '') {
            throw new \InvalidArgumentException($key . ' must be a non-empty string.');
        }

        return $value;
    }
}
