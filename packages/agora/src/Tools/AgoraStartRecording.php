<?php

namespace OpenCompany\Integrations\Agora\Tools;

use OpenCompany\Integrations\Agora\AgoraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AgoraStartRecording implements Tool
{
    public function __construct(
        private AgoraService $service,
    ) {}

    public function name(): string
    {
        return 'agora_start_recording';
    }

    public function description(): string
    {
        return 'Start a cloud recording for an Agora channel. Specify the channel name, UID, and recording configuration such as container format, storage settings, and layout.';
    }

    public function parameters(): array
    {
        return [
            'cname' => ['type' => 'string', 'required' => true, 'description' => 'The channel name to record.'],
            'uid' => ['type' => 'string', 'required' => true, 'description' => 'The user ID of the recording client in the channel.'],
            'clientRequest' => ['type' => 'object', 'description' => 'Recording configuration including recordingConfig and storageConfig (e.g., {"recordingConfig": {"maxIdleTime": 30, "streamTypes": 2}, "storageConfig": {"vendor": 1, "region": 0, "bucket": "my-bucket", "accessKey": "...", "secretKey": "...", "fileNamePrefix": ["recording"]}}).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Agora integration is not configured.');
            }

            if (empty($args['cname'])) {
                return ToolResult::error('The channel name (cname) is required.');
            }

            if (empty($args['uid'])) {
                return ToolResult::error('The user ID (uid) is required.');
            }

            $data = [
                'cname' => $args['cname'],
                'uid' => $args['uid'],
            ];

            if (isset($args['clientRequest'])) {
                $data['clientRequest'] = is_string($args['clientRequest'])
                    ? json_decode($args['clientRequest'], true) ?? []
                    : $args['clientRequest'];
            }

            $result = $this->service->startRecording($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
