<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Treasury > Direct Debit LBA > Update Mandate for LBA.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/linked_accounts/{linked_account_id}/mandate.
 */
class AirwallexTreasuryUpdateMandateForLba extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_treasury_update_mandate_for_lba';
    protected const DESCRIPTION = 'Treasury > Direct Debit LBA > Update Mandate for LBA.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/linked_accounts/{linked_account_id}/mandate.';
    protected const PARAMETERS = [
        'linked_account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `linked_account_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/linked_accounts/{linked_account_id}/mandate';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'linked_account_id' => 'linked_account_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
