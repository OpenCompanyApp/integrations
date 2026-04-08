<?php

namespace OpenCompany\Integrations\Sendgrid\Tools;

use OpenCompany\Integrations\Sendgrid\SendgridService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SendgridGetCurrentUser implements Tool
{
    public function __construct(
        private SendgridService $service,
    ) {}

    public function name(): string
    {
        return 'sendgrid_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated SendGrid user, including email, first name, and last name.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('SendGrid integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
