<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Agora\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Agora\AgoraService;
use OpenCompany\Integrations\Agora\Support\AgoraPayload;

/**
 * Request an Agora Cloud Recording resource ID.
 *
 * The resource ID must be used quickly with startRecording and can be used for
 * only one recording session.
 */
class AgoraAcquireRecordingResource implements Tool
{
    /**
     * @param  AgoraService  $service  The Agora Cloud Recording API client.
     */
    public function __construct(
        private AgoraService $service,
    ) {}

    public function name(): string
    {
        return 'agora_acquire_recording_resource';
    }

    public function description(): string
    {
        return 'Request a resource ID before starting an Agora Cloud Recording session.';
    }

    public function parameters(): array
    {
        return [
            'cname' => ['type' => 'string', 'required' => true, 'description' => 'Agora channel name to record.'],
            'uid' => ['type' => 'string', 'required' => true, 'description' => 'Recording client UID. Must be unique in the channel.'],
            'scene' => ['type' => 'integer', 'description' => 'Optional Agora scene value. Common default is 0.'],
            'resource_expired_hour' => ['type' => 'integer', 'description' => 'Optional resource expiration in hours.'],
            'start_parameter' => ['type' => 'object', 'description' => 'Optional Agora startParameter object for chained acquire/start configuration.'],
            'client_request' => ['type' => 'object', 'description' => 'Raw acquire clientRequest object. Explicit fields above override matching values.'],
        ];
    }

    /**
     * Acquire a Cloud Recording resource ID.
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

            if (array_key_exists('scene', $args)) {
                $clientRequest['scene'] = (int) $args['scene'];
            }

            if (array_key_exists('resource_expired_hour', $args)) {
                $clientRequest['resourceExpiredHour'] = (int) $args['resource_expired_hour'];
            }

            $startParameter = AgoraPayload::object($args, 'start_parameter');
            if ($startParameter !== []) {
                $clientRequest['startParameter'] = $startParameter;
            }

            return ToolResult::success($this->service->acquireResource(
                AgoraPayload::requiredString($args, 'cname'),
                AgoraPayload::requiredString($args, 'uid'),
                $clientRequest,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
