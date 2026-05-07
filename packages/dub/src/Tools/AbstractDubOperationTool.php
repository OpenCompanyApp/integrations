<?php

namespace OpenCompany\Integrations\Dub\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Dub\DubService;

/**
 * Shared executor for official Dub API operation tools.
 *
 * Concrete classes select one operation while this base class exposes metadata
 * and delegates HTTP behavior to DubService.
 */
abstract class AbstractDubOperationTool implements Tool
{
    protected const OPERATION = '';

    /**
     * @param  DubService  $service  Dub API client.
     */
    public function __construct(protected DubService $service) {}

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

        if (($this->definition()['request_body'] ?? false) === true) {
            $parameters['payload'] = [
                'type' => 'object',
                'required' => false,
                'description' => 'JSON request body fields documented by the Dub API for this operation.',
            ];
        }

        $parameters['query'] = [
            'type' => 'object',
            'required' => false,
            'description' => 'Optional query parameters documented by Dub for this operation.',
        ];

        return $parameters;
    }

    /**
     * Execute the Dub API operation.
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
