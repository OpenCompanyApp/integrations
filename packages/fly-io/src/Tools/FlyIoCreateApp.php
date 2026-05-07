<?php

namespace OpenCompany\Integrations\FlyIo\Tools;

use OpenCompany\Integrations\FlyIo\FlyIoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Fly App through the Machines API.
 */
class FlyIoCreateApp implements Tool
{
    /**
     * @param  FlyIoService  $service  The Fly.io Machines API client.
     */
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

    /**
     * Create a Fly App using an app name and optional organization slug.
     *
     * @param  array<string, mixed>  $args  Tool arguments (app_name, org_slug).
     */
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
