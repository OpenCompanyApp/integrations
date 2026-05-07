<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\FreshworksCrm\FreshworksCrmService;
use RuntimeException;

/**
 * Base class for Freshworks CRM REST endpoint tools.
 *
 * Handles credential checks, required argument validation, path interpolation,
 * and request body/query shaping for one Freshworks CRM API operation.
 */
abstract class AbstractFreshworksCrmEndpointTool implements Tool
{
    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [];

    /** @var list<string> */
    protected array $required = [];

    /** @var list<string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/';

    protected string $toolName = '';

    protected string $toolDescription = '';

    /**
     * @param  FreshworksCrmService  $service  The Freshworks CRM API client.
     */
    public function __construct(
        protected FreshworksCrmService $service,
    ) {}

    public function name(): string
    {
        return $this->toolName;
    }

    public function description(): string
    {
        return $this->toolDescription;
    }

    public function parameters(): array
    {
        return $this->parameters;
    }

    /**
     * Execute one Freshworks CRM REST API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshworks CRM integration is not configured.');
            }

            foreach ($this->required as $field) {
                if (!array_key_exists($field, $args) || $args[$field] === '' || $args[$field] === null) {
                    return ToolResult::error("{$field} is required.");
                }
            }

            $path = $this->interpolatePath($args);
            $query = $this->pick($args, $this->queryParams);
            $body = $this->wrapBody($this->pick($args, $this->bodyParams));

            $result = match ($this->method) {
                'GET' => $this->service->apiGet($path, $query),
                'POST' => $this->service->apiPost($path, $body, $query),
                'PUT' => $this->service->apiPut($path, $body, $query),
                'DELETE' => $this->service->apiDelete($path, $query),
                default => throw new RuntimeException("Unsupported Freshworks CRM tool method: {$this->method}"),
            };

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Wrap request body in a module root when needed.
     *
     * @param  array<string, mixed>  $body  Picked request body.
     * @return array<string, mixed>
     */
    protected function wrapBody(array $body): array
    {
        return $body;
    }

    /**
     * Replace {param} placeholders in the endpoint path.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function interpolatePath(array $args): string
    {
        return preg_replace_callback('/\{([a-zA-Z0-9_]+)\}/', function (array $matches) use ($args): string {
            $key = $matches[1];

            if (!array_key_exists($key, $args) || $args[$key] === '' || $args[$key] === null) {
                throw new RuntimeException("{$key} is required.");
            }

            return rawurlencode((string) $args[$key]);
        }, $this->path) ?? $this->path;
    }

    /**
     * Pick non-empty values from tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<int|string, string>  $fields  Fields to copy, optionally as input => output mappings.
     * @return array<string, mixed>
     */
    private function pick(array $args, array $fields): array
    {
        $values = [];

        foreach ($fields as $input => $output) {
            $field = is_int($input) ? $output : (string) $input;
            $target = is_int($input) ? $output : $output;

            if (array_key_exists($field, $args) && $args[$field] !== null && $args[$field] !== '') {
                $values[$target] = $args[$field];
            }
        }

        return $values;
    }
}
