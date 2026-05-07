<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Shortcut\ShortcutService;

/**
 * Shared executor for Shortcut endpoint-specific tools.
 *
 * Child tools carry official Swagger metadata while this base class handles
 * configured-state checks, argument mapping, request dispatch, and errors.
 */
abstract class AbstractShortcutTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';

    /**
     * @param  ShortcutService  $service  Shortcut API client.
     */
    public function __construct(protected ShortcutService $service) {}

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
     * Execute the mapped Shortcut API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Shortcut integration is not configured.');
            }

            return ToolResult::success($this->service->request(
                static::METHOD,
                static::PATH,
                $this->mapped($args, static::PATH_PARAMS, true),
                $this->mapped($args, static::QUERY_PARAMS),
                [],
                $this->body($args),
                static::BODY_CONTENT_TYPE,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Map tool parameter names back to official API parameter names.
     *
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
     * Resolve request body or multipart fields from tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function body(array $args): array
    {
        if (static::BODY_CONTENT_TYPE === 'multipart') {
            $this->mapped($args, static::FORM_REQUIRED_PARAMS, true);

            return $this->mapped($args, static::FORM_PARAMS);
        }

        $body = $args['body'] ?? [];

        if (static::BODY_REQUIRED && (!is_array($body) || $body === [])) {
            throw new InvalidArgumentException('body must be a non-empty object matching the Shortcut API request schema.');
        }

        if ($body !== [] && !is_array($body)) {
            throw new InvalidArgumentException('body must be an object.');
        }

        return $body;
    }
}
