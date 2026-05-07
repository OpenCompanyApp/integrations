<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\EdenAi\EdenAiService;

/**
 * Shared execution and validation helpers for Eden AI tool wrappers.
 */
abstract class AbstractEdenAiTool implements Tool
{
    /**
     * @param  EdenAiService  $service  The Eden AI API client.
     */
    public function __construct(
        protected EdenAiService $service,
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
     * Execute the Eden AI operation with standard error handling.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    final public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Eden AI integration is not configured.');
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
     * Read a required array argument.
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
     * Return an array argument or an empty array.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function arrayArg(array $args, string $key): array
    {
        return is_array($args[$key] ?? null) ? $args[$key] : [];
    }
}
