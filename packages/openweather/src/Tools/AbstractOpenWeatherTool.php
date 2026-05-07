<?php

namespace OpenCompany\Integrations\OpenWeather\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OpenWeather\OpenWeatherService;

/**
 * Shared executor for endpoint-specific OpenWeather tools.
 *
 * Child classes define endpoint metadata while this class validates required
 * arguments, merges query overrides, and converts exceptions to ToolResult.
 */
abstract class AbstractOpenWeatherTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const ENDPOINT = '';
    protected const REQUIRED = [];
    protected const REQUIRE_LOCATION = false;

    /**
     * @param  OpenWeatherService  $service  OpenWeather API client.
     */
    public function __construct(protected OpenWeatherService $service) {}

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
     * Execute the mapped OpenWeather endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (static::REQUIRE_LOCATION && !$this->hasLocation($args)) {
                throw new InvalidArgumentException('Provide latitude and longitude, or q, id, or zip.');
            }
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
     * Determine if any supported OpenWeather location selector is present.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function hasLocation(array $args): bool
    {
        return (isset($args['lat'], $args['lon']) && $args['lat'] !== '' && $args['lon'] !== '')
            || (isset($args['q']) && $args['q'] !== '')
            || (isset($args['id']) && $args['id'] !== '')
            || (isset($args['zip']) && $args['zip'] !== '');
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
