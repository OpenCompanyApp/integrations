<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\CustomerIO\CustomerIOService;

/**
 * Shared executor for official Customer.io API operation tools.
 *
 * Concrete classes select one operation while this base class exposes metadata,
 * validates required arguments, and delegates HTTP behavior to CustomerIOService.
 */
abstract class AbstractCustomerIOOperationTool implements Tool
{
    protected const OPERATION = '';

    /**
     * @param  CustomerIOService  $service  Customer.io API client.
     */
    public function __construct(protected CustomerIOService $service) {}

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
            if (($parameter['param'] ?? '') === '') {
                continue;
            }

            $parameters[(string) $parameter['param']] = [
                'type' => 'string',
                'required' => (bool) $parameter['required'],
                'description' => (string) ($parameter['description'] ?: ucfirst((string) $parameter['source']).' parameter '.$parameter['name'].'.'),
            ];
        }

        preg_match_all('/\{([^}]+)\}/', (string) $this->definition()['path'], $matches);
        foreach ($matches[1] as $name) {
            $param = $this->snake((string) $name);
            $parameters[$param] ??= [
                'type' => 'string',
                'required' => true,
                'description' => 'Path parameter '.$name.'.',
            ];
        }

        if (($this->definition()['request_body'] ?? false) === true) {
            $parameters['payload'] = [
                'type' => 'object',
                'required' => (bool) $this->definition()['request_body_required'],
                'description' => 'Request body fields documented by the Customer.io API for this operation.',
            ];
        }

        return $parameters;
    }

    /**
     * Execute the Customer.io API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            return ToolResult::success($this->service->call(static::OPERATION, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Return operation metadata.
     *
     * @return array<string, mixed>
     */
    private function definition(): array
    {
        return $this->service->operation(static::OPERATION);
    }

    /**
     * Convert OpenAPI path parameter names to tool argument names.
     */
    private function snake(string $value): string
    {
        $value = preg_replace('/([a-z])([A-Z])/', '$1_$2', $value) ?? $value;

        return strtolower(str_replace(['-', '.'], '_', $value));
    }
}
