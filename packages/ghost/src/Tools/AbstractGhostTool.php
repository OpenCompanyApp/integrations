<?php

namespace OpenCompany\Integrations\Ghost\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Ghost\GhostService;

/**
 * Shared argument parsing and error handling for Ghost tools.
 */
abstract class AbstractGhostTool implements Tool
{
    /** @param GhostService $service The Ghost Admin API client. */
    public function __construct(protected GhostService $service) {}

    /** @param callable(): array<string, mixed> $operation Operation to run. */
    protected function run(callable $operation): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ghost integration is not configured.');
            }

            return ToolResult::success($operation());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /** @param array<string, mixed> $args Tool arguments. */
    protected function requiredString(array $args, string $key): string
    {
        if (!isset($args[$key]) || trim((string) $args[$key]) === '') {
            throw new \InvalidArgumentException("{$key} is required.");
        }

        return trim((string) $args[$key]);
    }

    /** @param array<string, mixed> $args Tool arguments. @return array<string, mixed> */
    protected function objectArg(array $args, string $key, array $default = []): array
    {
        if (!array_key_exists($key, $args) || $args[$key] === null || $args[$key] === '') {
            return $default;
        }

        if (is_array($args[$key])) {
            return $args[$key];
        }

        if (is_string($args[$key])) {
            $decoded = json_decode($args[$key], true);
            if (is_array($decoded)) {
                return $decoded;
            }
        }

        throw new \InvalidArgumentException("{$key} must be an object or valid JSON object.");
    }
}
