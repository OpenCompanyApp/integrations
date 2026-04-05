<?php

namespace OpenCompany\Integrations\Bitly\Tools;

use OpenCompany\Integrations\Bitly\BitlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve details for an existing Bitlink.
 *
 * Calls GET /bitlinks/{bitlink} to fetch link metadata including
 * the long URL, title, tags, created/modified timestamps, and more.
 */
class BitlyGetLink implements Tool
{
    /**
     * Create a new BitlyGetLink tool instance.
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
        return 'bitly_get_link';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does
     */
    public function description(): string
    {
        return 'Retrieve details for a Bitlink, including the long URL, title, tags, and timestamps.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array Parameter definitions keyed by parameter name
     */
    public function parameters(): array
    {
        return [
            'bitlink' => ['type' => 'string', 'required' => true, 'description' => 'The Bitlink identifier (e.g., "bit.ly/abc123" or a full Bitly URL).'],
        ];
    }

    /**
     * Execute the tool: fetch Bitlink details.
     *
     * @param array $args Tool arguments containing the bitlink identifier
     *
     * @return ToolResult The Bitlink data or an error message
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

            $result = $this->service->getLink($bitlink);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
