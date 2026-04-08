<?php

namespace OpenCompany\Integrations\Mautic\Tools;

use OpenCompany\Integrations\Mautic\MauticService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * MauticGetContact — Retrieve a single contact by ID.
 *
 * Calls GET /api/contacts/{id} and returns the full contact record.
 *
 * @see https://developer.mautic.org/#get-contact
 */
class MauticGetContact implements Tool
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
        return 'mautic_get_contact';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get detailed information about a single Mautic contact by ID, including all fields and tags.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Mautic contact ID.'],
        ];
    }

    /**
     * Execute the tool — fetch a contact from Mautic.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id).
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

            $result = $this->service->getContact((int) $id);

            $contact = $result['contact'] ?? $result;

            if (empty($contact)) {
                return ToolResult::error("Contact with ID {$id} not found.");
            }

            return ToolResult::success($contact);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
