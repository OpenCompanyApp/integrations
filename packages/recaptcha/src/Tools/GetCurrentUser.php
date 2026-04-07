<?php

namespace OpenCompany\Integrations\Recaptcha\Tools;

use OpenCompany\Integrations\Recaptcha\RecaptchaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GetCurrentUser implements Tool
{
    public function __construct(
        private RecaptchaService $service,
    ) {}

    public function name(): string
    {
        return 'recaptcha_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the current reCAPTCHA Enterprise API access. Returns the list of accessible projects to verify connectivity.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            $result = $this->service->getCurrentUser();

            return ToolResult::success([
                'projects' => $result['projects'] ?? [],
                'raw' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
