<?php

namespace OpenCompany\Integrations\Logto\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Logto\LogtoService;

/**
 * Shared executor for Logto endpoint-specific tools.
 *
 * Child tools map one-to-one to official OpenAPI operations while this class
 * handles configured-state checks, argument mapping, validation, and errors.
 */
abstract class AbstractLogtoTool implements Tool
{
    protected const OPERATION = [];

    /**
     * @param  LogtoService  $service  Logto Management API client.
     */
    public function __construct(protected LogtoService $service) {}

    public function name(): string { return (string) static::OPERATION['slug']; }
    public function description(): string { return (string) static::OPERATION['description']; }
    public function parameters(): array { return static::OPERATION['parameters']; }

    /**
     * Execute the mapped Logto Management API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments for this operation.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) { return ToolResult::error('Logto integration is not configured.'); }

            return ToolResult::success($this->service->executeOperation(static::OPERATION, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}