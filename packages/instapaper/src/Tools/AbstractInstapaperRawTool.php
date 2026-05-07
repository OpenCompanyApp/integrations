<?php

namespace OpenCompany\Integrations\Instapaper\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Instapaper\InstapaperService;

/**
 * Shared executor for guarded raw Instapaper Full API calls.
 */
abstract class AbstractInstapaperRawTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const METHOD = '';

    /**
     * @param  InstapaperService  $service  Instapaper API client.
     */
    public function __construct(protected InstapaperService $service) {}

    public function name(): string { return static::NAME; }

    public function description(): string { return static::DESCRIPTION; }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Instapaper Full API path.'],
            'payload' => ['type' => 'object', 'description' => 'Form body fields.'],
        ];
    }

    /**
     * Execute the raw Instapaper request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instapaper integration is not configured.');
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
