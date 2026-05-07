<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\SemanticScholar\SemanticScholarService;

/**
 * Shared executor for Semantic Scholar endpoint-specific tools.
 *
 * Child classes define service method, path template, and required arguments;
 * this class validates arguments, expands path parameters, and sends query/body.
 */
abstract class AbstractSemanticScholarTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const SERVICE_METHOD = 'graphGet';
    protected const PATH = '';
    protected const PATH_PARAMS = [];
    protected const REQUIRED = [];
    protected const BODY_KEY = null;
    protected const BODY_REQUIRED = false;

    /**
     * @param  SemanticScholarService  $service  Semantic Scholar API client.
     */
    public function __construct(protected SemanticScholarService $service) {}

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
     * Execute the mapped Semantic Scholar endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            foreach (static::REQUIRED as $key) {
                $this->requireValue($args, $key);
            }

            $path = static::PATH;
            foreach (static::PATH_PARAMS as $key) {
                $this->requireValue($args, $key);
                $path = str_replace('{'.$key.'}', rawurlencode((string) $args[$key]), $path);
                unset($args[$key]);
            }

            $body = [];
            if (static::BODY_KEY !== null) {
                $bodyKey = static::BODY_KEY;
                $body = isset($args[$bodyKey]) && is_array($args[$bodyKey]) ? $args[$bodyKey] : [];
                unset($args[$bodyKey]);
                if (static::BODY_REQUIRED && $body === []) {
                    throw new InvalidArgumentException($bodyKey.' must be a non-empty object.');
                }
            }

            $query = isset($args['extra']) && is_array($args['extra']) ? $args['extra'] : [];
            unset($args['extra']);
            $query = array_merge($query, $args);

            $method = static::SERVICE_METHOD;
            $result = static::BODY_KEY === null
                ? $this->service->{$method}($path, $query)
                : $this->service->{$method}($path, $query, $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Ensure a required argument is present and non-empty.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function requireValue(array $args, string $key): void
    {
        $value = $args[$key] ?? null;
        if ($value === null || $value === '' || (is_array($value) && $value === [])) {
            throw new InvalidArgumentException($key.' is required.');
        }
    }
}
