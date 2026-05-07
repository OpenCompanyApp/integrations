<?php

namespace OpenCompany\Integrations\UsCensus\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\UsCensus\UsCensusService;

/**
 * Shared executor for US Census tools.
 *
 * Child classes provide static metadata while this base class dispatches to
 * explicit service methods and converts exceptions into tool errors.
 */
abstract class AbstractUsCensusTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';

    /**
     * @param  UsCensusService  $service  Census Data API client.
     */
    public function __construct(protected UsCensusService $service) {}

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
     * Execute the US Census operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $method = static::METHOD;
            if (!method_exists($this->service, $method)) {
                throw new InvalidArgumentException('Unsupported US Census operation.');
            }

            return ToolResult::success($this->service->{$method}($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
