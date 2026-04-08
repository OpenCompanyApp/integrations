<?php

namespace OpenCompany\Integrations\Mautic\Tools;

use OpenCompany\Integrations\Mautic\MauticService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * MauticCreateContact — Create a new contact in Mautic.
 *
 * Calls POST /api/contacts/new with the provided contact fields.
 *
 * @see https://developer.mautic.org/#create-contact
 */
class MauticCreateContact implements Tool
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
        return 'mautic_create_contact';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new contact in Mautic. Provide at least an email address; additional fields like first name, last name, phone, company, and tags are optional.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Email address for the contact.'],
            'firstname' => ['type' => 'string', 'description' => 'First name.'],
            'lastname' => ['type' => 'string', 'description' => 'Last name.'],
            'phone' => ['type' => 'string', 'description' => 'Phone number.'],
            'company' => ['type' => 'string', 'description' => 'Company name.'],
            'position' => ['type' => 'string', 'description' => 'Job title / position.'],
            'tags' => ['type' => 'array', 'description' => 'Tags to assign (array of tag names, e.g. ["lead", "newsletter"]).'],
            'owner' => ['type' => 'integer', 'description' => 'User ID of the contact owner.'],
        ];
    }

    /**
     * Execute the tool — create a contact in Mautic.
     *
     * @param  array<string, mixed>  $args  Tool arguments (email, firstname, lastname, etc.).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mautic integration is not configured.');
            }

            $email = $args['email'] ?? null;
            if (empty($email)) {
                return ToolResult::error('Email address is required to create a contact.');
            }

            $data = [];

            // Core fields
            foreach (['email', 'firstname', 'lastname', 'phone', 'company', 'position', 'owner'] as $field) {
                if (isset($args[$field])) {
                    $data[$field] = $args[$field];
                }
            }

            // Tags — Mautic expects an array of tag objects or strings
            if (isset($args['tags']) && is_array($args['tags'])) {
                $data['tags'] = array_map(fn (string $tag) => $tag, $args['tags']);
            }

            // Pass any extra custom fields through
            $knownFields = ['email', 'firstname', 'lastname', 'phone', 'company', 'position', 'owner', 'tags'];
            foreach ($args as $key => $value) {
                if (!in_array($key, $knownFields, true)) {
                    $data[$key] = $value;
                }
            }

            $result = $this->service->createContact($data);

            $contact = $result['contact'] ?? $result;

            return ToolResult::success([
                'message' => 'Contact created successfully.',
                'contact' => $contact,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
