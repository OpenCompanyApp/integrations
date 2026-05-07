<?php

namespace OpenCompany\Integrations\Buffer\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Buffer\BufferService;

/**
 * Shared executor for straightforward Buffer service-backed tools.
 *
 * Child tools declare the service method, required arguments, and whether the
 * operation forwards a payload object.
 */
abstract class AbstractBufferTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const METHOD = '';
    protected const ARGUMENTS = [];
    protected const REQUIRED = [];
    protected const USE_PAYLOAD = false;

    /**
     * @param  BufferService  $service  The Buffer API client.
     */
    public function __construct(
        protected BufferService $service,
    ) {}

    public function name(): string
    {
        return static::NAME;
    }

    public function description(): string
    {
        return static::DESCRIPTION;
    }

    public function parameters(): array
    {
        $parameters = [];

        foreach (static::ARGUMENTS as $argument) {
            $parameters[$argument] = [
                'type' => in_array($argument, ['order'], true) ? 'array' : 'string',
                'required' => in_array($argument, static::REQUIRED, true),
                'description' => str_replace('_', ' ', ucfirst($argument)).'.',
            ];
        }

        if (static::USE_PAYLOAD) {
            $parameters['payload'] = [
                'type' => 'object',
                'required' => in_array('payload', static::REQUIRED, true),
                'description' => 'Request payload fields supported by the Buffer endpoint.',
            ];
        }

        return $parameters;
    }

    /**
     * Execute the Buffer API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Buffer integration is not configured.');
            }

            foreach (static::REQUIRED as $required) {
                if (!isset($args[$required]) || $args[$required] === '') {
                    return ToolResult::error("{$required} is required.");
                }
            }

            $method = static::METHOD;
            $parameters = [];

            foreach (static::ARGUMENTS as $argument) {
                $parameters[] = $args[$argument] ?? null;
            }

            if (static::USE_PAYLOAD) {
                $parameters[] = $args['payload'] ?? [];
            }

            return ToolResult::success($this->service->{$method}(...$parameters));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
