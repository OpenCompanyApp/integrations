<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vimeo\VimeoService;

/**
 * Get details for a single Vimeo video by its ID.
 *
 * Returns full video metadata including name, description, duration,
 * thumbnails, privacy settings, stats, and embed presets.
 */
class VimeoGetVideo implements Tool
{
    public function __construct(
        private VimeoService $service,
    ) {}

    public function name(): string
    {
        return 'vimeo_get_video';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Vimeo video by its ID. Returns name, description, duration, thumbnails, privacy, stats, and playback links.';
    }

    public function parameters(): array
    {
        return [
            'video_id' => ['type' => 'string', 'required' => true, 'description' => 'The Vimeo video ID (e.g., "123456789").'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Vimeo integration is not configured.');
            }

            $videoId = $args['video_id'] ?? '';
            if (empty($videoId)) {
                return ToolResult::error('video_id is required.');
            }

            $result = $this->service->getVideo($videoId);

            return ToolResult::success([
                'id' => basename($result['uri'] ?? ''),
                'uri' => $result['uri'] ?? '',
                'name' => $result['name'] ?? '',
                'description' => $result['description'] ?? '',
                'duration' => $result['duration'] ?? null,
                'width' => $result['width'] ?? null,
                'height' => $result['height'] ?? null,
                'created_time' => $result['created_time'] ?? null,
                'modified_time' => $result['modified_time'] ?? null,
                'release_time' => $result['release_time'] ?? null,
                'status' => $result['status'] ?? null,
                'privacy' => [
                    'view' => $result['privacy']['view'] ?? null,
                    'embed' => $result['privacy']['embed'] ?? null,
                    'download' => $result['privacy']['download'] ?? null,
                    'comments' => $result['privacy']['comments'] ?? null,
                ],
                'pictures' => $result['pictures']['sizes'] ?? [],
                'stats' => [
                    'plays' => $result['stats']['plays'] ?? null,
                ],
                'link' => $result['link'] ?? '',
                'embed' => $result['embed'] ?? [],
                'tags' => array_map(fn (array $tag) => $tag['name'] ?? '', $result['tags'] ?? []),
                'categories' => array_map(fn (array $cat) => $cat['name'] ?? '', $result['categories'] ?? []),
                'user' => [
                    'name' => $result['user']['name'] ?? '',
                    'uri' => $result['user']['uri'] ?? '',
                    'link' => $result['user']['link'] ?? '',
                ],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
