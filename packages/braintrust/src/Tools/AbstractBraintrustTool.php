<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Braintrust\BraintrustService;

/**
 * Shared executor for Braintrust endpoint-specific tools.
 *
 * Keeps configured-state checks, path parameter validation, body/query shaping,
 * and error conversion consistent while each child maps to one API operation.
 */
abstract class AbstractBraintrustTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const QUERY_KEYS = [];

    /**
     * @param  BraintrustService  $service  Braintrust API client.
     */
    public function __construct(
        protected BraintrustService $service,
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
     * Execute the mapped Braintrust API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Braintrust integration is not configured.');
            }

            return ToolResult::success($this->service->request(
                static::METHOD,
                $this->path($args),
                $this->query($args),
                $this->body($args),
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Fill path placeholders from required tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function path(array $args): string
    {
        $path = static::PATH;

        foreach (static::PATH_PARAMS as $param) {
            $path = str_replace('{' . $param . '}', rawurlencode($this->requireString($args, $param)), $path);
        }

        return $path;
    }

    /**
     * Extract query parameters from `query` or known top-level keys.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function query(array $args): array
    {
        if (isset($args['query']) && is_array($args['query'])) {
            return $this->encodeQueryArrays($args['query']);
        }

        $query = [];
        foreach (static::QUERY_KEYS as $key) {
            if (array_key_exists($key, $args) && $args[$key] !== null && $args[$key] !== '') {
                $query[$key] = $args[$key];
            }
        }

        return $this->encodeQueryArrays($query);
    }

    /**
     * Extract an official request body from tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function body(array $args): array
    {
        $body = $args['body'] ?? [];

        if (static::BODY_REQUIRED && (!is_array($body) || $body === [])) {
            throw new InvalidArgumentException('body must be a non-empty object matching the Braintrust API request schema.');
        }

        if ($body !== [] && !is_array($body)) {
            throw new InvalidArgumentException('body must be an object.');
        }

        return $body;
    }

    /**
     * Braintrust expects complex query filters such as metadata as JSON strings.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function encodeQueryArrays(array $query): array
    {
        foreach ($query as $key => $value) {
            if (is_array($value)) {
                $query[$key] = json_encode($value, JSON_UNESCAPED_SLASHES);
            }
        }

        return $query;
    }

    /**
     * Ensure a required string argument exists.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function requireString(array $args, string $key): string
    {
        $value = $args[$key] ?? null;

        if (!is_string($value) || trim($value) === '') {
            throw new InvalidArgumentException($key . ' must be a non-empty string.');
        }

        return $value;
    }
}
