<?php

namespace OpenCompany\Integrations\Freshsales\Tools;

use OpenCompany\Integrations\Freshsales\FreshsalesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshsalesUpdateContact implements Tool
{
    /**
     * Create a new FreshsalesUpdateContact tool instance.
     */
    public function __construct(
        private FreshsalesService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'freshsales_update_contact';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Update an existing contact in Freshsales CRM. Provide the contact ID and the fields to update.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The contact ID to update.'],
            'first_name' => ['type' => 'string', 'description' => 'Updated first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Updated last name.'],
            'email' => ['type' => 'string', 'description' => 'Updated primary email address.'],
            'work_number' => ['type' => 'string', 'description' => 'Updated work phone number.'],
            'mobile_number' => ['type' => 'string', 'description' => 'Updated mobile phone number.'],
            'job_title' => ['type' => 'string', 'description' => 'Updated job title.'],
            'sales_account_id' => ['type' => 'integer', 'description' => 'ID of the sales account to link.'],
            'address' => ['type' => 'string', 'description' => 'Updated street address.'],
            'city' => ['type' => 'string', 'description' => 'Updated city.'],
            'state' => ['type' => 'string', 'description' => 'Updated state or province.'],
            'zipcode' => ['type' => 'string', 'description' => 'Updated postal / ZIP code.'],
            'country' => ['type' => 'string', 'description' => 'Updated country.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshsales integration is not configured.');
            }

            $id = (int) $args['id'];
            unset($args['id']);

            $data = array_filter($args, fn ($value) => $value !== null);

            if (empty($data)) {
                return ToolResult::error('No fields provided to update.');
            }

            $result = $this->service->updateContact($id, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
