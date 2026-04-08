<?php

namespace OpenCompany\Integrations\Mautic\Tools;

use OpenCompany\Integrations\Mautic\MauticService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * MauticUpdateContact — Update an existing contact in Mautic.
 *
 * Calls PUT /api/contacts/{id}/edit with the provided fields.
 *
 * @see https://developer.mautic.org/#edit-contact
 */
class MauticUpdateContact implements Tool
{
    /**
     * @param  MauticService  $service  The Mautic API service instance.
     */
    public function __construct(
        private MauticService $service,
    ) {}

    /**
     * The tool identifier used in the registry.
     */
    public function name(): string
    {
        return 'mautic_update_contact';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Update an existing Mautic contact. Provide the contact ID and the fields to update (e.g. email, firstname, lastname, phone, company, tags).';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Mautic contact ID to update.'],
            'email' => ['type' => 'string', 'description' => 'Updated email address.'],
            'firstname' => ['type' => 'string', 'description' => 'Updated first name.'],
            'lastname' => ['type' => 'string', 'description' => 'Updated last name.'],
            'phone' => ['type' => 'string', 'description' => 'Updated phone number.'],
            'company' => ['type' => 'string', 'description' => 'Updated company name.'],
            'position' => ['type' => 'string', 'description' => 'Updated job title / position.'],
            'tags' => ['type' => 'array', 'description' => 'Tags to set (array of tag names, e.g. ["lead", "newsletter"]).'],
            'owner' => ['type' => 'integer', 'description' => 'User ID of the contact owner.'],
        ];
    }

    /**
     * Execute the tool — update a contact in Mautic.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id + fields to update).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mautic integration is not configured.');
            }

            $id = $args['id'] ?? null;
            if (empty($id)) {
                return ToolResult::error('Contact ID is required.');
            }

            $data = [];
            $knownFields = ['id', 'email', 'firstname', 'lastname', 'phone', 'company', 'position', 'owner', 'tags'];

            foreach (['email', 'firstname', 'lastname', 'phone', 'company', 'position', 'owner'] as $field) {
                if (isset($args[$field])) {
                    $data[$field] = $args[$field];
                }
            }

            if (isset($args['tags']) && is_array($args['tags'])) {
                $data['tags'] = array_map(fn (string $tag) => $tag, $args['tags']);
            }

            // Pass any extra custom fields through
            foreach ($args as $key => $value) {
                if (!in_array($key, $knownFields, true)) {
                    $data[$key] = $value;
                }
            }

            if (empty($data)) {
                return ToolResult::error('No fields provided to update.');
            }

            $result = $this->service->updateContact((int) $id, $data);

            $contact = $result['contact'] ?? $result;

            return ToolResult::success([
                'message' => "Contact {$id} updated successfully.",
                'contact' => $contact,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
