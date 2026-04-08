<?php

namespace OpenCompany\Integrations\Gong\Tools;

use OpenCompany\Integrations\Gong\GongService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving detailed information about a specific Gong call.
 *
 * Fetches full call metadata including transcript, participants,
 * and analytics via the Gong GET /v2/calls/{id} endpoint.
 */
class GongGetCall implements Tool
{
    /**
     * Create a new GongGetCall tool instance.
     */
    public function __construct(
        private GongService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gong_get_call';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific call in Gong, including metadata, participants, and tracking data.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'callId' => ['type' => 'string', 'required' => true, 'description' => 'The unique call identifier.'],
        ];
    }

    /**
     * Execute the get call tool.
     *
     * @param  array  $args  Tool arguments containing the callId.
     * @return ToolResult The result containing call details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gong integration is not configured.');
            }

            $result = $this->service->getCall($args['callId']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
