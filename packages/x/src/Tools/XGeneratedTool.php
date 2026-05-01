<?php

namespace OpenCompany\Integrations\X\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\X\XService;

/**
 * Base class for generated X API operation tools.
 *
 * Concrete generated tools provide operation metadata through constants. This
 * class validates required arguments and delegates request execution to the
 * service, so every operation keeps one stable tool class without duplicating
 * HTTP plumbing.
 */
abstract class XGeneratedTool implements Tool
{
    protected const SLUG = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const OPERATION = [];

    /**
     * @param  XService  $service  The X API client
     */
    public function __construct(
        protected XService $service,
    ) {}

    public function name(): string
    {
        return static::SLUG;
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
     * Execute the generated X API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        foreach (static::PARAMETERS as $key => $schema) {
            if (($schema['required'] ?? false) && (!array_key_exists($key, $args) || $args[$key] === '' || $args[$key] === null)) {
                return ToolResult::error("{$key} is required.");
            }
        }

        try {
            return ToolResult::success($this->service->executeOperation(static::OPERATION, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}