<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\BraveSearch\BraveSearchService;

/**
 * Shared executor for Brave Search tools.
 *
 * Child classes provide static metadata while this base class dispatches to
 * explicit BraveSearchService methods and converts exceptions into tool errors.
 */
abstract class AbstractBraveSearchTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';

    /**
     * @param  BraveSearchService  $service  Brave Search API client.
     */
    public function __construct(protected BraveSearchService $service) {}

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
     * Execute the Brave Search operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $method = static::METHOD;
            if (!method_exists($this->service, $method)) {
                throw new InvalidArgumentException('Unsupported Brave Search operation.');
            }

            return ToolResult::success($this->service->{$method}($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
