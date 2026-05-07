<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

use OpenCompany\Integrations\ElasticEmail\ElasticEmailService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create or add an Elastic Email contact.
 */
class ElasticEmailCreateContact implements Tool
{
    /**
     * @param  ElasticEmailService  $service  Elastic Email API client.
     */
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

    /**
     * Execute the contact creation request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Elastic Email integration is not configured.');
            }

            $options = [];
            if (isset($args['first_name'])) {
                $options['FirstName'] = $args['first_name'];
            }
            if (isset($args['last_name'])) {
                $options['LastName'] = $args['last_name'];
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
