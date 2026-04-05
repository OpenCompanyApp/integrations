<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vimeo\VimeoService;

/**
 * List albums (showcases) for the authenticated Vimeo user.
 *
 * Returns paginated album listings with metadata like name, description,
 * thumbnail, and video count.
 */
class VimeoListAlbums implements Tool
{
    public function __construct(
        private VimeoService $service,
    ) {}

    public function name(): string
    {
        return 'vimeo_list_albums';
    }

    public function description(): string
    {
        return 'List albums (showcases) for the authenticated Vimeo user. Supports pagination, query search, sorting, and direction. Returns album names, descriptions, thumbnails, and video counts.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of albums per page (1–100, default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'query' => ['type' => 'string', 'description' => 'Full-text search query to filter albums by name or description.'],
            'sort' => ['type' => 'string', 'description' => 'Sort field: "alphabetical", "date", "duration", "manual", "modified_time", "name".'],
            'direction' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc".'],
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
            if (isset($args['sort'])) {
                $params['sort'] = $args['sort'];
            }
            if (isset($args['direction'])) {
                $params['direction'] = $args['direction'];
            }

            $result = $this->service->listAlbums($params);

            $albums = $result['data'] ?? [];
            $paging = $result['paging'] ?? [];

            return ToolResult::success([
                'albums' => array_map(function (array $album) {
                    return [
                        'id' => basename($album['uri'] ?? ''),
                        'uri' => $album['uri'] ?? '',
                        'name' => $album['name'] ?? '',
                        'description' => $album['description'] ?? '',
                        'link' => $album['link'] ?? '',
                        'created_time' => $album['created_time'] ?? null,
                        'modified_time' => $album['modified_time'] ?? null,
                        'privacy' => $album['privacy'] ?? null,
                        'pictures' => isset($album['pictures']['sizes']) ? collect($album['pictures']['sizes'])->last() : null,
                        'metadata' => [
                            'connections' => [
                                'videos' => $album['metadata']['connections']['videos']['total'] ?? null,
                            ],
                        ],
                    ];
                }, $albums),
                'total' => $result['total'] ?? count($albums),
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
