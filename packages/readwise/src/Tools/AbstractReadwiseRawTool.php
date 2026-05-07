<?php

namespace OpenCompany\Integrations\Readwise\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Readwise\ReadwiseService;

/**
 * Shared executor for guarded raw Readwise API calls.
 */
abstract class AbstractReadwiseRawTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const METHOD = '';

    /**
     * @param  ReadwiseService  $service  Readwise API client.
     */
    public function __construct(protected ReadwiseService $service) {}

    public function name(): string { return static::NAME; }

    public function description(): string { return static::DESCRIPTION; }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Readwise API path.'],
            'payload' => ['type' => 'object', 'description' => 'Query parameters or JSON body.'],
        ];
    }

    /**
     * Execute the raw Readwise request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Readwise integration is not configured.');
            }

            if (($args['path'] ?? '') === '') {
                return ToolResult::error('path is required.');
            }

            $payload = isset($args['payload']) && is_array($args['payload']) ? $args['payload'] : [];
            $method = static::METHOD;

            return ToolResult::success($this->service->{$method}((string) $args['path'], $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
