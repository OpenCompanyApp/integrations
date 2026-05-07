<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ConvertKit\ConvertKitService;

/**
 * Shared implementation for Kit API endpoint tools.
 *
 * Maps dedicated tool classes to current V4 endpoints while keeping all HTTP
 * access centralized in ConvertKitService.
 */
abstract class AbstractConvertKitEndpointTool implements Tool
{
    protected const TOOL_NAME = '';
    protected const TOOL_DESCRIPTION = '';
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PATH_KEYS = [];
    protected const QUERY_KEYS = [];
    protected const BODY_KEYS = [];
    protected const PARAMETERS = [];
    protected const DYNAMIC_PATH = false;

    /**
     * @param  ConvertKitService  $service  Kit API client.
     */
    public function __construct(
        protected ConvertKitService $service,
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
     * Execute the mapped Kit API endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ConvertKit integration is not configured.');
            }

            $path = $this->path($args);
            $query = $this->query($args);
            $body = $this->body($args);

            $result = match (static::METHOD) {
                'GET' => $this->service->apiGet($path, $query),
                'POST' => $this->service->apiPost($path, $body, $query),
                'PUT' => $this->service->apiPut($path, $body, $query),
                'DELETE' => $this->service->apiDelete($path, $body, $query),
                default => throw new \RuntimeException('Unsupported endpoint tool method: ' . static::METHOD),
            };

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Build the endpoint path from required path arguments.
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
     * Build query parameters from a params object and selected top-level keys.
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
     * Build a JSON body from payload or selected top-level keys.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function body(array $args): array
    {
        if (isset($args['payload']) && is_array($args['payload'])) {
            return $args['payload'];
        }

        $body = [];

        foreach (static::BODY_KEYS as $key) {
            if (array_key_exists($key, $args) && $args[$key] !== null && $args[$key] !== '') {
                $body[$key] = $args[$key];
            }
        }

        return $body;
    }

    /**
     * Read a required argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function required(array $args, string $key): mixed
    {
        if (!array_key_exists($key, $args) || $args[$key] === null || $args[$key] === '') {
            throw new \InvalidArgumentException("Missing required argument: {$key}");
        }

        return $args[$key];
    }
}
