<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Agora\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Agora\AgoraService;
use OpenCompany\Integrations\Agora\Support\AgoraPayload;

/**
 * Stop an active Agora Cloud Recording session.
 *
 * The resource ID cannot be reused after stop; callers must acquire another
 * resource before starting a new recording.
 */
class AgoraStopRecording implements Tool
{
    /**
     * @param  AgoraService  $service  The Agora Cloud Recording API client.
     */
    public function __construct(
        private AgoraService $service,
    ) {}

    public function name(): string
    {
        return 'agora_stop_recording';
    }

    public function description(): string
    {
        return 'Stop an active Agora Cloud Recording session.';
    }

    public function parameters(): array
    {
        return [
            'resource_id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID returned by acquire.'],
            'sid' => ['type' => 'string', 'required' => true, 'description' => 'Recording session ID returned by start.'],
            'mode' => ['type' => 'string', 'required' => true, 'enum' => ['individual', 'mix', 'web'], 'description' => 'Recording mode: individual, mix, or web.'],
            'cname' => ['type' => 'string', 'required' => true, 'description' => 'Agora channel name used for the recording.'],
            'uid' => ['type' => 'string', 'required' => true, 'description' => 'Recording client UID used in acquire and start.'],
            'async_stop' => ['type' => 'boolean', 'description' => 'Return immediately instead of waiting for files to upload.'],
            'client_request' => ['type' => 'object', 'description' => 'Raw stop clientRequest object. async_stop overrides async_stop inside this object.'],
        ];
    }

    /**
     * Stop a Cloud Recording session.
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

            if (array_key_exists('async_stop', $args)) {
                $clientRequest['async_stop'] = (bool) $args['async_stop'];
            }

            return ToolResult::success($this->service->stopRecording(
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
