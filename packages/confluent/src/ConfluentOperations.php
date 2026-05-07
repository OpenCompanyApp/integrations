<?php

namespace OpenCompany\Integrations\Confluent;

/**
 * Generated Confluent Cloud OpenAPI operation catalog.
 *
 * Metadata is extracted from Confluent's official Cloud API OpenAPI document
 * and is used by generated tools plus the shared service executor.
 */
class ConfluentOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return [
            'confluent_list_iam_v2_api_keys' => [
                'class' => 'ConfluentListIAMV2APIKeys',
                'method' => 'GET',
                'path' => '/iam/v2/api-keys',
                'operation_id' => 'listIamV2ApiKeys',
                'name' => 'List of API Keys',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all API keys. This can show all keys for a single owner across resources - Kafka clusters, or all keys for a single resource across owners. If no owner or resource filters are specified, returns all API Keys in the organization. You will only see the keys that are accessible to the account making the API request.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'spec.owner',
                        'argument_name' => 'spec_owner',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.owner.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.resource',
                        'argument_name' => 'spec_resource',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.resource.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'API Keys iam/v2'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_create_iam_v2_api_key' => [
                'class' => 'ConfluentCreateIAMV2APIKey',
                'method' => 'POST',
                'path' => '/iam/v2/api-keys',
                'operation_id' => 'createIamV2ApiKey',
                'name' => 'Create an API Key',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create an API key.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'API Keys iam/v2'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_get_iam_v2_api_key' => [
                'class' => 'ConfluentGetIAMV2APIKey',
                'method' => 'GET',
                'path' => '/iam/v2/api-keys/{id}',
                'operation_id' => 'getIamV2ApiKey',
                'name' => 'Read an API Key',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read an API key.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the API key.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'API Keys iam/v2'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_update_iam_v2_api_key' => [
                'class' => 'ConfluentUpdateIAMV2APIKey',
                'method' => 'PATCH',
                'path' => '/iam/v2/api-keys/{id}',
                'operation_id' => 'updateIamV2ApiKey',
                'name' => 'Update an API Key',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update an API key.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the API key.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'API Keys iam/v2'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_delete_iam_v2_api_key' => [
                'class' => 'ConfluentDeleteIAMV2APIKey',
                'method' => 'DELETE',
                'path' => '/iam/v2/api-keys/{id}',
                'operation_id' => 'deleteIamV2ApiKey',
                'name' => 'Delete an API Key',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete an API key.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the API key.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'API Keys iam/v2'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_list_environments' => [
                'class' => 'ConfluentListEnvironments',
                'method' => 'GET',
                'path' => '/org/v2/environments',
                'operation_id' => 'listOrgV2Environments',
                'name' => 'List of Environments',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all environments.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Environments org/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_org_v2_environment' => [
                'class' => 'ConfluentCreateOrgV2Environment',
                'method' => 'POST',
                'path' => '/org/v2/environments',
                'operation_id' => 'createOrgV2Environment',
                'name' => 'Create an Environment',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create an environment.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Environments org/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_org_v2_environment' => [
                'class' => 'ConfluentGetOrgV2Environment',
                'method' => 'GET',
                'path' => '/org/v2/environments/{id}',
                'operation_id' => 'getOrgV2Environment',
                'name' => 'Read an Environment',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read an environment.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Environments org/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_org_v2_environment' => [
                'class' => 'ConfluentUpdateOrgV2Environment',
                'method' => 'PATCH',
                'path' => '/org/v2/environments/{id}',
                'operation_id' => 'updateOrgV2Environment',
                'name' => 'Update an Environment',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update an environment.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Environments org/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_org_v2_environment' => [
                'class' => 'ConfluentDeleteOrgV2Environment',
                'method' => 'DELETE',
                'path' => '/org/v2/environments/{id}',
                'operation_id' => 'deleteOrgV2Environment',
                'name' => 'Delete an Environment',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete an environment. If successful, this request will also recursively delete all of the environment\'s associated resources, including all Kafka clusters, connectors, etc.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Environments org/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_org_v2_organizations' => [
                'class' => 'ConfluentListOrgV2Organizations',
                'method' => 'GET',
                'path' => '/org/v2/organizations',
                'operation_id' => 'listOrgV2Organizations',
                'name' => 'List of Organizations',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all organizations.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Organizations org/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_org_v2_organization' => [
                'class' => 'ConfluentGetOrgV2Organization',
                'method' => 'GET',
                'path' => '/org/v2/organizations/{id}',
                'operation_id' => 'getOrgV2Organization',
                'name' => 'Read an Organization',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read an organization.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Organizations org/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_org_v2_organization' => [
                'class' => 'ConfluentUpdateOrgV2Organization',
                'method' => 'PATCH',
                'path' => '/org/v2/organizations/{id}',
                'operation_id' => 'updateOrgV2Organization',
                'name' => 'Update an Organization',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update an organization.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Organizations org/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_iam_v2_users' => [
                'class' => 'ConfluentListIAMV2Users',
                'method' => 'GET',
                'path' => '/iam/v2/users',
                'operation_id' => 'listIamV2Users',
                'name' => 'List of Users',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all users.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Users iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_iam_v2_user' => [
                'class' => 'ConfluentGetIAMV2User',
                'method' => 'GET',
                'path' => '/iam/v2/users/{id}',
                'operation_id' => 'getIamV2User',
                'name' => 'Read a User',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a user.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the user.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Users iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_iam_v2_user' => [
                'class' => 'ConfluentUpdateIAMV2User',
                'method' => 'PATCH',
                'path' => '/iam/v2/users/{id}',
                'operation_id' => 'updateIamV2User',
                'name' => 'Update a User',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a user.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the user.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Users iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_iam_v2_user' => [
                'class' => 'ConfluentDeleteIAMV2User',
                'method' => 'DELETE',
                'path' => '/iam/v2/users/{id}',
                'operation_id' => 'deleteIamV2User',
                'name' => 'Delete a User',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a user. If successful, this request will also recursively delete all of the user\'s associated resources, including its cloud and cluster API keys.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the user.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Users iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_auth_type_iam_v2_user' => [
                'class' => 'ConfluentUpdateAuthTypeIAMV2User',
                'method' => 'PATCH',
                'path' => '/iam/v2/users/{id}/auth',
                'operation_id' => 'update_auth_typeIamV2User',
                'name' => 'Update Auth Type of a User',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Update the auth type of a user',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the user.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Users iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_iam_v2_service_accounts' => [
                'class' => 'ConfluentListIAMV2ServiceAccounts',
                'method' => 'GET',
                'path' => '/iam/v2/service-accounts',
                'operation_id' => 'listIamV2ServiceAccounts',
                'name' => 'List of Service Accounts',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all service accounts.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'display_name',
                        'argument_name' => 'display_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for displayname. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Service Accounts iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_iam_v2_service_account' => [
                'class' => 'ConfluentCreateIAMV2ServiceAccount',
                'method' => 'POST',
                'path' => '/iam/v2/service-accounts',
                'operation_id' => 'createIamV2ServiceAccount',
                'name' => 'Create a Service Account',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a service account.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'assigned_resource_owner',
                        'argument_name' => 'assigned_resource_owner',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The resourceid of the principal who will be assigned resource owner on the created service account. Principal can be group-mapping group-xxx, user u-xxx, service-account sa-xxx or identity-pool pool-xxx.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Service Accounts iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_iam_v2_service_account' => [
                'class' => 'ConfluentGetIAMV2ServiceAccount',
                'method' => 'GET',
                'path' => '/iam/v2/service-accounts/{id}',
                'operation_id' => 'getIamV2ServiceAccount',
                'name' => 'Read a Service Account',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a service account.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the service account.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Service Accounts iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_iam_v2_service_account' => [
                'class' => 'ConfluentUpdateIAMV2ServiceAccount',
                'method' => 'PATCH',
                'path' => '/iam/v2/service-accounts/{id}',
                'operation_id' => 'updateIamV2ServiceAccount',
                'name' => 'Update a Service Account',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a service account.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the service account.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Service Accounts iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_iam_v2_service_account' => [
                'class' => 'ConfluentDeleteIAMV2ServiceAccount',
                'method' => 'DELETE',
                'path' => '/iam/v2/service-accounts/{id}',
                'operation_id' => 'deleteIamV2ServiceAccount',
                'name' => 'Delete a Service Account',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a service account. If successful, this request will also recursively delete all of the service account\'s associated resources, including its cloud and cluster API keys.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the service account.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Service Accounts iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_iam_v2_invitations' => [
                'class' => 'ConfluentListIAMV2Invitations',
                'method' => 'GET',
                'path' => '/iam/v2/invitations',
                'operation_id' => 'listIamV2Invitations',
                'name' => 'List of Invitations',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all invitations.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'email',
                        'argument_name' => 'email',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for email.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'status',
                        'argument_name' => 'status',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for status.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'user',
                        'argument_name' => 'user',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for user.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'creator',
                        'argument_name' => 'creator',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for creator.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Invitations iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_iam_v2_invitation' => [
                'class' => 'ConfluentCreateIAMV2Invitation',
                'method' => 'POST',
                'path' => '/iam/v2/invitations',
                'operation_id' => 'createIamV2Invitation',
                'name' => 'Create an Invitation',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create an invitation. The newly invited user will not have any permissions. Give the user permission by assigning them to one or more roles by creating role bindingshttps://docs.confluent.io/cloud/current/api.htmltag/Role-Bindings-iamv2 for the created user.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Invitations iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_iam_v2_invitation' => [
                'class' => 'ConfluentGetIAMV2Invitation',
                'method' => 'GET',
                'path' => '/iam/v2/invitations/{id}',
                'operation_id' => 'getIamV2Invitation',
                'name' => 'Read an Invitation',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read an invitation.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the invitation.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Invitations iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_iam_v2_invitation' => [
                'class' => 'ConfluentDeleteIAMV2Invitation',
                'method' => 'DELETE',
                'path' => '/iam/v2/invitations/{id}',
                'operation_id' => 'deleteIamV2Invitation',
                'name' => 'Delete an Invitation',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete an invitation. Delete will deactivate the user if the user didn\'t accept the invitation yet.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the invitation.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Invitations iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_iam_v2_ip_groups' => [
                'class' => 'ConfluentListIAMV2IPGroups',
                'method' => 'GET',
                'path' => '/iam/v2/ip-groups',
                'operation_id' => 'listIamV2IpGroups',
                'name' => 'List of IP Groups',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all IP groups.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'IP Groups iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_iam_v2_ip_group' => [
                'class' => 'ConfluentCreateIAMV2IPGroup',
                'method' => 'POST',
                'path' => '/iam/v2/ip-groups',
                'operation_id' => 'createIamV2IpGroup',
                'name' => 'Create an IP Group',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create an IP group.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'IP Groups iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_iam_v2_ip_group' => [
                'class' => 'ConfluentGetIAMV2IPGroup',
                'method' => 'GET',
                'path' => '/iam/v2/ip-groups/{id}',
                'operation_id' => 'getIamV2IpGroup',
                'name' => 'Read an IP Group',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read an IP group.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the IP group.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'IP Groups iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_iam_v2_ip_group' => [
                'class' => 'ConfluentUpdateIAMV2IPGroup',
                'method' => 'PATCH',
                'path' => '/iam/v2/ip-groups/{id}',
                'operation_id' => 'updateIamV2IpGroup',
                'name' => 'Update an IP Group',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update an IP group.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the IP group.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'IP Groups iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_iam_v2_ip_group' => [
                'class' => 'ConfluentDeleteIAMV2IPGroup',
                'method' => 'DELETE',
                'path' => '/iam/v2/ip-groups/{id}',
                'operation_id' => 'deleteIamV2IpGroup',
                'name' => 'Delete an IP Group',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete an IP group.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the IP group.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'IP Groups iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_iam_v2_ip_filters' => [
                'class' => 'ConfluentListIAMV2IPFilters',
                'method' => 'GET',
                'path' => '/iam/v2/ip-filters',
                'operation_id' => 'listIamV2IpFilters',
                'name' => 'List of IP Filters',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all IP filters.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'resource_scope',
                        'argument_name' => 'resource_scope',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Lists all filters belonging to the specified resource scope.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'include_parent_scopes',
                        'argument_name' => 'include_parent_scopes',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'If set to true, this includes filters defined at the organization level. The resource scope must also be set to use this parameter.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'IP Filters iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_iam_v2_ip_filter' => [
                'class' => 'ConfluentCreateIAMV2IPFilter',
                'method' => 'POST',
                'path' => '/iam/v2/ip-filters',
                'operation_id' => 'createIamV2IpFilter',
                'name' => 'Create an IP Filter',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create an IP filter.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'IP Filters iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_iam_v2_ip_filter' => [
                'class' => 'ConfluentGetIAMV2IPFilter',
                'method' => 'GET',
                'path' => '/iam/v2/ip-filters/{id}',
                'operation_id' => 'getIamV2IpFilter',
                'name' => 'Read an IP Filter',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read an IP filter.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the IP filter.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'IP Filters iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_iam_v2_ip_filter' => [
                'class' => 'ConfluentUpdateIAMV2IPFilter',
                'method' => 'PATCH',
                'path' => '/iam/v2/ip-filters/{id}',
                'operation_id' => 'updateIamV2IpFilter',
                'name' => 'Update an IP Filter',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update an IP filter.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the IP filter.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'IP Filters iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_iam_v2_ip_filter' => [
                'class' => 'ConfluentDeleteIAMV2IPFilter',
                'method' => 'DELETE',
                'path' => '/iam/v2/ip-filters/{id}',
                'operation_id' => 'deleteIamV2IpFilter',
                'name' => 'Delete an IP Filter',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete an IP filter.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the IP filter.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'IP Filters iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_iam_v2_ip_filter_summary' => [
                'class' => 'ConfluentGetIAMV2IPFilterSummary',
                'method' => 'GET',
                'path' => '/iam/v2/ip-filter-summary',
                'operation_id' => 'getIamV2IpFilterSummary',
                'name' => 'Read an IP Filter Summary',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read an IP filter summary.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'scope',
                        'argument_name' => 'scope',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given scope.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'IP Filter Summaries iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_iam_v2_role_bindings' => [
                'class' => 'ConfluentListIAMV2RoleBindings',
                'method' => 'GET',
                'path' => '/iam/v2/role-bindings',
                'operation_id' => 'listIamV2RoleBindings',
                'name' => 'List of Role Bindings',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all role bindings.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'principal',
                        'argument_name' => 'principal',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for principal.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'role_name',
                        'argument_name' => 'role_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for rolename.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'crn_pattern',
                        'argument_name' => 'crn_pattern',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by a partial search of crnpattern.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Role Bindings iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_iam_v2_role_binding' => [
                'class' => 'ConfluentCreateIAMV2RoleBinding',
                'method' => 'POST',
                'path' => '/iam/v2/role-bindings',
                'operation_id' => 'createIamV2RoleBinding',
                'name' => 'Create a Role Binding',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a role binding.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Role Bindings iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_iam_v2_role_binding' => [
                'class' => 'ConfluentGetIAMV2RoleBinding',
                'method' => 'GET',
                'path' => '/iam/v2/role-bindings/{id}',
                'operation_id' => 'getIamV2RoleBinding',
                'name' => 'Read a Role Binding',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a role binding.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the role binding.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Role Bindings iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_iam_v2_role_binding' => [
                'class' => 'ConfluentDeleteIAMV2RoleBinding',
                'method' => 'DELETE',
                'path' => '/iam/v2/role-bindings/{id}',
                'operation_id' => 'deleteIamV2RoleBinding',
                'name' => 'Delete a Role Binding',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a role binding.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the role binding.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Role Bindings iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_notifications_v1_subscriptions' => [
                'class' => 'ConfluentListNotificationsV1Subscriptions',
                'method' => 'GET',
                'path' => '/notifications/v1/subscriptions',
                'operation_id' => 'listNotificationsV1Subscriptions',
                'name' => 'List of Subscriptions',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all subscriptions.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Subscriptions notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_notifications_v1_subscription' => [
                'class' => 'ConfluentCreateNotificationsV1Subscription',
                'method' => 'POST',
                'path' => '/notifications/v1/subscriptions',
                'operation_id' => 'createNotificationsV1Subscription',
                'name' => 'Create a Subscription',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a subscription.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Subscriptions notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_notifications_v1_subscription' => [
                'class' => 'ConfluentGetNotificationsV1Subscription',
                'method' => 'GET',
                'path' => '/notifications/v1/subscriptions/{id}',
                'operation_id' => 'getNotificationsV1Subscription',
                'name' => 'Read a Subscription',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a subscription.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the subscription.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Subscriptions notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_notifications_v1_subscription' => [
                'class' => 'ConfluentUpdateNotificationsV1Subscription',
                'method' => 'PATCH',
                'path' => '/notifications/v1/subscriptions/{id}',
                'operation_id' => 'updateNotificationsV1Subscription',
                'name' => 'Update a Subscription',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a subscription.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the subscription.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Subscriptions notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_notifications_v1_subscription' => [
                'class' => 'ConfluentDeleteNotificationsV1Subscription',
                'method' => 'DELETE',
                'path' => '/notifications/v1/subscriptions/{id}',
                'operation_id' => 'deleteNotificationsV1Subscription',
                'name' => 'Delete a Subscription',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a subscription.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the subscription.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Subscriptions notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_notifications_v1_integrations' => [
                'class' => 'ConfluentListNotificationsV1Integrations',
                'method' => 'GET',
                'path' => '/notifications/v1/integrations',
                'operation_id' => 'listNotificationsV1Integrations',
                'name' => 'List of Integrations',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all integrations.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Integrations notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_notifications_v1_integration' => [
                'class' => 'ConfluentCreateNotificationsV1Integration',
                'method' => 'POST',
                'path' => '/notifications/v1/integrations',
                'operation_id' => 'createNotificationsV1Integration',
                'name' => 'Create an Integration',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create an integration.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Integrations notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_notifications_v1_integration' => [
                'class' => 'ConfluentGetNotificationsV1Integration',
                'method' => 'GET',
                'path' => '/notifications/v1/integrations/{id}',
                'operation_id' => 'getNotificationsV1Integration',
                'name' => 'Read an Integration',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read an integration.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the integration.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Integrations notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_notifications_v1_integration' => [
                'class' => 'ConfluentUpdateNotificationsV1Integration',
                'method' => 'PATCH',
                'path' => '/notifications/v1/integrations/{id}',
                'operation_id' => 'updateNotificationsV1Integration',
                'name' => 'Update an Integration',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update an integration.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the integration.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Integrations notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_notifications_v1_integration' => [
                'class' => 'ConfluentDeleteNotificationsV1Integration',
                'method' => 'DELETE',
                'path' => '/notifications/v1/integrations/{id}',
                'operation_id' => 'deleteNotificationsV1Integration',
                'name' => 'Delete an Integration',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete an integration.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the integration.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Integrations notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_test_notifications_v1_integration' => [
                'class' => 'ConfluentTestNotificationsV1Integration',
                'method' => 'POST',
                'path' => '/notifications/v1/integrations:test',
                'operation_id' => 'testNotificationsV1Integration',
                'name' => 'Test a Webhook, Slack or Microsoft Teams integration',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Sends a test notification to validate the integration. This is supported only for Webhook, Slack and MsTeams targets',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Integrations notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_notifications_v1_notification_type' => [
                'class' => 'ConfluentGetNotificationsV1NotificationType',
                'method' => 'GET',
                'path' => '/notifications/v1/notification-types/{id}',
                'operation_id' => 'getNotificationsV1NotificationType',
                'name' => 'Read a Notification Type',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a notification type.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the notification type.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Notification Types notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_notifications_v1_notification_types' => [
                'class' => 'ConfluentListNotificationsV1NotificationTypes',
                'method' => 'GET',
                'path' => '/notifications/v1/notification-types',
                'operation_id' => 'listNotificationsV1NotificationTypes',
                'name' => 'Retrieve a list of all notification types for the resource type.',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to listbyresourcetype a notification type.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'resource_type',
                        'argument_name' => 'resource_type',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Confluent Cloud resource type',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Notification Types notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_notifications_v1_resource_preference' => [
                'class' => 'ConfluentCreateNotificationsV1ResourcePreference',
                'method' => 'POST',
                'path' => '/notifications/v1/resource-preferences',
                'operation_id' => 'createNotificationsV1ResourcePreference',
                'name' => 'Create a Resource Preference',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a resource preference.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Resource Preferences notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_notifications_v1_resource_preference' => [
                'class' => 'ConfluentGetNotificationsV1ResourcePreference',
                'method' => 'GET',
                'path' => '/notifications/v1/resource-preferences/{id}',
                'operation_id' => 'getNotificationsV1ResourcePreference',
                'name' => 'Read a Resource Preference',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a resource preference.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the resource preference.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Resource Preferences notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_notifications_v1_resource_preference' => [
                'class' => 'ConfluentUpdateNotificationsV1ResourcePreference',
                'method' => 'PATCH',
                'path' => '/notifications/v1/resource-preferences/{id}',
                'operation_id' => 'updateNotificationsV1ResourcePreference',
                'name' => 'Update a Resource Preference',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a resource preference.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the resource preference.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Resource Preferences notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_notifications_v1_resource_preference' => [
                'class' => 'ConfluentDeleteNotificationsV1ResourcePreference',
                'method' => 'DELETE',
                'path' => '/notifications/v1/resource-preferences/{id}',
                'operation_id' => 'deleteNotificationsV1ResourcePreference',
                'name' => 'Delete a Resource Preference',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a resource preference.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the resource preference.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Resource Preferences notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_notifications_v1_resource_preference_by_filter' => [
                'class' => 'ConfluentGetNotificationsV1ResourcePreferenceByFilter',
                'method' => 'GET',
                'path' => '/notifications/v1/resource-preferences:lookup',
                'operation_id' => 'getNotificationsV1ResourcePreferenceByFilter',
                'name' => 'Lookup a resource preference by filter returns one',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to readbyfilter a resource preference.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'resource',
                        'argument_name' => 'resource',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Confluent Cloud resource definition',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'resource_type',
                        'argument_name' => 'resource_type',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Confluent Cloud resource type',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Resource Preferences notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_notifications_v1_resource_subscription' => [
                'class' => 'ConfluentCreateNotificationsV1ResourceSubscription',
                'method' => 'POST',
                'path' => '/notifications/v1/resource-subscriptions',
                'operation_id' => 'createNotificationsV1ResourceSubscription',
                'name' => 'Create a Resource Subscription',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a resource subscription.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Resource Subscriptions notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_notifications_v1_resource_subscription' => [
                'class' => 'ConfluentGetNotificationsV1ResourceSubscription',
                'method' => 'GET',
                'path' => '/notifications/v1/resource-subscriptions/{id}',
                'operation_id' => 'getNotificationsV1ResourceSubscription',
                'name' => 'Read a Resource Subscription',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a resource subscription.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the resource subscription.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Resource Subscriptions notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_notifications_v1_resource_subscription' => [
                'class' => 'ConfluentUpdateNotificationsV1ResourceSubscription',
                'method' => 'PATCH',
                'path' => '/notifications/v1/resource-subscriptions/{id}',
                'operation_id' => 'updateNotificationsV1ResourceSubscription',
                'name' => 'Update a Resource Subscription',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a resource subscription.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the resource subscription.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Resource Subscriptions notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_notifications_v1_resource_subscription' => [
                'class' => 'ConfluentDeleteNotificationsV1ResourceSubscription',
                'method' => 'DELETE',
                'path' => '/notifications/v1/resource-subscriptions/{id}',
                'operation_id' => 'deleteNotificationsV1ResourceSubscription',
                'name' => 'Delete a Resource Subscription',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a resource subscription.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the resource subscription.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Resource Subscriptions notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_notifications_v1_resource_subscriptions_by_filter' => [
                'class' => 'ConfluentListNotificationsV1ResourceSubscriptionsByFilter',
                'method' => 'GET',
                'path' => '/notifications/v1/resource-subscriptions:lookup',
                'operation_id' => 'listNotificationsV1ResourceSubscriptionsByFilter',
                'name' => 'Lookup a list of resource subscription by filter',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to listbyfilter a resource subscription.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'resource',
                        'argument_name' => 'resource',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Confluent Cloud resource definition',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'resource_type',
                        'argument_name' => 'resource_type',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Confluent Cloud resource type',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Resource Subscriptions notifications/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_clusters' => [
                'class' => 'ConfluentListClusters',
                'method' => 'GET',
                'path' => '/cmk/v2/clusters',
                'operation_id' => 'listCmkV2Clusters',
                'name' => 'List of Clusters',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all clusters.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.network',
                        'argument_name' => 'spec_network',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.network. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Clusters cmk/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_cmk_v2_cluster' => [
                'class' => 'ConfluentCreateCMKV2Cluster',
                'method' => 'POST',
                'path' => '/cmk/v2/clusters',
                'operation_id' => 'createCmkV2Cluster',
                'name' => 'Create a Cluster',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a cluster.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Clusters cmk/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_cmk_v2_cluster' => [
                'class' => 'ConfluentGetCMKV2Cluster',
                'method' => 'GET',
                'path' => '/cmk/v2/clusters/{id}',
                'operation_id' => 'getCmkV2Cluster',
                'name' => 'Read a Cluster',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a cluster.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Clusters cmk/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_cmk_v2_cluster' => [
                'class' => 'ConfluentUpdateCMKV2Cluster',
                'method' => 'PATCH',
                'path' => '/cmk/v2/clusters/{id}',
                'operation_id' => 'updateCmkV2Cluster',
                'name' => 'Update a Cluster',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a cluster.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Clusters cmk/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_cmk_v2_cluster' => [
                'class' => 'ConfluentDeleteCMKV2Cluster',
                'method' => 'DELETE',
                'path' => '/cmk/v2/clusters/{id}',
                'operation_id' => 'deleteCmkV2Cluster',
                'name' => 'Delete a Cluster',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a cluster.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Clusters cmk/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_ksqldbcm_v2_clusters' => [
                'class' => 'ConfluentListKsqldbcmV2Clusters',
                'method' => 'GET',
                'path' => '/ksqldbcm/v2/clusters',
                'operation_id' => 'listKsqldbcmV2Clusters',
                'name' => 'List of Clusters',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all clusters.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Clusters ksqldbcm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_ksqldbcm_v2_cluster' => [
                'class' => 'ConfluentCreateKsqldbcmV2Cluster',
                'method' => 'POST',
                'path' => '/ksqldbcm/v2/clusters',
                'operation_id' => 'createKsqldbcmV2Cluster',
                'name' => 'Create a Cluster',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a cluster.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Clusters ksqldbcm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_ksqldbcm_v2_cluster' => [
                'class' => 'ConfluentGetKsqldbcmV2Cluster',
                'method' => 'GET',
                'path' => '/ksqldbcm/v2/clusters/{id}',
                'operation_id' => 'getKsqldbcmV2Cluster',
                'name' => 'Read a Cluster',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a cluster.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Clusters ksqldbcm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_ksqldbcm_v2_cluster' => [
                'class' => 'ConfluentDeleteKsqldbcmV2Cluster',
                'method' => 'DELETE',
                'path' => '/ksqldbcm/v2/clusters/{id}',
                'operation_id' => 'deleteKsqldbcmV2Cluster',
                'name' => 'Delete a Cluster',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a cluster.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Clusters ksqldbcm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_connectv1_connectors' => [
                'class' => 'ConfluentListConnectv1Connectors',
                'method' => 'GET',
                'path' => '/connect/v1/environments/{environment_id}/clusters/{kafka_cluster_id}/connectors',
                'operation_id' => 'listConnectv1Connectors',
                'name' => 'List of Connectors',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a list of "names" of the active connectors. You can then make a read requestoperation/readConnectv1Connector for a specific connector by name.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier of the environment this resource belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Kafka cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Connectors connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_connectv1_connector' => [
                'class' => 'ConfluentCreateConnectv1Connector',
                'method' => 'POST',
                'path' => '/connect/v1/environments/{environment_id}/clusters/{kafka_cluster_id}/connectors',
                'operation_id' => 'createConnectv1Connector',
                'name' => 'Create a Connector',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Create a new connector. Returns the new connector information if successful.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier of the environment this resource belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Kafka cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Connectors connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_connectv1_connectors_with_expansions' => [
                'class' => 'ConfluentListConnectv1ConnectorsWithExpansions',
                'method' => 'GET',
                'path' => '/connect/v1/environments/{environment_id}/clusters/{kafka_cluster_id}/connectors?expand=info,status,id',
                'operation_id' => 'listConnectv1ConnectorsWithExpansions',
                'name' => 'List of Connectors with Expansions',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve an object with the queried expansions of all connectors. Without expand query parameter, this list connector\'s endpoint will return a list of only the connector namesoperation/listConnectv1Connectors.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier of the environment this resource belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Kafka cluster.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'expand',
                        'argument_name' => 'expand',
                        'in' => 'query',
                        'required' => false,
                        'description' => '- id : Returns metadata of each connector such as id and id type. - info : Returns metadata of each connector such as the configuration, task information, and type of connector. - status : Returns additional state information of each connector including their status and tasks.',
                        'schema_type' => 'string',
                        'enum' => [
                            'id',
                            'info',
                            'status'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Connectors connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_connectv1_connector_config' => [
                'class' => 'ConfluentGetConnectv1ConnectorConfig',
                'method' => 'GET',
                'path' => '/connect/v1/environments/{environment_id}/clusters/{kafka_cluster_id}/connectors/{connector_name}/config',
                'operation_id' => 'getConnectv1ConnectorConfig',
                'name' => 'Read a Connector Configuration',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Get the configuration for the connector.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'connector_name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique name of the connector.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier of the environment this resource belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Kafka cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Connectors connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_or_update_connectv1_connector_config' => [
                'class' => 'ConfluentCreateOrUpdateConnectv1ConnectorConfig',
                'method' => 'PUT',
                'path' => '/connect/v1/environments/{environment_id}/clusters/{kafka_cluster_id}/connectors/{connector_name}/config',
                'operation_id' => 'createOrUpdateConnectv1ConnectorConfig',
                'name' => 'Create or Update a Connector Configuration',
                'description' => 'Create a new connector using the given configuration, or update the configuration for an existing connector. Returns information about the connector after the change has been made.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'connector_name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique name of the connector.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier of the environment this resource belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Kafka cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Configuration parameters for the connector. All values should be strings.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Connectors connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_read_connectv1_connector' => [
                'class' => 'ConfluentReadConnectv1Connector',
                'method' => 'GET',
                'path' => '/connect/v1/environments/{environment_id}/clusters/{kafka_cluster_id}/connectors/{connector_name}',
                'operation_id' => 'readConnectv1Connector',
                'name' => 'Read a Connector',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Get information about the connector.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'connector_name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique name of the connector.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier of the environment this resource belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Kafka cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Connectors connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_connectv1_connector' => [
                'class' => 'ConfluentDeleteConnectv1Connector',
                'method' => 'DELETE',
                'path' => '/connect/v1/environments/{environment_id}/clusters/{kafka_cluster_id}/connectors/{connector_name}',
                'operation_id' => 'deleteConnectv1Connector',
                'name' => 'Delete a Connector',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Delete a connector. Halts all tasks and deletes the connector configuration.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'connector_name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique name of the connector.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier of the environment this resource belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Kafka cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Connectors connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_pause_connectv1_connector' => [
                'class' => 'ConfluentPauseConnectv1Connector',
                'method' => 'PUT',
                'path' => '/connect/v1/environments/{environment_id}/clusters/{kafka_cluster_id}/connectors/{connector_name}/pause',
                'operation_id' => 'pauseConnectv1Connector',
                'name' => 'Pause a Connector',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Pause the connector and its tasks. Stops message processing until the connector is resumed. This call is asynchronous and the tasks will not transition to PAUSED state at the same time.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'connector_name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique name of the connector.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier of the environment this resource belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Kafka cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Lifecycle connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_resume_connectv1_connector' => [
                'class' => 'ConfluentResumeConnectv1Connector',
                'method' => 'PUT',
                'path' => '/connect/v1/environments/{environment_id}/clusters/{kafka_cluster_id}/connectors/{connector_name}/resume',
                'operation_id' => 'resumeConnectv1Connector',
                'name' => 'Resume a Connector',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Resume a paused connector or do nothing if the connector is not paused. This call is asynchronous and the tasks will not transition to RUNNING state at the same time.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'connector_name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique name of the connector.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier of the environment this resource belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Kafka cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Lifecycle connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_restart_connectv1_connector' => [
                'class' => 'ConfluentRestartConnectv1Connector',
                'method' => 'POST',
                'path' => '/connect/v1/environments/{environment_id}/clusters/{kafka_cluster_id}/connectors/{connector_name}/restart',
                'operation_id' => 'restartConnectv1Connector',
                'name' => 'Restart a Connector',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Restart the connector and its tasks. Stops message processing until the connector and tasks are restart. This call is asynchronous and the connector will not transition to another state at the same time.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'connector_name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique name of the connector.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier of the environment this resource belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Kafka cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Lifecycle connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_read_connectv1_connector_status' => [
                'class' => 'ConfluentReadConnectv1ConnectorStatus',
                'method' => 'GET',
                'path' => '/connect/v1/environments/{environment_id}/clusters/{kafka_cluster_id}/connectors/{connector_name}/status',
                'operation_id' => 'readConnectv1ConnectorStatus',
                'name' => 'Read a Connector Status',
                'description' => 'Get current status of the connector. This includes whether it is running, failed, or paused. Also includes which worker it is assigned to, error information if it has failed, and the state of all its tasks.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'connector_name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique name of the connector.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier of the environment this resource belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Kafka cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Status connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_connectv1_connector_tasks' => [
                'class' => 'ConfluentListConnectv1ConnectorTasks',
                'method' => 'GET',
                'path' => '/connect/v1/environments/{environment_id}/clusters/{kafka_cluster_id}/connectors/{connector_name}/tasks',
                'operation_id' => 'listConnectv1ConnectorTasks',
                'name' => 'List of Connector Tasks',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Get a list of tasks currently running for the connector.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'connector_name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique name of the connector.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier of the environment this resource belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Kafka cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Status connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_connectv1_connector_plugins' => [
                'class' => 'ConfluentListConnectv1ConnectorPlugins',
                'method' => 'GET',
                'path' => '/connect/v1/environments/{environment_id}/clusters/{kafka_cluster_id}/connector-plugins',
                'operation_id' => 'listConnectv1ConnectorPlugins',
                'name' => 'List of Managed Connector plugins',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Return a list of Managed Connector plugins installed in the Kafka Connect cluster.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier of the environment this resource belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Kafka cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Managed Connector Plugins connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_validate_connectv1_connector_plugin' => [
                'class' => 'ConfluentValidateConnectv1ConnectorPlugin',
                'method' => 'PUT',
                'path' => '/connect/v1/environments/{environment_id}/clusters/{kafka_cluster_id}/connector-plugins/{plugin_name}/config/validate',
                'operation_id' => 'validateConnectv1ConnectorPlugin',
                'name' => 'Validate a Managed Connector Plugin',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Validate the provided configuration values against the configuration definition. This API performs per config validation and returns suggested values and validation error messages.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'plugin_name',
                        'argument_name' => 'plugin_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique name of the connector plugin.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier of the environment this resource belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Kafka cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Configuration parameters for the connector. All values should be strings.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Managed Connector Plugins connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_translate_connectv1_connector_plugin' => [
                'class' => 'ConfluentTranslateConnectv1ConnectorPlugin',
                'method' => 'PUT',
                'path' => '/connect/v1/environments/{environment_id}/clusters/{kafka_cluster_id}/connector-plugins/{plugin_name}/config/translate?mask_sensitive=true',
                'operation_id' => 'translateConnectv1ConnectorPlugin',
                'name' => 'Translate Self Managed Connector Plugin Configurations to Fully Managed Connector Plugin Configurations',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Translate the provided Self Managed configuration values. This API performs configuration translation and returns the translated fully managed configuration along with any errors or warnings. Query Parameter masksensitive=true redacts sensitive config values in response.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'plugin_name',
                        'argument_name' => 'plugin_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique name of the connector plugin.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier of the environment this resource belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Kafka cluster.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'mask_sensitive',
                        'argument_name' => 'mask_sensitive',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Indicates whether to redact sensitive config values in response.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Configuration parameters for the connector. All values should be strings.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Managed Connector Plugins connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_connectv1_connector_offsets' => [
                'class' => 'ConfluentGetConnectv1ConnectorOffsets',
                'method' => 'GET',
                'path' => '/connect/v1/environments/{environment_id}/clusters/{kafka_cluster_id}/connectors/{connector_name}/offsets',
                'operation_id' => 'getConnectv1ConnectorOffsets',
                'name' => 'Get a Connector Offsets',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Get the current offsets for the connector. The offsets provide information on the point in the source system, from which the connector is pulling in data. The offsets of a connector are continuously observed periodically and are queryable via this API.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'connector_name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique name of the connector.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier of the environment this resource belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Kafka cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Offsets connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_alter_connectv1_connector_offsets_request' => [
                'class' => 'ConfluentAlterConnectv1ConnectorOffsetsRequest',
                'method' => 'POST',
                'path' => '/connect/v1/environments/{environment_id}/clusters/{kafka_cluster_id}/connectors/{connector_name}/offsets/request',
                'operation_id' => 'alterConnectv1ConnectorOffsetsRequest',
                'name' => 'Request to Alter the Connector Offsets',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Request to alter the offsets of a connector. This supports the ability to PATCH/DELETE the offsets of a connector. Note, you will see momentary downtime as this will internally stop the connector, while the offsets are being altered. You can only make one alter offsets request at a time for a connector.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'connector_name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique name of the connector.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier of the environment this resource belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Kafka cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Offsets connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_connectv1_connector_offsets_request_status' => [
                'class' => 'ConfluentGetConnectv1ConnectorOffsetsRequestStatus',
                'method' => 'GET',
                'path' => '/connect/v1/environments/{environment_id}/clusters/{kafka_cluster_id}/connectors/{connector_name}/offsets/request/status',
                'operation_id' => 'getConnectv1ConnectorOffsetsRequestStatus',
                'name' => 'Get the Status of Alter Offset Request',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Get the status of the previous alter offset request.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'connector_name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique name of the connector.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier of the environment this resource belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Kafka cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Offsets connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_connect_v1_custom_connector_plugins' => [
                'class' => 'ConfluentListConnectV1CustomConnectorPlugins',
                'method' => 'GET',
                'path' => '/connect/v1/custom-connector-plugins',
                'operation_id' => 'listConnectV1CustomConnectorPlugins',
                'name' => 'List of Custom Connector Plugins',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all custom connector plugins. If no cloud filter is specified, returns custom connector plugins from all clouds.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cloud',
                        'argument_name' => 'cloud',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for cloud.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Custom Connector Plugins connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_connect_v1_custom_connector_plugin' => [
                'class' => 'ConfluentCreateConnectV1CustomConnectorPlugin',
                'method' => 'POST',
                'path' => '/connect/v1/custom-connector-plugins',
                'operation_id' => 'createConnectV1CustomConnectorPlugin',
                'name' => 'Create a Custom Connector Plugin',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a custom connector plugin.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Custom Connector Plugins connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_connect_v1_custom_connector_plugin' => [
                'class' => 'ConfluentGetConnectV1CustomConnectorPlugin',
                'method' => 'GET',
                'path' => '/connect/v1/custom-connector-plugins/{id}',
                'operation_id' => 'getConnectV1CustomConnectorPlugin',
                'name' => 'Read a Custom Connector Plugin',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a custom connector plugin.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the custom connector plugin.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Custom Connector Plugins connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_connect_v1_custom_connector_plugin' => [
                'class' => 'ConfluentUpdateConnectV1CustomConnectorPlugin',
                'method' => 'PATCH',
                'path' => '/connect/v1/custom-connector-plugins/{id}',
                'operation_id' => 'updateConnectV1CustomConnectorPlugin',
                'name' => 'Update a Custom Connector Plugin',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a custom connector plugin.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the custom connector plugin.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Custom Connector Plugins connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_connect_v1_custom_connector_plugin' => [
                'class' => 'ConfluentDeleteConnectV1CustomConnectorPlugin',
                'method' => 'DELETE',
                'path' => '/connect/v1/custom-connector-plugins/{id}',
                'operation_id' => 'deleteConnectV1CustomConnectorPlugin',
                'name' => 'Delete a Custom Connector Plugin',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a custom connector plugin.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the custom connector plugin.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Custom Connector Plugins connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_presigned_upload_url_connect_v1_presigned_url' => [
                'class' => 'ConfluentPresignedUploadUrlConnectV1PresignedUrl',
                'method' => 'POST',
                'path' => '/connect/v1/presigned-upload-url',
                'operation_id' => 'presigned-upload-urlConnectV1PresignedUrl',
                'name' => 'Request a presigned upload URL for a new Custom Connector Plugin.',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Request a presigned upload URL to upload a Custom Connector Plugin archive.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Presigned Urls connect/v1'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_list_connect_v1_custom_connector_runtimes' => [
                'class' => 'ConfluentListConnectV1CustomConnectorRuntimes',
                'method' => 'GET',
                'path' => '/connect/v1/custom-connector-runtimes',
                'operation_id' => 'listConnectV1CustomConnectorRuntimes',
                'name' => 'List of Custom Connector Runtimes',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all custom connector runtimes.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Custom Connector Runtimes connect/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_cluster' => [
                'class' => 'ConfluentGetCluster',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}',
                'operation_id' => 'getKafkaCluster',
                'name' => 'Get Cluster',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the Kafka cluster with the specified clusterid.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Cluster v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_batch_create_kafka_acls' => [
                'class' => 'ConfluentBatchCreateKafkaAcls',
                'method' => 'POST',
                'path' => '/kafka/v3/clusters/{cluster_id}/acls:batch',
                'operation_id' => 'batchCreateKafkaAcls',
                'name' => 'Batch Create ACLs',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Create ACLs.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'The batch ACL creation request.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'ACL v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_acls' => [
                'class' => 'ConfluentGetKafkaAcls',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/acls',
                'operation_id' => 'getKafkaAcls',
                'name' => 'List ACLs',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy - When calling /acls without the principal parameter, service accounts are returned in numeric ID format e.g., User:12345. - To retrieve service accounts in the sa-xxx format, use /acls?principal=UserV2:. - The principal parameter supports both legacy User: format and new UserV2: format for service accounts. Return a list of ACLs that match the search criteria.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ],
                    [
                        'name' => 'resource_type',
                        'argument_name' => 'resource_type',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The ACL resource type.',
                        'schema_type' => 'string',
                        'enum' => [
                            'UNKNOWN',
                            'ANY',
                            'TOPIC',
                            'GROUP',
                            'CLUSTER',
                            'TRANSACTIONAL_ID',
                            'DELEGATION_TOKEN'
                        ]
                    ],
                    [
                        'name' => 'resource_name',
                        'argument_name' => 'resource_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The ACL resource name.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'pattern_type',
                        'argument_name' => 'pattern_type',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The ACL pattern type.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'principal',
                        'argument_name' => 'principal',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The ACL principal. This is the Service Account name or user name. Supports both legacy User: format numeric IDs and new UserV2: format sa-xxx format for service accounts. Use UserV2: to retrieve service accounts in the new format.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'host',
                        'argument_name' => 'host',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The ACL host.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'operation',
                        'argument_name' => 'operation',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The ACL operation.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'permission',
                        'argument_name' => 'permission',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The ACL permission.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'ACL v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_create_kafka_acls' => [
                'class' => 'ConfluentCreateKafkaAcls',
                'method' => 'POST',
                'path' => '/kafka/v3/clusters/{cluster_id}/acls',
                'operation_id' => 'createKafkaAcls',
                'name' => 'Create an ACL',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Create an ACL.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'The ACL creation request.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'ACL v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_kafka_acls' => [
                'class' => 'ConfluentDeleteKafkaAcls',
                'method' => 'DELETE',
                'path' => '/kafka/v3/clusters/{cluster_id}/acls',
                'operation_id' => 'deleteKafkaAcls',
                'name' => 'Delete ACLs',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Delete the ACLs that match the search criteria.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ],
                    [
                        'name' => 'resource_type',
                        'argument_name' => 'resource_type',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'The ACL resource type.',
                        'schema_type' => 'string',
                        'enum' => [
                            'UNKNOWN',
                            'ANY',
                            'TOPIC',
                            'GROUP',
                            'CLUSTER',
                            'TRANSACTIONAL_ID',
                            'DELEGATION_TOKEN'
                        ]
                    ],
                    [
                        'name' => 'resource_name',
                        'argument_name' => 'resource_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The ACL resource name.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'pattern_type',
                        'argument_name' => 'pattern_type',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'The ACL pattern type.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'principal',
                        'argument_name' => 'principal',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The ACL principal. This is the Service Account name or user name. Supports both legacy User: format numeric IDs and new UserV2: format sa-xxx format for service accounts. Use UserV2: to retrieve service accounts in the new format.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'host',
                        'argument_name' => 'host',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The ACL host.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'operation',
                        'argument_name' => 'operation',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'The ACL operation.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'permission',
                        'argument_name' => 'permission',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'The ACL permission.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'ACL v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_cluster_configs' => [
                'class' => 'ConfluentListKafkaClusterConfigs',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/broker-configs',
                'operation_id' => 'listKafkaClusterConfigs',
                'name' => 'List Dynamic Broker Configs',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return a list of dynamic cluster-wide broker configuration parameters for the specified Kafka cluster. Returns an empty list if there are no dynamic cluster-wide broker configuration parameters.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Configs v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_kafka_cluster_configs' => [
                'class' => 'ConfluentUpdateKafkaClusterConfigs',
                'method' => 'POST',
                'path' => '/kafka/v3/clusters/{cluster_id}/broker-configs:alter',
                'operation_id' => 'updateKafkaClusterConfigs',
                'name' => 'Batch Alter Dynamic Broker Configs',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Update or delete a set of dynamic cluster-wide broker configuration parameters.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'The alter cluster configuration parameter batch request.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Configs v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_cluster_config' => [
                'class' => 'ConfluentGetKafkaClusterConfig',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/broker-configs/{name}',
                'operation_id' => 'getKafkaClusterConfig',
                'name' => 'Get Dynamic Broker Config',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the dynamic cluster-wide broker configuration parameter specified by name.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The configuration parameter name.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Configs v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_kafka_cluster_config' => [
                'class' => 'ConfluentUpdateKafkaClusterConfig',
                'method' => 'PUT',
                'path' => '/kafka/v3/clusters/{cluster_id}/broker-configs/{name}',
                'operation_id' => 'updateKafkaClusterConfig',
                'name' => 'Update Dynamic Broker Config',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Update the dynamic cluster-wide broker configuration parameter specified by name.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The configuration parameter name.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'The cluster configuration parameter update request.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Configs v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_kafka_cluster_config' => [
                'class' => 'ConfluentDeleteKafkaClusterConfig',
                'method' => 'DELETE',
                'path' => '/kafka/v3/clusters/{cluster_id}/broker-configs/{name}',
                'operation_id' => 'deleteKafkaClusterConfig',
                'name' => 'Reset Dynamic Broker Config',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Reset the configuration parameter specified by name to its default value by deleting a dynamic cluster-wide configuration.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The configuration parameter name.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Configs v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_consumer_groups' => [
                'class' => 'ConfluentListKafkaConsumerGroups',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/consumer-groups',
                'operation_id' => 'listKafkaConsumerGroups',
                'name' => 'List Consumer Groups',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the list of consumer groups that belong to the specified Kafka cluster.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Consumer Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_consumer_group' => [
                'class' => 'ConfluentGetKafkaConsumerGroup',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/consumer-groups/{consumer_group_id}',
                'operation_id' => 'getKafkaConsumerGroup',
                'name' => 'Get Consumer Group',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the consumer group specified by the consumergroupid.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'consumer_group_id',
                        'argument_name' => 'consumer_group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The consumer group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Consumer Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_consumers' => [
                'class' => 'ConfluentListKafkaConsumers',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/consumer-groups/{consumer_group_id}/consumers',
                'operation_id' => 'listKafkaConsumers',
                'name' => 'List Consumers',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return a list of consumers that belong to the specified consumer group.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'consumer_group_id',
                        'argument_name' => 'consumer_group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The consumer group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Consumer Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_consumer_group_lag_summary' => [
                'class' => 'ConfluentGetKafkaConsumerGroupLagSummary',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/consumer-groups/{consumer_group_id}/lag-summary',
                'operation_id' => 'getKafkaConsumerGroupLagSummary',
                'name' => 'Get Consumer Group Lag Summary',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy !Available in dedicated clusters onlyhttps://img.shields.io/badge/-Available%20in%20dedicated%20clusters%20only-%23bc8540https://docs.confluent.io/cloud/current/clusters/cluster-types.htmldedicated-cluster Return the maximum and total lag of the consumers belonging to the specified consumer group.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'consumer_group_id',
                        'argument_name' => 'consumer_group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The consumer group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Consumer Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_consumer_lags' => [
                'class' => 'ConfluentListKafkaConsumerLags',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/consumer-groups/{consumer_group_id}/lags',
                'operation_id' => 'listKafkaConsumerLags',
                'name' => 'List Consumer Lags',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy !Available in dedicated clusters onlyhttps://img.shields.io/badge/-Available%20in%20dedicated%20clusters%20only-%23bc8540https://docs.confluent.io/cloud/current/clusters/cluster-types.htmldedicated-cluster Return a list of consumer lags of the consumers belonging to the specified consumer group.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'consumer_group_id',
                        'argument_name' => 'consumer_group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The consumer group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Consumer Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_consumer_lag' => [
                'class' => 'ConfluentGetKafkaConsumerLag',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/consumer-groups/{consumer_group_id}/lags/{topic_name}/partitions/{partition_id}',
                'operation_id' => 'getKafkaConsumerLag',
                'name' => 'Get Consumer Lag',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy !Available in dedicated clusters onlyhttps://img.shields.io/badge/-Available%20in%20dedicated%20clusters%20only-%23bc8540https://docs.confluent.io/cloud/current/clusters/cluster-types.htmldedicated-cluster Return the consumer lag on a partition with the given partitionid.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'consumer_group_id',
                        'argument_name' => 'consumer_group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The consumer group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'topic_name',
                        'argument_name' => 'topic_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The topic name.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'partition_id',
                        'argument_name' => 'partition_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The partition ID.',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Consumer Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_consumer' => [
                'class' => 'ConfluentGetKafkaConsumer',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/consumer-groups/{consumer_group_id}/consumers/{consumer_id}',
                'operation_id' => 'getKafkaConsumer',
                'name' => 'Get Consumer',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the consumer specified by the consumerid.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'consumer_group_id',
                        'argument_name' => 'consumer_group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The consumer group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'consumer_id',
                        'argument_name' => 'consumer_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The consumer ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Consumer Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_topics' => [
                'class' => 'ConfluentListTopics',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/topics',
                'operation_id' => 'listKafkaTopics',
                'name' => 'List Topics',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the list of topics that belong to the specified Kafka cluster.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Topic v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_create_topic' => [
                'class' => 'ConfluentCreateTopic',
                'method' => 'POST',
                'path' => '/kafka/v3/clusters/{cluster_id}/topics',
                'operation_id' => 'createKafkaTopic',
                'name' => 'Create Topic',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Create a topic. Also supports a dry-run mode that only validates whether the topic creation would succeed if the validateonly request property is explicitly specified and set to true. Note that when dry-run mode is being used the response status would be 200 OK instead of 201 Created.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'The topic creation request. Note that Confluent Cloud allows only specific replication factor values. Because of that the replication factor field should either be omitted or it should use one of the allowed values see https://docs.confluent.io/cloud/current/client-apps/optimizing/durability.html.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Topic v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_topic' => [
                'class' => 'ConfluentGetTopic',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/topics/{topic_name}',
                'operation_id' => 'getKafkaTopic',
                'name' => 'Get Topic',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the topic with the given topicname.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'topic_name',
                        'argument_name' => 'topic_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The topic name.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'include_authorized_operations',
                        'argument_name' => 'include_authorized_operations',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Specify if authorized operations should be included in the response.',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Topic v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_partition_count_kafka_topic' => [
                'class' => 'ConfluentUpdatePartitionCountKafkaTopic',
                'method' => 'PATCH',
                'path' => '/kafka/v3/clusters/{cluster_id}/topics/{topic_name}',
                'operation_id' => 'updatePartitionCountKafkaTopic',
                'name' => 'Update Partition Count',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Increase the number of partitions for a topic. To update other topic configurations, see https://docs.confluent.io/cloud/current/api.htmltag/Configs-v3/operation/updateKafkaTopicConfig.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'topic_name',
                        'argument_name' => 'topic_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The topic name.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Topic v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_kafka_topic' => [
                'class' => 'ConfluentDeleteKafkaTopic',
                'method' => 'DELETE',
                'path' => '/kafka/v3/clusters/{cluster_id}/topics/{topic_name}',
                'operation_id' => 'deleteKafkaTopic',
                'name' => 'Delete Topic',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Delete the topic with the given topicname.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'topic_name',
                        'argument_name' => 'topic_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The topic name.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Topic v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_topic_configs' => [
                'class' => 'ConfluentListKafkaTopicConfigs',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/topics/{topic_name}/configs',
                'operation_id' => 'listKafkaTopicConfigs',
                'name' => 'List Topic Configs',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the list of configuration parameters that belong to the specified topic.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'topic_name',
                        'argument_name' => 'topic_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The topic name.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Configs v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_kafka_topic_config_batch' => [
                'class' => 'ConfluentUpdateKafkaTopicConfigBatch',
                'method' => 'POST',
                'path' => '/kafka/v3/clusters/{cluster_id}/topics/{topic_name}/configs:alter',
                'operation_id' => 'updateKafkaTopicConfigBatch',
                'name' => 'Batch Alter Topic Configs',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Update or delete a set of topic configuration parameters. Also supports a dry-run mode that only validates whether the operation would succeed if the validateonly request property is explicitly specified and set to true.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'topic_name',
                        'argument_name' => 'topic_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The topic name.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'The alter topic configuration parameter batch request.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Configs v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_topic_config' => [
                'class' => 'ConfluentGetKafkaTopicConfig',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/topics/{topic_name}/configs/{name}',
                'operation_id' => 'getKafkaTopicConfig',
                'name' => 'Get Topic Config',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the configuration parameter with the given name.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'topic_name',
                        'argument_name' => 'topic_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The topic name.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The configuration parameter name.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Configs v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_kafka_topic_config' => [
                'class' => 'ConfluentUpdateKafkaTopicConfig',
                'method' => 'PUT',
                'path' => '/kafka/v3/clusters/{cluster_id}/topics/{topic_name}/configs/{name}',
                'operation_id' => 'updateKafkaTopicConfig',
                'name' => 'Update Topic Config',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Update the configuration parameter with given name. To update the number of partitions, see https://docs.confluent.io/cloud/current/api.htmltag/Topic-v3/operation/updatePartitionCountKafkaTopic.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'topic_name',
                        'argument_name' => 'topic_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The topic name.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The configuration parameter name.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'The topic configuration parameter update request.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Configs v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_kafka_topic_config' => [
                'class' => 'ConfluentDeleteKafkaTopicConfig',
                'method' => 'DELETE',
                'path' => '/kafka/v3/clusters/{cluster_id}/topics/{topic_name}/configs/{name}',
                'operation_id' => 'deleteKafkaTopicConfig',
                'name' => 'Reset Topic Config',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Reset the configuration parameter with given name to its default value.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'topic_name',
                        'argument_name' => 'topic_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The topic name.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The configuration parameter name.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Configs v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_partitions' => [
                'class' => 'ConfluentListKafkaPartitions',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/topics/{topic_name}/partitions',
                'operation_id' => 'listKafkaPartitions',
                'name' => 'List Partitions',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the list of partitions that belong to the specified topic.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'topic_name',
                        'argument_name' => 'topic_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The topic name.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Partition v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_partition' => [
                'class' => 'ConfluentGetKafkaPartition',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/topics/{topic_name}/partitions/{partition_id}',
                'operation_id' => 'getKafkaPartition',
                'name' => 'Get Partition',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the partition with the given partitionid.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'topic_name',
                        'argument_name' => 'topic_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The topic name.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'partition_id',
                        'argument_name' => 'partition_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The partition ID.',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Partition v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_all_topic_configs' => [
                'class' => 'ConfluentListKafkaAllTopicConfigs',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/topics/-/configs',
                'operation_id' => 'listKafkaAllTopicConfigs',
                'name' => 'List All Topic Configs',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the list of configuration parameters for all topics hosted by the specified cluster.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Configs v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_produce_record' => [
                'class' => 'ConfluentProduceRecord',
                'method' => 'POST',
                'path' => '/kafka/v3/clusters/{cluster_id}/topics/{topic_name}/records',
                'operation_id' => 'produceRecord',
                'name' => 'Produce Records',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Produce records to the given topic, returning delivery reports for each record produced. This API can be used in streaming mode by setting "Transfer-Encoding: chunked" header. For as long as the connection is kept open, the server will keep accepting records. Records are streamed to and from the server as Concatenated JSON. For each record sent to the server, the server will asynchronously send back a delivery report, in the same order, each with its own errorcode. An errorcode of 200 indicates success. The HTTP status code will be HTTP 200 OK as long as the connection is successfully established. To identify records that have encountered an error, check the errorcode of each delivery report. Note that the clusterid is validated only when running in Confluent Cloud. This API currently does not support Schema Registry integration. Sending schemas is not supported. Only BINARY, JSON, and STRING formats are supported.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'topic_name',
                        'argument_name' => 'topic_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The topic name.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'A single record to be produced to Kafka. To produce multiple records in the same request, simply concatenate the records. The delivery reports are concatenated in the same order as the records are sent.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Records v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_links' => [
                'class' => 'ConfluentListKafkaLinks',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/links',
                'operation_id' => 'listKafkaLinks',
                'name' => 'List all cluster links in the dest cluster',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy linkid in ListLinksResponseData is deprecated and may be removed in a future release. Use the new clusterlinkid instead.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_create_kafka_link' => [
                'class' => 'ConfluentCreateKafkaLink',
                'method' => 'POST',
                'path' => '/kafka/v3/clusters/{cluster_id}/links',
                'operation_id' => 'createKafkaLink',
                'name' => 'Create a cluster link',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Cluster link creation requires source cluster security configurations in the configs JSON section of the data request payload.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ],
                    [
                        'name' => 'link_name',
                        'argument_name' => 'link_name',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'The link name',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'validate_only',
                        'argument_name' => 'validate_only',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'To validate the action can be performed successfully or not. Default: false',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'validate_link',
                        'argument_name' => 'validate_link',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'To synchronously validate that the source cluster ID is expected and the dest cluster has the permission to read topics in the source cluster. Default: true',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Create a cluster link',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_link' => [
                'class' => 'ConfluentGetKafkaLink',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/links/{link_name}',
                'operation_id' => 'getKafkaLink',
                'name' => 'Describe the cluster link',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy linkid in ListLinksResponseData is deprecated and may be removed in a future release. Use the new clusterlinkid instead.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'link_name',
                        'argument_name' => 'link_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link name',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'include_tasks',
                        'argument_name' => 'include_tasks',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to include cluster linking tasks in the response. Default: false',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_kafka_link' => [
                'class' => 'ConfluentDeleteKafkaLink',
                'method' => 'DELETE',
                'path' => '/kafka/v3/clusters/{cluster_id}/links/{link_name}',
                'operation_id' => 'deleteKafkaLink',
                'name' => 'Delete the cluster link',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'link_name',
                        'argument_name' => 'link_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link name',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'force',
                        'argument_name' => 'force',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Force the action. Default: false',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'validate_only',
                        'argument_name' => 'validate_only',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'To validate the action can be performed successfully or not. Default: false',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_default_topic_configs' => [
                'class' => 'ConfluentListKafkaDefaultTopicConfigs',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/topics/{topic_name}/default-configs',
                'operation_id' => 'listKafkaDefaultTopicConfigs',
                'name' => 'List New Topic Default Configs',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy List the default configuration parameters used if the topic were to be newly created.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'topic_name',
                        'argument_name' => 'topic_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The topic name.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Configs v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_link_configs' => [
                'class' => 'ConfluentListKafkaLinkConfigs',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/links/{link_name}/configs',
                'operation_id' => 'listKafkaLinkConfigs',
                'name' => 'List all configs of the cluster link',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'link_name',
                        'argument_name' => 'link_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link name',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_link_configs' => [
                'class' => 'ConfluentGetKafkaLinkConfigs',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/links/{link_name}/configs/{config_name}',
                'operation_id' => 'getKafkaLinkConfigs',
                'name' => 'Describe the config under the cluster link',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'link_name',
                        'argument_name' => 'link_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link name',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'config_name',
                        'argument_name' => 'config_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link config name',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_kafka_link_config' => [
                'class' => 'ConfluentUpdateKafkaLinkConfig',
                'method' => 'PUT',
                'path' => '/kafka/v3/clusters/{cluster_id}/links/{link_name}/configs/{config_name}',
                'operation_id' => 'updateKafkaLinkConfig',
                'name' => 'Alter the config under the cluster link',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'link_name',
                        'argument_name' => 'link_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link name',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'config_name',
                        'argument_name' => 'config_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link config name',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Link config value to update',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_kafka_link_config' => [
                'class' => 'ConfluentDeleteKafkaLinkConfig',
                'method' => 'DELETE',
                'path' => '/kafka/v3/clusters/{cluster_id}/links/{link_name}/configs/{config_name}',
                'operation_id' => 'deleteKafkaLinkConfig',
                'name' => 'Reset the given config to default value',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'link_name',
                        'argument_name' => 'link_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link name',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'config_name',
                        'argument_name' => 'config_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link config name',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_kafka_link_config_batch' => [
                'class' => 'ConfluentUpdateKafkaLinkConfigBatch',
                'method' => 'PUT',
                'path' => '/kafka/v3/clusters/{cluster_id}/links/{link_name}/configs:alter',
                'operation_id' => 'updateKafkaLinkConfigBatch',
                'name' => 'Batch Alter Cluster Link Configs',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Batch Alter Cluster Link Configs',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'link_name',
                        'argument_name' => 'link_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link name',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'validate_only',
                        'argument_name' => 'validate_only',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'To validate the action can be performed successfully or not. Default: false',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_create_kafka_mirror_topic' => [
                'class' => 'ConfluentCreateKafkaMirrorTopic',
                'method' => 'POST',
                'path' => '/kafka/v3/clusters/{cluster_id}/links/{link_name}/mirrors',
                'operation_id' => 'createKafkaMirrorTopic',
                'name' => 'Create a mirror topic',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Create a topic in the destination cluster mirroring a topic in the source cluster',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'link_name',
                        'argument_name' => 'link_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link name',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Name and configs of the topics mirroring from and mirroring to. Note that Confluent Cloud allows only specific replication factor values. Because of that the replication factor field should either be omitted or it should use one of the allowed values see https://docs.confluent.io/cloud/current/client-apps/optimizing/durability.html.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_mirror_topics_under_link' => [
                'class' => 'ConfluentListKafkaMirrorTopicsUnderLink',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/links/{link_name}/mirrors',
                'operation_id' => 'listKafkaMirrorTopicsUnderLink',
                'name' => 'List mirror topics',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy List all mirror topics under the link',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'link_name',
                        'argument_name' => 'link_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link name',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'mirror_status',
                        'argument_name' => 'mirror_status',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The status of the mirror topic. If not specified, all mirror topics will be returned.',
                        'schema_type' => 'string',
                        'enum' => [
                            'ACTIVE',
                            'FAILED',
                            'LINK_FAILED',
                            'LINK_PAUSED',
                            'PAUSED',
                            'PENDING_STOPPED',
                            'SOURCE_UNAVAILABLE',
                            'STOPPED',
                            'PENDING_MIRROR',
                            'PENDING_SYNCHRONIZE',
                            'PENDING_SETUP_FOR_RESTORE',
                            'PENDING_RESTORE'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_mirror_topics' => [
                'class' => 'ConfluentListKafkaMirrorTopics',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/links/-/mirrors',
                'operation_id' => 'listKafkaMirrorTopics',
                'name' => 'List mirror topics',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy List all mirror topics in the cluster',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ],
                    [
                        'name' => 'mirror_status',
                        'argument_name' => 'mirror_status',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The status of the mirror topic. If not specified, all mirror topics will be returned.',
                        'schema_type' => 'string',
                        'enum' => [
                            'ACTIVE',
                            'FAILED',
                            'LINK_FAILED',
                            'LINK_PAUSED',
                            'PAUSED',
                            'PENDING_STOPPED',
                            'SOURCE_UNAVAILABLE',
                            'STOPPED',
                            'PENDING_MIRROR',
                            'PENDING_SYNCHRONIZE',
                            'PENDING_SETUP_FOR_RESTORE',
                            'PENDING_RESTORE'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_read_kafka_mirror_topic' => [
                'class' => 'ConfluentReadKafkaMirrorTopic',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/links/{link_name}/mirrors/{mirror_topic_name}',
                'operation_id' => 'readKafkaMirrorTopic',
                'name' => 'Describe the mirror topic',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'link_name',
                        'argument_name' => 'link_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link name',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'mirror_topic_name',
                        'argument_name' => 'mirror_topic_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Cluster Linking mirror topic name',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'include_state_transition_errors',
                        'argument_name' => 'include_state_transition_errors',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to include mirror state transition errors in the response. Default: false',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_kafka_mirror_topics_promote' => [
                'class' => 'ConfluentUpdateKafkaMirrorTopicsPromote',
                'method' => 'POST',
                'path' => '/kafka/v3/clusters/{cluster_id}/links/{link_name}/mirrors:promote',
                'operation_id' => 'updateKafkaMirrorTopicsPromote',
                'name' => 'Promote the mirror topics',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'link_name',
                        'argument_name' => 'link_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link name',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'validate_only',
                        'argument_name' => 'validate_only',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'To validate the action can be performed successfully or not. Default: false',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Mirror topics to be altered.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_kafka_mirror_topics_failover' => [
                'class' => 'ConfluentUpdateKafkaMirrorTopicsFailover',
                'method' => 'POST',
                'path' => '/kafka/v3/clusters/{cluster_id}/links/{link_name}/mirrors:failover',
                'operation_id' => 'updateKafkaMirrorTopicsFailover',
                'name' => 'Failover the mirror topics',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'link_name',
                        'argument_name' => 'link_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link name',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'validate_only',
                        'argument_name' => 'validate_only',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'To validate the action can be performed successfully or not. Default: false',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Mirror topics to be altered.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_kafka_mirror_topics_pause' => [
                'class' => 'ConfluentUpdateKafkaMirrorTopicsPause',
                'method' => 'POST',
                'path' => '/kafka/v3/clusters/{cluster_id}/links/{link_name}/mirrors:pause',
                'operation_id' => 'updateKafkaMirrorTopicsPause',
                'name' => 'Pause the mirror topics',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'link_name',
                        'argument_name' => 'link_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link name',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'validate_only',
                        'argument_name' => 'validate_only',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'To validate the action can be performed successfully or not. Default: false',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Mirror topics to be altered.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_kafka_mirror_topics_resume' => [
                'class' => 'ConfluentUpdateKafkaMirrorTopicsResume',
                'method' => 'POST',
                'path' => '/kafka/v3/clusters/{cluster_id}/links/{link_name}/mirrors:resume',
                'operation_id' => 'updateKafkaMirrorTopicsResume',
                'name' => 'Resume the mirror topics',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'link_name',
                        'argument_name' => 'link_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link name',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'validate_only',
                        'argument_name' => 'validate_only',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'To validate the action can be performed successfully or not. Default: false',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Mirror topics to be altered.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_kafka_mirror_topics_reverse_and_start_mirror' => [
                'class' => 'ConfluentUpdateKafkaMirrorTopicsReverseAndStartMirror',
                'method' => 'POST',
                'path' => '/kafka/v3/clusters/{cluster_id}/links/{link_name}/mirrors:reverse-and-start-mirror',
                'operation_id' => 'updateKafkaMirrorTopicsReverseAndStartMirror',
                'name' => 'Reverse the local mirror topic and start the remote mirror topic',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'link_name',
                        'argument_name' => 'link_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link name',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'validate_only',
                        'argument_name' => 'validate_only',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'To validate the action can be performed successfully or not. Default: false',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Mirror topics to be altered.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_kafka_mirror_topics_reverse_and_pause_mirror' => [
                'class' => 'ConfluentUpdateKafkaMirrorTopicsReverseAndPauseMirror',
                'method' => 'POST',
                'path' => '/kafka/v3/clusters/{cluster_id}/links/{link_name}/mirrors:reverse-and-pause-mirror',
                'operation_id' => 'updateKafkaMirrorTopicsReverseAndPauseMirror',
                'name' => 'Reverse the local mirror topic and Pause the remote mirror topic',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'link_name',
                        'argument_name' => 'link_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link name',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'validate_only',
                        'argument_name' => 'validate_only',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'To validate the action can be performed successfully or not. Default: false',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Mirror topics to be altered.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_kafka_mirror_topics_truncate_and_restore_mirror' => [
                'class' => 'ConfluentUpdateKafkaMirrorTopicsTruncateAndRestoreMirror',
                'method' => 'POST',
                'path' => '/kafka/v3/clusters/{cluster_id}/links/{link_name}/mirrors:truncate-and-restore',
                'operation_id' => 'updateKafkaMirrorTopicsTruncateAndRestoreMirror',
                'name' => 'Truncates the local topic to the remote stopped mirror log end offsets and restores mirroring to the local topic to mirror from the remote topic',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'link_name',
                        'argument_name' => 'link_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The link name',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'include_partition_level_truncation_data',
                        'argument_name' => 'include_partition_level_truncation_data',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to include partition level truncation information when truncating and restoring a topic in the response. Default: false',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'validate_only',
                        'argument_name' => 'validate_only',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'To validate the action can be performed successfully or not. Default: false',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Mirror topics to be altered.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Cluster Linking v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_share_groups' => [
                'class' => 'ConfluentListKafkaShareGroups',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/share-groups',
                'operation_id' => 'listKafkaShareGroups',
                'name' => 'List Share Groups',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the list of share groups that belong to the specified Kafka cluster.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Share Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_share_group' => [
                'class' => 'ConfluentGetKafkaShareGroup',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/share-groups/{group_id}',
                'operation_id' => 'getKafkaShareGroup',
                'name' => 'Get Share Group',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the share group specified by the groupid.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Share Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_kafka_share_group' => [
                'class' => 'ConfluentDeleteKafkaShareGroup',
                'method' => 'DELETE',
                'path' => '/kafka/v3/clusters/{cluster_id}/share-groups/{group_id}',
                'operation_id' => 'deleteKafkaShareGroup',
                'name' => 'Delete Share Group',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Delete the share group specified by the groupid.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Share Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_share_group_consumers' => [
                'class' => 'ConfluentListKafkaShareGroupConsumers',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/share-groups/{group_id}/consumers',
                'operation_id' => 'listKafkaShareGroupConsumers',
                'name' => 'List Share Group Consumers',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return a list of consumers that belong to the specified share group.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Share Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_share_group_consumer' => [
                'class' => 'ConfluentGetKafkaShareGroupConsumer',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/share-groups/{group_id}/consumers/{consumer_id}',
                'operation_id' => 'getKafkaShareGroupConsumer',
                'name' => 'Get Share Group Consumer',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the consumer specified by the consumerid.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'consumer_id',
                        'argument_name' => 'consumer_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The consumer ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Share Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_share_group_consumer_assignments' => [
                'class' => 'ConfluentListKafkaShareGroupConsumerAssignments',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/share-groups/{group_id}/consumers/{consumer_id}/assignments',
                'operation_id' => 'listKafkaShareGroupConsumerAssignments',
                'name' => 'List Share Group Consumer Assignments',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the consumer assignments specified by the consumerid.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'consumer_id',
                        'argument_name' => 'consumer_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The consumer ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Share Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_group_configs' => [
                'class' => 'ConfluentListKafkaGroupConfigs',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/groups/{group_id}/configs',
                'operation_id' => 'listKafkaGroupConfigs',
                'name' => 'List all configs of the group',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy List all configurations for the specified group. This API supports consumer groups, share groups, and streams groups.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Configs v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_group_config' => [
                'class' => 'ConfluentGetKafkaGroupConfig',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/groups/{group_id}/configs/{name}',
                'operation_id' => 'getKafkaGroupConfig',
                'name' => 'Get group config',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Get the configuration with the specified name for the specified group. This API supports consumer groups, share groups, and streams groups.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The configuration parameter name.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Configs v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_kafka_group_config' => [
                'class' => 'ConfluentUpdateKafkaGroupConfig',
                'method' => 'PUT',
                'path' => '/kafka/v3/clusters/{cluster_id}/groups/{group_id}/configs/{name}',
                'operation_id' => 'updateKafkaGroupConfig',
                'name' => 'Update group config',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Update the configuration with the specified name for the specified group. This API supports consumer groups, share groups, and streams groups.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The configuration parameter name.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Group config value to update',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Configs v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_kafka_group_config' => [
                'class' => 'ConfluentDeleteKafkaGroupConfig',
                'method' => 'DELETE',
                'path' => '/kafka/v3/clusters/{cluster_id}/groups/{group_id}/configs/{name}',
                'operation_id' => 'deleteKafkaGroupConfig',
                'name' => 'Delete group config',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Delete the dynamic configuration override with the specified name for the specified group. After deletion, the default group configuration will be applied. This API supports consumer groups, share groups, and streams groups.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The configuration parameter name.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Configs v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_kafka_group_config_batch' => [
                'class' => 'ConfluentUpdateKafkaGroupConfigBatch',
                'method' => 'POST',
                'path' => '/kafka/v3/clusters/{cluster_id}/groups/{group_id}/configs:alter',
                'operation_id' => 'updateKafkaGroupConfigBatch',
                'name' => 'Batch Alter Group Configs',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Batch alter configurations for the specified group. This API supports consumer groups, share groups, and streams groups.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'validate_only',
                        'argument_name' => 'validate_only',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'To validate the action can be performed successfully or not. Default: false',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Configs v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_streams_groups' => [
                'class' => 'ConfluentListKafkaStreamsGroups',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/streams-groups',
                'operation_id' => 'listKafkaStreamsGroups',
                'name' => 'List Streams Groups',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the list of streams groups that belong to the specified Kafka cluster',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Streams Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_streams_group' => [
                'class' => 'ConfluentGetKafkaStreamsGroup',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/streams-groups/{group_id}',
                'operation_id' => 'getKafkaStreamsGroup',
                'name' => 'Get Streams Group',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the streams group specified by the groupid.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Streams Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_streams_group_subtopologies' => [
                'class' => 'ConfluentListKafkaStreamsGroupSubtopologies',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/streams-groups/{group_id}/subtopologies',
                'operation_id' => 'listKafkaStreamsGroupSubtopologies',
                'name' => 'List Streams Group Subtopologies',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy Return a list of subtopologies that belong to the specified streams group.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Streams Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_streams_group_subtopology' => [
                'class' => 'ConfluentGetKafkaStreamsGroupSubtopology',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/streams-groups/{group_id}/subtopologies/{subtopology_id}',
                'operation_id' => 'getKafkaStreamsGroupSubtopology',
                'name' => 'Get Streams Group Subtopology',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the subtopology specified by the subtopologyid.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'subtopology_id',
                        'argument_name' => 'subtopology_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The streams subtopology ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Streams Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_streams_group_members' => [
                'class' => 'ConfluentListKafkaStreamsGroupMembers',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/streams-groups/{group_id}/members',
                'operation_id' => 'listKafkaStreamsGroupMembers',
                'name' => 'List Streams Group Members',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy Return a list of members that belong to the specified streams group.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Streams Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_streams_group_member' => [
                'class' => 'ConfluentGetKafkaStreamsGroupMember',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/streams-groups/{group_id}/members/{member_id}',
                'operation_id' => 'getKafkaStreamsGroupMember',
                'name' => 'Get Streams Group Member',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the members specified by the memberid.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'member_id',
                        'argument_name' => 'member_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The streams member ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Streams Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_streams_group_member_assignments' => [
                'class' => 'ConfluentGetKafkaStreamsGroupMemberAssignments',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/streams-groups/{group_id}/members/{member_id}/assignments',
                'operation_id' => 'getKafkaStreamsGroupMemberAssignments',
                'name' => 'Get Streams Group Member Assignments',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the assignments of the member specified by the memberid.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'member_id',
                        'argument_name' => 'member_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The streams member ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Streams Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_streams_group_member_target_assignments' => [
                'class' => 'ConfluentGetKafkaStreamsGroupMemberTargetAssignments',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/streams-groups/{group_id}/members/{member_id}/target-assignments',
                'operation_id' => 'getKafkaStreamsGroupMemberTargetAssignments',
                'name' => 'Get Streams Group Member Target Assignments',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the target assignments of the member specified by the memberid.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'member_id',
                        'argument_name' => 'member_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The streams member ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Streams Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_streams_group_member_assignment_tasks' => [
                'class' => 'ConfluentListKafkaStreamsGroupMemberAssignmentTasks',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/streams-groups/{group_id}/members/{member_id}/assignments/{assignments_type}',
                'operation_id' => 'listKafkaStreamsGroupMemberAssignmentTasks',
                'name' => 'List Streams Group Assignments of a Specific Type',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the tasks of the member specified by the memberid, and the type assignmentstype.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'member_id',
                        'argument_name' => 'member_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The streams member ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'assignments_type',
                        'argument_name' => 'assignments_type',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The streams member Assignment type.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Streams Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_kafka_streams_group_member_target_assignment_tasks' => [
                'class' => 'ConfluentListKafkaStreamsGroupMemberTargetAssignmentTasks',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/streams-groups/{group_id}/members/{member_id}/target-assignments/{assignments_type}',
                'operation_id' => 'listKafkaStreamsGroupMemberTargetAssignmentTasks',
                'name' => 'List Streams Group Target Assignments of a Specific Type',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the target tasks of the member specified by the memberid, and the type assignmentstype.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'member_id',
                        'argument_name' => 'member_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The streams member ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'assignments_type',
                        'argument_name' => 'assignments_type',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The streams member Assignment type.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Streams Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_streams_group_member_assignment_task_partitions' => [
                'class' => 'ConfluentGetKafkaStreamsGroupMemberAssignmentTaskPartitions',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/streams-groups/{group_id}/members/{member_id}/assignments/{assignments_type}/subtopologies/{subtopology_id}',
                'operation_id' => 'getKafkaStreamsGroupMemberAssignmentTaskPartitions',
                'name' => 'List Streams Group Assignments Task Partitions of a Specific Type and Subtopology',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the tasks of the member specified by the memberid, and the type assignmentstype.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'member_id',
                        'argument_name' => 'member_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The streams member ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'assignments_type',
                        'argument_name' => 'assignments_type',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The streams member Assignment type.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'subtopology_id',
                        'argument_name' => 'subtopology_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The streams subtopology ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Streams Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kafka_streams_group_member_target_assignment_task_partitions' => [
                'class' => 'ConfluentGetKafkaStreamsGroupMemberTargetAssignmentTaskPartitions',
                'method' => 'GET',
                'path' => '/kafka/v3/clusters/{cluster_id}/streams-groups/{group_id}/members/{member_id}/target-assignments/{assignments_type}/subtopologies/{subtopology_id}',
                'operation_id' => 'getKafkaStreamsGroupMemberTargetAssignmentTaskPartitions',
                'name' => 'List Streams Group Target Assignments Task Partitions of a Specific Type and Subtopology',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy Return the tasks of the member specified by the memberid, and the type assignmentstype.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster_id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Kafka cluster ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'member_id',
                        'argument_name' => 'member_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The streams member ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'assignments_type',
                        'argument_name' => 'assignments_type',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The streams member Assignment type.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'subtopology_id',
                        'argument_name' => 'subtopology_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The streams subtopology ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Streams Group v3'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_service_quota_v1_applied_quotas' => [
                'class' => 'ConfluentListServiceQuotaV1AppliedQuotas',
                'method' => 'GET',
                'path' => '/service-quota/v1/applied-quotas',
                'operation_id' => 'listServiceQuotaV1AppliedQuotas',
                'name' => 'List of Applied Quotas',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all applied quotas. Shows all quotas for a given scope.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'scope',
                        'argument_name' => 'scope',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'The applied scope the quota belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The environment ID the quota is associated with.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'network',
                        'argument_name' => 'network',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The network ID the quota is associated with.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster',
                        'argument_name' => 'kafka_cluster',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The kafka cluster ID the quota is associated with.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The id quota code that this quota belongs to.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Applied Quotas service-quota/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_service_quota_v1_applied_quota' => [
                'class' => 'ConfluentGetServiceQuotaV1AppliedQuota',
                'method' => 'GET',
                'path' => '/service-quota/v1/applied-quotas/{id}',
                'operation_id' => 'getServiceQuotaV1AppliedQuota',
                'name' => 'Read an Applied Quota',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read an applied quota.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The environment ID the quota is associated with. This field is only required when retrieving a single quota and the scope of quota is "ENVIRONMENT" or "NETWORK" or "KAFKACLUSTER".',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'network',
                        'argument_name' => 'network',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The network ID the quota is associated with. This field is only required when retrieving a single quota and the scope of quota is "NETWORK".',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster',
                        'argument_name' => 'kafka_cluster',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The kafka cluster ID the quota is associated with. This field is required only when the scope of quota is "KAFKACLUSTER".',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the applied quota.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Applied Quotas service-quota/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_service_quota_v1_scopes' => [
                'class' => 'ConfluentListServiceQuotaV1Scopes',
                'method' => 'GET',
                'path' => '/service-quota/v1/scopes',
                'operation_id' => 'listServiceQuotaV1Scopes',
                'name' => 'List of Scopes',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all scopes.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Scopes service-quota/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_service_quota_v1_scope' => [
                'class' => 'ConfluentGetServiceQuotaV1Scope',
                'method' => 'GET',
                'path' => '/service-quota/v1/scopes/{id}',
                'operation_id' => 'getServiceQuotaV1Scope',
                'name' => 'Read a Scope',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a scope.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the scope.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Scopes service-quota/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_partner_v2_entitlements' => [
                'class' => 'ConfluentListPartnerV2Entitlements',
                'method' => 'GET',
                'path' => '/partner/v2/entitlements',
                'operation_id' => 'listPartnerV2Entitlements',
                'name' => 'List of Entitlements',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Partner v2https://img.shields.io/badge/-Request%20Access%20To%20Partner%20v2-%23bc8540mailto:ccloud-api-access+partner-v2-early-access@confluent.io?subject=Request%20to%20join%20partner/v2%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20partner/v2%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Retrieve a sorted, filtered, paginated list of all entitlements.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'organization.id',
                        'argument_name' => 'organization_id',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for organization.id.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Entitlements partner/v2'
                ],
                'security' => [
                    'oauth'
                ]
            ],
            'confluent_create_partner_v2_entitlement' => [
                'class' => 'ConfluentCreatePartnerV2Entitlement',
                'method' => 'POST',
                'path' => '/partner/v2/entitlements',
                'operation_id' => 'createPartnerV2Entitlement',
                'name' => 'Create an Entitlement',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Partner v2https://img.shields.io/badge/-Request%20Access%20To%20Partner%20v2-%23bc8540mailto:ccloud-api-access+partner-v2-early-access@confluent.io?subject=Request%20to%20join%20partner/v2%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20partner/v2%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Make a request to create an entitlement.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Entitlements partner/v2'
                ],
                'security' => [
                    'oauth'
                ]
            ],
            'confluent_get_partner_v2_entitlement' => [
                'class' => 'ConfluentGetPartnerV2Entitlement',
                'method' => 'GET',
                'path' => '/partner/v2/entitlements/{id}',
                'operation_id' => 'getPartnerV2Entitlement',
                'name' => 'Read an Entitlement',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Partner v2https://img.shields.io/badge/-Request%20Access%20To%20Partner%20v2-%23bc8540mailto:ccloud-api-access+partner-v2-early-access@confluent.io?subject=Request%20to%20join%20partner/v2%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20partner/v2%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Make a request to read an entitlement.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'organization.id',
                        'argument_name' => 'organization_id',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Scope the operation to the given organization.id.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the entitlement.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Entitlements partner/v2'
                ],
                'security' => [
                    'oauth'
                ]
            ],
            'confluent_list_srcm_v2_regions' => [
                'class' => 'ConfluentListSRCMV2Regions',
                'method' => 'GET',
                'path' => '/srcm/v2/regions',
                'operation_id' => 'listSrcmV2Regions',
                'name' => 'List of Regions',
                'description' => '!Deprecatedhttps://img.shields.io/badge/Lifecycle%20Stage-Deprecated-%23ff005csection/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all regions.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'spec.cloud',
                        'argument_name' => 'spec_cloud',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.cloud.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.region_name',
                        'argument_name' => 'spec_region_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.regionname.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.packages',
                        'argument_name' => 'spec_packages',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.packages. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Regions srcm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_srcm_v2_region' => [
                'class' => 'ConfluentGetSRCMV2Region',
                'method' => 'GET',
                'path' => '/srcm/v2/regions/{id}',
                'operation_id' => 'getSrcmV2Region',
                'name' => 'Read a Region',
                'description' => '!Deprecatedhttps://img.shields.io/badge/Lifecycle%20Stage-Deprecated-%23ff005csection/Versioning/API-Lifecycle-Policy Make a request to read a region.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the region.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Regions srcm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_srcm_v2_clusters' => [
                'class' => 'ConfluentListSRCMV2Clusters',
                'method' => 'GET',
                'path' => '/srcm/v2/clusters',
                'operation_id' => 'listSrcmV2Clusters',
                'name' => 'List of Clusters',
                'description' => '!Deprecatedhttps://img.shields.io/badge/Lifecycle%20Stage-Deprecated-%23ff005csection/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all clusters.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Clusters srcm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_srcm_v2_cluster' => [
                'class' => 'ConfluentCreateSRCMV2Cluster',
                'method' => 'POST',
                'path' => '/srcm/v2/clusters',
                'operation_id' => 'createSrcmV2Cluster',
                'name' => 'Create a Cluster',
                'description' => '!Deprecatedhttps://img.shields.io/badge/Lifecycle%20Stage-Deprecated-%23ff005csection/Versioning/API-Lifecycle-Policy Make a request to create a cluster.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Clusters srcm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_srcm_v2_cluster' => [
                'class' => 'ConfluentGetSRCMV2Cluster',
                'method' => 'GET',
                'path' => '/srcm/v2/clusters/{id}',
                'operation_id' => 'getSrcmV2Cluster',
                'name' => 'Read a Cluster',
                'description' => '!Deprecatedhttps://img.shields.io/badge/Lifecycle%20Stage-Deprecated-%23ff005csection/Versioning/API-Lifecycle-Policy Make a request to read a cluster.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Clusters srcm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_srcm_v2_cluster' => [
                'class' => 'ConfluentUpdateSRCMV2Cluster',
                'method' => 'PATCH',
                'path' => '/srcm/v2/clusters/{id}',
                'operation_id' => 'updateSrcmV2Cluster',
                'name' => 'Update a Cluster',
                'description' => '!Deprecatedhttps://img.shields.io/badge/Lifecycle%20Stage-Deprecated-%23ff005csection/Versioning/API-Lifecycle-Policy Make a request to update a cluster.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Clusters srcm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_srcm_v2_cluster' => [
                'class' => 'ConfluentDeleteSRCMV2Cluster',
                'method' => 'DELETE',
                'path' => '/srcm/v2/clusters/{id}',
                'operation_id' => 'deleteSrcmV2Cluster',
                'name' => 'Delete a Cluster',
                'description' => '!Deprecatedhttps://img.shields.io/badge/Lifecycle%20Stage-Deprecated-%23ff005csection/Versioning/API-Lifecycle-Policy Make a request to delete a cluster.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Clusters srcm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_srcm_v3_clusters' => [
                'class' => 'ConfluentListSRCMV3Clusters',
                'method' => 'GET',
                'path' => '/srcm/v3/clusters',
                'operation_id' => 'listSrcmV3Clusters',
                'name' => 'List of Clusters',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all clusters.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Clusters srcm/v3'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_srcm_v3_cluster' => [
                'class' => 'ConfluentGetSRCMV3Cluster',
                'method' => 'GET',
                'path' => '/srcm/v3/clusters/{id}',
                'operation_id' => 'getSrcmV3Cluster',
                'name' => 'Read a Cluster',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a cluster.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Clusters srcm/v3'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_cluster_config' => [
                'class' => 'ConfluentGetClusterConfig',
                'method' => 'GET',
                'path' => '/clusterconfig',
                'operation_id' => 'getClusterConfig',
                'name' => 'Get cluster config',
                'description' => 'Retrieves cluster config information.',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'Config v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_test_compatibility_by_subject_name' => [
                'class' => 'ConfluentTestCompatibilityBySubjectName',
                'method' => 'POST',
                'path' => '/compatibility/subjects/{subject}/versions/{version}',
                'operation_id' => 'testCompatibilityBySubjectName',
                'name' => 'Test schema compatibility against a particular schema subject-version',
                'description' => 'Test input schema against a particular version of a subject\'s schema for compatibility. The compatibility level applied for the check is the configured compatibility level for the subject http:get:: /config/string: subject. If this subject\'s compatibility level was never changed, then the global compatibility level applies http:get:: /config.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Subject of the schema version against which compatibility is to be tested',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'version',
                        'argument_name' => 'version',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Version of the subject\'s schema against which compatibility is to be tested. Valid values for versionId are between 1,2^31-1 or the string "latest"."latest" checks compatibility of the input schema with the last registered schema under the specified subject',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'normalize',
                        'argument_name' => 'normalize',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to normalize the given schema',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'verbose',
                        'argument_name' => 'verbose',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to return detailed error messages',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => true,
                    'description' => 'Schema',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Compatibility v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_test_compatibility_for_subject' => [
                'class' => 'ConfluentTestCompatibilityForSubject',
                'method' => 'POST',
                'path' => '/compatibility/subjects/{subject}/versions',
                'operation_id' => 'testCompatibilityForSubject',
                'name' => 'Test schema compatibility against all schemas under a subject',
                'description' => 'Test input schema against a subject\'s schemas for compatibility, based on the configured compatibility level of the subject. In other words, it will perform the same compatibility check as register for that subject. The compatibility level applied for the check is the configured compatibility level for the subject http:get:: /config/string: subject. If this subject\'s compatibility level was never changed, then the global compatibility level applies http:get:: /config.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Subject of the schema version against which compatibility is to be tested',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'verbose',
                        'argument_name' => 'verbose',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to return detailed error messages',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => true,
                    'description' => 'Schema',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Compatibility v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_subject_level_config' => [
                'class' => 'ConfluentGetSubjectLevelConfig',
                'method' => 'GET',
                'path' => '/config/{subject}',
                'operation_id' => 'getSubjectLevelConfig',
                'name' => 'Get subject compatibility level',
                'description' => 'Retrieves compatibility level, compatibility group, normalization, default metadata, and rule set for a subject.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the subject',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'defaultToGlobal',
                        'argument_name' => 'default_to_global',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to return the global compatibility level if subject compatibility level not found',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Config v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_subject_level_config' => [
                'class' => 'ConfluentUpdateSubjectLevelConfig',
                'method' => 'PUT',
                'path' => '/config/{subject}',
                'operation_id' => 'updateSubjectLevelConfig',
                'name' => 'Update subject compatibility level',
                'description' => 'Update compatibility level, compatibility group, normalization, default metadata, and rule set for the specified subject. On success, echoes the original request back to the client.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the subject',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => true,
                    'description' => 'Config Update Request',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Config v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_subject_config' => [
                'class' => 'ConfluentDeleteSubjectConfig',
                'method' => 'DELETE',
                'path' => '/config/{subject}',
                'operation_id' => 'deleteSubjectConfig',
                'name' => 'Delete subject compatibility level',
                'description' => 'Deletes the specified subject-level compatibility level config and reverts to the global default.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the subject',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Config v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_top_level_config' => [
                'class' => 'ConfluentGetTopLevelConfig',
                'method' => 'GET',
                'path' => '/config',
                'operation_id' => 'getTopLevelConfig',
                'name' => 'Get global compatibility level',
                'description' => 'Retrieves the global compatibility level, compatibility group, normalization, default metadata, and rule set.',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'Config v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_top_level_config' => [
                'class' => 'ConfluentUpdateTopLevelConfig',
                'method' => 'PUT',
                'path' => '/config',
                'operation_id' => 'updateTopLevelConfig',
                'name' => 'Update global compatibility level',
                'description' => 'Updates the global compatibility level, compatibility group, schema normalization, default metadata, and rule set. On success, echoes the original request back to the client.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => true,
                    'description' => 'Config Update Request',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Config v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_top_level_config' => [
                'class' => 'ConfluentDeleteTopLevelConfig',
                'method' => 'DELETE',
                'path' => '/config',
                'operation_id' => 'deleteTopLevelConfig',
                'name' => 'Delete global compatibility level',
                'description' => 'Deletes the global compatibility level config and reverts to the default.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'Config v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_exporters' => [
                'class' => 'ConfluentListExporters',
                'method' => 'GET',
                'path' => '/exporters',
                'operation_id' => 'listExporters',
                'name' => 'Gets all schema exporters',
                'description' => 'Retrieves a list of schema exporters that have been created.',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'Exporters v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_register_exporter' => [
                'class' => 'ConfluentRegisterExporter',
                'method' => 'POST',
                'path' => '/exporters',
                'operation_id' => 'registerExporter',
                'name' => 'Creates a new schema exporter',
                'description' => 'Creates a new schema exporter. All attributes in request body are optional except config.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => true,
                    'description' => 'Schema',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Exporters v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_exporter_info_by_name' => [
                'class' => 'ConfluentGetExporterInfoByName',
                'method' => 'GET',
                'path' => '/exporters/{name}',
                'operation_id' => 'getExporterInfoByName',
                'name' => 'Gets schema exporter by name',
                'description' => 'Retrieves the information of the schema exporter.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the exporter',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Exporters v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_exporter_info' => [
                'class' => 'ConfluentUpdateExporterInfo',
                'method' => 'PUT',
                'path' => '/exporters/{name}',
                'operation_id' => 'updateExporterInfo',
                'name' => 'Update schema exporter by name',
                'description' => 'Updates the information or configurations of the schema exporter. All attributes in request body are optional.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the exporter',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => true,
                    'description' => 'Exporter Update Request',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Exporters v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_exporter' => [
                'class' => 'ConfluentDeleteExporter',
                'method' => 'DELETE',
                'path' => '/exporters/{name}',
                'operation_id' => 'deleteExporter',
                'name' => 'Delete schema exporter by name',
                'description' => 'Deletes the schema exporter.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the exporter',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Exporters v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_exporter_status_by_name' => [
                'class' => 'ConfluentGetExporterStatusByName',
                'method' => 'GET',
                'path' => '/exporters/{name}/status',
                'operation_id' => 'getExporterStatusByName',
                'name' => 'Gets schema exporter status by name',
                'description' => 'Retrieves the status of the schema exporter.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the exporter',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Exporters v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_exporter_config_by_name' => [
                'class' => 'ConfluentGetExporterConfigByName',
                'method' => 'GET',
                'path' => '/exporters/{name}/config',
                'operation_id' => 'getExporterConfigByName',
                'name' => 'Gets schema exporter config by name',
                'description' => 'Retrieves the config of the schema exporter.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the exporter',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Exporters v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_exporter_config_by_name' => [
                'class' => 'ConfluentUpdateExporterConfigByName',
                'method' => 'PUT',
                'path' => '/exporters/{name}/config',
                'operation_id' => 'updateExporterConfigByName',
                'name' => 'Update schema exporter config by name',
                'description' => 'Updates the configuration of the schema exporter.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the exporter',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => true,
                    'description' => 'Exporter Update Request',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Exporters v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_pause_exporter_by_name' => [
                'class' => 'ConfluentPauseExporterByName',
                'method' => 'PUT',
                'path' => '/exporters/{name}/pause',
                'operation_id' => 'pauseExporterByName',
                'name' => 'Pause schema exporter by name',
                'description' => 'Pauses the state of the schema exporter.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the exporter',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Exporters v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_reset_exporter_by_name' => [
                'class' => 'ConfluentResetExporterByName',
                'method' => 'PUT',
                'path' => '/exporters/{name}/reset',
                'operation_id' => 'resetExporterByName',
                'name' => 'Reset schema exporter by name',
                'description' => 'Reset the state of the schema exporter.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the exporter',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Exporters v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_resume_exporter_by_name' => [
                'class' => 'ConfluentResumeExporterByName',
                'method' => 'PUT',
                'path' => '/exporters/{name}/resume',
                'operation_id' => 'resumeExporterByName',
                'name' => 'Resume schema exporter by name',
                'description' => 'Resume running of the schema exporter.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the exporter',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Exporters v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_contexts' => [
                'class' => 'ConfluentListContexts',
                'method' => 'GET',
                'path' => '/contexts',
                'operation_id' => 'listContexts',
                'name' => 'List contexts',
                'description' => 'Retrieves a list of contexts.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'offset',
                        'argument_name' => 'offset',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination offset for results',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination size for results. Ignored if negative',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Contexts v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_mode' => [
                'class' => 'ConfluentGetMode',
                'method' => 'GET',
                'path' => '/mode/{subject}',
                'operation_id' => 'getMode',
                'name' => 'Get subject mode',
                'description' => 'Retrieves the subject mode.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the subject',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'defaultToGlobal',
                        'argument_name' => 'default_to_global',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to return the global mode if subject mode not found',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Modes v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_mode' => [
                'class' => 'ConfluentUpdateMode',
                'method' => 'PUT',
                'path' => '/mode/{subject}',
                'operation_id' => 'updateMode',
                'name' => 'Update subject mode',
                'description' => 'Update mode for the specified subject. On success, echoes the original request back to the client.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the subject',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'force',
                        'argument_name' => 'force',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to force update if setting mode to IMPORT and schemas currently exist',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => true,
                    'description' => 'Update Request',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Modes v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_subject_mode' => [
                'class' => 'ConfluentDeleteSubjectMode',
                'method' => 'DELETE',
                'path' => '/mode/{subject}',
                'operation_id' => 'deleteSubjectMode',
                'name' => 'Delete subject mode',
                'description' => 'Deletes the specified subject-level mode and reverts to the global default.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the subject',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Modes v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_top_level_mode' => [
                'class' => 'ConfluentGetTopLevelMode',
                'method' => 'GET',
                'path' => '/mode',
                'operation_id' => 'getTopLevelMode',
                'name' => 'Get global mode',
                'description' => 'Retrieves global mode.',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'Modes v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_top_level_mode' => [
                'class' => 'ConfluentUpdateTopLevelMode',
                'method' => 'PUT',
                'path' => '/mode',
                'operation_id' => 'updateTopLevelMode',
                'name' => 'Update global mode',
                'description' => 'Update global mode. On success, echoes the original request back to the client.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'force',
                        'argument_name' => 'force',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to force update if setting mode to IMPORT and schemas currently exist',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => true,
                    'description' => 'Update Request',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Modes v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_schema' => [
                'class' => 'ConfluentGetSchema',
                'method' => 'GET',
                'path' => '/schemas/ids/{id}',
                'operation_id' => 'getSchema',
                'name' => 'Get schema string by ID',
                'description' => 'Retrieves the schema string identified by the input ID.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Globally unique identifier of the schema',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Name of the subject',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'format',
                        'argument_name' => 'format',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Desired output format, dependent on schema type. For AVRO schemas, valid values are: " " default or "resolved". For PROTOBUF schemas, valid values are: " " default, "ignoreextensions", or "serialized" The parameter does not apply to JSON schemas.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Schemas v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_schema_only' => [
                'class' => 'ConfluentGetSchemaOnly',
                'method' => 'GET',
                'path' => '/schemas/ids/{id}/schema',
                'operation_id' => 'getSchemaOnly',
                'name' => 'Get schema by ID',
                'description' => 'Retrieves the schema identified by the input ID.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Globally unique identifier of the schema',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Name of the subject',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'format',
                        'argument_name' => 'format',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Desired output format, dependent on schema type. For AVRO schemas, valid values are: " " default or "resolved". For PROTOBUF schemas, valid values are: " " default, "ignoreextensions", or "serialized" The parameter does not apply to JSON schemas.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Schemas v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_schema_types' => [
                'class' => 'ConfluentGetSchemaTypes',
                'method' => 'GET',
                'path' => '/schemas/types',
                'operation_id' => 'getSchemaTypes',
                'name' => 'List supported schema types',
                'description' => 'Retrieve the schema types supported by this registry.',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'Schemas v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_schemas' => [
                'class' => 'ConfluentGetSchemas',
                'method' => 'GET',
                'path' => '/schemas',
                'operation_id' => 'getSchemas',
                'name' => 'List schemas',
                'description' => 'Get the schemas matching the specified parameters.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'subjectPrefix',
                        'argument_name' => 'subject_prefix',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filters results by the respective subject prefix',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'aliases',
                        'argument_name' => 'aliases',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to include aliases in the search',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'deleted',
                        'argument_name' => 'deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to return soft deleted schemas',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'latestOnly',
                        'argument_name' => 'latest_only',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to return latest schema versions only for each matching subject',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'ruleType',
                        'argument_name' => 'rule_type',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filters results by the given rule type',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'offset',
                        'argument_name' => 'offset',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination offset for results',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination size for results. Ignored if negative',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Schemas v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_subjects' => [
                'class' => 'ConfluentGetSubjects',
                'method' => 'GET',
                'path' => '/schemas/ids/{id}/subjects',
                'operation_id' => 'getSubjects',
                'name' => 'List subjects associated to schema ID',
                'description' => 'Retrieves all the subjects associated with a particular schema ID.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Globally unique identifier of the schema',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filters results by the respective subject',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'format',
                        'argument_name' => 'format',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Desired output format, dependent on schema type. For AVRO schemas, valid values are: " " default or "resolved". For PROTOBUF schemas, valid values are: " " default, "ignoreextensions", or "serialized" The parameter does not apply to JSON schemas.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'deleted',
                        'argument_name' => 'deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to include subjects where the schema was deleted',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'offset',
                        'argument_name' => 'offset',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination offset for results',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination size for results. Ignored if negative',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Schemas v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_versions' => [
                'class' => 'ConfluentGetVersions',
                'method' => 'GET',
                'path' => '/schemas/ids/{id}/versions',
                'operation_id' => 'getVersions',
                'name' => 'List subject-versions associated to schema ID',
                'description' => 'Get all the subject-version pairs associated with the input ID.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Globally unique identifier of the schema',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filters results by the respective subject',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'deleted',
                        'argument_name' => 'deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to include subject versions where the schema was deleted',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'offset',
                        'argument_name' => 'offset',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination offset for results',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination size for results. Ignored if negative',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Schemas v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_schema_by_version' => [
                'class' => 'ConfluentGetSchemaByVersion',
                'method' => 'GET',
                'path' => '/subjects/{subject}/versions/{version}',
                'operation_id' => 'getSchemaByVersion',
                'name' => 'Get schema by version',
                'description' => 'Retrieves a specific version of the schema registered under this subject.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the subject',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'version',
                        'argument_name' => 'version',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Version of the schema to be returned. Valid values for versionId are between 1,2^31-1 or the string "latest". "latest" returns the last registered schema under the specified subject. Note that there may be a new latest schema that gets registered right after this request is served.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'format',
                        'argument_name' => 'format',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Desired output format, dependent on schema type. For AVRO schemas, valid values are: " " default or "resolved". For PROTOBUF schemas, valid values are: " " default, "ignoreextensions", or "serialized" The parameter does not apply to JSON schemas.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'deleted',
                        'argument_name' => 'deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to include deleted schema',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Subjects v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_schema_version' => [
                'class' => 'ConfluentDeleteSchemaVersion',
                'method' => 'DELETE',
                'path' => '/subjects/{subject}/versions/{version}',
                'operation_id' => 'deleteSchemaVersion',
                'name' => 'Delete schema version',
                'description' => 'Deletes a specific version of the schema registered under this subject. This only deletes the version and the schema ID remains intact making it still possible to decode data using the schema ID. This API is recommended to be used only in development environments or under extreme circumstances where-in, its required to delete a previously registered schema for compatibility purposes or re-register previously registered schema.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the subject',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'version',
                        'argument_name' => 'version',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Version of the schema to be returned. Valid values for versionId are between 1,2^31-1 or the string "latest". "latest" returns the last registered schema under the specified subject. Note that there may be a new latest schema that gets registered right after this request is served.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'permanent',
                        'argument_name' => 'permanent',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to perform a permanent delete',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Subjects v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_referenced_by' => [
                'class' => 'ConfluentGetReferencedBy',
                'method' => 'GET',
                'path' => '/subjects/{subject}/versions/{version}/referencedby',
                'operation_id' => 'getReferencedBy',
                'name' => 'List schemas referencing a schema',
                'description' => 'Retrieves the IDs of schemas that reference the specified schema.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the subject',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'version',
                        'argument_name' => 'version',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Version of the schema to be returned. Valid values for versionId are between 1,2^31-1 or the string "latest". "latest" returns the last registered schema under the specified subject. Note that there may be a new latest schema that gets registered right after this request is served.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'offset',
                        'argument_name' => 'offset',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination offset for results',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination size for results. Ignored if negative',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Subjects v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_schema_only_1' => [
                'class' => 'ConfluentGetSchemaOnly1',
                'method' => 'GET',
                'path' => '/subjects/{subject}/versions/{version}/schema',
                'operation_id' => 'getSchemaOnly_1',
                'name' => 'Get schema string by version',
                'description' => 'Retrieves the schema for the specified version of this subject. Only the unescaped schema string is returned.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the subject',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'version',
                        'argument_name' => 'version',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Version of the schema to be returned. Valid values for versionId are between 1,2^31-1 or the string "latest". "latest" returns the last registered schema under the specified subject. Note that there may be a new latest schema that gets registered right after this request is served.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'deleted',
                        'argument_name' => 'deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to include deleted schema',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Subjects v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_versions' => [
                'class' => 'ConfluentListVersions',
                'method' => 'GET',
                'path' => '/subjects/{subject}/versions',
                'operation_id' => 'listVersions',
                'name' => 'List versions under subject',
                'description' => 'Retrieves a list of versions registered under the specified subject.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the subject',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'deleted',
                        'argument_name' => 'deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to include deleted schemas',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'deletedOnly',
                        'argument_name' => 'deleted_only',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to return deleted schemas only',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'offset',
                        'argument_name' => 'offset',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination offset for results',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination size for results. Ignored if negative',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Subjects v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_register' => [
                'class' => 'ConfluentRegister',
                'method' => 'POST',
                'path' => '/subjects/{subject}/versions',
                'operation_id' => 'register',
                'name' => 'Register schema under a subject',
                'description' => 'Register a new schema under the specified subject. If successfully registered, this returns the unique identifier of this schema in the registry. The returned identifier should be used to retrieve this schema from the schemas resource and is different from the schema\'s version which is associated with the subject. If the same schema is registered under a different subject, the same identifier will be returned. However, the version of the schema may be different under different subjects. A schema should be compatible with the previously registered schema or schemas if there are any as per the configured compatibility level. The configured compatibility level can be obtained by issuing a GET http:get:: /config/string: subject. If that returns null, then GET http:get:: /config When there are multiple instances of Schema Registry running in the same cluster, the schema registration request will be forwarded to one of the instances designated as the primary. If the primary is not available, the client will get an error code indicating that the forwarding has failed.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the subject',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'normalize',
                        'argument_name' => 'normalize',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to register the normalized schema',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'format',
                        'argument_name' => 'format',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Desired output format, dependent on schema type. For AVRO schemas, valid values are: " " default or "resolved". For PROTOBUF schemas, valid values are: " " default, "ignoreextensions", or "serialized" The parameter does not apply to JSON schemas.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => true,
                    'description' => 'Schema',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Subjects v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_look_up_schema_under_subject' => [
                'class' => 'ConfluentLookUpSchemaUnderSubject',
                'method' => 'POST',
                'path' => '/subjects/{subject}',
                'operation_id' => 'lookUpSchemaUnderSubject',
                'name' => 'Lookup schema under subject',
                'description' => 'Check if a schema has already been registered under the specified subject. If so, this returns the schema string along with its globally unique identifier, its version under this subject and the subject name.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Subject under which the schema will be registered',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'normalize',
                        'argument_name' => 'normalize',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to lookup the normalized schema',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'format',
                        'argument_name' => 'format',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Desired output format, dependent on schema type. For AVRO schemas, valid values are: " " default or "resolved". For PROTOBUF schemas, valid values are: " " default, "ignoreextensions", or "serialized" The parameter does not apply to JSON schemas.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'deleted',
                        'argument_name' => 'deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to lookup deleted schemas',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => true,
                    'description' => 'Schema',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Subjects v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_subject' => [
                'class' => 'ConfluentDeleteSubject',
                'method' => 'DELETE',
                'path' => '/subjects/{subject}',
                'operation_id' => 'deleteSubject',
                'name' => 'Delete subject',
                'description' => 'Deletes the specified subject and its associated compatibility level if registered. It is recommended to use this API only when a topic needs to be recycled or in development environment.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the subject',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'permanent',
                        'argument_name' => 'permanent',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to perform a permanent delete',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Subjects v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list' => [
                'class' => 'ConfluentList',
                'method' => 'GET',
                'path' => '/subjects',
                'operation_id' => 'list',
                'name' => 'List subjects',
                'description' => 'Retrieves a list of registered subjects matching specified parameters.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'subjectPrefix',
                        'argument_name' => 'subject_prefix',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Subject name prefix',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'deleted',
                        'argument_name' => 'deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to look up deleted subjects',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'deletedOnly',
                        'argument_name' => 'deleted_only',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to return deleted subjects only',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'offset',
                        'argument_name' => 'offset',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination offset for results',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination size for results. Ignored if negative',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Subjects v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_latest_with_metadata' => [
                'class' => 'ConfluentGetLatestWithMetadata',
                'method' => 'GET',
                'path' => '/subjects/{subject}/metadata',
                'operation_id' => 'getLatestWithMetadata',
                'name' => 'Retrieve the latest version with the given metadata.',
                'description' => 'Retrieve the latest version with the given metadata.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Subject under which the schema will be registered',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'key',
                        'argument_name' => 'key',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The metadata key. Add "?key=key" at the end of the request to match a metadata key. This query parameter can appear multiple times. Each instance is matched with a corresponding value query parameter, in order.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'value',
                        'argument_name' => 'value',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The metadata value. Add "?value=value" at the end of the request to match a metadata value. This query parameter can appear multiple times. Each instance is matched with a corresponding key query parameter, in order.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'format',
                        'argument_name' => 'format',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Desired output format, dependent on schema type. For AVRO schemas, valid values are: " " default or "resolved". For PROTOBUF schemas, valid values are: " " default, "ignoreextensions", or "serialized" The parameter does not apply to JSON schemas.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'deleted',
                        'argument_name' => 'deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to lookup deleted schemas',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Subjects v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kek_names' => [
                'class' => 'ConfluentGetKekNames',
                'method' => 'GET',
                'path' => '/dek-registry/v1/keks',
                'operation_id' => 'getKekNames',
                'name' => 'Get a list of kek names',
                'description' => 'Get a list of kek names',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'deleted',
                        'argument_name' => 'deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to include deleted keys',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Key Encryption Keys v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_create_kek' => [
                'class' => 'ConfluentCreateKek',
                'method' => 'POST',
                'path' => '/dek-registry/v1/keks',
                'operation_id' => 'createKek',
                'name' => 'Create a kek',
                'description' => 'Create a kek',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'testSharing',
                        'argument_name' => 'test_sharing',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to test kek sharing',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => true,
                    'description' => 'The create request',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Key Encryption Keys v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_kek' => [
                'class' => 'ConfluentDeleteKek',
                'method' => 'DELETE',
                'path' => '/dek-registry/v1/keks/{name}',
                'operation_id' => 'deleteKek',
                'name' => 'Delete a kek',
                'description' => 'Delete a kek',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the kek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'permanent',
                        'argument_name' => 'permanent',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to perform a permanent delete',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Key Encryption Keys v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_kek' => [
                'class' => 'ConfluentGetKek',
                'method' => 'GET',
                'path' => '/dek-registry/v1/keks/{name}',
                'operation_id' => 'getKek',
                'name' => 'Get a kek by name',
                'description' => 'Get a kek by name',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the kek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'deleted',
                        'argument_name' => 'deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to include deleted keys',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Key Encryption Keys v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_put_kek' => [
                'class' => 'ConfluentPutKek',
                'method' => 'PUT',
                'path' => '/dek-registry/v1/keks/{name}',
                'operation_id' => 'putKek',
                'name' => 'Alters a kek',
                'description' => 'Alters a kek',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the kek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'testSharing',
                        'argument_name' => 'test_sharing',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to test kek sharing',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => true,
                    'description' => 'The update request',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Key Encryption Keys v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_undelete_kek' => [
                'class' => 'ConfluentUndeleteKek',
                'method' => 'POST',
                'path' => '/dek-registry/v1/keks/{name}/undelete',
                'operation_id' => 'undeleteKek',
                'name' => 'Undelete a kek',
                'description' => 'Undelete a kek',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the kek',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Key Encryption Keys v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_test_kek' => [
                'class' => 'ConfluentTestKek',
                'method' => 'POST',
                'path' => '/dek-registry/v1/keks/{name}/test',
                'operation_id' => 'testKek',
                'name' => 'Test a kek',
                'description' => 'Test a kek',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the kek',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Key Encryption Keys v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_dek_subjects' => [
                'class' => 'ConfluentGetDekSubjects',
                'method' => 'GET',
                'path' => '/dek-registry/v1/keks/{name}/deks',
                'operation_id' => 'getDekSubjects',
                'name' => 'Get a list of dek subjects',
                'description' => 'Get a list of dek subjects',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the kek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'deleted',
                        'argument_name' => 'deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to include deleted keys',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'offset',
                        'argument_name' => 'offset',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination offset for results',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination size for results. Ignored if negative',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Data Encryption Keys v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_create_dek' => [
                'class' => 'ConfluentCreateDek',
                'method' => 'POST',
                'path' => '/dek-registry/v1/keks/{name}/deks',
                'operation_id' => 'createDek',
                'name' => 'Create a dek',
                'description' => 'Create a dek',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the kek',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => true,
                    'description' => 'The create request',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Data Encryption Keys v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_dek_versions' => [
                'class' => 'ConfluentDeleteDekVersions',
                'method' => 'DELETE',
                'path' => '/dek-registry/v1/keks/{name}/deks/{subject}',
                'operation_id' => 'deleteDekVersions',
                'name' => 'Delete all versions of a dek',
                'description' => 'Delete all versions of a dek',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the kek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Subject of the dek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'algorithm',
                        'argument_name' => 'algorithm',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Algorithm of the dek',
                        'schema_type' => 'string',
                        'enum' => [
                            'AES128_GCM',
                            'AES256_GCM',
                            'AES256_SIV'
                        ]
                    ],
                    [
                        'name' => 'permanent',
                        'argument_name' => 'permanent',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to perform a permanent delete',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Data Encryption Keys v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_dek' => [
                'class' => 'ConfluentGetDek',
                'method' => 'GET',
                'path' => '/dek-registry/v1/keks/{name}/deks/{subject}',
                'operation_id' => 'getDek',
                'name' => 'Get a dek by subject',
                'description' => 'Get a dek by subject',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the kek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Subject of the dek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'algorithm',
                        'argument_name' => 'algorithm',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Algorithm of the dek',
                        'schema_type' => 'string',
                        'enum' => [
                            'AES128_GCM',
                            'AES256_GCM',
                            'AES256_SIV'
                        ]
                    ],
                    [
                        'name' => 'deleted',
                        'argument_name' => 'deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to include deleted keys',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Data Encryption Keys v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_dek_version' => [
                'class' => 'ConfluentDeleteDekVersion',
                'method' => 'DELETE',
                'path' => '/dek-registry/v1/keks/{name}/deks/{subject}/versions/{version}',
                'operation_id' => 'deleteDekVersion',
                'name' => 'Delete a dek version',
                'description' => 'Delete a dek version',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the kek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Subject of the dek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'version',
                        'argument_name' => 'version',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Version of the dek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'algorithm',
                        'argument_name' => 'algorithm',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Algorithm of the dek',
                        'schema_type' => 'string',
                        'enum' => [
                            'AES128_GCM',
                            'AES256_GCM',
                            'AES256_SIV'
                        ]
                    ],
                    [
                        'name' => 'permanent',
                        'argument_name' => 'permanent',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to perform a permanent delete',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Data Encryption Keys v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_dek_by_version' => [
                'class' => 'ConfluentGetDekByVersion',
                'method' => 'GET',
                'path' => '/dek-registry/v1/keks/{name}/deks/{subject}/versions/{version}',
                'operation_id' => 'getDekByVersion',
                'name' => 'Get a dek by subject and version',
                'description' => 'Get a dek by subject and version',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the kek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Subject of the dek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'version',
                        'argument_name' => 'version',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Version of the dek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'algorithm',
                        'argument_name' => 'algorithm',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Algorithm of the dek',
                        'schema_type' => 'string',
                        'enum' => [
                            'AES128_GCM',
                            'AES256_GCM',
                            'AES256_SIV'
                        ]
                    ],
                    [
                        'name' => 'deleted',
                        'argument_name' => 'deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to include deleted keys',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Data Encryption Keys v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_dek_versions' => [
                'class' => 'ConfluentGetDekVersions',
                'method' => 'GET',
                'path' => '/dek-registry/v1/keks/{name}/deks/{subject}/versions',
                'operation_id' => 'getDekVersions',
                'name' => 'List versions of dek',
                'description' => 'List versions of dek',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the kek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Subject of the dek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'algorithm',
                        'argument_name' => 'algorithm',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Algorithm of the dek',
                        'schema_type' => 'string',
                        'enum' => [
                            'AES128_GCM',
                            'AES256_GCM',
                            'AES256_SIV'
                        ]
                    ],
                    [
                        'name' => 'deleted',
                        'argument_name' => 'deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to include deleted keys',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'offset',
                        'argument_name' => 'offset',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination offset for results',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination size for results. Ignored if negative',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Data Encryption Keys v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_undelete_dek_version' => [
                'class' => 'ConfluentUndeleteDekVersion',
                'method' => 'POST',
                'path' => '/dek-registry/v1/keks/{name}/deks/{subject}/versions/{version}/undelete',
                'operation_id' => 'undeleteDekVersion',
                'name' => 'Undelete a dek version',
                'description' => 'Undelete a dek version',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the kek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Subject of the dek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'version',
                        'argument_name' => 'version',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Version of the dek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'algorithm',
                        'argument_name' => 'algorithm',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Algorithm of the dek',
                        'schema_type' => 'string',
                        'enum' => [
                            'AES128_GCM',
                            'AES256_GCM',
                            'AES256_SIV'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Data Encryption Keys v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_undelete_dek_versions' => [
                'class' => 'ConfluentUndeleteDekVersions',
                'method' => 'POST',
                'path' => '/dek-registry/v1/keks/{name}/deks/{subject}/undelete',
                'operation_id' => 'undeleteDekVersions',
                'name' => 'Undelete all versions of a dek',
                'description' => 'Undelete all versions of a dek',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Name of the kek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'subject',
                        'argument_name' => 'subject',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Subject of the dek',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'algorithm',
                        'argument_name' => 'algorithm',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Algorithm of the dek',
                        'schema_type' => 'string',
                        'enum' => [
                            'AES128_GCM',
                            'AES256_GCM',
                            'AES256_SIV'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Data Encryption Keys v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_all_business_metadata_defs' => [
                'class' => 'ConfluentGetAllBusinessMetadataDefs',
                'method' => 'GET',
                'path' => '/catalog/v1/types/businessmetadatadefs',
                'operation_id' => 'getAllBusinessMetadataDefs',
                'name' => 'Bulk Read Business Metadata Definitions',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Bulk retrieval API for retrieving business metadata definitions.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'prefix',
                        'argument_name' => 'prefix',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The prefix of a business metadata definition name',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Types v1'
                ],
                'security' => []
            ],
            'confluent_create_business_metadata_defs' => [
                'class' => 'ConfluentCreateBusinessMetadataDefs',
                'method' => 'POST',
                'path' => '/catalog/v1/types/businessmetadatadefs',
                'operation_id' => 'createBusinessMetadataDefs',
                'name' => 'Bulk Create Business Metadata Definitions',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Bulk create API for business metadata definitions.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'The business metadata definitions to create',
                    'schema_type' => 'array',
                    'items' => [
                        'type' => 'object'
                    ]
                ],
                'tags' => [
                    'Types v1'
                ],
                'security' => []
            ],
            'confluent_update_business_metadata_defs' => [
                'class' => 'ConfluentUpdateBusinessMetadataDefs',
                'method' => 'PUT',
                'path' => '/catalog/v1/types/businessmetadatadefs',
                'operation_id' => 'updateBusinessMetadataDefs',
                'name' => 'Bulk Update Business Metadata Definitions',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Bulk update API for business metadata definitions.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'The business metadata definitions to update',
                    'schema_type' => 'array',
                    'items' => [
                        'type' => 'object'
                    ]
                ],
                'tags' => [
                    'Types v1'
                ],
                'security' => []
            ],
            'confluent_delete_business_metadata_def' => [
                'class' => 'ConfluentDeleteBusinessMetadataDef',
                'method' => 'DELETE',
                'path' => '/catalog/v1/types/businessmetadatadefs/{bmName}',
                'operation_id' => 'deleteBusinessMetadataDef',
                'name' => 'Delete Business Metadata Definition',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Delete API for business metadata definition identified by its name.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'bmName',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The name of the business metadata definition',
                        'schema_type' => 'string',
                        'aliases' => [
                            'bm_name'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Types v1'
                ],
                'security' => []
            ],
            'confluent_get_business_metadata_def_by_name' => [
                'class' => 'ConfluentGetBusinessMetadataDefByName',
                'method' => 'GET',
                'path' => '/catalog/v1/types/businessmetadatadefs/{bmName}',
                'operation_id' => 'getBusinessMetadataDefByName',
                'name' => 'Read Business Metadata Definition',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Get the business metadata definition with the given name.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'bmName',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The name of the business metadata definition',
                        'schema_type' => 'string',
                        'aliases' => [
                            'bm_name'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Types v1'
                ],
                'security' => []
            ],
            'confluent_create_business_metadata' => [
                'class' => 'ConfluentCreateBusinessMetadata',
                'method' => 'POST',
                'path' => '/catalog/v1/entity/businessmetadata',
                'operation_id' => 'createBusinessMetadata',
                'name' => 'Bulk Create Business Metadata',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Bulk API to create multiple business metadata.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'The business metadata',
                    'schema_type' => 'array',
                    'items' => [
                        'type' => 'object'
                    ]
                ],
                'tags' => [
                    'Entity v1'
                ],
                'security' => []
            ],
            'confluent_update_business_metadata' => [
                'class' => 'ConfluentUpdateBusinessMetadata',
                'method' => 'PUT',
                'path' => '/catalog/v1/entity/businessmetadata',
                'operation_id' => 'updateBusinessMetadata',
                'name' => 'Bulk Update Business Metadata',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Bulk API to update multiple business metadata.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'The business metadata',
                    'schema_type' => 'array',
                    'items' => [
                        'type' => 'object'
                    ]
                ],
                'tags' => [
                    'Entity v1'
                ],
                'security' => []
            ],
            'confluent_get_business_metadata' => [
                'class' => 'ConfluentGetBusinessMetadata',
                'method' => 'GET',
                'path' => '/catalog/v1/entity/type/{typeName}/name/{qualifiedName}/businessmetadata',
                'operation_id' => 'getBusinessMetadata',
                'name' => 'Read Business Metadata for an Entity',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Gets the list of business metadata for a given entity represented by a qualified name.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'typeName',
                        'argument_name' => 'type_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The type of the entity',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'qualifiedName',
                        'argument_name' => 'qualified_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The qualified name of the entity',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Entity v1'
                ],
                'security' => []
            ],
            'confluent_delete_business_metadata' => [
                'class' => 'ConfluentDeleteBusinessMetadata',
                'method' => 'DELETE',
                'path' => '/catalog/v1/entity/type/{typeName}/name/{qualifiedName}/businessmetadata/{bmName}',
                'operation_id' => 'deleteBusinessMetadata',
                'name' => 'Delete a Business Metadata for an Entity',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Delete a business metadata on an entity.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'typeName',
                        'argument_name' => 'type_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The type of the entity',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'qualifiedName',
                        'argument_name' => 'qualified_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The qualified name of the entity',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'bmName',
                        'argument_name' => 'bm_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The name of the business metadata',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Entity v1'
                ],
                'security' => []
            ],
            'confluent_update_tags' => [
                'class' => 'ConfluentUpdateTags',
                'method' => 'PUT',
                'path' => '/catalog/v1/entity/tags',
                'operation_id' => 'updateTags',
                'name' => 'Bulk Update Tags',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Bulk API to update multiple tags.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'The tags',
                    'schema_type' => 'array',
                    'items' => [
                        'type' => 'object'
                    ]
                ],
                'tags' => [
                    'Entity v1'
                ],
                'security' => []
            ],
            'confluent_create_tags' => [
                'class' => 'ConfluentCreateTags',
                'method' => 'POST',
                'path' => '/catalog/v1/entity/tags',
                'operation_id' => 'createTags',
                'name' => 'Bulk Create Tags',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Bulk API to create multiple tags.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'The tags',
                    'schema_type' => 'array',
                    'items' => [
                        'type' => 'object'
                    ]
                ],
                'tags' => [
                    'Entity v1'
                ],
                'security' => []
            ],
            'confluent_get_by_unique_attributes' => [
                'class' => 'ConfluentGetByUniqueAttributes',
                'method' => 'GET',
                'path' => '/catalog/v1/entity/type/{typeName}/name/{qualifiedName}',
                'operation_id' => 'getByUniqueAttributes',
                'name' => 'Read an Entity',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Fetch complete definition of an entity given its type and unique attribute.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'typeName',
                        'argument_name' => 'type_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The type of the entity',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'qualifiedName',
                        'argument_name' => 'qualified_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The qualified name of the entity',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'minExtInfo',
                        'argument_name' => 'min_ext_info',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to populate on header and schema attributes',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'ignoreRelationships',
                        'argument_name' => 'ignore_relationships',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to ignore relationships',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Entity v1'
                ],
                'security' => []
            ],
            'confluent_get_tags' => [
                'class' => 'ConfluentGetTags',
                'method' => 'GET',
                'path' => '/catalog/v1/entity/type/{typeName}/name/{qualifiedName}/tags',
                'operation_id' => 'getTags',
                'name' => 'Read Tags for an Entity',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Gets the list of tags for a given entity represented by a qualified name.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'typeName',
                        'argument_name' => 'type_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The type of the entity',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'qualifiedName',
                        'argument_name' => 'qualified_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The qualified name of the entity',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Entity v1'
                ],
                'security' => []
            ],
            'confluent_partial_entity_update' => [
                'class' => 'ConfluentPartialEntityUpdate',
                'method' => 'PUT',
                'path' => '/catalog/v1/entity',
                'operation_id' => 'partialEntityUpdate',
                'name' => 'Update an Entity Attribute',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Partially update an entity attribute.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'The entity to update',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Entity v1'
                ],
                'security' => []
            ],
            'confluent_delete_tag' => [
                'class' => 'ConfluentDeleteTag',
                'method' => 'DELETE',
                'path' => '/catalog/v1/entity/type/{typeName}/name/{qualifiedName}/tags/{tagName}',
                'operation_id' => 'deleteTag',
                'name' => 'Delete a Tag for an Entity',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Delete a tag for an entity.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'typeName',
                        'argument_name' => 'type_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The type of the entity',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'qualifiedName',
                        'argument_name' => 'qualified_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The qualified name of the entity',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'tagName',
                        'argument_name' => 'tag_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The name of the tag',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Entity v1'
                ],
                'security' => []
            ],
            'confluent_search_using_attribute' => [
                'class' => 'ConfluentSearchUsingAttribute',
                'method' => 'GET',
                'path' => '/catalog/v1/search/attribute',
                'operation_id' => 'searchUsingAttribute',
                'name' => 'Search by Attribute',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve data for the specified attribute search query.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'type',
                        'argument_name' => 'type',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Limit the result to only entities of specified types',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'attr',
                        'argument_name' => 'attr',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'One of more additional attributes to return in the response',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'attrName',
                        'argument_name' => 'attr_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The attribute to search',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'attrValuePrefix',
                        'argument_name' => 'attr_value_prefix',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The prefix for the attribute value to search',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'tag',
                        'argument_name' => 'tag',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Limit the result to only entities tagged with the given tag',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'sortBy',
                        'argument_name' => 'sort_by',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An attribute to sort by',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'sortOrder',
                        'argument_name' => 'sort_order',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Sort order, either ASCENDING default or DESCENDING',
                        'schema_type' => 'string',
                        'enum' => [
                            'ASCENDING',
                            'DESCENDING'
                        ]
                    ],
                    [
                        'name' => 'deleted',
                        'argument_name' => 'deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to include deleted entities',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Limit the result set to only include the specified number of entries',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'offset',
                        'argument_name' => 'offset',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Start offset of the result set useful for pagination',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Search v1'
                ],
                'security' => []
            ],
            'confluent_search_using_basic' => [
                'class' => 'ConfluentSearchUsingBasic',
                'method' => 'GET',
                'path' => '/catalog/v1/search/basic',
                'operation_id' => 'searchUsingBasic',
                'name' => 'Search by Fulltext Query',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve data for the specified fulltext query.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'query',
                        'argument_name' => 'query',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The full-text query',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'type',
                        'argument_name' => 'type',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Limit the result to only entities of specified types',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'attr',
                        'argument_name' => 'attr',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'One of more additional attributes to return in the response',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'tag',
                        'argument_name' => 'tag',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Limit the result to only entities tagged with the given tag',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'sortBy',
                        'argument_name' => 'sort_by',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An attribute to sort by',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'sortOrder',
                        'argument_name' => 'sort_order',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Sort order, either ASCENDING default or DESCENDING',
                        'schema_type' => 'string',
                        'enum' => [
                            'ASCENDING',
                            'DESCENDING'
                        ]
                    ],
                    [
                        'name' => 'deleted',
                        'argument_name' => 'deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Whether to include deleted entities',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Limit the result set to only include the specified number of entries',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'offset',
                        'argument_name' => 'offset',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Start offset of the result set useful for pagination',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Search v1'
                ],
                'security' => []
            ],
            'confluent_get_all_tag_defs' => [
                'class' => 'ConfluentGetAllTagDefs',
                'method' => 'GET',
                'path' => '/catalog/v1/types/tagdefs',
                'operation_id' => 'getAllTagDefs',
                'name' => 'Bulk Read Tag Definitions',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Bulk retrieval API for retrieving tag definitions.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'prefix',
                        'argument_name' => 'prefix',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The prefix of a tag definition name',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Types v1'
                ],
                'security' => []
            ],
            'confluent_update_tag_defs' => [
                'class' => 'ConfluentUpdateTagDefs',
                'method' => 'PUT',
                'path' => '/catalog/v1/types/tagdefs',
                'operation_id' => 'updateTagDefs',
                'name' => 'Bulk Update Tag Definitions',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Bulk update API for tag definitions.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'The tag definitions to update',
                    'schema_type' => 'array',
                    'items' => [
                        'type' => 'object'
                    ]
                ],
                'tags' => [
                    'Types v1'
                ],
                'security' => []
            ],
            'confluent_create_tag_defs' => [
                'class' => 'ConfluentCreateTagDefs',
                'method' => 'POST',
                'path' => '/catalog/v1/types/tagdefs',
                'operation_id' => 'createTagDefs',
                'name' => 'Bulk Create Tag Definitions',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Bulk create API for tag definitions.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'The tag definitions to create',
                    'schema_type' => 'array',
                    'items' => [
                        'type' => 'object'
                    ]
                ],
                'tags' => [
                    'Types v1'
                ],
                'security' => []
            ],
            'confluent_get_tag_def_by_name' => [
                'class' => 'ConfluentGetTagDefByName',
                'method' => 'GET',
                'path' => '/catalog/v1/types/tagdefs/{tagName}',
                'operation_id' => 'getTagDefByName',
                'name' => 'Read Tag Definition',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Get the tag definition with the given name.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'tagName',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The name of the tag definiton',
                        'schema_type' => 'string',
                        'aliases' => [
                            'tag_name'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Types v1'
                ],
                'security' => []
            ],
            'confluent_delete_tag_def' => [
                'class' => 'ConfluentDeleteTagDef',
                'method' => 'DELETE',
                'path' => '/catalog/v1/types/tagdefs/{tagName}',
                'operation_id' => 'deleteTagDef',
                'name' => 'Delete Tag Definition',
                'description' => '!Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Delete API for tag definition identified by its name.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'tagName',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The name of the tag definition',
                        'schema_type' => 'string',
                        'aliases' => [
                            'tag_name'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Types v1'
                ],
                'security' => []
            ],
            'confluent_list_cdx_v1_provider_shared_resources' => [
                'class' => 'ConfluentListCdxV1ProviderSharedResources',
                'method' => 'GET',
                'path' => '/cdx/v1/provider-shared-resources',
                'operation_id' => 'listCdxV1ProviderSharedResources',
                'name' => 'List of Provider Shared Resources',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all provider shared resources.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'stream_share',
                        'argument_name' => 'stream_share',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for streamshare.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'crn',
                        'argument_name' => 'crn',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for crn.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'include_deleted',
                        'argument_name' => 'include_deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Include deactivated shared resources',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Provider Shared Resources cdx/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_cdx_v1_provider_shared_resource' => [
                'class' => 'ConfluentGetCdxV1ProviderSharedResource',
                'method' => 'GET',
                'path' => '/cdx/v1/provider-shared-resources/{id}',
                'operation_id' => 'getCdxV1ProviderSharedResource',
                'name' => 'Read a Provider Shared Resource',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a provider shared resource.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the provider shared resource.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Provider Shared Resources cdx/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_cdx_v1_provider_shared_resource' => [
                'class' => 'ConfluentUpdateCdxV1ProviderSharedResource',
                'method' => 'PATCH',
                'path' => '/cdx/v1/provider-shared-resources/{id}',
                'operation_id' => 'updateCdxV1ProviderSharedResource',
                'name' => 'Update a Provider Shared Resource',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a provider shared resource.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the provider shared resource.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Provider Shared Resources cdx/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_upload_image_cdx_v1_provider_shared_resource' => [
                'class' => 'ConfluentUploadImageCdxV1ProviderSharedResource',
                'method' => 'POST',
                'path' => '/cdx/v1/provider-shared-resources/{id}/images/{file_name}',
                'operation_id' => 'upload_imageCdxV1ProviderSharedResource',
                'name' => 'Upload image for shared resource',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Upload the image file for the shared resource',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the provider shared resource.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'file_name',
                        'argument_name' => 'file_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The File Name',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'string'
                ],
                'tags' => [
                    'Provider Shared Resources cdx/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_view_image_cdx_v1_provider_shared_resource' => [
                'class' => 'ConfluentViewImageCdxV1ProviderSharedResource',
                'method' => 'GET',
                'path' => '/cdx/v1/provider-shared-resources/{id}/images/{file_name}',
                'operation_id' => 'view_imageCdxV1ProviderSharedResource',
                'name' => 'Get image for shared resource',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Returns the image file for the shared resource',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the provider shared resource.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'file_name',
                        'argument_name' => 'file_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The File Name',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Provider Shared Resources cdx/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_image_cdx_v1_provider_shared_resource' => [
                'class' => 'ConfluentDeleteImageCdxV1ProviderSharedResource',
                'method' => 'DELETE',
                'path' => '/cdx/v1/provider-shared-resources/{id}/images/{file_name}',
                'operation_id' => 'delete_imageCdxV1ProviderSharedResource',
                'name' => 'Delete the shared resource\'s image',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Deletes the image file for the shared resource',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the provider shared resource.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'file_name',
                        'argument_name' => 'file_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The File Name',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Provider Shared Resources cdx/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_cdx_v1_provider_shares' => [
                'class' => 'ConfluentListCdxV1ProviderShares',
                'method' => 'GET',
                'path' => '/cdx/v1/provider-shares',
                'operation_id' => 'listCdxV1ProviderShares',
                'name' => 'List of Provider Shares',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all provider shares.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'shared_resource',
                        'argument_name' => 'shared_resource',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for sharedresource.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'crn',
                        'argument_name' => 'crn',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for crn.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'include_deleted',
                        'argument_name' => 'include_deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Include deactivated shares',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Provider Shares cdx/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_cdx_v1_provider_share' => [
                'class' => 'ConfluentCreateCdxV1ProviderShare',
                'method' => 'POST',
                'path' => '/cdx/v1/provider-shares',
                'operation_id' => 'createCdxV1ProviderShare',
                'name' => 'Create a provider share',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Creates a share based on delivery method.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Provider Shares cdx/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_cdx_v1_provider_share' => [
                'class' => 'ConfluentGetCdxV1ProviderShare',
                'method' => 'GET',
                'path' => '/cdx/v1/provider-shares/{id}',
                'operation_id' => 'getCdxV1ProviderShare',
                'name' => 'Read a Provider Share',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a provider share.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the provider share.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Provider Shares cdx/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_cdx_v1_provider_share' => [
                'class' => 'ConfluentDeleteCdxV1ProviderShare',
                'method' => 'DELETE',
                'path' => '/cdx/v1/provider-shares/{id}',
                'operation_id' => 'deleteCdxV1ProviderShare',
                'name' => 'Delete a Provider Share',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a provider share.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the provider share.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Provider Shares cdx/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_resend_cdx_v1_provider_share' => [
                'class' => 'ConfluentResendCdxV1ProviderShare',
                'method' => 'POST',
                'path' => '/cdx/v1/provider-shares/{id}:resend',
                'operation_id' => 'resendCdxV1ProviderShare',
                'name' => 'Resend',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Resend provider share',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the provider share.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Provider Shares cdx/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_cdx_v1_consumer_shared_resources' => [
                'class' => 'ConfluentListCdxV1ConsumerSharedResources',
                'method' => 'GET',
                'path' => '/cdx/v1/consumer-shared-resources',
                'operation_id' => 'listCdxV1ConsumerSharedResources',
                'name' => 'List of Consumer Shared Resources',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all consumer shared resources.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'stream_share',
                        'argument_name' => 'stream_share',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for streamshare.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'include_deleted',
                        'argument_name' => 'include_deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Include deactivated shared resources',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Consumer Shared Resources cdx/v1'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_get_cdx_v1_consumer_shared_resource' => [
                'class' => 'ConfluentGetCdxV1ConsumerSharedResource',
                'method' => 'GET',
                'path' => '/cdx/v1/consumer-shared-resources/{id}',
                'operation_id' => 'getCdxV1ConsumerSharedResource',
                'name' => 'Read a Consumer Shared Resource',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a consumer shared resource.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the consumer shared resource.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Consumer Shared Resources cdx/v1'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_image_cdx_v1_consumer_shared_resource' => [
                'class' => 'ConfluentImageCdxV1ConsumerSharedResource',
                'method' => 'GET',
                'path' => '/cdx/v1/consumer-shared-resources/{id}/images/{file_name}',
                'operation_id' => 'imageCdxV1ConsumerSharedResource',
                'name' => 'Get image for shared resource',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Returns the image file for the shared resource',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the consumer shared resource.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'file_name',
                        'argument_name' => 'file_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The File Name',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Consumer Shared Resources cdx/v1'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_network_cdx_v1_consumer_shared_resource' => [
                'class' => 'ConfluentNetworkCdxV1ConsumerSharedResource',
                'method' => 'GET',
                'path' => '/cdx/v1/consumer-shared-resources/{id}:network',
                'operation_id' => 'networkCdxV1ConsumerSharedResource',
                'name' => 'Get shared resource\'s network configuration',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Returns network information of the shared resource',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the consumer shared resource.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Consumer Shared Resources cdx/v1'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_list_cdx_v1_consumer_shares' => [
                'class' => 'ConfluentListCdxV1ConsumerShares',
                'method' => 'GET',
                'path' => '/cdx/v1/consumer-shares',
                'operation_id' => 'listCdxV1ConsumerShares',
                'name' => 'List of Consumer Shares',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all consumer shares.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'shared_resource',
                        'argument_name' => 'shared_resource',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for sharedresource.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'include_deleted',
                        'argument_name' => 'include_deleted',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Include deactivated shares',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Consumer Shares cdx/v1'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_get_cdx_v1_consumer_share' => [
                'class' => 'ConfluentGetCdxV1ConsumerShare',
                'method' => 'GET',
                'path' => '/cdx/v1/consumer-shares/{id}',
                'operation_id' => 'getCdxV1ConsumerShare',
                'name' => 'Read a Consumer Share',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a consumer share.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the consumer share.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Consumer Shares cdx/v1'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_delete_cdx_v1_consumer_share' => [
                'class' => 'ConfluentDeleteCdxV1ConsumerShare',
                'method' => 'DELETE',
                'path' => '/cdx/v1/consumer-shares/{id}',
                'operation_id' => 'deleteCdxV1ConsumerShare',
                'name' => 'Delete a Consumer Share',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a consumer share.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the consumer share.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Consumer Shares cdx/v1'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_resources_cdx_v1_shared_token' => [
                'class' => 'ConfluentResourcesCdxV1SharedToken',
                'method' => 'POST',
                'path' => '/cdx/v1/shared-tokens:resources',
                'operation_id' => 'resourcesCdxV1SharedToken',
                'name' => 'Validate token to view shared resources',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Validate and decrypt the shared token and view token\'s shared resources',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Shared Tokens cdx/v1'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_redeem_cdx_v1_shared_token' => [
                'class' => 'ConfluentRedeemCdxV1SharedToken',
                'method' => 'POST',
                'path' => '/cdx/v1/shared-tokens:redeem',
                'operation_id' => 'redeemCdxV1SharedToken',
                'name' => 'Redeem token',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Redeem the shared token for shared topic and cluster access information',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Shared Tokens cdx/v1'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_get_cdx_v1_opt_in' => [
                'class' => 'ConfluentGetCdxV1OptIn',
                'method' => 'GET',
                'path' => '/cdx/v1/opt-in',
                'operation_id' => 'getCdxV1OptIn',
                'name' => 'Read the organization\'s stream sharing opt-in settings',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Returns the organization\'s stream sharing opt-in settings.',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'Opt Ins cdx/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_cdx_v1_opt_in' => [
                'class' => 'ConfluentUpdateCdxV1OptIn',
                'method' => 'PATCH',
                'path' => '/cdx/v1/opt-in',
                'operation_id' => 'updateCdxV1OptIn',
                'name' => 'Set the organization\'s stream sharing opt-in settings',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Updates the organization\'s stream sharing opt-in settings.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Opt Ins cdx/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_partner_v2_organization' => [
                'class' => 'ConfluentGetPartnerV2Organization',
                'method' => 'GET',
                'path' => '/partner/v2/organizations/{id}',
                'operation_id' => 'getPartnerV2Organization',
                'name' => 'Read an Organization',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Partner v2https://img.shields.io/badge/-Request%20Access%20To%20Partner%20v2-%23bc8540mailto:ccloud-api-access+partner-v2-early-access@confluent.io?subject=Request%20to%20join%20partner/v2%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20partner/v2%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Make a request to read an organization.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Organizations partner/v2'
                ],
                'security' => [
                    'oauth'
                ]
            ],
            'confluent_list_partner_v2_organizations' => [
                'class' => 'ConfluentListPartnerV2Organizations',
                'method' => 'GET',
                'path' => '/partner/v2/organizations',
                'operation_id' => 'listPartnerV2Organizations',
                'name' => 'List of Organizations',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Partner v2https://img.shields.io/badge/-Request%20Access%20To%20Partner%20v2-%23bc8540mailto:ccloud-api-access+partner-v2-early-access@confluent.io?subject=Request%20to%20join%20partner/v2%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20partner/v2%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Retrieve a sorted, filtered, paginated list of all organizations.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Organizations partner/v2'
                ],
                'security' => [
                    'oauth'
                ]
            ],
            'confluent_signup' => [
                'class' => 'ConfluentSignup',
                'method' => 'POST',
                'path' => '/partner/v2/signup',
                'operation_id' => 'signup',
                'name' => 'Signup an Organization on behalf of a Customer',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Partner v2https://img.shields.io/badge/-Request%20Access%20To%20Partner%20v2-%23bc8540mailto:ccloud-api-access+partner-v2-early-access@confluent.io?subject=Request%20to%20join%20partner/v2%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20partner/v2%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Create an organization for a customer. You must pass in either an entitlement object reference a url to a previously created entitlement or entitlement details. If you pass in an entitlement object reference, we will link with the created entitlement. If you pass in the entitlement details, we will create the entitlement with the organization in a single transaction. If you pass in user details email, given name, and family name, we will create a user as well. If you do not pass in user details, you MUST call /partner/v2/signup/activate with user details to complete signup.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'dry_run',
                        'argument_name' => 'dry_run',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'If true, only perform validation of signup',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'A JSON object containing signup information',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Signup partner/v2'
                ],
                'security' => [
                    'oauth'
                ]
            ],
            'confluent_activate_signup' => [
                'class' => 'ConfluentActivateSignup',
                'method' => 'POST',
                'path' => '/partner/v2/signup/activate',
                'operation_id' => 'activateSignup',
                'name' => 'Activate an Incomplete Signup',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Partner v2https://img.shields.io/badge/-Request%20Access%20To%20Partner%20v2-%23bc8540mailto:ccloud-api-access+partner-v2-early-access@confluent.io?subject=Request%20to%20join%20partner/v2%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20partner/v2%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Creates a user in the organization previously created in /partner/v2/signup. This completes the signup process if you did not pass in user details to /partner/v2/signup. Calling this endpoint if the signup process has been completed will result in a 409 Conflict error.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'A JSON object containing signup information',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Signup partner/v2'
                ],
                'security' => [
                    'oauth'
                ]
            ],
            'confluent_signup_partner_v2_link' => [
                'class' => 'ConfluentSignupPartnerV2Link',
                'method' => 'POST',
                'path' => '/partner/v2/signup/link',
                'operation_id' => 'signupPartnerV2Link',
                'name' => 'Signup a Customer by Linking to an Existing Organization',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Partner v2https://img.shields.io/badge/-Request%20Access%20To%20Partner%20v2-%23bc8540mailto:ccloud-api-access+partner-v2-early-access@confluent.io?subject=Request%20to%20join%20partner/v2%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20partner/v2%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Signup a customer by linking a new entitlement to an existing Confluent Cloud organization.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'dry_run',
                        'argument_name' => 'dry_run',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'If true, only perform validation of signup',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'A JSON object containing signup information',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Signup partner/v2'
                ],
                'security' => [
                    'oauth'
                ]
            ],
            'confluent_list_networking_v1_networks' => [
                'class' => 'ConfluentListNetworkingV1Networks',
                'method' => 'GET',
                'path' => '/networking/v1/networks',
                'operation_id' => 'listNetworkingV1Networks',
                'name' => 'List of Networks',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all networks.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'spec.display_name',
                        'argument_name' => 'spec_display_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.displayname. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'spec.cloud',
                        'argument_name' => 'spec_cloud',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.cloud. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'spec.region',
                        'argument_name' => 'spec_region',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.region. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'spec.connection_types',
                        'argument_name' => 'spec_connection_types',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.connectiontypes. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'spec.cidr',
                        'argument_name' => 'spec_cidr',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.cidr. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'status.phase',
                        'argument_name' => 'status_phase',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for status.phase. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Networks networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_networking_v1_network' => [
                'class' => 'ConfluentCreateNetworkingV1Network',
                'method' => 'POST',
                'path' => '/networking/v1/networks',
                'operation_id' => 'createNetworkingV1Network',
                'name' => 'Create a Network',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a network.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Networks networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_networking_v1_network' => [
                'class' => 'ConfluentGetNetworkingV1Network',
                'method' => 'GET',
                'path' => '/networking/v1/networks/{id}',
                'operation_id' => 'getNetworkingV1Network',
                'name' => 'Read a Network',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a network.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the network.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Networks networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_networking_v1_network' => [
                'class' => 'ConfluentUpdateNetworkingV1Network',
                'method' => 'PATCH',
                'path' => '/networking/v1/networks/{id}',
                'operation_id' => 'updateNetworkingV1Network',
                'name' => 'Update a Network',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a network.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the network.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Networks networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_networking_v1_network' => [
                'class' => 'ConfluentDeleteNetworkingV1Network',
                'method' => 'DELETE',
                'path' => '/networking/v1/networks/{id}',
                'operation_id' => 'deleteNetworkingV1Network',
                'name' => 'Delete a Network',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a network.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the network.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Networks networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_networking_v1_peerings' => [
                'class' => 'ConfluentListNetworkingV1Peerings',
                'method' => 'GET',
                'path' => '/networking/v1/peerings',
                'operation_id' => 'listNetworkingV1Peerings',
                'name' => 'List of Peerings',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all peerings.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'spec.display_name',
                        'argument_name' => 'spec_display_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.displayname. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'status.phase',
                        'argument_name' => 'status_phase',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for status.phase. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.network',
                        'argument_name' => 'spec_network',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.network. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Peerings networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_networking_v1_peering' => [
                'class' => 'ConfluentCreateNetworkingV1Peering',
                'method' => 'POST',
                'path' => '/networking/v1/peerings',
                'operation_id' => 'createNetworkingV1Peering',
                'name' => 'Create a Peering',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a peering.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Peerings networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_networking_v1_peering' => [
                'class' => 'ConfluentGetNetworkingV1Peering',
                'method' => 'GET',
                'path' => '/networking/v1/peerings/{id}',
                'operation_id' => 'getNetworkingV1Peering',
                'name' => 'Read a Peering',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a peering.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the peering.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Peerings networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_networking_v1_peering' => [
                'class' => 'ConfluentUpdateNetworkingV1Peering',
                'method' => 'PATCH',
                'path' => '/networking/v1/peerings/{id}',
                'operation_id' => 'updateNetworkingV1Peering',
                'name' => 'Update a Peering',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a peering.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the peering.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Peerings networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_networking_v1_peering' => [
                'class' => 'ConfluentDeleteNetworkingV1Peering',
                'method' => 'DELETE',
                'path' => '/networking/v1/peerings/{id}',
                'operation_id' => 'deleteNetworkingV1Peering',
                'name' => 'Delete a Peering',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a peering.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the peering.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Peerings networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_networking_v1_transit_gateway_attachments' => [
                'class' => 'ConfluentListNetworkingV1TransitGatewayAttachments',
                'method' => 'GET',
                'path' => '/networking/v1/transit-gateway-attachments',
                'operation_id' => 'listNetworkingV1TransitGatewayAttachments',
                'name' => 'List of Transit Gateway Attachments',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all transit gateway attachments.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'spec.display_name',
                        'argument_name' => 'spec_display_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.displayname. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'status.phase',
                        'argument_name' => 'status_phase',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for status.phase. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.network',
                        'argument_name' => 'spec_network',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.network. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Transit Gateway Attachments networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_networking_v1_transit_gateway_attachment' => [
                'class' => 'ConfluentCreateNetworkingV1TransitGatewayAttachment',
                'method' => 'POST',
                'path' => '/networking/v1/transit-gateway-attachments',
                'operation_id' => 'createNetworkingV1TransitGatewayAttachment',
                'name' => 'Create a Transit Gateway Attachment',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a transit gateway attachment.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Transit Gateway Attachments networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_networking_v1_transit_gateway_attachment' => [
                'class' => 'ConfluentGetNetworkingV1TransitGatewayAttachment',
                'method' => 'GET',
                'path' => '/networking/v1/transit-gateway-attachments/{id}',
                'operation_id' => 'getNetworkingV1TransitGatewayAttachment',
                'name' => 'Read a Transit Gateway Attachment',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a transit gateway attachment.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the transit gateway attachment.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Transit Gateway Attachments networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_networking_v1_transit_gateway_attachment' => [
                'class' => 'ConfluentUpdateNetworkingV1TransitGatewayAttachment',
                'method' => 'PATCH',
                'path' => '/networking/v1/transit-gateway-attachments/{id}',
                'operation_id' => 'updateNetworkingV1TransitGatewayAttachment',
                'name' => 'Update a Transit Gateway Attachment',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a transit gateway attachment.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the transit gateway attachment.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Transit Gateway Attachments networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_networking_v1_transit_gateway_attachment' => [
                'class' => 'ConfluentDeleteNetworkingV1TransitGatewayAttachment',
                'method' => 'DELETE',
                'path' => '/networking/v1/transit-gateway-attachments/{id}',
                'operation_id' => 'deleteNetworkingV1TransitGatewayAttachment',
                'name' => 'Delete a Transit Gateway Attachment',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a transit gateway attachment.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the transit gateway attachment.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Transit Gateway Attachments networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_networking_v1_private_link_accesses' => [
                'class' => 'ConfluentListNetworkingV1PrivateLinkAccesses',
                'method' => 'GET',
                'path' => '/networking/v1/private-link-accesses',
                'operation_id' => 'listNetworkingV1PrivateLinkAccesses',
                'name' => 'List of Private Link Accesses',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all private link accesses.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'spec.display_name',
                        'argument_name' => 'spec_display_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.displayname. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'status.phase',
                        'argument_name' => 'status_phase',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for status.phase. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.network',
                        'argument_name' => 'spec_network',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.network. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Private Link Accesses networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_networking_v1_private_link_access' => [
                'class' => 'ConfluentCreateNetworkingV1PrivateLinkAccess',
                'method' => 'POST',
                'path' => '/networking/v1/private-link-accesses',
                'operation_id' => 'createNetworkingV1PrivateLinkAccess',
                'name' => 'Create a Private Link Access',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a private link access.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Private Link Accesses networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_networking_v1_private_link_access' => [
                'class' => 'ConfluentGetNetworkingV1PrivateLinkAccess',
                'method' => 'GET',
                'path' => '/networking/v1/private-link-accesses/{id}',
                'operation_id' => 'getNetworkingV1PrivateLinkAccess',
                'name' => 'Read a Private Link Access',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a private link access.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the private link access.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Private Link Accesses networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_networking_v1_private_link_access' => [
                'class' => 'ConfluentUpdateNetworkingV1PrivateLinkAccess',
                'method' => 'PATCH',
                'path' => '/networking/v1/private-link-accesses/{id}',
                'operation_id' => 'updateNetworkingV1PrivateLinkAccess',
                'name' => 'Update a Private Link Access',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a private link access.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the private link access.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Private Link Accesses networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_networking_v1_private_link_access' => [
                'class' => 'ConfluentDeleteNetworkingV1PrivateLinkAccess',
                'method' => 'DELETE',
                'path' => '/networking/v1/private-link-accesses/{id}',
                'operation_id' => 'deleteNetworkingV1PrivateLinkAccess',
                'name' => 'Delete a Private Link Access',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a private link access.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the private link access.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Private Link Accesses networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_networking_v1_network_link_services' => [
                'class' => 'ConfluentListNetworkingV1NetworkLinkServices',
                'method' => 'GET',
                'path' => '/networking/v1/network-link-services',
                'operation_id' => 'listNetworkingV1NetworkLinkServices',
                'name' => 'List of Network Link Services',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all network link services.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'spec.display_name',
                        'argument_name' => 'spec_display_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.displayname. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'status.phase',
                        'argument_name' => 'status_phase',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for status.phase. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.network',
                        'argument_name' => 'spec_network',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.network. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Network Link Services networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_networking_v1_network_link_service' => [
                'class' => 'ConfluentCreateNetworkingV1NetworkLinkService',
                'method' => 'POST',
                'path' => '/networking/v1/network-link-services',
                'operation_id' => 'createNetworkingV1NetworkLinkService',
                'name' => 'Create a Network Link Service',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a network link service.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Network Link Services networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_networking_v1_network_link_service' => [
                'class' => 'ConfluentGetNetworkingV1NetworkLinkService',
                'method' => 'GET',
                'path' => '/networking/v1/network-link-services/{id}',
                'operation_id' => 'getNetworkingV1NetworkLinkService',
                'name' => 'Read a Network Link Service',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a network link service.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the network link service.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Network Link Services networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_networking_v1_network_link_service' => [
                'class' => 'ConfluentUpdateNetworkingV1NetworkLinkService',
                'method' => 'PATCH',
                'path' => '/networking/v1/network-link-services/{id}',
                'operation_id' => 'updateNetworkingV1NetworkLinkService',
                'name' => 'Update a Network Link Service',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a network link service.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the network link service.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Network Link Services networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_networking_v1_network_link_service' => [
                'class' => 'ConfluentDeleteNetworkingV1NetworkLinkService',
                'method' => 'DELETE',
                'path' => '/networking/v1/network-link-services/{id}',
                'operation_id' => 'deleteNetworkingV1NetworkLinkService',
                'name' => 'Delete a Network Link Service',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a network link service.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the network link service.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Network Link Services networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_networking_v1_network_link_endpoints' => [
                'class' => 'ConfluentListNetworkingV1NetworkLinkEndpoints',
                'method' => 'GET',
                'path' => '/networking/v1/network-link-endpoints',
                'operation_id' => 'listNetworkingV1NetworkLinkEndpoints',
                'name' => 'List of Network Link Endpoints',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all network link endpoints.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'spec.display_name',
                        'argument_name' => 'spec_display_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.displayname. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'status.phase',
                        'argument_name' => 'status_phase',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for status.phase. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.network',
                        'argument_name' => 'spec_network',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.network. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'spec.network_link_service',
                        'argument_name' => 'spec_network_link_service',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.networklinkservice. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Network Link Endpoints networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_networking_v1_network_link_endpoint' => [
                'class' => 'ConfluentCreateNetworkingV1NetworkLinkEndpoint',
                'method' => 'POST',
                'path' => '/networking/v1/network-link-endpoints',
                'operation_id' => 'createNetworkingV1NetworkLinkEndpoint',
                'name' => 'Create a Network Link Endpoint',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a network link endpoint.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Network Link Endpoints networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_networking_v1_network_link_endpoint' => [
                'class' => 'ConfluentGetNetworkingV1NetworkLinkEndpoint',
                'method' => 'GET',
                'path' => '/networking/v1/network-link-endpoints/{id}',
                'operation_id' => 'getNetworkingV1NetworkLinkEndpoint',
                'name' => 'Read a Network Link Endpoint',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a network link endpoint.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the network link endpoint.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Network Link Endpoints networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_networking_v1_network_link_endpoint' => [
                'class' => 'ConfluentUpdateNetworkingV1NetworkLinkEndpoint',
                'method' => 'PATCH',
                'path' => '/networking/v1/network-link-endpoints/{id}',
                'operation_id' => 'updateNetworkingV1NetworkLinkEndpoint',
                'name' => 'Update a Network Link Endpoint',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a network link endpoint.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the network link endpoint.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Network Link Endpoints networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_networking_v1_network_link_endpoint' => [
                'class' => 'ConfluentDeleteNetworkingV1NetworkLinkEndpoint',
                'method' => 'DELETE',
                'path' => '/networking/v1/network-link-endpoints/{id}',
                'operation_id' => 'deleteNetworkingV1NetworkLinkEndpoint',
                'name' => 'Delete a Network Link Endpoint',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a network link endpoint.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the network link endpoint.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Network Link Endpoints networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_networking_v1_network_link_service_associations' => [
                'class' => 'ConfluentListNetworkingV1NetworkLinkServiceAssociations',
                'method' => 'GET',
                'path' => '/networking/v1/network-link-service-associations',
                'operation_id' => 'listNetworkingV1NetworkLinkServiceAssociations',
                'name' => 'List of Network Link Service Associations',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all network link service associations.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'status.phase',
                        'argument_name' => 'status_phase',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for status.phase. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'spec.network_link_service',
                        'argument_name' => 'spec_network_link_service',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for spec.networklinkservice.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Network Link Service Associations networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_networking_v1_network_link_service_association' => [
                'class' => 'ConfluentGetNetworkingV1NetworkLinkServiceAssociation',
                'method' => 'GET',
                'path' => '/networking/v1/network-link-service-associations/{id}',
                'operation_id' => 'getNetworkingV1NetworkLinkServiceAssociation',
                'name' => 'Read a Network Link Service Association',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a network link service association.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'spec.network_link_service',
                        'argument_name' => 'spec_network_link_service',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given spec.networklinkservice.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the network link service association.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Network Link Service Associations networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_networking_v1_ip_addresses' => [
                'class' => 'ConfluentListNetworkingV1IPAddresses',
                'method' => 'GET',
                'path' => '/networking/v1/ip-addresses',
                'operation_id' => 'listNetworkingV1IpAddresses',
                'name' => 'List of IP Addresses',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Related guide: Use Public Egress IP addresses on Confluent Cloudhttps://docs.confluent.io/cloud/current/networking/static-egress-ip-addresses.html Retrieve a sorted, filtered, paginated list of all IP Addresses.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cloud',
                        'argument_name' => 'cloud',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for cloud. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'region',
                        'argument_name' => 'region',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for region. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'services',
                        'argument_name' => 'services',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for services. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'address_type',
                        'argument_name' => 'address_type',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for addresstype. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'IP Addresses networking/v1'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_list_networking_v1_private_link_attachments' => [
                'class' => 'ConfluentListNetworkingV1PrivateLinkAttachments',
                'method' => 'GET',
                'path' => '/networking/v1/private-link-attachments',
                'operation_id' => 'listNetworkingV1PrivateLinkAttachments',
                'name' => 'List of Private Link Attachments',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all private link attachments.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'spec.display_name',
                        'argument_name' => 'spec_display_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.displayname. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'spec.cloud',
                        'argument_name' => 'spec_cloud',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.cloud. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'spec.region',
                        'argument_name' => 'spec_region',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.region. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'status.phase',
                        'argument_name' => 'status_phase',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for status.phase. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Private Link Attachments networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_networking_v1_private_link_attachment' => [
                'class' => 'ConfluentCreateNetworkingV1PrivateLinkAttachment',
                'method' => 'POST',
                'path' => '/networking/v1/private-link-attachments',
                'operation_id' => 'createNetworkingV1PrivateLinkAttachment',
                'name' => 'Create a Private Link Attachment',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a private link attachment.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Private Link Attachments networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_networking_v1_private_link_attachment' => [
                'class' => 'ConfluentGetNetworkingV1PrivateLinkAttachment',
                'method' => 'GET',
                'path' => '/networking/v1/private-link-attachments/{id}',
                'operation_id' => 'getNetworkingV1PrivateLinkAttachment',
                'name' => 'Read a Private Link Attachment',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a private link attachment.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the private link attachment.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Private Link Attachments networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_networking_v1_private_link_attachment' => [
                'class' => 'ConfluentUpdateNetworkingV1PrivateLinkAttachment',
                'method' => 'PATCH',
                'path' => '/networking/v1/private-link-attachments/{id}',
                'operation_id' => 'updateNetworkingV1PrivateLinkAttachment',
                'name' => 'Update a Private Link Attachment',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a private link attachment.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the private link attachment.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Private Link Attachments networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_networking_v1_private_link_attachment' => [
                'class' => 'ConfluentDeleteNetworkingV1PrivateLinkAttachment',
                'method' => 'DELETE',
                'path' => '/networking/v1/private-link-attachments/{id}',
                'operation_id' => 'deleteNetworkingV1PrivateLinkAttachment',
                'name' => 'Delete a Private Link Attachment',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a private link attachment.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the private link attachment.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Private Link Attachments networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_networking_v1_private_link_attachment_connections' => [
                'class' => 'ConfluentListNetworkingV1PrivateLinkAttachmentConnections',
                'method' => 'GET',
                'path' => '/networking/v1/private-link-attachment-connections',
                'operation_id' => 'listNetworkingV1PrivateLinkAttachmentConnections',
                'name' => 'List of Private Link Attachment Connections',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all private link attachment connections.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.private_link_attachment',
                        'argument_name' => 'spec_private_link_attachment',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.privatelinkattachment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Private Link Attachment Connections networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_networking_v1_private_link_attachment_connection' => [
                'class' => 'ConfluentCreateNetworkingV1PrivateLinkAttachmentConnection',
                'method' => 'POST',
                'path' => '/networking/v1/private-link-attachment-connections',
                'operation_id' => 'createNetworkingV1PrivateLinkAttachmentConnection',
                'name' => 'Create a Private Link Attachment Connection',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a private link attachment connection.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Private Link Attachment Connections networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_networking_v1_private_link_attachment_connection' => [
                'class' => 'ConfluentGetNetworkingV1PrivateLinkAttachmentConnection',
                'method' => 'GET',
                'path' => '/networking/v1/private-link-attachment-connections/{id}',
                'operation_id' => 'getNetworkingV1PrivateLinkAttachmentConnection',
                'name' => 'Read a Private Link Attachment Connection',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a private link attachment connection.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the private link attachment connection.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Private Link Attachment Connections networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_networking_v1_private_link_attachment_connection' => [
                'class' => 'ConfluentUpdateNetworkingV1PrivateLinkAttachmentConnection',
                'method' => 'PATCH',
                'path' => '/networking/v1/private-link-attachment-connections/{id}',
                'operation_id' => 'updateNetworkingV1PrivateLinkAttachmentConnection',
                'name' => 'Update a Private Link Attachment Connection',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a private link attachment connection.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the private link attachment connection.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Private Link Attachment Connections networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_networking_v1_private_link_attachment_connection' => [
                'class' => 'ConfluentDeleteNetworkingV1PrivateLinkAttachmentConnection',
                'method' => 'DELETE',
                'path' => '/networking/v1/private-link-attachment-connections/{id}',
                'operation_id' => 'deleteNetworkingV1PrivateLinkAttachmentConnection',
                'name' => 'Delete a Private Link Attachment Connection',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a private link attachment connection.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the private link attachment connection.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Private Link Attachment Connections networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_iam_v2_identity_providers' => [
                'class' => 'ConfluentListIAMV2IdentityProviders',
                'method' => 'GET',
                'path' => '/iam/v2/identity-providers',
                'operation_id' => 'listIamV2IdentityProviders',
                'name' => 'List of Identity Providers',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all identity providers.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Identity Providers iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_iam_v2_identity_provider' => [
                'class' => 'ConfluentCreateIAMV2IdentityProvider',
                'method' => 'POST',
                'path' => '/iam/v2/identity-providers',
                'operation_id' => 'createIamV2IdentityProvider',
                'name' => 'Create an Identity Provider',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create an identity provider.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Identity Providers iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_iam_v2_identity_provider' => [
                'class' => 'ConfluentGetIAMV2IdentityProvider',
                'method' => 'GET',
                'path' => '/iam/v2/identity-providers/{id}',
                'operation_id' => 'getIamV2IdentityProvider',
                'name' => 'Read an Identity Provider',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read an identity provider.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the identity provider.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Identity Providers iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_iam_v2_identity_provider' => [
                'class' => 'ConfluentUpdateIAMV2IdentityProvider',
                'method' => 'PATCH',
                'path' => '/iam/v2/identity-providers/{id}',
                'operation_id' => 'updateIamV2IdentityProvider',
                'name' => 'Update an Identity Provider',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update an identity provider.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the identity provider.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Identity Providers iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_iam_v2_identity_provider' => [
                'class' => 'ConfluentDeleteIAMV2IdentityProvider',
                'method' => 'DELETE',
                'path' => '/iam/v2/identity-providers/{id}',
                'operation_id' => 'deleteIamV2IdentityProvider',
                'name' => 'Delete an Identity Provider',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete an identity provider.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the identity provider.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Identity Providers iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_refresh_iam_v2_json_web_key_set' => [
                'class' => 'ConfluentRefreshIAMV2JsonWebKeySet',
                'method' => 'PATCH',
                'path' => '/iam/v2/identity-providers/{provider_id}/jwks',
                'operation_id' => 'refreshIamV2JsonWebKeySet',
                'name' => 'Refresh a provider\'s JWKS',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to refresh the provider\'s JWKS',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'provider_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Provider',
                        'schema_type' => 'string',
                        'aliases' => [
                            'provider_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Jwks iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_iam_v2_identity_pools' => [
                'class' => 'ConfluentListIAMV2IdentityPools',
                'method' => 'GET',
                'path' => '/iam/v2/identity-providers/{provider_id}/identity-pools',
                'operation_id' => 'listIamV2IdentityPools',
                'name' => 'List of Identity Pools',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all identity pools.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'provider_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Provider',
                        'schema_type' => 'string',
                        'aliases' => [
                            'provider_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Identity Pools iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_iam_v2_identity_pool' => [
                'class' => 'ConfluentCreateIAMV2IdentityPool',
                'method' => 'POST',
                'path' => '/iam/v2/identity-providers/{provider_id}/identity-pools',
                'operation_id' => 'createIamV2IdentityPool',
                'name' => 'Create an Identity Pool',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create an identity pool.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'assigned_resource_owner',
                        'argument_name' => 'assigned_resource_owner',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The resourceid of the principal who will be assigned resource owner on the created identity pool. Principal can be group-mapping group-xxx, user u-xxx, service-account sa-xxx or identity-pool pool-xxx.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'provider_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Provider',
                        'schema_type' => 'string',
                        'aliases' => [
                            'provider_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Identity Pools iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_iam_v2_identity_pool' => [
                'class' => 'ConfluentGetIAMV2IdentityPool',
                'method' => 'GET',
                'path' => '/iam/v2/identity-providers/{provider_id}/identity-pools/{id}',
                'operation_id' => 'getIamV2IdentityPool',
                'name' => 'Read an Identity Pool',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read an identity pool.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'provider_id',
                        'argument_name' => 'provider_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Provider',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the identity pool.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Identity Pools iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_iam_v2_identity_pool' => [
                'class' => 'ConfluentUpdateIAMV2IdentityPool',
                'method' => 'PATCH',
                'path' => '/iam/v2/identity-providers/{provider_id}/identity-pools/{id}',
                'operation_id' => 'updateIamV2IdentityPool',
                'name' => 'Update an Identity Pool',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update an identity pool.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'provider_id',
                        'argument_name' => 'provider_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Provider',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the identity pool.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Identity Pools iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_iam_v2_identity_pool' => [
                'class' => 'ConfluentDeleteIAMV2IdentityPool',
                'method' => 'DELETE',
                'path' => '/iam/v2/identity-providers/{provider_id}/identity-pools/{id}',
                'operation_id' => 'deleteIamV2IdentityPool',
                'name' => 'Delete an Identity Pool',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete an identity pool.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'provider_id',
                        'argument_name' => 'provider_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Provider',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the identity pool.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Identity Pools iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_exchange_sts_v1_oauth_token' => [
                'class' => 'ConfluentExchangeSTSV1OauthToken',
                'method' => 'POST',
                'path' => '/sts/v1/oauth2/token',
                'operation_id' => 'exchangeStsV1OauthToken',
                'name' => 'Exchange an OAuth Token',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Use this operation to exchange an access token JWT issued by an external identity provider for an access token JWT issued by Confluent.This enables the use of external identities to access Confluent Cloud APIs.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'OAuth Tokens sts/v1'
                ],
                'security' => []
            ],
            'confluent_list_kafka_quotas_v1_client_quotas' => [
                'class' => 'ConfluentListKafkaQuotasV1ClientQuotas',
                'method' => 'GET',
                'path' => '/kafka-quotas/v1/client-quotas',
                'operation_id' => 'listKafkaQuotasV1ClientQuotas',
                'name' => 'List of Client Quotas',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all client quotas.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'spec.cluster',
                        'argument_name' => 'spec_cluster',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for spec.cluster.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Client Quotas kafka-quotas/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_kafka_quotas_v1_client_quota' => [
                'class' => 'ConfluentCreateKafkaQuotasV1ClientQuota',
                'method' => 'POST',
                'path' => '/kafka-quotas/v1/client-quotas',
                'operation_id' => 'createKafkaQuotasV1ClientQuota',
                'name' => 'Create a Client Quota',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a client quota.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => true,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'string'
                ],
                'tags' => [
                    'Client Quotas kafka-quotas/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_kafka_quotas_v1_client_quota' => [
                'class' => 'ConfluentGetKafkaQuotasV1ClientQuota',
                'method' => 'GET',
                'path' => '/kafka-quotas/v1/client-quotas/{id}',
                'operation_id' => 'getKafkaQuotasV1ClientQuota',
                'name' => 'Read a Client Quota',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a client quota.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the client quota.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Client Quotas kafka-quotas/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_kafka_quotas_v1_client_quota' => [
                'class' => 'ConfluentUpdateKafkaQuotasV1ClientQuota',
                'method' => 'PATCH',
                'path' => '/kafka-quotas/v1/client-quotas/{id}',
                'operation_id' => 'updateKafkaQuotasV1ClientQuota',
                'name' => 'Update a Client Quota',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a client quota.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the client quota.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Client Quotas kafka-quotas/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_kafka_quotas_v1_client_quota' => [
                'class' => 'ConfluentDeleteKafkaQuotasV1ClientQuota',
                'method' => 'DELETE',
                'path' => '/kafka-quotas/v1/client-quotas/{id}',
                'operation_id' => 'deleteKafkaQuotasV1ClientQuota',
                'name' => 'Delete a Client Quota',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a client quota.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the client quota.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Client Quotas kafka-quotas/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_byok_v1_keys' => [
                'class' => 'ConfluentListBYOKV1Keys',
                'method' => 'GET',
                'path' => '/byok/v1/keys',
                'operation_id' => 'listByokV1Keys',
                'name' => 'List of Keys',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all keys.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'display_name',
                        'argument_name' => 'display_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by a partial search of displayname.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'provider',
                        'argument_name' => 'provider',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for provider.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'state',
                        'argument_name' => 'state',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for state.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'validation_phase',
                        'argument_name' => 'validation_phase',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for validationphase.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'validation_region',
                        'argument_name' => 'validation_region',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter keys by the cloud region where they are deployed.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'key',
                        'argument_name' => 'key',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filters results by a partial match on the key identifier: keyarn for AWS, keyid for Azure and GCP.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Keys byok/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_byok_v1_key' => [
                'class' => 'ConfluentCreateBYOKV1Key',
                'method' => 'POST',
                'path' => '/byok/v1/keys',
                'operation_id' => 'createByokV1Key',
                'name' => 'Create a Key',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a key.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Keys byok/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_byok_v1_key' => [
                'class' => 'ConfluentGetBYOKV1Key',
                'method' => 'GET',
                'path' => '/byok/v1/keys/{id}',
                'operation_id' => 'getByokV1Key',
                'name' => 'Read a Key',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a key.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the key.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Keys byok/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_byok_v1_key' => [
                'class' => 'ConfluentUpdateBYOKV1Key',
                'method' => 'PATCH',
                'path' => '/byok/v1/keys/{id}',
                'operation_id' => 'updateByokV1Key',
                'name' => 'Update a Key',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a key.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the key.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Keys byok/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_byok_v1_key' => [
                'class' => 'ConfluentDeleteBYOKV1Key',
                'method' => 'DELETE',
                'path' => '/byok/v1/keys/{id}',
                'operation_id' => 'deleteByokV1Key',
                'name' => 'Delete a Key',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a key.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the key.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Keys byok/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_billing_v1_costs' => [
                'class' => 'ConfluentListBillingV1Costs',
                'method' => 'GET',
                'path' => '/billing/v1/costs',
                'operation_id' => 'listBillingV1Costs',
                'name' => 'List of Costs',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all costs.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'start_date',
                        'argument_name' => 'start_date',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for startdate.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'end_date',
                        'argument_name' => 'end_date',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for enddate.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Costs billing/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_iam_v2_sso_group_mappings' => [
                'class' => 'ConfluentListIAMV2SsoGroupMappings',
                'method' => 'GET',
                'path' => '/iam/v2/sso/group-mappings',
                'operation_id' => 'listIamV2SsoGroupMappings',
                'name' => 'List of Group Mappings',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all group mappings.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Group Mappings iam/v2/sso'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_iam_v2_sso_group_mapping' => [
                'class' => 'ConfluentCreateIAMV2SsoGroupMapping',
                'method' => 'POST',
                'path' => '/iam/v2/sso/group-mappings',
                'operation_id' => 'createIamV2SsoGroupMapping',
                'name' => 'Create a Group Mapping',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a group mapping.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Group Mappings iam/v2/sso'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_iam_v2_sso_group_mapping' => [
                'class' => 'ConfluentGetIAMV2SsoGroupMapping',
                'method' => 'GET',
                'path' => '/iam/v2/sso/group-mappings/{id}',
                'operation_id' => 'getIamV2SsoGroupMapping',
                'name' => 'Read a Group Mapping',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a group mapping.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the group mapping.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Group Mappings iam/v2/sso'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_iam_v2_sso_group_mapping' => [
                'class' => 'ConfluentUpdateIAMV2SsoGroupMapping',
                'method' => 'PATCH',
                'path' => '/iam/v2/sso/group-mappings/{id}',
                'operation_id' => 'updateIamV2SsoGroupMapping',
                'name' => 'Update a Group Mapping',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a group mapping.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the group mapping.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Group Mappings iam/v2/sso'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_iam_v2_sso_group_mapping' => [
                'class' => 'ConfluentDeleteIAMV2SsoGroupMapping',
                'method' => 'DELETE',
                'path' => '/iam/v2/sso/group-mappings/{id}',
                'operation_id' => 'deleteIamV2SsoGroupMapping',
                'name' => 'Delete a Group Mapping',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a group mapping.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the group mapping.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Group Mappings iam/v2/sso'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_fcpm_v2_compute_pools' => [
                'class' => 'ConfluentListFcpmV2ComputePools',
                'method' => 'GET',
                'path' => '/fcpm/v2/compute-pools',
                'operation_id' => 'listFcpmV2ComputePools',
                'name' => 'List of Compute Pools',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all compute pools.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'spec.region',
                        'argument_name' => 'spec_region',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.region.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.network',
                        'argument_name' => 'spec_network',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.network.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Compute Pools fcpm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_fcpm_v2_compute_pool' => [
                'class' => 'ConfluentCreateFcpmV2ComputePool',
                'method' => 'POST',
                'path' => '/fcpm/v2/compute-pools',
                'operation_id' => 'createFcpmV2ComputePool',
                'name' => 'Create a Compute Pool',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a compute pool.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Compute Pools fcpm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_fcpm_v2_compute_pool' => [
                'class' => 'ConfluentGetFcpmV2ComputePool',
                'method' => 'GET',
                'path' => '/fcpm/v2/compute-pools/{id}',
                'operation_id' => 'getFcpmV2ComputePool',
                'name' => 'Read a Compute Pool',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a compute pool.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the compute pool.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Compute Pools fcpm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_fcpm_v2_compute_pool' => [
                'class' => 'ConfluentUpdateFcpmV2ComputePool',
                'method' => 'PATCH',
                'path' => '/fcpm/v2/compute-pools/{id}',
                'operation_id' => 'updateFcpmV2ComputePool',
                'name' => 'Update a Compute Pool',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a compute pool.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the compute pool.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Compute Pools fcpm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_fcpm_v2_compute_pool' => [
                'class' => 'ConfluentDeleteFcpmV2ComputePool',
                'method' => 'DELETE',
                'path' => '/fcpm/v2/compute-pools/{id}',
                'operation_id' => 'deleteFcpmV2ComputePool',
                'name' => 'Delete a Compute Pool',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a compute pool.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the compute pool.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Compute Pools fcpm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_fcpm_v2_regions' => [
                'class' => 'ConfluentListFcpmV2Regions',
                'method' => 'GET',
                'path' => '/fcpm/v2/regions',
                'operation_id' => 'listFcpmV2Regions',
                'name' => 'List of Regions',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all regions.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cloud',
                        'argument_name' => 'cloud',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for cloud.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'region_name',
                        'argument_name' => 'region_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for regionname.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Regions fcpm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_fcpm_v2_org_compute_pool_config' => [
                'class' => 'ConfluentGetFcpmV2OrgComputePoolConfig',
                'method' => 'GET',
                'path' => '/fcpm/v2/compute-pool-config',
                'operation_id' => 'getFcpmV2OrgComputePoolConfig',
                'name' => 'Read an Org Compute Pool Config',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read an org compute pool config.',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'Org Compute Pool Configs fcpm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_fcpm_v2_org_compute_pool_config' => [
                'class' => 'ConfluentUpdateFcpmV2OrgComputePoolConfig',
                'method' => 'PATCH',
                'path' => '/fcpm/v2/compute-pool-config',
                'operation_id' => 'updateFcpmV2OrgComputePoolConfig',
                'name' => 'Update an Org Compute Pool Config',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update an org compute pool config.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Org Compute Pool Configs fcpm/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_sqlv1_connections' => [
                'class' => 'ConfluentListSqlv1Connections',
                'method' => 'GET',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/connections',
                'operation_id' => 'listSqlv1Connections',
                'name' => 'List of Connections',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered and paginated list of all Connections.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.connection_type',
                        'argument_name' => 'spec_connection_type',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.connectiontype',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Connections sql/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_create_sqlv1_connection' => [
                'class' => 'ConfluentCreateSqlv1Connection',
                'method' => 'POST',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/connections',
                'operation_id' => 'createSqlv1Connection',
                'name' => 'Create a Connection',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Make a request to create a Connection.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Connections sql/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_get_sqlv1_connection' => [
                'class' => 'ConfluentGetSqlv1Connection',
                'method' => 'GET',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/connections/{connection_name}',
                'operation_id' => 'getSqlv1Connection',
                'name' => 'Read a Connection',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Make a request to read a Connection.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'connection_name',
                        'argument_name' => 'connection_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The user provided name of the Connection. Unique within a region within an org and env.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Connections sql/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_delete_sqlv1_connection' => [
                'class' => 'ConfluentDeleteSqlv1Connection',
                'method' => 'DELETE',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/connections/{connection_name}',
                'operation_id' => 'deleteSqlv1Connection',
                'name' => 'Delete a Connection',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Make a request to delete a statement.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'connection_name',
                        'argument_name' => 'connection_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the connection.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Connections sql/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_update_sqlv1_connection' => [
                'class' => 'ConfluentUpdateSqlv1Connection',
                'method' => 'PUT',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/connections/{connection_name}',
                'operation_id' => 'updateSqlv1Connection',
                'name' => 'Update a Connection',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Make a request to update a connection.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'connection_name',
                        'argument_name' => 'connection_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the connection.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Connections sql/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_get_sqlv1_statement_result' => [
                'class' => 'ConfluentGetSqlv1StatementResult',
                'method' => 'GET',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/statements/{name}/results',
                'operation_id' => 'getSqlv1StatementResult',
                'name' => 'Read Statement Result',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Read Statement Result.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the statement.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'It contains the field offset in the CollectSinkFunction protocol. On the first request, it should be unset. The offset is assumed to start at 0.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Statement Results sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_sqlv1_statements' => [
                'class' => 'ConfluentListSqlv1Statements',
                'method' => 'GET',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/statements',
                'operation_id' => 'listSqlv1Statements',
                'name' => 'List of Statements',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all statements.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.compute_pool_id',
                        'argument_name' => 'spec_compute_pool_id',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.computepoolid. When creating statements, if computepoolid is not specified, the statement will use the default compute pool. The default pool is automatically determined by the system.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'label_selector',
                        'argument_name' => 'label_selector',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A comma-separated label selector to filter the statements.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Statements sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_create_sqlv1_statement' => [
                'class' => 'ConfluentCreateSqlv1Statement',
                'method' => 'POST',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/statements',
                'operation_id' => 'createSqlv1Statement',
                'name' => 'Create a Statement',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a statement.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Statements sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_sqlv1_statement' => [
                'class' => 'ConfluentGetSqlv1Statement',
                'method' => 'GET',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/statements/{statement_name}',
                'operation_id' => 'getSqlv1Statement',
                'name' => 'Read a Statement',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a statement.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'statement_name',
                        'argument_name' => 'statement_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the statement.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Statements sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_sqlv1_statement' => [
                'class' => 'ConfluentDeleteSqlv1Statement',
                'method' => 'DELETE',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/statements/{statement_name}',
                'operation_id' => 'deleteSqlv1Statement',
                'name' => 'Delete a Statement',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a statement.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'statement_name',
                        'argument_name' => 'statement_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the statement.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Statements sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_sqlv1_statement' => [
                'class' => 'ConfluentUpdateSqlv1Statement',
                'method' => 'PUT',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/statements/{statement_name}',
                'operation_id' => 'updateSqlv1Statement',
                'name' => 'Update a Statement',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a statement. The request will fail with a 409 Conflict error if the Statement has changed since it was fetched. In this case, do a GET, reapply the modifications, and try the update again.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'statement_name',
                        'argument_name' => 'statement_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the statement.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Statements sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_patch_sqlv1_statement' => [
                'class' => 'ConfluentPatchSqlv1Statement',
                'method' => 'PATCH',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/statements/{statement_name}',
                'operation_id' => 'patchSqlv1Statement',
                'name' => 'Patch a Statement',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to patch a statement.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'statement_name',
                        'argument_name' => 'statement_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the statement.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'array',
                    'items' => [
                        'type' => 'object'
                    ]
                ],
                'tags' => [
                    'Statements sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_sqlv1_statement_exceptions' => [
                'class' => 'ConfluentGetSqlv1StatementExceptions',
                'method' => 'GET',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/statements/{statement_name}/exceptions',
                'operation_id' => 'getSqlv1StatementExceptions',
                'name' => 'List of Statement Exceptions',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a list of the 10 most recent statement exceptions.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'statement_name',
                        'argument_name' => 'statement_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the statement.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Statement Exceptions sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_sqlv1_materialized_tables' => [
                'class' => 'ConfluentListSqlv1MaterializedTables',
                'method' => 'GET',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/materialized-tables',
                'operation_id' => 'listSqlv1MaterializedTables',
                'name' => 'List all materialized tables',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted and paginated list of all materialized tables.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Materialized Tables sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_create_sqlv1_materialized_table' => [
                'class' => 'ConfluentCreateSqlv1MaterializedTable',
                'method' => 'POST',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/databases/{kafka_cluster_id}/materialized-tables',
                'operation_id' => 'createSqlv1MaterializedTable',
                'name' => 'Create a materialized table',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Create a new Materialized Table.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the database.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => true,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Materialized Tables sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_sqlv1_materialized_table' => [
                'class' => 'ConfluentGetSqlv1MaterializedTable',
                'method' => 'GET',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/databases/{kafka_cluster_id}/materialized-tables/{table_name}',
                'operation_id' => 'getSqlv1MaterializedTable',
                'name' => 'Read a materialized table',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a specific Materialized Table by name.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the database.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'table_name',
                        'argument_name' => 'table_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Materialized Table',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Materialized Tables sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_sqlv1_materialized_table' => [
                'class' => 'ConfluentUpdateSqlv1MaterializedTable',
                'method' => 'PUT',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/databases/{kafka_cluster_id}/materialized-tables/{table_name}',
                'operation_id' => 'updateSqlv1MaterializedTable',
                'name' => 'Update/Evolve a materialized table',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a Materialized Table\'s mutable fields. Mutable fields include: query, stopped, computepoolid, principal, columns, watermark, constraints and tableoptions.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the database.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'table_name',
                        'argument_name' => 'table_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Materialized Table',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => true,
                    'description' => 'The Materialized Table resource with updated spec fields.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Materialized Tables sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_sqlv1_materialized_table' => [
                'class' => 'ConfluentDeleteSqlv1MaterializedTable',
                'method' => 'DELETE',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/databases/{kafka_cluster_id}/materialized-tables/{table_name}',
                'operation_id' => 'deleteSqlv1MaterializedTable',
                'name' => 'Delete a materialized table',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Delete a specific Materialized Table by name.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the database.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'table_name',
                        'argument_name' => 'table_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Materialized Table',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Materialized Tables sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_sqlv1_materialized_table_versions' => [
                'class' => 'ConfluentListSqlv1MaterializedTableVersions',
                'method' => 'GET',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/databases/{kafka_cluster_id}/materialized-tables/{table_name}/versions',
                'operation_id' => 'listSqlv1MaterializedTableVersions',
                'name' => 'List all the versions of a materialized table',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted and paginated list of all versions for a specific Materialized Table.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the database.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'table_name',
                        'argument_name' => 'table_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Materialized Table.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Materialized Table Versions sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_sqlv1_materialized_table_version' => [
                'class' => 'ConfluentGetSqlv1MaterializedTableVersion',
                'method' => 'GET',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/databases/{kafka_cluster_id}/materialized-tables/{table_name}/versions/{version}',
                'operation_id' => 'getSqlv1MaterializedTableVersion',
                'name' => 'Read a materialized table version',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a specific version of a Materialized Table.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the database.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'table_name',
                        'argument_name' => 'table_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Materialized Table.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'version',
                        'argument_name' => 'version',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The version number of the Materialized Table.',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Materialized Table Versions sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_list_sqlv1_agents' => [
                'class' => 'ConfluentListSqlv1Agents',
                'method' => 'GET',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/agents',
                'operation_id' => 'listSqlv1Agents',
                'name' => 'List all agents',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300af91section/Versioning/API-Lifecycle-Policy Retrieve a sorted and paginated list of all agents.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Agents sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_create_sqlv1_agent' => [
                'class' => 'ConfluentCreateSqlv1Agent',
                'method' => 'POST',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/databases/{kafka_cluster_id}/agents',
                'operation_id' => 'createSqlv1Agent',
                'name' => 'Create an Agent',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300af91section/Versioning/API-Lifecycle-Policy Make a request to create an Agent.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the database.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Agents sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_get_sqlv1_agent' => [
                'class' => 'ConfluentGetSqlv1Agent',
                'method' => 'GET',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/databases/{kafka_cluster_id}/agents/{agent_name}',
                'operation_id' => 'getSqlv1Agent',
                'name' => 'Read an Agent',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300af91section/Versioning/API-Lifecycle-Policy Retrieve a specific Agent by name.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the database.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'agent_name',
                        'argument_name' => 'agent_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Agent',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Agents sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_update_sqlv1_agent' => [
                'class' => 'ConfluentUpdateSqlv1Agent',
                'method' => 'PUT',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/databases/{kafka_cluster_id}/agents/{agent_name}',
                'operation_id' => 'updateSqlv1Agent',
                'name' => 'Alter an Agent',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300af91section/Versioning/API-Lifecycle-Policy Make a request to update an Agent\'s mutable fields. Mutable fields include: description, model, prompt, and properties.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the database.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'agent_name',
                        'argument_name' => 'agent_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Agent',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => true,
                    'description' => 'The Agent resource with updated spec fields.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Agents sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_delete_sqlv1_agent' => [
                'class' => 'ConfluentDeleteSqlv1Agent',
                'method' => 'DELETE',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/databases/{kafka_cluster_id}/agents/{agent_name}',
                'operation_id' => 'deleteSqlv1Agent',
                'name' => 'Delete an Agent',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300af91section/Versioning/API-Lifecycle-Policy Delete a specific Agent by name.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'kafka_cluster_id',
                        'argument_name' => 'kafka_cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the database.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'agent_name',
                        'argument_name' => 'agent_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the Agent',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Agents sql/v1'
                ],
                'security' => [
                    'external-access-token',
                    'resource-api-key'
                ]
            ],
            'confluent_create_sqlv1_tool' => [
                'class' => 'ConfluentCreateSqlv1Tool',
                'method' => 'POST',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/databases/{database_name}/tools',
                'operation_id' => 'createSqlv1Tool',
                'name' => 'Create a Tool',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Make a request to create a Tool.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'database_name',
                        'argument_name' => 'database_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The name of the database.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Tools sql/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_list_sqlv1_tools' => [
                'class' => 'ConfluentListSqlv1Tools',
                'method' => 'GET',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/databases/{database_name}/tools',
                'operation_id' => 'listSqlv1Tools',
                'name' => 'List of Tools',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all Tools.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'database_name',
                        'argument_name' => 'database_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The name of the database.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Tools sql/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_get_sqlv1_tool' => [
                'class' => 'ConfluentGetSqlv1Tool',
                'method' => 'GET',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/databases/{database_name}/tools/{tool_name}',
                'operation_id' => 'getSqlv1Tool',
                'name' => 'Read a Tool',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Make a request to read a Tool.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'database_name',
                        'argument_name' => 'database_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The name of the database.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'tool_name',
                        'argument_name' => 'tool_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The user provided name of the Tool.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Tools sql/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_delete_sqlv1_tool' => [
                'class' => 'ConfluentDeleteSqlv1Tool',
                'method' => 'DELETE',
                'path' => '/sql/v1/organizations/{organization_id}/environments/{environment_id}/databases/{database_name}/tools/{tool_name}',
                'operation_id' => 'deleteSqlv1Tool',
                'name' => 'Delete a Tool',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Make a request to delete a Tool.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'organization_id',
                        'argument_name' => 'organization_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the organization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment_id',
                        'argument_name' => 'environment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'database_name',
                        'argument_name' => 'database_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The name of the database.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'tool_name',
                        'argument_name' => 'tool_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The user provided name of the Tool.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Tools sql/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_list_networking_v1_dns_forwarders' => [
                'class' => 'ConfluentListNetworkingV1DNSForwarders',
                'method' => 'GET',
                'path' => '/networking/v1/dns-forwarders',
                'operation_id' => 'listNetworkingV1DnsForwarders',
                'name' => 'List of DNS Forwarders',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all DNS forwarders.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'DNS Forwarders networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_networking_v1_dns_forwarder' => [
                'class' => 'ConfluentCreateNetworkingV1DNSForwarder',
                'method' => 'POST',
                'path' => '/networking/v1/dns-forwarders',
                'operation_id' => 'createNetworkingV1DnsForwarder',
                'name' => 'Create a DNS Forwarder',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a DNS forwarder.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'DNS Forwarders networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_networking_v1_dns_forwarder' => [
                'class' => 'ConfluentGetNetworkingV1DNSForwarder',
                'method' => 'GET',
                'path' => '/networking/v1/dns-forwarders/{id}',
                'operation_id' => 'getNetworkingV1DnsForwarder',
                'name' => 'Read a DNS Forwarder',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a DNS forwarder.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the DNS forwarder.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'DNS Forwarders networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_networking_v1_dns_forwarder' => [
                'class' => 'ConfluentUpdateNetworkingV1DNSForwarder',
                'method' => 'PATCH',
                'path' => '/networking/v1/dns-forwarders/{id}',
                'operation_id' => 'updateNetworkingV1DnsForwarder',
                'name' => 'Update a DNS Forwarder',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a DNS forwarder.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the DNS forwarder.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'DNS Forwarders networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_networking_v1_dns_forwarder' => [
                'class' => 'ConfluentDeleteNetworkingV1DNSForwarder',
                'method' => 'DELETE',
                'path' => '/networking/v1/dns-forwarders/{id}',
                'operation_id' => 'deleteNetworkingV1DnsForwarder',
                'name' => 'Delete a DNS Forwarder',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a DNS forwarder.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the DNS forwarder.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'DNS Forwarders networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_networking_v1_access_points' => [
                'class' => 'ConfluentListNetworkingV1AccessPoints',
                'method' => 'GET',
                'path' => '/networking/v1/access-points',
                'operation_id' => 'listNetworkingV1AccessPoints',
                'name' => 'List of Access Points',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all access points.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'spec.display_name',
                        'argument_name' => 'spec_display_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.displayname. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.gateway',
                        'argument_name' => 'spec_gateway',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.gateway. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for id. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Access Points networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_networking_v1_access_point' => [
                'class' => 'ConfluentCreateNetworkingV1AccessPoint',
                'method' => 'POST',
                'path' => '/networking/v1/access-points',
                'operation_id' => 'createNetworkingV1AccessPoint',
                'name' => 'Create an Access Point',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create an access point.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Access Points networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_networking_v1_access_point' => [
                'class' => 'ConfluentGetNetworkingV1AccessPoint',
                'method' => 'GET',
                'path' => '/networking/v1/access-points/{id}',
                'operation_id' => 'getNetworkingV1AccessPoint',
                'name' => 'Read an Access Point',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read an access point.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the access point.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Access Points networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_networking_v1_access_point' => [
                'class' => 'ConfluentUpdateNetworkingV1AccessPoint',
                'method' => 'PATCH',
                'path' => '/networking/v1/access-points/{id}',
                'operation_id' => 'updateNetworkingV1AccessPoint',
                'name' => 'Update an Access Point',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update an access point.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the access point.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Access Points networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_networking_v1_access_point' => [
                'class' => 'ConfluentDeleteNetworkingV1AccessPoint',
                'method' => 'DELETE',
                'path' => '/networking/v1/access-points/{id}',
                'operation_id' => 'deleteNetworkingV1AccessPoint',
                'name' => 'Delete an Access Point',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete an access point.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the access point.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Access Points networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_networking_v1_dns_records' => [
                'class' => 'ConfluentListNetworkingV1DNSRecords',
                'method' => 'GET',
                'path' => '/networking/v1/dns-records',
                'operation_id' => 'listNetworkingV1DnsRecords',
                'name' => 'List of DNS Records',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all DNS records.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'spec.display_name',
                        'argument_name' => 'spec_display_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.displayname. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'spec.domain',
                        'argument_name' => 'spec_domain',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.domain. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.gateway',
                        'argument_name' => 'spec_gateway',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.gateway. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'resource',
                        'argument_name' => 'resource',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for resource. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'DNS Records networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_networking_v1_dns_record' => [
                'class' => 'ConfluentCreateNetworkingV1DNSRecord',
                'method' => 'POST',
                'path' => '/networking/v1/dns-records',
                'operation_id' => 'createNetworkingV1DnsRecord',
                'name' => 'Create a DNS Record',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a DNS record.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'DNS Records networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_networking_v1_dns_record' => [
                'class' => 'ConfluentGetNetworkingV1DNSRecord',
                'method' => 'GET',
                'path' => '/networking/v1/dns-records/{id}',
                'operation_id' => 'getNetworkingV1DnsRecord',
                'name' => 'Read a DNS Record',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a DNS record.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the DNS record.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'DNS Records networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_networking_v1_dns_record' => [
                'class' => 'ConfluentUpdateNetworkingV1DNSRecord',
                'method' => 'PATCH',
                'path' => '/networking/v1/dns-records/{id}',
                'operation_id' => 'updateNetworkingV1DnsRecord',
                'name' => 'Update a DNS Record',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a DNS record.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the DNS record.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'DNS Records networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_networking_v1_dns_record' => [
                'class' => 'ConfluentDeleteNetworkingV1DNSRecord',
                'method' => 'DELETE',
                'path' => '/networking/v1/dns-records/{id}',
                'operation_id' => 'deleteNetworkingV1DnsRecord',
                'name' => 'Delete a DNS Record',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a DNS record.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the DNS record.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'DNS Records networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_iam_v2_certificate_authorities' => [
                'class' => 'ConfluentListIAMV2CertificateAuthorities',
                'method' => 'GET',
                'path' => '/iam/v2/certificate-authorities',
                'operation_id' => 'listIamV2CertificateAuthorities',
                'name' => 'List of Certificate Authorities',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all certificate authorities.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Certificate Authorities iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_iam_v2_certificate_authority' => [
                'class' => 'ConfluentCreateIAMV2CertificateAuthority',
                'method' => 'POST',
                'path' => '/iam/v2/certificate-authorities',
                'operation_id' => 'createIamV2CertificateAuthority',
                'name' => 'Create a Certificate Authority',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a certificate authority.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Certificate Authorities iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_iam_v2_certificate_authority' => [
                'class' => 'ConfluentGetIAMV2CertificateAuthority',
                'method' => 'GET',
                'path' => '/iam/v2/certificate-authorities/{id}',
                'operation_id' => 'getIamV2CertificateAuthority',
                'name' => 'Read a Certificate Authority',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a certificate authority.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the certificate authority.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Certificate Authorities iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_iam_v2_certificate_authority' => [
                'class' => 'ConfluentUpdateIAMV2CertificateAuthority',
                'method' => 'PUT',
                'path' => '/iam/v2/certificate-authorities/{id}',
                'operation_id' => 'updateIamV2CertificateAuthority',
                'name' => 'Update a Certificate Authority',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a certificate authority.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the certificate authority.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Certificate Authorities iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_iam_v2_certificate_authority' => [
                'class' => 'ConfluentDeleteIAMV2CertificateAuthority',
                'method' => 'DELETE',
                'path' => '/iam/v2/certificate-authorities/{id}',
                'operation_id' => 'deleteIamV2CertificateAuthority',
                'name' => 'Delete a Certificate Authority',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a certificate authority.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the certificate authority.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Certificate Authorities iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_iam_v2_certificate_identity_pools' => [
                'class' => 'ConfluentListIAMV2CertificateIdentityPools',
                'method' => 'GET',
                'path' => '/iam/v2/certificate-authorities/{certificate_authority_id}/identity-pools',
                'operation_id' => 'listIamV2CertificateIdentityPools',
                'name' => 'List of Certificate Identity Pools',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all certificate identity pools.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'certificate_authority_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Certificate Authority',
                        'schema_type' => 'string',
                        'aliases' => [
                            'certificate_authority_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Certificate Identity Pools iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_iam_v2_certificate_identity_pool' => [
                'class' => 'ConfluentCreateIAMV2CertificateIdentityPool',
                'method' => 'POST',
                'path' => '/iam/v2/certificate-authorities/{certificate_authority_id}/identity-pools',
                'operation_id' => 'createIamV2CertificateIdentityPool',
                'name' => 'Create a Certificate Identity Pool',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a certificate identity pool.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'assigned_resource_owner',
                        'argument_name' => 'assigned_resource_owner',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The resourceid of the principal who will be assigned resource owner on the created certificate identity pool. Principal can be group-mapping group-xxx, user u-xxx, service-account sa-xxx or identity-pool pool-xxx.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'certificate_authority_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Certificate Authority',
                        'schema_type' => 'string',
                        'aliases' => [
                            'certificate_authority_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Certificate Identity Pools iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_iam_v2_certificate_identity_pool' => [
                'class' => 'ConfluentGetIAMV2CertificateIdentityPool',
                'method' => 'GET',
                'path' => '/iam/v2/certificate-authorities/{certificate_authority_id}/identity-pools/{id}',
                'operation_id' => 'getIamV2CertificateIdentityPool',
                'name' => 'Read a Certificate Identity Pool',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a certificate identity pool.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'certificate_authority_id',
                        'argument_name' => 'certificate_authority_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Certificate Authority',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the certificate identity pool.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Certificate Identity Pools iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_iam_v2_certificate_identity_pool' => [
                'class' => 'ConfluentUpdateIAMV2CertificateIdentityPool',
                'method' => 'PUT',
                'path' => '/iam/v2/certificate-authorities/{certificate_authority_id}/identity-pools/{id}',
                'operation_id' => 'updateIamV2CertificateIdentityPool',
                'name' => 'Update a Certificate Identity Pool',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a certificate identity pool.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'certificate_authority_id',
                        'argument_name' => 'certificate_authority_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Certificate Authority',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the certificate identity pool.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Certificate Identity Pools iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_iam_v2_certificate_identity_pool' => [
                'class' => 'ConfluentDeleteIAMV2CertificateIdentityPool',
                'method' => 'DELETE',
                'path' => '/iam/v2/certificate-authorities/{certificate_authority_id}/identity-pools/{id}',
                'operation_id' => 'deleteIamV2CertificateIdentityPool',
                'name' => 'Delete a Certificate Identity Pool',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a certificate identity pool.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'certificate_authority_id',
                        'argument_name' => 'certificate_authority_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Certificate Authority',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the certificate identity pool.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Certificate Identity Pools iam/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_pim_v1_integrations' => [
                'class' => 'ConfluentListPimV1Integrations',
                'method' => 'GET',
                'path' => '/pim/v1/integrations',
                'operation_id' => 'listPimV1Integrations',
                'name' => 'List of Integrations',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all integrations. If no provider filter is specified, returns provider integrations from all clouds.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'provider',
                        'argument_name' => 'provider',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for provider.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Integrations pim/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_pim_v1_integration' => [
                'class' => 'ConfluentCreatePimV1Integration',
                'method' => 'POST',
                'path' => '/pim/v1/integrations',
                'operation_id' => 'createPimV1Integration',
                'name' => 'Create an Integration',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create an integration.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Integrations pim/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_pim_v1_integration' => [
                'class' => 'ConfluentGetPimV1Integration',
                'method' => 'GET',
                'path' => '/pim/v1/integrations/{id}',
                'operation_id' => 'getPimV1Integration',
                'name' => 'Read an Integration',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read an integration.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the integration.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Integrations pim/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_pim_v1_integration' => [
                'class' => 'ConfluentDeletePimV1Integration',
                'method' => 'DELETE',
                'path' => '/pim/v1/integrations/{id}',
                'operation_id' => 'deletePimV1Integration',
                'name' => 'Delete an Integration',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete an integration. This request fails if existing workloads are using this CSP integration.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the integration.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Integrations pim/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_pim_v2_integrations' => [
                'class' => 'ConfluentListPimV2Integrations',
                'method' => 'GET',
                'path' => '/pim/v2/integrations',
                'operation_id' => 'listPimV2Integrations',
                'name' => 'List of Integrations',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Provider Integrationhttps://img.shields.io/badge/-Request%20Access%20To%20Provider%20Integration-%23bc8540mailto:ccloud-api-access+pim-v2-early-access@confluent.io?subject=Request%20to%20join%20pim/v2%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20pim/v2%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Retrieve a sorted, filtered, paginated list of all integrations. If no provider filter is specified, returns provider integrations from all clouds.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'display_name',
                        'argument_name' => 'display_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by a partial search of displayname.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'provider',
                        'argument_name' => 'provider',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for provider.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'status',
                        'argument_name' => 'status',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for status.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Integrations pim/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_pim_v2_integration' => [
                'class' => 'ConfluentCreatePimV2Integration',
                'method' => 'POST',
                'path' => '/pim/v2/integrations',
                'operation_id' => 'createPimV2Integration',
                'name' => 'Create an Integration',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Provider Integrationhttps://img.shields.io/badge/-Request%20Access%20To%20Provider%20Integration-%23bc8540mailto:ccloud-api-access+pim-v2-early-access@confluent.io?subject=Request%20to%20join%20pim/v2%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20pim/v2%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Make a request to create an integration.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Integrations pim/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_pim_v2_integration' => [
                'class' => 'ConfluentGetPimV2Integration',
                'method' => 'GET',
                'path' => '/pim/v2/integrations/{id}',
                'operation_id' => 'getPimV2Integration',
                'name' => 'Read an Integration',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Provider Integrationhttps://img.shields.io/badge/-Request%20Access%20To%20Provider%20Integration-%23bc8540mailto:ccloud-api-access+pim-v2-early-access@confluent.io?subject=Request%20to%20join%20pim/v2%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20pim/v2%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Make a request to read an integration.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the integration.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Integrations pim/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_pim_v2_integration' => [
                'class' => 'ConfluentUpdatePimV2Integration',
                'method' => 'PATCH',
                'path' => '/pim/v2/integrations/{id}',
                'operation_id' => 'updatePimV2Integration',
                'name' => 'Update an Integration',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Provider Integrationhttps://img.shields.io/badge/-Request%20Access%20To%20Provider%20Integration-%23bc8540mailto:ccloud-api-access+pim-v2-early-access@confluent.io?subject=Request%20to%20join%20pim/v2%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20pim/v2%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Make a request to update an integration. This request only works for integrations with DRAFT status.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the integration.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Integrations pim/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_pim_v2_integration' => [
                'class' => 'ConfluentDeletePimV2Integration',
                'method' => 'DELETE',
                'path' => '/pim/v2/integrations/{id}',
                'operation_id' => 'deletePimV2Integration',
                'name' => 'Delete an Integration',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Provider Integrationhttps://img.shields.io/badge/-Request%20Access%20To%20Provider%20Integration-%23bc8540mailto:ccloud-api-access+pim-v2-early-access@confluent.io?subject=Request%20to%20join%20pim/v2%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20pim/v2%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Make a request to delete an integration. This request fails if existing workloads are using this CSP integration.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the integration.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Integrations pim/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_validate_pim_v2_integration' => [
                'class' => 'ConfluentValidatePimV2Integration',
                'method' => 'POST',
                'path' => '/pim/v2/integrations:validate',
                'operation_id' => 'validatePimV2Integration',
                'name' => 'Validate an Integration',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Provider Integrationhttps://img.shields.io/badge/-Request%20Access%20To%20Provider%20Integration-%23bc8540mailto:ccloud-api-access+pim-v2-early-access@confluent.io?subject=Request%20to%20join%20pim/v2%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20pim/v2%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Validate the provider integration configuration.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Integrations pim/v2'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_artifact_v1_flink_artifacts' => [
                'class' => 'ConfluentListArtifactV1FlinkArtifacts',
                'method' => 'GET',
                'path' => '/artifact/v1/flink-artifacts',
                'operation_id' => 'listArtifactV1FlinkArtifacts',
                'name' => 'List of Flink Artifacts',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all flink artifacts.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cloud',
                        'argument_name' => 'cloud',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for cloud.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'region',
                        'argument_name' => 'region',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for region.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Flink Artifacts artifact/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_artifact_v1_flink_artifact' => [
                'class' => 'ConfluentCreateArtifactV1FlinkArtifact',
                'method' => 'POST',
                'path' => '/artifact/v1/flink-artifacts',
                'operation_id' => 'createArtifactV1FlinkArtifact',
                'name' => 'Create a new Flink Artifact.',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a flink artifact.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cloud',
                        'argument_name' => 'cloud',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given cloud.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'region',
                        'argument_name' => 'region',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given region.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Flink Artifacts artifact/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_artifact_v1_flink_artifact' => [
                'class' => 'ConfluentGetArtifactV1FlinkArtifact',
                'method' => 'GET',
                'path' => '/artifact/v1/flink-artifacts/{id}',
                'operation_id' => 'getArtifactV1FlinkArtifact',
                'name' => 'Read a Flink Artifact',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a flink artifact.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cloud',
                        'argument_name' => 'cloud',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given cloud.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'region',
                        'argument_name' => 'region',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given region.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the flink artifact.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Flink Artifacts artifact/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_artifact_v1_flink_artifact' => [
                'class' => 'ConfluentUpdateArtifactV1FlinkArtifact',
                'method' => 'PATCH',
                'path' => '/artifact/v1/flink-artifacts/{id}',
                'operation_id' => 'updateArtifactV1FlinkArtifact',
                'name' => 'Update a Flink Artifact',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a flink artifact.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cloud',
                        'argument_name' => 'cloud',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given cloud.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'region',
                        'argument_name' => 'region',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given region.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the flink artifact.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Flink Artifacts artifact/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_artifact_v1_flink_artifact' => [
                'class' => 'ConfluentDeleteArtifactV1FlinkArtifact',
                'method' => 'DELETE',
                'path' => '/artifact/v1/flink-artifacts/{id}',
                'operation_id' => 'deleteArtifactV1FlinkArtifact',
                'name' => 'Delete a Flink Artifact',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a flink artifact.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cloud',
                        'argument_name' => 'cloud',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given cloud.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'region',
                        'argument_name' => 'region',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given region.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the flink artifact.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Flink Artifacts artifact/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_presigned_upload_url_artifact_v1_presigned_url' => [
                'class' => 'ConfluentPresignedUploadUrlArtifactV1PresignedUrl',
                'method' => 'POST',
                'path' => '/artifact/v1/presigned-upload-url',
                'operation_id' => 'presigned-upload-urlArtifactV1PresignedUrl',
                'name' => 'Request a presigned upload URL for a new Flink Artifact.',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Request a presigned upload URL to upload a Flink Artifact archive.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Presigned Urls artifact/v1'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_list_networking_v1_gateways' => [
                'class' => 'ConfluentListNetworkingV1Gateways',
                'method' => 'GET',
                'path' => '/networking/v1/gateways',
                'operation_id' => 'listNetworkingV1Gateways',
                'name' => 'List of Gateways',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all gateways.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'gateway_type',
                        'argument_name' => 'gateway_type',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for gatewaytype. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for id. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'spec.config.region',
                        'argument_name' => 'spec_config_region',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.config.region. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'spec.display_name',
                        'argument_name' => 'spec_display_name',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.displayname. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'status.phase',
                        'argument_name' => 'status_phase',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for status.phase. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Gateways networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_networking_v1_gateway' => [
                'class' => 'ConfluentCreateNetworkingV1Gateway',
                'method' => 'POST',
                'path' => '/networking/v1/gateways',
                'operation_id' => 'createNetworkingV1Gateway',
                'name' => 'Create a Gateway',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a gateway.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Gateways networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_networking_v1_gateway' => [
                'class' => 'ConfluentGetNetworkingV1Gateway',
                'method' => 'GET',
                'path' => '/networking/v1/gateways/{id}',
                'operation_id' => 'getNetworkingV1Gateway',
                'name' => 'Read a Gateway',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a gateway.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the gateway.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Gateways networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_networking_v1_gateway' => [
                'class' => 'ConfluentUpdateNetworkingV1Gateway',
                'method' => 'PATCH',
                'path' => '/networking/v1/gateways/{id}',
                'operation_id' => 'updateNetworkingV1Gateway',
                'name' => 'Update a Gateway',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a gateway.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the gateway.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Gateways networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_networking_v1_gateway' => [
                'class' => 'ConfluentDeleteNetworkingV1Gateway',
                'method' => 'DELETE',
                'path' => '/networking/v1/gateways/{id}',
                'operation_id' => 'deleteNetworkingV1Gateway',
                'name' => 'Delete a Gateway',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a gateway.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the gateway.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Gateways networking/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_ccl_v1_custom_code_loggings' => [
                'class' => 'ConfluentListCclV1CustomCodeLoggings',
                'method' => 'GET',
                'path' => '/ccl/v1/custom-code-loggings',
                'operation_id' => 'listCclV1CustomCodeLoggings',
                'name' => 'List of Custom Code Loggings',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Custom Code Logging API EAhttps://img.shields.io/badge/-Request%20Access%20To%20Custom%20Code%20Logging%20API%20EA-%23bc8540mailto:ccloud-api-access+ccl-v1-early-access@confluent.io?subject=Request%20to%20join%20ccl/v1%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20ccl/v1%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Retrieve a sorted, filtered, paginated list of all custom code loggings.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Custom Code Loggings ccl/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_ccl_v1_custom_code_logging' => [
                'class' => 'ConfluentCreateCclV1CustomCodeLogging',
                'method' => 'POST',
                'path' => '/ccl/v1/custom-code-loggings',
                'operation_id' => 'createCclV1CustomCodeLogging',
                'name' => 'Create a Custom Code Logging',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Custom Code Logging API EAhttps://img.shields.io/badge/-Request%20Access%20To%20Custom%20Code%20Logging%20API%20EA-%23bc8540mailto:ccloud-api-access+ccl-v1-early-access@confluent.io?subject=Request%20to%20join%20ccl/v1%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20ccl/v1%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Make a request to create a custom code logging.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Custom Code Loggings ccl/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_ccl_v1_custom_code_logging' => [
                'class' => 'ConfluentGetCclV1CustomCodeLogging',
                'method' => 'GET',
                'path' => '/ccl/v1/custom-code-loggings/{id}',
                'operation_id' => 'getCclV1CustomCodeLogging',
                'name' => 'Read a Custom Code Logging',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Custom Code Logging API EAhttps://img.shields.io/badge/-Request%20Access%20To%20Custom%20Code%20Logging%20API%20EA-%23bc8540mailto:ccloud-api-access+ccl-v1-early-access@confluent.io?subject=Request%20to%20join%20ccl/v1%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20ccl/v1%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Make a request to read a custom code logging.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the custom code logging.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Custom Code Loggings ccl/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_ccl_v1_custom_code_logging' => [
                'class' => 'ConfluentUpdateCclV1CustomCodeLogging',
                'method' => 'PATCH',
                'path' => '/ccl/v1/custom-code-loggings/{id}',
                'operation_id' => 'updateCclV1CustomCodeLogging',
                'name' => 'Update a Custom Code Logging',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Custom Code Logging API EAhttps://img.shields.io/badge/-Request%20Access%20To%20Custom%20Code%20Logging%20API%20EA-%23bc8540mailto:ccloud-api-access+ccl-v1-early-access@confluent.io?subject=Request%20to%20join%20ccl/v1%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20ccl/v1%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Make a request to update a custom code logging.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the custom code logging.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Custom Code Loggings ccl/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_ccl_v1_custom_code_logging' => [
                'class' => 'ConfluentDeleteCclV1CustomCodeLogging',
                'method' => 'DELETE',
                'path' => '/ccl/v1/custom-code-loggings/{id}',
                'operation_id' => 'deleteCclV1CustomCodeLogging',
                'name' => 'Delete a Custom Code Logging',
                'description' => '!Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Custom Code Logging API EAhttps://img.shields.io/badge/-Request%20Access%20To%20Custom%20Code%20Logging%20API%20EA-%23bc8540mailto:ccloud-api-access+ccl-v1-early-access@confluent.io?subject=Request%20to%20join%20ccl/v1%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20ccl/v1%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Make a request to delete a custom code logging.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the custom code logging.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Custom Code Loggings ccl/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_tableflow_v1_regions' => [
                'class' => 'ConfluentListTableflowV1Regions',
                'method' => 'GET',
                'path' => '/tableflow/v1/regions',
                'operation_id' => 'listTableflowV1Regions',
                'name' => 'List of Regions',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all regions.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cloud',
                        'argument_name' => 'cloud',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for cloud.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Regions tableflow/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_list_tableflow_v1_tableflow_topics' => [
                'class' => 'ConfluentListTableflowV1TableflowTopics',
                'method' => 'GET',
                'path' => '/tableflow/v1/tableflow-topics',
                'operation_id' => 'listTableflowV1TableflowTopics',
                'name' => 'List of Tableflow Topics',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all tableflow topics.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'spec.table_formats',
                        'argument_name' => 'spec_table_formats',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.tableformats. Pass multiple times to see results matching any of the values.',
                        'schema_type' => 'array',
                        'items' => [
                            'type' => 'string'
                        ]
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.kafka_cluster',
                        'argument_name' => 'spec_kafka_cluster',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for spec.kafkacluster.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Tableflow Topics tableflow/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_create_tableflow_v1_tableflow_topic' => [
                'class' => 'ConfluentCreateTableflowV1TableflowTopic',
                'method' => 'POST',
                'path' => '/tableflow/v1/tableflow-topics',
                'operation_id' => 'createTableflowV1TableflowTopic',
                'name' => 'Create a Tableflow Topic',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a tableflow topic.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Tableflow Topics tableflow/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_get_tableflow_v1_tableflow_topic' => [
                'class' => 'ConfluentGetTableflowV1TableflowTopic',
                'method' => 'GET',
                'path' => '/tableflow/v1/tableflow-topics/{display_name}',
                'operation_id' => 'getTableflowV1TableflowTopic',
                'name' => 'Read a Tableflow Topic',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a tableflow topic.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.kafka_cluster',
                        'argument_name' => 'spec_kafka_cluster',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given spec.kafkacluster.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'display_name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The name of the Kafka topic for which Tableflow is enabled.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'display_name'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Tableflow Topics tableflow/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_update_tableflow_v1_tableflow_topic' => [
                'class' => 'ConfluentUpdateTableflowV1TableflowTopic',
                'method' => 'PATCH',
                'path' => '/tableflow/v1/tableflow-topics/{display_name}',
                'operation_id' => 'updateTableflowV1TableflowTopic',
                'name' => 'Update a Tableflow Topic',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a tableflow topic.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'display_name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The name of the Kafka topic for which Tableflow is enabled.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'display_name'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Tableflow Topics tableflow/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_delete_tableflow_v1_tableflow_topic' => [
                'class' => 'ConfluentDeleteTableflowV1TableflowTopic',
                'method' => 'DELETE',
                'path' => '/tableflow/v1/tableflow-topics/{display_name}',
                'operation_id' => 'deleteTableflowV1TableflowTopic',
                'name' => 'Delete a Tableflow Topic',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a tableflow topic.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.kafka_cluster',
                        'argument_name' => 'spec_kafka_cluster',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given spec.kafkacluster.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'display_name',
                        'argument_name' => 'name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The name of the Kafka topic for which Tableflow is enabled.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'display_name'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Tableflow Topics tableflow/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_list_tableflow_v1_catalog_integrations' => [
                'class' => 'ConfluentListTableflowV1CatalogIntegrations',
                'method' => 'GET',
                'path' => '/tableflow/v1/catalog-integrations',
                'operation_id' => 'listTableflowV1CatalogIntegrations',
                'name' => 'List of Catalog Integrations',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all catalog integrations.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.kafka_cluster',
                        'argument_name' => 'spec_kafka_cluster',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for spec.kafkacluster.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Catalog Integrations tableflow/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_create_tableflow_v1_catalog_integration' => [
                'class' => 'ConfluentCreateTableflowV1CatalogIntegration',
                'method' => 'POST',
                'path' => '/tableflow/v1/catalog-integrations',
                'operation_id' => 'createTableflowV1CatalogIntegration',
                'name' => 'Create a Catalog Integration',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a catalog integration.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Catalog Integrations tableflow/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_get_tableflow_v1_catalog_integration' => [
                'class' => 'ConfluentGetTableflowV1CatalogIntegration',
                'method' => 'GET',
                'path' => '/tableflow/v1/catalog-integrations/{id}',
                'operation_id' => 'getTableflowV1CatalogIntegration',
                'name' => 'Read a Catalog Integration',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a catalog integration.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.kafka_cluster',
                        'argument_name' => 'spec_kafka_cluster',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given spec.kafkacluster.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the catalog integration.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Catalog Integrations tableflow/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_update_tableflow_v1_catalog_integration' => [
                'class' => 'ConfluentUpdateTableflowV1CatalogIntegration',
                'method' => 'PATCH',
                'path' => '/tableflow/v1/catalog-integrations/{id}',
                'operation_id' => 'updateTableflowV1CatalogIntegration',
                'name' => 'Update a Catalog Integration',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a catalog integration.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the catalog integration.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Catalog Integrations tableflow/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_delete_tableflow_v1_catalog_integration' => [
                'class' => 'ConfluentDeleteTableflowV1CatalogIntegration',
                'method' => 'DELETE',
                'path' => '/tableflow/v1/catalog-integrations/{id}',
                'operation_id' => 'deleteTableflowV1CatalogIntegration',
                'name' => 'Delete a Catalog Integration',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a catalog integration.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'spec.kafka_cluster',
                        'argument_name' => 'spec_kafka_cluster',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given spec.kafkacluster.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the catalog integration.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Catalog Integrations tableflow/v1'
                ],
                'security' => [
                    'resource-api-key'
                ]
            ],
            'confluent_list_ccpm_v1_custom_connect_plugins' => [
                'class' => 'ConfluentListCcpmV1CustomConnectPlugins',
                'method' => 'GET',
                'path' => '/ccpm/v1/plugins',
                'operation_id' => 'listCcpmV1CustomConnectPlugins',
                'name' => 'List of Custom Connect Plugins',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all custom connect plugins. If no cloud filter is specified, returns custom connect plugins from all clouds.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'spec.cloud',
                        'argument_name' => 'spec_cloud',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for spec.cloud.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Custom Connect Plugins ccpm/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_ccpm_v1_custom_connect_plugin' => [
                'class' => 'ConfluentCreateCcpmV1CustomConnectPlugin',
                'method' => 'POST',
                'path' => '/ccpm/v1/plugins',
                'operation_id' => 'createCcpmV1CustomConnectPlugin',
                'name' => 'Create a Custom Connect Plugin',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a custom connect plugin.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Custom Connect Plugins ccpm/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_ccpm_v1_custom_connect_plugin' => [
                'class' => 'ConfluentGetCcpmV1CustomConnectPlugin',
                'method' => 'GET',
                'path' => '/ccpm/v1/plugins/{id}',
                'operation_id' => 'getCcpmV1CustomConnectPlugin',
                'name' => 'Read a Custom Connect Plugin',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a custom connect plugin.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the custom connect plugin.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Custom Connect Plugins ccpm/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_update_ccpm_v1_custom_connect_plugin' => [
                'class' => 'ConfluentUpdateCcpmV1CustomConnectPlugin',
                'method' => 'PATCH',
                'path' => '/ccpm/v1/plugins/{id}',
                'operation_id' => 'updateCcpmV1CustomConnectPlugin',
                'name' => 'Update a Custom Connect Plugin',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a custom connect plugin.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the custom connect plugin.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Custom Connect Plugins ccpm/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_ccpm_v1_custom_connect_plugin' => [
                'class' => 'ConfluentDeleteCcpmV1CustomConnectPlugin',
                'method' => 'DELETE',
                'path' => '/ccpm/v1/plugins/{id}',
                'operation_id' => 'deleteCcpmV1CustomConnectPlugin',
                'name' => 'Delete a Custom Connect Plugin',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a custom connect plugin.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the custom connect plugin.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Custom Connect Plugins ccpm/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_ccpm_v1_presigned_url' => [
                'class' => 'ConfluentCreateCcpmV1PresignedUrl',
                'method' => 'POST',
                'path' => '/ccpm/v1/presigned-upload-url',
                'operation_id' => 'createCcpmV1PresignedUrl',
                'name' => 'Request a presigned upload URL for a new Custom Connect Plugin.',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Request a presigned upload URL to upload a Custom Connect Plugin archive.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Presigned Urls ccpm/v1'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_list_ccpm_v1_custom_connect_plugin_versions' => [
                'class' => 'ConfluentListCcpmV1CustomConnectPluginVersions',
                'method' => 'GET',
                'path' => '/ccpm/v1/plugins/{plugin_id}/versions',
                'operation_id' => 'listCcpmV1CustomConnectPluginVersions',
                'name' => 'List of Custom Connect Plugin Versions',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all custom connect plugin versions.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'plugin_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Plugin',
                        'schema_type' => 'string',
                        'aliases' => [
                            'plugin_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Custom Connect Plugin Versions ccpm/v1'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_create_ccpm_v1_custom_connect_plugin_version' => [
                'class' => 'ConfluentCreateCcpmV1CustomConnectPluginVersion',
                'method' => 'POST',
                'path' => '/ccpm/v1/plugins/{plugin_id}/versions',
                'operation_id' => 'createCcpmV1CustomConnectPluginVersion',
                'name' => 'Create a Custom Connect Plugin Version',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create a custom connect plugin version.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'plugin_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Plugin',
                        'schema_type' => 'string',
                        'aliases' => [
                            'plugin_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Custom Connect Plugin Versions ccpm/v1'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_get_ccpm_v1_custom_connect_plugin_version' => [
                'class' => 'ConfluentGetCcpmV1CustomConnectPluginVersion',
                'method' => 'GET',
                'path' => '/ccpm/v1/plugins/{plugin_id}/versions/{id}',
                'operation_id' => 'getCcpmV1CustomConnectPluginVersion',
                'name' => 'Read a Custom Connect Plugin Version',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to read a custom connect plugin version.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'plugin_id',
                        'argument_name' => 'plugin_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Plugin',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the custom connect plugin version.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Custom Connect Plugin Versions ccpm/v1'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_delete_ccpm_v1_custom_connect_plugin_version' => [
                'class' => 'ConfluentDeleteCcpmV1CustomConnectPluginVersion',
                'method' => 'DELETE',
                'path' => '/ccpm/v1/plugins/{plugin_id}/versions/{id}',
                'operation_id' => 'deleteCcpmV1CustomConnectPluginVersion',
                'name' => 'Delete a Custom Connect Plugin Version',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a custom connect plugin version.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'plugin_id',
                        'argument_name' => 'plugin_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Plugin',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the custom connect plugin version.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Custom Connect Plugin Versions ccpm/v1'
                ],
                'security' => [
                    'cloud-api-key'
                ]
            ],
            'confluent_list_usm_v1_kafka_clusters' => [
                'class' => 'ConfluentListUSMV1KafkaClusters',
                'method' => 'GET',
                'path' => '/usm/v1/kafka-clusters',
                'operation_id' => 'listUsmV1KafkaClusters',
                'name' => 'List of Kafka Clusters',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all kafka clusters.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Kafka Clusters usm/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_usm_v1_kafka_cluster' => [
                'class' => 'ConfluentCreateUSMV1KafkaCluster',
                'method' => 'POST',
                'path' => '/usm/v1/kafka-clusters',
                'operation_id' => 'createUsmV1KafkaCluster',
                'name' => 'Create a Kafka Cluster',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Make a request to create a kafka cluster.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Kafka Clusters usm/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_usm_v1_kafka_cluster' => [
                'class' => 'ConfluentGetUSMV1KafkaCluster',
                'method' => 'GET',
                'path' => '/usm/v1/kafka-clusters/{id}',
                'operation_id' => 'getUsmV1KafkaCluster',
                'name' => 'Read a Kafka Cluster',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Make a request to read a kafka cluster.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the kafka cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Kafka Clusters usm/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_usm_v1_kafka_cluster' => [
                'class' => 'ConfluentDeleteUSMV1KafkaCluster',
                'method' => 'DELETE',
                'path' => '/usm/v1/kafka-clusters/{id}',
                'operation_id' => 'deleteUsmV1KafkaCluster',
                'name' => 'Delete a Kafka Cluster',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Make a request to delete a kafka cluster.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the kafka cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Kafka Clusters usm/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_usm_v1_connect_clusters' => [
                'class' => 'ConfluentListUSMV1ConnectClusters',
                'method' => 'GET',
                'path' => '/usm/v1/connect-clusters',
                'operation_id' => 'listUsmV1ConnectClusters',
                'name' => 'List of Connect Clusters',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all connect clusters.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Connect Clusters usm/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_create_usm_v1_connect_cluster' => [
                'class' => 'ConfluentCreateUSMV1ConnectCluster',
                'method' => 'POST',
                'path' => '/usm/v1/connect-clusters',
                'operation_id' => 'createUsmV1ConnectCluster',
                'name' => 'Create a Connect Cluster',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Make a request to create a connect cluster.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Confluent Cloud API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Connect Clusters usm/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_get_usm_v1_connect_cluster' => [
                'class' => 'ConfluentGetUSMV1ConnectCluster',
                'method' => 'GET',
                'path' => '/usm/v1/connect-clusters/{id}',
                'operation_id' => 'getUsmV1ConnectCluster',
                'name' => 'Read a Connect Cluster',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Make a request to read a connect cluster.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the connect cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Connect Clusters usm/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_delete_usm_v1_connect_cluster' => [
                'class' => 'ConfluentDeleteUSMV1ConnectCluster',
                'method' => 'DELETE',
                'path' => '/usm/v1/connect-clusters/{id}',
                'operation_id' => 'deleteUsmV1ConnectCluster',
                'name' => 'Delete a Connect Cluster',
                'description' => '!Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Make a request to delete a connect cluster.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Scope the operation to the given environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The unique identifier for the connect cluster.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Connect Clusters usm/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ],
            'confluent_list_endpoint_v1_endpoints' => [
                'class' => 'ConfluentListEndpointV1Endpoints',
                'method' => 'GET',
                'path' => '/endpoint/v1/endpoints',
                'operation_id' => 'listEndpointV1Endpoints',
                'name' => 'List of Endpoints',
                'description' => '!General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all endpoints.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cloud',
                        'argument_name' => 'cloud',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for cloud.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'region',
                        'argument_name' => 'region',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for region.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'service',
                        'argument_name' => 'service',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for service.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'is_private',
                        'argument_name' => 'is_private',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by whether the endpoint is private true or public false. If not specified, returns both private and public endpoints.',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'environment',
                        'argument_name' => 'environment',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'Filter the results by exact match for environment.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'resource',
                        'argument_name' => 'resource',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by exact match for resource.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'page_size',
                        'argument_name' => 'page_size',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A pagination size for collection requests.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'page_token',
                        'argument_name' => 'page_token',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque pagination token for collection requests.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Endpoints endpoint/v1'
                ],
                'security' => [
                    'cloud-api-key',
                    'confluent-sts-access-token'
                ]
            ]
        ];
    }
}
