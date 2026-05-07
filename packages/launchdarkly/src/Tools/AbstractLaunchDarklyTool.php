<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\LaunchDarkly\LaunchDarklyService;

/**
 * Shared executor for LaunchDarkly endpoint-mapped tools.
 *
 * Handles configured-state checks, path interpolation, query/body shaping, and
 * exception conversion so individual tools can stay declarative.
 */
abstract class AbstractLaunchDarklyTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const REQUIRED = [];
    protected const QUERY_KEYS = [];
    protected const BODY_KEYS = [];
    protected const BODY_REQUIRED = false;

    /**
     * @param  LaunchDarklyService  $service  LaunchDarkly API client.
     */
    public function __construct(protected LaunchDarklyService $service) {}

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
     * Execute the mapped LaunchDarkly API endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('LaunchDarkly integration is not configured.');
            }

            foreach (static::REQUIRED as $required) {
                if (!isset($args[$required]) || $args[$required] === '') {
                    return ToolResult::error("{$required} is required.");
                }
            }

            $path = $this->path($args);
            $query = $this->query($args);
            $payload = $this->payload($args);

            if (static::METHOD !== 'GET' && $query !== []) {
                $path .= (str_contains($path, '?') ? '&' : '?') . http_build_query($query);
            }

            $result = match (static::METHOD) {
                'GET' => $this->service->apiGet($path, $query),
                'POST' => $this->service->apiPost($path, $payload),
                'PATCH' => $this->service->apiPatch($path, $payload),
                'PUT' => $this->service->apiPut($path, $payload),
                'DELETE' => $this->service->apiDelete($path, $payload),
                default => throw new \RuntimeException('Unsupported LaunchDarkly tool method: ' . static::METHOD),
            };

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Interpolate path placeholders from tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function path(array $args): string
    {
        return preg_replace_callback('/\{([a-zA-Z0-9_]+)\}/', function (array $match) use ($args): string {
            $key = $match[1];
            if (!isset($args[$key]) || $args[$key] === '') {
                throw new \InvalidArgumentException("{$key} is required.");
            }

            if ($key === 'path') {
                return ltrim((string) $args[$key], '/');
            }

            return rawurlencode((string) $args[$key]);
        }, static::PATH) ?? static::PATH;
    }

    /**
     * Build query parameters from allowed keys.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function query(array $args): array
    {
        $query = $args['query'] ?? [];
        if (!is_array($query)) {
            throw new \InvalidArgumentException('query must be an object.');
        }

        foreach (static::QUERY_KEYS as $key) {
            if (array_key_exists($key, $args) && $args[$key] !== null && $args[$key] !== '') {
                $query[$key] = $args[$key];
            }
        }

        return $query;
    }

    /**
     * Build request body from raw body plus allowed first-class body fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<int|string, mixed>
     */
    private function payload(array $args): array
    {
        $payload = $args['body'] ?? $args['patch'] ?? [];
        if (!is_array($payload)) {
            throw new \InvalidArgumentException('body must be an object or list.');
        }

        foreach (static::BODY_KEYS as $key) {
            if (array_key_exists($key, $args) && $args[$key] !== null) {
                $payload[$key] = $args[$key];
            }
        }

        if (static::BODY_REQUIRED && $payload === []) {
            throw new \InvalidArgumentException('A non-empty body, patch, or first-class body fields are required.');
        }

        return $payload;
    }
}
