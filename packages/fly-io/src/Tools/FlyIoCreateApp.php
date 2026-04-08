<?php

namespace OpenCompany\Integrations\FlyIo\Tools;

use OpenCompany\Integrations\FlyIo\FlyIoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FlyIoCreateApp implements Tool
{
    public function __construct(
        private FlyIoService $service,
    ) {}

    public function name(): string
    {
        return 'fly_io_create_app';
    }

    public function description(): string
    {
        return 'Create a new Fly.io app. Requires an app name and optionally an organization ID.';
    }

    public function parameters(): array
    {
        return [
            'app_name' => ['type' => 'string', 'description' => 'The desired name for the new app.'],
            'org_slug' => ['type' => 'string', 'description' => 'The organization slug to create the app in (optional, uses default org if omitted).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Fly.io integration is not configured.');
            }

            $appName = $args['app_name'] ?? '';
            if (empty($appName)) {
                return ToolResult::error('The app_name parameter is required.');
            }

            $params = ['app_name' => $appName];

            if (isset($args['org_slug']) && !empty($args['org_slug'])) {
                $params['org_slug'] = $args['org_slug'];
            }

            $result = $this->service->createApp($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
