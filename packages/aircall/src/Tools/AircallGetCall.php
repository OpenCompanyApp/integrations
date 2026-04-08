<?php

namespace OpenCompany\Integrations\Aircall\Tools;

use OpenCompany\Integrations\Aircall\AircallService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving a single call from the Aircall API.
 *
 * Returns detailed information about a specific call including duration,
 * direction, status, recording URL, transcripts, and associated contact.
 *
 * @see https://developer.aircall.io/api-references/#retrieve-a-call
 */
class AircallGetCall implements Tool
{
    /**
     * Create a new AircallGetCall tool instance.
     *
     * @param  AircallService  $service  The Aircall API service instance.
     */
    public function __construct(
        private AircallService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'aircall_get_call';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Retrieve detailed information about a specific call in Aircall by its ID. Returns call details including duration, direction, status, recording, and contact information.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'call_id' => ['type' => 'integer', 'required' => true, 'description' => 'The unique identifier of the call to retrieve.'],
        ];
    }

    /**
     * Execute the get call tool.
     *
     * @param  array  $args  The tool arguments containing the call ID.
     * @return ToolResult The result containing the call details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Aircall integration is not configured.');
            }

            $result = $this->service->getCall((int) $args['call_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
