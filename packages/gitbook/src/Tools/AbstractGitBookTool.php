<?php

namespace OpenCompany\Integrations\GitBook\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\GitBook\GitBookService;

/**
 * Shared executor for GitBook tools.
 *
 * Child classes provide metadata while this base class dispatches to explicit
 * service methods and converts exceptions into tool errors.
 */
abstract class AbstractGitBookTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';

    /**
     * @param  GitBookService  $service  GitBook API client.
     */
    public function __construct(protected GitBookService $service) {}

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
     * Execute the GitBook operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $method = static::METHOD;
            if (!method_exists($this->service, $method)) {
                throw new InvalidArgumentException('Unsupported GitBook operation.');
            }

            return ToolResult::success($this->service->{$method}($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
