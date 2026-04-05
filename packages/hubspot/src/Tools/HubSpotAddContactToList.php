<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add contacts to a HubSpot marketing list.
 *
 * Supports adding contacts by their IDs or email addresses.
 */
class HubSpotAddContactToList implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_add_contact_to_list';
    }

    public function description(): string
    {
        return <<<'MD'
        Add contacts to a HubSpot marketing list.
        Provide either contact_ids (HubSpot vid IDs) or emails (email addresses), or both.
        Contacts that are already in the list are silently skipped.
        MD;
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'HubSpot list ID to add contacts to.'],
            'contact_ids' => ['type' => 'array', 'description' => 'Array of HubSpot contact IDs (vids) to add.'],
            'emails' => ['type' => 'array', 'description' => 'Array of email addresses to add.'],
        ];
    }

    /**
     * Add contacts to a HubSpot list by ID or email.
     *
     * @param  array<string, mixed>  $args  Tool arguments (list_id, contact_ids, emails)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $listId = $args['list_id'] ?? '';
            if (empty($listId)) {
                return ToolResult::error('list_id is required.');
            }

            $contactIds = $args['contact_ids'] ?? null;
            $emails = $args['emails'] ?? null;

            if (empty($contactIds) && empty($emails)) {
                return ToolResult::error('At least one of contact_ids or emails is required.');
            }

            $result = $this->service->addContactToList(
                $listId,
                is_array($contactIds) ? $contactIds : null,
                is_array($emails) ? $emails : null,
            );

            return ToolResult::success([
                'list_id' => $listId,
                'updated' => $result['updated'] ?? [],
                'discarded' => $result['discarded'] ?? [],
                'invalid_vids' => $result['invalidVids'] ?? [],
                'invalid_emails' => $result['invalidEmails'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
