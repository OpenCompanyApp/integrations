<?php

namespace OpenCompany\Integrations\Lasso\Tools;

use OpenCompany\Integrations\Lasso\LassoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Create Contact.
 *
 * Creates a new contact (registrant) in Lasso CRM with name, email, phone,
 * and other optional fields.
 */
class LassoCreateContact implements Tool
{
    /**
     * @param  LassoService  $service  The Lasso API service instance.
     */
    public function __construct(
        private LassoService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'lasso_create_contact';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Create a new contact (registrant) in Lasso CRM. Provide at least a first name or last name, and optionally email, phone, and other details.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'first_name'  => ['type' => 'string', 'description' => 'Contact first name.'],
            'last_name'   => ['type' => 'string', 'description' => 'Contact last name.'],
            'email'       => ['type' => 'string', 'description' => 'Primary email address.'],
            'phone'       => ['type' => 'string', 'description' => 'Primary phone number.'],
            'project_id'  => ['type' => 'string', 'description' => 'Project ID to associate the contact with.'],
            'source'      => ['type' => 'string', 'description' => 'Lead source (e.g., "Website", "Referral").'],
            'notes'       => ['type' => 'string', 'description' => 'Notes about the contact.'],
        ];
    }

    /**
     * Execute the create contact tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (first_name, last_name, email, etc.).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Lasso CRM integration is not configured.');
            }

            $data = array_filter([
                'first_name' => $args['first_name'] ?? null,
                'last_name'  => $args['last_name'] ?? null,
                'email'      => $args['email'] ?? null,
                'phone'      => $args['phone'] ?? null,
                'project_id' => $args['project_id'] ?? null,
                'source'     => $args['source'] ?? null,
                'notes'      => $args['notes'] ?? null,
            ], fn ($value) => $value !== null);

            if (empty($data['first_name']) && empty($data['last_name'])) {
                return ToolResult::error('At least a first name or last name is required.');
            }

            $result = $this->service->createContact($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
