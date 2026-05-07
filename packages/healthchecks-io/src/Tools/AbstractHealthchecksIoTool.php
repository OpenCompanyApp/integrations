<?php

namespace OpenCompany\Integrations\HealthchecksIo\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\HealthchecksIo\HealthchecksIoService;

/**
 * Shared executor for Healthchecks.io endpoint-specific tools.
 *
 * Handles configured-state checks, parameter mapping, ping method overrides,
 * body shaping, dispatch, and error conversion for API operations.
 */
abstract class AbstractHealthchecksIoTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const REQUIRES_AUTH = true;
    protected const PING = false;

    /**
     * @param  HealthchecksIoService  $service  Healthchecks.io API client.
     */
    public function __construct(protected HealthchecksIoService $service) {}

    public function name(): string { return static::NAME; }
    public function description(): string { return static::DESCRIPTION; }
    public function parameters(): array { return static::PARAMETERS; }

    /**
     * Execute the mapped Healthchecks.io API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (static::REQUIRES_AUTH && !$this->service->isConfigured()) {
                return ToolResult::error('Healthchecks.io integration is not configured.');
            }

            return ToolResult::success($this->service->request(
                $this->method($args),
                static::PATH,
                $this->mapped($args, static::PATH_PARAMS, true),
                $this->mapped($args, static::QUERY_PARAMS),
                $this->body($args),
                static::REQUIRES_AUTH,
                static::PING,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function method(array $args): string
    {
        $method = static::PING ? strtoupper((string) ($args['http_method'] ?? static::METHOD)) : static::METHOD;
        if (!in_array($method, ['HEAD', 'GET', 'POST'], true) && static::PING) {
            throw new InvalidArgumentException('http_method must be HEAD, GET, or POST for ping tools.');
        }

        return $method;
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<string, string>  $map  Official parameter name to tool key map.
     * @return array<string, mixed>
     */
    private function mapped(array $args, array $map, bool $required = false): array
    {
        $out = [];
        foreach ($map as $official => $key) {
            if (!array_key_exists($key, $args) || $args[$key] === null || $args[$key] === '') {
                if ($required) {
                    throw new InvalidArgumentException($key . ' must be a non-empty parameter.');
                }
                continue;
            }
            $out[$official] = $args[$key];
        }

        return $out;
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function body(array $args): array
    {
        if (static::PING) {
            return ['body_text' => (string) ($args['body_text'] ?? '')];
        }

        $body = $args['body'] ?? [];
        if (static::BODY_REQUIRED && (!is_array($body) || $body === [])) {
            throw new InvalidArgumentException('body must be a non-empty object matching the Healthchecks.io API request schema.');
        }
        if ($body !== [] && !is_array($body)) {
            throw new InvalidArgumentException('body must be an object.');
        }

        return $body;
    }
}
