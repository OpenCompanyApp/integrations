<?php

namespace OpenCompany\Integrations\GetResponse\Tools;

use OpenCompany\Integrations\GetResponse\GetResponseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GetResponseCreateContact implements Tool
{
    public function __construct(
        private GetResponseService $service,
    ) {}

    public function name(): string
    {
        return 'getresponse_create_contact';
    }

    public function description(): string
    {
        return 'Create a new contact in GetResponse. Requires an email address. Optionally set the contact name and assign to a campaign.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The contact\'s email address.'],
            'name' => ['type' => 'string', 'description' => 'The contact\'s full name.'],
            'campaign' => ['type' => 'string', 'description' => 'Campaign ID to add the contact to.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('GetResponse integration is not configured.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('Email address is required.');
            }

            $result = $this->service->createContact(
                email: $args['email'],
                name: $args['name'] ?? null,
                campaign: $args['campaign'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
