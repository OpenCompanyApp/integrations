<?php

namespace OpenCompany\Integrations\GoogleSlides\Tools;

use OpenCompany\Integrations\GoogleSlides\GoogleSlidesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleSlidesGetCurrentUser implements Tool
{
    public function __construct(
        private GoogleSlidesService $service,
    ) {}

    public function name(): string
    {
        return 'gslides_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Google user\'s profile information (display name, email, photo).';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Slides integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
