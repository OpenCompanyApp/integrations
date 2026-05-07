<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves organization members based on the organization ID and the cursor, or based on the user emails provided in the request. Required scope organizations:read Rate limiting Level 3 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint GET /v2/orgs/{org_id}/members.
 */
class MiroEnterpriseGetOrganizationMembers extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_get_organization_members';
    protected const DESCRIPTION = 'Retrieves organization members based on the organization ID and the cursor, or based on the user emails provided in the request. Required scope organizations:read Rate limiting Level 3 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: GET /v2/orgs/{org_id}/members.';
    protected const PARAMETERS = array (
      'emails' => array (
        'type' => 'string',
        'description' => 'emails parameter.',
        'required' => false,
      ),
      'role' => array (
        'type' => 'string',
        'description' => 'role parameter.',
        'required' => false,
        'enum' => array (
          'organization_internal_admin',
          'organization_internal_user',
          'organization_external_user',
          'organization_team_guest_user',
          'unknown',
        ),
      ),
      'license' => array (
        'type' => 'string',
        'description' => 'license parameter.',
        'required' => false,
        'enum' => array (
          'advanced',
          'standard',
          'basic',
          'full',
          'occasional',
          'free',
          'free_restricted',
          'full_trial',
          'unknown',
        ),
      ),
      'active' => array (
        'type' => 'boolean',
        'description' => 'active parameter.',
        'required' => false,
      ),
      'cursor' => array (
        'type' => 'string',
        'description' => 'cursor parameter.',
        'required' => false,
      ),
      'limit' => array (
        'type' => 'integer',
        'description' => 'limit parameter.',
        'required' => false,
      ),
      'org_id' => array (
        'type' => 'string',
        'description' => 'id of the organization',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/orgs/{org_id}/members';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
    );
    protected const QUERY_PARAMS = array (
      'emails' => 'emails',
      'role' => 'role',
      'license' => 'license',
      'active' => 'active',
      'cursor' => 'cursor',
      'limit' => 'limit',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
