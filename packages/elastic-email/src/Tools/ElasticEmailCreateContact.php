<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

use OpenCompany\Integrations\ElasticEmail\ElasticEmailService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ElasticEmailCreateContact implements Tool
{
    public function __construct(
        private ElasticEmailService $service,
    ) {}

    public function name(): string
    {
        return 'elasticemail_create_contact';
    }

    public function description(): string
    {
        return 'Create or add a contact in Elastic Email. Optionally assign the contact to an existing list.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Contact email address.'],
            'list_name' => ['type' => 'string', 'description' => 'Name of the list to add the contact to. The list must already exist in your Elastic Email account.'],
            'first_name' => ['type' => 'string', 'description' => 'Contact first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Contact last name.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Elastic Email integration is not configured.');
            }

            $options = [];
            foreach (['first_name', 'last_name'] as $key) {
                if (isset($args[$key])) {
                    $options[$key] = $args[$key];
                }
            }

            $result = $this->service->createContact(
                $args['email'],
                $args['list_name'] ?? null,
                $options,
            );

            return ToolResult::success([
                'message' => 'Contact created successfully.',
                'data' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
