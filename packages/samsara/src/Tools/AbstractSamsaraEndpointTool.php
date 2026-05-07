<?php

namespace OpenCompany\Integrations\Samsara\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Samsara\SamsaraService;

/**
 * Shared implementation for mapped Samsara REST API endpoint tools.
 */
abstract class AbstractSamsaraEndpointTool implements Tool
{
    protected const TOOL_NAME = '';
    protected const TOOL_DESCRIPTION = '';
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PATH_KEYS = [];
    protected const QUERY_KEYS = [];
    protected const PARAMETERS = [];
    protected const DYNAMIC_PATH = false;

    /**
     * @param  SamsaraService  $service  Samsara API client.
     */
    public function __construct(
        protected SamsaraService $service,
    ) {}

    public function name(): string
    {
        return static::TOOL_NAME;
    }

    public function description(): string
    {
        return static::TOOL_DESCRIPTION;
    }

    public function parameters(): array
    {
        return static::PARAMETERS;
    }

    /**
     * Execute the mapped Samsara endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Samsara integration is not configured.');
            }

            $path = $this->path($args);
            $query = $this->query($args);
            $body = is_array($args['payload'] ?? null) ? $args['payload'] : [];

            $result = match (static::METHOD) {
                'GET' => $this->service->apiGet($path, $query),
                'POST' => $this->service->apiPost($path, $body, $query),
                'PATCH' => $this->service->apiPatch($path, $body, $query),
                'DELETE' => $this->service->apiDelete($path, $query),
                default => throw new \RuntimeException('Unsupported Samsara endpoint tool method: ' . static::METHOD),
            };

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Build the endpoint path.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function path(array $args): string
    {
        if (static::DYNAMIC_PATH) {
            return (string) $this->required($args, 'path');
        }

        $path = static::PATH;
        foreach (static::PATH_KEYS as $key) {
            $path = str_replace('{' . $key . '}', rawurlencode((string) $this->required($args, $key)), $path);
        }

        return $path;
    }

    /**
     * Build query parameters.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function query(array $args): array
    {
        $query = is_array($args['params'] ?? null) ? $args['params'] : [];

        foreach (static::QUERY_KEYS as $key) {
            if (array_key_exists($key, $args) && $args[$key] !== null && $args[$key] !== '') {
                $query[$key] = $args[$key];
            }
        }

        return $query;
    }

    /**
     * Read a required argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function required(array $args, string $key): mixed
    {
        if (! array_key_exists($key, $args) || $args[$key] === null || $args[$key] === '') {
            throw new \InvalidArgumentException("Missing required argument: {$key}");
        }

        return $args[$key];
    }
}
