<?php

namespace OpenCompany\Integrations\Front\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Front\FrontService;

/**
 * Shared executor for Front endpoint-mapped tools.
 *
 * Handles configured-state checks, path interpolation, query/body shaping, and
 * exception conversion so individual tools can stay declarative.
 */
abstract class AbstractFrontTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const REQUIRED = [];
    protected const ALIASES = [];
    protected const QUERY_KEYS = [];
    protected const BODY_KEYS = [];
    protected const BODY_REQUIRED = false;

    /**
     * @param  FrontService  $service  Front API client.
     */
    public function __construct(protected FrontService $service) {}

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
     * Execute the mapped Front API endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Front integration is not configured.');
            }

            $args = $this->applyAliases($args);

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
                default => throw new \RuntimeException('Unsupported Front tool method: ' . static::METHOD),
            };

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Apply backwards-compatible argument aliases before validation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function applyAliases(array $args): array
    {
        foreach (static::ALIASES as $target => $aliases) {
            if (isset($args[$target]) && $args[$target] !== '') {
                continue;
            }

            foreach ((array) $aliases as $alias) {
                if (isset($args[$alias]) && $args[$alias] !== '') {
                    $args[$target] = $args[$alias];
                    break;
                }
            }
        }

        return $args;
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
     * Build request body from raw data plus allowed first-class fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function payload(array $args): array
    {
        $rawBody = $args['body'] ?? [];
        $payload = [];

        if (is_array($rawBody)) {
            $payload = $rawBody;
        } elseif (!in_array('body', static::BODY_KEYS, true)) {
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
