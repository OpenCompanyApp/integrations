<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ElasticEmail\ElasticEmailService;

/**
 * Base class for Elastic Email tools that delegate to ElasticEmailService.
 */
abstract class AbstractElasticEmailTool implements Tool
{
    /**
     * @param  ElasticEmailService  $service  Elastic Email API client.
     */
    public function __construct(protected ElasticEmailService $service) {}

    /**
     * Execute the Elastic Email tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Elastic Email integration is not configured.');
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
     * @return array<string, mixed>|array<int, mixed>
     */
    abstract protected function callService(array $args): array;

    /**
     * Return optional object parameters.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function params(array $args, string $key = 'params'): array
    {
        return is_array($args[$key] ?? null) ? $args[$key] : [];
    }

    /**
     * Return a required string argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function stringArg(array $args, string $key): string
    {
        if (empty($args[$key])) {
            throw new \RuntimeException("{$key} is required.");
        }

        return (string) $args[$key];
    }

    /**
     * Parse a comma-separated or array email list.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<int, string>
     */
    protected function emailListArg(array $args, string $key): array
    {
        $value = $args[$key] ?? null;

        if ($value === null || $value === '') {
            throw new \RuntimeException("{$key} is required.");
        }

        if (is_array($value)) {
            return array_values(array_filter(array_map(static fn ($item): string => trim((string) $item), $value)));
        }

        return array_values(array_filter(array_map('trim', preg_split('/[;,]/', (string) $value) ?: [])));
    }
}
