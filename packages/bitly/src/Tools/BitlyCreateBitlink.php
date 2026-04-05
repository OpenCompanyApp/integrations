<?php

namespace OpenCompany\Integrations\Bitly\Tools;

use OpenCompany\Integrations\Bitly\BitlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Bitlink with full metadata.
 *
 * Calls POST /bitlinks to create a new shortened link with optional
 * title, tags, custom domain, and group association.
 */
class BitlyCreateBitlink implements Tool
{
    /**
     * Create a new BitlyCreateBitlink tool instance.
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
        return 'bitly_create_bitlink';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does
     */
    public function description(): string
    {
        return 'Create a new Bitlink with title, tags, and optional custom domain. More full-featured than shorten — use this when you need metadata.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array Parameter definitions keyed by parameter name
     */
    public function parameters(): array
    {
        return [
            'long_url' => ['type' => 'string', 'required' => true, 'description' => 'The destination URL to shorten.'],
            'title' => ['type' => 'string', 'description' => 'A descriptive title for the link (e.g., "Q1 Marketing Campaign").'],
            'tags' => ['type' => 'array', 'description' => 'Array of tags to categorize the link (e.g., ["marketing", "q1"]).'],
            'domain' => ['type' => 'string', 'description' => 'Custom short domain (e.g., "bit.ly"). Defaults to account\'s default domain.'],
            'group_guid' => ['type' => 'string', 'description' => 'The GUID of the group to associate this link with.'],
        ];
    }

    /**
     * Execute the tool: create a new Bitlink.
     *
     * @param array $args Tool arguments containing long_url and optional metadata
     *
     * @return ToolResult The created Bitlink data or an error message
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bitly integration is not configured.');
            }

            $longUrl = $args['long_url'] ?? '';
            if (empty($longUrl)) {
                return ToolResult::error('long_url is required.');
            }

            $result = $this->service->createBitlink(
                $longUrl,
                $args['title'] ?? null,
                $args['tags'] ?? null,
                $args['domain'] ?? null,
                $args['group_guid'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
