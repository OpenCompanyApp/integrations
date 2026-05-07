<?php

namespace OpenCompany\Integrations\Apify\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Apify\ApifyService;

/**
 * Base tool for executing one official Apify OpenAPI operation.
 */
abstract class AbstractApifyOperationTool implements Tool
{
    protected const OPERATION = '';

    /**
     * @param  ApifyService  $service  Apify API client.
     */
    public function __construct(
        protected ApifyService $service,
    ) {}

    public function name(): string
    {
        return (string) $this->definition()['slug'];
    }

    public function description(): string
    {
        return (string) $this->definition()['description'];
    }

    public function parameters(): array
    {
        $parameters = [];

        foreach ($this->definition()['parameters'] as $parameter) {
            $parameters[(string) $parameter['param']] = array_filter([
                'type' => $parameter['type'] ?? 'string',
                'required' => $parameter['required'] ?? false,
                'description' => $parameter['description'] ?? null,
            ], static fn ($value): bool => $value !== null);
        }

        $parameters['query'] = [
            'type' => 'object',
            'description' => 'Additional documented Apify query parameters to pass through exactly as named.',
        ];
        $parameters['body'] = [
            'type' => 'object',
            'description' => 'JSON request body matching the official Apify OpenAPI schema.',
        ];

        return $parameters;
    }

    /**
     * Execute the Apify operation with normalized snake_case arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Apify integration is not configured. Provide an API token.');
            }

            return ToolResult::success($this->service->call(static::OPERATION, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Return metadata for this Apify operation.
     *
     * @return array<string, mixed>
     */
    private function definition(): array
    {
        return $this->service->operation(static::OPERATION);
    }
}
