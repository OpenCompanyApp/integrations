<?php

namespace OpenCompany\Integrations\Devin\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Devin\DevinService;

/**
 * Add tags to a Devin session.
 *
 * Uses the current v3 append-tags endpoint or legacy v1 tag update endpoint.
 */
class DevinAppendSessionTags implements Tool
{
    /**
     * @param  DevinService  $service  The Devin API client.
     */
    public function __construct(
        private DevinService $service,
    ) {}

    public function name(): string
    {
        return 'devin_append_session_tags';
    }

    public function description(): string
    {
        return 'Append tags to a Devin session.';
    }

    public function parameters(): array
    {
        return [
            'session_id' => ['type' => 'string', 'required' => true, 'description' => 'The Devin session ID.'],
            'tags' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'string'], 'description' => 'Tags to append.'],
        ];
    }

    /**
     * Append session tags.
     *
     * @param  array<string, mixed>  $args  Tool arguments (session_id, tags).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Devin integration is not configured.');
            }

            return ToolResult::success($this->service->appendSessionTags($args['session_id'], $args['tags']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
