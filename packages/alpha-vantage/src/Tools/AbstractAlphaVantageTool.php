<?php

namespace OpenCompany\Integrations\AlphaVantage\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\AlphaVantage\AlphaVantageService;

/**
 * Shared executor for Alpha Vantage function tools.
 *
 * Child classes declare one official function, required fields, and parameter
 * metadata while this class validates arguments and converts exceptions.
 */
abstract class AbstractAlphaVantageTool implements Tool
{
    protected const NAME = '';
    protected const FUNCTION = '';
    protected const DESCRIPTION = '';
    protected const REQUIRED = [];
    protected const PARAMETERS = [];

    /**
     * @param  AlphaVantageService  $service  Alpha Vantage API client.
     */
    public function __construct(protected AlphaVantageService $service) {}

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
     * Execute the Alpha Vantage function.
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

            return ToolResult::success($this->service->query(static::FUNCTION, array_merge($query, $args)));
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
