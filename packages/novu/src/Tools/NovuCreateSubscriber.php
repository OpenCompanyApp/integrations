<?php

namespace OpenCompany\Integrations\Novu\Tools;

use OpenCompany\Integrations\Novu\NovuService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NovuCreateSubscriber implements Tool
{
    public function __construct(
        private NovuService $service,
    ) {}

    public function name(): string
    {
        return 'novu_create_subscriber';
    }

    public function description(): string
    {
        return 'Create a new subscriber in Novu. Requires an email address. Optionally include first name, last name, and phone number.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The subscriber\'s email address.'],
            'firstName' => ['type' => 'string', 'description' => 'The subscriber\'s first name.'],
            'lastName' => ['type' => 'string', 'description' => 'The subscriber\'s last name.'],
            'phone' => ['type' => 'string', 'description' => 'The subscriber\'s phone number (e.g., "+1234567890").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Novu integration is not configured.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('Email address is required to create a subscriber.');
            }

            $result = $this->service->createSubscriber(
                email: $args['email'],
                firstName: $args['firstName'] ?? null,
                lastName: $args['lastName'] ?? null,
                phone: $args['phone'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
