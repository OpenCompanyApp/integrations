<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

use OpenCompany\Integrations\FreshworksCrm\FreshworksCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshworksCrmCreateContact implements Tool
{
    public function __construct(
        private FreshworksCrmService $service,
    ) {}

    public function name(): string
    {
        return 'freshworks_crm_create_contact';
    }

    public function description(): string
    {
        return 'Create a new contact in Freshworks CRM. Provide at least a first name or last name. Email and mobile number are optional.';
    }

    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'description' => 'First name of the contact.'],
            'last_name' => ['type' => 'string', 'description' => 'Last name of the contact.'],
            'email' => ['type' => 'string', 'description' => 'Email address of the contact.'],
            'mobile_number' => ['type' => 'string', 'description' => 'Mobile phone number of the contact.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshworks CRM integration is not configured.');
            }

            $data = [];

            if (isset($args['first_name'])) {
                $data['first_name'] = $args['first_name'];
            }
            if (isset($args['last_name'])) {
                $data['last_name'] = $args['last_name'];
            }
            if (isset($args['email'])) {
                $data['email'] = $args['email'];
            }
            if (isset($args['mobile_number'])) {
                $data['mobile_number'] = $args['mobile_number'];
            }

            if (empty($data)) {
                return ToolResult::error('At least one field (first_name, last_name, email, or mobile_number) is required.');
            }

            $result = $this->service->createContact($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
