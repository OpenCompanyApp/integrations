<?php

namespace OpenCompany\Integrations\Heroku\Tools;

use OpenCompany\Integrations\Heroku\HerokuService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List domains attached to a Heroku app.
 */
class HerokuListDomains implements Tool
{
    /**
     * @param  HerokuService  $service  The Heroku Platform API client.
     */
    public function __construct(
        private HerokuService $service,
    ) {}

    public function name(): string
    {
        return 'heroku_list_domains';
    }

    public function description(): string
    {
        return 'List all domains for a given Heroku app. Returns domain hostnames, types (custom/Heroku), and status.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'required' => true, 'description' => 'The app ID or name.'],
        ];
    }

    /**
     * List domains for an app ID or name.
     *
     * @param  array<string, mixed>  $args  Tool arguments (app_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Heroku integration is not configured.');
            }

            $result = $this->service->listDomains($args['app_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
