<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Recruitee\RecruiteeService;

/**
 * Shared execution and validation helpers for Recruitee tool wrappers.
 */
abstract class AbstractRecruiteeTool implements Tool
{
    /**
     * @param  RecruiteeService  $service  The Recruitee Core API client.
     */
    public function __construct(
        protected RecruiteeService $service,
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
     * Execute the Recruitee operation with standard error handling.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    final public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Recruitee integration is not configured.');
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
     * Read a required positive integer argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function requiredInt(array $args, string $key, string $label): int
    {
        $value = (int) ($args[$key] ?? 0);
        if ($value <= 0) {
            throw new \InvalidArgumentException("A valid {$label} is required.");
        }

        return $value;
    }

    /**
     * Read a required string argument.
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
     * Read a required object argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function requiredArray(array $args, string $key, string $label): array
    {
        $value = $args[$key] ?? null;
        if (!is_array($value) || $value === []) {
            throw new \InvalidArgumentException("{$label} is required.");
        }

        return $value;
    }

    /**
     * Return an object argument or an empty array.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function arrayArg(array $args, string $key): array
    {
        return is_array($args[$key] ?? null) ? $args[$key] : [];
    }
}
