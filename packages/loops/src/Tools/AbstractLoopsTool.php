<?php

namespace OpenCompany\Integrations\Loops\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Loops\LoopsService;

/**
 * Shared executor for Loops API tools.
 *
 * Provides configured-state checks and consistent exception-to-tool-result
 * conversion for endpoint-specific tool classes.
 */
abstract class AbstractLoopsTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';

    /**
     * @param  LoopsService  $service  The Loops API client.
     */
    public function __construct(protected LoopsService $service) {}

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
     * Execute the mapped Loops API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Loops integration is not configured.');
            }

            return ToolResult::success($this->call($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Call the service method for this tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->{static::METHOD}($args);
    }

    /**
     * Merge top-level fields with an optional custom properties object.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function mergeProperties(array $args): array
    {
        $properties = $args['properties'] ?? [];
        unset($args['properties']);

        if (is_array($properties)) {
            foreach ($properties as $key => $value) {
                $args[$key] = $value;
            }
        }

        return $args;
    }
}
