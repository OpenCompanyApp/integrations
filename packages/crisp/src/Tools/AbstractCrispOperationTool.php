<?php

namespace OpenCompany\Integrations\Crisp\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Crisp\CrispService;

/**
 * Base tool for executing one official Crisp REST API operation.
 */
abstract class AbstractCrispOperationTool implements Tool
{
    protected const OPERATION = '';

    /**
     * @param  CrispService  $service  Crisp REST API client.
     */
    public function __construct(
        protected CrispService $service,
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

        $parameters['query'] = ['type' => 'object', 'description' => 'Additional Crisp query parameters to pass through exactly as documented.'];
        $parameters['payload'] = ['type' => 'object', 'description' => 'JSON body payload to send exactly as documented by Crisp. Prefer this for complex write operations.'];

        return $parameters;
    }

    /**
     * Execute the Crisp operation with normalized snake_case arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Crisp integration is not configured. Provide token identifier, token key, tier, and a default website ID when using website-scoped tools.');
            }

            return ToolResult::success($this->service->call(static::OPERATION, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Return metadata for this Crisp operation.
     *
     * @return array<string, mixed>
     */
    private function definition(): array
    {
        return $this->service->operation(static::OPERATION);
    }
}
