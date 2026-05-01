<?php

namespace OpenCompany\Integrations\XAds\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\XAds\XAdsService;

/**
 * Base class for generated X Ads API operation tools.
 *
 * Each concrete tool contains operation metadata derived from the official X
 * Ads Postman collection and delegates signed requests to the service.
 */
abstract class XAdsGeneratedTool implements Tool
{
    protected const SLUG = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const OPERATION = [];

    /**
     * @param  XAdsService  $service  The X Ads API client
     */
    public function __construct(
        protected XAdsService $service,
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
     * Execute the generated X Ads API operation.
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