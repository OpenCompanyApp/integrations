<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vimeo\VimeoService;

/**
 * Shared execution and argument helpers for Vimeo tool wrappers.
 */
abstract class AbstractVimeoTool implements Tool
{
    /**
     * @param  VimeoService  $service  The Vimeo API client.
     */
    public function __construct(
        protected VimeoService $service,
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
     * Execute the Vimeo operation with standard error handling.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    final public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vimeo integration is not configured.');
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
     * @return array<string, mixed>|string
     */
    abstract protected function call(array $args): array|string;

    /**
     * Read a required string argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function requiredString(array $args, string $key): string
    {
        $value = trim((string) ($args[$key] ?? ''));
        if ($value === '') {
            throw new \InvalidArgumentException("{$key} is required.");
        }

        return $value;
    }

    /**
     * Read a required object argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function requiredArray(array $args, string $key): array
    {
        $value = $args[$key] ?? null;
        if (!is_array($value) || $value === []) {
            throw new \InvalidArgumentException("{$key} is required.");
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
