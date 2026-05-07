<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Update or remove a funding source.
 *
 * Maps to the official Dwolla endpoint POST /funding-sources/{id}.
 */
class DwollaUpdateOrRemoveFundingSource extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_update_or_remove_funding_source';
    protected const DESCRIPTION = 'Updates a bank funding source\'s details or soft deletes it. When updating, you can change the name (any status) or modify routing/account numbers and account type (unverified status only). When removing, the funding source is soft deleted and can still be accessed but marked as removed.

Official Dwolla endpoint: POST /funding-sources/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Funding source unique identifier',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Dwolla OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/funding-sources/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
