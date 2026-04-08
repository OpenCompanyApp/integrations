<?php

namespace OpenCompany\Integrations\Contentful\Tools;

use OpenCompany\Integrations\Contentful\ContentfulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List assets in the Contentful space.
 */
class ContentfulListAssets implements Tool
{
    /**
     * @param  ContentfulService  $service  The Contentful API client
     */
    public function __construct(
        private ContentfulService $service,
    ) {}

    public function name(): string
    {
        return 'contentful_list_assets';
    }

    public function description(): string
    {
        return <<<'MD'
        List assets (images, files, videos) in the Contentful space.
        Supports pagination with limit and skip parameters.
        Returns asset IDs, titles, file details, and URLs.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of assets to return (default 100).'],
            'skip' => ['type' => 'integer', 'description' => 'Number of assets to skip for pagination.'],
        ];
    }

    /**
     * List assets with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, skip)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Contentful integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            if (isset($args['skip'])) {
                $params['skip'] = (int) $args['skip'];
            }

            $result = $this->service->listAssets($params);
            $items = $result['items'] ?? [];

            if (empty($items)) {
                return ToolResult::success('No assets found.');
            }

            $output = [];
            foreach ($items as $item) {
                $file = $item['fields']['file']['en-US'] ?? $item['fields']['file'] ?? [];
                $output[] = [
                    'id' => $item['sys']['id'] ?? '',
                    'title' => $item['fields']['title']['en-US'] ?? $item['fields']['title'] ?? '',
                    'description' => $item['fields']['description']['en-US'] ?? $item['fields']['description'] ?? '',
                    'content_type' => $file['contentType'] ?? '',
                    'file_name' => $file['fileName'] ?? '',
                    'url' => isset($file['url']) ? 'https:' . $file['url'] : '',
                    'size' => $file['details']['size'] ?? null,
                    'width' => $file['details']['image']['width'] ?? null,
                    'height' => $file['details']['image']['height'] ?? null,
                    'version' => $item['sys']['version'] ?? null,
                ];
            }

            return ToolResult::success([
                'total' => $result['total'] ?? count($output),
                'count' => count($output),
                'skip' => $result['skip'] ?? 0,
                'items' => $output,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
