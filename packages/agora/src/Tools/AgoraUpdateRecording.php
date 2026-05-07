<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Agora\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Agora\AgoraService;
use OpenCompany\Integrations\Agora\Support\AgoraPayload;

/**
 * Update an active Agora Cloud Recording session.
 *
 * Supports Agora's update endpoint for changing subscriptions and selected web
 * recording extension state without restarting the session.
 */
class AgoraUpdateRecording implements Tool
{
    /**
     * @param  AgoraService  $service  The Agora Cloud Recording API client.
     */
    public function __construct(
        private AgoraService $service,
    ) {}

    public function name(): string
    {
        return 'agora_update_recording';
    }

    public function description(): string
    {
        return 'Update an active Agora Cloud Recording subscription list or web recorder state.';
    }

    public function parameters(): array
    {
        return [
            'resource_id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID returned by acquire.'],
            'sid' => ['type' => 'string', 'required' => true, 'description' => 'Recording session ID returned by start.'],
            'mode' => ['type' => 'string', 'required' => true, 'enum' => ['individual', 'mix', 'web'], 'description' => 'Recording mode: individual, mix, or web.'],
            'cname' => ['type' => 'string', 'required' => true, 'description' => 'Agora channel name used for the recording.'],
            'uid' => ['type' => 'string', 'required' => true, 'description' => 'Recording client UID used in acquire and start.'],
            'stream_subscribe' => ['type' => 'object', 'description' => 'Agora streamSubscribe object for subscription updates.'],
            'web_recorder_config' => ['type' => 'object', 'description' => 'Agora webRecorderConfig object for web recording updates.'],
            'rtmp_publish_config' => ['type' => 'object', 'description' => 'Agora rtmpPublishConfig object for web recording stream publishing updates.'],
            'client_request' => ['type' => 'object', 'description' => 'Raw update clientRequest object. Explicit fields above override matching values.'],
        ];
    }

    /**
     * Update a Cloud Recording session.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Agora integration is not configured.');
            }

            $clientRequest = AgoraPayload::object($args, 'client_request');

            foreach ([
                'stream_subscribe' => 'streamSubscribe',
                'web_recorder_config' => 'webRecorderConfig',
                'rtmp_publish_config' => 'rtmpPublishConfig',
            ] as $argKey => $apiKey) {
                $value = AgoraPayload::object($args, $argKey);
                if ($value !== []) {
                    $clientRequest[$apiKey] = $value;
                }
            }

            return ToolResult::success($this->service->updateRecording(
                AgoraPayload::requiredString($args, 'resource_id'),
                AgoraPayload::requiredString($args, 'sid'),
                AgoraPayload::requiredString($args, 'mode'),
                AgoraPayload::requiredString($args, 'cname'),
                AgoraPayload::requiredString($args, 'uid'),
                $clientRequest,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
