<?php

namespace OpenCompany\Integrations\Bitwarden\Tools;

/**
 * Retrieves the subscription details for the current organization.
 *
 * Maps to the official Bitwarden Public API endpoint get /public/organization/subscription.
 */
class BitwardenOrganizationGetSubscription extends AbstractBitwardenTool
{
    protected const NAME = 'bitwarden_organization_get_subscription';
    protected const DESCRIPTION = 'Retrieves the subscription details for the current organization.

Official Bitwarden Public API endpoint: GET /public/organization/subscription

Retrieves the subscription details for the current organization.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/public/organization/subscription';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
