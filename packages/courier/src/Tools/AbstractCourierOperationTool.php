<?php

namespace OpenCompany\Integrations\Courier\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Courier\CourierService;

/**
 * Shared executor for official Courier API operation tools.
 *
 * Concrete classes select one operation while this base class exposes metadata,
 * validates required arguments, and delegates HTTP behavior to CourierService.
 */
abstract class AbstractCourierOperationTool implements Tool
{
    protected const OPERATION = '';

    /**
     * @param  CourierService  $service  Courier API client.
     */
    public function __construct(protected CourierService $service) {}

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
                'description' => (string) ($parameter['description'] ?: ucfirst((string) $parameter['source']).' parameter '.$parameter['name'].'.'),
            ];
        }

        if (($this->definition()['request_body'] ?? false) === true) {
            $parameters['payload'] = [
                'type' => 'object',
                'required' => (bool) $this->definition()['request_body_required'],
                'description' => 'Request body fields documented by the Courier API for this operation.',
            ];
        }

        return $parameters;
    }

    /**
     * Execute the Courier API operation.
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
