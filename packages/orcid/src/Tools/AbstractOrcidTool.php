<?php

namespace OpenCompany\Integrations\Orcid\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Orcid\OrcidService;

/**
 * Shared executor for ORCID Public API tools.
 *
 * Child classes define path templates, defaults, required parameters, and
 * response format while this class handles validation and dispatch.
 */
abstract class AbstractOrcidTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const PATH = '';
    protected const PATH_PARAMS = [];
    protected const DEFAULTS = [];
    protected const REQUIRED = [];
    protected const FORMAT = 'json';

    /**
     * @param  OrcidService  $service  ORCID Public API client.
     */
    public function __construct(protected OrcidService $service) {}

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
            'access_token' => ['type' => 'string', 'required' => false, 'description' => 'Optional ORCID /read-public bearer token.'],
            'extra' => ['type' => 'object', 'required' => false, 'description' => 'Additional official ORCID query parameters. Top-level arguments override duplicate keys.'],
        ];
    }

    /**
     * Execute the ORCID endpoint.
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

            return ToolResult::success($this->service->get($path, $params, static::FORMAT));
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
