<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vimeo\VimeoService;

/**
 * List videos for the authenticated Vimeo user.
 *
 * Supports pagination, full-text query search, and filtering by
 * embeddable, playable, privacy, and other dimensions.
 */
class VimeoListVideos implements Tool
{
    public function __construct(
        private VimeoService $service,
    ) {}

    public function name(): string
    {
        return 'vimeo_list_videos';
    }

    public function description(): string
    {
        return 'List videos for the authenticated Vimeo user. Supports pagination, full-text search via query, and filters (e.g., embeddable, playable, privacy). Returns video URIs, names, durations, thumbnails, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of videos per page (1–100, default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'query' => ['type' => 'string', 'description' => 'Full-text search query to filter videos by name or description.'],
            'filter' => ['type' => 'string', 'description' => 'Filter category: "embeddable", "playable", "purchase_price", "privacy".'],
            'filter_embeddable' => ['type' => 'boolean', 'description' => 'When filter is "embeddable": true = only embeddable, false = only non-embeddable.'],
            'filter_playable' => ['type' => 'boolean', 'description' => 'When filter is "playable": true = only playable, false = only non-playable.'],
            'direction' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc".'],
            'sort' => ['type' => 'string', 'description' => 'Sort field: "alphabetical", "comments", "date", "duration", "likes", "plays".'],
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

            $params = [];

            if (isset($args['per_page'])) {
                $params['per_page'] = min(max((int) $args['per_page'], 1), 100);
            }
            if (isset($args['page'])) {
                $params['page'] = max((int) $args['page'], 1);
            }
            if (isset($args['query'])) {
                $params['query'] = $args['query'];
            }
            if (isset($args['filter'])) {
                $params['filter'] = $args['filter'];
            }
            if (isset($args['filter_embeddable'])) {
                $params['filter_embeddable'] = $args['filter_embeddable'] ? 'true' : 'false';
            }
            if (isset($args['filter_playable'])) {
                $params['filter_playable'] = $args['filter_playable'] ? 'true' : 'false';
            }
            if (isset($args['direction'])) {
                $params['direction'] = $args['direction'];
            }
            if (isset($args['sort'])) {
                $params['sort'] = $args['sort'];
            }

            $result = $this->service->listVideos($params);

            $videos = $result['data'] ?? [];
            $paging = $result['paging'] ?? [];

            return ToolResult::success([
                'videos' => array_map(function (array $video) {
                    return [
                        'id' => basename($video['uri'] ?? ''),
                        'uri' => $video['uri'] ?? '',
                        'name' => $video['name'] ?? '',
                        'description' => $video['description'] ?? '',
                        'duration' => $video['duration'] ?? null,
                        'created_time' => $video['created_time'] ?? null,
                        'modified_time' => $video['modified_time'] ?? null,
                        'status' => $video['status'] ?? null,
                        'privacy' => $video['privacy']['view'] ?? null,
                        'pictures' => isset($video['pictures']['sizes']) ? collect($video['pictures']['sizes'])->last() : null,
                        'link' => $video['link'] ?? '',
                    ];
                }, $videos),
                'total' => $result['total'] ?? count($videos),
                'page' => $params['page'] ?? 1,
                'per_page' => $params['per_page'] ?? 25,
                'paging' => [
                    'next' => $paging['next'] ?? null,
                    'previous' => $paging['previous'] ?? null,
                    'first' => $paging['first'] ?? null,
                    'last' => $paging['last'] ?? null,
                ],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
