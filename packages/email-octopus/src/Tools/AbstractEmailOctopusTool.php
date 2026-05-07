<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\EmailOctopus\EmailOctopusService;

/**
 * Shared executor for EmailOctopus API tools.
 *
 * Provides configured-state checks and consistent exception handling for
 * endpoint-specific tool classes.
 */
abstract class AbstractEmailOctopusTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';

    /**
     * @param  EmailOctopusService  $service  The EmailOctopus API client.
     */
    public function __construct(protected EmailOctopusService $service) {}

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
     * Execute the mapped EmailOctopus API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('EmailOctopus integration is not configured.');
            }

            return ToolResult::success($this->service->{static::METHOD}($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
