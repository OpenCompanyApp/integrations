<?php

namespace OpenCompany\Integrations\Ahrefs\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Ahrefs\AhrefsService;

/**
 * Base class for Ahrefs tools that delegate to AhrefsService.
 */
abstract class AbstractAhrefsTool implements Tool
{
    /**
     * @param  AhrefsService  $service  Ahrefs API client.
     */
    public function __construct(protected AhrefsService $service) {}

    /**
     * Execute the Ahrefs tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Ahrefs integration is not configured.');
            }

            return ToolResult::success($this->callService($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Call the concrete service method for this tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    abstract protected function callService(array $args): array;

    /**
     * Return a required array argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function arrayArg(array $args, string $key): array
    {
        if (! isset($args[$key]) || ! is_array($args[$key])) {
            throw new \RuntimeException("{$key} must be an object.");
        }

        return $args[$key];
    }

    /**
     * Return a required string argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function stringArg(array $args, string $key): string
    {
        if (empty($args[$key])) {
            throw new \RuntimeException("{$key} is required.");
        }

        return (string) $args[$key];
    }
}
