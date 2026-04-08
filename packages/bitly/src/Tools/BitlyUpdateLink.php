<?php

namespace OpenCompany\Integrations\Bitly\Tools;

use OpenCompany\Integrations\Bitly\BitlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Bitlink's metadata.
 *
 * Calls PATCH /bitlinks/{bitlink} to modify the link's title,
 * archived status, tags, or other editable fields.
 */
class BitlyUpdateLink implements Tool
{
    /**
     * Create a new BitlyUpdateLink tool instance.
     *
     * @param BitlyService $service The Bitly API service
     */
    public function __construct(
        private BitlyService $service,
    ) {}

    /**
     * Get the tool name.
     *
     * @return string The tool identifier
     */
    public function name(): string
    {
        return 'bitly_update_link';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does
     */
    public function description(): string
    {
        return 'Update a Bitlink\'s metadata — set the title, archive/unarchive, or update tags.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array Parameter definitions keyed by parameter name
     */
    public function parameters(): array
    {
        return [
            'bitlink' => ['type' => 'string', 'required' => true, 'description' => 'The Bitlink identifier (e.g., "bit.ly/abc123").'],
            'title' => ['type' => 'string', 'description' => 'A descriptive title for the link.'],
            'archived' => ['type' => 'boolean', 'description' => 'Whether to archive the link (true) or restore it (false).'],
            'tags' => ['type' => 'array', 'description' => 'Array of tags to assign to the link (e.g., ["marketing", "campaign"]).'],
        ];
    }

    /**
     * Execute the tool: update the specified Bitlink.
     *
     * @param array $args Tool arguments containing the bitlink and fields to update
     *
     * @return ToolResult The updated Bitlink data or an error message
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bitly integration is not configured.');
            }

            $bitlink = $args['bitlink'] ?? '';
            if (empty($bitlink)) {
                return ToolResult::error('bitlink is required.');
            }

            $data = [];
            if (isset($args['title'])) {
                $data['title'] = $args['title'];
            }
            if (isset($args['archived'])) {
                $data['archived'] = (bool) $args['archived'];
            }
            if (isset($args['tags'])) {
                $data['tags'] = $args['tags'];
            }

            if (empty($data)) {
                return ToolResult::error('At least one of title, archived, or tags must be provided.');
            }

            $result = $this->service->updateLink($bitlink, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
