<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Urlscan\UrlscanService;

/**
 * Shared executor for urlscan.io endpoint-specific tools.
 *
 * Handles configured-state checks, parameter mapping, body shaping, dispatch,
 * and error conversion for generated OpenAPI operations.
 */
abstract class AbstractUrlscanTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;

    /**
     * @param  UrlscanService  $service  urlscan.io API client.
     */
    public function __construct(protected UrlscanService $service) {}

    public function name(): string { return static::NAME; }
    public function description(): string { return static::DESCRIPTION; }
    public function parameters(): array { return static::PARAMETERS; }

    /**
     * Execute the mapped urlscan.io API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('urlscan.io integration is not configured.');
            }

            return ToolResult::success($this->service->request(
                static::METHOD,
                static::PATH,
                $this->mapped($args, static::PATH_PARAMS, true),
                $this->mapped($args, static::QUERY_PARAMS),
                [],
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
        if (static::BODY_REQUIRED && (!is_array($body) || $body === [])) {
            throw new InvalidArgumentException('body must be a non-empty object matching the urlscan.io API request schema.');
        }
        if ($body !== [] && !is_array($body)) {
            throw new InvalidArgumentException('body must be an object.');
        }

        return $body;
    }
}
