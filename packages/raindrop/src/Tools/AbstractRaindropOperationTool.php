<?php

namespace OpenCompany\Integrations\Raindrop\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Raindrop\RaindropService;

/**
 * Shared executor for official Raindrop.io REST API operation tools.
 *
 * Concrete classes select one operation while this base class exposes metadata
 * and delegates HTTP behavior to RaindropService.
 */
abstract class AbstractRaindropOperationTool implements Tool
{
    protected const OPERATION = '';

    /**
     * @param  RaindropService  $service  Raindrop.io API client.
     */
    public function __construct(protected RaindropService $service) {}

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
            $parameters[(string) $parameter['param']] = [
                'type' => 'string',
                'required' => (bool) $parameter['required'],
                'description' => (string) $parameter['description'],
            ];
        }

        $parameters['query'] = [
            'type' => 'object',
            'required' => false,
            'description' => 'Optional query parameters documented by Raindrop.io for this operation.',
        ];

        if (($this->definition()['request_body'] ?? false) === true) {
            $parameters['payload'] = [
                'type' => 'object',
                'required' => false,
                'description' => 'Request body fields documented by Raindrop.io for this operation.',
            ];
        }

        return $parameters;
    }

    /**
     * Execute the Raindrop.io API operation.
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
