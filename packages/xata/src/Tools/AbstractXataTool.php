<?php

namespace OpenCompany\Integrations\Xata\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Xata\XataService;

/**
 * Shared executor for Xata operation-specific tools.
 *
 * Keeps configuration checks, parameter declarations, and API error handling
 * consistent across management and data-plane operations.
 */
abstract class AbstractXataTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const OPERATION = [];

    /**
     * @param  XataService  $service  Xata API client.
     */
    public function __construct(
        protected XataService $service,
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
     * Execute the mapped Xata API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Xata integration is not configured.');
            }

            return ToolResult::success($this->service->executeOperation(static::OPERATION, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
