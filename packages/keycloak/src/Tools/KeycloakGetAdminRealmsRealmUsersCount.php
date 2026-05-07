<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Returns the number of users that match the given criteria.
 *
 * Maps to GET /admin/realms/{realm}/users/count in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmUsersCount extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_users_count',
  'class' => 'KeycloakGetAdminRealmsRealmUsersCount',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/users/count',
  'summary' => 'Returns the number of users that match the given criteria',
  'description' => 'It can be called in three different ways. 1. Don’t specify any criteria and pass {@code null}. The number of all users within that realm will be returned. 2. If {@code search} is specified other criteria such as {@code last} will be ignored even though you set them. The {@code search} string will be matched against the first and last name, the username and the email of a user. 3. If {@code search} is unspecified but any of {@code last}, {@code first}, {@code email} or {@code username} those crit',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
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
    'createdAfter' => 'created_after',
    'createdBefore' => 'created_before',
    'email' => 'email',
    'emailVerified' => 'email_verified',
    'enabled' => 'enabled',
    'exact' => 'exact',
    'firstName' => 'first_name',
    'idpAlias' => 'idp_alias',
    'idpUserId' => 'idp_user_id',
    'lastName' => 'last_name',
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
