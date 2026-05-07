<?php

namespace OpenCompany\Integrations\OpenMeteo\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OpenMeteo\OpenMeteoService;

/**
 * Shared executor for endpoint-specific Open-Meteo tools.
 *
 * Child classes define the endpoint, required parameters, and parameter schema
 * while this class handles validation and error conversion.
 */
abstract class AbstractOpenMeteoTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const ENDPOINT = '';
    protected const REQUIRED = [];

    /**
     * @param  OpenMeteoService  $service  Open-Meteo API client.
     */
    public function __construct(protected OpenMeteoService $service) {}

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
     * Execute the mapped Open-Meteo endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            foreach (static::REQUIRED as $key) {
                $this->requireValue($args, $key);
            }

            $query = isset($args['query']) && is_array($args['query']) ? $args['query'] : [];
            unset($args['query']);

            return ToolResult::success($this->service->get(static::ENDPOINT, array_merge($query, $args)));
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
