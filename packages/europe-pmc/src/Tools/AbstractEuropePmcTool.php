<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\EuropePmc\EuropePmcService;

/**
 * Shared executor for endpoint-specific Europe PMC tools.
 *
 * Child classes define the API surface, path template, defaults, and required
 * arguments while this class handles validation and dispatch.
 */
abstract class AbstractEuropePmcTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const API = 'rest';
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PATH_PARAMS = [];
    protected const DEFAULTS = [];
    protected const REQUIRED = [];

    /**
     * @param  EuropePmcService  $service  Europe PMC API client.
     */
    public function __construct(protected EuropePmcService $service) {}

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
        return static::PARAMETERS + [
            'format' => ['type' => 'string', 'required' => false, 'description' => 'Response format where supported, commonly json or xml.'],
            'email' => ['type' => 'string', 'required' => false, 'description' => 'Optional contact email for Europe PMC service notices.'],
            'extra' => ['type' => 'object', 'required' => false, 'description' => 'Additional official Europe PMC parameters. Top-level arguments override duplicate keys.'],
        ];
    }

    /**
     * Execute the Europe PMC endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            foreach (static::REQUIRED as $key) {
                $this->requireValue($args, $key);
            }

            $extra = isset($args['extra']) && is_array($args['extra']) ? $args['extra'] : [];
            unset($args['extra']);

            $params = array_merge(static::DEFAULTS, $extra, $args);
            $path = static::PATH;

            foreach (static::PATH_PARAMS as $key) {
                $this->requireValue($params, $key);
                $path = str_replace('{'.$key.'}', rawurlencode((string) $params[$key]), $path);
                unset($params[$key]);
            }

            return ToolResult::success($this->dispatch($path, $params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Dispatch the endpoint to the correct Europe PMC API family.
     *
     * @param  array<string, mixed>  $params  Query or form parameters.
     * @return array<string, mixed>
     */
    private function dispatch(string $path, array $params): array
    {
        return match (static::API) {
            'annotations' => $this->service->annotations($path, $params),
            'grants' => $this->service->grants($params),
            default => static::METHOD === 'POST'
                ? $this->service->post($path, $params)
                : $this->service->get($path, $params),
        };
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
