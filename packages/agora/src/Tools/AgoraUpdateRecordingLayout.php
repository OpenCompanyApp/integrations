<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Agora\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Agora\AgoraService;
use OpenCompany\Integrations\Agora\Support\AgoraPayload;

/**
 * Update the layout for an active Agora composite recording.
 *
 * Wraps the documented updateLayout endpoint and sends layoutConfig,
 * mixedVideoLayout, and background options through clientRequest.
 */
class AgoraUpdateRecordingLayout implements Tool
{
    /**
     * @param  AgoraService  $service  The Agora Cloud Recording API client.
     */
    public function __construct(
        private AgoraService $service,
    ) {}

    public function name(): string
    {
        return 'agora_update_recording_layout';
    }

    public function description(): string
    {
        return 'Update the video mixing layout for an active Agora composite recording.';
    }

    public function parameters(): array
    {
        return [
            'resource_id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID returned by acquire.'],
            'sid' => ['type' => 'string', 'required' => true, 'description' => 'Recording session ID returned by start.'],
            'cname' => ['type' => 'string', 'required' => true, 'description' => 'Agora channel name used for the recording.'],
            'uid' => ['type' => 'string', 'required' => true, 'description' => 'Recording client UID used in acquire and start.'],
            'mixed_video_layout' => ['type' => 'integer', 'description' => 'Agora mixedVideoLayout value.'],
            'background_color' => ['type' => 'string', 'description' => 'Background color for mixed layout, for example "#000000".'],
            'layout_config' => ['type' => 'array', 'description' => 'Agora layoutConfig array for custom mixed layout regions.'],
            'background_config' => ['type' => 'array', 'description' => 'Agora backgroundConfig array.'],
            'default_user_background_image' => ['type' => 'string', 'description' => 'Default user background image URL.'],
            'client_request' => ['type' => 'object', 'description' => 'Raw updateLayout clientRequest object. Explicit fields above override matching values.'],
        ];
    }

    /**
     * Update a Cloud Recording mixed layout.
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

            if (array_key_exists('mixed_video_layout', $args)) {
                $clientRequest['mixedVideoLayout'] = (int) $args['mixed_video_layout'];
            }

            foreach ([
                'background_color' => 'backgroundColor',
                'default_user_background_image' => 'defaultUserBackgroundImage',
            ] as $argKey => $apiKey) {
                $value = AgoraPayload::optionalString($args, $argKey);
                if ($value !== '') {
                    $clientRequest[$apiKey] = $value;
                }
            }

            foreach ([
                'layout_config' => 'layoutConfig',
                'background_config' => 'backgroundConfig',
            ] as $argKey => $apiKey) {
                $value = AgoraPayload::object($args, $argKey);
                if ($value !== []) {
                    $clientRequest[$apiKey] = array_values($value);
                }
            }

            return ToolResult::success($this->service->updateLayout(
                AgoraPayload::requiredString($args, 'resource_id'),
                AgoraPayload::requiredString($args, 'sid'),
                AgoraPayload::requiredString($args, 'cname'),
                AgoraPayload::requiredString($args, 'uid'),
                $clientRequest,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
