<?php

namespace OpenCompany\Integrations\Svix\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Svix\SvixService;

/**
 * Shared executor for official Svix API operation tools.
 *
 * Concrete classes select one OpenAPI operation while this base class exposes
 * metadata and delegates request execution to SvixService.
 */
abstract class AbstractSvixOperationTool implements Tool
{
    protected const OPERATION = '';

    /**
     * @param  SvixService  $service  Svix API client.
     */
    public function __construct(protected SvixService $service) {}

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
            $definition = [
                'type' => (string) $parameter['type'],
                'required' => (bool) $parameter['required'],
                'description' => (string) $parameter['description'],
            ];

            if (isset($parameter['enum']) && is_array($parameter['enum'])) {
                $definition['enum'] = $parameter['enum'];
            }

            $parameters[(string) $parameter['param']] = $definition;
        }

        if (($this->definition()['request_body'] ?? false) === true) {
            $parameters['payload'] = [
                'type' => 'object',
                'required' => false,
                'description' => 'JSON request body fields documented by the Svix API for this operation.',
            ];
        }

        $parameters['query'] = [
            'type' => 'object',
            'required' => false,
            'description' => 'Optional extra query parameters documented by Svix for this operation.',
        ];

        $parameters['headers'] = [
            'type' => 'object',
            'required' => false,
            'description' => 'Optional extra HTTP headers. Prefer typed parameters such as idempotency_key when available.',
        ];

        return $parameters;
    }

    /**
     * Execute the Svix API operation.
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
}
