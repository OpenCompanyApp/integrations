<?php

namespace OpenCompany\Integrations\Drip\Tools;

use OpenCompany\Integrations\Drip\DripService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DripGetSubscriber implements Tool
{
    public function __construct(
        private DripService $service,
    ) {}

    public function name(): string
    {
        return 'drip_get_subscriber';
    }

    public function description(): string
    {
        return 'Fetch a single subscriber from Drip by their subscriber ID or email address. Returns full subscriber details including status, tags, custom fields, and subscription information.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The subscriber ID or email address.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Drip integration is not configured. Provide an API key and account ID.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Subscriber ID or email is required.');
            }

            $result = $this->service->getSubscriber($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
