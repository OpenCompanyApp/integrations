<?php

namespace OpenCompany\Integrations\Buffer\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Randomize pending Buffer updates for a profile.
 */
class BufferShuffleUpdates extends AbstractBufferTool
{
    protected const NAME = 'buffer_shuffle_updates';
    protected const DESCRIPTION = 'Randomize pending Buffer updates for a profile.';
    protected const METHOD = 'shuffleUpdates';

    public function parameters(): array
    {
        return [
            'profileId' => ['type' => 'string', 'required' => true, 'description' => 'The social profile ID.'],
            'count' => ['type' => 'integer', 'description' => 'Number of updates to return.'],
            'utc' => ['type' => 'boolean', 'description' => 'Return times relative to UTC.'],
        ];
    }

    /**
     * Execute the shuffle request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Buffer integration is not configured.');
            }

            if (empty($args['profileId'])) {
                return ToolResult::error('profileId is required.');
            }

            return ToolResult::success($this->service->shuffleUpdates(
                $args['profileId'],
                isset($args['count']) ? (int) $args['count'] : null,
                isset($args['utc']) ? (bool) $args['utc'] : null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
