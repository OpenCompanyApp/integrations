<?php

namespace OpenCompany\Integrations\Apollo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Apollo\ApolloService;

/**
 * Base class for Apollo tools that delegate directly to the service layer.
 *
 * Keeps endpoint tools small while preserving per-tool parameters, slugs, and
 * descriptions for catalog discovery and JavaScript docs.
 */
abstract class AbstractApolloTool implements Tool
{
    protected const NAME = '';

    protected const DESCRIPTION = '';

    protected const PARAMETERS = [];

    /**
     * @param  ApolloService  $service  Apollo API client.
     */
    public function __construct(protected ApolloService $service) {}

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
     * Execute the Apollo tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Apollo integration is not configured.');
            }

            return ToolResult::success($this->callService($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Call the concrete service method for this tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    abstract protected function callService(array $args): array;

    /**
     * Remove null or empty-string arguments before API calls.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function filled(array $args): array
    {
        return array_filter($args, static fn (mixed $value): bool => $value !== null && $value !== '');
    }

    /**
     * Merge an optional free-form filters object with named tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  string[]  $exclude  Argument keys that are not API filters.
     * @return array<string, mixed>
     */
    protected function filters(array $args, array $exclude = []): array
    {
        $filters = is_array($args['filters'] ?? null) ? $args['filters'] : [];

        foreach ($args as $key => $value) {
            if ($key === 'filters' || in_array($key, $exclude, true)) {
                continue;
            }

            $filters[$key] = $value;
        }

        return $this->filled($filters);
    }
}
