<?php

namespace OpenCompany\Integrations\Arxiv\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Arxiv\ArxivService;

/**
 * Shared implementation for focused arXiv tools.
 */
abstract class AbstractArxivTool implements Tool
{
    protected const TOOL_NAME = '';
    protected const TOOL_DESCRIPTION = '';
    protected const PARAMETERS = [];

    /**
     * @param  ArxivService  $service  arXiv API client.
     */
    public function __construct(
        protected ArxivService $service,
    ) {}

    public function name(): string
    {
        return static::TOOL_NAME;
    }

    public function description(): string
    {
        return static::TOOL_DESCRIPTION;
    }

    public function parameters(): array
    {
        return static::PARAMETERS;
    }

    /**
     * Execute the arXiv operation with common exception handling.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            return ToolResult::success($this->run($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Run the tool-specific operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    abstract protected function run(array $args): array;

    /**
     * Read a required scalar argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function required(array $args, string $key): string
    {
        if (!array_key_exists($key, $args) || $args[$key] === null || $args[$key] === '') {
            throw new \InvalidArgumentException("Missing required argument: {$key}");
        }

        return (string) $args[$key];
    }

    /**
     * Return selected optional arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<int, string>  $keys  Allowed argument keys.
     * @return array<string, mixed>
     */
    protected function optional(array $args, array $keys): array
    {
        $params = [];

        foreach ($keys as $key) {
            if (array_key_exists($key, $args) && $args[$key] !== null && $args[$key] !== '') {
                $params[$key] = $args[$key];
            }
        }

        return $params;
    }
}
