<?php

namespace OpenCompany\Integrations\Hetzner;

/**
 * Official Hetzner Cloud OpenAPI operation metadata.
 *
 * Generated from docs.hetzner.cloud/cloud.spec.json.
 */
final class HetznerOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return array (
  'hetzner_get_actions' =>
  array (
    'slug' => 'hetzner_get_actions',
    'class' => 'HetznerGetActions',
    'type' => 'read',
    'name' => 'Get multiple Actions',
    'description' => 'Returns multiple Action objects specified by the `id` parameter. **Note**: This endpoint previously allowed listing all actions in the project. This functionality was deprecated in July 2023 and removed on 30 January 2025. - Announcement: https://docs.hetzner.cloud/changelog#2023-07-20-actions-list-endpoint-is-deprecated - Removal: https://docs.hetzner.cloud/changelog#2025-01-30-listing-arbitrary-actions-in-the-actions-list-endpoint-is-removed',
    'operation_id' => 'get_actions',
    'method' => 'GET',
    'path' => '/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'query',
        'required' => true,
        'description' => 'Filter the actions by ID. May be used multiple times. The response will only contain actions matching the specified IDs.',
        'schema_type' => 'array',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_action' =>
  array (
    'slug' => 'hetzner_get_action',
    'class' => 'HetznerGetAction',
    'type' => 'read',
    'name' => 'Get an Action',
    'description' => 'Returns a specific Action object.',
    'operation_id' => 'get_action',
    'method' => 'GET',
    'path' => '/actions/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_certificates' =>
  array (
    'slug' => 'hetzner_list_certificates',
    'class' => 'HetznerListCertificates',
    'type' => 'read',
    'name' => 'List Certificates',
    'description' => 'Returns all Certificate objects.',
    'operation_id' => 'list_certificates',
    'method' => 'GET',
    'path' => '/certificates',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort resources by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their name. The response will only contain the resources matching exactly the specified name.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'label_selector',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by labels. The response will only contain resources matching the label selector. For more information, see "[Label Selector](#description/label-selector)".',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by type. May be used multiple times. The response will only contain the resources with the specified type.',
        'schema_type' => 'array',
      ),
      4 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      5 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_create_certificate' =>
  array (
    'slug' => 'hetzner_create_certificate',
    'class' => 'HetznerCreateCertificate',
    'type' => 'write',
    'name' => 'Create a Certificate',
    'description' => 'Creates a new Certificate. The default type **uploaded** allows for uploading your existing `certificate` and `private_key` in PEM format. You have to monitor its expiration date and handle renewal yourself. In contrast, type **managed** requests a new Certificate from *Let\'s Encrypt* for the specified `domain_names`. Only domains managed by *Hetzner DNS* are supported. We handle renewal and timely alert the project owner via email if problems occur. For type `managed` Certificates the `action` key of the response contains the Action that allows for tracking the issuance process. For type `uploaded` Certificates the `action` is always null.',
    'operation_id' => 'create_certificate',
    'method' => 'POST',
    'path' => '/certificates',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_list_certificates_actions' =>
  array (
    'slug' => 'hetzner_list_certificates_actions',
    'class' => 'HetznerListCertificatesActions',
    'type' => 'read',
    'name' => 'List Actions',
    'description' => 'Returns all Action objects. You can `sort` the results by using the sort URI parameter, and filter them with the `status` and `id` parameter.',
    'operation_id' => 'list_certificates_actions',
    'method' => 'GET',
    'path' => '/certificates/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by ID. May be used multiple times. The response will only contain actions matching the specified IDs.',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_certificates_action' =>
  array (
    'slug' => 'hetzner_get_certificates_action',
    'class' => 'HetznerGetCertificatesAction',
    'type' => 'read',
    'name' => 'Get an Action',
    'description' => 'Returns a specific Action object.',
    'operation_id' => 'get_certificates_action',
    'method' => 'GET',
    'path' => '/certificates/actions/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_certificate' =>
  array (
    'slug' => 'hetzner_get_certificate',
    'class' => 'HetznerGetCertificate',
    'type' => 'read',
    'name' => 'Get a Certificate',
    'description' => 'Gets a specific Certificate object.',
    'operation_id' => 'get_certificate',
    'method' => 'GET',
    'path' => '/certificates/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Certificate.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_update_certificate' =>
  array (
    'slug' => 'hetzner_update_certificate',
    'class' => 'HetznerUpdateCertificate',
    'type' => 'write',
    'name' => 'Update a Certificate',
    'description' => 'Updates the Certificate properties. Note: if the Certificate object changes during the request, the response will be a "conflict" error.',
    'operation_id' => 'update_certificate',
    'method' => 'PUT',
    'path' => '/certificates/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Certificate.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_delete_certificate' =>
  array (
    'slug' => 'hetzner_delete_certificate',
    'class' => 'HetznerDeleteCertificate',
    'type' => 'write',
    'name' => 'Delete a Certificate',
    'description' => 'Deletes a Certificate.',
    'operation_id' => 'delete_certificate',
    'method' => 'DELETE',
    'path' => '/certificates/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Certificate.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_certificate_actions' =>
  array (
    'slug' => 'hetzner_list_certificate_actions',
    'class' => 'HetznerListCertificateActions',
    'type' => 'read',
    'name' => 'List Actions for a Certificate',
    'description' => 'Returns all Action objects for a Certificate. You can sort the results by using the `sort` URI parameter, and filter them with the `status` parameter. Only type `managed` Certificates can have Actions. For type `uploaded` Certificates the `actions` key will always contain an empty array.',
    'operation_id' => 'list_certificate_actions',
    'method' => 'GET',
    'path' => '/certificates/{id}/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Certificate.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_retry_certificate' =>
  array (
    'slug' => 'hetzner_retry_certificate',
    'class' => 'HetznerRetryCertificate',
    'type' => 'write',
    'name' => 'Retry Issuance or Renewal',
    'description' => 'Retry a failed Certificate issuance or renewal. Only applicable if the type of the Certificate is `managed` and the issuance or renewal status is `failed`. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | | `caa_record_does_not_allow_ca` | CAA record does not allow certificate authority | | | `ca_dns_validation_failed` | Certificate Authority: DNS validation failed | | | `ca_too_many_authorizations_failed_recently` | Certificate Authority: Too many authorizations failed recently | | | `ca_too_many_certificates_issued_for_registered_domain` | Certificate Authority: Too many certificates issued for registered domain | | | `ca_too_many_duplicate_certificates` | Certificate Authority: Too many duplicate certificates | | | `could_not_verify_domain_delegated_to_zone` | Could not verify domain delegated to zone | | | `dns_zone_not_found` | DNS zone not found | | | `dns_zone_is_secondary_zone` | DNS zone is a secondary zone |',
    'operation_id' => 'retry_certificate',
    'method' => 'POST',
    'path' => '/certificates/{id}/actions/retry',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Certificate.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_certificate_action' =>
  array (
    'slug' => 'hetzner_get_certificate_action',
    'class' => 'HetznerGetCertificateAction',
    'type' => 'read',
    'name' => 'Get an Action for a Certificate',
    'description' => '**Deprecated**: This operation is deprecated, see our [changelog](https://docs.hetzner.cloud/changelog#2026-04-30-deprecate-get-resource-action-endpoints) for more details. Returns a specific Action for a Certificate. Only type `managed` Certificates have Actions.',
    'operation_id' => 'get_certificate_action',
    'method' => 'GET',
    'path' => '/certificates/{id}/actions/{action_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Certificate.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'action_id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_datacenters' =>
  array (
    'slug' => 'hetzner_list_datacenters',
    'class' => 'HetznerListDatacenters',
    'type' => 'read',
    'name' => 'List Data Centers',
    'description' => 'Returns all [Data Centers](#tag/data-centers).',
    'operation_id' => 'list_datacenters',
    'method' => 'GET',
    'path' => '/datacenters',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their name. The response will only contain the resources matching exactly the specified name.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort resources by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_datacenter' =>
  array (
    'slug' => 'hetzner_get_datacenter',
    'class' => 'HetznerGetDatacenter',
    'type' => 'read',
    'name' => 'Get a Data Center',
    'description' => 'Returns a single [Data Center](#tag/data-centers).',
    'operation_id' => 'get_datacenter',
    'method' => 'GET',
    'path' => '/datacenters/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Data Center.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_firewalls' =>
  array (
    'slug' => 'hetzner_list_firewalls',
    'class' => 'HetznerListFirewalls',
    'type' => 'read',
    'name' => 'List Firewalls',
    'description' => 'Returns all [Firewalls](#tag/firewalls). Use the provided URI parameters to modify the result.',
    'operation_id' => 'list_firewalls',
    'method' => 'GET',
    'path' => '/firewalls',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort resources by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their name. The response will only contain the resources matching exactly the specified name.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'label_selector',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by labels. The response will only contain resources matching the label selector. For more information, see "[Label Selector](#description/label-selector)".',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_create_firewall' =>
  array (
    'slug' => 'hetzner_create_firewall',
    'class' => 'HetznerCreateFirewall',
    'type' => 'write',
    'name' => 'Create a Firewall',
    'description' => 'Create a [Firewall](#tag/firewalls). #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `server_already_added` | The [Server](#tag/servers) was applied more than once. | | `422` | `incompatible_network_type` | The resources network type is not supported by [Firewalls](#tag/firewalls). | | `422` | `firewall_resource_not_found` | The resource the [Firewall](#tag/firewalls) should be attached to was not found. |',
    'operation_id' => 'create_firewall',
    'method' => 'POST',
    'path' => '/firewalls',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_list_firewalls_actions' =>
  array (
    'slug' => 'hetzner_list_firewalls_actions',
    'class' => 'HetznerListFirewallsActions',
    'type' => 'read',
    'name' => 'List Actions',
    'description' => 'Returns all [Actions](#tag/actions) for [Firewalls](#tag/firewalls). Use the provided URI parameters to modify the result.',
    'operation_id' => 'list_firewalls_actions',
    'method' => 'GET',
    'path' => '/firewalls/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by ID. May be used multiple times. The response will only contain actions matching the specified IDs.',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_firewalls_action' =>
  array (
    'slug' => 'hetzner_get_firewalls_action',
    'class' => 'HetznerGetFirewallsAction',
    'type' => 'read',
    'name' => 'Get an Action',
    'description' => 'Returns the specific [Action](#tag/actions).',
    'operation_id' => 'get_firewalls_action',
    'method' => 'GET',
    'path' => '/firewalls/actions/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_firewall' =>
  array (
    'slug' => 'hetzner_get_firewall',
    'class' => 'HetznerGetFirewall',
    'type' => 'read',
    'name' => 'Get a Firewall',
    'description' => 'Returns a single [Firewall](#tag/firewalls).',
    'operation_id' => 'get_firewall',
    'method' => 'GET',
    'path' => '/firewalls/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Firewall.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_update_firewall' =>
  array (
    'slug' => 'hetzner_update_firewall',
    'class' => 'HetznerUpdateFirewall',
    'type' => 'write',
    'name' => 'Update a Firewall',
    'description' => 'Update a [Firewall](#tag/firewalls). In case of a parallel running change on the [Firewall](#tag/firewalls) a `conflict` error will be returned.',
    'operation_id' => 'update_firewall',
    'method' => 'PUT',
    'path' => '/firewalls/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Firewall.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_delete_firewall' =>
  array (
    'slug' => 'hetzner_delete_firewall',
    'class' => 'HetznerDeleteFirewall',
    'type' => 'write',
    'name' => 'Delete a Firewall',
    'description' => 'Deletes the [Firewall](#tag/firewalls). #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `resource_in_use` | [Firewall](#tag/firewalls) still applied to a resource |',
    'operation_id' => 'delete_firewall',
    'method' => 'DELETE',
    'path' => '/firewalls/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Firewall.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_firewall_actions' =>
  array (
    'slug' => 'hetzner_list_firewall_actions',
    'class' => 'HetznerListFirewallActions',
    'type' => 'read',
    'name' => 'List Actions for a Firewall',
    'description' => 'Returns all [Actions](#tag/actions) for the [Firewall](#tag/firewalls). Use the provided URI parameters to modify the result.',
    'operation_id' => 'list_firewall_actions',
    'method' => 'GET',
    'path' => '/firewalls/{id}/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Firewall.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_apply_firewall_to_resources' =>
  array (
    'slug' => 'hetzner_apply_firewall_to_resources',
    'class' => 'HetznerApplyFirewallToResources',
    'type' => 'write',
    'name' => 'Apply to Resources',
    'description' => 'Applies a [Firewall](#tag/firewalls) to multiple resources. Supported resources: - [Servers](#tag/servers) (with a public network interface) - [Label Selectors](#description/label-selector) A [Server](#tag/servers) can be applied to [a maximum of 5 Firewalls](https://docs.hetzner.com/cloud/firewalls/overview#limits). This limit applies to [Servers](#tag/servers) applied via a matching [Label Selector](#description/label-selector) as well. Updates to resources matching or no longer matching a [Label Selector](#description/label-selector) can take up to a few seconds to be processed. A [Firewall](#tag/firewalls) is applied to a resource once the related [Action](#tag/actions) with command `apply_firewall` successfully finished. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `404` | `firewall_resource_not_found` | The resource the [Firewall](#tag/firewalls) should be applied to was not found | | `422` | `firewall_already_applied` | [Firewall](#tag/firewalls) is already applied to resource | | `422` | `incompatible_network_type` | The network type of the resource is not supported by [Firewalls](#tag/firewalls) | | `422` | `private_net_only_server` | The [Server](#tag/servers) the [Firewall](#tag/firewalls) should be applied to has no public interface |',
    'operation_id' => 'apply_firewall_to_resources',
    'method' => 'POST',
    'path' => '/firewalls/{id}/actions/apply_to_resources',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Firewall.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_remove_firewall_from_resources' =>
  array (
    'slug' => 'hetzner_remove_firewall_from_resources',
    'class' => 'HetznerRemoveFirewallFromResources',
    'type' => 'write',
    'name' => 'Remove from Resources',
    'description' => 'Removes a [Firewall](#tag/firewalls) from multiple resources. Supported resources: - [Servers](#tag/servers) (with a public network interface) A [Firewall](#tag/firewalls) is removed from a resource once the related [Action](#tag/actions) with command `remove_firewall` successfully finished. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `404` | `firewall_resource_not_found` | The resource the [Firewall](#tag/firewalls) should be removed from was not found | | `422` | `firewall_managed_by_label_selector` | [Firewall](#tag/firewall) is applied via a [Label Selector](#description/label-selector) and cannot be removed manually |',
    'operation_id' => 'remove_firewall_from_resources',
    'method' => 'POST',
    'path' => '/firewalls/{id}/actions/remove_from_resources',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Firewall.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_set_firewall_rules' =>
  array (
    'slug' => 'hetzner_set_firewall_rules',
    'class' => 'HetznerSetFirewallRules',
    'type' => 'write',
    'name' => 'Set Rules',
    'description' => 'Set the rules of a [Firewall](#tag/firewalls). Overwrites the existing rules with the given ones. Pass an empty array to remove all rules. Rules are limited to 50 entries per [Firewall](#tag/firewalls) and [500 effective rules](https://docs.hetzner.com/cloud/firewalls/overview#limits).',
    'operation_id' => 'set_firewall_rules',
    'method' => 'POST',
    'path' => '/firewalls/{id}/actions/set_rules',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Firewall.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_get_firewall_action' =>
  array (
    'slug' => 'hetzner_get_firewall_action',
    'class' => 'HetznerGetFirewallAction',
    'type' => 'read',
    'name' => 'Get an Action for a Firewall',
    'description' => '**Deprecated**: This operation is deprecated, see our [changelog](https://docs.hetzner.cloud/changelog#2026-04-30-deprecate-get-resource-action-endpoints) for more details. Returns a specific [Action](#tag/actions) for a [Firewall](#tag/firewalls).',
    'operation_id' => 'get_firewall_action',
    'method' => 'GET',
    'path' => '/firewalls/{id}/actions/{action_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Firewall.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'action_id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_floating_ips' =>
  array (
    'slug' => 'hetzner_list_floating_ips',
    'class' => 'HetznerListFloatingIps',
    'type' => 'read',
    'name' => 'List Floating IPs',
    'description' => 'List multiple [Floating IPs](#tag/floating-ips). Use the provided URI parameters to modify the result.',
    'operation_id' => 'list_floating_ips',
    'method' => 'GET',
    'path' => '/floating_ips',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their name. The response will only contain the resources matching exactly the specified name.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'label_selector',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by labels. The response will only contain resources matching the label selector. For more information, see "[Label Selector](#description/label-selector)".',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort resources by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_create_floating_ip' =>
  array (
    'slug' => 'hetzner_create_floating_ip',
    'class' => 'HetznerCreateFloatingIp',
    'type' => 'write',
    'name' => 'Create a Floating IP',
    'description' => 'Create a [Floating IP](#tag/floating-ips). Provide the `server` attribute to assign the [Floating IP](#tag/floating-ips) to that server or provide a `home_location` to locate the [Floating IP](#tag/floating-ips) at. Note that the [Floating IP](#tag/floating-ips) can be assigned to a [Server](#tag/servers) in any [Location](#tag/locations) later on. For optimal routing it is advised to use the [Floating IP](#tag/floating-ips) in the same [Location](#tag/locations) it was created in.',
    'operation_id' => 'create_floating_ip',
    'method' => 'POST',
    'path' => '/floating_ips',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'The `type` argument is required while `home_location` and `server` are mutually exclusive.',
    ),
  ),
  'hetzner_list_floating_ips_actions' =>
  array (
    'slug' => 'hetzner_list_floating_ips_actions',
    'class' => 'HetznerListFloatingIpsActions',
    'type' => 'read',
    'name' => 'List Actions',
    'description' => 'Lists multiple [Actions](#tag/actions). Use the provided URI parameters to modify the result.',
    'operation_id' => 'list_floating_ips_actions',
    'method' => 'GET',
    'path' => '/floating_ips/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by ID. May be used multiple times. The response will only contain actions matching the specified IDs.',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_floating_ips_action' =>
  array (
    'slug' => 'hetzner_get_floating_ips_action',
    'class' => 'HetznerGetFloatingIpsAction',
    'type' => 'read',
    'name' => 'Get an Action',
    'description' => 'Returns a single [Action](#tag/actions).',
    'operation_id' => 'get_floating_ips_action',
    'method' => 'GET',
    'path' => '/floating_ips/actions/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_floating_ip' =>
  array (
    'slug' => 'hetzner_get_floating_ip',
    'class' => 'HetznerGetFloatingIp',
    'type' => 'read',
    'name' => 'Get a Floating IP',
    'description' => 'Returns a single [Floating IP](#tag/floating-ips).',
    'operation_id' => 'get_floating_ip',
    'method' => 'GET',
    'path' => '/floating_ips/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Floating IP.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_update_floating_ip' =>
  array (
    'slug' => 'hetzner_update_floating_ip',
    'class' => 'HetznerUpdateFloatingIp',
    'type' => 'write',
    'name' => 'Update a Floating IP',
    'description' => 'Update a [Floating IP](#tag/floating-ips).',
    'operation_id' => 'update_floating_ip',
    'method' => 'PUT',
    'path' => '/floating_ips/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Floating IP.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_delete_floating_ip' =>
  array (
    'slug' => 'hetzner_delete_floating_ip',
    'class' => 'HetznerDeleteFloatingIp',
    'type' => 'write',
    'name' => 'Delete a Floating IP',
    'description' => 'Deletes a [Floating IP](#tag/floating-ips). If assigned to a [Server](#tag/servers) the [Floating IP](#tag/floating-ips) will be unassigned automatically until 1 May 2026. After this date, the [Floating IP](#tag/floating-ips) needs to be unassigned before it can be deleted. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `must_be_unassigned` | Error when IP is still assigned to a Resource. This error will appear as of 1 May 2026. |',
    'operation_id' => 'delete_floating_ip',
    'method' => 'DELETE',
    'path' => '/floating_ips/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Floating IP.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_floating_ip_actions' =>
  array (
    'slug' => 'hetzner_list_floating_ip_actions',
    'class' => 'HetznerListFloatingIpActions',
    'type' => 'read',
    'name' => 'List Actions for a Floating IP',
    'description' => 'Lists [Actions](#tag/actions) for a [Floating IP](#tag/floating-ips). Use the provided URI parameters to modify the result.',
    'operation_id' => 'list_floating_ip_actions',
    'method' => 'GET',
    'path' => '/floating_ips/{id}/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Floating IP.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_assign_floating_ip' =>
  array (
    'slug' => 'hetzner_assign_floating_ip',
    'class' => 'HetznerAssignFloatingIp',
    'type' => 'write',
    'name' => 'Assign a Floating IP to a Server',
    'description' => 'Assigns a [Floating IP](#tag/floating-ips) to a [Server](#tag/servers). #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `floating_ip_assigned` | The [Floating IP](#tag/floating-ips) is already assigned |',
    'operation_id' => 'assign_floating_ip',
    'method' => 'POST',
    'path' => '/floating_ips/{id}/actions/assign',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Floating IP.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_change_floating_ip_dns_ptr' =>
  array (
    'slug' => 'hetzner_change_floating_ip_dns_ptr',
    'class' => 'HetznerChangeFloatingIpDnsPtr',
    'type' => 'write',
    'name' => 'Change reverse DNS records for a Floating IP',
    'description' => 'Change the reverse DNS records for this [Floating IP](#tag/floating-ips). Allows to modify the PTR records set for the IP address.',
    'operation_id' => 'change_floating_ip_dns_ptr',
    'method' => 'POST',
    'path' => '/floating_ips/{id}/actions/change_dns_ptr',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Floating IP.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'The `ip` attributes specifies for which IP address the record is set. For IPv4 addresses this must be the exact address of the [Floating IP](#tag/floating-ips). For IPv6 addresses this must be a single address within the `/64` subnet of the [Floating IP](#tag/floating-ips). The `dns_ptr` attribute specifies the hostname used for the IP address. Must be a fully qualified domain name (FQDN) without trailing dot. For IPv6 [Floating IPs](#tag/floating-ips) up to 100 entries can be created.',
    ),
  ),
  'hetzner_change_floating_ip_protection' =>
  array (
    'slug' => 'hetzner_change_floating_ip_protection',
    'class' => 'HetznerChangeFloatingIpProtection',
    'type' => 'write',
    'name' => 'Change Floating IP Protection',
    'description' => 'Changes the protection settings configured for the [Floating IP](#tag/floating-ips).',
    'operation_id' => 'change_floating_ip_protection',
    'method' => 'POST',
    'path' => '/floating_ips/{id}/actions/change_protection',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Floating IP.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_unassign_floating_ip' =>
  array (
    'slug' => 'hetzner_unassign_floating_ip',
    'class' => 'HetznerUnassignFloatingIp',
    'type' => 'write',
    'name' => 'Unassign a Floating IP',
    'description' => 'Unassigns a [Floating IP](#tag/floating-ips). Results in the IP being unreachable. Can be assigned to another resource again.',
    'operation_id' => 'unassign_floating_ip',
    'method' => 'POST',
    'path' => '/floating_ips/{id}/actions/unassign',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Floating IP.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_floating_ip_action' =>
  array (
    'slug' => 'hetzner_get_floating_ip_action',
    'class' => 'HetznerGetFloatingIpAction',
    'type' => 'read',
    'name' => 'Get an Action for a Floating IP',
    'description' => '**Deprecated**: This operation is deprecated, see our [changelog](https://docs.hetzner.cloud/changelog#2026-04-30-deprecate-get-resource-action-endpoints) for more details. Returns a specific [Action](#tag/actions) for a [Floating IP](#tag/floating-ips).',
    'operation_id' => 'get_floating_ip_action',
    'method' => 'GET',
    'path' => '/floating_ips/{id}/actions/{action_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Floating IP.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'action_id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_images' =>
  array (
    'slug' => 'hetzner_list_images',
    'class' => 'HetznerListImages',
    'type' => 'read',
    'name' => 'List Images',
    'description' => 'Returns all Image objects. You can select specific Image types only and sort the results by using URI parameters.',
    'operation_id' => 'list_images',
    'method' => 'GET',
    'path' => '/images',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort resources by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by type. May be used multiple times. The response will only contain the resources with the specified type.',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by status. May be used multiple times. The response will only contain the resources with the specified status.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'bound_to',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter Images by their linked Server ID. May be used multiple times. Only available for Images of type `backup`.',
        'schema_type' => 'array',
      ),
      4 =>
      array (
        'name' => 'include_deprecated',
        'in' => 'query',
        'required' => false,
        'description' => 'Include deprecated Images.',
        'schema_type' => 'boolean',
      ),
      5 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their name. The response will only contain the resources matching exactly the specified name.',
        'schema_type' => 'string',
      ),
      6 =>
      array (
        'name' => 'label_selector',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by labels. The response will only contain resources matching the label selector. For more information, see "[Label Selector](#description/label-selector)".',
        'schema_type' => 'string',
      ),
      7 =>
      array (
        'name' => 'architecture',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by cpu architecture. The response will only contain the resources with the specified cpu architecture.',
        'schema_type' => 'string',
      ),
      8 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      9 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_images_actions' =>
  array (
    'slug' => 'hetzner_list_images_actions',
    'class' => 'HetznerListImagesActions',
    'type' => 'read',
    'name' => 'List Actions',
    'description' => 'Returns all Action objects. You can `sort` the results by using the sort URI parameter, and filter them with the `status` and `id` parameter.',
    'operation_id' => 'list_images_actions',
    'method' => 'GET',
    'path' => '/images/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by ID. May be used multiple times. The response will only contain actions matching the specified IDs.',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_images_action' =>
  array (
    'slug' => 'hetzner_get_images_action',
    'class' => 'HetznerGetImagesAction',
    'type' => 'read',
    'name' => 'Get an Action',
    'description' => 'Returns a specific Action object.',
    'operation_id' => 'get_images_action',
    'method' => 'GET',
    'path' => '/images/actions/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_image' =>
  array (
    'slug' => 'hetzner_get_image',
    'class' => 'HetznerGetImage',
    'type' => 'read',
    'name' => 'Get an Image',
    'description' => 'Returns a specific Image object.',
    'operation_id' => 'get_image',
    'method' => 'GET',
    'path' => '/images/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Image.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_update_image' =>
  array (
    'slug' => 'hetzner_update_image',
    'class' => 'HetznerUpdateImage',
    'type' => 'write',
    'name' => 'Update an Image',
    'description' => 'Updates the Image. You may change the description, convert a Backup Image to a Snapshot Image or change the Image labels. Only Images of type `snapshot` and `backup` can be updated.',
    'operation_id' => 'update_image',
    'method' => 'PUT',
    'path' => '/images/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Image.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_delete_image' =>
  array (
    'slug' => 'hetzner_delete_image',
    'class' => 'HetznerDeleteImage',
    'type' => 'write',
    'name' => 'Delete an Image',
    'description' => 'Deletes an Image. Only Images of type `snapshot` and `backup` can be deleted.',
    'operation_id' => 'delete_image',
    'method' => 'DELETE',
    'path' => '/images/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Image.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_image_actions' =>
  array (
    'slug' => 'hetzner_list_image_actions',
    'class' => 'HetznerListImageActions',
    'type' => 'read',
    'name' => 'List Actions for an Image',
    'description' => 'Returns all Action objects for an Image. You can sort the results by using the `sort` URI parameter, and filter them with the `status` parameter.',
    'operation_id' => 'list_image_actions',
    'method' => 'GET',
    'path' => '/images/{id}/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Image.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_change_image_protection' =>
  array (
    'slug' => 'hetzner_change_image_protection',
    'class' => 'HetznerChangeImageProtection',
    'type' => 'write',
    'name' => 'Change Image Protection',
    'description' => 'Changes the protection configuration of the Image. Can only be used on snapshots.',
    'operation_id' => 'change_image_protection',
    'method' => 'POST',
    'path' => '/images/{id}/actions/change_protection',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Image.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_get_image_action' =>
  array (
    'slug' => 'hetzner_get_image_action',
    'class' => 'HetznerGetImageAction',
    'type' => 'read',
    'name' => 'Get an Action for an Image',
    'description' => '**Deprecated**: This operation is deprecated, see our [changelog](https://docs.hetzner.cloud/changelog#2026-04-30-deprecate-get-resource-action-endpoints) for more details. Returns a specific Action for an Image.',
    'operation_id' => 'get_image_action',
    'method' => 'GET',
    'path' => '/images/{id}/actions/{action_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Image.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'action_id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_isos' =>
  array (
    'slug' => 'hetzner_list_isos',
    'class' => 'HetznerListIsos',
    'type' => 'read',
    'name' => 'List ISOs',
    'description' => 'Returns all available ISO objects.',
    'operation_id' => 'list_isos',
    'method' => 'GET',
    'path' => '/isos',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their name. The response will only contain the resources matching exactly the specified name.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'architecture',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by cpu architecture. The response will only contain the resources with the specified cpu architecture.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'include_architecture_wildcard',
        'in' => 'query',
        'required' => false,
        'description' => 'Include Images with wildcard architecture (architecture is null). Architecture filter must be specified.',
        'schema_type' => 'boolean',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_iso' =>
  array (
    'slug' => 'hetzner_get_iso',
    'class' => 'HetznerGetIso',
    'type' => 'read',
    'name' => 'Get an ISO',
    'description' => 'Returns a specific ISO object.',
    'operation_id' => 'get_iso',
    'method' => 'GET',
    'path' => '/isos/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the ISO.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_load_balancer_types' =>
  array (
    'slug' => 'hetzner_list_load_balancer_types',
    'class' => 'HetznerListLoadBalancerTypes',
    'type' => 'read',
    'name' => 'List Load Balancer Types',
    'description' => 'Gets all Load Balancer type objects.',
    'operation_id' => 'list_load_balancer_types',
    'method' => 'GET',
    'path' => '/load_balancer_types',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their name. The response will only contain the resources matching exactly the specified name.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_load_balancer_type' =>
  array (
    'slug' => 'hetzner_get_load_balancer_type',
    'class' => 'HetznerGetLoadBalancerType',
    'type' => 'read',
    'name' => 'Get a Load Balancer Type',
    'description' => 'Gets a specific Load Balancer type object.',
    'operation_id' => 'get_load_balancer_type',
    'method' => 'GET',
    'path' => '/load_balancer_types/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer Type.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_load_balancers' =>
  array (
    'slug' => 'hetzner_list_load_balancers',
    'class' => 'HetznerListLoadBalancers',
    'type' => 'read',
    'name' => 'List Load Balancers',
    'description' => 'Gets all existing Load Balancers that you have available.',
    'operation_id' => 'list_load_balancers',
    'method' => 'GET',
    'path' => '/load_balancers',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort resources by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their name. The response will only contain the resources matching exactly the specified name.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'label_selector',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by labels. The response will only contain resources matching the label selector. For more information, see "[Label Selector](#description/label-selector)".',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_create_load_balancer' =>
  array (
    'slug' => 'hetzner_create_load_balancer',
    'class' => 'HetznerCreateLoadBalancer',
    'type' => 'write',
    'name' => 'Create a Load Balancer',
    'description' => 'Creates a Load Balancer. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `412` | `source_port_already_used` | The source port you are trying to add is already in use | | `422` | `ip_not_owned` | The IP is not owned by the owner of the project of the Load Balancer | | `422` | `load_balancer_not_attached_to_network` | The Load Balancer is not attached to a network | | `422` | `resolve_cloud_private_targets_error` | The server you are trying to add as a target is not attached to the same network as the Load Balancer | | `422` | `resolve_cloud_public_targets_error` | The server that you are trying to add as a public target does not have a public IPv4 address | | `422` | `target_already_defined` | The Load Balancer target you are trying to define is already defined |',
    'operation_id' => 'create_load_balancer',
    'method' => 'POST',
    'path' => '/load_balancers',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_list_load_balancers_actions' =>
  array (
    'slug' => 'hetzner_list_load_balancers_actions',
    'class' => 'HetznerListLoadBalancersActions',
    'type' => 'read',
    'name' => 'List Actions',
    'description' => 'Returns all Action objects. You can `sort` the results by using the sort URI parameter, and filter them with the `status` and `id` parameter.',
    'operation_id' => 'list_load_balancers_actions',
    'method' => 'GET',
    'path' => '/load_balancers/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by ID. May be used multiple times. The response will only contain actions matching the specified IDs.',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_load_balancers_action' =>
  array (
    'slug' => 'hetzner_get_load_balancers_action',
    'class' => 'HetznerGetLoadBalancersAction',
    'type' => 'read',
    'name' => 'Get an Action',
    'description' => 'Returns a specific Action object.',
    'operation_id' => 'get_load_balancers_action',
    'method' => 'GET',
    'path' => '/load_balancers/actions/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_load_balancer' =>
  array (
    'slug' => 'hetzner_get_load_balancer',
    'class' => 'HetznerGetLoadBalancer',
    'type' => 'read',
    'name' => 'Get a Load Balancer',
    'description' => 'Gets a specific Load Balancer object.',
    'operation_id' => 'get_load_balancer',
    'method' => 'GET',
    'path' => '/load_balancers/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_update_load_balancer' =>
  array (
    'slug' => 'hetzner_update_load_balancer',
    'class' => 'HetznerUpdateLoadBalancer',
    'type' => 'write',
    'name' => 'Update a Load Balancer',
    'description' => 'Updates a Load Balancer. You can update a Load Balancer\'s name and a Load Balancer\'s labels. Note: if the Load Balancer object changes during the request, the response will be a "conflict" error.',
    'operation_id' => 'update_load_balancer',
    'method' => 'PUT',
    'path' => '/load_balancers/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_delete_load_balancer' =>
  array (
    'slug' => 'hetzner_delete_load_balancer',
    'class' => 'HetznerDeleteLoadBalancer',
    'type' => 'write',
    'name' => 'Delete a Load Balancer',
    'description' => 'Deletes a Load Balancer.',
    'operation_id' => 'delete_load_balancer',
    'method' => 'DELETE',
    'path' => '/load_balancers/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_load_balancer_actions' =>
  array (
    'slug' => 'hetzner_list_load_balancer_actions',
    'class' => 'HetznerListLoadBalancerActions',
    'type' => 'read',
    'name' => 'List Actions for a Load Balancer',
    'description' => 'Returns all Action objects for a Load Balancer. You can sort the results by using the `sort` URI parameter, and filter them with the `status` parameter.',
    'operation_id' => 'list_load_balancer_actions',
    'method' => 'GET',
    'path' => '/load_balancers/{id}/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_add_load_balancer_service' =>
  array (
    'slug' => 'hetzner_add_load_balancer_service',
    'class' => 'HetznerAddLoadBalancerService',
    'type' => 'write',
    'name' => 'Add Service',
    'description' => 'Adds a service to a Load Balancer. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `412` | `source_port_already_used` | The source port you are trying to add is already in use |',
    'operation_id' => 'add_load_balancer_service',
    'method' => 'POST',
    'path' => '/load_balancers/{id}/actions/add_service',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_add_load_balancer_target' =>
  array (
    'slug' => 'hetzner_add_load_balancer_target',
    'class' => 'HetznerAddLoadBalancerTarget',
    'type' => 'write',
    'name' => 'Add Target',
    'description' => 'Adds a target to a Load Balancer. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `ip_not_in_vswitch_subnet` | The IP you are trying to add does not belong to the vswitch subnet of the attached network | | `422` | `ip_not_owned` | The IP you are trying to add as a target is not owned by the Project owner | | `422` | `load_balancer_public_interface_disabled` | The Load Balancer\'s public network interface is disabled | | `422` | `load_balancer_not_attached_to_network` | The Load Balancer is not attached to a network | | `422` | `network_has_no_vswitch_subnet` | The given IP is private but attached network does not have a vswitch subnet | | `422` | `resolve_cloud_private_targets_error` | The server you are trying to add as a target is not attached to the same network as the Load Balancer | | `422` | `resolve_cloud_public_targets_error` | The server that you are trying to add as a public target does not have a public IPv4 address | | `422` | `target_already_defined` | The Load Balancer target you are trying to define is already defined |',
    'operation_id' => 'add_load_balancer_target',
    'method' => 'POST',
    'path' => '/load_balancers/{id}/actions/add_target',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_attach_load_balancer_to_network' =>
  array (
    'slug' => 'hetzner_attach_load_balancer_to_network',
    'class' => 'HetznerAttachLoadBalancerToNetwork',
    'type' => 'write',
    'name' => 'Attach a Load Balancer to a Network',
    'description' => 'Attach a Load Balancer to a Network. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `load_balancer_already_attached` | The Load Balancer is already attached to a network | | `422` | `ip_not_available` | The provided Network IP is not available | | `422` | `no_subnet_available` | No Subnet or IP is available for the Load Balancer within the network |',
    'operation_id' => 'attach_load_balancer_to_network',
    'method' => 'POST',
    'path' => '/load_balancers/{id}/actions/attach_to_network',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_change_load_balancer_algorithm' =>
  array (
    'slug' => 'hetzner_change_load_balancer_algorithm',
    'class' => 'HetznerChangeLoadBalancerAlgorithm',
    'type' => 'write',
    'name' => 'Change Algorithm',
    'description' => 'Change the algorithm that determines to which target new requests are sent.',
    'operation_id' => 'change_load_balancer_algorithm',
    'method' => 'POST',
    'path' => '/load_balancers/{id}/actions/change_algorithm',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_change_load_balancer_dns_ptr' =>
  array (
    'slug' => 'hetzner_change_load_balancer_dns_ptr',
    'class' => 'HetznerChangeLoadBalancerDnsPtr',
    'type' => 'write',
    'name' => 'Change reverse DNS entry for this Load Balancer',
    'description' => 'Changes the hostname that will appear when getting the hostname belonging to the public IPs (IPv4 and IPv6) of this Load Balancer. Floating IPs assigned to the Server are not affected by this.',
    'operation_id' => 'change_load_balancer_dns_ptr',
    'method' => 'POST',
    'path' => '/load_balancers/{id}/actions/change_dns_ptr',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Select the IP address for which to change the DNS entry by passing `ip`. It can be either IPv4 or IPv6. The target hostname is set by passing `dns_ptr`, which must be a fully qualified domain name (FQDN) without trailing dot.',
    ),
  ),
  'hetzner_change_load_balancer_protection' =>
  array (
    'slug' => 'hetzner_change_load_balancer_protection',
    'class' => 'HetznerChangeLoadBalancerProtection',
    'type' => 'write',
    'name' => 'Change Load Balancer Protection',
    'description' => 'Changes the protection configuration of a Load Balancer.',
    'operation_id' => 'change_load_balancer_protection',
    'method' => 'POST',
    'path' => '/load_balancers/{id}/actions/change_protection',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_change_load_balancer_type' =>
  array (
    'slug' => 'hetzner_change_load_balancer_type',
    'class' => 'HetznerChangeLoadBalancerType',
    'type' => 'write',
    'name' => 'Change the Type of a Load Balancer',
    'description' => 'Changes the type (Max Services, Max Targets and Max Connections) of a Load Balancer. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `invalid_load_balancer_type` | The Load Balancer type does not fit for the given Load Balancer |',
    'operation_id' => 'change_load_balancer_type',
    'method' => 'POST',
    'path' => '/load_balancers/{id}/actions/change_type',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_delete_load_balancer_service' =>
  array (
    'slug' => 'hetzner_delete_load_balancer_service',
    'class' => 'HetznerDeleteLoadBalancerService',
    'type' => 'write',
    'name' => 'Delete Service',
    'description' => 'Delete a service of a Load Balancer.',
    'operation_id' => 'delete_load_balancer_service',
    'method' => 'POST',
    'path' => '/load_balancers/{id}/actions/delete_service',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_detach_load_balancer_from_network' =>
  array (
    'slug' => 'hetzner_detach_load_balancer_from_network',
    'class' => 'HetznerDetachLoadBalancerFromNetwork',
    'type' => 'write',
    'name' => 'Detach a Load Balancer from a Network',
    'description' => 'Detaches a Load Balancer from a network.',
    'operation_id' => 'detach_load_balancer_from_network',
    'method' => 'POST',
    'path' => '/load_balancers/{id}/actions/detach_from_network',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_disable_load_balancer_public_interface' =>
  array (
    'slug' => 'hetzner_disable_load_balancer_public_interface',
    'class' => 'HetznerDisableLoadBalancerPublicInterface',
    'type' => 'write',
    'name' => 'Disable the public interface of a Load Balancer',
    'description' => 'Disable the public interface of a Load Balancer. The Load Balancer will be not accessible from the internet via its public IPs. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `load_balancer_not_attached_to_network` | The Load Balancer is not attached to a network | | `422` | `targets_without_use_private_ip` | The Load Balancer has targets that use the public IP instead of the private IP |',
    'operation_id' => 'disable_load_balancer_public_interface',
    'method' => 'POST',
    'path' => '/load_balancers/{id}/actions/disable_public_interface',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_enable_load_balancer_public_interface' =>
  array (
    'slug' => 'hetzner_enable_load_balancer_public_interface',
    'class' => 'HetznerEnableLoadBalancerPublicInterface',
    'type' => 'write',
    'name' => 'Enable the public interface of a Load Balancer',
    'description' => 'Enable the public interface of a Load Balancer. The Load Balancer will be accessible from the internet via its public IPs.',
    'operation_id' => 'enable_load_balancer_public_interface',
    'method' => 'POST',
    'path' => '/load_balancers/{id}/actions/enable_public_interface',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_remove_load_balancer_target' =>
  array (
    'slug' => 'hetzner_remove_load_balancer_target',
    'class' => 'HetznerRemoveLoadBalancerTarget',
    'type' => 'write',
    'name' => 'Remove Target',
    'description' => 'Removes a target from a Load Balancer.',
    'operation_id' => 'remove_load_balancer_target',
    'method' => 'POST',
    'path' => '/load_balancers/{id}/actions/remove_target',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_update_load_balancer_service' =>
  array (
    'slug' => 'hetzner_update_load_balancer_service',
    'class' => 'HetznerUpdateLoadBalancerService',
    'type' => 'write',
    'name' => 'Update Service',
    'description' => 'Updates a Load Balancer Service. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `source_port_already_used` | The source port you are trying to add is already in use |',
    'operation_id' => 'update_load_balancer_service',
    'method' => 'POST',
    'path' => '/load_balancers/{id}/actions/update_service',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_get_load_balancer_action' =>
  array (
    'slug' => 'hetzner_get_load_balancer_action',
    'class' => 'HetznerGetLoadBalancerAction',
    'type' => 'read',
    'name' => 'Get an Action for a Load Balancer',
    'description' => '**Deprecated**: This operation is deprecated, see our [changelog](https://docs.hetzner.cloud/changelog#2026-04-30-deprecate-get-resource-action-endpoints) for more details. Returns a specific Action for a Load Balancer.',
    'operation_id' => 'get_load_balancer_action',
    'method' => 'GET',
    'path' => '/load_balancers/{id}/actions/{action_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'action_id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_load_balancer_metrics' =>
  array (
    'slug' => 'hetzner_get_load_balancer_metrics',
    'class' => 'HetznerGetLoadBalancerMetrics',
    'type' => 'read',
    'name' => 'Get Metrics for a LoadBalancer',
    'description' => 'You must specify the type of metric to get: `open_connections`, `connections_per_second`, `requests_per_second` or `bandwidth`. You can also specify more than one type by comma separation, e.g. `requests_per_second,bandwidth`. Depending on the type you will get different time series data: |Type | Timeseries | Unit | Description | |---- |------------|------|-------------| | open_connections | open_connections | number | Open connections | | connections_per_second | connections_per_second | connections/s | Connections per second | | requests_per_second | requests_per_second | requests/s | Requests per second | | bandwidth | bandwidth.in | bytes/s | Ingress bandwidth | || bandwidth.out | bytes/s | Egress bandwidth | Metrics are available for the last 30 days only. If you do not provide the step argument we will automatically adjust it so that 200 samples are returned. We limit the number of samples to a maximum of 500 and will adjust the step parameter accordingly.',
    'operation_id' => 'get_load_balancer_metrics',
    'method' => 'GET',
    'path' => '/load_balancers/{id}/metrics',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Load Balancer.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => true,
        'description' => 'Type of metrics to get.',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'start',
        'in' => 'query',
        'required' => true,
        'description' => 'Start of period to get Metrics for (must be in [RFC3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) format).',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'end',
        'in' => 'query',
        'required' => true,
        'description' => 'End of period to get Metrics for (must be in [RFC3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) format).',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'step',
        'in' => 'query',
        'required' => false,
        'description' => 'Resolution of results in seconds.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_locations' =>
  array (
    'slug' => 'hetzner_list_locations',
    'class' => 'HetznerListLocations',
    'type' => 'read',
    'name' => 'List Locations',
    'description' => 'Returns all [Locations](#tag/locations).',
    'operation_id' => 'list_locations',
    'method' => 'GET',
    'path' => '/locations',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their name. The response will only contain the resources matching exactly the specified name.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort resources by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      3 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_location' =>
  array (
    'slug' => 'hetzner_get_location',
    'class' => 'HetznerGetLocation',
    'type' => 'read',
    'name' => 'Get a Location',
    'description' => 'Returns a [Location](#tag/locations).',
    'operation_id' => 'get_location',
    'method' => 'GET',
    'path' => '/locations/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Location.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_networks' =>
  array (
    'slug' => 'hetzner_list_networks',
    'class' => 'HetznerListNetworks',
    'type' => 'read',
    'name' => 'List Networks',
    'description' => 'List multiple [Networks](#tag/networks). Use the provided URI parameters to modify the result.',
    'operation_id' => 'list_networks',
    'method' => 'GET',
    'path' => '/networks',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort resources by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their name. The response will only contain the resources matching exactly the specified name.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'label_selector',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by labels. The response will only contain resources matching the label selector. For more information, see "[Label Selector](#description/label-selector)".',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_create_network' =>
  array (
    'slug' => 'hetzner_create_network',
    'class' => 'HetznerCreateNetwork',
    'type' => 'write',
    'name' => 'Create a Network',
    'description' => 'Creates a [Network](#tag/networks). The provided `ip_range` can only be extended later on, but not reduced. Subnets can be added now or later on using the [add subnet action](#tag/network-actions/add_network_subnet). If you do not specify an `ip_range` for the subnet the first available /24 range will be used. Routes can be added now or later by using the [add route action](#tag/network-actions/add_network_route).',
    'operation_id' => 'create_network',
    'method' => 'POST',
    'path' => '/networks',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_list_networks_actions' =>
  array (
    'slug' => 'hetzner_list_networks_actions',
    'class' => 'HetznerListNetworksActions',
    'type' => 'read',
    'name' => 'List Actions',
    'description' => 'Lists multiple [Actions](#tag/actions). Use the provided URI parameters to modify the result.',
    'operation_id' => 'list_networks_actions',
    'method' => 'GET',
    'path' => '/networks/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by ID. May be used multiple times. The response will only contain actions matching the specified IDs.',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_networks_action' =>
  array (
    'slug' => 'hetzner_get_networks_action',
    'class' => 'HetznerGetNetworksAction',
    'type' => 'read',
    'name' => 'Get an Action',
    'description' => 'Returns a single [Action](#tag/actions).',
    'operation_id' => 'get_networks_action',
    'method' => 'GET',
    'path' => '/networks/actions/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_network' =>
  array (
    'slug' => 'hetzner_get_network',
    'class' => 'HetznerGetNetwork',
    'type' => 'read',
    'name' => 'Get a Network',
    'description' => 'Get a specific [Network](#tag/networks).',
    'operation_id' => 'get_network',
    'method' => 'GET',
    'path' => '/networks/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Network.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_update_network' =>
  array (
    'slug' => 'hetzner_update_network',
    'class' => 'HetznerUpdateNetwork',
    'type' => 'write',
    'name' => 'Update a Network',
    'description' => 'Update a [Network](#tag/networks). If a change is currently being performed on this [Network](#tag/networks), a error response with code `conflict` will be returned.',
    'operation_id' => 'update_network',
    'method' => 'PUT',
    'path' => '/networks/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Network.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_delete_network' =>
  array (
    'slug' => 'hetzner_delete_network',
    'class' => 'HetznerDeleteNetwork',
    'type' => 'write',
    'name' => 'Delete a Network',
    'description' => 'Deletes a [Network](#tag/networks). Attached resources will be detached automatically.',
    'operation_id' => 'delete_network',
    'method' => 'DELETE',
    'path' => '/networks/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Network.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_network_actions' =>
  array (
    'slug' => 'hetzner_list_network_actions',
    'class' => 'HetznerListNetworkActions',
    'type' => 'read',
    'name' => 'List Actions for a Network',
    'description' => 'Lists [Actions](#tag/actions) for a [Network](#tag/networks). Use the provided URI parameters to modify the result.',
    'operation_id' => 'list_network_actions',
    'method' => 'GET',
    'path' => '/networks/{id}/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Network.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_add_network_route' =>
  array (
    'slug' => 'hetzner_add_network_route',
    'class' => 'HetznerAddNetworkRoute',
    'type' => 'write',
    'name' => 'Add a route to a Network',
    'description' => 'Adds a route entry to a [Network](#tag/networks). If a change is currently being performed on this [Network](#tag/networks), a error response with code `conflict` will be returned.',
    'operation_id' => 'add_network_route',
    'method' => 'POST',
    'path' => '/networks/{id}/actions/add_route',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Network.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_add_network_subnet' =>
  array (
    'slug' => 'hetzner_add_network_subnet',
    'class' => 'HetznerAddNetworkSubnet',
    'type' => 'write',
    'name' => 'Add a subnet to a Network',
    'description' => 'Adds a new subnet to the [Network](#tag/networks). If the subnet `ip_range` is not provided, the first available `/24` IP range will be used. If a change is currently being performed on this [Network](#tag/networks), a error response with code `conflict` will be returned.',
    'operation_id' => 'add_network_subnet',
    'method' => 'POST',
    'path' => '/networks/{id}/actions/add_subnet',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Network.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_change_network_ip_range' =>
  array (
    'slug' => 'hetzner_change_network_ip_range',
    'class' => 'HetznerChangeNetworkIpRange',
    'type' => 'write',
    'name' => 'Change IP range of a Network',
    'description' => 'Changes the IP range of a [Network](#tag/networks). The following restrictions apply to changing the IP range: - IP ranges can only be extended and never shrunk. - IPs can only be added to the end of the existing range, therefore only the netmask is allowed to be changed. To update the routes on the connected [Servers](#tag/servers), they need to be rebooted or the routes to be updated manually. For example if the [Network](#tag/networks) has a range of `10.0.0.0/16` to extend it the new range has to start with the IP `10.0.0.0` as well. The netmask `/16` can be changed to a smaller one then `16` therefore increasing the IP range. A valid entry would be `10.0.0.0/15`, `10.0.0.0/14` or `10.0.0.0/13` and so on. If a change is currently being performed on this [Network](#tag/networks), a error response with code `conflict` will be returned.',
    'operation_id' => 'change_network_ip_range',
    'method' => 'POST',
    'path' => '/networks/{id}/actions/change_ip_range',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Network.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_change_network_protection' =>
  array (
    'slug' => 'hetzner_change_network_protection',
    'class' => 'HetznerChangeNetworkProtection',
    'type' => 'write',
    'name' => 'Change Network Protection',
    'description' => 'Changes the protection settings of a [Network](#tag/networks). If a change is currently being performed on this [Network](#tag/networks), a error response with code `conflict` will be returned.',
    'operation_id' => 'change_network_protection',
    'method' => 'POST',
    'path' => '/networks/{id}/actions/change_protection',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Network.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_delete_network_route' =>
  array (
    'slug' => 'hetzner_delete_network_route',
    'class' => 'HetznerDeleteNetworkRoute',
    'type' => 'write',
    'name' => 'Delete a route from a Network',
    'description' => 'Delete a route entry from a [Network](#tag/networks). If a change is currently being performed on this [Network](#tag/networks), a error response with code `conflict` will be returned.',
    'operation_id' => 'delete_network_route',
    'method' => 'POST',
    'path' => '/networks/{id}/actions/delete_route',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Network.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_delete_network_subnet' =>
  array (
    'slug' => 'hetzner_delete_network_subnet',
    'class' => 'HetznerDeleteNetworkSubnet',
    'type' => 'write',
    'name' => 'Delete a subnet from a Network',
    'description' => 'Deletes a single subnet entry from a [Network](#tag/networks). Subnets containing attached resources can not be deleted, they must be detached beforehand. If a change is currently being performed on this [Network](#tag/networks), a error response with code `conflict` will be returned.',
    'operation_id' => 'delete_network_subnet',
    'method' => 'POST',
    'path' => '/networks/{id}/actions/delete_subnet',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Network.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_get_network_action' =>
  array (
    'slug' => 'hetzner_get_network_action',
    'class' => 'HetznerGetNetworkAction',
    'type' => 'read',
    'name' => 'Get an Action for a Network',
    'description' => '**Deprecated**: This operation is deprecated, see our [changelog](https://docs.hetzner.cloud/changelog#2026-04-30-deprecate-get-resource-action-endpoints) for more details. Returns a specific [Action](#tag/actions) for a [Network](#tag/networks).',
    'operation_id' => 'get_network_action',
    'method' => 'GET',
    'path' => '/networks/{id}/actions/{action_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Network.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'action_id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_placement_groups' =>
  array (
    'slug' => 'hetzner_list_placement_groups',
    'class' => 'HetznerListPlacementGroups',
    'type' => 'read',
    'name' => 'List Placement Groups',
    'description' => 'Returns all Placement Group objects.',
    'operation_id' => 'list_placement_groups',
    'method' => 'GET',
    'path' => '/placement_groups',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort resources by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their name. The response will only contain the resources matching exactly the specified name.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'label_selector',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by labels. The response will only contain resources matching the label selector. For more information, see "[Label Selector](#description/label-selector)".',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by type. May be used multiple times. The response will only contain the resources with the specified type.',
        'schema_type' => 'array',
      ),
      4 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      5 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_create_placement_group' =>
  array (
    'slug' => 'hetzner_create_placement_group',
    'class' => 'HetznerCreatePlacementGroup',
    'type' => 'write',
    'name' => 'Create a PlacementGroup',
    'description' => 'Creates a new Placement Group.',
    'operation_id' => 'create_placement_group',
    'method' => 'POST',
    'path' => '/placement_groups',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_get_placement_group' =>
  array (
    'slug' => 'hetzner_get_placement_group',
    'class' => 'HetznerGetPlacementGroup',
    'type' => 'read',
    'name' => 'Get a PlacementGroup',
    'description' => 'Gets a specific Placement Group object.',
    'operation_id' => 'get_placement_group',
    'method' => 'GET',
    'path' => '/placement_groups/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Placement Group.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_update_placement_group' =>
  array (
    'slug' => 'hetzner_update_placement_group',
    'class' => 'HetznerUpdatePlacementGroup',
    'type' => 'write',
    'name' => 'Update a PlacementGroup',
    'description' => 'Updates the Placement Group properties. Note: if the Placement Group object changes during the request, the response will be a "conflict" error.',
    'operation_id' => 'update_placement_group',
    'method' => 'PUT',
    'path' => '/placement_groups/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Placement Group.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_delete_placement_group' =>
  array (
    'slug' => 'hetzner_delete_placement_group',
    'class' => 'HetznerDeletePlacementGroup',
    'type' => 'write',
    'name' => 'Delete a PlacementGroup',
    'description' => 'Deletes a Placement Group.',
    'operation_id' => 'delete_placement_group',
    'method' => 'DELETE',
    'path' => '/placement_groups/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Placement Group.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_pricing' =>
  array (
    'slug' => 'hetzner_get_pricing',
    'class' => 'HetznerGetPricing',
    'type' => 'read',
    'name' => 'Get all prices',
    'description' => 'Returns prices for all resources available on the platform. VAT and currency of the Project owner are used for calculations. Both net and gross prices are included in the response.',
    'operation_id' => 'get_pricing',
    'method' => 'GET',
    'path' => '/pricing',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_primary_ips' =>
  array (
    'slug' => 'hetzner_list_primary_ips',
    'class' => 'HetznerListPrimaryIps',
    'type' => 'read',
    'name' => 'List Primary IPs',
    'description' => 'List multiple [Primary IPs](#tag/primary-ips). Use the provided URI parameters to modify the result.',
    'operation_id' => 'list_primary_ips',
    'method' => 'GET',
    'path' => '/primary_ips',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their name. The response will only contain the resources matching exactly the specified name.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'label_selector',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by labels. The response will only contain resources matching the label selector. For more information, see "[Label Selector](#description/label-selector)".',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'ip',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter results by IP address.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      5 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort resources by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_create_primary_ip' =>
  array (
    'slug' => 'hetzner_create_primary_ip',
    'class' => 'HetznerCreatePrimaryIp',
    'type' => 'write',
    'name' => 'Create a Primary IP',
    'description' => 'Create a new [Primary IP](#tag/primary-ips). Can optionally be assigned to a resource by providing an `assignee_id` and `assignee_type`. If not assigned to a resource the `location` key needs to be provided. This can be either the ID or the name of the [Location](#tag/locations) this [Primary IP](#tag/primary-ips) shall be created in. A [Primary IP](#tag/primary-ips) can only be assigned to resource in the same [Location](#tag/locations) later on. The `datacenter` key is deprecated in favor of `location` and will be removed after 01 July 2026. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `server_not_stopped` | The specified [Server](#tag/servers) is running, but needs to be powered off | | `422` | `server_has_ipv4` | The [Server](#tag/servers) already has an ipv4 address | | `422` | `server_has_ipv6` | The [Server](#tag/servers) already has an ipv6 address |',
    'operation_id' => 'create_primary_ip',
    'method' => 'POST',
    'path' => '/primary_ips',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request Body for creating a new [Primary IP](#tag/primary-ips). The `location`, `datacenter` and `assignee_id`/`assignee_type` attributes are mutually exclusive.',
    ),
  ),
  'hetzner_list_primary_ips_actions' =>
  array (
    'slug' => 'hetzner_list_primary_ips_actions',
    'class' => 'HetznerListPrimaryIpsActions',
    'type' => 'read',
    'name' => 'List Actions',
    'description' => 'Lists multiple [Actions](#tag/actions). Use the provided URI parameters to modify the result.',
    'operation_id' => 'list_primary_ips_actions',
    'method' => 'GET',
    'path' => '/primary_ips/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by ID. May be used multiple times. The response will only contain actions matching the specified IDs.',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_primary_ips_action' =>
  array (
    'slug' => 'hetzner_get_primary_ips_action',
    'class' => 'HetznerGetPrimaryIpsAction',
    'type' => 'read',
    'name' => 'Get an Action',
    'description' => 'Returns a single [Action](#tag/actions).',
    'operation_id' => 'get_primary_ips_action',
    'method' => 'GET',
    'path' => '/primary_ips/actions/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_primary_ip_actions' =>
  array (
    'slug' => 'hetzner_list_primary_ip_actions',
    'class' => 'HetznerListPrimaryIpActions',
    'type' => 'read',
    'name' => 'List Actions for a Primary IP',
    'description' => 'Returns all [Actions](#tag/actions) for a [Primary IP](#tag/primary-ips). Use the provided URI parameters to modify the result.',
    'operation_id' => 'list_primary_ip_actions',
    'method' => 'GET',
    'path' => '/primary_ips/{id}/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Primary IP.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_primary_ip_action' =>
  array (
    'slug' => 'hetzner_get_primary_ip_action',
    'class' => 'HetznerGetPrimaryIpAction',
    'type' => 'read',
    'name' => 'Get an Action for a Primary IP',
    'description' => '**Deprecated**: This operation is deprecated, see our [changelog](https://docs.hetzner.cloud/changelog#2026-04-30-deprecate-get-resource-action-endpoints) for more details. Returns a specific [Action](#tag/actions) for a [Primary IP](#tag/primary-ips).',
    'operation_id' => 'get_primary_ip_action',
    'method' => 'GET',
    'path' => '/primary_ips/{id}/actions/{action_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Primary IP.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'action_id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_primary_ip' =>
  array (
    'slug' => 'hetzner_get_primary_ip',
    'class' => 'HetznerGetPrimaryIp',
    'type' => 'read',
    'name' => 'Get a Primary IP',
    'description' => 'Returns a [Primary IP](#tag/primary-ips).',
    'operation_id' => 'get_primary_ip',
    'method' => 'GET',
    'path' => '/primary_ips/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Primary IP.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_update_primary_ip' =>
  array (
    'slug' => 'hetzner_update_primary_ip',
    'class' => 'HetznerUpdatePrimaryIp',
    'type' => 'write',
    'name' => 'Update a Primary IP',
    'description' => 'Update a [Primary IP](#tag/primary-ips). If another change is concurrently performed on this [Primary IP](#tag/primary-ips), a error response with code `conflict` will be returned.',
    'operation_id' => 'update_primary_ip',
    'method' => 'PUT',
    'path' => '/primary_ips/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Primary IP.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_delete_primary_ip' =>
  array (
    'slug' => 'hetzner_delete_primary_ip',
    'class' => 'HetznerDeletePrimaryIp',
    'type' => 'write',
    'name' => 'Delete a Primary IP',
    'description' => 'Deletes a [Primary IP](#tag/primary-ips). The [Server](#tag/servers) must be powered off (status `off`) in order for this operation to succeed. If assigned to a [Server](#tag/servers) the [Primary IP](#tag/primary-ips) will be unassigned automatically until 1 May 2026. After this date, the [Primary IP](#tag/primary-ips) needs to be unassigned before it can be deleted. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `must_be_unassigned` | Error when IP is still assigned to a Resource. This error will appear as of 1 May 2026. |',
    'operation_id' => 'delete_primary_ip',
    'method' => 'DELETE',
    'path' => '/primary_ips/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Primary IP.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_assign_primary_ip' =>
  array (
    'slug' => 'hetzner_assign_primary_ip',
    'class' => 'HetznerAssignPrimaryIp',
    'type' => 'write',
    'name' => 'Assign a Primary IP to a resource',
    'description' => 'Assign a [Primary IP](#tag/primary-ips) to a resource. A [Server](#tag/servers) can only have one [Primary IP](#tag/primary-ips) of type `ipv4` and one of type `ipv6` assigned. If you need more IPs use [Floating IPs](#tag/floating-ips). A [Server](#tag/servers) must be powered off (status `off`) in order for this operation to succeed. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `server_not_stopped` | The [Server](#tag/servers) is running, but needs to be powered off | | `422` | `primary_ip_already_assigned` | [Primary IP](#tag/primary-ips) is already assigned to a different [Server](#tag/servers) | | `422` | `server_has_ipv4` | The [Server](#tag/servers) already has an IPv4 address | | `422` | `server_has_ipv6` | The [Server](#tag/servers) already has an IPv6 address |',
    'operation_id' => 'assign_primary_ip',
    'method' => 'POST',
    'path' => '/primary_ips/{id}/actions/assign',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Primary IP.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_change_primary_ip_dns_ptr' =>
  array (
    'slug' => 'hetzner_change_primary_ip_dns_ptr',
    'class' => 'HetznerChangePrimaryIpDnsPtr',
    'type' => 'write',
    'name' => 'Change reverse DNS records for a Primary IP',
    'description' => 'Change the reverse DNS records for this [Primary IP](#tag/primary-ips). Allows to modify the PTR records set for the IP address.',
    'operation_id' => 'change_primary_ip_dns_ptr',
    'method' => 'POST',
    'path' => '/primary_ips/{id}/actions/change_dns_ptr',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Primary IP.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'The `ip` attributes specifies for which IP address the record is set. For IPv4 addresses this must be the exact address of the [Primary IP](#tag/primary-ips). For IPv6 addresses this must be a single address within the `/64` subnet of the [Primary IP](#tag/primary-ips). The `dns_ptr` attribute specifies the hostname used for the IP address. Must be a fully qualified domain name (FQDN) without trailing dot. For IPv6 [Primary IPs](#tag/primary-ips) up to 100 entries can be created.',
    ),
  ),
  'hetzner_change_primary_ip_protection' =>
  array (
    'slug' => 'hetzner_change_primary_ip_protection',
    'class' => 'HetznerChangePrimaryIpProtection',
    'type' => 'write',
    'name' => 'Change Primary IP Protection',
    'description' => 'Changes the protection configuration of a [Primary IP](#tag/primary-ips). A [Primary IPs](#tag/primary-ips) deletion protection can only be enabled if its `auto_delete` property is set to `false`.',
    'operation_id' => 'change_primary_ip_protection',
    'method' => 'POST',
    'path' => '/primary_ips/{id}/actions/change_protection',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Primary IP.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_unassign_primary_ip' =>
  array (
    'slug' => 'hetzner_unassign_primary_ip',
    'class' => 'HetznerUnassignPrimaryIp',
    'type' => 'write',
    'name' => 'Unassign a Primary IP from a resource',
    'description' => 'Unassign a [Primary IP](#tag/primary-ips) from a resource. A [Server](#tag/servers) must be powered off (status `off`) in order for this operation to succeed. A [Server](#tag/servers) requires at least one network interface (public or private) to be powered on. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `server_not_stopped` | The [Server](#tag/servers) is running, but needs to be powered off | | `422` | `server_is_load_balancer_target` | The [Server](#tag/servers) IPv4 address is a loadbalancer target |',
    'operation_id' => 'unassign_primary_ip',
    'method' => 'POST',
    'path' => '/primary_ips/{id}/actions/unassign',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Primary IP.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_server_types' =>
  array (
    'slug' => 'hetzner_list_server_types',
    'class' => 'HetznerListServerTypes',
    'type' => 'read',
    'name' => 'List Server Types',
    'description' => 'Gets all Server type objects.',
    'operation_id' => 'list_server_types',
    'method' => 'GET',
    'path' => '/server_types',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their name. The response will only contain the resources matching exactly the specified name.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      2 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_server_type' =>
  array (
    'slug' => 'hetzner_get_server_type',
    'class' => 'HetznerGetServerType',
    'type' => 'read',
    'name' => 'Get a Server Type',
    'description' => 'Gets a specific Server type object.',
    'operation_id' => 'get_server_type',
    'method' => 'GET',
    'path' => '/server_types/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server Type.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_servers' =>
  array (
    'slug' => 'hetzner_list_servers',
    'class' => 'HetznerListServers',
    'type' => 'read',
    'name' => 'List Servers',
    'description' => 'Returns all existing Server objects.',
    'operation_id' => 'list_servers',
    'method' => 'GET',
    'path' => '/servers',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their name. The response will only contain the resources matching exactly the specified name.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'label_selector',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by labels. The response will only contain resources matching the label selector. For more information, see "[Label Selector](#description/label-selector)".',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort resources by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by status. May be used multiple times. The response will only contain the resources with the specified status.',
        'schema_type' => 'array',
      ),
      4 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      5 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_create_server' =>
  array (
    'slug' => 'hetzner_create_server',
    'class' => 'HetznerCreateServer',
    'type' => 'write',
    'name' => 'Create a Server',
    'description' => 'Creates a new Server. Returns preliminary information about the Server as well as an Action that covers progress of creation. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `412` | `primary_ip_version_mismatch` | The specified Primary IP has the wrong IP Version | | `422` | `placement_error` | An error during the placement occurred | | `422` | `primary_ip_assigned` | The specified Primary IP is already assigned to a server | | `422` | `primary_ip_datacenter_mismatch` | he specified Primary IP is in a different datacenter |',
    'operation_id' => 'create_server',
    'method' => 'POST',
    'path' => '/servers',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Please note that Server names must be unique per Project and valid hostnames as per RFC 1123 (i.e. may only contain letters, digits, periods, and dashes). For `server_type` you can either use the ID as listed in `/server_types` or its name. For `image` you can either use the ID as listed in `/images` or its name. If you want to create the Server in a Location, you must set `location` to the ID or name as listed in `/locations`. Some properties like `start_after_create` or `automount` will trigger Actions after the Server is created. Those Actions are listed in the `next_actions` field in the response. For accessing your Server we strongly recommend to use SSH keys by passing the respective key IDs in `ssh_keys`. If you do not specify any `ssh_keys` we will generate a root password for you and return it in the response. Please note that provided user-data is stored in our systems. While we take measures to protect it we highly recommend that you don\'t use it to store passwords or other sensitive information.',
    ),
  ),
  'hetzner_list_servers_actions' =>
  array (
    'slug' => 'hetzner_list_servers_actions',
    'class' => 'HetznerListServersActions',
    'type' => 'read',
    'name' => 'List Actions',
    'description' => 'Returns all Action objects. You can `sort` the results by using the sort URI parameter, and filter them with the `status` and `id` parameter.',
    'operation_id' => 'list_servers_actions',
    'method' => 'GET',
    'path' => '/servers/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by ID. May be used multiple times. The response will only contain actions matching the specified IDs.',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_servers_action' =>
  array (
    'slug' => 'hetzner_get_servers_action',
    'class' => 'HetznerGetServersAction',
    'type' => 'read',
    'name' => 'Get an Action',
    'description' => 'Returns a specific Action object.',
    'operation_id' => 'get_servers_action',
    'method' => 'GET',
    'path' => '/servers/actions/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_server' =>
  array (
    'slug' => 'hetzner_get_server',
    'class' => 'HetznerGetServer',
    'type' => 'read',
    'name' => 'Get a Server',
    'description' => 'Returns a specific Server object. The Server must exist inside the Project.',
    'operation_id' => 'get_server',
    'method' => 'GET',
    'path' => '/servers/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_update_server' =>
  array (
    'slug' => 'hetzner_update_server',
    'class' => 'HetznerUpdateServer',
    'type' => 'write',
    'name' => 'Update a Server',
    'description' => 'Updates a Server. You can update a Server\'s name and a Server\'s labels. Please note that Server names must be unique per Project and valid hostnames as per RFC 1123 (i.e. may only contain letters, digits, periods, and dashes).',
    'operation_id' => 'update_server',
    'method' => 'PUT',
    'path' => '/servers/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_delete_server' =>
  array (
    'slug' => 'hetzner_delete_server',
    'class' => 'HetznerDeleteServer',
    'type' => 'write',
    'name' => 'Delete a Server',
    'description' => 'Deletes a Server. This immediately removes the Server from your account, and it is no longer accessible. Any resources attached to the server (like Volumes, Primary IPs, Floating IPs, Firewalls, Placement Groups) are detached while the server is deleted.',
    'operation_id' => 'delete_server',
    'method' => 'DELETE',
    'path' => '/servers/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_server_actions' =>
  array (
    'slug' => 'hetzner_list_server_actions',
    'class' => 'HetznerListServerActions',
    'type' => 'read',
    'name' => 'List Actions for a Server',
    'description' => 'Returns all Action objects for a Server. You can `sort` the results by using the sort URI parameter, and filter them with the `status` parameter.',
    'operation_id' => 'list_server_actions',
    'method' => 'GET',
    'path' => '/servers/{id}/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_add_server_to_placement_group' =>
  array (
    'slug' => 'hetzner_add_server_to_placement_group',
    'class' => 'HetznerAddServerToPlacementGroup',
    'type' => 'write',
    'name' => 'Add a Server to a Placement Group',
    'description' => 'Adds a Server to a Placement Group. Server must be powered off for this command to succeed. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `server_not_stopped` | The action requires a stopped server | | `422` | `already_in_placement_group` | The server is already part of a placement group |',
    'operation_id' => 'add_server_to_placement_group',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/add_to_placement_group',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_attach_server_iso' =>
  array (
    'slug' => 'hetzner_attach_server_iso',
    'class' => 'HetznerAttachServerIso',
    'type' => 'write',
    'name' => 'Attach an ISO to a Server',
    'description' => 'Attaches an ISO to a Server. The Server will immediately see it as a new disk. An already attached ISO will automatically be detached before the new ISO is attached. Servers with attached ISOs have a modified boot order: They will try to boot from the ISO first before falling back to hard disk.',
    'operation_id' => 'attach_server_iso',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/attach_iso',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_attach_server_to_network' =>
  array (
    'slug' => 'hetzner_attach_server_to_network',
    'class' => 'HetznerAttachServerToNetwork',
    'type' => 'write',
    'name' => 'Attach a Server to a Network',
    'description' => 'Attaches a Server to a network. This will complement the fixed public Server interface by adding an additional ethernet interface to the Server which is connected to the specified network. The Server will get an IP auto assigned from a subnet of type `server` in the same `network_zone`. Using the `alias_ips` attribute you can also define one or more additional IPs to the Servers. Please note that you will have to configure these IPs by hand on your Server since only the primary IP will be given out by DHCP. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `server_already_attached` | The server is already attached to the network | | `422` | `ip_not_available` | The provided Network IP is not available | | `422` | `no_subnet_available` | No Subnet or IP is available for the Server within the network | | `422` | `networks_overlap` | The network IP range overlaps with one of the server networks |',
    'operation_id' => 'attach_server_to_network',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/attach_to_network',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_change_server_alias_ips' =>
  array (
    'slug' => 'hetzner_change_server_alias_ips',
    'class' => 'HetznerChangeServerAliasIps',
    'type' => 'write',
    'name' => 'Change alias IPs of a Network',
    'description' => 'Changes the alias IPs of an already attached Network. Note that the existing aliases for the specified Network will be replaced with these provided in the request body. So if you want to add an alias IP, you have to provide the existing ones from the Network plus the new alias IP in the request body.',
    'operation_id' => 'change_server_alias_ips',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/change_alias_ips',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_change_server_dns_ptr' =>
  array (
    'slug' => 'hetzner_change_server_dns_ptr',
    'class' => 'HetznerChangeServerDnsPtr',
    'type' => 'write',
    'name' => 'Change reverse DNS entry for this Server',
    'description' => 'Changes the hostname that will appear when getting the hostname belonging to the primary IPs (IPv4 and IPv6) of this Server. Floating IPs assigned to the Server are not affected by this.',
    'operation_id' => 'change_server_dns_ptr',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/change_dns_ptr',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Select the IP address for which to change the DNS entry by passing `ip`. It can be either IPv4 or IPv6. The target hostname is set by passing `dns_ptr`, which must be a fully qualified domain name (FQDN) without trailing dot.',
    ),
  ),
  'hetzner_change_server_protection' =>
  array (
    'slug' => 'hetzner_change_server_protection',
    'class' => 'HetznerChangeServerProtection',
    'type' => 'write',
    'name' => 'Change Server Protection',
    'description' => 'Changes the protection configuration of the Server.',
    'operation_id' => 'change_server_protection',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/change_protection',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_change_server_type' =>
  array (
    'slug' => 'hetzner_change_server_type',
    'class' => 'HetznerChangeServerType',
    'type' => 'write',
    'name' => 'Change the Type of a Server',
    'description' => 'Changes the type (Cores, RAM and disk sizes) of a Server. Server must be powered off for this command to succeed. This copies the content of its disk, and starts it again. You can only migrate to Server types with the same `storage_type` and equal or bigger disks. Shrinking disks is not possible as it might destroy data. If the disk gets upgraded, the Server type can not be downgraded any more. If you plan to downgrade the Server type, set `upgrade_disk` to `false`. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `invalid_server_type` | The server type does not fit for the given server or is deprecated | | `422` | `server_not_stopped` | The action requires a stopped server |',
    'operation_id' => 'change_server_type',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/change_type',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_create_server_image' =>
  array (
    'slug' => 'hetzner_create_server_image',
    'class' => 'HetznerCreateServerImage',
    'type' => 'write',
    'name' => 'Create Image from a Server',
    'description' => 'Creates an Image (snapshot) from a Server by copying the contents of its disks. This creates a snapshot of the current state of the disk and copies it into an Image. If the Server is currently running you must make sure that its disk content is consistent. Otherwise, the created Image may not be readable. To make sure disk content is consistent, we recommend to shut down the Server prior to creating an Image. You can either create a `backup` Image that is bound to the Server and therefore will be deleted when the Server is deleted, or you can create a `snapshot` Image which is completely independent of the Server it was created from and will survive Server deletion. Backup Images are only available when the backup option is enabled for the Server. Snapshot Images are billed on a per GB basis.',
    'operation_id' => 'create_server_image',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/create_image',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_detach_server_from_network' =>
  array (
    'slug' => 'hetzner_detach_server_from_network',
    'class' => 'HetznerDetachServerFromNetwork',
    'type' => 'write',
    'name' => 'Detach a Server from a Network',
    'description' => 'Detaches a Server from a network. The interface for this network will vanish.',
    'operation_id' => 'detach_server_from_network',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/detach_from_network',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_detach_server_iso' =>
  array (
    'slug' => 'hetzner_detach_server_iso',
    'class' => 'HetznerDetachServerIso',
    'type' => 'write',
    'name' => 'Detach an ISO from a Server',
    'description' => 'Detaches an ISO from a Server. In case no ISO Image is attached to the Server, the status of the returned Action is immediately set to `success`.',
    'operation_id' => 'detach_server_iso',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/detach_iso',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_disable_server_backup' =>
  array (
    'slug' => 'hetzner_disable_server_backup',
    'class' => 'HetznerDisableServerBackup',
    'type' => 'write',
    'name' => 'Disable Backups for a Server',
    'description' => 'Disables the automatic backup option and deletes all existing Backups for a Server. No more additional charges for backups will be made. Caution: This immediately removes all existing backups for the Server!',
    'operation_id' => 'disable_server_backup',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/disable_backup',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_disable_server_rescue' =>
  array (
    'slug' => 'hetzner_disable_server_rescue',
    'class' => 'HetznerDisableServerRescue',
    'type' => 'write',
    'name' => 'Disable Rescue Mode for a Server',
    'description' => 'Disables the Hetzner Rescue System for a Server. This makes a Server start from its disks on next reboot. Rescue Mode is automatically disabled when you first boot into it or if you do not use it for 60 minutes. Disabling rescue mode will not reboot your Server - you will have to do this yourself.',
    'operation_id' => 'disable_server_rescue',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/disable_rescue',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_enable_server_backup' =>
  array (
    'slug' => 'hetzner_enable_server_backup',
    'class' => 'HetznerEnableServerBackup',
    'type' => 'write',
    'name' => 'Enable and Configure Backups for a Server',
    'description' => 'Enables and configures the automatic daily backup option for the Server. Enabling automatic backups will increase the price of the Server by 20%. In return, you will get seven slots where Images of type backup can be stored. Backups are automatically created daily.',
    'operation_id' => 'enable_server_backup',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/enable_backup',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_enable_server_rescue' =>
  array (
    'slug' => 'hetzner_enable_server_rescue',
    'class' => 'HetznerEnableServerRescue',
    'type' => 'write',
    'name' => 'Enable Rescue Mode for a Server',
    'description' => 'Enable the Hetzner Rescue System for this Server. The next time a Server with enabled rescue mode boots it will start a special minimal Linux distribution designed for repair and reinstall. In case a Server cannot boot on its own you can use this to access a Server\'s disks. Rescue Mode is automatically disabled when you first boot into it or if you do not use it for 60 minutes. Enabling rescue mode will not [reboot](https://docs.hetzner.cloud/#server-actions-soft-reboot-a-server) your Server - you will have to do this yourself.',
    'operation_id' => 'enable_server_rescue',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/enable_rescue',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_poweroff_server' =>
  array (
    'slug' => 'hetzner_poweroff_server',
    'class' => 'HetznerPoweroffServer',
    'type' => 'write',
    'name' => 'Power off a Server',
    'description' => 'Cuts power to the Server. This forcefully stops it without giving the Server operating system time to gracefully stop. May lead to data loss, equivalent to pulling the power cord. Power off should only be used when shutdown does not work.',
    'operation_id' => 'poweroff_server',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/poweroff',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_poweron_server' =>
  array (
    'slug' => 'hetzner_poweron_server',
    'class' => 'HetznerPoweronServer',
    'type' => 'write',
    'name' => 'Power on a Server',
    'description' => 'Starts a Server by turning its power on.',
    'operation_id' => 'poweron_server',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/poweron',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_reboot_server' =>
  array (
    'slug' => 'hetzner_reboot_server',
    'class' => 'HetznerRebootServer',
    'type' => 'write',
    'name' => 'Soft-reboot a Server',
    'description' => 'Reboots a Server gracefully by sending an ACPI request. The Server operating system must support ACPI and react to the request, otherwise the Server will not reboot.',
    'operation_id' => 'reboot_server',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/reboot',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_rebuild_server' =>
  array (
    'slug' => 'hetzner_rebuild_server',
    'class' => 'HetznerRebuildServer',
    'type' => 'write',
    'name' => 'Rebuild a Server from an Image',
    'description' => 'Rebuilds a Server overwriting its disk with the content of an Image, thereby **destroying all data** on the target Server The Image can either be one you have created earlier (`backup` or `snapshot` Image) or it can be a completely fresh `system` Image provided by us. You can get a list of all available Images with `GET /images`. Your Server will automatically be powered off before the rebuild command executes.',
    'operation_id' => 'rebuild_server',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/rebuild',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'To select which Image to rebuild from you can either pass an ID or a name as the `image` argument. Passing a name only works for `system` Images since the other Image types do not have a name set.',
    ),
  ),
  'hetzner_remove_server_from_placement_group' =>
  array (
    'slug' => 'hetzner_remove_server_from_placement_group',
    'class' => 'HetznerRemoveServerFromPlacementGroup',
    'type' => 'write',
    'name' => 'Remove from Placement Group',
    'description' => 'Removes a Server from a Placement Group.',
    'operation_id' => 'remove_server_from_placement_group',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/remove_from_placement_group',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_request_server_console' =>
  array (
    'slug' => 'hetzner_request_server_console',
    'class' => 'HetznerRequestServerConsole',
    'type' => 'write',
    'name' => 'Request Console for a Server',
    'description' => 'Requests credentials for remote access via VNC over websocket to keyboard, monitor, and mouse for a Server. The provided URL is valid for 1 minute, after this period a new url needs to be created to connect to the Server. How long the connection is open after the initial connect is not subject to this timeout.',
    'operation_id' => 'request_server_console',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/request_console',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_reset_server' =>
  array (
    'slug' => 'hetzner_reset_server',
    'class' => 'HetznerResetServer',
    'type' => 'write',
    'name' => 'Reset a Server',
    'description' => 'Cuts power to a Server and starts it again. This forcefully stops it without giving the Server operating system time to gracefully stop. This may lead to data loss, it\'s equivalent to pulling the power cord and plugging it in again. Reset should only be used when reboot does not work.',
    'operation_id' => 'reset_server',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/reset',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_reset_server_password' =>
  array (
    'slug' => 'hetzner_reset_server_password',
    'class' => 'HetznerResetServerPassword',
    'type' => 'write',
    'name' => 'Reset root Password of a Server',
    'description' => 'Resets the root password. Only works for Linux systems that are running the qemu guest agent. Server must be powered on (status `running`) in order for this operation to succeed. This will generate a new password for this Server and return it. If this does not succeed you can use the rescue system to netboot the Server and manually change your Server password by hand.',
    'operation_id' => 'reset_server_password',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/reset_password',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_shutdown_server' =>
  array (
    'slug' => 'hetzner_shutdown_server',
    'class' => 'HetznerShutdownServer',
    'type' => 'write',
    'name' => 'Shutdown a Server',
    'description' => 'Shuts down a Server gracefully by sending an ACPI shutdown request. The Server operating system must support ACPI and react to the request, otherwise the Server will not shut down. Please note that the `action` status in this case only reflects whether the action was sent to the server. It does not mean that the server actually shut down successfully. If you need to ensure that the server is off, use the `poweroff` action.',
    'operation_id' => 'shutdown_server',
    'method' => 'POST',
    'path' => '/servers/{id}/actions/shutdown',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_server_action' =>
  array (
    'slug' => 'hetzner_get_server_action',
    'class' => 'HetznerGetServerAction',
    'type' => 'read',
    'name' => 'Get an Action for a Server',
    'description' => '**Deprecated**: This operation is deprecated, see our [changelog](https://docs.hetzner.cloud/changelog#2026-04-30-deprecate-get-resource-action-endpoints) for more details. Returns a specific Action object for a Server.',
    'operation_id' => 'get_server_action',
    'method' => 'GET',
    'path' => '/servers/{id}/actions/{action_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'action_id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_server_metrics' =>
  array (
    'slug' => 'hetzner_get_server_metrics',
    'class' => 'HetznerGetServerMetrics',
    'type' => 'read',
    'name' => 'Get Metrics for a Server',
    'description' => 'Get Metrics for specified Server. You must specify the type of metric to get: cpu, disk or network. You can also specify more than one type by comma separation, e.g. cpu,disk. Depending on the type you will get different time series data | Type | Timeseries | Unit | Description | |---------|-------------------------|-----------|------------------------------------------------------| | cpu | cpu | percent | Percent CPU usage | | disk | disk.0.iops.read | iop/s | Number of read IO operations per second | | | disk.0.iops.write | iop/s | Number of write IO operations per second | | | disk.0.bandwidth.read | bytes/s | Bytes read per second | | | disk.0.bandwidth.write | bytes/s | Bytes written per second | | network | network.0.pps.in | packets/s | Public Network interface packets per second received | | | network.0.pps.out | packets/s | Public Network interface packets per second sent | | | network.0.bandwidth.in | bytes/s | Public Network interface bytes/s received | | | network.0.bandwidth.out | bytes/s | Public Network interface bytes/s sent | Metrics are available for the last 30 days only. If you do not provide the step argument we will automatically adjust it so that a maximum of 200 samples are returned. We limit the number of samples returned to a maximum of 500 and will adjust the step parameter accordingly.',
    'operation_id' => 'get_server_metrics',
    'method' => 'GET',
    'path' => '/servers/{id}/metrics',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Server.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => true,
        'description' => 'Type of metrics to get.',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'start',
        'in' => 'query',
        'required' => true,
        'description' => 'Start of period to get Metrics for (must be in [RFC3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) format).',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'end',
        'in' => 'query',
        'required' => true,
        'description' => 'End of period to get Metrics for (must be in [RFC3339](https://datatracker.ietf.org/doc/html/rfc3339#section-5.6) format).',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'step',
        'in' => 'query',
        'required' => false,
        'description' => 'Resolution of results in seconds.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_ssh_keys' =>
  array (
    'slug' => 'hetzner_list_ssh_keys',
    'class' => 'HetznerListSshKeys',
    'type' => 'read',
    'name' => 'List SSH keys',
    'description' => 'Returns all SSH key objects.',
    'operation_id' => 'list_ssh_keys',
    'method' => 'GET',
    'path' => '/ssh_keys',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort resources by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their name. The response will only contain the resources matching exactly the specified name.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'fingerprint',
        'in' => 'query',
        'required' => false,
        'description' => 'May be used to filter SSH keys by their fingerprint. The response will only contain the SSH key matching the specified fingerprint.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'label_selector',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by labels. The response will only contain resources matching the label selector. For more information, see "[Label Selector](#description/label-selector)".',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      5 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_create_ssh_key' =>
  array (
    'slug' => 'hetzner_create_ssh_key',
    'class' => 'HetznerCreateSshKey',
    'type' => 'write',
    'name' => 'Create an SSH key',
    'description' => 'Creates a new SSH key with the given `name` and `public_key`. Once an SSH key is created, it can be used in other calls such as creating Servers.',
    'operation_id' => 'create_ssh_key',
    'method' => 'POST',
    'path' => '/ssh_keys',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_get_ssh_key' =>
  array (
    'slug' => 'hetzner_get_ssh_key',
    'class' => 'HetznerGetSshKey',
    'type' => 'read',
    'name' => 'Get a SSH key',
    'description' => 'Returns a specific SSH key object.',
    'operation_id' => 'get_ssh_key',
    'method' => 'GET',
    'path' => '/ssh_keys/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the SSH Key.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_update_ssh_key' =>
  array (
    'slug' => 'hetzner_update_ssh_key',
    'class' => 'HetznerUpdateSshKey',
    'type' => 'write',
    'name' => 'Update an SSH key',
    'description' => 'Updates an SSH key. You can update an SSH key name and an SSH key labels.',
    'operation_id' => 'update_ssh_key',
    'method' => 'PUT',
    'path' => '/ssh_keys/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the SSH Key.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_delete_ssh_key' =>
  array (
    'slug' => 'hetzner_delete_ssh_key',
    'class' => 'HetznerDeleteSshKey',
    'type' => 'write',
    'name' => 'Delete an SSH key',
    'description' => 'Deletes an SSH key. It cannot be used anymore.',
    'operation_id' => 'delete_ssh_key',
    'method' => 'DELETE',
    'path' => '/ssh_keys/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the SSH Key.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_volumes' =>
  array (
    'slug' => 'hetzner_list_volumes',
    'class' => 'HetznerListVolumes',
    'type' => 'read',
    'name' => 'List Volumes',
    'description' => 'Gets all existing Volumes that you have available.',
    'operation_id' => 'list_volumes',
    'method' => 'GET',
    'path' => '/volumes',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by status. May be used multiple times. The response will only contain the resources with the specified status.',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort resources by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their name. The response will only contain the resources matching exactly the specified name.',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'label_selector',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by labels. The response will only contain resources matching the label selector. For more information, see "[Label Selector](#description/label-selector)".',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      5 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_create_volume' =>
  array (
    'slug' => 'hetzner_create_volume',
    'class' => 'HetznerCreateVolume',
    'type' => 'write',
    'name' => 'Create a Volume',
    'description' => 'Creates a new Volume attached to a Server. If you want to create a Volume that is not attached to a Server, you need to provide the `location` key instead of `server`. This can be either the ID or the name of the Location this Volume will be created in. Note that a Volume can be attached to a Server only in the same Location as the Volume itself. Specifying the Server during Volume creation will automatically attach the Volume to that Server after it has been initialized. In that case, the `next_actions` key in the response is an array which contains a single `attach_volume` action. The minimum Volume size is 10GB and the maximum size is 10TB (10240GB). A volume\'s name can consist of alphanumeric characters, dashes, underscores, and dots, but has to start and end with an alphanumeric character. The total length is limited to 64 characters. Volume names must be unique per Project. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `no_space_left_in_location` | There is no volume space left in the given location |',
    'operation_id' => 'create_volume',
    'method' => 'POST',
    'path' => '/volumes',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_list_volumes_actions' =>
  array (
    'slug' => 'hetzner_list_volumes_actions',
    'class' => 'HetznerListVolumesActions',
    'type' => 'read',
    'name' => 'List Actions',
    'description' => 'Returns all Action objects. You can `sort` the results by using the sort URI parameter, and filter them with the `status` and `id` parameter.',
    'operation_id' => 'list_volumes_actions',
    'method' => 'GET',
    'path' => '/volumes/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by ID. May be used multiple times. The response will only contain actions matching the specified IDs.',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_volumes_action' =>
  array (
    'slug' => 'hetzner_get_volumes_action',
    'class' => 'HetznerGetVolumesAction',
    'type' => 'read',
    'name' => 'Get an Action',
    'description' => 'Returns a specific Action object.',
    'operation_id' => 'get_volumes_action',
    'method' => 'GET',
    'path' => '/volumes/actions/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_volume' =>
  array (
    'slug' => 'hetzner_get_volume',
    'class' => 'HetznerGetVolume',
    'type' => 'read',
    'name' => 'Get a Volume',
    'description' => 'Gets a specific Volume object.',
    'operation_id' => 'get_volume',
    'method' => 'GET',
    'path' => '/volumes/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Volume.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_update_volume' =>
  array (
    'slug' => 'hetzner_update_volume',
    'class' => 'HetznerUpdateVolume',
    'type' => 'write',
    'name' => 'Update a Volume',
    'description' => 'Updates the Volume properties.',
    'operation_id' => 'update_volume',
    'method' => 'PUT',
    'path' => '/volumes/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Volume.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_delete_volume' =>
  array (
    'slug' => 'hetzner_delete_volume',
    'class' => 'HetznerDeleteVolume',
    'type' => 'write',
    'name' => 'Delete a Volume',
    'description' => 'Deletes a volume. All Volume data is irreversibly destroyed. The Volume must not be attached to a Server and it must not have delete protection enabled.',
    'operation_id' => 'delete_volume',
    'method' => 'DELETE',
    'path' => '/volumes/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Volume.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_volume_actions' =>
  array (
    'slug' => 'hetzner_list_volume_actions',
    'class' => 'HetznerListVolumeActions',
    'type' => 'read',
    'name' => 'List Actions for a Volume',
    'description' => 'Returns all Action objects for a Volume. You can `sort` the results by using the sort URI parameter, and filter them with the `status` parameter.',
    'operation_id' => 'list_volume_actions',
    'method' => 'GET',
    'path' => '/volumes/{id}/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Volume.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_attach_volume' =>
  array (
    'slug' => 'hetzner_attach_volume',
    'class' => 'HetznerAttachVolume',
    'type' => 'write',
    'name' => 'Attach Volume to a Server',
    'description' => 'Attaches a Volume to a Server. Works only if the Server is in the same Location as the Volume.',
    'operation_id' => 'attach_volume',
    'method' => 'POST',
    'path' => '/volumes/{id}/actions/attach',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Volume.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_change_volume_protection' =>
  array (
    'slug' => 'hetzner_change_volume_protection',
    'class' => 'HetznerChangeVolumeProtection',
    'type' => 'write',
    'name' => 'Change Volume Protection',
    'description' => 'Changes the protection configuration of a Volume.',
    'operation_id' => 'change_volume_protection',
    'method' => 'POST',
    'path' => '/volumes/{id}/actions/change_protection',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Volume.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_detach_volume' =>
  array (
    'slug' => 'hetzner_detach_volume',
    'class' => 'HetznerDetachVolume',
    'type' => 'write',
    'name' => 'Detach Volume',
    'description' => 'Detaches a Volume from the Server it\'s attached to. You may attach it to a Server again at a later time.',
    'operation_id' => 'detach_volume',
    'method' => 'POST',
    'path' => '/volumes/{id}/actions/detach',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Volume.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_resize_volume' =>
  array (
    'slug' => 'hetzner_resize_volume',
    'class' => 'HetznerResizeVolume',
    'type' => 'write',
    'name' => 'Resize Volume',
    'description' => 'Changes the size of a Volume. Note that downsizing a Volume is not possible.',
    'operation_id' => 'resize_volume',
    'method' => 'POST',
    'path' => '/volumes/{id}/actions/resize',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Volume.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_get_volume_action' =>
  array (
    'slug' => 'hetzner_get_volume_action',
    'class' => 'HetznerGetVolumeAction',
    'type' => 'read',
    'name' => 'Get an Action for a Volume',
    'description' => '**Deprecated**: This operation is deprecated, see our [changelog](https://docs.hetzner.cloud/changelog#2026-04-30-deprecate-get-resource-action-endpoints) for more details. Returns a specific Action for a Volume.',
    'operation_id' => 'get_volume_action',
    'method' => 'GET',
    'path' => '/volumes/{id}/actions/{action_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Volume.',
        'schema_type' => 'integer',
      ),
      1 =>
      array (
        'name' => 'action_id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_zones' =>
  array (
    'slug' => 'hetzner_list_zones',
    'class' => 'HetznerListZones',
    'type' => 'read',
    'name' => 'List Zones',
    'description' => 'Returns all [Zones](#tag/zones). Use the provided URI parameters to modify the result.',
    'operation_id' => 'list_zones',
    'method' => 'GET',
    'path' => '/zones',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their name. The response will only contain the resources matching exactly the specified name.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'mode',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their mode. The response will only contain the resources matching exactly the specified mode.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'label_selector',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by labels. The response will only contain resources matching the label selector. For more information, see "[Label Selector](#description/label-selector)".',
        'schema_type' => 'string',
      ),
      3 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort resources by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      4 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      5 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_create_zone' =>
  array (
    'slug' => 'hetzner_create_zone',
    'class' => 'HetznerCreateZone',
    'type' => 'write',
    'name' => 'Create a Zone',
    'description' => 'Creates a [Zone](#tag/zones). A default `SOA` and three `NS` resource records with the assigned Hetzner nameservers are created automatically.',
    'operation_id' => 'create_zone',
    'method' => 'POST',
    'path' => '/zones',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_get_zone' =>
  array (
    'slug' => 'hetzner_get_zone',
    'class' => 'HetznerGetZone',
    'type' => 'read',
    'name' => 'Get a Zone',
    'description' => 'Returns a single [Zone](#tag/zones).',
    'operation_id' => 'get_zone',
    'method' => 'GET',
    'path' => '/zones/{id_or_name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_update_zone' =>
  array (
    'slug' => 'hetzner_update_zone',
    'class' => 'HetznerUpdateZone',
    'type' => 'write',
    'name' => 'Update a Zone',
    'description' => 'Updates a [Zone](#tag/zones). To modify resource record sets ([RRSets](#tag/zone-rrsets)), use the [RRSet Actions endpoints](#tag/zone-rrset-actions).',
    'operation_id' => 'update_zone',
    'method' => 'PUT',
    'path' => '/zones/{id_or_name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_delete_zone' =>
  array (
    'slug' => 'hetzner_delete_zone',
    'class' => 'HetznerDeleteZone',
    'type' => 'write',
    'name' => 'Delete a Zone',
    'description' => 'Deletes a [Zone](#tag/zones).',
    'operation_id' => 'delete_zone',
    'method' => 'DELETE',
    'path' => '/zones/{id_or_name}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_zone_zonefile' =>
  array (
    'slug' => 'hetzner_get_zone_zonefile',
    'class' => 'HetznerGetZoneZonefile',
    'type' => 'read',
    'name' => 'Export a Zone file',
    'description' => 'Returns a generated [Zone](#tag/zones) file in BIND (RFC [1034](https://datatracker.ietf.org/doc/html/rfc1034)/[1035](https://datatracker.ietf.org/doc/html/rfc1035)) format. Only applicable for [Zones](#tag/zones) in primary mode. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `incorrect_zone_mode` | This operation is not supported for this Zone\'s `mode`. |',
    'operation_id' => 'get_zone_zonefile',
    'method' => 'GET',
    'path' => '/zones/{id_or_name}/zonefile',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_zones_actions' =>
  array (
    'slug' => 'hetzner_list_zones_actions',
    'class' => 'HetznerListZonesActions',
    'type' => 'read',
    'name' => 'List Actions',
    'description' => 'Returns all [Zone](#tag/zones) [Actions](#tag/actions). Use the provided URI parameters to modify the result.',
    'operation_id' => 'list_zones_actions',
    'method' => 'GET',
    'path' => '/zones/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by ID. May be used multiple times. The response will only contain actions matching the specified IDs.',
        'schema_type' => 'array',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_zones_action' =>
  array (
    'slug' => 'hetzner_get_zones_action',
    'class' => 'HetznerGetZonesAction',
    'type' => 'read',
    'name' => 'Get an Action',
    'description' => 'Returns a specific [Action](#tag/actions).',
    'operation_id' => 'get_zones_action',
    'method' => 'GET',
    'path' => '/zones/actions/{id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_list_zone_actions' =>
  array (
    'slug' => 'hetzner_list_zone_actions',
    'class' => 'HetznerListZoneActions',
    'type' => 'read',
    'name' => 'List Actions for a Zone',
    'description' => 'Returns all [Actions](#tag/actions) for a [Zone](#tag/zones). Use the provided URI parameters to modify the result.',
    'operation_id' => 'list_zone_actions',
    'method' => 'GET',
    'path' => '/zones/{id_or_name}/actions',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort actions by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      2 =>
      array (
        'name' => 'status',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter the actions by status. May be used multiple times. The response will only contain actions matching the specified statuses.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      4 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_get_zone_action' =>
  array (
    'slug' => 'hetzner_get_zone_action',
    'class' => 'HetznerGetZoneAction',
    'type' => 'read',
    'name' => 'Get an Action for a Zone',
    'description' => '**Deprecated**: This operation is deprecated, see our [changelog](https://docs.hetzner.cloud/changelog#2026-04-30-deprecate-get-resource-action-endpoints) for more details. Returns a specific [Action](#tag/actions) for a [Zone](#tag/zones).',
    'operation_id' => 'get_zone_action',
    'method' => 'GET',
    'path' => '/zones/{id_or_name}/actions/{action_id}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'action_id',
        'in' => 'path',
        'required' => true,
        'description' => 'ID of the Action.',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_change_zone_primary_nameservers' =>
  array (
    'slug' => 'hetzner_change_zone_primary_nameservers',
    'class' => 'HetznerChangeZonePrimaryNameservers',
    'type' => 'write',
    'name' => 'Change a Zone\'s Primary Nameservers',
    'description' => 'Overwrites the primary nameservers of a [Zone](#tag/zones). Only applicable for [Zones](#tag/zones) in secondary mode. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `incorrect_zone_mode` | This operation is not supported for this Zone\'s `mode`. |',
    'operation_id' => 'change_zone_primary_nameservers',
    'method' => 'POST',
    'path' => '/zones/{id_or_name}/actions/change_primary_nameservers',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_change_zone_protection' =>
  array (
    'slug' => 'hetzner_change_zone_protection',
    'class' => 'HetznerChangeZoneProtection',
    'type' => 'write',
    'name' => 'Change a Zone\'s Protection',
    'description' => 'Changes the protection configuration of a [Zone](#tag/zones).',
    'operation_id' => 'change_zone_protection',
    'method' => 'POST',
    'path' => '/zones/{id_or_name}/actions/change_protection',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_change_zone_ttl' =>
  array (
    'slug' => 'hetzner_change_zone_ttl',
    'class' => 'HetznerChangeZoneTtl',
    'type' => 'write',
    'name' => 'Change a Zone\'s Default TTL',
    'description' => 'Changes the default Time To Live (TTL) of a [Zone](#tag/zones). This TTL is used for [RRSets](#tag/zone-rrsets) that do not explicitly define a TTL. Only applicable for [Zones](#tag/zones) in primary mode. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `incorrect_zone_mode` | This operation is not supported for this Zone\'s `mode`. |',
    'operation_id' => 'change_zone_ttl',
    'method' => 'POST',
    'path' => '/zones/{id_or_name}/actions/change_ttl',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_import_zone_zonefile' =>
  array (
    'slug' => 'hetzner_import_zone_zonefile',
    'class' => 'HetznerImportZoneZonefile',
    'type' => 'write',
    'name' => 'Import a Zone file',
    'description' => 'Imports a zone file, replacing all resource record sets ([RRSets](#tag/zone-rrsets)). The import will fail if existing [RRSet](#tag/zone-rrsets) are `change` protected. See [Zone file import](#tag/zones/zone-file-import) for more details. Only applicable for [Zones](#tag/zones) in primary mode. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `incorrect_zone_mode` | This operation is not supported for this Zone\'s `mode`. |',
    'operation_id' => 'import_zone_zonefile',
    'method' => 'POST',
    'path' => '/zones/{id_or_name}/actions/import_zonefile',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_list_zone_rrsets' =>
  array (
    'slug' => 'hetzner_list_zone_rrsets',
    'class' => 'HetznerListZoneRrsets',
    'type' => 'read',
    'name' => 'List RRSets',
    'description' => 'Returns all [RRSets](#tag/zone-rrsets) in the [Zone](#tag/zones). Use the provided URI parameters to modify the result. The maximum value for `per_page` on this endpoint is `100` instead of `50`. Only applicable for [Zones](#tag/zones) in primary mode. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `incorrect_zone_mode` | This operation is not supported for this Zone\'s `mode`. |',
    'operation_id' => 'list_zone_rrsets',
    'method' => 'GET',
    'path' => '/zones/{id_or_name}/rrsets',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their name. The response will only contain the resources matching exactly the specified name.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by their type. May be used multiple times. The response will only contain resources matching the specified types.',
        'schema_type' => 'array',
      ),
      3 =>
      array (
        'name' => 'label_selector',
        'in' => 'query',
        'required' => false,
        'description' => 'Filter resources by labels. The response will only contain resources matching the label selector. For more information, see "[Label Selector](#description/label-selector)".',
        'schema_type' => 'string',
      ),
      4 =>
      array (
        'name' => 'sort',
        'in' => 'query',
        'required' => false,
        'description' => 'Sort resources by field and direction. May be used multiple times. For more information, see "[Sorting](#description/sorting)".',
        'schema_type' => 'array',
      ),
      5 =>
      array (
        'name' => 'page',
        'in' => 'query',
        'required' => false,
        'description' => 'Page number to return. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
      6 =>
      array (
        'name' => 'per_page',
        'in' => 'query',
        'required' => false,
        'description' => 'Maximum number of entries returned per page. For more information, see "[Pagination](#description/pagination)".',
        'schema_type' => 'integer',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_create_zone_rrset' =>
  array (
    'slug' => 'hetzner_create_zone_rrset',
    'class' => 'HetznerCreateZoneRrset',
    'type' => 'write',
    'name' => 'Create an RRSet',
    'description' => 'Create an [RRSet](#tag/zone-rrsets) in the [Zone](#tag/zones). Only applicable for [Zones](#tag/zones) in primary mode. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `incorrect_zone_mode` | This operation is not supported for this Zone\'s `mode`. |',
    'operation_id' => 'create_zone_rrset',
    'method' => 'POST',
    'path' => '/zones/{id_or_name}/rrsets',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_get_zone_rrset' =>
  array (
    'slug' => 'hetzner_get_zone_rrset',
    'class' => 'HetznerGetZoneRrset',
    'type' => 'read',
    'name' => 'Get an RRSet',
    'description' => 'Returns a single [RRSet](#tag/zone-rrsets) from the [Zone](#tag/zones). Only applicable for [Zones](#tag/zones) in primary mode. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `incorrect_zone_mode` | This operation is not supported for this Zone\'s `mode`. |',
    'operation_id' => 'get_zone_rrset',
    'method' => 'GET',
    'path' => '/zones/{id_or_name}/rrsets/{rr_name}/{rr_type}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'rr_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Hetzner Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'rr_type',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Hetzner Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_update_zone_rrset' =>
  array (
    'slug' => 'hetzner_update_zone_rrset',
    'class' => 'HetznerUpdateZoneRrset',
    'type' => 'write',
    'name' => 'Update an RRSet',
    'description' => 'Updates an [RRSet](#tag/zone-rrsets) in the [Zone](#tag/zones). Only applicable for [Zones](#tag/zones) in primary mode. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `incorrect_zone_mode` | This operation is not supported for this Zone\'s `mode`. |',
    'operation_id' => 'update_zone_rrset',
    'method' => 'PUT',
    'path' => '/zones/{id_or_name}/rrsets/{rr_name}/{rr_type}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'rr_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Hetzner Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'rr_type',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Hetzner Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_delete_zone_rrset' =>
  array (
    'slug' => 'hetzner_delete_zone_rrset',
    'class' => 'HetznerDeleteZoneRrset',
    'type' => 'write',
    'name' => 'Delete an RRSet',
    'description' => 'Deletes an [RRSet](#tag/zone-rrsets) from the [Zone](#tag/zones). Only applicable for [Zones](#tag/zones) in primary mode. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `incorrect_zone_mode` | This operation is not supported for this Zone\'s `mode`. |',
    'operation_id' => 'delete_zone_rrset',
    'method' => 'DELETE',
    'path' => '/zones/{id_or_name}/rrsets/{rr_name}/{rr_type}',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'rr_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Hetzner Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'rr_type',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Hetzner Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' => NULL,
  ),
  'hetzner_change_zone_rrset_protection' =>
  array (
    'slug' => 'hetzner_change_zone_rrset_protection',
    'class' => 'HetznerChangeZoneRrsetProtection',
    'type' => 'write',
    'name' => 'Change an RRSet\'s Protection',
    'description' => 'Changes the protection of an [RRSet](#tag/zone-rrsets) in the [Zone](#tag/zones). Only applicable for [Zones](#tag/zones) in primary mode. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `incorrect_zone_mode` | This operation is not supported for this Zone\'s `mode`. |',
    'operation_id' => 'change_zone_rrset_protection',
    'method' => 'POST',
    'path' => '/zones/{id_or_name}/rrsets/{rr_name}/{rr_type}/actions/change_protection',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'rr_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Hetzner Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'rr_type',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Hetzner Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_change_zone_rrset_ttl' =>
  array (
    'slug' => 'hetzner_change_zone_rrset_ttl',
    'class' => 'HetznerChangeZoneRrsetTtl',
    'type' => 'write',
    'name' => 'Change an RRSet\'s TTL',
    'description' => 'Changes the Time To Live (TTL) of an [RRSet](#tag/zone-rrsets) in the [Zone](#tag/zones). Only applicable for [Zones](#tag/zones) in primary mode. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `incorrect_zone_mode` | This operation is not supported for this Zone\'s `mode`. |',
    'operation_id' => 'change_zone_rrset_ttl',
    'method' => 'POST',
    'path' => '/zones/{id_or_name}/rrsets/{rr_name}/{rr_type}/actions/change_ttl',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'rr_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Hetzner Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'rr_type',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Hetzner Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_set_zone_rrset_records' =>
  array (
    'slug' => 'hetzner_set_zone_rrset_records',
    'class' => 'HetznerSetZoneRrsetRecords',
    'type' => 'write',
    'name' => 'Set Records of an RRSet',
    'description' => 'Overwrites the resource records (RRs) of an existing [RRSet](#tag/zone-rrsets) in the [Zone](#tag/zones). Only applicable for [Zones](#tag/zones) in primary mode. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `incorrect_zone_mode` | This operation is not supported for this Zone\'s `mode`. |',
    'operation_id' => 'set_zone_rrset_records',
    'method' => 'POST',
    'path' => '/zones/{id_or_name}/rrsets/{rr_name}/{rr_type}/actions/set_records',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'rr_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Hetzner Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'rr_type',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Hetzner Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_add_zone_rrset_records' =>
  array (
    'slug' => 'hetzner_add_zone_rrset_records',
    'class' => 'HetznerAddZoneRrsetRecords',
    'type' => 'write',
    'name' => 'Add Records to an RRSet',
    'description' => 'Adds resource records (RRs) to an [RRSet](#tag/zone-rrsets) in the [Zone](#tag/zones). For convenience, the [RRSet](#tag/zone-rrsets) will be automatically created if it doesn\'t exist. Otherwise, the new records are appended to the existing [RRSet](#tag/zone-rrsets). Only applicable for [Zones](#tag/zones) in primary mode. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `incorrect_zone_mode` | This operation is not supported for this Zone\'s `mode`. |',
    'operation_id' => 'add_zone_rrset_records',
    'method' => 'POST',
    'path' => '/zones/{id_or_name}/rrsets/{rr_name}/{rr_type}/actions/add_records',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'rr_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Hetzner Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'rr_type',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Hetzner Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_remove_zone_rrset_records' =>
  array (
    'slug' => 'hetzner_remove_zone_rrset_records',
    'class' => 'HetznerRemoveZoneRrsetRecords',
    'type' => 'write',
    'name' => 'Remove Records from an RRSet',
    'description' => 'Removes resource records (RRs) from an existing [RRSet](#tag/zone-rrsets) in the [Zone](#tag/zones). For convenience, the [RRSet](#tag/zone-rrsets) will be automatically deleted if it doesn\'t contain any RRs afterwards. Only applicable for [Zones](#tag/zones) in primary mode. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `incorrect_zone_mode` | This operation is not supported for this Zone\'s `mode`. |',
    'operation_id' => 'remove_zone_rrset_records',
    'method' => 'POST',
    'path' => '/zones/{id_or_name}/rrsets/{rr_name}/{rr_type}/actions/remove_records',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'rr_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Hetzner Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'rr_type',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Hetzner Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
  'hetzner_update_zone_rrset_records' =>
  array (
    'slug' => 'hetzner_update_zone_rrset_records',
    'class' => 'HetznerUpdateZoneRrsetRecords',
    'type' => 'write',
    'name' => 'Update Records of an RRSet',
    'description' => 'Updates resource records\' (RRs) comments of an existing [RRSet](#tag/zone-rrsets) in the [Zone](#tag/zones). Only applicable for [Zones](#tag/zones) in primary mode. #### Operation specific errors | Status | Code | Description | | --- | --- | --- | | `422` | `incorrect_zone_mode` | This operation is not supported for this Zone\'s `mode`. |',
    'operation_id' => 'update_zone_rrset_records',
    'method' => 'POST',
    'path' => '/zones/{id_or_name}/rrsets/{rr_name}/{rr_type}/actions/update_records',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id_or_name',
        'in' => 'path',
        'required' => true,
        'description' => 'ID or Name of the Zone.',
        'schema_type' => 'string',
      ),
      1 =>
      array (
        'name' => 'rr_name',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Hetzner Cloud API operation.',
        'schema_type' => 'string',
      ),
      2 =>
      array (
        'name' => 'rr_type',
        'in' => 'path',
        'required' => true,
        'description' => 'Execute the Hetzner Cloud API operation.',
        'schema_type' => 'string',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Execute the Hetzner Cloud API operation.',
    ),
  ),
);
    }
}