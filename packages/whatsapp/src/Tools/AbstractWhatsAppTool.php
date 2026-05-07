<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\WhatsApp\WhatsAppService;

/**
 * Shared helper methods for WhatsApp Business Platform tools.
 */
abstract class AbstractWhatsAppTool implements Tool
{
    /**
     * @param  WhatsAppService  $service  WhatsApp API client.
     */
    public function __construct(
        protected WhatsAppService $service,
    ) {}

    /**
     * Return a string argument or a default.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function string(array $args, string $key, string $default = ''): string
    {
        $value = $args[$key] ?? $default;

        return is_scalar($value) ? (string) $value : $default;
    }

    /**
     * Return an integer argument or a default.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function integer(array $args, string $key, int $default): int
    {
        return isset($args[$key]) ? (int) $args[$key] : $default;
    }

    /**
     * Return an array argument, decoding JSON strings when supplied.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string|int, mixed>
     */
    protected function arrayArg(array $args, string $key): array
    {
        $value = $args[$key] ?? [];

        if (is_string($value)) {
            $decoded = json_decode($value, true);

            return is_array($decoded) ? $decoded : [];
        }

        return is_array($value) ? $value : [];
    }

    /**
     * Return a required string or throw a validation error.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function requiredString(array $args, string $key): string
    {
        $value = $this->string($args, $key);
        if ($value === '') {
            throw new \InvalidArgumentException("{$key} is required.");
        }

        return $value;
    }

    /**
     * Wrap tool execution with consistent exception handling.
     *
     * @param  callable(): array<string, mixed>  $callback  Tool operation.
     */
    protected function run(callable $callback): ToolResult
    {
        try {
            return ToolResult::success($callback());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
