<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ConstantContact\ConstantContactService;

/**
 * Base class for Constant Contact tools that delegate to ConstantContactService.
 */
abstract class AbstractConstantContactTool implements Tool
{
    /**
     * @param  ConstantContactService  $service  Constant Contact API client.
     */
    public function __construct(protected ConstantContactService $service) {}

    /**
     * Execute the Constant Contact tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Constant Contact integration is not configured.');
            }

            return ToolResult::success($this->callService($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Call the concrete service method.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    abstract protected function callService(array $args): array;

    /**
     * Return optional object parameters.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function params(array $args, string $key = 'params'): array
    {
        return is_array($args[$key] ?? null) ? $args[$key] : [];
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
