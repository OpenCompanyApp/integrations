<?php

namespace OpenCompany\Integrations\Agora\Tools;

use OpenCompany\Integrations\Agora\AgoraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AgoraCreateProject implements Tool
{
    public function __construct(
        private AgoraService $service,
    ) {}

    public function name(): string
    {
        return 'agora_create_project';
    }

    public function description(): string
    {
        return 'Create a new Agora project. Specify a project name and optional configuration such as recording settings and authentication mode.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'A unique name for the project.'],
            'recording_config' => ['type' => 'object', 'description' => 'Recording configuration as a JSON object (e.g., {"max_idle_time": 30, "stream_types": 2}).'],
            'sign_key' => ['type' => 'boolean', 'description' => 'Whether to enable a signaling key for the project (default: false).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Agora integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('The project name is required.');
            }

            $data = ['name' => $args['name']];

            if (isset($args['recording_config'])) {
                $data['recording_config'] = is_string($args['recording_config'])
                    ? json_decode($args['recording_config'], true) ?? []
                    : $args['recording_config'];
            }

            if (isset($args['sign_key'])) {
                $data['sign_key'] = (bool) $args['sign_key'];
            }

            $result = $this->service->createProject($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
