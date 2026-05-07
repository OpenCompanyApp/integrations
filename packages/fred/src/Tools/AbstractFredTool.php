<?php

namespace OpenCompany\Integrations\Fred\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Fred\FredService;

/**
 * Shared executor for FRED tools.
 *
 * Child classes provide static metadata while this base class dispatches to
 * explicit FredService methods and converts exceptions into tool errors.
 */
abstract class AbstractFredTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';

    /**
     * @param  FredService  $service  FRED API client.
     */
    public function __construct(protected FredService $service) {}

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
     * Execute the FRED operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $method = static::METHOD;
            if (!method_exists($this->service, $method)) {
                throw new InvalidArgumentException('Unsupported FRED operation.');
            }

            return ToolResult::success($this->service->{$method}($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
