<?php

namespace OpenCompany\Integrations\Cal\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Cal\CalService;

/**
 * Base class for Cal.com tools that delegate to CalService.
 */
abstract class AbstractCalTool implements Tool
{
    /**
     * @param  CalService  $service  Cal.com API client.
     */
    public function __construct(protected CalService $service) {}

    /**
     * Execute the Cal.com tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Cal.com integration is not configured.');
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
