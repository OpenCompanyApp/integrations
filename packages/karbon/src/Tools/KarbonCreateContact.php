<?php

namespace OpenCompany\Integrations\Karbon\Tools;

use OpenCompany\Integrations\Karbon\KarbonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KarbonCreateContact implements Tool
{
    public function __construct(
        private KarbonService $service,
    ) {}

    public function name(): string
    {
        return 'karbon_create_contact';
    }

    public function description(): string
    {
        return 'Create a new contact in Karbon. Provide at least a first name and last name. Optionally include email, company, and phone number.';
    }

    public function parameters(): array
    {
        return [
            'firstName' => ['type' => 'string', 'required' => true, 'description' => 'The contact\'s first name.'],
            'lastName' => ['type' => 'string', 'required' => true, 'description' => 'The contact\'s last name.'],
            'email' => ['type' => 'string', 'description' => 'The contact\'s email address.'],
            'company' => ['type' => 'string', 'description' => 'The contact\'s company or organization name.'],
            'phone' => ['type' => 'string', 'description' => 'The contact\'s phone number.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Karbon integration is not configured.');
            }

            if (empty($args['firstName']) || empty($args['lastName'])) {
                return ToolResult::error('firstName and lastName are required.');
            }

            $data = [
                'firstName' => $args['firstName'],
                'lastName' => $args['lastName'],
            ];

            if (isset($args['email'])) {
                $data['email'] = $args['email'];
            }

            if (isset($args['company'])) {
                $data['company'] = $args['company'];
            }

            if (isset($args['phone'])) {
                $data['phone'] = $args['phone'];
            }

            $result = $this->service->createContact($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
