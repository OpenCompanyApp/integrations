<?php

namespace OpenCompany\Integrations\Canva\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Canva\CanvaService;

/**
 * Shared executor for official Canva Connect API operation tools.
 *
 * Concrete classes select one operation while this base class exposes metadata,
 * validates required arguments, and delegates HTTP behavior to CanvaService.
 */
abstract class AbstractCanvaOperationTool implements Tool
{
    protected const OPERATION = '';

    /**
     * @param  CanvaService  $service  Canva Connect API client.
     */
    public function __construct(protected CanvaService $service) {}

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
            if (($this->definition()['content_type'] ?? '') === 'application/octet-stream') {
                $parameters['body'] = [
                    'type' => 'string',
                    'required' => (bool) $this->definition()['request_body_required'],
                    'description' => 'Raw binary request body as a string. Use the required metadata header parameter when Canva requires upload metadata.',
                ];
            } else {
                $parameters['payload'] = [
                    'type' => 'object',
                    'required' => (bool) $this->definition()['request_body_required'],
                    'description' => 'Request body fields documented by the Canva Connect API for this operation.',
                ];
            }
        }

        return $parameters;
    }

    /**
     * Execute the Canva Connect API operation.
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
