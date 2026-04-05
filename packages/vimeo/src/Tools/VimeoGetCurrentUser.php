<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vimeo\VimeoService;

/**
 * Get the authenticated Vimeo user's profile.
 *
 * Returns account info including name, bio, location, profile pictures,
 * upload quota, and account type.
 */
class VimeoGetCurrentUser implements Tool
{
    public function __construct(
        private VimeoService $service,
    ) {}

    public function name(): string
    {
        return 'vimeo_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Vimeo user\'s profile information. Returns name, bio, location, account type, upload quota, and profile pictures.';
    }

    public function parameters(): array
    {
        return [];
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

            $result = $this->service->getCurrentUser();

            $uploadQuota = $result['upload_quota'] ?? [];

            return ToolResult::success([
                'id' => basename($result['uri'] ?? ''),
                'uri' => $result['uri'] ?? '',
                'name' => $result['name'] ?? '',
                'bio' => $result['bio'] ?? '',
                'location' => $result['location'] ?? '',
                'link' => $result['link'] ?? '',
                'created_time' => $result['created_time'] ?? null,
                'account' => $result['account'] ?? '',
                'pictures' => $result['pictures']['sizes'] ?? [],
                'upload_quota' => [
                    'space' => [
                        'free' => $uploadQuota['space']['free'] ?? null,
                        'max' => $uploadQuota['space']['max'] ?? null,
                        'showing' => $uploadQuota['space']['showing'] ?? null,
                    ],
                ],
                'metadata' => [
                    'connections' => [
                        'videos' => $result['metadata']['connections']['videos']['total'] ?? null,
                        'albums' => $result['metadata']['connections']['albums']['total'] ?? null,
                        'followers' => $result['metadata']['connections']['followers']['total'] ?? null,
                        'following' => $result['metadata']['connections']['following']['total'] ?? null,
                    ],
                ],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
