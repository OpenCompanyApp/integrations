<?php

namespace OpenCompany\Integrations\Agora\Tools;

use OpenCompany\Integrations\Agora\AgoraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AgoraGetRecording implements Tool
{
    public function __construct(
        private AgoraService $service,
    ) {}

    public function name(): string
    {
        return 'agora_get_recording';
    }

    public function description(): string
    {
        return 'Get details of a specific Agora cloud recording by its session ID (sid), including status, file list, and download URLs.';
    }

    public function parameters(): array
    {
        return [
            'recording_id' => ['type' => 'string', 'required' => true, 'description' => 'The recording session ID (sid).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Agora integration is not configured.');
            }

            if (empty($args['recording_id'])) {
                return ToolResult::error('The recording ID is required.');
            }

            $result = $this->service->getRecording($args['recording_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
