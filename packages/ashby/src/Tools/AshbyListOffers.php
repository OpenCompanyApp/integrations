<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** List Ashby offers. */
class AshbyListOffers extends AbstractAshbyTool
{
    protected const NAME = 'ashby_list_offers';
    protected const DESCRIPTION = 'List Ashby offers with status filters and pagination.';
    protected const ENDPOINT = '/offer.list';
    protected const BODY_KEYS = ['createdAfter', 'cursor', 'syncToken', 'limit', 'offerStatus', 'acceptanceStatus', 'applicationId', 'approvalStatus'];
    protected const PARAMETERS = [
        'applicationId' => ['type' => 'string', 'description' => 'Application UUID.'],
        'offerStatus' => ['type' => 'array', 'description' => 'Offer status filters.'],
        'acceptanceStatus' => ['type' => 'array', 'description' => 'Acceptance status filters.'],
        'approvalStatus' => ['type' => 'array', 'description' => 'Approval status filters.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum results.'],
    ];
}
