<?php

namespace OpenCompany\Integrations\Bannerbear\Tools;

use OpenCompany\Integrations\Bannerbear\BannerbearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BannerbearListImages implements Tool
{
    public function __construct(
        private BannerbearService $service,
    ) {}

    public function name(): string
    {
        return 'bannerbear_list_images';
    }

    public function description(): string
    {
        return 'List previously created Bannerbear images. Returns image UIDs, statuses, and download URLs. Supports pagination via page and limit parameters.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based). Defaults to 1.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of results per page. Defaults to 20.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bannerbear integration is not configured.');
            }

            $page = (int) ($args['page'] ?? 1);
            $limit = (int) ($args['limit'] ?? 20);

            $result = $this->service->listImages($page, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
