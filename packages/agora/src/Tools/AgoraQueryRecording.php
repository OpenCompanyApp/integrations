<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Agora\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Agora\AgoraService;
use OpenCompany\Integrations\Agora\Support\AgoraPayload;

/**
 * Query the status of an Agora Cloud Recording session.
 *
 * Returns Agora's normalized JSON response including the resource ID, session
 * ID, serverResponse status, and file or extension service state when present.
 */
class AgoraQueryRecording implements Tool
{
    /**
     * @param  AgoraService  $service  The Agora Cloud Recording API client.
     */
    public function __construct(
        private AgoraService $service,
    ) {}

    public function name(): string
    {
        return 'agora_query_recording';
    }

    public function description(): string
    {
        return 'Query the status of an active Agora Cloud Recording session.';
    }

    public function parameters(): array
    {
        return [
            'resource_id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID returned by acquire.'],
            'sid' => ['type' => 'string', 'required' => true, 'description' => 'Recording session ID returned by start.'],
            'mode' => ['type' => 'string', 'required' => true, 'enum' => ['individual', 'mix', 'web'], 'description' => 'Recording mode: individual, mix, or web.'],
        ];
    }

    /**
     * Query a Cloud Recording session.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Agora integration is not configured.');
            }

            return ToolResult::success($this->service->queryRecording(
                AgoraPayload::requiredString($args, 'resource_id'),
                AgoraPayload::requiredString($args, 'sid'),
                AgoraPayload::requiredString($args, 'mode'),
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
