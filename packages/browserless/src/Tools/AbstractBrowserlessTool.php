<?php

namespace OpenCompany\Integrations\Browserless\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Browserless\BrowserlessService;

/**
 * Shared executor for Browserless endpoint-specific tools.
 *
 * Maps generated OpenAPI tool arguments into path, query, JSON, and JavaScript
 * request data and converts thrown service errors into ToolResult errors.
 */
abstract class AbstractBrowserlessTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';

    /**
     * @param  BrowserlessService  $service  Browserless API client.
     */
    public function __construct(protected BrowserlessService $service) {}
    public function name(): string { return static::NAME; }
    public function description(): string { return static::DESCRIPTION; }
    public function parameters(): array { return static::PARAMETERS; }

    /**
     * Execute the mapped Browserless API operation.
     * @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) { return ToolResult::error('Browserless integration is not configured.'); }
            return ToolResult::success($this->service->request(static::METHOD, static::PATH, array_merge($this->mapped($args, static::OPTIONAL_PATH_PARAMS), $this->mapped($args, static::PATH_PARAMS, true)), $this->mapped($args, static::QUERY_PARAMS), [], $this->body($args), static::BODY_CONTENT_TYPE));
        } catch (\Throwable $e) { return ToolResult::error($e->getMessage()); }
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<string, string>  $map  Official parameter name to tool key map.
     * @return array<string, mixed>
     */
    private function mapped(array $args, array $map, bool $required = false): array
    {
        $out=[];
        foreach ($map as $official=>$key) {
            if (!array_key_exists($key,$args) || $args[$key]===null || $args[$key]==='') { if ($required) { throw new InvalidArgumentException($key.' must be a non-empty parameter.'); } continue; }
            $out[$official]=$args[$key];
        }
        return $out;
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function body(array $args): array
    {
        if (static::BODY_CONTENT_TYPE === 'javascript') {
            if (static::BODY_REQUIRED && (!isset($args['code']) || $args['code'] === '')) { throw new InvalidArgumentException('code must be a non-empty JavaScript string.'); }
            return ['code' => (string) ($args['code'] ?? '')];
        }
        $body=$args['body']??[];
        if (static::BODY_REQUIRED && (!is_array($body) || $body===[])) { throw new InvalidArgumentException('body must be a non-empty object matching the Browserless API request schema.'); }
        if ($body!==[] && !is_array($body)) { throw new InvalidArgumentException('body must be an object.'); }
        return $body;
    }
}
