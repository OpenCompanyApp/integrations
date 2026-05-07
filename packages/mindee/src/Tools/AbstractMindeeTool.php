<?php

namespace OpenCompany\Integrations\Mindee\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mindee\MindeeService;

/**
 * Base class for Mindee endpoint tools that return raw API response data.
 */
abstract class AbstractMindeeTool implements Tool
{
    /**
     * @param  MindeeService  $service  Mindee API client.
     */
    public function __construct(protected MindeeService $service) {}

    /**
     * Execute the Mindee tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mindee integration is not configured.');
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
     * Return an options object if one was provided.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function options(array $args): array
    {
        return is_array($args['options'] ?? null) ? $args['options'] : [];
    }
}
