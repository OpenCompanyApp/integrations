<?php

namespace OpenCompany\Integrations\Box\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Box\BoxService;

/**
 * Base tool for executing one official Box OpenAPI operation.
 */
abstract class AbstractBoxOperationTool implements Tool
{
    protected const OPERATION = '';

    /**
     * @param  BoxService  $service  Box API client.
     */
    public function __construct(
        protected BoxService $service,
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
            'description' => 'Additional documented Box query parameters to pass through exactly as named.',
        ];
        $parameters['body'] = [
            'type' => 'object',
            'description' => 'Request body matching the official Box OpenAPI schema.',
        ];

        return $parameters;
    }

    /**
     * Execute the Box operation with normalized snake_case arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Box integration is not configured. Provide an access token.');
            }

            return ToolResult::success($this->service->call(static::OPERATION, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Return metadata for this Box operation.
     *
     * @return array<string, mixed>
     */
    private function definition(): array
    {
        return $this->service->operation(static::OPERATION);
    }
}
