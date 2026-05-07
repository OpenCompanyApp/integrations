<?php

namespace OpenCompany\Integrations\Heroku\Tools;

use OpenCompany\Integrations\Heroku\HerokuService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List dynos running on a Heroku app.
 */
class HerokuListDynos implements Tool
{
    /**
     * @param  HerokuService  $service  The Heroku Platform API client.
     */
    public function __construct(
        private HerokuService $service,
    ) {}

    public function name(): string
    {
        return 'heroku_list_dynos';
    }

    public function description(): string
    {
        return 'List all dynos for a given Heroku app. Returns dyno names, types, sizes, states, and uptime.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'required' => true, 'description' => 'The app ID or name.'],
        ];
    }

    /**
     * List dynos for an app ID or name.
     *
     * @param  array<string, mixed>  $args  Tool arguments (app_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Heroku integration is not configured.');
            }

            $result = $this->service->listDynos($args['app_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
