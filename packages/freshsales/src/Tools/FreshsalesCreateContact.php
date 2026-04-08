<?php

namespace OpenCompany\Integrations\Freshsales\Tools;

use OpenCompany\Integrations\Freshsales\FreshsalesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new contact in Freshsales CRM.
 *
 * Creates a contact with the provided details. At least a first name or
 * last name is recommended. Email and mobile number are optional.
 */
class FreshsalesCreateContact implements Tool
{
    public function __construct(
        private FreshsalesService $service,
    ) {}

    public function name(): string
    {
        return 'freshsales_create_contact';
    }

    public function description(): string
    {
        return 'Create a new contact in Freshsales CRM with name, email, and phone details.';
    }

    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'required' => true, 'description' => 'First name of the contact.'],
            'last_name' => ['type' => 'string', 'required' => true, 'description' => 'Last name of the contact.'],
            'email' => ['type' => 'string', 'description' => 'Email address of the contact.'],
            'mobile_number' => ['type' => 'string', 'description' => 'Mobile phone number of the contact.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshsales integration is not configured.');
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

            if (empty($data['first_name']) && empty($data['last_name'])) {
                return ToolResult::error('At least a first name or last name is required to create a contact.');
            }

            $result = $this->service->createContact($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
