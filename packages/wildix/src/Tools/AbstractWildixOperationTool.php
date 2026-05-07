<?php

namespace OpenCompany\Integrations\Wildix\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Wildix\WildixService;

/**
 * Base tool for executing one official Wildix WMS/PBX API operation.
 */
abstract class AbstractWildixOperationTool implements Tool
{
    protected const OPERATION = '';

    /**
     * @param  WildixService  $service  Wildix WMS/PBX API client.
     */
    public function __construct(
        protected WildixService $service,
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
            'description' => 'Additional documented Wildix query parameters to pass through when a generated operation supports filters.',
        ];
        $parameters['payload'] = [
            'type' => 'object',
            'description' => 'Additional documented Wildix JSON request fields to pass through for write operations.',
        ];

        return $parameters;
    }

    /**
     * Execute the Wildix operation with normalized snake_case arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wildix integration is not configured. Provide an access token and PBX API base URL.');
            }

            return ToolResult::success($this->service->call(static::OPERATION, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Return metadata for this Wildix operation.
     *
     * @return array<string, mixed>
     */
    private function definition(): array
    {
        return $this->service->operation(static::OPERATION);
    }
}
