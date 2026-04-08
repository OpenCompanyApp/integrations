<?php

namespace OpenCompany\Integrations\Dub\Tools;

use OpenCompany\Integrations\Dub\DubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DubGetDomain implements Tool
{
    public function __construct(
        private DubService $service,
    ) {}

    public function name(): string
    {
        return 'dub_get_domain';
    }

    public function description(): string
    {
        return 'Get details of a specific domain by its ID or slug.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The domain ID or slug (e.g., "dub.sh", "clx...").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Dub.co integration is not configured.');
            }

            $result = $this->service->getDomain($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
