<?php

namespace OpenCompany\Integrations\Miniflux\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Miniflux\MinifluxService;

/**
 * Shared executor for guarded raw Miniflux API calls.
 */
abstract class AbstractMinifluxRawTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const METHOD = '';

    /**
     * @param  MinifluxService  $service  Miniflux API client.
     */
    public function __construct(protected MinifluxService $service) {}

    public function name(): string { return static::NAME; }

    public function description(): string { return static::DESCRIPTION; }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Miniflux API path.'],
            'payload' => ['type' => 'object', 'description' => 'Query parameters or JSON body.'],
        ];
    }

    /**
     * Execute the raw Miniflux request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Miniflux integration is not configured.');
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
