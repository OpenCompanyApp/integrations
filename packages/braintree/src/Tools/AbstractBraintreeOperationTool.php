<?php

namespace OpenCompany\Integrations\Braintree\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Braintree\BraintreeService;

/**
 * Base tool for executing one official Braintree GraphQL operation field.
 */
abstract class AbstractBraintreeOperationTool implements Tool
{
    protected const OPERATION = '';

    /**
     * @param  BraintreeService  $service  Braintree GraphQL client.
     */
    public function __construct(
        protected BraintreeService $service,
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
        $parameters['selection'] = ['type' => 'string', 'description' => 'GraphQL selection set for object results, for example `id legacyId status`. Defaults to `__typename` when omitted.'];
        $parameters['variables'] = ['type' => 'object', 'description' => 'Additional GraphQL variables by original schema variable name.'];
        return $parameters;
    }

    /**
     * Execute the Braintree operation with normalized snake_case arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Braintree credentials are not configured. Provide public/private keys or an OAuth access token.');
            }
            return ToolResult::success($this->service->call(static::OPERATION, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Return metadata for this Braintree operation.
     *
     * @return array<string, mixed>
     */
    private function definition(): array
    {
        return $this->service->operation(static::OPERATION);
    }
}