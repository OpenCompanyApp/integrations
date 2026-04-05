<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

use OpenCompany\Integrations\Vimeo\VimeoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

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
        return 'List videos for the authenticated Vimeo user. Returns paginated results with video metadata.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (1-based, default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of videos per page (max 100, default: 25).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vimeo integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 25;

            $result = $this->service->listVideos($page, $perPage);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the Vimeo list videos response.
     *
     * @param  array<string, mixed>  $result
     * @return array<string, mixed>
     */
    private function formatResponse(array $result): array
    {
        $videos = array_map(function (array $video): array {
            return [
                'id' => $video['uri'] ?? null,
                'name' => $video['name'] ?? null,
                'description' => $video['description'] ?? null,
                'duration' => $video['duration'] ?? null,
                'status' => $video['status'] ?? null,
                'link' => $video['link'] ?? null,
                'created_time' => $video['created_time'] ?? null,
                'pictures' => $video['pictures'] ?? null,
            ];
        }, $result['data'] ?? []);

        return [
            'videos' => $videos,
            'total' => $result['total'] ?? count($videos),
            'page' => $result['page'] ?? 1,
            'per_page' => $result['per_page'] ?? 25,
            'last_page' => ($result['paging']['last'] ?? null) !== null
                ? $this->extractPageFromUri($result['paging']['last'])
                : ($result['page'] ?? 1),
        ];
    }

    /**
     * Extract the page query parameter from a Vimeo paging URI.
     */
    private function extractPageFromUri(?string $uri): ?int
    {
        if ($uri === null) {
            return null;
        }

        $query = parse_url($uri, PHP_URL_QUERY);
        if ($query === null) {
            return null;
        }

        parse_str($query, $params);

        return isset($params['page']) ? (int) $params['page'] : null;
    }
}
