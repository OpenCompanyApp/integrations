<?php

namespace OpenCompany\Integrations\Heroku\Tools;

use OpenCompany\Integrations\Heroku\HerokuService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HerokuGetApp implements Tool
{
    public function __construct(
        private HerokuService $service,
    ) {}

    public function name(): string
    {
        return 'heroku_get_app';
    }

    public function description(): string
    {
        return 'Get details for a specific Heroku app by ID or name. Returns full app information including region, stack, and Git URL.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'required' => true, 'description' => 'The app ID or name (e.g., "my-app" or the UUID).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Heroku integration is not configured.');
            }

            $result = $this->service->getApp($args['app_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
