<?php

namespace OpenCompany\Integrations\Novu\Tools;

use OpenCompany\Integrations\Novu\NovuService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NovuGetSubscriber implements Tool
{
    public function __construct(
        private NovuService $service,
    ) {}

    public function name(): string
    {
        return 'novu_get_subscriber';
    }

    public function description(): string
    {
        return 'Get details of a specific subscriber in Novu by their ID. Returns the subscriber profile including email, phone, and preferences.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The subscriber ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Novu integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Subscriber ID is required.');
            }

            $result = $this->service->getSubscriber($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
