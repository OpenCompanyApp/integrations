<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create an association between two HubSpot CRM objects.
 *
 * Links a source object to a target object with a specified association type.
 */
class HubSpotCreateAssociation implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_create_association';
    }

    public function description(): string
    {
        return <<<'MD'
        Create an association between two HubSpot CRM objects.
        For example, associate a contact to a company, or a deal to a company.
        Specify the from/to object types (contacts, companies, deals, tickets), their IDs, and the association type.
        Common association types: contact_to_company, company_to_contact, deal_to_company, ticket_to_contact.
        MD;
    }

    public function parameters(): array
    {
        return [
            'from_type' => ['type' => 'string', 'required' => true, 'description' => 'Source object type (e.g., "contacts", "companies", "deals", "tickets").'],
            'from_id' => ['type' => 'string', 'required' => true, 'description' => 'Source object ID.'],
            'to_type' => ['type' => 'string', 'required' => true, 'description' => 'Target object type (e.g., "contacts", "companies", "deals", "tickets").'],
            'to_id' => ['type' => 'string', 'required' => true, 'description' => 'Target object ID.'],
            'association_type' => ['type' => 'string', 'required' => true, 'description' => 'Association type name (e.g., "contact_to_company", "deal_to_company").'],
        ];
    }

    /**
     * Create an association between two HubSpot CRM objects.
     *
     * @param  array<string, mixed>  $args  Tool arguments (from_type, from_id, to_type, to_id, association_type)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $fromType = $args['from_type'] ?? '';
            $fromId = $args['from_id'] ?? '';
            $toType = $args['to_type'] ?? '';
            $toId = $args['to_id'] ?? '';
            $associationType = $args['association_type'] ?? '';

            if (empty($fromType) || empty($fromId) || empty($toType) || empty($toId) || empty($associationType)) {
                return ToolResult::error('from_type, from_id, to_type, to_id, and association_type are all required.');
            }

            $result = $this->service->createAssociation($fromType, $fromId, $toType, $toId, $associationType);

            return ToolResult::success([
                'from_type' => $fromType,
                'from_id' => $fromId,
                'to_type' => $toType,
                'to_id' => $toId,
                'association_type' => $associationType,
                'created' => true,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
