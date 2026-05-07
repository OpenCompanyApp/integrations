<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create an organization membership.
 *
 * Maps to the official WorkOS endpoint post /user_management/organization_memberships.
 */
class WorkOSUserlandUserOrganizationMembershipsCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_user_organization_memberships_create';
    protected const DESCRIPTION = 'Create an organization membership

Official WorkOS endpoint: POST /user_management/organization_memberships

Creates a new `active` organization membership for the given organization and user. Calling this API with an organization and user that match an `inactive` organization membership will activate the membership with the specified role(s).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user_management/organization_memberships';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
