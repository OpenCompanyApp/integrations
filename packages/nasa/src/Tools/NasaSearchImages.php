<?php

namespace OpenCompany\Integrations\Nasa\Tools;

use OpenCompany\Integrations\Nasa\NasaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search NASA Image and Video Library assets.
 */
class NasaSearchImages implements Tool
{
    /**
     * Create a new NasaSearchImages tool instance.
     *
     * @param  NasaService  $service  The NASA service for making API calls.
     */
    public function __construct(
        private NasaService $service,
    ) {}

    /**
     * Get the tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'nasa_search_images';
    }

    /**
     * Get the tool description for AI agent context.
     */
    public function description(): string
    {
        return 'Search the NASA Image and Video Library for space, astronomy, and mission imagery. Returns image URLs, titles, descriptions, and metadata from NASA\'s vast collection.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'q' => ['type' => 'string', 'required' => true, 'description' => 'The search query (e.g., "moon landing", "Mars", "black hole", "Saturn rings").'],
            'media_type' => ['type' => 'string', 'description' => 'Filter by media type: "image", "video", or "audio". Defaults to all types.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default 1).'],
            'year_start' => ['type' => 'string', 'description' => 'Optional starting year for media creation date filtering.'],
            'year_end' => ['type' => 'string', 'description' => 'Optional ending year for media creation date filtering.'],
            'center' => ['type' => 'string', 'description' => 'Optional NASA center filter such as JPL, KSC, or GSFC.'],
            'keywords' => ['type' => 'string', 'description' => 'Optional comma-separated keyword filter.'],
            'nasa_id' => ['type' => 'string', 'description' => 'Optional exact NASA media ID filter.'],
        ];
    }

    /**
     * Execute the search images tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The image search results.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('NASA integration is not configured.');
            }

            $result = $this->service->searchImages(
                q: $args['q'],
                mediaType: $args['media_type'] ?? null,
                page: isset($args['page']) ? (int) $args['page'] : null,
                filters: array_intersect_key($args, array_flip(['year_start', 'year_end', 'center', 'keywords', 'nasa_id'])),
            );

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the image search response into a clean structure.
     *
     * @param  array<string, mixed>  $result  The raw API response.
     * @return array<string, mixed> The formatted search results.
     */
    private function formatResponse(array $result): array
    {
        $collection = $result['collection'] ?? [];
        $items = $collection['items'] ?? [];

        $formatted = array_map(function (array $item): array {
            $data = $item['data'][0] ?? [];
            $links = $item['links'] ?? [];

            $imageUrls = array_values(array_map(function (array $link): string {
                return $link['href'] ?? '';
            }, array_filter($links, function (array $link): bool {
                return ($link['render'] ?? '') === 'image' || isset($link['href']);
            })));

            return [
                'nasa_id' => $data['nasa_id'] ?? null,
                'title' => $data['title'] ?? null,
                'description' => $data['description'] ?? null,
                'date_created' => $data['date_created'] ?? null,
                'media_type' => $data['media_type'] ?? null,
                'keywords' => $data['keywords'] ?? [],
                'center' => $data['center'] ?? null,
                'photographer' => $data['photographer'] ?? null,
                'thumbnail' => $imageUrls[0] ?? null,
                'links' => $imageUrls,
            ];
        }, $items);

        return [
            'items' => $formatted,
            'total_hits' => $collection['metadata']['total_hits'] ?? count($formatted),
            'count' => count($formatted),
        ];
    }
}
