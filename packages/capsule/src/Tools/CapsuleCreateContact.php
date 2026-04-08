<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\Integrations\Capsule\CapsuleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * CapsuleCreateContact — create a new person or organisation in Capsule CRM.
 *
 * Accepts type ("person" or "organisation"), firstName, lastName,
 * and an array of email addresses. Returns the newly created contact.
 */
class CapsuleCreateContact implements Tool
{
    public function __construct(
        private CapsuleService $service,
    ) {}

    public function name(): string
    {
        return 'capsule_create_contact';
    }

    public function description(): string
    {
        return 'Create a new contact (person or organisation) in Capsule CRM. Provide at least a first name and last name for a person contact.';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'description' => 'Contact type: "person" (default) or "organisation".'],
            'firstName' => ['type' => 'string', 'required' => true, 'description' => 'First name of the contact.'],
            'lastName' => ['type' => 'string', 'required' => true, 'description' => 'Last name of the contact.'],
            'emailAddresses' => ['type' => 'array', 'description' => 'Email addresses, e.g. [{"address":"user@example.com"}].'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Capsule CRM integration is not configured.');
            }

            $type = $args['type'] ?? 'person';
            $firstName = $args['firstName'] ?? '';
            $lastName = $args['lastName'] ?? '';
            $emailAddresses = $args['emailAddresses'] ?? [];

            if ($type === 'person' && ($firstName === '' && $lastName === '')) {
                return ToolResult::error('At least a firstName or lastName is required for a person contact.');
            }

            $result = $this->service->createContact($type, $firstName, $lastName, $emailAddresses);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
