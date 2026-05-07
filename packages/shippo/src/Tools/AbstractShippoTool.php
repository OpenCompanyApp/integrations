<?php

namespace OpenCompany\Integrations\Shippo\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Shippo\ShippoService;

/**
 * Shared executor for Shippo endpoint-specific tools.
 *
 * Handles configured-state checks, path/query/header mapping, body validation,
 * service dispatch, and error conversion.
 */
abstract class AbstractShippoTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;

    /**
     * @param  ShippoService  $service  Shippo API client.
     */
    public function __construct(protected ShippoService $service) {}

    public function name(): string { return static::NAME; }
    public function description(): string { return static::DESCRIPTION; }
    public function parameters(): array { return static::PARAMETERS; }

    /**
     * Execute the mapped Shippo API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Shippo API token is required.');
            }

            return ToolResult::success($this->service->request(
                static::METHOD,
                static::PATH,
                $this->mapped($args, static::PATH_PARAMS, true),
                $this->mapped($args, static::QUERY_PARAMS),
                $this->mapped($args, static::HEADER_PARAMS),
                $this->body($args),
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
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
        $body = $args['body'] ?? [];
        if ($body !== [] && !is_array($body)) {
            throw new InvalidArgumentException('body must be an object.');
        }
        if (static::BODY_REQUIRED && (!is_array($body) || $body === [])) {
            throw new InvalidArgumentException('body must be a non-empty object matching the Shippo request schema.');
        }

        return $body;
    }
}
