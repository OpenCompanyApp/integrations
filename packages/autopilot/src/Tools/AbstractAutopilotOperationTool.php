<?php

namespace OpenCompany\Integrations\Autopilot\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Autopilot\AutopilotService;

/**
 * Shared executor for official Autopilot API operation tools.
 *
 * Concrete classes select one API Blueprint operation while this base class
 * exposes metadata and delegates request execution to AutopilotService.
 */
abstract class AbstractAutopilotOperationTool implements Tool
{
    protected const OPERATION = '';

    /**
     * @param  AutopilotService  $service  Autopilot API client.
     */
    public function __construct(protected AutopilotService $service) {}

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
                'description' => 'JSON request body fields documented by the Autopilot API for this operation.',
            ];
        }

        $parameters['query'] = [
            'type' => 'object',
            'required' => false,
            'description' => 'Optional query parameters documented by Autopilot for this operation.',
        ];

        return $parameters;
    }

    /**
     * Execute the Autopilot API operation.
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
