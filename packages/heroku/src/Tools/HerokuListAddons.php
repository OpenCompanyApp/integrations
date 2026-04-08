<?php

namespace OpenCompany\Integrations\Heroku\Tools;

use OpenCompany\Integrations\Heroku\HerokuService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HerokuListAddons implements Tool
{
    public function __construct(
        private HerokuService $service,
    ) {}

    public function name(): string
    {
        return 'heroku_list_addons';
    }

    public function description(): string
    {
        return 'List all add-ons attached to a given Heroku app. Returns add-on names, plans, states, and provider details.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'required' => true, 'description' => 'The app ID or name.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Heroku integration is not configured.');
            }

            $result = $this->service->listAddons($args['app_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
