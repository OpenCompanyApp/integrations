<?php

namespace OpenCompany\Integrations\GoogleForms\Tools;

use OpenCompany\Integrations\GoogleForms\GoogleFormsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GFormsGetCurrentUser implements Tool
{
    public function __construct(
        private GoogleFormsService $service,
    ) {}

    public function name(): string
    {
        return 'gforms_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Google user\'s profile — email, display name, and profile photo. Use this to verify the connected account.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Forms integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
