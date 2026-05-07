<?php

namespace OpenCompany\Integrations\Plaid\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Plaid\PlaidService;

/**
 * Shared executor for Plaid endpoint-specific tools.
 *
 * Each child class maps to one official OpenAPI operation while this base class
 * handles configured-state checks, path/body shaping, and error conversion.
 */
abstract class AbstractPlaidTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = 'POST';
    protected const PATH = '';
    protected const PATH_PARAMS = [];
    protected const BODY_REQUIRED = true;

    /**
     * @param  PlaidService  $service  Plaid API client.
     */
    public function __construct(protected PlaidService $service) {}

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
     * Execute the mapped Plaid API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Plaid integration is not configured.');
            }

            return ToolResult::success($this->service->request(
                static::METHOD,
                static::PATH,
                $this->pathParams($args),
                $this->body($args),
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function pathParams(array $args): array
    {
        $params = [];
        foreach (static::PATH_PARAMS as $key) {
            $params[$key] = $this->requireScalar($args, $key);
        }

        return $params;
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function body(array $args): array
    {
        $body = $args['body'] ?? [];
        if (static::BODY_REQUIRED && (!is_array($body) || $body === [])) {
            throw new InvalidArgumentException('body must be a non-empty object matching the Plaid API request schema.');
        }

        if ($body !== [] && !is_array($body)) {
            throw new InvalidArgumentException('body must be an object.');
        }

        return $body;
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function requireScalar(array $args, string $key): string
    {
        $value = $args[$key] ?? null;
        if (is_int($value) || is_float($value) || is_bool($value)) {
            return (string) $value;
        }

        if (!is_string($value) || trim($value) === '') {
            throw new InvalidArgumentException($key.' must be a non-empty string.');
        }

        return $value;
    }
}