<?php

namespace OpenCompany\Integrations\Plivo\Tools;

use OpenCompany\Integrations\Plivo\PlivoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving details of a specific call from the Plivo API.
 *
 * Returns call details including duration, direction, status, call UUID,
 * from/to numbers, start/end times, and recording information.
 *
 * @see https://www.plivo.com/docs/voice/api/call#get-a-call
 */
class PlivoGetCall implements Tool
{
    /**
     * Create a new PlivoGetCall tool instance.
     *
     * @param  PlivoService  $service  The Plivo API service instance.
     */
    public function __construct(
        private PlivoService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'plivo_get_call';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Retrieve detailed information about a specific Plivo call by its call UUID. Returns call details including duration, direction, status, and recording information.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'call_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique call UUID to retrieve.'],
        ];
    }

    /**
     * Execute the get call tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments containing the call UUID.
     * @return ToolResult The result containing call details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Plivo integration is not configured.');
            }

            $result = $this->service->getCall($args['call_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
