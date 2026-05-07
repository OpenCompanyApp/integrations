<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vimeo\VimeoService;

/**
 * Create a new video upload slot on Vimeo.
 *
 * Initiates an upload using the specified approach (pull, post, or streaming).
 * Returns the upload URL or link along with the new video URI.
 */
class VimeoCreateVideo implements Tool
{
    /**
     * @param  VimeoService  $service  The Vimeo API client.
     */
    public function __construct(
        private VimeoService $service,
    ) {}

    public function name(): string
    {
        return 'vimeo_create_video';
    }

    public function description(): string
    {
        return 'Create a new video upload slot on Vimeo. Choose an upload approach: "pull" (Vimeo downloads from a URL), "post" (you POST to an upload link), or "streaming" (Tus protocol). Returns the video URI and upload target.';
    }

    public function parameters(): array
    {
        return [
            'upload_approach' => [
                'type' => 'string',
                'description' => 'Upload method: "pull" (Vimeo fetches from URL), "post" (direct upload), or "streaming" (Tus). Default: "post".',
                'enum' => ['pull', 'post', 'streaming'],
            ],
            'upload_link' => [
                'type' => 'string',
                'description' => 'Required when upload_approach is "pull". The URL Vimeo will download the video from.',
            ],
            'name' => [
                'type' => 'string',
                'description' => 'Title of the video.',
            ],
            'description' => [
                'type' => 'string',
                'description' => 'Description of the video.',
            ],
            'privacy' => [
                'type' => 'string',
                'description' => 'Privacy setting: "anybody", "nobody", "contacts", "password", "unlisted", "disable".',
                'enum' => ['anybody', 'nobody', 'contacts', 'password', 'unlisted', 'disable'],
            ],
            'password' => [
                'type' => 'string',
                'description' => 'Required when privacy is "password".',
            ],
            'folder_uri' => [
                'type' => 'string',
                'description' => 'URI of a folder (project) to add the video to after creation.',
            ],
        ];
    }

    /**
     * Create a video upload resource.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Vimeo integration is not configured.');
            }

            $approach = $args['upload_approach'] ?? 'post';
            $data = [
                'upload' => [
                    'approach' => $approach,
                ],
            ];

            if ($approach === 'pull' && isset($args['upload_link'])) {
                $data['upload']['link'] = $args['upload_link'];
            } elseif ($approach === 'pull') {
                return ToolResult::error('upload_link is required when upload_approach is "pull".');
            }

            if (isset($args['name'])) {
                $data['name'] = $args['name'];
            }
            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }
            if (isset($args['privacy'])) {
                $data['privacy'] = ['view' => $args['privacy']];
                if ($args['privacy'] === 'password' && isset($args['password'])) {
                    $data['password'] = $args['password'];
                }
            }

            $result = $this->service->createVideo($data);

            $upload = $result['upload'] ?? [];

            return ToolResult::success([
                'id' => basename($result['uri'] ?? ''),
                'uri' => $result['uri'] ?? '',
                'name' => $result['name'] ?? '',
                'link' => $result['link'] ?? '',
                'upload' => [
                    'status' => $upload['status'] ?? '',
                    'approach' => $upload['approach'] ?? $approach,
                    'upload_link' => $upload['upload_link'] ?? null,
                    'link' => $upload['link'] ?? null,
                    'size' => $upload['size'] ?? null,
                ],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
