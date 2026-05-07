<?php

namespace OpenCompany\Integrations\Wallabag\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Wallabag\WallabagService;

/**
 * Shared executor for guarded raw wallabag API calls.
 */
abstract class AbstractWallabagRawTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const METHOD = '';

    /**
     * @param  WallabagService  $service  wallabag API client.
     */
    public function __construct(protected WallabagService $service) {}

    public function name(): string { return static::NAME; }

    public function description(): string { return static::DESCRIPTION; }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative wallabag API path.'],
            'payload' => ['type' => 'object', 'description' => 'Query parameters or JSON body.'],
        ];
    }

    /**
     * Execute the raw wallabag request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('wallabag integration is not configured.');
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
