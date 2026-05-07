<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Agora\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Agora\AgoraService;
use OpenCompany\Integrations\Agora\Support\AgoraPayload;

/**
 * Start an Agora Cloud Recording session.
 *
 * Starts individual, composite, or web page recording with caller-provided
 * recording and storage configuration.
 */
class AgoraStartRecording implements Tool
{
    /**
     * @param  AgoraService  $service  The Agora Cloud Recording API client.
     */
    public function __construct(
        private AgoraService $service,
    ) {}

    public function name(): string
    {
        return 'agora_start_recording';
    }

    public function description(): string
    {
        return 'Start an Agora Cloud Recording session using a resource ID returned by agora_acquire_recording_resource.';
    }

    public function parameters(): array
    {
        return [
            'resource_id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID returned by acquire.'],
            'mode' => ['type' => 'string', 'required' => true, 'enum' => ['individual', 'mix', 'web'], 'description' => 'Recording mode: individual, mix, or web.'],
            'cname' => ['type' => 'string', 'required' => true, 'description' => 'Agora channel name to record.'],
            'uid' => ['type' => 'string', 'required' => true, 'description' => 'Recording client UID used in acquire.'],
            'token' => ['type' => 'string', 'description' => 'Optional RTC token for the recording client.'],
            'recording_config' => ['type' => 'object', 'description' => 'Agora recordingConfig object.'],
            'recording_file_config' => ['type' => 'object', 'description' => 'Agora recordingFileConfig object, for example avFileType.'],
            'storage_config' => ['type' => 'object', 'description' => 'Agora storageConfig object for the destination cloud storage.'],
            'snapshot_config' => ['type' => 'object', 'description' => 'Optional snapshotConfig object.'],
            'extension_service_config' => ['type' => 'object', 'description' => 'Optional extensionServiceConfig object for web recording or streaming extensions.'],
            'client_request' => ['type' => 'object', 'description' => 'Raw start clientRequest object. Explicit fields above override matching values.'],
        ];
    }

    /**
     * Start a Cloud Recording session.
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
                'recording_config' => 'recordingConfig',
                'recording_file_config' => 'recordingFileConfig',
                'storage_config' => 'storageConfig',
                'snapshot_config' => 'snapshotConfig',
                'extension_service_config' => 'extensionServiceConfig',
            ] as $argKey => $apiKey) {
                $value = AgoraPayload::object($args, $argKey);
                if ($value !== []) {
                    $clientRequest[$apiKey] = $value;
                }
            }

            $token = AgoraPayload::optionalString($args, 'token');
            if ($token !== '') {
                $clientRequest['token'] = $token;
            }

            return ToolResult::success($this->service->startRecording(
                AgoraPayload::requiredString($args, 'resource_id'),
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
