<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Wufoo\WufooService;

/**
 * Shared execution and validation helpers for Wufoo tool wrappers.
 */
abstract class AbstractWufooTool implements Tool
{
    /**
     * @param  WufooService  $service  The Wufoo API client.
     */
    public function __construct(
        protected WufooService $service,
    ) {}

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
     * Execute the Wufoo operation with standard configuration and error handling.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    final public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wufoo integration is not configured.');
            }

            return ToolResult::success($this->call($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Run the concrete service operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    abstract protected function call(array $args): array;

    /**
     * Read a required non-empty string argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function requiredString(array $args, string $key, string $label): string
    {
        $value = trim((string) ($args[$key] ?? ''));
        if ($value === '') {
            throw new \InvalidArgumentException("{$label} is required.");
        }

        return $value;
    }

    /**
     * Return an array argument or an empty array.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function arrayArg(array $args, string $key): array
    {
        return is_array($args[$key] ?? null) ? $args[$key] : [];
    }

    /**
     * Return a boolean argument with a default value.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function boolArg(array $args, string $key, bool $default = false): bool
    {
        if (!array_key_exists($key, $args)) {
            return $default;
        }

        return filter_var($args[$key], FILTER_VALIDATE_BOOLEAN);
    }
}
