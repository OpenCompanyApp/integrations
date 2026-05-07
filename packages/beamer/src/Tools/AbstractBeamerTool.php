<?php

namespace OpenCompany\Integrations\Beamer\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Beamer\BeamerService;

/**
 * Base class for Beamer tools that call generic service methods.
 */
abstract class AbstractBeamerTool implements Tool
{
    /**
     * @param  BeamerService  $service  Beamer API client.
     */
    public function __construct(protected BeamerService $service) {}

    /**
     * Execute the Beamer tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Beamer integration is not configured.');
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
     * Return a required API path.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function path(array $args): string
    {
        if (empty($args['path'])) {
            throw new \RuntimeException('path is required.');
        }

        return (string) $args['path'];
    }
}
