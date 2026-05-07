<?php

namespace OpenCompany\Integrations\Bitly\Tools;

use OpenCompany\Integrations\Bitly\BitlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Shorten a long URL into a Bitlink.
 *
 * Calls POST /shorten with the long URL, optional custom domain,
 * and optional group GUID to create a shortened link.
 */
class BitlyShortenLink implements Tool
{
    /**
     * Create a new BitlyShortenLink tool instance.
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
        return 'bitly_shorten_link';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does
     */
    public function description(): string
    {
        return 'Shorten a long URL into a Bitlink. Returns the shortened URL and link details.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array Parameter definitions keyed by parameter name
     */
    public function parameters(): array
    {
        return [
            'long_url' => ['type' => 'string', 'required' => true, 'description' => 'The long URL to shorten (e.g., "https://example.test/very/long/path").'],
            'domain' => ['type' => 'string', 'description' => 'Custom short domain to use (e.g., "bit.ly", "j.mp"). Defaults to the account\'s default domain.'],
            'group_guid' => ['type' => 'string', 'description' => 'The GUID of the group to associate this link with. If omitted, uses the default group.'],
        ];
    }

    /**
     * Execute the tool: shorten the provided long URL.
     *
     * @param array $args Tool arguments containing long_url, and optionally domain and group_guid
     *
     * @return ToolResult The shortened link data or an error message
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

            $result = $this->service->shortenLink(
                $longUrl,
                $args['domain'] ?? null,
                $args['group_guid'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
