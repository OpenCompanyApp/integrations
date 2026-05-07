<?php

namespace OpenCompany\Integrations\Stability\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Stability\StabilityService;

/**
 * Shared executor for Stability AI operation-specific tools.
 *
 * Child classes declare a single official API operation while this base class
 * handles parameters, configuration checks, and error conversion.
 */
abstract class AbstractStabilityTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const OPERATION = [];

    /**
     * @param  StabilityService  $service  Stability AI API client.
     */
    public function __construct(
        protected StabilityService $service,
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
     * Execute the mapped Stability AI API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Stability AI integration is not configured.');
            }

            return ToolResult::success($this->service->executeOperation(static::OPERATION, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
