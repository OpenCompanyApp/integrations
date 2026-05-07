<?php

namespace OpenCompany\Integrations\AfterShip\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\AfterShip\AfterShipService;

/**
 * Shared executor for AfterShip tools.
 *
 * Child classes provide metadata while this base class dispatches to explicit
 * service methods and converts exceptions into tool errors.
 */
abstract class AbstractAfterShipTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';

    /**
     * @param  AfterShipService  $service  AfterShip Tracking API client.
     */
    public function __construct(protected AfterShipService $service) {}

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
     * Execute the AfterShip operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $method = static::METHOD;
            if (!method_exists($this->service, $method)) {
                throw new InvalidArgumentException('Unsupported AfterShip operation.');
            }

            return ToolResult::success($this->service->{$method}($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
