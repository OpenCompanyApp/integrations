<?php

namespace OpenCompany\Integrations\Clearbit\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Clearbit\ClearbitService;

/**
 * Base class for Clearbit tools that delegate to ClearbitService.
 */
abstract class AbstractClearbitTool implements Tool
{
    /**
     * @param  ClearbitService  $service  Clearbit API client.
     */
    public function __construct(protected ClearbitService $service) {}

    /**
     * Execute the Clearbit tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($this->requiresConfiguration() && ! $this->service->isConfigured()) {
                return ToolResult::error('Clearbit integration is not configured.');
            }

            return ToolResult::success($this->callService($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Whether the endpoint requires a Clearbit API key.
     */
    protected function requiresConfiguration(): bool
    {
        return true;
    }

    /**
     * Call the concrete service method for this tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>|array<int, mixed>
     */
    abstract protected function callService(array $args): array;

    /**
     * Return optional object parameters.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function params(array $args): array
    {
        return is_array($args['params'] ?? null) ? $args['params'] : [];
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
