<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MailerLite\MailerLiteService;

/**
 * Base helper for MailerLite tools.
 *
 * Centralizes configuration checks, argument filtering, and exception handling
 * so individual tool classes can stay focused on endpoint mapping.
 */
abstract class AbstractMailerLiteTool implements Tool
{
    /**
     * @param  MailerLiteService  $service  MailerLite API client.
     */
    public function __construct(
        protected MailerLiteService $service,
    ) {}

    /**
     * Run a service operation and convert exceptions into tool errors.
     *
     * @param  callable(): array<string, mixed>  $callback  Service operation.
     */
    protected function run(callable $callback): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MailerLite integration is not configured.');
            }

            return ToolResult::success($callback());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Return only non-null arguments listed in $keys.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<int, string>  $keys  Allowed keys.
     * @return array<string, mixed>
     */
    protected function only(array $args, array $keys): array
    {
        $data = [];

        foreach ($keys as $key) {
            if (array_key_exists($key, $args) && $args[$key] !== null && $args[$key] !== '') {
                $data[$key] = $args[$key];
            }
        }

        return $data;
    }

    /**
     * Read a required argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  string  $key  Required argument key.
     */
    protected function required(array $args, string $key): mixed
    {
        if (!array_key_exists($key, $args) || $args[$key] === null || $args[$key] === '') {
            throw new \InvalidArgumentException("Missing required argument: {$key}");
        }

        return $args[$key];
    }

    /**
     * Read a payload object, falling back to selected top-level keys.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<int, string>  $fallbackKeys  Top-level keys to include when payload is absent.
     * @return array<string, mixed>
     */
    protected function payload(array $args, array $fallbackKeys = []): array
    {
        if (isset($args['payload']) && is_array($args['payload'])) {
            return $args['payload'];
        }

        return $this->only($args, $fallbackKeys);
    }
}
