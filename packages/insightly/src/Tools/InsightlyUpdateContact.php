<?php

namespace OpenCompany\Integrations\Insightly\Tools;

use OpenCompany\Integrations\Insightly\InsightlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Update Contact
 *
 * Updates an existing contact in Insightly CRM.
 *
 * @see https://api.na1.insightly.com/v3.1/Help#!/Contacts/PutEntity
 */
class InsightlyUpdateContact implements Tool
{
    /**
     * Create a new InsightlyUpdateContact tool instance.
     *
     * @param  InsightlyService  $service  The Insightly API service.
     */
    public function __construct(
        private InsightlyService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'insightly_update_contact';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Update an existing contact in Insightly CRM. Provide the contact ID and the fields to update. Only the specified fields will be changed.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Insightly contact ID to update.'],
            'first_name' => ['type' => 'string', 'description' => 'Updated first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Updated last name.'],
            'email' => ['type' => 'string', 'description' => 'Updated primary email address.'],
            'phone' => ['type' => 'string', 'description' => 'Updated primary phone number.'],
            'title' => ['type' => 'string', 'description' => 'Updated job title.'],
            'background' => ['type' => 'string', 'description' => 'Updated background notes or description.'],
            'contact_type' => ['type' => 'string', 'description' => 'Updated contact type.'],
            'additional_fields' => ['type' => 'object', 'description' => 'Additional Insightly contact fields to update as key-value pairs.'],
        ];
    }

    /**
     * Execute the update contact tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing 'id' and fields to update.
     * @return ToolResult The updated contact record or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Insightly integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $data = [];

            if (isset($args['first_name'])) {
                $data['FIRST_NAME'] = $args['first_name'];
            }
            if (isset($args['last_name'])) {
                $data['LAST_NAME'] = $args['last_name'];
            }
            if (isset($args['title'])) {
                $data['TITLE'] = $args['title'];
            }
            if (isset($args['background'])) {
                $data['BACKGROUND'] = $args['background'];
            }
            if (isset($args['contact_type'])) {
                $data['CONTACTTYPE'] = $args['contact_type'];
            }
            if (isset($args['email'])) {
                $data['EMAIL_ADDRESS'] = $args['email'];
            }
            if (isset($args['phone'])) {
                $data['PHONE'] = $args['phone'];
            }

            if (isset($args['additional_fields']) && is_array($args['additional_fields'])) {
                $data = array_merge($data, $args['additional_fields']);
            }

            $result = $this->service->updateContact((int) $args['id'], $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
