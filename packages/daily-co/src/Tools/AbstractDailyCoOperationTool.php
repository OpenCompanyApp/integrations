<?php

namespace OpenCompany\Integrations\DailyCo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\DailyCo\DailyCoService;

/**
 * Shared executor for official Daily REST API operation tools.
 *
 * Concrete classes select one operation while this base class exposes metadata
 * and delegates HTTP behavior to DailyCoService.
 */
abstract class AbstractDailyCoOperationTool implements Tool
{
    protected const OPERATION = '';

    /**
     * @param  DailyCoService  $service  Daily REST API client.
     */
    public function __construct(protected DailyCoService $service) {}

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
                'type' => (string) $parameter['type'],
                'required' => (bool) $parameter['required'],
                'description' => (string) $parameter['description'],
            ];
        }

        if (($this->definition()['request_body'] ?? false) === true) {
            $parameters['payload'] = [
                'type' => 'object',
                'required' => false,
                'description' => 'JSON request body fields documented by the Daily REST API for this operation.',
            ];
        }

        $parameters['query'] = [
            'type' => 'object',
            'required' => false,
            'description' => 'Optional query parameters documented by Daily for this operation.',
        ];

        return $parameters;
    }

    /**
     * Execute the Daily REST API operation.
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
