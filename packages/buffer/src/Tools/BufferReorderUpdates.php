<?php

namespace OpenCompany\Integrations\Buffer\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Reorder pending Buffer updates for a profile.
 */
class BufferReorderUpdates extends AbstractBufferTool
{
    protected const NAME = 'buffer_reorder_updates';
    protected const DESCRIPTION = 'Reorder pending Buffer updates for a profile.';
    protected const METHOD = 'reorderUpdates';

    public function parameters(): array
    {
        return [
            'profileId' => ['type' => 'string', 'required' => true, 'description' => 'The social profile ID.'],
            'order' => ['type' => 'array', 'required' => true, 'description' => 'Ordered array of pending update IDs.'],
            'offset' => ['type' => 'integer', 'description' => 'Optional offset for partial reorder.'],
            'utc' => ['type' => 'boolean', 'description' => 'Return times relative to UTC.'],
        ];
    }

    /**
     * Execute the reorder request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Buffer integration is not configured.');
            }

            if (empty($args['profileId']) || empty($args['order'])) {
                return ToolResult::error('profileId and order are required.');
            }

            return ToolResult::success($this->service->reorderUpdates(
                $args['profileId'],
                $args['order'],
                isset($args['offset']) ? (int) $args['offset'] : null,
                isset($args['utc']) ? (bool) $args['utc'] : null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
