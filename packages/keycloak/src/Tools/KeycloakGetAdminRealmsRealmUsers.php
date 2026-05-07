<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get users Returns a stream of users, filtered according to query parameters.
 *
 * Maps to GET /admin/realms/{realm}/users in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmUsers extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_users',
  'class' => 'KeycloakGetAdminRealmsRealmUsers',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/users',
  'summary' => 'Get users Returns a stream of users, filtered according to query parameters',
  'description' => 'Returns a stream of users. Note that the \'credentials\' field in the returned UserRepresentation objects is typically not populated for performance reasons. If specific credential metadata is required, use the dedicated \'GET /admin/realms/{realm}/users/{user-id}/credentials\' endpoint.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'brief_representation' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Boolean which defines whether brief representations are returned (default: false)',
    ),
    'created_after' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Only return users created after (inclusive) the given date, in ISO-8601 format (yyyy-MM-dd) or epoch milliseconds',
    ),
    'created_before' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Only return users created before (inclusive) the given date, in ISO-8601 format (yyyy-MM-dd) or epoch milliseconds',
    ),
    'email' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'A String contained in email, or the complete email, if param "exact" is true',
    ),
    'email_verified' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'whether the email has been verified',
    ),
    'enabled' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Boolean representing if user is enabled or not',
    ),
    'exact' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Boolean which defines whether the params "last", "first", "email" and "username" must match exactly',
    ),
    'first' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Pagination offset',
    ),
    'first_name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'A String contained in firstName, or the complete firstName, if param "exact" is true',
    ),
    'idp_alias' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The alias of an Identity Provider linked to the user',
    ),
    'idp_user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The userId at an Identity Provider linked to the user',
    ),
    'last_name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'A String contained in lastName, or the complete lastName, if param "exact" is true',
    ),
    'max' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Maximum results size (defaults to 100)',
    ),
    'q' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'A query to search for custom attributes, in the format \'key1:value2 key2:value2\'',
    ),
    'search' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'A String contained in username, first or last name, or email. Default search behavior is prefix-based (e.g., foo or foo*). Use *foo* for infix search and "foo" for exact search.',
    ),
    'username' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'A String contained in username, or the complete username, if param "exact" is true',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
  ),
  'query_params' =>
  array (
    'briefRepresentation' => 'brief_representation',
    'createdAfter' => 'created_after',
    'createdBefore' => 'created_before',
    'email' => 'email',
    'emailVerified' => 'email_verified',
    'enabled' => 'enabled',
    'exact' => 'exact',
    'first' => 'first',
    'firstName' => 'first_name',
    'idpAlias' => 'idp_alias',
    'idpUserId' => 'idp_user_id',
    'lastName' => 'last_name',
    'max' => 'max',
    'q' => 'q',
    'search' => 'search',
    'username' => 'username',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
