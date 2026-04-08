<?php

namespace OpenCompany\Integrations\Heroku\Tools;

use OpenCompany\Integrations\Heroku\HerokuService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HerokuListCollaborators implements Tool
{
    public function __construct(
        private HerokuService $service,
    ) {}

    public function name(): string
    {
        return 'heroku_list_collaborators';
    }

    public function description(): string
    {
        return 'List all collaborators for a given Heroku app. Returns collaborator emails, roles, and permissions.';
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

            $result = $this->service->listCollaborators($args['app_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
