<?php

namespace OpenCompany\Integrations\Avalara\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Avalara\AvalaraService;

/**
 * Base tool for executing one official Avalara AvaTax REST API operation.
 */
abstract class AbstractAvalaraOperationTool implements Tool
{
    protected const OPERATION = '';

    /**
     * @param  AvalaraService  $service  Avalara AvaTax REST API client.
     */
    public function __construct(
        protected AvalaraService $service,
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

        $parameters['query'] = ['type' => 'object', 'description' => 'Additional documented AvaTax query parameters to pass through by original API name, for example $include, $filter, $top, $skip, or $orderBy.'];
        $parameters['body'] = ['type' => 'object', 'description' => 'JSON request body to send exactly as documented by Avalara for write operations.'];

        return $parameters;
    }

    /**
     * Execute the Avalara operation with normalized snake_case arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Avalara integration is not configured. Provide either an access token or Account ID plus license key.');
            }

            return ToolResult::success($this->service->call(static::OPERATION, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Return metadata for this Avalara operation.
     *
     * @return array<string, mixed>
     */
    private function definition(): array
    {
        return $this->service->operation(static::OPERATION);
    }
}