<?php

namespace OpenCompany\Integrations\Ashby\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Ashby\AshbyService;

/**
 * Shared executor for Ashby endpoint-mapped tools.
 *
 * Handles configured-state checks, body shaping, and exception conversion for
 * Ashby's RPC-style POST endpoints.
 */
abstract class AbstractAshbyTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const ENDPOINT = '';
    protected const REQUIRED = [];
    protected const BODY_KEYS = [];
    protected const BODY_REQUIRED = false;

    /**
     * @param  AshbyService  $service  Ashby API client.
     */
    public function __construct(protected AshbyService $service) {}

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
     * Execute the mapped Ashby API endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ashby integration is not configured.');
            }

            foreach (static::REQUIRED as $required) {
                if (!isset($args[$required]) || $args[$required] === '') {
                    return ToolResult::error("{$required} is required.");
                }
            }

            return ToolResult::success($this->service->apiPost($this->endpoint($args), $this->payload($args)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Resolve the endpoint, allowing raw API tools to use a path argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function endpoint(array $args): string
    {
        if (static::ENDPOINT === '{endpoint}') {
            return (string) $args['endpoint'];
        }

        return static::ENDPOINT;
    }

    /**
     * Build request body from raw body plus allowed first-class body fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function payload(array $args): array
    {
        $payload = $args['body'] ?? [];
        if (!is_array($payload)) {
            throw new \InvalidArgumentException('body must be an object.');
        }

        foreach (static::BODY_KEYS as $key) {
            if (array_key_exists($key, $args) && $args[$key] !== null && $args[$key] !== '') {
                $payload[$key] = $args[$key];
            }
        }

        if (static::BODY_REQUIRED && $payload === []) {
            throw new \InvalidArgumentException('A non-empty body or first-class body fields are required.');
        }

        return $payload;
    }
}
