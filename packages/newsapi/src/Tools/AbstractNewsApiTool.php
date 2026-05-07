<?php

namespace OpenCompany\Integrations\NewsApi\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\NewsApi\NewsApiService;

/**
 * Shared executor for NewsAPI tools.
 *
 * Child classes provide metadata while this base class dispatches service
 * calls and converts exceptions to tool errors.
 */
abstract class AbstractNewsApiTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';

    /**
     * @param  NewsApiService  $service  NewsAPI v2 client.
     */
    public function __construct(protected NewsApiService $service) {}

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
     * Execute the NewsAPI operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            return ToolResult::success(match (static::METHOD) {
                'everything' => $this->service->everything($args),
                'topHeadlines' => $this->service->topHeadlines($args),
                'sources' => $this->service->sources($args),
                default => throw new InvalidArgumentException('Unsupported NewsAPI operation.'),
            });
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
