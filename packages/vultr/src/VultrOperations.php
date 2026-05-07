<?php

namespace OpenCompany\Integrations\Vultr;

/**
 * Generated Vultr OpenAPI operation catalog.
 *
 * Metadata is extracted from Vultr's official Redoc OpenAPI document and is
 * used by generated tools plus the shared service executor.
 */
class VultrOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return [
            'vultr_list_pullzones' => [
                'class' => 'VultrListPullzones',
                'method' => 'GET',
                'path' => '/cdns/pull-zones',
                'operation_id' => 'list-pullzones',
                'name' => 'List CDN Pull Zones',
                'description' => 'List CDN Pull Zones',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'CDNs'
                ]
            ],
            'vultr_create_pullzone' => [
                'class' => 'VultrCreatePullzone',
                'method' => 'POST',
                'path' => '/cdns/pull-zones',
                'operation_id' => 'create-pullzone',
                'name' => 'Create CDN Pull Zones',
                'description' => 'Create CDN Pull Zones',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'CDNs'
                ]
            ],
            'vultr_get_pullzone' => [
                'class' => 'VultrGetPullzone',
                'method' => 'GET',
                'path' => '/cdns/pull-zones/{pullzone-id}',
                'operation_id' => 'get-pullzone',
                'name' => 'Get CDN Pull Zone',
                'description' => 'Get CDN Pull Zone',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'pullzone-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Pull Zone IDoperation/list-pullzones.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'pullzone_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'CDNs'
                ]
            ],
            'vultr_update_pullzone' => [
                'class' => 'VultrUpdatePullzone',
                'method' => 'PUT',
                'path' => '/cdns/pull-zones/{pullzone-id}',
                'operation_id' => 'update-pullzone',
                'name' => 'Update CDN Pull Zone',
                'description' => 'Update CDN Pull Zone',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'pullzone-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Pull Zone IDoperation/list-pullzones.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'pullzone_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'CDNs'
                ]
            ],
            'vultr_delete_pullzone' => [
                'class' => 'VultrDeletePullzone',
                'method' => 'DELETE',
                'path' => '/cdns/pull-zones/{pullzone-id}',
                'operation_id' => 'delete-pullzone',
                'name' => 'Delete CDN Pullzone',
                'description' => 'Delete CDN Pullzone',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'pullzone-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Pull Zone IDoperation/list-pullzones.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'pullzone_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'CDNs'
                ]
            ],
            'vultr_purge_pullzone' => [
                'class' => 'VultrPurgePullzone',
                'method' => 'GET',
                'path' => '/cdns/pull-zones/{pullzone-id}/purge',
                'operation_id' => 'purge-pullzone',
                'name' => 'Purge CDN Pull Zone',
                'description' => 'Purge CDN Pull Zone',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'pullzone-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Pull Zone IDoperation/list-pullzones.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'pullzone_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'CDNs'
                ]
            ],
            'vultr_list_pushzones' => [
                'class' => 'VultrListPushzones',
                'method' => 'GET',
                'path' => '/cdns/push-zones',
                'operation_id' => 'list-pushzones',
                'name' => 'List CDN Push Zones',
                'description' => 'List CDN Push Zones',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'CDNs'
                ]
            ],
            'vultr_create_pushzone' => [
                'class' => 'VultrCreatePushzone',
                'method' => 'POST',
                'path' => '/cdns/push-zones',
                'operation_id' => 'create-pushzone',
                'name' => 'Create CDN Push Zones',
                'description' => 'Create CDN Push Zones',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'CDNs'
                ]
            ],
            'vultr_get_pushzone' => [
                'class' => 'VultrGetPushzone',
                'method' => 'GET',
                'path' => '/cdns/push-zones/{pushzone-id}',
                'operation_id' => 'get-pushzone',
                'name' => 'Get CDN Push Zone',
                'description' => 'Get CDN Push Zone',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'pushzone-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Push Zone IDoperation/list-pushzones.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'pushzone_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'CDNs'
                ]
            ],
            'vultr_update_pushzone' => [
                'class' => 'VultrUpdatePushzone',
                'method' => 'PUT',
                'path' => '/cdns/push-zones/{pushzone-id}',
                'operation_id' => 'update-pushzone',
                'name' => 'Update CDN Push Zone',
                'description' => 'Update CDN Push Zone',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'pushzone-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Push Zone IDoperation/list-pushzones.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'pushzone_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'CDNs'
                ]
            ],
            'vultr_delete_pushzone' => [
                'class' => 'VultrDeletePushzone',
                'method' => 'DELETE',
                'path' => '/cdns/push-zones/{pushzone-id}',
                'operation_id' => 'delete-pushzone',
                'name' => 'Delete CDN Pushzone',
                'description' => 'Delete CDN Pushzone',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'pushzone-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Push Zone IDoperation/list-pushzones.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'pushzone_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'CDNs'
                ]
            ],
            'vultr_get_pushzone_files' => [
                'class' => 'VultrGetPushzoneFiles',
                'method' => 'GET',
                'path' => '/cdns/push-zones/{pushzone-id}/files',
                'operation_id' => 'get-pushzone-files',
                'name' => 'List CDN Push Zone Files',
                'description' => 'List CDN Push Zone Files',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'pushzone-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Push Zone IDoperation/list-pushzones.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'pushzone_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'CDNs'
                ]
            ],
            'vultr_create_pushzone_upload' => [
                'class' => 'VultrCreatePushzoneUpload',
                'method' => 'POST',
                'path' => '/cdns/push-zones/{pushzone-id}/files',
                'operation_id' => 'create-pushzone-upload',
                'name' => 'Create CDN Push Zone File Upload Endpoint',
                'description' => 'Create CDN Push Zone File Upload Endpoint',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'pushzone-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Push Zone IDoperation/list-pushzones.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'pushzone_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'CDNs'
                ]
            ],
            'vultr_get_pushzone_pushzone_id_files_file_name' => [
                'class' => 'VultrGetPushzonePushzoneIdFilesFileName',
                'method' => 'GET',
                'path' => '/cdns/push-zones/{pushzone-id}/files/{file-name}',
                'operation_id' => 'get-pushzone',
                'name' => 'Get CDN Push Zone File',
                'description' => 'Get CDN Push Zone File',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'pushzone-id',
                        'argument_name' => 'pushzone_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Push Zone IDoperation/list-pushzones.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'file-name',
                        'argument_name' => 'file_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The File Nameoperation/list-pushzone-files.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'CDNs'
                ]
            ],
            'vultr_delete_pushzone_file' => [
                'class' => 'VultrDeletePushzoneFile',
                'method' => 'DELETE',
                'path' => '/cdns/push-zones/{pushzone-id}/files/{file-name}',
                'operation_id' => 'delete-pushzone-file',
                'name' => 'Delete CDN Pushzone File',
                'description' => 'Delete CDN Pushzone File',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'pushzone-id',
                        'argument_name' => 'pushzone_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Push Zone IDoperation/list-pushzones.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'file-name',
                        'argument_name' => 'file_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The File Nameoperation/list-pushzone-files.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'CDNs'
                ]
            ],
            'vultr_get_network' => [
                'class' => 'VultrGetNetwork',
                'method' => 'GET',
                'path' => '/private-networks/{network-id}',
                'operation_id' => 'get-network',
                'name' => 'Get a private network',
                'description' => 'Get a private network',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'network-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Network idoperation/list-networks.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'network_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'private Networks'
                ]
            ],
            'vultr_delete_network' => [
                'class' => 'VultrDeleteNetwork',
                'method' => 'DELETE',
                'path' => '/private-networks/{network-id}',
                'operation_id' => 'delete-network',
                'name' => 'Delete a private network',
                'description' => 'Delete a private network',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'network-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Network idoperation/list-networks.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'network_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'private Networks'
                ]
            ],
            'vultr_update_network' => [
                'class' => 'VultrUpdateNetwork',
                'method' => 'PUT',
                'path' => '/private-networks/{network-id}',
                'operation_id' => 'update-network',
                'name' => 'Update a Private Network',
                'description' => 'Update a Private Network',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'network-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Network idoperation/list-networks.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'network_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'private Networks'
                ]
            ],
            'vultr_list_networks' => [
                'class' => 'VultrListNetworks',
                'method' => 'GET',
                'path' => '/private-networks',
                'operation_id' => 'list-networks',
                'name' => 'List Private Networks',
                'description' => 'List Private Networks',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'private Networks'
                ]
            ],
            'vultr_create_network' => [
                'class' => 'VultrCreateNetwork',
                'method' => 'POST',
                'path' => '/private-networks',
                'operation_id' => 'create-network',
                'name' => 'Create a Private Network',
                'description' => 'Create a Private Network',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'private Networks'
                ]
            ],
            'vultr_get_vpc' => [
                'class' => 'VultrGetVpc',
                'method' => 'GET',
                'path' => '/vpcs/{vpc-id}',
                'operation_id' => 'get-vpc',
                'name' => 'Get a VPC',
                'description' => 'Get a VPC',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vpc_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_delete_vpc' => [
                'class' => 'VultrDeleteVpc',
                'method' => 'DELETE',
                'path' => '/vpcs/{vpc-id}',
                'operation_id' => 'delete-vpc',
                'name' => 'Delete a VPC',
                'description' => 'Delete a VPC',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vpc_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_update_vpc' => [
                'class' => 'VultrUpdateVpc',
                'method' => 'PUT',
                'path' => '/vpcs/{vpc-id}',
                'operation_id' => 'update-vpc',
                'name' => 'Update a VPC',
                'description' => 'Update a VPC',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vpc_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_list_vpcs' => [
                'class' => 'VultrListVpcs',
                'method' => 'GET',
                'path' => '/vpcs',
                'operation_id' => 'list-vpcs',
                'name' => 'List VPCs',
                'description' => 'List VPCs',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_create_vpc' => [
                'class' => 'VultrCreateVpc',
                'method' => 'POST',
                'path' => '/vpcs',
                'operation_id' => 'create-vpc',
                'name' => 'Create a VPC',
                'description' => 'Create a VPC',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_list_vpc_attachments' => [
                'class' => 'VultrListVpcAttachments',
                'method' => 'GET',
                'path' => '/vpcs/{vpc-id}/attachments',
                'operation_id' => 'list-vpc-attachments',
                'name' => 'List VPC Attachments',
                'description' => 'List VPC Attachments',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vpc_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_list_nat_gateways' => [
                'class' => 'VultrListNatGateways',
                'method' => 'GET',
                'path' => '/vpcs/{vpc-id}/nat-gateway',
                'operation_id' => 'list-nat-gateways',
                'name' => 'List NAT Gateways',
                'description' => 'List NAT Gateways',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vpc_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_create_nat_gateway' => [
                'class' => 'VultrCreateNatGateway',
                'method' => 'POST',
                'path' => '/vpcs/{vpc-id}/nat-gateway',
                'operation_id' => 'create-nat-gateway',
                'name' => 'Create NAT Gateway',
                'description' => 'Create NAT Gateway',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vpc_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_get_nat_gateway' => [
                'class' => 'VultrGetNatGateway',
                'method' => 'GET',
                'path' => '/vpcs/{vpc-id}/nat-gateway/{nat-gateway-id}',
                'operation_id' => 'get-nat-gateway',
                'name' => 'Get NAT Gateway',
                'description' => 'Get NAT Gateway',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'vpc_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nat-gateway-id',
                        'argument_name' => 'nat_gateway_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NAT Gateway IDoperation/list-nat-gateways.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_update_nat_gateway' => [
                'class' => 'VultrUpdateNatGateway',
                'method' => 'PUT',
                'path' => '/vpcs/{vpc-id}/nat-gateway/{nat-gateway-id}',
                'operation_id' => 'update-nat-gateway',
                'name' => 'Update NAT Gateway',
                'description' => 'Update NAT Gateway',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'vpc_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nat-gateway-id',
                        'argument_name' => 'nat_gateway_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NAT Gateway IDoperation/list-nat-gateways.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_delete_nat_gateway' => [
                'class' => 'VultrDeleteNatGateway',
                'method' => 'DELETE',
                'path' => '/vpcs/{vpc-id}/nat-gateway/{nat-gateway-id}',
                'operation_id' => 'delete-nat-gateway',
                'name' => 'Delete NAT Gateway',
                'description' => 'Delete NAT Gateway',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'vpc_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nat-gateway-id',
                        'argument_name' => 'nat_gateway_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NAT Gateway IDoperation/list-nat-gateways.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_list_nat_gateway_firewall_rules' => [
                'class' => 'VultrListNatGatewayFirewallRules',
                'method' => 'GET',
                'path' => '/vpcs/{vpc-id}/nat-gateway/{nat-gateway-id}/global/firewall-rules',
                'operation_id' => 'list-nat-gateway-firewall-rules',
                'name' => 'List NAT Gateway Firewall Rules',
                'description' => 'List NAT Gateway Firewall Rules',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'vpc_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nat-gateway-id',
                        'argument_name' => 'nat_gateway_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NAT Gateway IDoperation/list-nat-gateways.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_create_nat_gateway_firewall_rule' => [
                'class' => 'VultrCreateNatGatewayFirewallRule',
                'method' => 'POST',
                'path' => '/vpcs/{vpc-id}/nat-gateway/{nat-gateway-id}/global/firewall-rules',
                'operation_id' => 'create-nat-gateway-firewall-rule',
                'name' => 'Create NAT Gateway Firewall Rule',
                'description' => 'Create NAT Gateway Firewall Rule',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'vpc_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nat-gateway-id',
                        'argument_name' => 'nat_gateway_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NAT Gateway IDoperation/list-nat-gateways.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_get_nat_gateway_firewall_rule' => [
                'class' => 'VultrGetNatGatewayFirewallRule',
                'method' => 'GET',
                'path' => '/vpcs/{vpc-id}/nat-gateway/{nat-gateway-id}/global/firewall-rules/{firewall-rule-id}',
                'operation_id' => 'get-nat-gateway-firewall-rule',
                'name' => 'Get NAT Gateway Firewall Rule',
                'description' => 'Get NAT Gateway Firewall Rule',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'vpc_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nat-gateway-id',
                        'argument_name' => 'nat_gateway_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NAT Gateway IDoperation/list-nat-gateways.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'firewall-rule-id',
                        'argument_name' => 'firewall_rule_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Firewall Rule IDoperation/list-nat-gateway-firewall-rules.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_update_nat_gateway_firewall_rule' => [
                'class' => 'VultrUpdateNatGatewayFirewallRule',
                'method' => 'PUT',
                'path' => '/vpcs/{vpc-id}/nat-gateway/{nat-gateway-id}/global/firewall-rules/{firewall-rule-id}',
                'operation_id' => 'update-nat-gateway-firewall-rule',
                'name' => 'Update NAT Gateway Firewall Rule',
                'description' => 'Update NAT Gateway Firewall Rule',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'vpc_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nat-gateway-id',
                        'argument_name' => 'nat_gateway_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NAT Gateway IDoperation/list-nat-gateways.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'firewall-rule-id',
                        'argument_name' => 'firewall_rule_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Firewall Rule IDoperation/list-nat-gateway-firewall-rules.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_delete_nat_gateway_firewall_rule' => [
                'class' => 'VultrDeleteNatGatewayFirewallRule',
                'method' => 'DELETE',
                'path' => '/vpcs/{vpc-id}/nat-gateway/{nat-gateway-id}/global/firewall-rules/{firewall-rule-id}',
                'operation_id' => 'delete-nat-gateway-firewall-rule',
                'name' => 'Delete NAT Gateway Firewall Rule',
                'description' => 'Delete NAT Gateway Firewall Rule',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'vpc_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nat-gateway-id',
                        'argument_name' => 'nat_gateway_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NAT Gateway IDoperation/list-nat-gateways.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'firewall-rule-id',
                        'argument_name' => 'firewall_rule_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Firewall Rule IDoperation/list-nat-gateway-firewall-rules.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_list_nat_gateway_port_forwarding_rules' => [
                'class' => 'VultrListNatGatewayPortForwardingRules',
                'method' => 'GET',
                'path' => '/vpcs/{vpc-id}/nat-gateway/{nat-gateway-id}/global/port-forwarding-rules',
                'operation_id' => 'list-nat-gateway-port-forwarding-rules',
                'name' => 'List NAT Gateway Port Forwarding Rules',
                'description' => 'List NAT Gateway Port Forwarding Rules',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'vpc_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nat-gateway-id',
                        'argument_name' => 'nat_gateway_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NAT Gateway IDoperation/list-nat-gateways.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_create_nat_gateway_port_forwarding_rule' => [
                'class' => 'VultrCreateNatGatewayPortForwardingRule',
                'method' => 'POST',
                'path' => '/vpcs/{vpc-id}/nat-gateway/{nat-gateway-id}/global/port-forwarding-rules',
                'operation_id' => 'create-nat-gateway-port-forwarding-rule',
                'name' => 'Create NAT Gateway Port Forwarding Rule',
                'description' => 'Create NAT Gateway Port Forwarding Rule',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'vpc_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nat-gateway-id',
                        'argument_name' => 'nat_gateway_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NAT Gateway IDoperation/list-nat-gateways.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_get_nat_gateway_port_forwarding_rule' => [
                'class' => 'VultrGetNatGatewayPortForwardingRule',
                'method' => 'GET',
                'path' => '/vpcs/{vpc-id}/nat-gateway/{nat-gateway-id}/global/port-forwarding-rules/{port-forwarding-rule-id}',
                'operation_id' => 'get-nat-gateway-port-forwarding-rule',
                'name' => 'Get NAT Gateway Port Forwarding Rule',
                'description' => 'Get NAT Gateway Port Forwarding Rule',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'vpc_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nat-gateway-id',
                        'argument_name' => 'nat_gateway_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NAT Gateway IDoperation/list-nat-gateways.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'port-forwarding-rule-id',
                        'argument_name' => 'port_forwarding_rule_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Port Forwarding Rule IDoperation/list-nat-gateway-port-forwarding-rules.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_update_nat_gateway_port_forwarding_rule' => [
                'class' => 'VultrUpdateNatGatewayPortForwardingRule',
                'method' => 'PUT',
                'path' => '/vpcs/{vpc-id}/nat-gateway/{nat-gateway-id}/global/port-forwarding-rules/{port-forwarding-rule-id}',
                'operation_id' => 'update-nat-gateway-port-forwarding-rule',
                'name' => 'Update NAT Gateway Port Forwarding Rule',
                'description' => 'Update NAT Gateway Port Forwarding Rule',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'vpc_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nat-gateway-id',
                        'argument_name' => 'nat_gateway_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NAT Gateway IDoperation/list-nat-gateways.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'port-forwarding-rule-id',
                        'argument_name' => 'port_forwarding_rule_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Port Forwarding Rule IDoperation/list-nat-gateway-port-forwarding-rules.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_delete_nat_gateway_port_forwarding_rule' => [
                'class' => 'VultrDeleteNatGatewayPortForwardingRule',
                'method' => 'DELETE',
                'path' => '/vpcs/{vpc-id}/nat-gateway/{nat-gateway-id}/global/port-forwarding-rules/{port-forwarding-rule-id}',
                'operation_id' => 'delete-nat-gateway-port-forwarding-rule',
                'name' => 'Delete NAT Gateway Port Forwarding Rule',
                'description' => 'Delete NAT Gateway Port Forwarding Rule',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'vpc_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nat-gateway-id',
                        'argument_name' => 'nat_gateway_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NAT Gateway IDoperation/list-nat-gateways.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'port-forwarding-rule-id',
                        'argument_name' => 'port_forwarding_rule_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Port Forwarding Rule IDoperation/list-nat-gateway-port-forwarding-rules.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VPCs'
                ]
            ],
            'vultr_get_vpc2' => [
                'class' => 'VultrGetVpc2',
                'method' => 'GET',
                'path' => '/vpc2/{vpc-id}',
                'operation_id' => 'get-vpc2',
                'name' => 'Get a VPC 2.0 network',
                'description' => 'Get a VPC 2.0 network',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vpc_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VPC2'
                ]
            ],
            'vultr_delete_vpc2' => [
                'class' => 'VultrDeleteVpc2',
                'method' => 'DELETE',
                'path' => '/vpc2/{vpc-id}',
                'operation_id' => 'delete-vpc2',
                'name' => 'Delete a VPC 2.0 network',
                'description' => 'Delete a VPC 2.0 network',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vpc_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VPC2'
                ]
            ],
            'vultr_update_vpc2' => [
                'class' => 'VultrUpdateVpc2',
                'method' => 'PUT',
                'path' => '/vpc2/{vpc-id}',
                'operation_id' => 'update-vpc2',
                'name' => 'Update a VPC 2.0 network',
                'description' => 'Update a VPC 2.0 network',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vpc_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'VPC2'
                ]
            ],
            'vultr_list_vpc2' => [
                'class' => 'VultrListVpc2',
                'method' => 'GET',
                'path' => '/vpc2',
                'operation_id' => 'list-vpc2',
                'name' => 'List VPC 2.0 networks',
                'description' => 'List VPC 2.0 networks',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VPC2'
                ]
            ],
            'vultr_create_vpc2' => [
                'class' => 'VultrCreateVpc2',
                'method' => 'POST',
                'path' => '/vpc2',
                'operation_id' => 'create-vpc2',
                'name' => 'Create a VPC 2.0 network',
                'description' => 'Create a VPC 2.0 network',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'VPC2'
                ]
            ],
            'vultr_list_vpc2_nodes' => [
                'class' => 'VultrListVpc2Nodes',
                'method' => 'GET',
                'path' => '/vpc2/{vpc-id}/nodes',
                'operation_id' => 'list-vpc2-nodes',
                'name' => 'Get a list of nodes attached to a VPC 2.0 network',
                'description' => 'Get a list of nodes attached to a VPC 2.0 network',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vpc_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VPC2'
                ]
            ],
            'vultr_attach_vpc2_nodes' => [
                'class' => 'VultrAttachVpc2Nodes',
                'method' => 'POST',
                'path' => '/vpc2/{vpc-id}/nodes/attach',
                'operation_id' => 'attach-vpc2-nodes',
                'name' => 'Attach nodes to a VPC 2.0 network',
                'description' => 'Attach nodes to a VPC 2.0 network',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vpc_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'VPC2'
                ]
            ],
            'vultr_detach_vpc2_nodes' => [
                'class' => 'VultrDetachVpc2Nodes',
                'method' => 'POST',
                'path' => '/vpc2/{vpc-id}/nodes/detach',
                'operation_id' => 'detach-vpc2-nodes',
                'name' => 'Remove nodes from a VPC 2.0 network',
                'description' => 'Remove nodes from a VPC 2.0 network',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vpc-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VPC IDoperation/list-vpcs.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vpc_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'VPC2'
                ]
            ],
            'vultr_get_user' => [
                'class' => 'VultrGetUser',
                'method' => 'GET',
                'path' => '/users/{user-id}',
                'operation_id' => 'get-user',
                'name' => 'Get User',
                'description' => 'Get User',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'user-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User idoperation/list-users.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'user_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'users'
                ]
            ],
            'vultr_delete_user' => [
                'class' => 'VultrDeleteUser',
                'method' => 'DELETE',
                'path' => '/users/{user-id}',
                'operation_id' => 'delete-user',
                'name' => 'Delete User',
                'description' => 'Delete User',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'user-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User idoperation/list-users.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'user_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'users'
                ]
            ],
            'vultr_update_user' => [
                'class' => 'VultrUpdateUser',
                'method' => 'PATCH',
                'path' => '/users/{user-id}',
                'operation_id' => 'update-user',
                'name' => 'Update User',
                'description' => 'Update User',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'user-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User idoperation/list-users.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'user_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'users'
                ]
            ],
            'vultr_get_user_ip_whitelist_entry' => [
                'class' => 'VultrGetUserIpWhitelistEntry',
                'method' => 'GET',
                'path' => '/users/{user-id}/ip-whitelist/entry',
                'operation_id' => 'get-user-ip-whitelist-entry',
                'name' => 'Get User IP Whitelist Entry',
                'description' => 'Get User IP Whitelist Entry',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'user-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User idoperation/list-users.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'user_id'
                        ]
                    ],
                    [
                        'name' => 'subnet',
                        'argument_name' => 'subnet',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'The IP address or subnet.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'subnet_size',
                        'argument_name' => 'subnet_size',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'The subnet size.',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'users'
                ]
            ],
            'vultr_list_user_ip_whitelist' => [
                'class' => 'VultrListUserIpWhitelist',
                'method' => 'GET',
                'path' => '/users/{user-id}/ip-whitelist',
                'operation_id' => 'list-user-ip-whitelist',
                'name' => 'List User IP Whitelist',
                'description' => 'List User IP Whitelist',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'user-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User idoperation/list-users.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'user_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'users'
                ]
            ],
            'vultr_add_user_ip_whitelist' => [
                'class' => 'VultrAddUserIpWhitelist',
                'method' => 'POST',
                'path' => '/users/{user-id}/ip-whitelist',
                'operation_id' => 'add-user-ip-whitelist',
                'name' => 'Add IP to User Whitelist',
                'description' => 'Add IP to User Whitelist',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'user-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User idoperation/list-users.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'user_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'users'
                ]
            ],
            'vultr_remove_user_ip_whitelist' => [
                'class' => 'VultrRemoveUserIpWhitelist',
                'method' => 'DELETE',
                'path' => '/users/{user-id}/ip-whitelist',
                'operation_id' => 'remove-user-ip-whitelist',
                'name' => 'Remove IP from User Whitelist',
                'description' => 'Remove IP from User Whitelist',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'user-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User idoperation/list-users.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'user_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'users'
                ]
            ],
            'vultr_list_user_api_keys' => [
                'class' => 'VultrListUserApiKeys',
                'method' => 'GET',
                'path' => '/users/{user-id}/apikeys',
                'operation_id' => 'list-user-api-keys',
                'name' => 'List User API Keys',
                'description' => 'List User API Keys',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'user-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User idoperation/list-users.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'user_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'users'
                ]
            ],
            'vultr_create_user_api_key' => [
                'class' => 'VultrCreateUserApiKey',
                'method' => 'POST',
                'path' => '/users/{user-id}/apikeys',
                'operation_id' => 'create-user-api-key',
                'name' => 'Create User API Key',
                'description' => 'Create User API Key',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'user-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User idoperation/list-users.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'user_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'users'
                ]
            ],
            'vultr_get_user_api_key' => [
                'class' => 'VultrGetUserApiKey',
                'method' => 'GET',
                'path' => '/users/{user-id}/apikeys/{apikey-id}',
                'operation_id' => 'get-user-api-key',
                'name' => 'Get User API Key',
                'description' => 'Get User API Key',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'user-id',
                        'argument_name' => 'user_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User idoperation/list-users.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'apikey-id',
                        'argument_name' => 'apikey_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The API key idoperation/list-user-api-keys.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'users'
                ]
            ],
            'vultr_delete_user_api_key' => [
                'class' => 'VultrDeleteUserApiKey',
                'method' => 'DELETE',
                'path' => '/users/{user-id}/apikeys/{apikey-id}',
                'operation_id' => 'delete-user-api-key',
                'name' => 'Delete User API Key',
                'description' => 'Delete User API Key',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'user-id',
                        'argument_name' => 'user_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User idoperation/list-users.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'apikey-id',
                        'argument_name' => 'apikey_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The API key idoperation/list-user-api-keys.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'users'
                ]
            ],
            'vultr_list_users' => [
                'class' => 'VultrListUsers',
                'method' => 'GET',
                'path' => '/users',
                'operation_id' => 'list-users',
                'name' => 'Get Users',
                'description' => 'Get Users',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'users'
                ]
            ],
            'vultr_create_user' => [
                'class' => 'VultrCreateUser',
                'method' => 'POST',
                'path' => '/users',
                'operation_id' => 'create-user',
                'name' => 'Create User',
                'description' => 'Create User',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'users'
                ]
            ],
            'vultr_get_startup_script' => [
                'class' => 'VultrGetStartupScript',
                'method' => 'GET',
                'path' => '/startup-scripts/{startup-id}',
                'operation_id' => 'get-startup-script',
                'name' => 'Get Startup Script',
                'description' => 'Get Startup Script',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'startup-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Startup Script idoperation/list-startup-scripts.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'startup_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'startup'
                ]
            ],
            'vultr_delete_startup_script' => [
                'class' => 'VultrDeleteStartupScript',
                'method' => 'DELETE',
                'path' => '/startup-scripts/{startup-id}',
                'operation_id' => 'delete-startup-script',
                'name' => 'Delete Startup Script',
                'description' => 'Delete Startup Script',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'startup-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Startup Script idoperation/list-startup-scripts.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'startup_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'startup'
                ]
            ],
            'vultr_update_startup_script' => [
                'class' => 'VultrUpdateStartupScript',
                'method' => 'PATCH',
                'path' => '/startup-scripts/{startup-id}',
                'operation_id' => 'update-startup-script',
                'name' => 'Update Startup Script',
                'description' => 'Update Startup Script',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'startup-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Startup Script idoperation/list-startup-scripts.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'startup_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'startup'
                ]
            ],
            'vultr_list_startup_scripts' => [
                'class' => 'VultrListStartupScripts',
                'method' => 'GET',
                'path' => '/startup-scripts',
                'operation_id' => 'list-startup-scripts',
                'name' => 'List Startup Scripts',
                'description' => 'List Startup Scripts',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'startup'
                ]
            ],
            'vultr_create_startup_script' => [
                'class' => 'VultrCreateStartupScript',
                'method' => 'POST',
                'path' => '/startup-scripts',
                'operation_id' => 'create-startup-script',
                'name' => 'Create Startup Script',
                'description' => 'Create Startup Script',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'startup'
                ]
            ],
            'vultr_get_ssh_key' => [
                'class' => 'VultrGetSshKey',
                'method' => 'GET',
                'path' => '/ssh-keys/{ssh-key-id}',
                'operation_id' => 'get-ssh-key',
                'name' => 'Get SSH Key',
                'description' => 'Get SSH Key',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'ssh-key-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The SSH Key idoperation/list-ssh-keys.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'ssh_key_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'ssh'
                ]
            ],
            'vultr_update_ssh_key' => [
                'class' => 'VultrUpdateSshKey',
                'method' => 'PATCH',
                'path' => '/ssh-keys/{ssh-key-id}',
                'operation_id' => 'update-ssh-key',
                'name' => 'Update SSH Key',
                'description' => 'Update SSH Key',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'ssh-key-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The SSH Key idoperation/list-ssh-keys.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'ssh_key_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'ssh'
                ]
            ],
            'vultr_delete_ssh_key' => [
                'class' => 'VultrDeleteSshKey',
                'method' => 'DELETE',
                'path' => '/ssh-keys/{ssh-key-id}',
                'operation_id' => 'delete-ssh-key',
                'name' => 'Delete SSH Key',
                'description' => 'Delete SSH Key',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'ssh-key-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The SSH Key idoperation/list-ssh-keys.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'ssh_key_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'ssh'
                ]
            ],
            'vultr_list_ssh_keys' => [
                'class' => 'VultrListSshKeys',
                'method' => 'GET',
                'path' => '/ssh-keys',
                'operation_id' => 'list-ssh-keys',
                'name' => 'List SSH Keys',
                'description' => 'List SSH Keys',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'ssh'
                ]
            ],
            'vultr_create_ssh_key' => [
                'class' => 'VultrCreateSshKey',
                'method' => 'POST',
                'path' => '/ssh-keys',
                'operation_id' => 'create-ssh-key',
                'name' => 'Create SSH key',
                'description' => 'Create SSH key',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'ssh'
                ]
            ],
            'vultr_delete_snapshot' => [
                'class' => 'VultrDeleteSnapshot',
                'method' => 'DELETE',
                'path' => '/snapshots/{snapshot-id}',
                'operation_id' => 'delete-snapshot',
                'name' => 'Delete Snapshot',
                'description' => 'Delete Snapshot',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'snapshot-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Snapshot idoperation/list-snapshots.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'snapshot_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'snapshot'
                ]
            ],
            'vultr_get_snapshot' => [
                'class' => 'VultrGetSnapshot',
                'method' => 'GET',
                'path' => '/snapshots/{snapshot-id}',
                'operation_id' => 'get-snapshot',
                'name' => 'Get Snapshot',
                'description' => 'Get Snapshot',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'snapshot-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Snapshot idoperation/list-snapshots.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'snapshot_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'snapshot'
                ]
            ],
            'vultr_put_snapshots_snapshot_id' => [
                'class' => 'VultrPutSnapshotsSnapshotId',
                'method' => 'PUT',
                'path' => '/snapshots/{snapshot-id}',
                'operation_id' => 'put-snapshots-snapshot-id',
                'name' => 'Update Snapshot',
                'description' => 'Update Snapshot',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'snapshot-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Snapshot idoperation/list-snapshots.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'snapshot_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'snapshot'
                ]
            ],
            'vultr_list_snapshots' => [
                'class' => 'VultrListSnapshots',
                'method' => 'GET',
                'path' => '/snapshots',
                'operation_id' => 'list-snapshots',
                'name' => 'List Snapshots',
                'description' => 'List Snapshots',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'description',
                        'argument_name' => 'description',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the list of Snapshots by description',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'snapshot'
                ]
            ],
            'vultr_create_snapshot' => [
                'class' => 'VultrCreateSnapshot',
                'method' => 'POST',
                'path' => '/snapshots',
                'operation_id' => 'create-snapshot',
                'name' => 'Create Snapshot',
                'description' => 'Create Snapshot',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'snapshot'
                ]
            ],
            'vultr_create_snapshot_create_from_url' => [
                'class' => 'VultrCreateSnapshotCreateFromUrl',
                'method' => 'POST',
                'path' => '/snapshots/create-from-url',
                'operation_id' => 'create-snapshot-create-from-url',
                'name' => 'Create Snapshot from URL',
                'description' => 'Create Snapshot from URL',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'snapshot'
                ]
            ],
            'vultr_list_subaccounts' => [
                'class' => 'VultrListSubaccounts',
                'method' => 'GET',
                'path' => '/subaccounts',
                'operation_id' => 'list-subaccounts',
                'name' => 'List Sub-Accounts',
                'description' => 'List Sub-Accounts',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'subaccount'
                ]
            ],
            'vultr_create_subaccount' => [
                'class' => 'VultrCreateSubaccount',
                'method' => 'POST',
                'path' => '/subaccounts',
                'operation_id' => 'create-subaccount',
                'name' => 'Create Sub-Account',
                'description' => 'Create Sub-Account',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'subaccount'
                ]
            ],
            'vultr_get_reserved_ip' => [
                'class' => 'VultrGetReservedIp',
                'method' => 'GET',
                'path' => '/reserved-ips/{reserved-ip}',
                'operation_id' => 'get-reserved-ip',
                'name' => 'Get Reserved IP',
                'description' => 'Get Reserved IP',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'reserved-ip',
                        'argument_name' => 'reserved_ip',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Reserved IP idoperation/list-reserved-ips.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'reserved-ip'
                ]
            ],
            'vultr_delete_reserved_ip' => [
                'class' => 'VultrDeleteReservedIp',
                'method' => 'DELETE',
                'path' => '/reserved-ips/{reserved-ip}',
                'operation_id' => 'delete-reserved-ip',
                'name' => 'Delete Reserved IP',
                'description' => 'Delete Reserved IP',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'reserved-ip',
                        'argument_name' => 'reserved_ip',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Reserved IP idoperation/list-reserved-ips.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'reserved-ip'
                ]
            ],
            'vultr_patch_reserved_ips_reserved_ip' => [
                'class' => 'VultrPatchReservedIpsReservedIp',
                'method' => 'PATCH',
                'path' => '/reserved-ips/{reserved-ip}',
                'operation_id' => 'patch-reserved-ips-reserved-ip',
                'name' => 'Update Reserved IP',
                'description' => 'Update Reserved IP',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'reserved-ip',
                        'argument_name' => 'reserved_ip',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Reserved IP idoperation/list-reserved-ips.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'reserved-ip'
                ]
            ],
            'vultr_list_reserved_ips' => [
                'class' => 'VultrListReservedIps',
                'method' => 'GET',
                'path' => '/reserved-ips',
                'operation_id' => 'list-reserved-ips',
                'name' => 'List Reserved IPs',
                'description' => 'List Reserved IPs',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'reserved-ip'
                ]
            ],
            'vultr_create_reserved_ip' => [
                'class' => 'VultrCreateReservedIp',
                'method' => 'POST',
                'path' => '/reserved-ips',
                'operation_id' => 'create-reserved-ip',
                'name' => 'Create Reserved IP',
                'description' => 'Create Reserved IP',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'reserved-ip'
                ]
            ],
            'vultr_attach_reserved_ip' => [
                'class' => 'VultrAttachReservedIp',
                'method' => 'POST',
                'path' => '/reserved-ips/{reserved-ip}/attach',
                'operation_id' => 'attach-reserved-ip',
                'name' => 'Attach Reserved IP',
                'description' => 'Attach Reserved IP',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'reserved-ip',
                        'argument_name' => 'reserved_ip',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Reserved IP idoperation/list-reserved-ips',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'reserved-ip'
                ]
            ],
            'vultr_detach_reserved_ip' => [
                'class' => 'VultrDetachReservedIp',
                'method' => 'POST',
                'path' => '/reserved-ips/{reserved-ip}/detach',
                'operation_id' => 'detach-reserved-ip',
                'name' => 'Detach Reserved IP',
                'description' => 'Detach Reserved IP',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'reserved-ip',
                        'argument_name' => 'reserved_ip',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Reserved IP idoperation/list-reserved-ips',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'reserved-ip'
                ]
            ],
            'vultr_convert_reserved_ip' => [
                'class' => 'VultrConvertReservedIp',
                'method' => 'POST',
                'path' => '/reserved-ips/convert',
                'operation_id' => 'convert-reserved-ip',
                'name' => 'Convert Instance IP to Reserved IP',
                'description' => 'Convert Instance IP to Reserved IP',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'reserved-ip'
                ]
            ],
            'vultr_list_os' => [
                'class' => 'VultrListOs',
                'method' => 'GET',
                'path' => '/os',
                'operation_id' => 'list-os',
                'name' => 'List OS',
                'description' => 'List OS',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'os'
                ]
            ],
            'vultr_get_api_key' => [
                'class' => 'VultrGetApiKey',
                'method' => 'GET',
                'path' => '/apikeys/{apikey-id}',
                'operation_id' => 'get-api-key',
                'name' => 'Get API Key',
                'description' => 'Get API Key',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'api-keys'
                ]
            ],
            'vultr_delete_api_key' => [
                'class' => 'VultrDeleteApiKey',
                'method' => 'DELETE',
                'path' => '/apikeys/{apikey-id}',
                'operation_id' => 'delete-api-key',
                'name' => 'Delete API Key',
                'description' => 'Delete API Key',
                'type' => 'write',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'api-keys'
                ]
            ],
            'vultr_list_api_keys' => [
                'class' => 'VultrListApiKeys',
                'method' => 'GET',
                'path' => '/apikeys',
                'operation_id' => 'list-api-keys',
                'name' => 'List API Keys',
                'description' => 'List API Keys',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'api-keys'
                ]
            ],
            'vultr_create_api_key' => [
                'class' => 'VultrCreateApiKey',
                'method' => 'POST',
                'path' => '/apikeys',
                'operation_id' => 'create-api-key',
                'name' => 'Create API Key',
                'description' => 'Create API Key',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'api-keys'
                ]
            ],
            'vultr_list_applications' => [
                'class' => 'VultrListApplications',
                'method' => 'GET',
                'path' => '/applications',
                'operation_id' => 'list-applications',
                'name' => 'List Applications',
                'description' => 'List Applications',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'type',
                        'argument_name' => 'type',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by type. | | Type | Description | | - | ------ | ------------- | | | all | All available application types | | | marketplace | Marketplace applications | | | one-click | Vultr One-Click applications |',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'application'
                ]
            ],
            'vultr_get_current_user' => [
                'class' => 'VultrGetCurrentUser',
                'method' => 'GET',
                'path' => '/account',
                'operation_id' => 'get-account',
                'name' => 'Get Account Info',
                'description' => 'Get Account Info',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'account'
                ]
            ],
            'vultr_get_account_bgp' => [
                'class' => 'VultrGetAccountBgp',
                'method' => 'GET',
                'path' => '/account/bgp',
                'operation_id' => 'get-account-bgp',
                'name' => 'Get Account BGP Info',
                'description' => 'Get Account BGP Info',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'account'
                ]
            ],
            'vultr_create_account_bgp_setup' => [
                'class' => 'VultrCreateAccountBgpSetup',
                'method' => 'POST',
                'path' => '/account/bgp/setup',
                'operation_id' => 'create-account-bgp-setup',
                'name' => 'Setup BGP on your Account',
                'description' => 'Setup BGP on your Account',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'account'
                ]
            ],
            'vultr_get_account_bandwidth' => [
                'class' => 'VultrGetAccountBandwidth',
                'method' => 'GET',
                'path' => '/account/bandwidth',
                'operation_id' => 'get-account-bandwidth',
                'name' => 'Get Account Bandwidth Info',
                'description' => 'Get Account Bandwidth Info',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'account'
                ]
            ],
            'vultr_list_custom_subscriptions' => [
                'class' => 'VultrListCustomSubscriptions',
                'method' => 'GET',
                'path' => '/account/custom-subscriptions',
                'operation_id' => 'list-custom-subscriptions',
                'name' => 'List Custom Subscriptions',
                'description' => 'List Custom Subscriptions',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'account'
                ]
            ],
            'vultr_list_backups' => [
                'class' => 'VultrListBackups',
                'method' => 'GET',
                'path' => '/backups',
                'operation_id' => 'list-backups',
                'name' => 'List Backups',
                'description' => 'List Backups',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'instance_id',
                        'argument_name' => 'instance_id',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the backup list by Instance idoperation/list-instances.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'backup'
                ]
            ],
            'vultr_list_blocks' => [
                'class' => 'VultrListBlocks',
                'method' => 'GET',
                'path' => '/blocks',
                'operation_id' => 'list-blocks',
                'name' => 'List Block storages',
                'description' => 'List Block storages',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'block'
                ]
            ],
            'vultr_create_block' => [
                'class' => 'VultrCreateBlock',
                'method' => 'POST',
                'path' => '/blocks',
                'operation_id' => 'create-block',
                'name' => 'Create Block Storage',
                'description' => 'Create Block Storage',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'block'
                ]
            ],
            'vultr_list_block_snapshots' => [
                'class' => 'VultrListBlockSnapshots',
                'method' => 'GET',
                'path' => '/blocks/snapshots',
                'operation_id' => 'list-block-snapshots',
                'name' => 'List Block storage snapshots',
                'description' => 'List Block storage snapshots',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'block'
                ]
            ],
            'vultr_create_block_snapshot' => [
                'class' => 'VultrCreateBlockSnapshot',
                'method' => 'POST',
                'path' => '/blocks/snapshots',
                'operation_id' => 'create-block-snapshot',
                'name' => 'Create Block Storage Snapshot',
                'description' => 'Create Block Storage Snapshot',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'block'
                ]
            ],
            'vultr_get_block_snapshot' => [
                'class' => 'VultrGetBlockSnapshot',
                'method' => 'GET',
                'path' => '/blocks/snapshots/{snapshot-id}',
                'operation_id' => 'get-block-snapshot',
                'name' => 'Get Block Storage Snapshots',
                'description' => 'Get Block Storage Snapshots',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'snapshot-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Block Storage snapshot idoperation/list-block-snapshots.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'snapshot_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'block'
                ]
            ],
            'vultr_delete_block_snapshot' => [
                'class' => 'VultrDeleteBlockSnapshot',
                'method' => 'DELETE',
                'path' => '/blocks/snapshots/{snapshot-id}',
                'operation_id' => 'delete-block-snapshot',
                'name' => 'Delete Block Storage Snapshot',
                'description' => 'Delete Block Storage Snapshot',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'snapshot-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Block Storage snapshot idoperation/list-block-snapshots.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'snapshot_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'block'
                ]
            ],
            'vultr_update_block_snapshot' => [
                'class' => 'VultrUpdateBlockSnapshot',
                'method' => 'PUT',
                'path' => '/blocks/snapshots/{snapshot-id}',
                'operation_id' => 'update-block-snapshot',
                'name' => 'Update Block Storage Snapshot',
                'description' => 'Update Block Storage Snapshot',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'snapshot-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Block Storage snapshot idoperation/list-block-snapshots.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'snapshot_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'block'
                ]
            ],
            'vultr_get_block' => [
                'class' => 'VultrGetBlock',
                'method' => 'GET',
                'path' => '/blocks/{block-id}',
                'operation_id' => 'get-block',
                'name' => 'Get Block Storage',
                'description' => 'Get Block Storage',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'block-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Block Storage idoperation/list-blocks.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'block_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'block'
                ]
            ],
            'vultr_delete_block' => [
                'class' => 'VultrDeleteBlock',
                'method' => 'DELETE',
                'path' => '/blocks/{block-id}',
                'operation_id' => 'delete-block',
                'name' => 'Delete Block Storage',
                'description' => 'Delete Block Storage',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'block-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Block Storage idoperation/list-blocks.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'block_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'block'
                ]
            ],
            'vultr_update_block' => [
                'class' => 'VultrUpdateBlock',
                'method' => 'PATCH',
                'path' => '/blocks/{block-id}',
                'operation_id' => 'update-block',
                'name' => 'Update Block Storage',
                'description' => 'Update Block Storage',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'block-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Block Storage idoperation/list-blocks.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'block_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'block'
                ]
            ],
            'vultr_attach_block' => [
                'class' => 'VultrAttachBlock',
                'method' => 'POST',
                'path' => '/blocks/{block-id}/attach',
                'operation_id' => 'attach-block',
                'name' => 'Attach Block Storage',
                'description' => 'Attach Block Storage',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'block-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Block Storage idoperation/list-blocks.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'block_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'block'
                ]
            ],
            'vultr_detach_block' => [
                'class' => 'VultrDetachBlock',
                'method' => 'POST',
                'path' => '/blocks/{block-id}/detach',
                'operation_id' => 'detach-block',
                'name' => 'Detach Block Storage',
                'description' => 'Detach Block Storage',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'block-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Block Storage idoperation/list-blocks.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'block_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'block'
                ]
            ],
            'vultr_list_firewall_groups' => [
                'class' => 'VultrListFirewallGroups',
                'method' => 'GET',
                'path' => '/firewalls',
                'operation_id' => 'list-firewall-groups',
                'name' => 'List Firewall Groups',
                'description' => 'List Firewall Groups',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'firewall'
                ]
            ],
            'vultr_create_firewall_group' => [
                'class' => 'VultrCreateFirewallGroup',
                'method' => 'POST',
                'path' => '/firewalls',
                'operation_id' => 'create-firewall-group',
                'name' => 'Create Firewall Group',
                'description' => 'Create Firewall Group',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'firewall'
                ]
            ],
            'vultr_get_firewall_group' => [
                'class' => 'VultrGetFirewallGroup',
                'method' => 'GET',
                'path' => '/firewalls/{firewall-group-id}',
                'operation_id' => 'get-firewall-group',
                'name' => 'Get Firewall Group',
                'description' => 'Get Firewall Group',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'firewall-group-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Firewall Group idoperation/list-firewall-groups.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'firewall_group_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'firewall'
                ]
            ],
            'vultr_update_firewall_group' => [
                'class' => 'VultrUpdateFirewallGroup',
                'method' => 'PUT',
                'path' => '/firewalls/{firewall-group-id}',
                'operation_id' => 'update-firewall-group',
                'name' => 'Update Firewall Group',
                'description' => 'Update Firewall Group',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'firewall-group-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Firewall Group idoperation/list-firewall-groups.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'firewall_group_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'firewall'
                ]
            ],
            'vultr_delete_firewall_group' => [
                'class' => 'VultrDeleteFirewallGroup',
                'method' => 'DELETE',
                'path' => '/firewalls/{firewall-group-id}',
                'operation_id' => 'delete-firewall-group',
                'name' => 'Delete Firewall Group',
                'description' => 'Delete Firewall Group',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'firewall-group-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Firewall Group idoperation/list-firewall-groups.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'firewall_group_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'firewall'
                ]
            ],
            'vultr_list_firewall_group_rules' => [
                'class' => 'VultrListFirewallGroupRules',
                'method' => 'GET',
                'path' => '/firewalls/{firewall-group-id}/rules',
                'operation_id' => 'list-firewall-group-rules',
                'name' => 'List Firewall Rules',
                'description' => 'List Firewall Rules',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'firewall-group-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Firewall Group idoperation/list-firewall-groups.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'firewall_group_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'firewall'
                ]
            ],
            'vultr_post_firewalls_firewall_group_id_rules' => [
                'class' => 'VultrPostFirewallsFirewallGroupIdRules',
                'method' => 'POST',
                'path' => '/firewalls/{firewall-group-id}/rules',
                'operation_id' => 'post-firewalls-firewall-group-id-rules',
                'name' => 'Create Firewall Rules',
                'description' => 'Create Firewall Rules',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'firewall-group-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Firewall Group idoperation/list-firewall-groups.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'firewall_group_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'firewall'
                ]
            ],
            'vultr_delete_firewall_group_rule' => [
                'class' => 'VultrDeleteFirewallGroupRule',
                'method' => 'DELETE',
                'path' => '/firewalls/{firewall-group-id}/rules/{firewall-rule-id}',
                'operation_id' => 'delete-firewall-group-rule',
                'name' => 'Delete Firewall Rule',
                'description' => 'Delete Firewall Rule',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'firewall-group-id',
                        'argument_name' => 'firewall_group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Firewall Group idoperation/list-firewall-groups.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'firewall-rule-id',
                        'argument_name' => 'firewall_rule_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Firewall Rule idoperation/list-firewall-group-rules.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'firewall'
                ]
            ],
            'vultr_get_firewall_group_rule' => [
                'class' => 'VultrGetFirewallGroupRule',
                'method' => 'GET',
                'path' => '/firewalls/{firewall-group-id}/rules/{firewall-rule-id}',
                'operation_id' => 'get-firewall-group-rule',
                'name' => 'Get Firewall Rule',
                'description' => 'Get Firewall Rule',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'firewall-group-id',
                        'argument_name' => 'firewall_group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Firewall Group idoperation/list-firewall-groups.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'firewall-rule-id',
                        'argument_name' => 'firewall_rule_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Firewall Rule idoperation/list-firewall-group-rules.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'firewall'
                ]
            ],
            'vultr_list_isos' => [
                'class' => 'VultrListIsos',
                'method' => 'GET',
                'path' => '/iso',
                'operation_id' => 'list-isos',
                'name' => 'List ISOs',
                'description' => 'List ISOs',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iso'
                ]
            ],
            'vultr_create_iso' => [
                'class' => 'VultrCreateIso',
                'method' => 'POST',
                'path' => '/iso',
                'operation_id' => 'create-iso',
                'name' => 'Create ISO',
                'description' => 'Create ISO',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'iso'
                ]
            ],
            'vultr_iso_get' => [
                'class' => 'VultrIsoGet',
                'method' => 'GET',
                'path' => '/iso/{iso-id}',
                'operation_id' => 'iso-get',
                'name' => 'Get ISO',
                'description' => 'Get ISO',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'iso-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ISO idoperation/list-isos.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'iso_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iso'
                ]
            ],
            'vultr_iso_edit' => [
                'class' => 'VultrIsoEdit',
                'method' => 'PUT',
                'path' => '/iso/{iso-id}',
                'operation_id' => 'iso-edit',
                'name' => 'Update ISO',
                'description' => 'Update ISO',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'iso-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ISO idoperation/list-isos.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'iso_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'iso'
                ]
            ],
            'vultr_delete_iso' => [
                'class' => 'VultrDeleteIso',
                'method' => 'DELETE',
                'path' => '/iso/{iso-id}',
                'operation_id' => 'delete-iso',
                'name' => 'Delete ISO',
                'description' => 'Delete ISO',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'iso-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ISO idoperation/list-isos.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'iso_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iso'
                ]
            ],
            'vultr_list_public_isos' => [
                'class' => 'VultrListPublicIsos',
                'method' => 'GET',
                'path' => '/iso-public',
                'operation_id' => 'list-public-isos',
                'name' => 'List Public ISOs',
                'description' => 'List Public ISOs',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'iso'
                ]
            ],
            'vultr_list_object_storages' => [
                'class' => 'VultrListObjectStorages',
                'method' => 'GET',
                'path' => '/object-storage',
                'operation_id' => 'list-object-storages',
                'name' => 'List Object Storages',
                'description' => 'List Object Storages',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    's3'
                ]
            ],
            'vultr_create_object_storage' => [
                'class' => 'VultrCreateObjectStorage',
                'method' => 'POST',
                'path' => '/object-storage',
                'operation_id' => 'create-object-storage',
                'name' => 'Create Object Storage',
                'description' => 'Create Object Storage',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    's3'
                ]
            ],
            'vultr_get_object_storage' => [
                'class' => 'VultrGetObjectStorage',
                'method' => 'GET',
                'path' => '/object-storage/{object-storage-id}',
                'operation_id' => 'get-object-storage',
                'name' => 'Get Object Storage',
                'description' => 'Get Object Storage',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'object-storage-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Object Storage idoperation/list-object-storages.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'object_storage_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    's3'
                ]
            ],
            'vultr_delete_object_storage' => [
                'class' => 'VultrDeleteObjectStorage',
                'method' => 'DELETE',
                'path' => '/object-storage/{object-storage-id}',
                'operation_id' => 'delete-object-storage',
                'name' => 'Delete Object Storage',
                'description' => 'Delete Object Storage',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'object-storage-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Object Storage idoperation/list-object-storages.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'object_storage_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    's3'
                ]
            ],
            'vultr_update_object_storage' => [
                'class' => 'VultrUpdateObjectStorage',
                'method' => 'PUT',
                'path' => '/object-storage/{object-storage-id}',
                'operation_id' => 'update-object-storage',
                'name' => 'Update Object Storage',
                'description' => 'Update Object Storage',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'object-storage-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Object Storage idoperation/list-object-storages.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'object_storage_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    's3'
                ]
            ],
            'vultr_create_object_storage_bucket' => [
                'class' => 'VultrCreateObjectStorageBucket',
                'method' => 'POST',
                'path' => '/object-storage/{object-storage-id}/bucket',
                'operation_id' => 'create-object-storage-bucket',
                'name' => 'Create Bucket',
                'description' => 'Create Bucket',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'object-storage-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Object Storage idoperation/list-object-storages.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'object_storage_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    's3'
                ]
            ],
            'vultr_delete_object_storage_bucket' => [
                'class' => 'VultrDeleteObjectStorageBucket',
                'method' => 'DELETE',
                'path' => '/object-storage/{object-storage-id}/bucket/{bucket-name}',
                'operation_id' => 'delete-object-storage-bucket',
                'name' => 'Delete Bucket',
                'description' => 'Delete Bucket',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'object-storage-id',
                        'argument_name' => 'object_storage_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Object Storage idoperation/list-object-storages.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'bucket-name',
                        'argument_name' => 'bucket_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The name of the bucket.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    's3'
                ]
            ],
            'vultr_set_object_storage_bucket_lifecycle' => [
                'class' => 'VultrSetObjectStorageBucketLifecycle',
                'method' => 'POST',
                'path' => '/object-storage/{object-storage-id}/bucket/{bucket-name}/lifecycle',
                'operation_id' => 'set-object-storage-bucket-lifecycle',
                'name' => 'Set Bucket Lifecycle Policy',
                'description' => 'Set Bucket Lifecycle Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'object-storage-id',
                        'argument_name' => 'object_storage_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Object Storage idoperation/list-object-storages.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'bucket-name',
                        'argument_name' => 'bucket_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The name of the bucket.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    's3'
                ]
            ],
            'vultr_delete_object_storage_bucket_lifecycle_policy' => [
                'class' => 'VultrDeleteObjectStorageBucketLifecyclePolicy',
                'method' => 'DELETE',
                'path' => '/object-storage/{object-storage-id}/bucket/{bucket-name}/lifecycle',
                'operation_id' => 'delete-object-storage-bucket-lifecycle-policy',
                'name' => 'Delete Bucket Lifecycle Policy',
                'description' => 'Delete Bucket Lifecycle Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'object-storage-id',
                        'argument_name' => 'object_storage_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Object Storage idoperation/list-object-storages.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'bucket-name',
                        'argument_name' => 'bucket_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The name of the bucket.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    's3'
                ]
            ],
            'vultr_set_object_storage_bucket_archival' => [
                'class' => 'VultrSetObjectStorageBucketArchival',
                'method' => 'POST',
                'path' => '/object-storage/{object-storage-id}/bucket/{bucket-name}/archival',
                'operation_id' => 'set-object-storage-bucket-archival',
                'name' => 'Enable Bucket Archival',
                'description' => 'Enable Bucket Archival',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'object-storage-id',
                        'argument_name' => 'object_storage_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Object Storage idoperation/list-object-storages.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'bucket-name',
                        'argument_name' => 'bucket_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The name of the bucket.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    's3'
                ]
            ],
            'vultr_regenerate_object_storage_keys' => [
                'class' => 'VultrRegenerateObjectStorageKeys',
                'method' => 'POST',
                'path' => '/object-storage/{object-storage-id}/regenerate-keys',
                'operation_id' => 'regenerate-object-storage-keys',
                'name' => 'Regenerate Object Storage Keys',
                'description' => 'Regenerate Object Storage Keys',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'object-storage-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Object Storage idoperation/list-object-storages.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'object_storage_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    's3'
                ]
            ],
            'vultr_list_object_storage_clusters' => [
                'class' => 'VultrListObjectStorageClusters',
                'method' => 'GET',
                'path' => '/object-storage/clusters',
                'operation_id' => 'list-object-storage-clusters',
                'name' => 'Get All Clusters',
                'description' => 'Get All Clusters',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    's3'
                ]
            ],
            'vultr_list_object_storage_tiers' => [
                'class' => 'VultrListObjectStorageTiers',
                'method' => 'GET',
                'path' => '/object-storage/tiers',
                'operation_id' => 'list-object-storage-tiers',
                'name' => 'Get All Tiers',
                'description' => 'Get All Tiers',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    's3'
                ]
            ],
            'vultr_list_object_storage_cluster_tiers' => [
                'class' => 'VultrListObjectStorageClusterTiers',
                'method' => 'GET',
                'path' => '/object-storage/clusters/{cluster-id}/tiers',
                'operation_id' => 'list-object-storage-cluster-tiers',
                'name' => 'Get All Cluster Tiers',
                'description' => 'Get All Cluster Tiers',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Cluster idoperation/list-object-storage-clusters.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    's3'
                ]
            ],
            'vultr_list_storage_gateways' => [
                'class' => 'VultrListStorageGateways',
                'method' => 'GET',
                'path' => '/storage-gateways',
                'operation_id' => 'list-storage-gateways',
                'name' => 'List storage gateways',
                'description' => 'List storage gateways',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'storage-gateways'
                ]
            ],
            'vultr_create_storage_gateway' => [
                'class' => 'VultrCreateStorageGateway',
                'method' => 'POST',
                'path' => '/storage-gateways',
                'operation_id' => 'create-storage-gateway',
                'name' => 'Create Storage Gateway',
                'description' => 'Create Storage Gateway',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'storage-gateways'
                ]
            ],
            'vultr_delete_storage_gateway_export' => [
                'class' => 'VultrDeleteStorageGatewayExport',
                'method' => 'DELETE',
                'path' => '/storage-gateways/{storage-gateway-id}/exports/{export-id}',
                'operation_id' => 'delete-storage-gateway-export',
                'name' => 'Delete Storage Gateway Export',
                'description' => 'Delete Storage Gateway Export',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'storage-gateway-id',
                        'argument_name' => 'storage_gateway_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Storage Gateway idoperation/list-storage-gateways.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'export-id',
                        'argument_name' => 'export_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Storage Gateway export idoperation/list-storage-gateways.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'storage-gateways'
                ]
            ],
            'vultr_add_storage_gateway_export' => [
                'class' => 'VultrAddStorageGatewayExport',
                'method' => 'POST',
                'path' => '/storage-gateways/{storage-gateway-id}/exports',
                'operation_id' => 'add-storage-gateway-export',
                'name' => 'Add a new export to this storage gateway',
                'description' => 'Add a new export to this storage gateway',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'storage-gateway-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Storage Gateway idoperation/list-storage-gateways.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'storage_gateway_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'array',
                    'items' => [
                        'type' => 'object'
                    ]
                ],
                'tags' => [
                    'storage-gateways'
                ]
            ],
            'vultr_get_storage_gateway' => [
                'class' => 'VultrGetStorageGateway',
                'method' => 'GET',
                'path' => '/storage-gateways/{storage-gateway-id}',
                'operation_id' => 'get-storage-gateway',
                'name' => 'Get Storage Gateway',
                'description' => 'Get Storage Gateway',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'storage-gateway-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Storage Gateway idoperation/list-storage-gateways.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'storage_gateway_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'storage-gateways'
                ]
            ],
            'vultr_delete_storage_gateway' => [
                'class' => 'VultrDeleteStorageGateway',
                'method' => 'DELETE',
                'path' => '/storage-gateways/{storage-gateway-id}',
                'operation_id' => 'delete-storage-gateway',
                'name' => 'Delete Storage Gateway',
                'description' => 'Delete Storage Gateway',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'storage-gateway-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Storage Gateway idoperation/list-storage-gateways.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'storage_gateway_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'storage-gateways'
                ]
            ],
            'vultr_update_storage_gateway' => [
                'class' => 'VultrUpdateStorageGateway',
                'method' => 'PUT',
                'path' => '/storage-gateways/{storage-gateway-id}',
                'operation_id' => 'update-storage-gateway',
                'name' => 'Update Storage Gateway',
                'description' => 'Update Storage Gateway',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'storage-gateway-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Storage Gateway idoperation/list-storage-gateways.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'storage_gateway_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'storage-gateways'
                ]
            ],
            'vultr_list_dns_domains' => [
                'class' => 'VultrListDnsDomains',
                'method' => 'GET',
                'path' => '/domains',
                'operation_id' => 'list-dns-domains',
                'name' => 'List DNS Domains',
                'description' => 'List DNS Domains',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'dns'
                ]
            ],
            'vultr_create_dns_domain' => [
                'class' => 'VultrCreateDnsDomain',
                'method' => 'POST',
                'path' => '/domains',
                'operation_id' => 'create-dns-domain',
                'name' => 'Create DNS Domain',
                'description' => 'Create DNS Domain',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'dns'
                ]
            ],
            'vultr_get_dns_domain' => [
                'class' => 'VultrGetDnsDomain',
                'method' => 'GET',
                'path' => '/domains/{dns-domain}',
                'operation_id' => 'get-dns-domain',
                'name' => 'Get DNS Domain',
                'description' => 'Get DNS Domain',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'dns-domain',
                        'argument_name' => 'dns_domain',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The DNS Domainoperation/list-dns-domains.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'dns'
                ]
            ],
            'vultr_delete_dns_domain' => [
                'class' => 'VultrDeleteDnsDomain',
                'method' => 'DELETE',
                'path' => '/domains/{dns-domain}',
                'operation_id' => 'delete-dns-domain',
                'name' => 'Delete Domain',
                'description' => 'Delete Domain',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'dns-domain',
                        'argument_name' => 'dns_domain',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The DNS Domainoperation/list-dns-domains.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'dns'
                ]
            ],
            'vultr_update_dns_domain' => [
                'class' => 'VultrUpdateDnsDomain',
                'method' => 'PUT',
                'path' => '/domains/{dns-domain}',
                'operation_id' => 'update-dns-domain',
                'name' => 'Update a DNS Domain',
                'description' => 'Update a DNS Domain',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'dns-domain',
                        'argument_name' => 'dns_domain',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The DNS Domainoperation/list-dns-domains.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'dns'
                ]
            ],
            'vultr_get_dns_domain_soa' => [
                'class' => 'VultrGetDnsDomainSoa',
                'method' => 'GET',
                'path' => '/domains/{dns-domain}/soa',
                'operation_id' => 'get-dns-domain-soa',
                'name' => 'Get SOA information',
                'description' => 'Get SOA information',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'dns-domain',
                        'argument_name' => 'dns_domain',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The DNS Domainoperation/list-dns-domains.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'dns'
                ]
            ],
            'vultr_update_dns_domain_soa' => [
                'class' => 'VultrUpdateDnsDomainSoa',
                'method' => 'PATCH',
                'path' => '/domains/{dns-domain}/soa',
                'operation_id' => 'update-dns-domain-soa',
                'name' => 'Update SOA information',
                'description' => 'Update SOA information',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'dns-domain',
                        'argument_name' => 'dns_domain',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The DNS Domainoperation/list-dns-domains.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'dns'
                ]
            ],
            'vultr_get_dns_domain_dnssec' => [
                'class' => 'VultrGetDnsDomainDnssec',
                'method' => 'GET',
                'path' => '/domains/{dns-domain}/dnssec',
                'operation_id' => 'get-dns-domain-dnssec',
                'name' => 'Get DNSSec Info',
                'description' => 'Get DNSSec Info',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'dns-domain',
                        'argument_name' => 'dns_domain',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The DNS Domainoperation/list-dns-domains.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'dns'
                ]
            ],
            'vultr_create_dns_domain_record' => [
                'class' => 'VultrCreateDnsDomainRecord',
                'method' => 'POST',
                'path' => '/domains/{dns-domain}/records',
                'operation_id' => 'create-dns-domain-record',
                'name' => 'Create Record',
                'description' => 'Create Record',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'dns-domain',
                        'argument_name' => 'dns_domain',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The DNS Domainoperation/list-dns-domains.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'dns'
                ]
            ],
            'vultr_list_dns_domain_records' => [
                'class' => 'VultrListDnsDomainRecords',
                'method' => 'GET',
                'path' => '/domains/{dns-domain}/records',
                'operation_id' => 'list-dns-domain-records',
                'name' => 'List Records',
                'description' => 'List Records',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'dns-domain',
                        'argument_name' => 'dns_domain',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The DNS Domainoperation/list-dns-domains.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'dns'
                ]
            ],
            'vultr_get_dns_domain_record' => [
                'class' => 'VultrGetDnsDomainRecord',
                'method' => 'GET',
                'path' => '/domains/{dns-domain}/records/{record-id}',
                'operation_id' => 'get-dns-domain-record',
                'name' => 'Get Record',
                'description' => 'Get Record',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'dns-domain',
                        'argument_name' => 'dns_domain',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The DNS Domainoperation/list-dns-domains.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'record-id',
                        'argument_name' => 'record_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The DNS Record idoperation/list-dns-domain-records.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'dns'
                ]
            ],
            'vultr_update_dns_domain_record' => [
                'class' => 'VultrUpdateDnsDomainRecord',
                'method' => 'PATCH',
                'path' => '/domains/{dns-domain}/records/{record-id}',
                'operation_id' => 'update-dns-domain-record',
                'name' => 'Update Record',
                'description' => 'Update Record',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'dns-domain',
                        'argument_name' => 'dns_domain',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The DNS Domainoperation/list-dns-domains.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'record-id',
                        'argument_name' => 'record_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The DNS Record idoperation/list-dns-domain-records.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'dns'
                ]
            ],
            'vultr_delete_dns_domain_record' => [
                'class' => 'VultrDeleteDnsDomainRecord',
                'method' => 'DELETE',
                'path' => '/domains/{dns-domain}/records/{record-id}',
                'operation_id' => 'delete-dns-domain-record',
                'name' => 'Delete Record',
                'description' => 'Delete Record',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'dns-domain',
                        'argument_name' => 'dns_domain',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The DNS Domainoperation/list-dns-domains.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'record-id',
                        'argument_name' => 'record_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The DNS Record idoperation/list-dns-domain-records.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'dns'
                ]
            ],
            'vultr_list_regions' => [
                'class' => 'VultrListRegions',
                'method' => 'GET',
                'path' => '/regions',
                'operation_id' => 'list-regions',
                'name' => 'List Regions',
                'description' => 'List Regions',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'region'
                ]
            ],
            'vultr_list_available_plans_region' => [
                'class' => 'VultrListAvailablePlansRegion',
                'method' => 'GET',
                'path' => '/regions/{region-id}/availability',
                'operation_id' => 'list-available-plans-region',
                'name' => 'List available plans in region',
                'description' => 'List available plans in region',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'region-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Region idoperation/list-regions.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'region_id'
                        ]
                    ],
                    [
                        'name' => 'type',
                        'argument_name' => 'type',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by type. | Type | Description | |----------|-----------------| | all | All available types | | vc2 | Cloud Compute | | vdc | Dedicated Cloud | | vhf | High Frequency Compute | | vhp | High Performance | | voc | All Optimized Cloud types | | voc-g | General Purpose Optimized Cloud | | voc-c | CPU Optimized Cloud | | voc-m | Memory Optimized Cloud | | voc-s | Storage Optimized Cloud | | vbm | Bare Metal | | vcg | Cloud GPU |',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'region'
                ]
            ],
            'vultr_list_load_balancers' => [
                'class' => 'VultrListLoadBalancers',
                'method' => 'GET',
                'path' => '/load-balancers',
                'operation_id' => 'list-load-balancers',
                'name' => 'List Load Balancers',
                'description' => 'List Load Balancers',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_create_load_balancer' => [
                'class' => 'VultrCreateLoadBalancer',
                'method' => 'POST',
                'path' => '/load-balancers',
                'operation_id' => 'create-load-balancer',
                'name' => 'Create Load Balancer',
                'description' => 'Create Load Balancer',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_get_load_balancer' => [
                'class' => 'VultrGetLoadBalancer',
                'method' => 'GET',
                'path' => '/load-balancers/{load-balancer-id}',
                'operation_id' => 'get-load-balancer',
                'name' => 'Get Load Balancer',
                'description' => 'Get Load Balancer',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'load-balancer-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Load Balancer idoperation/list-load-balancers.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'load_balancer_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_update_load_balancer' => [
                'class' => 'VultrUpdateLoadBalancer',
                'method' => 'PATCH',
                'path' => '/load-balancers/{load-balancer-id}',
                'operation_id' => 'update-load-balancer',
                'name' => 'Update Load Balancer',
                'description' => 'Update Load Balancer',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'load-balancer-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Load Balancer idoperation/list-load-balancers.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'load_balancer_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_delete_load_balancer' => [
                'class' => 'VultrDeleteLoadBalancer',
                'method' => 'DELETE',
                'path' => '/load-balancers/{load-balancer-id}',
                'operation_id' => 'delete-load-balancer',
                'name' => 'Delete Load Balancer',
                'description' => 'Delete Load Balancer',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'load-balancer-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Load Balancer idoperation/list-load-balancers.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'load_balancer_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_delete_load_balancer_ssl' => [
                'class' => 'VultrDeleteLoadBalancerSsl',
                'method' => 'DELETE',
                'path' => '/load-balancers/{load-balancer-id}/ssl',
                'operation_id' => 'delete-load-balancer-ssl',
                'name' => 'Delete Load Balancer SSL',
                'description' => 'Delete Load Balancer SSL',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'load-balancer-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Load Balancer idoperation/list-load-balancers.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'load_balancer_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_delete_load_balancer_auto_ssl' => [
                'class' => 'VultrDeleteLoadBalancerAutoSsl',
                'method' => 'DELETE',
                'path' => '/load-balancers/{load-balancer-id}/auto_ssl',
                'operation_id' => 'delete-load-balancer-auto-ssl',
                'name' => 'Disable Load Balancer Auto SSL',
                'description' => 'Disable Load Balancer Auto SSL',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'load-balancer-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Load Balancer idoperation/list-load-balancers.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'load_balancer_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_list_load_balancer_forwarding_rules' => [
                'class' => 'VultrListLoadBalancerForwardingRules',
                'method' => 'GET',
                'path' => '/load-balancers/{load-balancer-id}/forwarding-rules',
                'operation_id' => 'list-load-balancer-forwarding-rules',
                'name' => 'List Forwarding Rules',
                'description' => 'List Forwarding Rules',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'load-balancer-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Load Balancer idoperation/list-load-balancers.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'load_balancer_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_create_load_balancer_forwarding_rules' => [
                'class' => 'VultrCreateLoadBalancerForwardingRules',
                'method' => 'POST',
                'path' => '/load-balancers/{load-balancer-id}/forwarding-rules',
                'operation_id' => 'create-load-balancer-forwarding-rules',
                'name' => 'Create Forwarding Rule',
                'description' => 'Create Forwarding Rule',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'load-balancer-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Load Balancer idoperation/list-load-balancers.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'load_balancer_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_get_load_balancer_forwarding_rule' => [
                'class' => 'VultrGetLoadBalancerForwardingRule',
                'method' => 'GET',
                'path' => '/load-balancers/{load-balancer-id}/forwarding-rules/{forwarding-rule-id}',
                'operation_id' => 'get-load-balancer-forwarding-rule',
                'name' => 'Get Forwarding Rule',
                'description' => 'Get Forwarding Rule',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'load-balancer-id',
                        'argument_name' => 'load_balancer_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Load Balancer idoperation/list-load-balancers.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'forwarding-rule-id',
                        'argument_name' => 'forwarding_rule_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Forwarding Rule idoperation/list-load-balancer-forwarding-rules.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_delete_load_balancer_forwarding_rule' => [
                'class' => 'VultrDeleteLoadBalancerForwardingRule',
                'method' => 'DELETE',
                'path' => '/load-balancers/{load-balancer-id}/forwarding-rules/{forwarding-rule-id}',
                'operation_id' => 'delete-load-balancer-forwarding-rule',
                'name' => 'Delete Forwarding Rule',
                'description' => 'Delete Forwarding Rule',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'load-balancer-id',
                        'argument_name' => 'load_balancer_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Load Balancer idoperation/list-load-balancers.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'forwarding-rule-id',
                        'argument_name' => 'forwarding_rule_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Forwarding Rule idoperation/list-load-balancer-forwarding-rules.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_get_load_balancer_reverse_dns' => [
                'class' => 'VultrGetLoadBalancerReverseDns',
                'method' => 'GET',
                'path' => '/load-balancers/{load-balancer-id}/reverse-dns',
                'operation_id' => 'get-load-balancer-reverse-dns',
                'name' => 'Get Reverse DNS',
                'description' => 'Get Reverse DNS',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'load-balancer-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Load Balancer idoperation/list-load-balancers.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'load_balancer_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_delete_load_balancer_reverse_dns' => [
                'class' => 'VultrDeleteLoadBalancerReverseDns',
                'method' => 'DELETE',
                'path' => '/load-balancers/{load-balancer-id}/reverse-dns',
                'operation_id' => 'delete-load-balancer-reverse-dns',
                'name' => 'Delete Reverse DNS',
                'description' => 'Delete Reverse DNS',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'load-balancer-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Load Balancer idoperation/list-load-balancers.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'load_balancer_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_create_load_balancer_reverse_dns_ipv6' => [
                'class' => 'VultrCreateLoadBalancerReverseDnsIpv6',
                'method' => 'POST',
                'path' => '/load-balancers/{load-balancer-id}/reverse-dns',
                'operation_id' => 'create-load-balancer-reverse-dns-ipv6',
                'name' => 'Create Reverse DNS IPV6',
                'description' => 'Create Reverse DNS IPV6',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'load-balancer-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Load Balancer idoperation/list-load-balancers.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'load_balancer_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_create_load_balancer_reverse_dns_ipv4' => [
                'class' => 'VultrCreateLoadBalancerReverseDnsIpv4',
                'method' => 'PUT',
                'path' => '/load-balancers/{load-balancer-id}/reverse-dns',
                'operation_id' => 'create-load-balancer-reverse-dns-ipv4',
                'name' => 'Update Reverse DNS IPV4',
                'description' => 'Update Reverse DNS IPV4',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'load-balancer-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Load Balancer idoperation/list-load-balancers.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'load_balancer_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_list_logs' => [
                'class' => 'VultrListLogs',
                'method' => 'GET',
                'path' => '/logs',
                'operation_id' => 'list-logs',
                'name' => 'List Logs',
                'description' => 'List Logs',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'start_time',
                        'argument_name' => 'start_time',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A UTC timestamp for the start of the time period from which to return logs. starttime is an inclusive endpoint. Logs with a timestamp equal to, or after starttime are included in the response This field is required if the endtime field is not provided. Expected Format: yyyy-mm-ddThh:mm:ssZ EX: 2025-06-26T00:00:00Z starttime must be after to the date added for starttime starttime and endtime may not be more than 30 days and 1 hour apart If no starttime is provided a time 30 days and 1 hour prior to the endtime will be used by default',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'end_time',
                        'argument_name' => 'end_time',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'A UTC timestamp for the end of the time period from which to return logs. endtime is an exclusive endpoint. Only logs with a timestamp before the endtime are included in the response. This field is required if the starttime field is not provided. Expected Format: yyyy-mm-ddThh:mm:ssZ EX: 2025-06-26T00:00:00Z endtime must be before the date added for starttime starttime and endtime may not be more than 30 days and 1 hour apart If no endtime is provided the current time will be used by default',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'log_level',
                        'argument_name' => 'log_level',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the logs by the level assigned to the log. info debug warning error critical',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'resource_type',
                        'argument_name' => 'resource_type',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the logs by the type of a resource such as an instances, bare-metals, kubernetes, etc. resourcetype must be an exact match to the value of the resource type set in the log.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'resource_id',
                        'argument_name' => 'resource_id',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the logs by the UUID of a specific resource such as an instance.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'logs'
                ]
            ],
            'vultr_list_plans' => [
                'class' => 'VultrListPlans',
                'method' => 'GET',
                'path' => '/plans',
                'operation_id' => 'list-plans',
                'name' => 'List Plans',
                'description' => 'List Plans',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'type',
                        'argument_name' => 'type',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by type. | Type | Description | |----------|-----------------| | all | All available types | | vc2 | Cloud Compute | | vdc | Dedicated Cloud | | vhf | High Frequency Compute | | vhp | High Performance | | voc | All Optimized Cloud types | | voc-g | General Purpose Optimized Cloud | | voc-c | CPU Optimized Cloud | | voc-m | Memory Optimized Cloud | | voc-s | Storage Optimized Cloud | | vcg | Cloud GPU |',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'os',
                        'argument_name' => 'os',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter the results by operating system. | | Type | Description | | - | ------ | ------------- | | | windows | All available plans that support windows |',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'plans'
                ]
            ],
            'vultr_list_metal_plans' => [
                'class' => 'VultrListMetalPlans',
                'method' => 'GET',
                'path' => '/plans-metal',
                'operation_id' => 'list-metal-plans',
                'name' => 'List Bare Metal Plans',
                'description' => 'List Bare Metal Plans',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'plans'
                ]
            ],
            'vultr_list_baremetals' => [
                'class' => 'VultrListBaremetals',
                'method' => 'GET',
                'path' => '/bare-metals',
                'operation_id' => 'list-baremetals',
                'name' => 'List Bare Metal Instances',
                'description' => 'List Bare Metal Instances',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_create_baremetal' => [
                'class' => 'VultrCreateBaremetal',
                'method' => 'POST',
                'path' => '/bare-metals',
                'operation_id' => 'create-baremetal',
                'name' => 'Create Bare Metal Instance',
                'description' => 'Create Bare Metal Instance',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_get_baremetal' => [
                'class' => 'VultrGetBaremetal',
                'method' => 'GET',
                'path' => '/bare-metals/{baremetal-id}',
                'operation_id' => 'get-baremetal',
                'name' => 'Get Bare Metal',
                'description' => 'Get Bare Metal',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal idoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_update_baremetal' => [
                'class' => 'VultrUpdateBaremetal',
                'method' => 'PATCH',
                'path' => '/bare-metals/{baremetal-id}',
                'operation_id' => 'update-baremetal',
                'name' => 'Update Bare Metal',
                'description' => 'Update Bare Metal',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal idoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_delete_baremetal' => [
                'class' => 'VultrDeleteBaremetal',
                'method' => 'DELETE',
                'path' => '/bare-metals/{baremetal-id}',
                'operation_id' => 'delete-baremetal',
                'name' => 'Delete Bare Metal',
                'description' => 'Delete Bare Metal',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal idoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_get_ipv4_baremetal' => [
                'class' => 'VultrGetIpv4Baremetal',
                'method' => 'GET',
                'path' => '/bare-metals/{baremetal-id}/ipv4',
                'operation_id' => 'get-ipv4-baremetal',
                'name' => 'Bare Metal IPv4 Addresses',
                'description' => 'Bare Metal IPv4 Addresses',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal idoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_get_ipv6_baremetal' => [
                'class' => 'VultrGetIpv6Baremetal',
                'method' => 'GET',
                'path' => '/bare-metals/{baremetal-id}/ipv6',
                'operation_id' => 'get-ipv6-baremetal',
                'name' => 'Bare Metal IPv6 Addresses',
                'description' => 'Bare Metal IPv6 Addresses',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal idoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_create_baremetal_reverse_ipv4' => [
                'class' => 'VultrCreateBaremetalReverseIpv4',
                'method' => 'POST',
                'path' => '/bare-metals/{baremetal-id}/ipv4/reverse',
                'operation_id' => 'create-baremetal-reverse-ipv4',
                'name' => 'Create Baremetal Reverse IPv4',
                'description' => 'Create Baremetal Reverse IPv4',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal IDoperation/baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_create_baremetal_reverse_ipv6' => [
                'class' => 'VultrCreateBaremetalReverseIpv6',
                'method' => 'POST',
                'path' => '/bare-metals/{baremetal-id}/ipv6/reverse',
                'operation_id' => 'create-baremetal-reverse-ipv6',
                'name' => 'Create Baremetal Reverse IPv6',
                'description' => 'Create Baremetal Reverse IPv6',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare metal IDoperation/baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_post_baremetal_instance_id_ipv4_reverse_default' => [
                'class' => 'VultrPostBaremetalInstanceIdIpv4ReverseDefault',
                'method' => 'POST',
                'path' => '/bare-metals/{baremetal-id}/ipv4/reverse/default',
                'operation_id' => 'post-baremetal-instance-id-ipv4-reverse-default',
                'name' => 'Set Default Reverse DNS Entry',
                'description' => 'Set Default Reverse DNS Entry',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal IDoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_delete_baremetal_reverse_ipv6' => [
                'class' => 'VultrDeleteBaremetalReverseIpv6',
                'method' => 'DELETE',
                'path' => '/bare-metals/{baremetal-id}/ipv6/reverse/{ipv6}',
                'operation_id' => 'delete-baremetal-reverse-ipv6',
                'name' => 'Delete BareMetal Reverse IPv6',
                'description' => 'Delete BareMetal Reverse IPv6',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'baremetal_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal idoperation/list-baremetals.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'ipv6',
                        'argument_name' => 'ipv6',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The IPv6 address.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_start_baremetal' => [
                'class' => 'VultrStartBaremetal',
                'method' => 'POST',
                'path' => '/bare-metals/{baremetal-id}/start',
                'operation_id' => 'start-baremetal',
                'name' => 'Start Bare Metal',
                'description' => 'Start Bare Metal',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal idoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_reboot_baremetal' => [
                'class' => 'VultrRebootBaremetal',
                'method' => 'POST',
                'path' => '/bare-metals/{baremetal-id}/reboot',
                'operation_id' => 'reboot-baremetal',
                'name' => 'Reboot Bare Metal',
                'description' => 'Reboot Bare Metal',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal idoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_reinstall_baremetal' => [
                'class' => 'VultrReinstallBaremetal',
                'method' => 'POST',
                'path' => '/bare-metals/{baremetal-id}/reinstall',
                'operation_id' => 'reinstall-baremetal',
                'name' => 'Reinstall Bare Metal',
                'description' => 'Reinstall Bare Metal',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal idoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_halt_baremetal' => [
                'class' => 'VultrHaltBaremetal',
                'method' => 'POST',
                'path' => '/bare-metals/{baremetal-id}/halt',
                'operation_id' => 'halt-baremetal',
                'name' => 'Halt Bare Metal',
                'description' => 'Halt Bare Metal',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal idoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_get_bandwidth_baremetal' => [
                'class' => 'VultrGetBandwidthBaremetal',
                'method' => 'GET',
                'path' => '/bare-metals/{baremetal-id}/bandwidth',
                'operation_id' => 'get-bandwidth-baremetal',
                'name' => 'Bare Metal Bandwidth',
                'description' => 'Bare Metal Bandwidth',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal idoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_halt_baremetals' => [
                'class' => 'VultrHaltBaremetals',
                'method' => 'POST',
                'path' => '/bare-metals/halt',
                'operation_id' => 'halt-baremetals',
                'name' => 'Halt Bare Metals',
                'description' => 'Halt Bare Metals',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_reboot_bare_metals' => [
                'class' => 'VultrRebootBareMetals',
                'method' => 'POST',
                'path' => '/bare-metals/reboot',
                'operation_id' => 'reboot-bare-metals',
                'name' => 'Reboot Bare Metals',
                'description' => 'Reboot Bare Metals',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_start_bare_metals' => [
                'class' => 'VultrStartBareMetals',
                'method' => 'POST',
                'path' => '/bare-metals/start',
                'operation_id' => 'start-bare-metals',
                'name' => 'Start Bare Metals',
                'description' => 'Start Bare Metals',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_get_bare_metal_userdata' => [
                'class' => 'VultrGetBareMetalUserdata',
                'method' => 'GET',
                'path' => '/bare-metals/{baremetal-id}/user-data',
                'operation_id' => 'get-bare-metal-userdata',
                'name' => 'Get Bare Metal User Data',
                'description' => 'Get Bare Metal User Data',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal idoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_list_instances' => [
                'class' => 'VultrListInstances',
                'method' => 'GET',
                'path' => '/instances',
                'operation_id' => 'list-instances',
                'name' => 'List Instances',
                'description' => 'List Instances',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'tag',
                        'argument_name' => 'tag',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter by specific tag.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'label',
                        'argument_name' => 'label',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter by label.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'main_ip',
                        'argument_name' => 'main_ip',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter by main ip address.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'region',
                        'argument_name' => 'region',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter by Region idoperation/list-regions.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'firewall_group_id',
                        'argument_name' => 'firewall_group_id',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter by Firewall group idoperation/list-firewall-groups.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'hostname',
                        'argument_name' => 'hostname',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter by hostname.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'show_pending_charges',
                        'argument_name' => 'show_pending_charges',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Set to true to show pending charges.',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_create_instance' => [
                'class' => 'VultrCreateInstance',
                'method' => 'POST',
                'path' => '/instances',
                'operation_id' => 'create-instance',
                'name' => 'Create Instance',
                'description' => 'Create Instance',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_get_instance' => [
                'class' => 'VultrGetInstance',
                'method' => 'GET',
                'path' => '/instances/{instance-id}',
                'operation_id' => 'get-instance',
                'name' => 'Get Instance',
                'description' => 'Get Instance',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_update_instance' => [
                'class' => 'VultrUpdateInstance',
                'method' => 'PATCH',
                'path' => '/instances/{instance-id}',
                'operation_id' => 'update-instance',
                'name' => 'Update Instance',
                'description' => 'Update Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_delete_instance' => [
                'class' => 'VultrDeleteInstance',
                'method' => 'DELETE',
                'path' => '/instances/{instance-id}',
                'operation_id' => 'delete-instance',
                'name' => 'Delete Instance',
                'description' => 'Delete Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_halt_instances' => [
                'class' => 'VultrHaltInstances',
                'method' => 'POST',
                'path' => '/instances/halt',
                'operation_id' => 'halt-instances',
                'name' => 'Halt Instances',
                'description' => 'Halt Instances',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_reboot_instances' => [
                'class' => 'VultrRebootInstances',
                'method' => 'POST',
                'path' => '/instances/reboot',
                'operation_id' => 'reboot-instances',
                'name' => 'Reboot instances',
                'description' => 'Reboot instances',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_start_instances' => [
                'class' => 'VultrStartInstances',
                'method' => 'POST',
                'path' => '/instances/start',
                'operation_id' => 'start-instances',
                'name' => 'Start instances',
                'description' => 'Start instances',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_start_instance' => [
                'class' => 'VultrStartInstance',
                'method' => 'POST',
                'path' => '/instances/{instance-id}/start',
                'operation_id' => 'start-instance',
                'name' => 'Start instance',
                'description' => 'Start instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_reboot_instance' => [
                'class' => 'VultrRebootInstance',
                'method' => 'POST',
                'path' => '/instances/{instance-id}/reboot',
                'operation_id' => 'reboot-instance',
                'name' => 'Reboot Instance',
                'description' => 'Reboot Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_reinstall_instance' => [
                'class' => 'VultrReinstallInstance',
                'method' => 'POST',
                'path' => '/instances/{instance-id}/reinstall',
                'operation_id' => 'reinstall-instance',
                'name' => 'Reinstall Instance',
                'description' => 'Reinstall Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_get_instance_bandwidth' => [
                'class' => 'VultrGetInstanceBandwidth',
                'method' => 'GET',
                'path' => '/instances/{instance-id}/bandwidth',
                'operation_id' => 'get-instance-bandwidth',
                'name' => 'Instance Bandwidth',
                'description' => 'Instance Bandwidth',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ],
                    [
                        'name' => 'date_range',
                        'argument_name' => 'date_range',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The range of days to include, represented as the number of days relative to the current date. Default 30, Minimum 1 and Max 180.',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_get_instance_neighbors' => [
                'class' => 'VultrGetInstanceNeighbors',
                'method' => 'GET',
                'path' => '/instances/{instance-id}/neighbors',
                'operation_id' => 'get-instance-neighbors',
                'name' => 'Get Instance neighbors',
                'description' => 'Get Instance neighbors',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_list_instance_private_networks' => [
                'class' => 'VultrListInstancePrivateNetworks',
                'method' => 'GET',
                'path' => '/instances/{instance-id}/private-networks',
                'operation_id' => 'list-instance-private-networks',
                'name' => 'List instance Private Networks',
                'description' => 'List instance Private Networks',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_list_instance_vpcs' => [
                'class' => 'VultrListInstanceVpcs',
                'method' => 'GET',
                'path' => '/instances/{instance-id}/vpcs',
                'operation_id' => 'list-instance-vpcs',
                'name' => 'List instance VPCs',
                'description' => 'List instance VPCs',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_list_instance_vpc2' => [
                'class' => 'VultrListInstanceVpc2',
                'method' => 'GET',
                'path' => '/instances/{instance-id}/vpc2',
                'operation_id' => 'list-instance-vpc2',
                'name' => 'List Instance VPC 2.0 Networks',
                'description' => 'List Instance VPC 2.0 Networks',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_get_instance_iso_status' => [
                'class' => 'VultrGetInstanceIsoStatus',
                'method' => 'GET',
                'path' => '/instances/{instance-id}/iso',
                'operation_id' => 'get-instance-iso-status',
                'name' => 'Get Instance ISO Status',
                'description' => 'Get Instance ISO Status',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_attach_instance_iso' => [
                'class' => 'VultrAttachInstanceIso',
                'method' => 'POST',
                'path' => '/instances/{instance-id}/iso/attach',
                'operation_id' => 'attach-instance-iso',
                'name' => 'Attach ISO to Instance',
                'description' => 'Attach ISO to Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Attach Instance ISO parameter.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_detach_instance_iso' => [
                'class' => 'VultrDetachInstanceIso',
                'method' => 'POST',
                'path' => '/instances/{instance-id}/iso/detach',
                'operation_id' => 'detach-instance-iso',
                'name' => 'Detach ISO from instance',
                'description' => 'Detach ISO from instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_attach_instance_network' => [
                'class' => 'VultrAttachInstanceNetwork',
                'method' => 'POST',
                'path' => '/instances/{instance-id}/private-networks/attach',
                'operation_id' => 'attach-instance-network',
                'name' => 'Attach Private Network to Instance',
                'description' => 'Attach Private Network to Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_detach_instance_network' => [
                'class' => 'VultrDetachInstanceNetwork',
                'method' => 'POST',
                'path' => '/instances/{instance-id}/private-networks/detach',
                'operation_id' => 'detach-instance-network',
                'name' => 'Detach Private Network from Instance.',
                'description' => 'Detach Private Network from Instance.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_attach_instance_vpc' => [
                'class' => 'VultrAttachInstanceVpc',
                'method' => 'POST',
                'path' => '/instances/{instance-id}/vpcs/attach',
                'operation_id' => 'attach-instance-vpc',
                'name' => 'Attach VPC to Instance',
                'description' => 'Attach VPC to Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_detach_instance_vpc' => [
                'class' => 'VultrDetachInstanceVpc',
                'method' => 'POST',
                'path' => '/instances/{instance-id}/vpcs/detach',
                'operation_id' => 'detach-instance-vpc',
                'name' => 'Detach VPC from Instance',
                'description' => 'Detach VPC from Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_attach_instance_vpc2' => [
                'class' => 'VultrAttachInstanceVpc2',
                'method' => 'POST',
                'path' => '/instances/{instance-id}/vpc2/attach',
                'operation_id' => 'attach-instance-vpc2',
                'name' => 'Attach VPC 2.0 Network to Instance',
                'description' => 'Attach VPC 2.0 Network to Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_detach_instance_vpc2' => [
                'class' => 'VultrDetachInstanceVpc2',
                'method' => 'POST',
                'path' => '/instances/{instance-id}/vpc2/detach',
                'operation_id' => 'detach-instance-vpc2',
                'name' => 'Detach VPC 2.0 Network from Instance',
                'description' => 'Detach VPC 2.0 Network from Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_create_instance_backup_schedule' => [
                'class' => 'VultrCreateInstanceBackupSchedule',
                'method' => 'POST',
                'path' => '/instances/{instance-id}/backup-schedule',
                'operation_id' => 'create-instance-backup-schedule',
                'name' => 'Set Instance Backup Schedule',
                'description' => 'Set Instance Backup Schedule',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_get_instance_backup_schedule' => [
                'class' => 'VultrGetInstanceBackupSchedule',
                'method' => 'GET',
                'path' => '/instances/{instance-id}/backup-schedule',
                'operation_id' => 'get-instance-backup-schedule',
                'name' => 'Get Instance Backup Schedule',
                'description' => 'Get Instance Backup Schedule',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_restore_instance' => [
                'class' => 'VultrRestoreInstance',
                'method' => 'POST',
                'path' => '/instances/{instance-id}/restore',
                'operation_id' => 'restore-instance',
                'name' => 'Restore Instance',
                'description' => 'Restore Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_get_instance_ipv4' => [
                'class' => 'VultrGetInstanceIpv4',
                'method' => 'GET',
                'path' => '/instances/{instance-id}/ipv4',
                'operation_id' => 'get-instance-ipv4',
                'name' => 'List Instance IPv4 Information',
                'description' => 'List Instance IPv4 Information',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ],
                    [
                        'name' => 'public_network',
                        'argument_name' => 'public_network',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'If true, includes information about the public network adapter such as MAC address with the mainip entry.',
                        'schema_type' => 'boolean'
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_create_instance_ipv4' => [
                'class' => 'VultrCreateInstanceIpv4',
                'method' => 'POST',
                'path' => '/instances/{instance-id}/ipv4',
                'operation_id' => 'create-instance-ipv4',
                'name' => 'Create IPv4',
                'description' => 'Create IPv4',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_get_instance_ipv6' => [
                'class' => 'VultrGetInstanceIpv6',
                'method' => 'GET',
                'path' => '/instances/{instance-id}/ipv6',
                'operation_id' => 'get-instance-ipv6',
                'name' => 'Get Instance IPv6 Information',
                'description' => 'Get Instance IPv6 Information',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_create_instance_reverse_ipv6' => [
                'class' => 'VultrCreateInstanceReverseIpv6',
                'method' => 'POST',
                'path' => '/instances/{instance-id}/ipv6/reverse',
                'operation_id' => 'create-instance-reverse-ipv6',
                'name' => 'Create Instance Reverse IPv6',
                'description' => 'Create Instance Reverse IPv6',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_list_instance_ipv6_reverse' => [
                'class' => 'VultrListInstanceIpv6Reverse',
                'method' => 'GET',
                'path' => '/instances/{instance-id}/ipv6/reverse',
                'operation_id' => 'list-instance-ipv6-reverse',
                'name' => 'List Instance IPv6 Reverse',
                'description' => 'List Instance IPv6 Reverse',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_create_instance_reverse_ipv4' => [
                'class' => 'VultrCreateInstanceReverseIpv4',
                'method' => 'POST',
                'path' => '/instances/{instance-id}/ipv4/reverse',
                'operation_id' => 'create-instance-reverse-ipv4',
                'name' => 'Create Instance Reverse IPv4',
                'description' => 'Create Instance Reverse IPv4',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_get_backup' => [
                'class' => 'VultrGetBackup',
                'method' => 'GET',
                'path' => '/backups/{backup-id}',
                'operation_id' => 'get-backup',
                'name' => 'Get a Backup',
                'description' => 'Get a Backup',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'backup-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Backup idoperation/list-backups.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'backup_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'backup'
                ]
            ],
            'vultr_get_instance_userdata' => [
                'class' => 'VultrGetInstanceUserdata',
                'method' => 'GET',
                'path' => '/instances/{instance-id}/user-data',
                'operation_id' => 'get-instance-userdata',
                'name' => 'Get Instance User Data',
                'description' => 'Get Instance User Data',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_halt_instance' => [
                'class' => 'VultrHaltInstance',
                'method' => 'POST',
                'path' => '/instances/{instance-id}/halt',
                'operation_id' => 'halt-instance',
                'name' => 'Halt Instance',
                'description' => 'Halt Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_post_instances_instance_id_ipv4_reverse_default' => [
                'class' => 'VultrPostInstancesInstanceIdIpv4ReverseDefault',
                'method' => 'POST',
                'path' => '/instances/{instance-id}/ipv4/reverse/default',
                'operation_id' => 'post-instances-instance-id-ipv4-reverse-default',
                'name' => 'Set Default Reverse DNS Entry',
                'description' => 'Set Default Reverse DNS Entry',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_delete_instance_ipv4' => [
                'class' => 'VultrDeleteInstanceIpv4',
                'method' => 'DELETE',
                'path' => '/instances/{instance-id}/ipv4/{ipv4}',
                'operation_id' => 'delete-instance-ipv4',
                'name' => 'Delete IPv4 Address',
                'description' => 'Delete IPv4 Address',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'instance_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'ipv4',
                        'argument_name' => 'ipv4',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The IPv4 address.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_delete_instance_reverse_ipv6' => [
                'class' => 'VultrDeleteInstanceReverseIpv6',
                'method' => 'DELETE',
                'path' => '/instances/{instance-id}/ipv6/reverse/{ipv6}',
                'operation_id' => 'delete-instance-reverse-ipv6',
                'name' => 'Delete Instance Reverse IPv6',
                'description' => 'Delete Instance Reverse IPv6',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'instance_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'ipv6',
                        'argument_name' => 'ipv6',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The IPv6 address.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_get_instance_upgrades' => [
                'class' => 'VultrGetInstanceUpgrades',
                'method' => 'GET',
                'path' => '/instances/{instance-id}/upgrades',
                'operation_id' => 'get-instance-upgrades',
                'name' => 'Get Available Instance Upgrades',
                'description' => 'Get Available Instance Upgrades',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instance_id'
                        ]
                    ],
                    [
                        'name' => 'type',
                        'argument_name' => 'type',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter upgrade by type: - all applications, os, plans - applications - os - plans',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_get_instance_job' => [
                'class' => 'VultrGetInstanceJob',
                'method' => 'GET',
                'path' => '/instances/jobs/{job-id}',
                'operation_id' => 'get-instance-job',
                'name' => 'Get Instance Job',
                'description' => 'Get Instance Job',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'job-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Job IDoperation/update-instance.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'job_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instances'
                ]
            ],
            'vultr_get_bare_metals_upgrades' => [
                'class' => 'VultrGetBareMetalsUpgrades',
                'method' => 'GET',
                'path' => '/bare-metals/{baremetal-id}/upgrades',
                'operation_id' => 'get-bare-metals-upgrades',
                'name' => 'Get Available Bare Metal Upgrades',
                'description' => 'Get Available Bare Metal Upgrades',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal idoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ],
                    [
                        'name' => 'type',
                        'argument_name' => 'type',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter upgrade by type: - all applications, plans - applications - os',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_get_bare_metal_vnc' => [
                'class' => 'VultrGetBareMetalVnc',
                'method' => 'GET',
                'path' => '/bare-metals/{baremetal-id}/vnc',
                'operation_id' => 'get-bare-metal-vnc',
                'name' => 'Get VNC URL for a Bare Metal',
                'description' => 'Get VNC URL for a Bare Metal',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal idoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_attach_baremetals_vpcs' => [
                'class' => 'VultrAttachBaremetalsVpcs',
                'method' => 'POST',
                'path' => '/bare-metals/{baremetal-id}/vpcs/attach',
                'operation_id' => 'attach-baremetals-vpcs',
                'name' => 'Attach VPC Network to Bare Metal Instance',
                'description' => 'Attach VPC Network to Bare Metal Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal IDoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_detach_baremetal_vpcs' => [
                'class' => 'VultrDetachBaremetalVpcs',
                'method' => 'POST',
                'path' => '/bare-metals/{baremetal-id}/vpcs/detach',
                'operation_id' => 'detach-baremetal-vpcs',
                'name' => 'Detach VPC Network from Bare Metal Instance',
                'description' => 'Detach VPC Network from Bare Metal Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The bare-metal IDoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_list_baremetal_vpcs' => [
                'class' => 'VultrListBaremetalVpcs',
                'method' => 'GET',
                'path' => '/bare-metals/{baremetal-id}/vpcs',
                'operation_id' => 'list-baremetal-vpcs',
                'name' => 'List Bare Metal Instance VPC Networks',
                'description' => 'List Bare Metal Instance VPC Networks',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal IDoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_attach_baremetals_vpc2' => [
                'class' => 'VultrAttachBaremetalsVpc2',
                'method' => 'POST',
                'path' => '/bare-metals/{baremetal-id}/vpc2/attach',
                'operation_id' => 'attach-baremetals-vpc2',
                'name' => 'Attach VPC 2.0 Network to Bare Metal Instance',
                'description' => 'Attach VPC 2.0 Network to Bare Metal Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal IDoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_detach_baremetal_vpc2' => [
                'class' => 'VultrDetachBaremetalVpc2',
                'method' => 'POST',
                'path' => '/bare-metals/{baremetal-id}/vpc2/detach',
                'operation_id' => 'detach-baremetal-vpc2',
                'name' => 'Detach VPC 2.0 Network from Bare Metal Instance',
                'description' => 'Detach VPC 2.0 Network from Bare Metal Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The bare-metal IDoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_list_baremetal_vpc2' => [
                'class' => 'VultrListBaremetalVpc2',
                'method' => 'GET',
                'path' => '/bare-metals/{baremetal-id}/vpc2',
                'operation_id' => 'list-baremetal-vpc2',
                'name' => 'List Bare Metal Instance VPC 2.0 Networks',
                'description' => 'List Bare Metal Instance VPC 2.0 Networks',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'baremetal-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Bare Metal IDoperation/list-baremetals.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'baremetal_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'baremetal'
                ]
            ],
            'vultr_list_loadbalancer_firewall_rules' => [
                'class' => 'VultrListLoadbalancerFirewallRules',
                'method' => 'GET',
                'path' => '/load-balancers/{loadbalancer-id}/firewall-rules',
                'operation_id' => 'list-loadbalancer-firewall-rules',
                'name' => 'List Firewall Rules',
                'description' => 'List Firewall Rules',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'loadbalancer-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'List Loadbalancer Firewall Rules parameter.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'loadbalancer_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_create_loadbalancer_firewall_rules' => [
                'class' => 'VultrCreateLoadbalancerFirewallRules',
                'method' => 'POST',
                'path' => '/load-balancers/{loadbalancer-id}/firewall-rules',
                'operation_id' => 'create-loadbalancer-firewall-rules',
                'name' => 'Create Firewall Rules',
                'description' => 'Create Firewall Rules',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'loadbalancer-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Create Loadbalancer Firewall Rules parameter.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'loadbalancer_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_get_loadbalancer_firewall_rule' => [
                'class' => 'VultrGetLoadbalancerFirewallRule',
                'method' => 'GET',
                'path' => '/load-balancers/{loadbalancer-id}/firewall-rules/{firewall-rule-id}',
                'operation_id' => 'get-loadbalancer-firewall-rule',
                'name' => 'Get Firewall Rule',
                'description' => 'Get Firewall Rule',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'loadbalancer-id',
                        'argument_name' => 'loadbalancer_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Get Loadbalancer Firewall Rule parameter.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'firewall-rule-id',
                        'argument_name' => 'firewall_rule_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Get Loadbalancer Firewall Rule parameter.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_delete_loadbalancer_firewall_rule' => [
                'class' => 'VultrDeleteLoadbalancerFirewallRule',
                'method' => 'DELETE',
                'path' => '/load-balancers/{loadbalancer-id}/firewall-rules/{firewall-rule-id}',
                'operation_id' => 'delete-loadbalancer-firewall-rule',
                'name' => 'Delete Firewall Rule',
                'description' => 'Delete Firewall Rule',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'loadbalancer-id',
                        'argument_name' => 'loadbalancer_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Delete Loadbalancer Firewall Rule parameter.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'firewall-rule-id',
                        'argument_name' => 'firewall_rule_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Delete Loadbalancer Firewall Rule parameter.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'load-balancer'
                ]
            ],
            'vultr_create_kubernetes_cluster' => [
                'class' => 'VultrCreateKubernetesCluster',
                'method' => 'POST',
                'path' => '/kubernetes/clusters',
                'operation_id' => 'create-kubernetes-cluster',
                'name' => 'Create Kubernetes Cluster',
                'description' => 'Create Kubernetes Cluster',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request Body',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_list_kubernetes_clusters' => [
                'class' => 'VultrListKubernetesClusters',
                'method' => 'GET',
                'path' => '/kubernetes/clusters',
                'operation_id' => 'list-kubernetes-clusters',
                'name' => 'List all Kubernetes Clusters',
                'description' => 'List all Kubernetes Clusters',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_get_kubernetes_clusters' => [
                'class' => 'VultrGetKubernetesClusters',
                'method' => 'GET',
                'path' => '/kubernetes/clusters/{vke-id}',
                'operation_id' => 'get-kubernetes-clusters',
                'name' => 'Get Kubernetes Cluster',
                'description' => 'Get Kubernetes Cluster',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vke_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_update_kubernetes_cluster' => [
                'class' => 'VultrUpdateKubernetesCluster',
                'method' => 'PUT',
                'path' => '/kubernetes/clusters/{vke-id}',
                'operation_id' => 'update-kubernetes-cluster',
                'name' => 'Update Kubernetes Cluster',
                'description' => 'Update Kubernetes Cluster',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vke_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request Body',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_delete_kubernetes_cluster' => [
                'class' => 'VultrDeleteKubernetesCluster',
                'method' => 'DELETE',
                'path' => '/kubernetes/clusters/{vke-id}',
                'operation_id' => 'delete-kubernetes-cluster',
                'name' => 'Delete Kubernetes Cluster',
                'description' => 'Delete Kubernetes Cluster',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vke_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_delete_kubernetes_cluster_vke_id_delete_with_linked_resources' => [
                'class' => 'VultrDeleteKubernetesClusterVkeIdDeleteWithLinkedResources',
                'method' => 'DELETE',
                'path' => '/kubernetes/clusters/{vke-id}/delete-with-linked-resources',
                'operation_id' => 'delete-kubernetes-cluster-vke-id-delete-with-linked-resources',
                'name' => 'Delete VKE Cluster and All Related Resources',
                'description' => 'Delete VKE Cluster and All Related Resources',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Delete Kubernetes Cluster Vke Id Delete With Linked Resources parameter.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vke_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_get_kubernetes_resources' => [
                'class' => 'VultrGetKubernetesResources',
                'method' => 'GET',
                'path' => '/kubernetes/clusters/{vke-id}/resources',
                'operation_id' => 'get-kubernetes-resources',
                'name' => 'Get Kubernetes Resources',
                'description' => 'Get Kubernetes Resources',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vke_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_get_kubernetes_available_upgrades' => [
                'class' => 'VultrGetKubernetesAvailableUpgrades',
                'method' => 'GET',
                'path' => '/kubernetes/clusters/{vke-id}/available-upgrades',
                'operation_id' => 'get-kubernetes-available-upgrades',
                'name' => 'Get Kubernetes Available Upgrades',
                'description' => 'Get Kubernetes Available Upgrades',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vke_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_start_kubernetes_cluster_upgrade' => [
                'class' => 'VultrStartKubernetesClusterUpgrade',
                'method' => 'POST',
                'path' => '/kubernetes/clusters/{vke-id}/upgrades',
                'operation_id' => 'start-kubernetes-cluster-upgrade',
                'name' => 'Start Kubernetes Cluster Upgrade',
                'description' => 'Start Kubernetes Cluster Upgrade',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vke_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request Body',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_create_nodepools' => [
                'class' => 'VultrCreateNodepools',
                'method' => 'POST',
                'path' => '/kubernetes/clusters/{vke-id}/node-pools',
                'operation_id' => 'create-nodepools',
                'name' => 'Create NodePool',
                'description' => 'Create NodePool',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vke_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request Body',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_get_nodepools' => [
                'class' => 'VultrGetNodepools',
                'method' => 'GET',
                'path' => '/kubernetes/clusters/{vke-id}/node-pools',
                'operation_id' => 'get-nodepools',
                'name' => 'List NodePools',
                'description' => 'List NodePools',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vke_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_get_nodepool' => [
                'class' => 'VultrGetNodepool',
                'method' => 'GET',
                'path' => '/kubernetes/clusters/{vke-id}/node-pools/{nodepool-id}',
                'operation_id' => 'get-nodepool',
                'name' => 'Get NodePool',
                'description' => 'Get NodePool',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'vke_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nodepool-id',
                        'argument_name' => 'nodepool_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NodePool IDoperation/get-nodepools.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_update_nodepool' => [
                'class' => 'VultrUpdateNodepool',
                'method' => 'PATCH',
                'path' => '/kubernetes/clusters/{vke-id}/node-pools/{nodepool-id}',
                'operation_id' => 'update-nodepool',
                'name' => 'Update Nodepool',
                'description' => 'Update Nodepool',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'vke_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nodepool-id',
                        'argument_name' => 'nodepool_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NodePool IDoperation/get-nodepools.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request Body',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_delete_nodepool' => [
                'class' => 'VultrDeleteNodepool',
                'method' => 'DELETE',
                'path' => '/kubernetes/clusters/{vke-id}/node-pools/{nodepool-id}',
                'operation_id' => 'delete-nodepool',
                'name' => 'Delete Nodepool',
                'description' => 'Delete Nodepool',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'vke_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nodepool-id',
                        'argument_name' => 'nodepool_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NodePool IDoperation/get-nodepools.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_list_nodepool_labels' => [
                'class' => 'VultrListNodepoolLabels',
                'method' => 'GET',
                'path' => '/kubernetes/clusters/{vke-id}/node-pools/{nodepool-id}/labels',
                'operation_id' => 'list-nodepool-labels',
                'name' => 'List NodePool Labels',
                'description' => 'List NodePool Labels',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'vke_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nodepool-id',
                        'argument_name' => 'nodepool_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NodePool IDoperation/get-nodepools.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_create_nodepool_label' => [
                'class' => 'VultrCreateNodepoolLabel',
                'method' => 'POST',
                'path' => '/kubernetes/clusters/{vke-id}/node-pools/{nodepool-id}/labels',
                'operation_id' => 'create-nodepool-label',
                'name' => 'Create NodePool Label',
                'description' => 'Create NodePool Label',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'vke_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nodepool-id',
                        'argument_name' => 'nodepool_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NodePool IDoperation/get-nodepools.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_read_nodepool_label' => [
                'class' => 'VultrReadNodepoolLabel',
                'method' => 'GET',
                'path' => '/kubernetes/clusters/{vke-id}/node-pools/{nodepool-id}/labels/{label-id}',
                'operation_id' => 'read-nodepool-label',
                'name' => 'Read NodePool Label',
                'description' => 'Read NodePool Label',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'vke_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nodepool-id',
                        'argument_name' => 'nodepool_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NodePool IDoperation/get-nodepools.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'label-id',
                        'argument_name' => 'label_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NodePool Label IDoperation/list-labels.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_delete_nodepool_label' => [
                'class' => 'VultrDeleteNodepoolLabel',
                'method' => 'DELETE',
                'path' => '/kubernetes/clusters/{vke-id}/node-pools/{nodepool-id}/labels/{label-id}',
                'operation_id' => 'delete-nodepool-label',
                'name' => 'Delete NodePool Label',
                'description' => 'Delete NodePool Label',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'vke_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nodepool-id',
                        'argument_name' => 'nodepool_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NodePool IDoperation/get-nodepools.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'label-id',
                        'argument_name' => 'label_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NodePool Label IDoperation/list-labels.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_list_nodepool_taints' => [
                'class' => 'VultrListNodepoolTaints',
                'method' => 'GET',
                'path' => '/kubernetes/clusters/{vke-id}/node-pools/{nodepool-id}/taints',
                'operation_id' => 'list-nodepool-taints',
                'name' => 'List NodePool Taints',
                'description' => 'List NodePool Taints',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'vke_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nodepool-id',
                        'argument_name' => 'nodepool_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NodePool IDoperation/get-nodepools.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_create_nodepool_taint' => [
                'class' => 'VultrCreateNodepoolTaint',
                'method' => 'POST',
                'path' => '/kubernetes/clusters/{vke-id}/node-pools/{nodepool-id}/taints',
                'operation_id' => 'create-nodepool-taint',
                'name' => 'Create NodePool Taint',
                'description' => 'Create NodePool Taint',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'vke_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nodepool-id',
                        'argument_name' => 'nodepool_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NodePool IDoperation/get-nodepools.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_read_nodepool_taint' => [
                'class' => 'VultrReadNodepoolTaint',
                'method' => 'GET',
                'path' => '/kubernetes/clusters/{vke-id}/node-pools/{nodepool-id}/taints/{taint-id}',
                'operation_id' => 'read-nodepool-taint',
                'name' => 'Read NodePool Taint',
                'description' => 'Read NodePool Taint',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'vke_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nodepool-id',
                        'argument_name' => 'nodepool_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NodePool IDoperation/get-nodepools.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'taint-id',
                        'argument_name' => 'taint_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NodePool Taint IDoperation/list-taints.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_delete_nodepool_taint' => [
                'class' => 'VultrDeleteNodepoolTaint',
                'method' => 'DELETE',
                'path' => '/kubernetes/clusters/{vke-id}/node-pools/{nodepool-id}/taints/{taint-id}',
                'operation_id' => 'delete-nodepool-taint',
                'name' => 'Delete NodePool Taint',
                'description' => 'Delete NodePool Taint',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'vke_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nodepool-id',
                        'argument_name' => 'nodepool_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NodePool IDoperation/get-nodepools.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'taint-id',
                        'argument_name' => 'taint_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NodePool Taint IDoperation/list-taints.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_delete_nodepool_instance' => [
                'class' => 'VultrDeleteNodepoolInstance',
                'method' => 'DELETE',
                'path' => '/kubernetes/clusters/{vke-id}/node-pools/{nodepool-id}/nodes/{node-id}',
                'operation_id' => 'delete-nodepool-instance',
                'name' => 'Delete NodePool Instance',
                'description' => 'Delete NodePool Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'vke_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nodepool-id',
                        'argument_name' => 'nodepool_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NodePool IDoperation/get-nodepools.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'node-id',
                        'argument_name' => 'node_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_recycle_nodepool_instance' => [
                'class' => 'VultrRecycleNodepoolInstance',
                'method' => 'POST',
                'path' => '/kubernetes/clusters/{vke-id}/node-pools/{nodepool-id}/nodes/{node-id}/recycle',
                'operation_id' => 'recycle-nodepool-instance',
                'name' => 'Recycle a NodePool Instance',
                'description' => 'Recycle a NodePool Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'vke_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nodepool-id',
                        'argument_name' => 'nodepool_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The NodePool IDoperation/get-nodepools.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'node-id',
                        'argument_name' => 'node_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'Node ID',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_get_kubernetes_clusters_config' => [
                'class' => 'VultrGetKubernetesClustersConfig',
                'method' => 'GET',
                'path' => '/kubernetes/clusters/{vke-id}/config',
                'operation_id' => 'get-kubernetes-clusters-config',
                'name' => 'Get Kubernetes Cluster Kubeconfig',
                'description' => 'Get Kubernetes Cluster Kubeconfig',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vke-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The VKE IDoperation/list-kubernetes-clusters.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vke_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_get_kubernetes_versions' => [
                'class' => 'VultrGetKubernetesVersions',
                'method' => 'GET',
                'path' => '/kubernetes/versions',
                'operation_id' => 'get-kubernetes-versions',
                'name' => 'Get Kubernetes Versions',
                'description' => 'Get Kubernetes Versions',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'kubernetes'
                ]
            ],
            'vultr_list_billing_history' => [
                'class' => 'VultrListBillingHistory',
                'method' => 'GET',
                'path' => '/billing/history',
                'operation_id' => 'list-billing-history',
                'name' => 'List Billing History',
                'description' => 'List Billing History',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'billing'
                ]
            ],
            'vultr_list_invoices' => [
                'class' => 'VultrListInvoices',
                'method' => 'GET',
                'path' => '/billing/invoices',
                'operation_id' => 'list-invoices',
                'name' => 'List Invoices',
                'description' => 'List Invoices',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'billing'
                ]
            ],
            'vultr_get_invoice' => [
                'class' => 'VultrGetInvoice',
                'method' => 'GET',
                'path' => '/billing/invoices/{invoice-id}',
                'operation_id' => 'get-invoice',
                'name' => 'Get Invoice',
                'description' => 'Get Invoice',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'invoice-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'ID of invoice',
                        'schema_type' => 'string',
                        'aliases' => [
                            'invoice_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'billing'
                ]
            ],
            'vultr_get_invoice_items' => [
                'class' => 'VultrGetInvoiceItems',
                'method' => 'GET',
                'path' => '/billing/invoices/{invoice-id}/items',
                'operation_id' => 'get-invoice-items',
                'name' => 'Get Invoice Items',
                'description' => 'Get Invoice Items',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'invoice-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'ID of invoice',
                        'schema_type' => 'string',
                        'aliases' => [
                            'invoice_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'billing'
                ]
            ],
            'vultr_pending_charges' => [
                'class' => 'VultrPendingCharges',
                'method' => 'GET',
                'path' => '/billing/pending-charges',
                'operation_id' => 'pending-charges',
                'name' => 'List Pending Charges',
                'description' => 'List Pending Charges',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'billing'
                ]
            ],
            'vultr_pending_charges_csv' => [
                'class' => 'VultrPendingChargesCsv',
                'method' => 'GET',
                'path' => '/billing/pending-charges/csv',
                'operation_id' => 'pending-charges-csv',
                'name' => 'Get Pending Charges CSV',
                'description' => 'Get Pending Charges CSV',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'billing'
                ]
            ],
            'vultr_list_database_plans' => [
                'class' => 'VultrListDatabasePlans',
                'method' => 'GET',
                'path' => '/databases/plans',
                'operation_id' => 'list-database-plans',
                'name' => 'List Managed Database Plans',
                'description' => 'List Managed Database Plans',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'engine',
                        'argument_name' => 'engine',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter by engine type mysql pg valkey kafka',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'nodes',
                        'argument_name' => 'nodes',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter by number of nodes.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'region',
                        'argument_name' => 'region',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter by Region idoperation/list-regions.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_list_databases' => [
                'class' => 'VultrListDatabases',
                'method' => 'GET',
                'path' => '/databases',
                'operation_id' => 'list-databases',
                'name' => 'List Managed Databases',
                'description' => 'List Managed Databases',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'label',
                        'argument_name' => 'label',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter by label.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'tag',
                        'argument_name' => 'tag',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter by specific tag.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'region',
                        'argument_name' => 'region',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter by Region idoperation/list-regions.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_create_database' => [
                'class' => 'VultrCreateDatabase',
                'method' => 'POST',
                'path' => '/databases',
                'operation_id' => 'create-database',
                'name' => 'Create Managed Database',
                'description' => 'Create Managed Database',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_get_database' => [
                'class' => 'VultrGetDatabase',
                'method' => 'GET',
                'path' => '/databases/{database-id}',
                'operation_id' => 'get-database',
                'name' => 'Get Managed Database',
                'description' => 'Get Managed Database',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_update_database' => [
                'class' => 'VultrUpdateDatabase',
                'method' => 'PUT',
                'path' => '/databases/{database-id}',
                'operation_id' => 'update-database',
                'name' => 'Update Managed Database',
                'description' => 'Update Managed Database',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_delete_database' => [
                'class' => 'VultrDeleteDatabase',
                'method' => 'DELETE',
                'path' => '/databases/{database-id}',
                'operation_id' => 'delete-database',
                'name' => 'Delete Managed Database',
                'description' => 'Delete Managed Database',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_get_database_usage' => [
                'class' => 'VultrGetDatabaseUsage',
                'method' => 'GET',
                'path' => '/databases/{database-id}/usage',
                'operation_id' => 'get-database-usage',
                'name' => 'Get Database Usage Information',
                'description' => 'Get Database Usage Information',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_list_database_users' => [
                'class' => 'VultrListDatabaseUsers',
                'method' => 'GET',
                'path' => '/databases/{database-id}/users',
                'operation_id' => 'list-database-users',
                'name' => 'List Database Users',
                'description' => 'List Database Users',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_create_database_user' => [
                'class' => 'VultrCreateDatabaseUser',
                'method' => 'POST',
                'path' => '/databases/{database-id}/users',
                'operation_id' => 'create-database-user',
                'name' => 'Create Database User',
                'description' => 'Create Database User',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_get_database_user' => [
                'class' => 'VultrGetDatabaseUser',
                'method' => 'GET',
                'path' => '/databases/{database-id}/users/{username}',
                'operation_id' => 'get-database-user',
                'name' => 'Get Database User',
                'description' => 'Get Database User',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'username',
                        'argument_name' => 'username',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database useroperation/list-database-users.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_update_database_user' => [
                'class' => 'VultrUpdateDatabaseUser',
                'method' => 'PUT',
                'path' => '/databases/{database-id}/users/{username}',
                'operation_id' => 'update-database-user',
                'name' => 'Update Database User',
                'description' => 'Update Database User',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'username',
                        'argument_name' => 'username',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database useroperation/list-database-users.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_delete_database_user' => [
                'class' => 'VultrDeleteDatabaseUser',
                'method' => 'DELETE',
                'path' => '/databases/{database-id}/users/{username}',
                'operation_id' => 'delete-database-user',
                'name' => 'Delete Database User',
                'description' => 'Delete Database User',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'username',
                        'argument_name' => 'username',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database useroperation/list-database-users.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_set_database_user_acl' => [
                'class' => 'VultrSetDatabaseUserAcl',
                'method' => 'PUT',
                'path' => '/databases/{database-id}/users/{username}/access-control',
                'operation_id' => 'set-database-user-acl',
                'name' => 'Set Database User Access Control',
                'description' => 'Set Database User Access Control',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'username',
                        'argument_name' => 'username',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database useroperation/list-database-users.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_list_database_dbs' => [
                'class' => 'VultrListDatabaseDbs',
                'method' => 'GET',
                'path' => '/databases/{database-id}/dbs',
                'operation_id' => 'list-database-dbs',
                'name' => 'List Logical Databases',
                'description' => 'List Logical Databases',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_create_database_db' => [
                'class' => 'VultrCreateDatabaseDb',
                'method' => 'POST',
                'path' => '/databases/{database-id}/dbs',
                'operation_id' => 'create-database-db',
                'name' => 'Create Logical Database',
                'description' => 'Create Logical Database',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_get_database_db' => [
                'class' => 'VultrGetDatabaseDb',
                'method' => 'GET',
                'path' => '/databases/{database-id}/dbs/{db-name}',
                'operation_id' => 'get-database-db',
                'name' => 'Get Logical Database',
                'description' => 'Get Logical Database',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'db-name',
                        'argument_name' => 'db_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The logical database nameoperation/list-database-dbs.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_delete_database_db' => [
                'class' => 'VultrDeleteDatabaseDb',
                'method' => 'DELETE',
                'path' => '/databases/{database-id}/dbs/{db-name}',
                'operation_id' => 'delete-database-db',
                'name' => 'Delete Logical Database',
                'description' => 'Delete Logical Database',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'db-name',
                        'argument_name' => 'db_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The logical database nameoperation/list-database-dbs.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_list_database_topics' => [
                'class' => 'VultrListDatabaseTopics',
                'method' => 'GET',
                'path' => '/databases/{database-id}/topics',
                'operation_id' => 'list-database-topics',
                'name' => 'List Database Topics',
                'description' => 'List Database Topics',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_create_database_topic' => [
                'class' => 'VultrCreateDatabaseTopic',
                'method' => 'POST',
                'path' => '/databases/{database-id}/topics',
                'operation_id' => 'create-database-topic',
                'name' => 'Create Database Topic',
                'description' => 'Create Database Topic',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_get_database_topic' => [
                'class' => 'VultrGetDatabaseTopic',
                'method' => 'GET',
                'path' => '/databases/{database-id}/topics/{topic-name}',
                'operation_id' => 'get-database-topic',
                'name' => 'Get Database Topic',
                'description' => 'Get Database Topic',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'topic-name',
                        'argument_name' => 'topic_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database topicoperation/list-database-topics.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_update_database_topic' => [
                'class' => 'VultrUpdateDatabaseTopic',
                'method' => 'PUT',
                'path' => '/databases/{database-id}/topics/{topic-name}',
                'operation_id' => 'update-database-topic',
                'name' => 'Update Database Topic',
                'description' => 'Update Database Topic',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'topic-name',
                        'argument_name' => 'topic_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database topicoperation/list-database-topics.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_delete_database_topic' => [
                'class' => 'VultrDeleteDatabaseTopic',
                'method' => 'DELETE',
                'path' => '/databases/{database-id}/topics/{topic-name}',
                'operation_id' => 'delete-database-topic',
                'name' => 'Delete Database Topic',
                'description' => 'Delete Database Topic',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'topic-name',
                        'argument_name' => 'topic_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database topicoperation/list-database-topics.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_list_database_quotas' => [
                'class' => 'VultrListDatabaseQuotas',
                'method' => 'GET',
                'path' => '/databases/{database-id}/quotas',
                'operation_id' => 'list-database-quotas',
                'name' => 'List Database Quotas',
                'description' => 'List Database Quotas',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_create_database_quota' => [
                'class' => 'VultrCreateDatabaseQuota',
                'method' => 'POST',
                'path' => '/databases/{database-id}/quotas',
                'operation_id' => 'create-database-quota',
                'name' => 'Create Database Quota',
                'description' => 'Create Database Quota',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_get_database_quota' => [
                'class' => 'VultrGetDatabaseQuota',
                'method' => 'GET',
                'path' => '/databases/{database-id}/quotas/{client-id}/{username}',
                'operation_id' => 'get-database-quota',
                'name' => 'Get Database Quota',
                'description' => 'Get Database Quota',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'client-id',
                        'argument_name' => 'client_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database quota\'s client IDoperation/list-database-quotas.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'username',
                        'argument_name' => 'username',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database quota\'s useroperation/list-database-quotas.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_update_database_quota' => [
                'class' => 'VultrUpdateDatabaseQuota',
                'method' => 'PUT',
                'path' => '/databases/{database-id}/quotas/{client-id}/{username}',
                'operation_id' => 'update-database-quota',
                'name' => 'Update Database Quota',
                'description' => 'Update Database Quota',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'client-id',
                        'argument_name' => 'client_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database quota\'s client IDoperation/list-database-quotas.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'username',
                        'argument_name' => 'username',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database quota\'s useroperation/list-database-quotas.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_delete_database_quota' => [
                'class' => 'VultrDeleteDatabaseQuota',
                'method' => 'DELETE',
                'path' => '/databases/{database-id}/quotas/{client-id}/{username}',
                'operation_id' => 'delete-database-quota',
                'name' => 'Delete Database Quota',
                'description' => 'Delete Database Quota',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'client-id',
                        'argument_name' => 'client_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database quota\'s client IDoperation/list-database-quotas.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'username',
                        'argument_name' => 'username',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database quota\'s useroperation/list-database-quotas.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_list_database_available_connectors' => [
                'class' => 'VultrListDatabaseAvailableConnectors',
                'method' => 'GET',
                'path' => '/databases/{database-id}/available-connectors',
                'operation_id' => 'list-database-available-connectors',
                'name' => 'List Database Available Connectors',
                'description' => 'List Database Available Connectors',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_get_database_connector_configuration_schema' => [
                'class' => 'VultrGetDatabaseConnectorConfigurationSchema',
                'method' => 'GET',
                'path' => '/databases/{database-id}/available-connectors/{connector-class}/configuration',
                'operation_id' => 'get-database-connector-configuration-schema',
                'name' => 'Get Database Connector Configuration Schema',
                'description' => 'Get Database Connector Configuration Schema',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'connector-class',
                        'argument_name' => 'connector_class',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database connector\'s identifying classoperation/list-database-available-connectors.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_list_database_connectors' => [
                'class' => 'VultrListDatabaseConnectors',
                'method' => 'GET',
                'path' => '/databases/{database-id}/connectors',
                'operation_id' => 'list-database-connectors',
                'name' => 'List Database Connectors',
                'description' => 'List Database Connectors',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_create_database_connector' => [
                'class' => 'VultrCreateDatabaseConnector',
                'method' => 'POST',
                'path' => '/databases/{database-id}/connectors',
                'operation_id' => 'create-database-connector',
                'name' => 'Create Database Connector',
                'description' => 'Create Database Connector',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_get_database_connector' => [
                'class' => 'VultrGetDatabaseConnector',
                'method' => 'GET',
                'path' => '/databases/{database-id}/connectors/{connector-name}',
                'operation_id' => 'get-database-connector',
                'name' => 'Get Database Connector',
                'description' => 'Get Database Connector',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'connector-name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database connector\'s nameoperation/list-database-connectors.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_update_database_connector' => [
                'class' => 'VultrUpdateDatabaseConnector',
                'method' => 'PUT',
                'path' => '/databases/{database-id}/connectors/{connector-name}',
                'operation_id' => 'update-database-connector',
                'name' => 'Update Database Connector',
                'description' => 'Update Database Connector',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'connector-name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database connector\'s nameoperation/list-database-connectors.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_delete_database_connector' => [
                'class' => 'VultrDeleteDatabaseConnector',
                'method' => 'DELETE',
                'path' => '/databases/{database-id}/connectors/{connector-name}',
                'operation_id' => 'delete-database-connector',
                'name' => 'Delete Database Connector',
                'description' => 'Delete Database Connector',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'connector-name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database connector\'s nameoperation/list-database-connectors.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_get_database_connector_status' => [
                'class' => 'VultrGetDatabaseConnectorStatus',
                'method' => 'GET',
                'path' => '/databases/{database-id}/connectors/{connector-name}/status',
                'operation_id' => 'get-database-connector-status',
                'name' => 'Get Database Connector Status',
                'description' => 'Get Database Connector Status',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'connector-name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database connector\'s nameoperation/list-database-connectors.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_restart_database_connector' => [
                'class' => 'VultrRestartDatabaseConnector',
                'method' => 'POST',
                'path' => '/databases/{database-id}/connectors/{connector-name}/restart',
                'operation_id' => 'restart-database-connector',
                'name' => 'Restart Database Connector',
                'description' => 'Restart Database Connector',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'connector-name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database connector\'s nameoperation/list-database-connectors.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_pause_database_connector' => [
                'class' => 'VultrPauseDatabaseConnector',
                'method' => 'POST',
                'path' => '/databases/{database-id}/connectors/{connector-name}/pause',
                'operation_id' => 'pause-database-connector',
                'name' => 'Pause Database Connector',
                'description' => 'Pause Database Connector',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'connector-name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database connector\'s nameoperation/list-database-connectors.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_resume_database_connector' => [
                'class' => 'VultrResumeDatabaseConnector',
                'method' => 'POST',
                'path' => '/databases/{database-id}/connectors/{connector-name}/resume',
                'operation_id' => 'resume-database-connector',
                'name' => 'Resume Database Connector',
                'description' => 'Resume Database Connector',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'connector-name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database connector\'s nameoperation/list-database-connectors.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_restart_database_connector_task' => [
                'class' => 'VultrRestartDatabaseConnectorTask',
                'method' => 'POST',
                'path' => '/databases/{database-id}/connectors/{connector-name}/tasks/{task-id}/restart',
                'operation_id' => 'restart-database-connector-task',
                'name' => 'Restart Database Connector Task',
                'description' => 'Restart Database Connector Task',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'connector-name',
                        'argument_name' => 'connector_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The database connector\'s nameoperation/list-database-connectors.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'task-id',
                        'argument_name' => 'task_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The connector task\'s IDoperation/get-database-connector-status.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_list_maintenance_updates' => [
                'class' => 'VultrListMaintenanceUpdates',
                'method' => 'GET',
                'path' => '/databases/{database-id}/maintenance',
                'operation_id' => 'list-maintenance-updates',
                'name' => 'List Maintenance Updates',
                'description' => 'List Maintenance Updates',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_start_maintenance_updates' => [
                'class' => 'VultrStartMaintenanceUpdates',
                'method' => 'POST',
                'path' => '/databases/{database-id}/maintenance',
                'operation_id' => 'start-maintenance-updates',
                'name' => 'Start Maintenance Updates',
                'description' => 'Start Maintenance Updates',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_list_service_alerts' => [
                'class' => 'VultrListServiceAlerts',
                'method' => 'POST',
                'path' => '/databases/{database-id}/alerts',
                'operation_id' => 'list-service-alerts',
                'name' => 'List Service Alerts',
                'description' => 'List Service Alerts',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_view_migration_status' => [
                'class' => 'VultrViewMigrationStatus',
                'method' => 'GET',
                'path' => '/databases/{database-id}/migration',
                'operation_id' => 'view-migration-status',
                'name' => 'Get Migration Status',
                'description' => 'Get Migration Status',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_database_start_migration' => [
                'class' => 'VultrDatabaseStartMigration',
                'method' => 'POST',
                'path' => '/databases/{database-id}/migration',
                'operation_id' => 'database-start-migration',
                'name' => 'Start Migration',
                'description' => 'Start Migration',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_database_detach_migration' => [
                'class' => 'VultrDatabaseDetachMigration',
                'method' => 'DELETE',
                'path' => '/databases/{database-id}/migration',
                'operation_id' => 'database-detach-migration',
                'name' => 'Detach Migration',
                'description' => 'Detach Migration',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_database_add_read_replica' => [
                'class' => 'VultrDatabaseAddReadReplica',
                'method' => 'POST',
                'path' => '/databases/{database-id}/read-replica',
                'operation_id' => 'database-add-read-replica',
                'name' => 'Add Read-Only Replica',
                'description' => 'Add Read-Only Replica',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_database_promote_read_replica' => [
                'class' => 'VultrDatabasePromoteReadReplica',
                'method' => 'POST',
                'path' => '/databases/{database-id}/promote-read-replica',
                'operation_id' => 'database-promote-read-replica',
                'name' => 'Promote Read-Only Replica',
                'description' => 'Promote Read-Only Replica',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_get_backup_information' => [
                'class' => 'VultrGetBackupInformation',
                'method' => 'GET',
                'path' => '/databases/{database-id}/backups',
                'operation_id' => 'get-backup-information',
                'name' => 'Get Backup Information',
                'description' => 'Get Backup Information',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_database_restore_from_backup' => [
                'class' => 'VultrDatabaseRestoreFromBackup',
                'method' => 'POST',
                'path' => '/databases/{database-id}/restore',
                'operation_id' => 'database-restore-from-backup',
                'name' => 'Restore from Backup',
                'description' => 'Restore from Backup',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_database_fork' => [
                'class' => 'VultrDatabaseFork',
                'method' => 'POST',
                'path' => '/databases/{database-id}/fork',
                'operation_id' => 'database-fork',
                'name' => 'Fork Managed Database',
                'description' => 'Fork Managed Database',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_list_connection_pools' => [
                'class' => 'VultrListConnectionPools',
                'method' => 'GET',
                'path' => '/databases/{database-id}/connection-pools',
                'operation_id' => 'list-connection-pools',
                'name' => 'List Connection Pools',
                'description' => 'List Connection Pools',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_create_connection_pool' => [
                'class' => 'VultrCreateConnectionPool',
                'method' => 'POST',
                'path' => '/databases/{database-id}/connection-pools',
                'operation_id' => 'create-connection-pool',
                'name' => 'Create Connection Pool',
                'description' => 'Create Connection Pool',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_get_connection_pool' => [
                'class' => 'VultrGetConnectionPool',
                'method' => 'GET',
                'path' => '/databases/{database-id}/connection-pools/{pool-name}',
                'operation_id' => 'get-connection-pool',
                'name' => 'Get Connection Pool',
                'description' => 'Get Connection Pool',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'pool-name',
                        'argument_name' => 'pool_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The connection pool nameoperation/list-connection-pools.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_update_connection_pool' => [
                'class' => 'VultrUpdateConnectionPool',
                'method' => 'PUT',
                'path' => '/databases/{database-id}/connection-pools/{pool-name}',
                'operation_id' => 'update-connection-pool',
                'name' => 'Update Connection Pool',
                'description' => 'Update Connection Pool',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'pool-name',
                        'argument_name' => 'pool_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The connection pool nameoperation/list-connection-pools.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_delete_connection_pool' => [
                'class' => 'VultrDeleteConnectionPool',
                'method' => 'DELETE',
                'path' => '/databases/{database-id}/connection-pools/{pool-name}',
                'operation_id' => 'delete-connection-pool',
                'name' => 'Delete Connection Pool',
                'description' => 'Delete Connection Pool',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'database_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'pool-name',
                        'argument_name' => 'pool_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The connection pool nameoperation/list-connection-pools.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_list_advanced_options' => [
                'class' => 'VultrListAdvancedOptions',
                'method' => 'GET',
                'path' => '/databases/{database-id}/advanced-options',
                'operation_id' => 'list-advanced-options',
                'name' => 'List Advanced Options',
                'description' => 'List Advanced Options',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_update_advanced_options' => [
                'class' => 'VultrUpdateAdvancedOptions',
                'method' => 'PUT',
                'path' => '/databases/{database-id}/advanced-options',
                'operation_id' => 'update-advanced-options',
                'name' => 'Update Advanced Options',
                'description' => 'Update Advanced Options',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_list_advanced_options_kafka_rest' => [
                'class' => 'VultrListAdvancedOptionsKafkaRest',
                'method' => 'GET',
                'path' => '/databases/{database-id}/advanced-options/kafka-rest',
                'operation_id' => 'list-advanced-options-kafka-rest',
                'name' => 'List Kafka REST Advanced Options',
                'description' => 'List Kafka REST Advanced Options',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_update_advanced_options_kafka_rest' => [
                'class' => 'VultrUpdateAdvancedOptionsKafkaRest',
                'method' => 'PUT',
                'path' => '/databases/{database-id}/advanced-options/kafka-rest',
                'operation_id' => 'update-advanced-options-kafka-rest',
                'name' => 'Update Kafka REST Advanced Options',
                'description' => 'Update Kafka REST Advanced Options',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_list_advanced_options_schema_registry' => [
                'class' => 'VultrListAdvancedOptionsSchemaRegistry',
                'method' => 'GET',
                'path' => '/databases/{database-id}/advanced-options/schema-registry',
                'operation_id' => 'list-advanced-options-schema-registry',
                'name' => 'List Schema Registry Advanced Options',
                'description' => 'List Schema Registry Advanced Options',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_update_advanced_options_schema_registry' => [
                'class' => 'VultrUpdateAdvancedOptionsSchemaRegistry',
                'method' => 'PUT',
                'path' => '/databases/{database-id}/advanced-options/schema-registry',
                'operation_id' => 'update-advanced-options-schema-registry',
                'name' => 'Update Schema Registry Advanced Options',
                'description' => 'Update Schema Registry Advanced Options',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_list_advanced_options_kafka_connect' => [
                'class' => 'VultrListAdvancedOptionsKafkaConnect',
                'method' => 'GET',
                'path' => '/databases/{database-id}/advanced-options/kafka-connect',
                'operation_id' => 'list-advanced-options-kafka-connect',
                'name' => 'List Kafka Connect Advanced Options',
                'description' => 'List Kafka Connect Advanced Options',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_update_advanced_options_kafka_connect' => [
                'class' => 'VultrUpdateAdvancedOptionsKafkaConnect',
                'method' => 'PUT',
                'path' => '/databases/{database-id}/advanced-options/kafka-connect',
                'operation_id' => 'update-advanced-options-kafka-connect',
                'name' => 'Update Kafka Connect Advanced Options',
                'description' => 'Update Kafka Connect Advanced Options',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_list_available_versions' => [
                'class' => 'VultrListAvailableVersions',
                'method' => 'GET',
                'path' => '/databases/{database-id}/version-upgrade',
                'operation_id' => 'list-available-versions',
                'name' => 'List Available Versions',
                'description' => 'List Available Versions',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_start_version_upgrade' => [
                'class' => 'VultrStartVersionUpgrade',
                'method' => 'POST',
                'path' => '/databases/{database-id}/version-upgrade',
                'operation_id' => 'start-version-upgrade',
                'name' => 'Start Version Upgrade',
                'description' => 'Start Version Upgrade',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'database-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Managed Database IDoperation/list-databases.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'database_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'managed-databases'
                ]
            ],
            'vultr_list_inference' => [
                'class' => 'VultrListInference',
                'method' => 'GET',
                'path' => '/inference',
                'operation_id' => 'list-inference',
                'name' => 'List Serverless Inference',
                'description' => 'List Serverless Inference',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'serverless-inference'
                ]
            ],
            'vultr_create_inference' => [
                'class' => 'VultrCreateInference',
                'method' => 'POST',
                'path' => '/inference',
                'operation_id' => 'create-inference',
                'name' => 'Create Serverless Inference',
                'description' => 'Create Serverless Inference',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'serverless-inference'
                ]
            ],
            'vultr_get_inference' => [
                'class' => 'VultrGetInference',
                'method' => 'GET',
                'path' => '/inference/{inference-id}',
                'operation_id' => 'get-inference',
                'name' => 'Get Serverless Inference',
                'description' => 'Get Serverless Inference',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'inference-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Inference IDoperation/list-inference.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'inference_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'serverless-inference'
                ]
            ],
            'vultr_update_inference' => [
                'class' => 'VultrUpdateInference',
                'method' => 'PATCH',
                'path' => '/inference/{inference-id}',
                'operation_id' => 'update-inference',
                'name' => 'Update Serverless Inference',
                'description' => 'Update Serverless Inference',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'inference-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Inference IDoperation/list-inference.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'inference_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'serverless-inference'
                ]
            ],
            'vultr_delete_inference' => [
                'class' => 'VultrDeleteInference',
                'method' => 'DELETE',
                'path' => '/inference/{inference-id}',
                'operation_id' => 'delete-inference',
                'name' => 'Delete Serverless Inference',
                'description' => 'Delete Serverless Inference',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'inference-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Inference IDoperation/list-inference.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'inference_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'serverless-inference'
                ]
            ],
            'vultr_get_inference_usage' => [
                'class' => 'VultrGetInferenceUsage',
                'method' => 'GET',
                'path' => '/inference/{inference-id}/usage',
                'operation_id' => 'get-inference-usage',
                'name' => 'Get Serverless Inference Usage Information',
                'description' => 'Get Serverless Inference Usage Information',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'inference-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Inference IDoperation/list-inference.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'inference_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'serverless-inference'
                ]
            ],
            'vultr_list_marketplace_apps' => [
                'class' => 'VultrListMarketplaceApps',
                'method' => 'GET',
                'path' => '/marketplace/apps',
                'operation_id' => 'list-marketplace-apps',
                'name' => 'List Marketplace Apps',
                'description' => 'List Marketplace Apps',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'marketplace'
                ]
            ],
            'vultr_list_marketplace_app_variables' => [
                'class' => 'VultrListMarketplaceAppVariables',
                'method' => 'GET',
                'path' => '/marketplace/apps/{image-id}/variables',
                'operation_id' => 'list-marketplace-app-variables',
                'name' => 'List Marketplace App Variables',
                'description' => 'List Marketplace App Variables',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'image-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The application\'s Image IDoperation/list-applications.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'image_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'marketplace'
                ]
            ],
            'vultr_list_registries' => [
                'class' => 'VultrListRegistries',
                'method' => 'GET',
                'path' => '/registries',
                'operation_id' => 'list-registries',
                'name' => 'List Container Registries',
                'description' => 'List Container Registries',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_create_registry' => [
                'class' => 'VultrCreateRegistry',
                'method' => 'POST',
                'path' => '/registry',
                'operation_id' => 'create-registry',
                'name' => 'Create Container Registry',
                'description' => 'Create Container Registry',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_read_registry' => [
                'class' => 'VultrReadRegistry',
                'method' => 'GET',
                'path' => '/registry/{registry-id}',
                'operation_id' => 'read-registry',
                'name' => 'Read Container Registry',
                'description' => 'Read Container Registry',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'registry_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_update_registry' => [
                'class' => 'VultrUpdateRegistry',
                'method' => 'PUT',
                'path' => '/registry/{registry-id}',
                'operation_id' => 'update-registry',
                'name' => 'Update Container Registry',
                'description' => 'Update Container Registry',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'registry_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_delete_registry' => [
                'class' => 'VultrDeleteRegistry',
                'method' => 'DELETE',
                'path' => '/registry/{registry-id}',
                'operation_id' => 'delete-registry',
                'name' => 'Delete Container Registry',
                'description' => 'Delete Container Registry',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'registry_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_list_replications' => [
                'class' => 'VultrListReplications',
                'method' => 'GET',
                'path' => '/registry/{registry-id}/replications',
                'operation_id' => 'list-replications',
                'name' => 'List Replication Policies',
                'description' => 'List Replication Policies',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'registry_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_create_replication' => [
                'class' => 'VultrCreateReplication',
                'method' => 'POST',
                'path' => '/registry/{registry-id}/replication',
                'operation_id' => 'create-replication',
                'name' => 'Create Replication Policy',
                'description' => 'Create Replication Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'registry_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_read_replication' => [
                'class' => 'VultrReadReplication',
                'method' => 'GET',
                'path' => '/registry/{registry-id}/replication/{region}',
                'operation_id' => 'read-replication',
                'name' => 'Read Replication Policy',
                'description' => 'Read Replication Policy',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'registry_id'
                        ]
                    ],
                    [
                        'name' => 'VCR Region',
                        'argument_name' => 'v_c_r_region',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'The VCR Regioncomponents/schemas/replication/properties/region. Which can be found by List Regionoperation/list-registry-regions.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_delete_replication' => [
                'class' => 'VultrDeleteReplication',
                'method' => 'DELETE',
                'path' => '/registry/{registry-id}/replication/{region}',
                'operation_id' => 'delete-replication',
                'name' => 'Delete Replication Policy',
                'description' => 'Delete Replication Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'registry_id'
                        ]
                    ],
                    [
                        'name' => 'VCR Region',
                        'argument_name' => 'v_c_r_region',
                        'in' => 'query',
                        'required' => true,
                        'description' => 'The VCR Regioncomponents/schemas/replication/properties/region. Which can be found by List Regionoperation/list-registry-regions.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_update_retention_schedule' => [
                'class' => 'VultrUpdateRetentionSchedule',
                'method' => 'PUT',
                'path' => '/registry/{registry-id}/retention/schedule',
                'operation_id' => 'update-retention-schedule',
                'name' => 'Update Retention Policy Schedule',
                'description' => 'Update Retention Policy Schedule',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'registry_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_execute_retention_policy' => [
                'class' => 'VultrExecuteRetentionPolicy',
                'method' => 'POST',
                'path' => '/registry/{registry-id}/retention/executions',
                'operation_id' => 'execute-retention-policy',
                'name' => 'Trigger Retention Policy Execution',
                'description' => 'Trigger Retention Policy Execution',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'registry_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_list_retention_rules' => [
                'class' => 'VultrListRetentionRules',
                'method' => 'GET',
                'path' => '/registry/{registry-id}/retention/rules',
                'operation_id' => 'list-retention-rules',
                'name' => 'List Retention Rules',
                'description' => 'List Retention Rules',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'registry_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_create_retention_rule' => [
                'class' => 'VultrCreateRetentionRule',
                'method' => 'POST',
                'path' => '/registry/{registry-id}/retention/rules',
                'operation_id' => 'create-retention-rule',
                'name' => 'Create Retention Rule',
                'description' => 'Create Retention Rule',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'registry_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_read_retention_rule' => [
                'class' => 'VultrReadRetentionRule',
                'method' => 'GET',
                'path' => '/registry/{registry-id}/retention/rules/{retention-rule-id}',
                'operation_id' => 'read-retention-rule',
                'name' => 'Read Retention Rule',
                'description' => 'Read Retention Rule',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'registry_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'retention-rule-id',
                        'argument_name' => 'retention_rule_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Retention Rule IDcomponents/schemas/retention-rule/properties/id. Which can be found by List Retention Rulesoperation/list-retention-rules.',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_update_retention_rule' => [
                'class' => 'VultrUpdateRetentionRule',
                'method' => 'PUT',
                'path' => '/registry/{registry-id}/retention/rules/{retention-rule-id}',
                'operation_id' => 'update-retention-rule',
                'name' => 'Update Retention Rule',
                'description' => 'Update Retention Rule',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'registry_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'retention-rule-id',
                        'argument_name' => 'retention_rule_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Retention Rule IDcomponents/schemas/retention-rule/properties/id. Which can be found by List Retention Rulesoperation/list-retention-rules.',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_delete_retention_rule' => [
                'class' => 'VultrDeleteRetentionRule',
                'method' => 'DELETE',
                'path' => '/registry/{registry-id}/retention/rules/{retention-rule-id}',
                'operation_id' => 'delete-retention-rule',
                'name' => 'Delete Retention Rule',
                'description' => 'Delete Retention Rule',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'registry_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'retention-rule-id',
                        'argument_name' => 'retention_rule_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Retention Rule IDcomponents/schemas/retention-rule/properties/id. Which can be found by List Retention Rulesoperation/list-retention-rules.',
                        'schema_type' => 'number'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_list_registry_repositories' => [
                'class' => 'VultrListRegistryRepositories',
                'method' => 'GET',
                'path' => '/registry/{registry-id}/repositories',
                'operation_id' => 'list-registry-repositories',
                'name' => 'List Repositories',
                'description' => 'List Repositories',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'registry_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_read_registry_repository' => [
                'class' => 'VultrReadRegistryRepository',
                'method' => 'GET',
                'path' => '/registry/{registry-id}/repository/{repository-image}',
                'operation_id' => 'read-registry-repository',
                'name' => 'Read Repository',
                'description' => 'Read Repository',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'registry_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'repository-image',
                        'argument_name' => 'repository_image',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Repository Imagecomponents/schemas/registry-repository/properties/image. Which can be found by List Repositoriesoperation/list-registry-repositories.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_update_repository' => [
                'class' => 'VultrUpdateRepository',
                'method' => 'PUT',
                'path' => '/registry/{registry-id}/repository/{repository-image}',
                'operation_id' => 'update-repository',
                'name' => 'Update Repository',
                'description' => 'Update Repository',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'registry_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'repository-image',
                        'argument_name' => 'repository_image',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Repository Imagecomponents/schemas/registry-repository/properties/image. Which can be found by List Repositoriesoperation/list-registry-repositories.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_delete_repository' => [
                'class' => 'VultrDeleteRepository',
                'method' => 'DELETE',
                'path' => '/registry/{registry-id}/repository/{repository-image}',
                'operation_id' => 'delete-repository',
                'name' => 'Delete Repository',
                'description' => 'Delete Repository',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'registry_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'repository-image',
                        'argument_name' => 'repository_image',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Repository Imagecomponents/schemas/registry-repository/properties/image. Which can be found by List Repositoriesoperation/list-registry-repositories.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_update_container_registry_password' => [
                'class' => 'VultrUpdateContainerRegistryPassword',
                'method' => 'PUT',
                'path' => '/registry/{registry-id}/user/password',
                'operation_id' => 'update-container-registry-password',
                'name' => 'Update Container Registry Password',
                'description' => 'Update Container Registry Password',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'registry_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_list_registry_robots' => [
                'class' => 'VultrListRegistryRobots',
                'method' => 'GET',
                'path' => '/registry/{registry-id}/robots',
                'operation_id' => 'list-registry-robots',
                'name' => 'List Robots',
                'description' => 'List Robots',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'registry_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_g_e_t_registry_registry_id_robot_robot_name' => [
                'class' => 'VultrGETRegistryRegistryIdRobotRobotName',
                'method' => 'GET',
                'path' => '/registry/{registry-id}/robot/{robot-name}',
                'operation_id' => '',
                'name' => 'Read Robot',
                'description' => 'Read Robot',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'registry_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'robot-name',
                        'argument_name' => 'robot_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Robot Namecomponents/schemas/registry-robot/properties/name. Which can be found by List Robotsoperation/list-registry-robots.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_update_robot' => [
                'class' => 'VultrUpdateRobot',
                'method' => 'PUT',
                'path' => '/registry/{registry-id}/robot/{robot-name}',
                'operation_id' => 'update-robot',
                'name' => 'Update Robot',
                'description' => 'Update Robot',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'registry_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'robot-name',
                        'argument_name' => 'robot_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Robot Namecomponents/schemas/registry-robot/properties/name. Which can be found by List Robotsoperation/list-registry-robots.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_delete_robot' => [
                'class' => 'VultrDeleteRobot',
                'method' => 'DELETE',
                'path' => '/registry/{registry-id}/robot/{robot-name}',
                'operation_id' => 'delete-robot',
                'name' => 'Delete Robot',
                'description' => 'Delete Robot',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'registry_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'robot-name',
                        'argument_name' => 'robot_name',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Robot Namecomponents/schemas/registry-robot/properties/name. Which can be found by List Robotsoperation/list-registry-robots.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_list_registry_repository_artifacts' => [
                'class' => 'VultrListRegistryRepositoryArtifacts',
                'method' => 'GET',
                'path' => '/registry/{registry-id}/repository/{repository-image}/artifacts',
                'operation_id' => 'list-registry-repository-artifacts',
                'name' => 'List Artifacts',
                'description' => 'List Artifacts',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'registry_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'repository-image',
                        'argument_name' => 'repository_image',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Repository Imagecomponents/schemas/registry-repository/properties/image. Which can be found by List Repositoriesoperation/list-registry-repositories.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_g_e_t_registry_registry_id_repository_repository_image_artifact_artifact_digest' => [
                'class' => 'VultrGETRegistryRegistryIdRepositoryRepositoryImageArtifactArtifactDigest',
                'method' => 'GET',
                'path' => '/registry/{registry-id}/repository/{repository-image}/artifact/{artifact-digest}',
                'operation_id' => '',
                'name' => 'Read Artifact',
                'description' => 'Read Artifact',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'registry_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'repository-image',
                        'argument_name' => 'repository_image',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Repository Imagecomponents/schemas/registry-repository/properties/image. Which can be found by List Repositoriesoperation/list-registry-repositories.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'artifact-digest',
                        'argument_name' => 'artifact_digest',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Artifact Digestcomponents/schemas/registry-repository-artifact/properties/digest. Which can be found by List Artifactsoperation/list-registry-repository-artifacts.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_d_e_l_e_t_e_registry_registry_id_repository_repository_image_artifact_artifact_digest' => [
                'class' => 'VultrDELETERegistryRegistryIdRepositoryRepositoryImageArtifactArtifactDigest',
                'method' => 'DELETE',
                'path' => '/registry/{registry-id}/repository/{repository-image}/artifact/{artifact-digest}',
                'operation_id' => '',
                'name' => 'Delete Artifact',
                'description' => 'Delete Artifact',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'registry-id',
                        'argument_name' => 'registry_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Registry IDcomponents/schemas/registry/properties/id. Which can be found by List Registriesoperation/list-registries.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'repository-image',
                        'argument_name' => 'repository_image',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Repository Imagecomponents/schemas/registry-repository/properties/image. Which can be found by List Repositoriesoperation/list-registry-repositories.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'artifact-digest',
                        'argument_name' => 'artifact_digest',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Artifact Digestcomponents/schemas/registry-repository-artifact/properties/digest. Which can be found by List Artifactsoperation/list-registry-repository-artifacts.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_list_registry_regions' => [
                'class' => 'VultrListRegistryRegions',
                'method' => 'GET',
                'path' => '/registry/region/list',
                'operation_id' => 'list-registry-regions',
                'name' => 'List Registry Regions',
                'description' => 'List Registry Regions',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_list_registry_plans' => [
                'class' => 'VultrListRegistryPlans',
                'method' => 'GET',
                'path' => '/registry/plan/list',
                'operation_id' => 'list-registry-plans',
                'name' => 'List Registry Plans',
                'description' => 'List Registry Plans',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'Container Registry'
                ]
            ],
            'vultr_list_tickets' => [
                'class' => 'VultrListTickets',
                'method' => 'GET',
                'path' => '/tickets',
                'operation_id' => 'list-tickets',
                'name' => 'List Tickets',
                'description' => 'List Tickets',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'tickets'
                ]
            ],
            'vultr_create_ticket' => [
                'class' => 'VultrCreateTicket',
                'method' => 'POST',
                'path' => '/tickets',
                'operation_id' => 'create-ticket',
                'name' => 'Create Ticket',
                'description' => 'Create Ticket',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'tickets'
                ]
            ],
            'vultr_get_ticket' => [
                'class' => 'VultrGetTicket',
                'method' => 'GET',
                'path' => '/tickets/{reference}',
                'operation_id' => 'get-ticket',
                'name' => 'Get Ticket',
                'description' => 'Get Ticket',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'reference',
                        'argument_name' => 'reference',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The referenceoperation/list-tickets.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'tickets'
                ]
            ],
            'vultr_close_ticket' => [
                'class' => 'VultrCloseTicket',
                'method' => 'POST',
                'path' => '/tickets/{reference}',
                'operation_id' => 'close-ticket',
                'name' => 'Close Ticket',
                'description' => 'Close Ticket',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'reference',
                        'argument_name' => 'reference',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The referenceoperation/list-tickets.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'tickets'
                ]
            ],
            'vultr_list_ticket_replies' => [
                'class' => 'VultrListTicketReplies',
                'method' => 'GET',
                'path' => '/tickets/{reference}/replies',
                'operation_id' => 'list-ticket-replies',
                'name' => 'List Ticket Replies',
                'description' => 'List Ticket Replies',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'reference',
                        'argument_name' => 'reference',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The referenceoperation/list-tickets.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'tickets'
                ]
            ],
            'vultr_create_reply' => [
                'class' => 'VultrCreateReply',
                'method' => 'POST',
                'path' => '/tickets/{reference}/replies',
                'operation_id' => 'create-reply',
                'name' => 'Create Ticket Reply',
                'description' => 'Create Ticket Reply',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'reference',
                        'argument_name' => 'reference',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The referenceoperation/list-tickets.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'tickets'
                ]
            ],
            'vultr_review_ticket_reply' => [
                'class' => 'VultrReviewTicketReply',
                'method' => 'POST',
                'path' => '/tickets/{reference}/replies/{ticket-reply-index}/review',
                'operation_id' => 'review-ticket-reply',
                'name' => 'Rate Ticket Reply',
                'description' => 'Rate Ticket Reply',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'reference',
                        'argument_name' => 'reference',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The referenceoperation/list-tickets.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'ticket-reply-index',
                        'argument_name' => 'ticket_reply_index',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The indexoperation/list-ticket-replies.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'tickets'
                ]
            ],
            'vultr_get_ticket_reply_attachment' => [
                'class' => 'VultrGetTicketReplyAttachment',
                'method' => 'GET',
                'path' => '/tickets/{reference}/replies/{ticket-reply-index}/attachments/{ticket-attachment-index}',
                'operation_id' => 'get-ticket-reply-attachment',
                'name' => 'Get Ticket Reply Attachment',
                'description' => 'Get Ticket Reply Attachment',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'reference',
                        'argument_name' => 'reference',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The referenceoperation/list-tickets.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'ticket-reply-index',
                        'argument_name' => 'ticket_reply_index',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The indexoperation/list-ticket-replies.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'ticket-attachment-index',
                        'argument_name' => 'ticket_attachment_index',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The attachments indexoperation/list-ticket-replies.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'tickets'
                ]
            ],
            'vultr_list_regions_vfs_regions' => [
                'class' => 'VultrListRegionsVfsRegions',
                'method' => 'GET',
                'path' => '/vfs/regions',
                'operation_id' => 'listRegions',
                'name' => 'List VFS Regions',
                'description' => 'List VFS Regions',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'VFS'
                ]
            ],
            'vultr_list_v_f_s' => [
                'class' => 'VultrListVFS',
                'method' => 'GET',
                'path' => '/vfs',
                'operation_id' => 'listVFS',
                'name' => 'List VFSs',
                'description' => 'List VFSs',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'VFS'
                ]
            ],
            'vultr_create_v_f_s' => [
                'class' => 'VultrCreateVFS',
                'method' => 'POST',
                'path' => '/vfs',
                'operation_id' => 'createVFS',
                'name' => 'Create VFS',
                'description' => 'Create VFS',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => true,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'VFS'
                ]
            ],
            'vultr_get_v_f_s' => [
                'class' => 'VultrGetVFS',
                'method' => 'GET',
                'path' => '/vfs/{vfs_id}',
                'operation_id' => 'getVFS',
                'name' => 'Get VFS',
                'description' => 'Get VFS',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vfs_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'ID of the VFS subscription to retrieve',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vfs_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VFS'
                ]
            ],
            'vultr_update_v_f_s' => [
                'class' => 'VultrUpdateVFS',
                'method' => 'PUT',
                'path' => '/vfs/{vfs_id}',
                'operation_id' => 'updateVFS',
                'name' => 'Update VFS',
                'description' => 'Update VFS',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'VFS'
                ]
            ],
            'vultr_delete_v_f_s' => [
                'class' => 'VultrDeleteVFS',
                'method' => 'DELETE',
                'path' => '/vfs/{vfs_id}',
                'operation_id' => 'deleteVFS',
                'name' => 'Delete VFS',
                'description' => 'Delete VFS',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vfs_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'ID of the VFS subscription to retrieve',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vfs_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VFS'
                ]
            ],
            'vultr_list_v_f_s_attachments' => [
                'class' => 'VultrListVFSAttachments',
                'method' => 'GET',
                'path' => '/vfs/{vfs_id}/attachments',
                'operation_id' => 'listVFSAttachments',
                'name' => 'List VFS Attachments',
                'description' => 'List VFS Attachments',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vfs_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'ID of the VFS subscription',
                        'schema_type' => 'string',
                        'aliases' => [
                            'vfs_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VFS'
                ]
            ],
            'vultr_create_v_f_s_attachment' => [
                'class' => 'VultrCreateVFSAttachment',
                'method' => 'PUT',
                'path' => '/vfs/{vfs_id}/attachments/{vps_id}',
                'operation_id' => 'createVFSAttachment',
                'name' => 'Attach VPS Instance to VFS',
                'description' => 'Attach VPS Instance to VFS',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vfs_id',
                        'argument_name' => 'vfs_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'ID of the VFS subscription',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'vps_id',
                        'argument_name' => 'vps_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'ID of the VPS subscription to attach',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VFS'
                ]
            ],
            'vultr_get_v_f_s_attachment' => [
                'class' => 'VultrGetVFSAttachment',
                'method' => 'GET',
                'path' => '/vfs/{vfs_id}/attachments/{vps_id}',
                'operation_id' => 'getVFSAttachment',
                'name' => 'Get VFS Attachment',
                'description' => 'Get VFS Attachment',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'vfs_id',
                        'argument_name' => 'vfs_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'ID of the VFS subscription',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'vps_id',
                        'argument_name' => 'vps_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'ID of the VPS subscription to attach',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VFS'
                ]
            ],
            'vultr_delete_v_f_s_attachment' => [
                'class' => 'VultrDeleteVFSAttachment',
                'method' => 'DELETE',
                'path' => '/vfs/{vfs_id}/attachments/{vps_id}',
                'operation_id' => 'deleteVFSAttachment',
                'name' => 'Delete VFS Attachment',
                'description' => 'Delete VFS Attachment',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'vfs_id',
                        'argument_name' => 'vfs_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'ID of the VFS subscription',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'vps_id',
                        'argument_name' => 'vps_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'ID of the VPS subscription to attach',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'VFS'
                ]
            ],
            'vultr_list_iam_policies' => [
                'class' => 'VultrListIamPolicies',
                'method' => 'GET',
                'path' => '/v2/policies',
                'operation_id' => 'list-iam-policies',
                'name' => 'List Policies',
                'description' => 'List Policies',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_create_iam_policy' => [
                'class' => 'VultrCreateIamPolicy',
                'method' => 'POST',
                'path' => '/v2/policies',
                'operation_id' => 'create-iam-policy',
                'name' => 'Create Policy',
                'description' => 'Create Policy',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_get_iam_policy' => [
                'class' => 'VultrGetIamPolicy',
                'method' => 'GET',
                'path' => '/v2/policies/{id}',
                'operation_id' => 'get-iam-policy',
                'name' => 'Get Policy',
                'description' => 'Get Policy',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Policy ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_update_iam_policy' => [
                'class' => 'VultrUpdateIamPolicy',
                'method' => 'PUT',
                'path' => '/v2/policies/{id}',
                'operation_id' => 'update-iam-policy',
                'name' => 'Update Policy',
                'description' => 'Update Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Policy ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_delete_iam_policy' => [
                'class' => 'VultrDeleteIamPolicy',
                'method' => 'DELETE',
                'path' => '/v2/policies/{id}',
                'operation_id' => 'delete-iam-policy',
                'name' => 'Delete Policy',
                'description' => 'Delete Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Policy ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_restore_iam_policy' => [
                'class' => 'VultrRestoreIamPolicy',
                'method' => 'PATCH',
                'path' => '/v2/policies/{id}/restore',
                'operation_id' => 'restore-iam-policy',
                'name' => 'Restore Policy',
                'description' => 'Restore Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Policy ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_list_iam_policy_groups' => [
                'class' => 'VultrListIamPolicyGroups',
                'method' => 'GET',
                'path' => '/v2/policies/{policy_id}/groups',
                'operation_id' => 'list-iam-policy-groups',
                'name' => 'List Policy Groups',
                'description' => 'List Policy Groups',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'policy_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Policy ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'policy_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_attach_iam_group_to_policy' => [
                'class' => 'VultrAttachIamGroupToPolicy',
                'method' => 'POST',
                'path' => '/v2/policies/{policy_id}/groups/{group_id}',
                'operation_id' => 'attach-iam-group-to-policy',
                'name' => 'Attach Group to Policy',
                'description' => 'Attach Group to Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'policy_id',
                        'argument_name' => 'policy_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Policy ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_detach_iam_group_from_policy' => [
                'class' => 'VultrDetachIamGroupFromPolicy',
                'method' => 'DELETE',
                'path' => '/v2/policies/{policy_id}/groups/{group_id}',
                'operation_id' => 'detach-iam-group-from-policy',
                'name' => 'Detach Group from Policy',
                'description' => 'Detach Group from Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'policy_id',
                        'argument_name' => 'policy_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Policy ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_list_iam_policy_users' => [
                'class' => 'VultrListIamPolicyUsers',
                'method' => 'GET',
                'path' => '/v2/policies/{policy_id}/users',
                'operation_id' => 'list-iam-policy-users',
                'name' => 'List Policy Users',
                'description' => 'List Policy Users',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'policy_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Policy ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'policy_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_attach_iam_user_to_policy' => [
                'class' => 'VultrAttachIamUserToPolicy',
                'method' => 'POST',
                'path' => '/v2/policies/{policy_id}/users/{user_id}',
                'operation_id' => 'attach-iam-user-to-policy',
                'name' => 'Attach User to Policy',
                'description' => 'Attach User to Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'policy_id',
                        'argument_name' => 'policy_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Policy ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'user_id',
                        'argument_name' => 'user_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_detach_iam_user_from_policy' => [
                'class' => 'VultrDetachIamUserFromPolicy',
                'method' => 'DELETE',
                'path' => '/v2/policies/{policy_id}/users/{user_id}',
                'operation_id' => 'detach-iam-user-from-policy',
                'name' => 'Detach User from Policy',
                'description' => 'Detach User from Policy',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'policy_id',
                        'argument_name' => 'policy_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Policy ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'user_id',
                        'argument_name' => 'user_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_list_iam_roles' => [
                'class' => 'VultrListIamRoles',
                'method' => 'GET',
                'path' => '/v2/roles',
                'operation_id' => 'list-iam-roles',
                'name' => 'List Roles',
                'description' => 'List Roles',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_create_iam_role' => [
                'class' => 'VultrCreateIamRole',
                'method' => 'POST',
                'path' => '/v2/roles',
                'operation_id' => 'create-iam-role',
                'name' => 'Create Role',
                'description' => 'Create Role',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_get_iam_role' => [
                'class' => 'VultrGetIamRole',
                'method' => 'GET',
                'path' => '/v2/roles/{id}',
                'operation_id' => 'get-iam-role',
                'name' => 'Get Role',
                'description' => 'Get Role',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_update_iam_role' => [
                'class' => 'VultrUpdateIamRole',
                'method' => 'PUT',
                'path' => '/v2/roles/{id}',
                'operation_id' => 'update-iam-role',
                'name' => 'Update Role',
                'description' => 'Update Role',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_delete_iam_role' => [
                'class' => 'VultrDeleteIamRole',
                'method' => 'DELETE',
                'path' => '/v2/roles/{id}',
                'operation_id' => 'delete-iam-role',
                'name' => 'Delete Role',
                'description' => 'Delete Role',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_restore_iam_role' => [
                'class' => 'VultrRestoreIamRole',
                'method' => 'PATCH',
                'path' => '/v2/roles/{id}/restore',
                'operation_id' => 'restore-iam-role',
                'name' => 'Restore Role',
                'description' => 'Restore Role',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_list_iam_role_groups' => [
                'class' => 'VultrListIamRoleGroups',
                'method' => 'GET',
                'path' => '/v2/roles/{role_id}/groups',
                'operation_id' => 'list-iam-role-groups',
                'name' => 'List Role Groups',
                'description' => 'List Role Groups',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'role_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'role_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_assign_iam_group_to_role' => [
                'class' => 'VultrAssignIamGroupToRole',
                'method' => 'POST',
                'path' => '/v2/roles/{role_id}/groups/{group_id}',
                'operation_id' => 'assign-iam-group-to-role',
                'name' => 'Assign Group to Role',
                'description' => 'Assign Group to Role',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'role_id',
                        'argument_name' => 'role_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_remove_iam_group_from_role' => [
                'class' => 'VultrRemoveIamGroupFromRole',
                'method' => 'DELETE',
                'path' => '/v2/roles/{role_id}/groups/{group_id}',
                'operation_id' => 'remove-iam-group-from-role',
                'name' => 'Remove Group from Role',
                'description' => 'Remove Group from Role',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'role_id',
                        'argument_name' => 'role_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_list_iam_role_users' => [
                'class' => 'VultrListIamRoleUsers',
                'method' => 'GET',
                'path' => '/v2/roles/{role_id}/users',
                'operation_id' => 'list-iam-role-users',
                'name' => 'List Role Users',
                'description' => 'List Role Users',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'role_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'role_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_assign_iam_user_to_role' => [
                'class' => 'VultrAssignIamUserToRole',
                'method' => 'POST',
                'path' => '/v2/roles/{role_id}/users/{user_id}',
                'operation_id' => 'assign-iam-user-to-role',
                'name' => 'Assign User to Role',
                'description' => 'Assign User to Role',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'role_id',
                        'argument_name' => 'role_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'user_id',
                        'argument_name' => 'user_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_remove_iam_user_from_role' => [
                'class' => 'VultrRemoveIamUserFromRole',
                'method' => 'DELETE',
                'path' => '/v2/roles/{role_id}/users/{user_id}',
                'operation_id' => 'remove-iam-user-from-role',
                'name' => 'Remove User from Role',
                'description' => 'Remove User from Role',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'role_id',
                        'argument_name' => 'role_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'user_id',
                        'argument_name' => 'user_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_list_iam_role_policies' => [
                'class' => 'VultrListIamRolePolicies',
                'method' => 'GET',
                'path' => '/v2/roles/{role_id}/policies',
                'operation_id' => 'list-iam-role-policies',
                'name' => 'List Role Policies',
                'description' => 'List Role Policies',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'role_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'role_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_assign_iam_policy_to_role_deprecated' => [
                'class' => 'VultrAssignIamPolicyToRoleDeprecated',
                'method' => 'POST',
                'path' => '/v2/roles/{role_id}/policies',
                'operation_id' => 'assign-iam-policy-to-role-deprecated',
                'name' => 'Assign Policy to Role Deprecated',
                'description' => 'Assign Policy to Role Deprecated',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'role_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'role_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_assign_iam_policy_to_role' => [
                'class' => 'VultrAssignIamPolicyToRole',
                'method' => 'POST',
                'path' => '/v2/roles/{role_id}/policies/{policy_id}',
                'operation_id' => 'assign-iam-policy-to-role',
                'name' => 'Assign Policy to Role',
                'description' => 'Assign Policy to Role',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'role_id',
                        'argument_name' => 'role_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'policy_id',
                        'argument_name' => 'policy_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Policy ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_remove_iam_policy_from_role' => [
                'class' => 'VultrRemoveIamPolicyFromRole',
                'method' => 'DELETE',
                'path' => '/v2/roles/{role_id}/policies/{policy_id}',
                'operation_id' => 'remove-iam-policy-from-role',
                'name' => 'Remove Policy from Role',
                'description' => 'Remove Policy from Role',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'role_id',
                        'argument_name' => 'role_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'policy_id',
                        'argument_name' => 'policy_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Policy ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_list_iam_groups' => [
                'class' => 'VultrListIamGroups',
                'method' => 'GET',
                'path' => '/v2/groups',
                'operation_id' => 'list-iam-groups',
                'name' => 'List Groups',
                'description' => 'List Groups',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_create_iam_group' => [
                'class' => 'VultrCreateIamGroup',
                'method' => 'POST',
                'path' => '/v2/groups',
                'operation_id' => 'create-iam-group',
                'name' => 'Create Group',
                'description' => 'Create Group',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_get_iam_group' => [
                'class' => 'VultrGetIamGroup',
                'method' => 'GET',
                'path' => '/v2/groups/{id}',
                'operation_id' => 'get-iam-group',
                'name' => 'Get Group',
                'description' => 'Get Group',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'show_last_activity',
                        'argument_name' => 'show_last_activity',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Set to true to include the lastactivity field in the response.',
                        'schema_type' => 'boolean'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_update_iam_group' => [
                'class' => 'VultrUpdateIamGroup',
                'method' => 'PUT',
                'path' => '/v2/groups/{id}',
                'operation_id' => 'update-iam-group',
                'name' => 'Update Group',
                'description' => 'Update Group',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_delete_iam_group' => [
                'class' => 'VultrDeleteIamGroup',
                'method' => 'DELETE',
                'path' => '/v2/groups/{id}',
                'operation_id' => 'delete-iam-group',
                'name' => 'Delete Group',
                'description' => 'Delete Group',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_list_iam_group_members' => [
                'class' => 'VultrListIamGroupMembers',
                'method' => 'GET',
                'path' => '/v2/groups/{group_id}/members',
                'operation_id' => 'list-iam-group-members',
                'name' => 'List Group Members',
                'description' => 'List Group Members',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'group_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Group ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'group_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_add_iam_group_member' => [
                'class' => 'VultrAddIamGroupMember',
                'method' => 'POST',
                'path' => '/v2/groups/{group_id}/members',
                'operation_id' => 'add-iam-group-member',
                'name' => 'Add Group Member',
                'description' => 'Add Group Member',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'group_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Group ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'group_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_get_iam_group_member' => [
                'class' => 'VultrGetIamGroupMember',
                'method' => 'GET',
                'path' => '/v2/groups/{group_id}/members/{id}',
                'operation_id' => 'get-iam-group-member',
                'name' => 'Get Group Member',
                'description' => 'Get Group Member',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Group Member ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_remove_iam_group_member' => [
                'class' => 'VultrRemoveIamGroupMember',
                'method' => 'DELETE',
                'path' => '/v2/groups/{group_id}/members/{id}',
                'operation_id' => 'remove-iam-group-member',
                'name' => 'Remove Group Member',
                'description' => 'Remove Group Member',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Group Member ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_restore_iam_group_member' => [
                'class' => 'VultrRestoreIamGroupMember',
                'method' => 'PUT',
                'path' => '/v2/groups/{group_id}/members/{id}',
                'operation_id' => 'restore-iam-group-member',
                'name' => 'Restore Group Member',
                'description' => 'Restore Group Member',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'group_id',
                        'argument_name' => 'group_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Group Member ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_list_iam_group_roles' => [
                'class' => 'VultrListIamGroupRoles',
                'method' => 'GET',
                'path' => '/v2/groups/{id}/roles',
                'operation_id' => 'list-iam-group-roles',
                'name' => 'List Group Roles',
                'description' => 'List Group Roles',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_list_iam_group_policies' => [
                'class' => 'VultrListIamGroupPolicies',
                'method' => 'GET',
                'path' => '/v2/groups/{id}/policies',
                'operation_id' => 'list-iam-group-policies',
                'name' => 'List Group Policies',
                'description' => 'List Group Policies',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Group ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_list_iam_role_trusts' => [
                'class' => 'VultrListIamRoleTrusts',
                'method' => 'GET',
                'path' => '/v2/role-trusts',
                'operation_id' => 'list-iam-role-trusts',
                'name' => 'List Role Trusts',
                'description' => 'List Role Trusts',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_create_iam_role_trust' => [
                'class' => 'VultrCreateIamRoleTrust',
                'method' => 'POST',
                'path' => '/v2/role-trusts',
                'operation_id' => 'create-iam-role-trust',
                'name' => 'Create Role Trust',
                'description' => 'Create Role Trust',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_get_iam_role_trust' => [
                'class' => 'VultrGetIamRoleTrust',
                'method' => 'GET',
                'path' => '/v2/role-trusts/{id}',
                'operation_id' => 'get-iam-role-trust',
                'name' => 'Get Role Trust',
                'description' => 'Get Role Trust',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role Trust ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_update_iam_role_trust' => [
                'class' => 'VultrUpdateIamRoleTrust',
                'method' => 'PUT',
                'path' => '/v2/role-trusts/{id}',
                'operation_id' => 'update-iam-role-trust',
                'name' => 'Update Role Trust',
                'description' => 'Update Role Trust',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role Trust ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_delete_iam_role_trust' => [
                'class' => 'VultrDeleteIamRoleTrust',
                'method' => 'DELETE',
                'path' => '/v2/role-trusts/{id}',
                'operation_id' => 'delete-iam-role-trust',
                'name' => 'Delete Role Trust',
                'description' => 'Delete Role Trust',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role Trust ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_restore_iam_role_trust' => [
                'class' => 'VultrRestoreIamRoleTrust',
                'method' => 'PATCH',
                'path' => '/v2/role-trusts/{id}/restore',
                'operation_id' => 'restore-iam-role-trust',
                'name' => 'Restore Role Trust',
                'description' => 'Restore Role Trust',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role Trust ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_list_iam_role_trusts_by_role' => [
                'class' => 'VultrListIamRoleTrustsByRole',
                'method' => 'GET',
                'path' => '/v2/role-trusts/by-role/{role_id}',
                'operation_id' => 'list-iam-role-trusts-by-role',
                'name' => 'List Role Trusts by Role',
                'description' => 'List Role Trusts by Role',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'role_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Role ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'role_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_list_iam_assumable_roles' => [
                'class' => 'VultrListIamAssumableRoles',
                'method' => 'GET',
                'path' => '/v2/role-trusts/assumable/{user_id}',
                'operation_id' => 'list-iam-assumable-roles',
                'name' => 'List Assumable Roles for User',
                'description' => 'List Assumable Roles for User',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'user_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'user_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_iam_aws_sts_assume_role' => [
                'class' => 'VultrIamAwsStsAssumeRole',
                'method' => 'POST',
                'path' => '/v2/assumed-roles/compatibility/aws/sts',
                'operation_id' => 'iam-aws-sts-assume-role',
                'name' => 'AWS STS AssumeRole Compatibility',
                'description' => 'AWS STS AssumeRole Compatibility',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_iam_assume_role' => [
                'class' => 'VultrIamAssumeRole',
                'method' => 'POST',
                'path' => '/v2/assumed-roles/assume',
                'operation_id' => 'iam-assume-role',
                'name' => 'Assume Role',
                'description' => 'Assume Role',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_list_iam_assumed_role_sessions' => [
                'class' => 'VultrListIamAssumedRoleSessions',
                'method' => 'GET',
                'path' => '/v2/assumed-roles/users/{user_id}/sessions',
                'operation_id' => 'list-iam-assumed-role-sessions',
                'name' => 'List Assumed Role Sessions',
                'description' => 'List Assumed Role Sessions',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'user_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'user_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_delete_iam_assumed_role_session' => [
                'class' => 'VultrDeleteIamAssumedRoleSession',
                'method' => 'DELETE',
                'path' => '/v2/assumed-roles/{session_token}',
                'operation_id' => 'delete-iam-assumed-role-session',
                'name' => 'Delete Assumed Role Session',
                'description' => 'Delete Assumed Role Session',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'session_token',
                        'argument_name' => 'session_token',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The session token.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'iam'
                ]
            ],
            'vultr_list_invitations' => [
                'class' => 'VultrListInvitations',
                'method' => 'GET',
                'path' => '/v2/invitation',
                'operation_id' => 'list-invitations',
                'name' => 'List Invitations',
                'description' => 'List Invitations',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'organizations'
                ]
            ],
            'vultr_create_invitation' => [
                'class' => 'VultrCreateInvitation',
                'method' => 'POST',
                'path' => '/v2/invitation',
                'operation_id' => 'create-invitation',
                'name' => 'Create Invitation',
                'description' => 'Create Invitation',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'organizations'
                ]
            ],
            'vultr_get_invitation' => [
                'class' => 'VultrGetInvitation',
                'method' => 'GET',
                'path' => '/v2/invitation/{id}',
                'operation_id' => 'get-invitation',
                'name' => 'Get Invitation',
                'description' => 'Get Invitation',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Invitation ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'organizations'
                ]
            ],
            'vultr_resend_invitation' => [
                'class' => 'VultrResendInvitation',
                'method' => 'POST',
                'path' => '/v2/invitation/{id}/resend',
                'operation_id' => 'resend-invitation',
                'name' => 'Resend Invitation',
                'description' => 'Resend Invitation',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Invitation ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'organizations'
                ]
            ],
            'vultr_list_iam_current_user_groups' => [
                'class' => 'VultrListIamCurrentUserGroups',
                'method' => 'GET',
                'path' => '/v2/users/me/groups',
                'operation_id' => 'list-iam-current-user-groups',
                'name' => 'List My Groups',
                'description' => 'List My Groups',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'users'
                ]
            ],
            'vultr_list_iam_current_user_roles' => [
                'class' => 'VultrListIamCurrentUserRoles',
                'method' => 'GET',
                'path' => '/v2/users/me/roles',
                'operation_id' => 'list-iam-current-user-roles',
                'name' => 'List My Roles',
                'description' => 'List My Roles',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'users'
                ]
            ],
            'vultr_list_iam_current_user_policies' => [
                'class' => 'VultrListIamCurrentUserPolicies',
                'method' => 'GET',
                'path' => '/v2/users/me/policies',
                'operation_id' => 'list-iam-current-user-policies',
                'name' => 'List My Policies',
                'description' => 'List My Policies',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'users'
                ]
            ],
            'vultr_list_iam_user_groups' => [
                'class' => 'VultrListIamUserGroups',
                'method' => 'GET',
                'path' => '/v2/users/{user_id}/groups',
                'operation_id' => 'list-iam-user-groups',
                'name' => 'List User Groups',
                'description' => 'List User Groups',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'user_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'user_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'users'
                ]
            ],
            'vultr_list_iam_user_roles' => [
                'class' => 'VultrListIamUserRoles',
                'method' => 'GET',
                'path' => '/v2/users/{user_id}/roles',
                'operation_id' => 'list-iam-user-roles',
                'name' => 'List User Roles',
                'description' => 'List User Roles',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'user_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'user_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'users'
                ]
            ],
            'vultr_list_iam_user_policies' => [
                'class' => 'VultrListIamUserPolicies',
                'method' => 'GET',
                'path' => '/v2/users/{user_id}/policies',
                'operation_id' => 'list-iam-user-policies',
                'name' => 'List User Policies',
                'description' => 'List User Policies',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'user_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'user_id'
                        ]
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'users'
                ]
            ],
            'vultr_list_organizations' => [
                'class' => 'VultrListOrganizations',
                'method' => 'GET',
                'path' => '/v2/organizations',
                'operation_id' => 'list-organizations',
                'name' => 'List Organizations',
                'description' => 'List Organizations',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'organizations'
                ]
            ],
            'vultr_get_organization' => [
                'class' => 'VultrGetOrganization',
                'method' => 'GET',
                'path' => '/v2/organizations/{id}',
                'operation_id' => 'get-organization',
                'name' => 'Get Organization',
                'description' => 'Get Organization',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Organization ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'organizations'
                ]
            ],
            'vultr_update_organization' => [
                'class' => 'VultrUpdateOrganization',
                'method' => 'PUT',
                'path' => '/v2/organizations/{id}',
                'operation_id' => 'update-organization',
                'name' => 'Update Organization',
                'description' => 'Update Organization',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Organization ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'organizations'
                ]
            ],
            'vultr_remove_organization_user' => [
                'class' => 'VultrRemoveOrganizationUser',
                'method' => 'DELETE',
                'path' => '/v2/organizations/{id}/user/{user_id}',
                'operation_id' => 'remove-organization-user',
                'name' => 'Remove User from Organization',
                'description' => 'Remove User from Organization',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Organization ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'user_id',
                        'argument_name' => 'user_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'organizations'
                ]
            ],
            'vultr_suspend_organization_user' => [
                'class' => 'VultrSuspendOrganizationUser',
                'method' => 'PUT',
                'path' => '/v2/organizations/{id}/user/{user_id}/suspend',
                'operation_id' => 'suspend-organization-user',
                'name' => 'Suspend Organization User',
                'description' => 'Suspend Organization User',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Organization ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'user_id',
                        'argument_name' => 'user_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'organizations'
                ]
            ],
            'vultr_unsuspend_organization_user' => [
                'class' => 'VultrUnsuspendOrganizationUser',
                'method' => 'PUT',
                'path' => '/v2/organizations/{id}/user/{user_id}/unsuspend',
                'operation_id' => 'unsuspend-organization-user',
                'name' => 'Unsuspend Organization User',
                'description' => 'Unsuspend Organization User',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Organization ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'user_id',
                        'argument_name' => 'user_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The User ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'organizations'
                ]
            ],
            'vultr_list_organization_suspended_users' => [
                'class' => 'VultrListOrganizationSuspendedUsers',
                'method' => 'GET',
                'path' => '/v2/organizations/{id}/suspended-users',
                'operation_id' => 'list-organization-suspended-users',
                'name' => 'List Suspended Organization Users',
                'description' => 'List Suspended Organization Users',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Organization ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'organizations'
                ]
            ],
            'vultr_get_organization_scim' => [
                'class' => 'VultrGetOrganizationScim',
                'method' => 'GET',
                'path' => '/v2/organizations/{id}/scim',
                'operation_id' => 'get-organization-scim',
                'name' => 'Get Organization SCIM Config',
                'description' => 'Get Organization SCIM Config',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Organization ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'organizations'
                ]
            ],
            'vultr_enable_organization_scim' => [
                'class' => 'VultrEnableOrganizationScim',
                'method' => 'POST',
                'path' => '/v2/organizations/{id}/scim/enable',
                'operation_id' => 'enable-organization-scim',
                'name' => 'Enable SCIM',
                'description' => 'Enable SCIM',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Organization ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'organizations'
                ]
            ],
            'vultr_disable_organization_scim' => [
                'class' => 'VultrDisableOrganizationScim',
                'method' => 'POST',
                'path' => '/v2/organizations/{id}/scim/disable',
                'operation_id' => 'disable-organization-scim',
                'name' => 'Disable SCIM',
                'description' => 'Disable SCIM',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Organization ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'organizations'
                ]
            ],
            'vultr_rotate_organization_scim_token' => [
                'class' => 'VultrRotateOrganizationScimToken',
                'method' => 'POST',
                'path' => '/v2/organizations/{id}/scim/token',
                'operation_id' => 'rotate-organization-scim-token',
                'name' => 'Rotate SCIM Token',
                'description' => 'Rotate SCIM Token',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Organization ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'organizations'
                ]
            ],
            'vultr_list_oidc_providers' => [
                'class' => 'VultrListOidcProviders',
                'method' => 'GET',
                'path' => '/v2/oidc/provider',
                'operation_id' => 'list-oidc-providers',
                'name' => 'List OIDC Providers',
                'description' => 'List OIDC Providers',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'oidc'
                ]
            ],
            'vultr_create_oidc_provider' => [
                'class' => 'VultrCreateOidcProvider',
                'method' => 'POST',
                'path' => '/v2/oidc/provider',
                'operation_id' => 'create-oidc-provider',
                'name' => 'Create OIDC Provider',
                'description' => 'Create OIDC Provider',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'oidc'
                ]
            ],
            'vultr_get_oidc_provider' => [
                'class' => 'VultrGetOidcProvider',
                'method' => 'GET',
                'path' => '/v2/oidc/provider/{provider_id}',
                'operation_id' => 'get-oidc-provider',
                'name' => 'Get OIDC Provider',
                'description' => 'Get OIDC Provider',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'provider_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The OIDC Provider ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'provider_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'oidc'
                ]
            ],
            'vultr_delete_oidc_provider' => [
                'class' => 'VultrDeleteOidcProvider',
                'method' => 'DELETE',
                'path' => '/v2/oidc/provider/{provider_id}',
                'operation_id' => 'delete-oidc-provider',
                'name' => 'Delete OIDC Provider',
                'description' => 'Delete OIDC Provider',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'provider_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The OIDC Provider ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'provider_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'oidc'
                ]
            ],
            'vultr_create_oidc_provider_token' => [
                'class' => 'VultrCreateOidcProviderToken',
                'method' => 'POST',
                'path' => '/v2/oidc/provider/{provider_id}/token',
                'operation_id' => 'create-oidc-provider-token',
                'name' => 'Create OIDC Provider Token',
                'description' => 'Create OIDC Provider Token',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'provider_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The OIDC Provider ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'provider_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'oidc'
                ]
            ],
            'vultr_get_oidc_provider_discovery' => [
                'class' => 'VultrGetOidcProviderDiscovery',
                'method' => 'GET',
                'path' => '/v2/oidc/provider/{provider_id}/.well-known/openid-configuration',
                'operation_id' => 'get-oidc-provider-discovery',
                'name' => 'Get OIDC Provider Discovery',
                'description' => 'Get OIDC Provider Discovery',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'provider_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The OIDC Provider ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'provider_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'oidc'
                ]
            ],
            'vultr_list_oidc_issuers' => [
                'class' => 'VultrListOidcIssuers',
                'method' => 'GET',
                'path' => '/v2/oidc/issuer',
                'operation_id' => 'list-oidc-issuers',
                'name' => 'List OIDC Issuers',
                'description' => 'List OIDC Issuers',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'oidc'
                ]
            ],
            'vultr_create_oidc_issuer' => [
                'class' => 'VultrCreateOidcIssuer',
                'method' => 'POST',
                'path' => '/v2/oidc/issuer',
                'operation_id' => 'create-oidc-issuer',
                'name' => 'Create OIDC Issuer',
                'description' => 'Create OIDC Issuer',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'oidc'
                ]
            ],
            'vultr_get_oidc_issuer' => [
                'class' => 'VultrGetOidcIssuer',
                'method' => 'GET',
                'path' => '/v2/oidc/issuer/{issuer_id}',
                'operation_id' => 'get-oidc-issuer',
                'name' => 'Get OIDC Issuer',
                'description' => 'Get OIDC Issuer',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'issuer_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The OIDC Issuer ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'issuer_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'oidc'
                ]
            ],
            'vultr_update_oidc_issuer' => [
                'class' => 'VultrUpdateOidcIssuer',
                'method' => 'PATCH',
                'path' => '/v2/oidc/issuer/{issuer_id}',
                'operation_id' => 'update-oidc-issuer',
                'name' => 'Update OIDC Issuer',
                'description' => 'Update OIDC Issuer',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'issuer_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The OIDC Issuer ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'issuer_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'oidc'
                ]
            ],
            'vultr_delete_oidc_issuer' => [
                'class' => 'VultrDeleteOidcIssuer',
                'method' => 'DELETE',
                'path' => '/v2/oidc/issuer/{issuer_id}',
                'operation_id' => 'delete-oidc-issuer',
                'name' => 'Delete OIDC Issuer',
                'description' => 'Delete OIDC Issuer',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'issuer_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The OIDC Issuer ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'issuer_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'oidc'
                ]
            ],
            'vultr_get_oidc_issuer_jwks' => [
                'class' => 'VultrGetOidcIssuerJwks',
                'method' => 'GET',
                'path' => '/v2/oidc/issuer/{issuer_id}/jwks',
                'operation_id' => 'get-oidc-issuer-jwks',
                'name' => 'Get OIDC Issuer JWKS',
                'description' => 'Get OIDC Issuer JWKS',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'issuer_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The OIDC Issuer ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'issuer_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'oidc'
                ]
            ],
            'vultr_oidc_authorize' => [
                'class' => 'VultrOidcAuthorize',
                'method' => 'GET',
                'path' => '/v2/oidc/authorize',
                'operation_id' => 'oidc-authorize',
                'name' => 'OIDC Authorization Endpoint',
                'description' => 'OIDC Authorization Endpoint',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'response_type',
                        'argument_name' => 'response_type',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The response type e.g., "code".',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'client_id',
                        'argument_name' => 'client_id',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The client ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'redirect_uri',
                        'argument_name' => 'redirect_uri',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The redirect URI after authorization.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'scope',
                        'argument_name' => 'scope',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The requested scopes e.g., "openid".',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'state',
                        'argument_name' => 'state',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'An opaque value for security.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'oidc'
                ]
            ],
            'vultr_get_oidc_token' => [
                'class' => 'VultrGetOidcToken',
                'method' => 'GET',
                'path' => '/v2/oidc/token',
                'operation_id' => 'get-oidc-token',
                'name' => 'Get OIDC Token Info',
                'description' => 'Get OIDC Token Info',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'oidc'
                ]
            ],
            'vultr_get_oidc_jwks' => [
                'class' => 'VultrGetOidcJwks',
                'method' => 'GET',
                'path' => '/v2/oidc/jwks',
                'operation_id' => 'get-oidc-jwks',
                'name' => 'Get OIDC JWKS',
                'description' => 'Get OIDC JWKS',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'oidc'
                ]
            ],
            'vultr_get_oidc_userinfo' => [
                'class' => 'VultrGetOidcUserinfo',
                'method' => 'GET',
                'path' => '/v2/oidc/userinfo',
                'operation_id' => 'get-oidc-userinfo',
                'name' => 'Get OIDC User Info',
                'description' => 'Get OIDC User Info',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'oidc'
                ]
            ],
            'vultr_scim_list_users' => [
                'class' => 'VultrScimListUsers',
                'method' => 'GET',
                'path' => '/scim/v2/Users',
                'operation_id' => 'scim-list-users',
                'name' => 'List SCIM Users',
                'description' => 'List SCIM Users',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'startIndex',
                        'argument_name' => 'start_index',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The 1-based index of the first result in the current set of list results.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'count',
                        'argument_name' => 'count',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Specifies the desired maximum number of query results per page.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'filter',
                        'argument_name' => 'filter',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter expression to select specific resources e.g., userName eq "user@example.com".',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'scim'
                ]
            ],
            'vultr_scim_create_user' => [
                'class' => 'VultrScimCreateUser',
                'method' => 'POST',
                'path' => '/scim/v2/Users',
                'operation_id' => 'scim-create-user',
                'name' => 'Create SCIM User',
                'description' => 'Create SCIM User',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'scim'
                ]
            ],
            'vultr_scim_get_user' => [
                'class' => 'VultrScimGetUser',
                'method' => 'GET',
                'path' => '/scim/v2/Users/{id}',
                'operation_id' => 'scim-get-user',
                'name' => 'Get SCIM User',
                'description' => 'Get SCIM User',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The SCIM User ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'scim'
                ]
            ],
            'vultr_scim_patch_user' => [
                'class' => 'VultrScimPatchUser',
                'method' => 'PATCH',
                'path' => '/scim/v2/Users/{id}',
                'operation_id' => 'scim-patch-user',
                'name' => 'Patch SCIM User',
                'description' => 'Patch SCIM User',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The SCIM User ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'scim'
                ]
            ],
            'vultr_scim_delete_user' => [
                'class' => 'VultrScimDeleteUser',
                'method' => 'DELETE',
                'path' => '/scim/v2/Users/{id}',
                'operation_id' => 'scim-delete-user',
                'name' => 'Delete SCIM User',
                'description' => 'Delete SCIM User',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The SCIM User ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'scim'
                ]
            ],
            'vultr_scim_list_groups' => [
                'class' => 'VultrScimListGroups',
                'method' => 'GET',
                'path' => '/scim/v2/Groups',
                'operation_id' => 'scim-list-groups',
                'name' => 'List SCIM Groups',
                'description' => 'List SCIM Groups',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'startIndex',
                        'argument_name' => 'start_index',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'The 1-based index of the first result in the current set of list results.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'count',
                        'argument_name' => 'count',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Specifies the desired maximum number of query results per page.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'filter',
                        'argument_name' => 'filter',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter expression to select specific resources e.g., displayName eq "my-group".',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'scim'
                ]
            ],
            'vultr_scim_create_group' => [
                'class' => 'VultrScimCreateGroup',
                'method' => 'POST',
                'path' => '/scim/v2/Groups',
                'operation_id' => 'scim-create-group',
                'name' => 'Create SCIM Group',
                'description' => 'Create SCIM Group',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'scim'
                ]
            ],
            'vultr_scim_get_group' => [
                'class' => 'VultrScimGetGroup',
                'method' => 'GET',
                'path' => '/scim/v2/Groups/{id}',
                'operation_id' => 'scim-get-group',
                'name' => 'Get SCIM Group',
                'description' => 'Get SCIM Group',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The SCIM Group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'scim'
                ]
            ],
            'vultr_scim_update_group' => [
                'class' => 'VultrScimUpdateGroup',
                'method' => 'PUT',
                'path' => '/scim/v2/Groups/{id}',
                'operation_id' => 'scim-update-group',
                'name' => 'Update SCIM Group',
                'description' => 'Update SCIM Group',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The SCIM Group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'scim'
                ]
            ],
            'vultr_scim_patch_group' => [
                'class' => 'VultrScimPatchGroup',
                'method' => 'PATCH',
                'path' => '/scim/v2/Groups/{id}',
                'operation_id' => 'scim-patch-group',
                'name' => 'Patch SCIM Group',
                'description' => 'Patch SCIM Group',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The SCIM Group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Vultr API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'scim'
                ]
            ],
            'vultr_scim_delete_group' => [
                'class' => 'VultrScimDeleteGroup',
                'method' => 'DELETE',
                'path' => '/scim/v2/Groups/{id}',
                'operation_id' => 'scim-delete-group',
                'name' => 'Delete SCIM Group',
                'description' => 'Delete SCIM Group',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The SCIM Group ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'scim'
                ]
            ],
            'vultr_list_clusters' => [
                'class' => 'VultrListClusters',
                'method' => 'GET',
                'path' => '/clusters',
                'operation_id' => 'list-clusters',
                'name' => 'List Clusters',
                'description' => 'List Clusters',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'per_page',
                        'argument_name' => 'per_page',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items requested per page. Default is 100 and Max is 500.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'cursor',
                        'argument_name' => 'cursor',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Cursor for paging. See Meta and Paginationsection/Introduction/Meta-and-Pagination.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'clusters'
                ]
            ],
            'vultr_create_cluster' => [
                'class' => 'VultrCreateCluster',
                'method' => 'POST',
                'path' => '/clusters',
                'operation_id' => 'create-cluster',
                'name' => 'Create Cluster',
                'description' => 'Create Cluster',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'clusters'
                ]
            ],
            'vultr_get_cluster_availability' => [
                'class' => 'VultrGetClusterAvailability',
                'method' => 'GET',
                'path' => '/clusters/availability',
                'operation_id' => 'get-cluster-availability',
                'name' => 'Get Cluster Availability',
                'description' => 'Get Cluster Availability',
                'type' => 'read',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'clusters'
                ]
            ],
            'vultr_get_cluster' => [
                'class' => 'VultrGetCluster',
                'method' => 'GET',
                'path' => '/clusters/{cluster-id}',
                'operation_id' => 'get-cluster',
                'name' => 'Get Cluster',
                'description' => 'Get Cluster',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Cluster IDoperation/list-clusters.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'clusters'
                ]
            ],
            'vultr_update_cluster' => [
                'class' => 'VultrUpdateCluster',
                'method' => 'PUT',
                'path' => '/clusters/{cluster-id}',
                'operation_id' => 'update-cluster',
                'name' => 'Update Cluster',
                'description' => 'Update Cluster',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Cluster IDoperation/list-clusters.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'clusters'
                ]
            ],
            'vultr_mass_update_cluster_instances' => [
                'class' => 'VultrMassUpdateClusterInstances',
                'method' => 'POST',
                'path' => '/clusters/{cluster-id}',
                'operation_id' => 'mass-update-cluster-instances',
                'name' => 'Mass Update Cluster Instances',
                'description' => 'Mass Update Cluster Instances',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Cluster IDoperation/list-clusters.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'clusters'
                ]
            ],
            'vultr_delete_cluster' => [
                'class' => 'VultrDeleteCluster',
                'method' => 'DELETE',
                'path' => '/clusters/{cluster-id}',
                'operation_id' => 'delete-cluster',
                'name' => 'Delete Cluster',
                'description' => 'Delete Cluster',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Cluster IDoperation/list-clusters.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'clusters'
                ]
            ],
            'vultr_get_cluster_metrics' => [
                'class' => 'VultrGetClusterMetrics',
                'method' => 'GET',
                'path' => '/clusters/{cluster-id}/metrics',
                'operation_id' => 'get-cluster-metrics',
                'name' => 'Get Cluster Metrics',
                'description' => 'Get Cluster Metrics',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'cluster-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Cluster IDoperation/list-clusters.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'cluster_id'
                        ]
                    ],
                    [
                        'name' => 'period',
                        'argument_name' => 'period',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Time period for metrics. Defaults to -1days.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'clusters'
                ]
            ],
            'vultr_update_cluster_instance' => [
                'class' => 'VultrUpdateClusterInstance',
                'method' => 'POST',
                'path' => '/clusters/{cluster-id}/{action}/{instance-id}',
                'operation_id' => 'update-cluster-instance',
                'name' => 'Update Cluster Instance',
                'description' => 'Update Cluster Instance',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'cluster-id',
                        'argument_name' => 'cluster_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Cluster IDoperation/list-clusters.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'action',
                        'argument_name' => 'action',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The action to perform. attach detach',
                        'schema_type' => 'string',
                        'enum' => [
                            'attach',
                            'detach'
                        ]
                    ],
                    [
                        'name' => 'instance-id',
                        'argument_name' => 'instance_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance IDoperation/list-instances.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'clusters'
                ]
            ],
            'vultr_list_instance_templates' => [
                'class' => 'VultrListInstanceTemplates',
                'method' => 'GET',
                'path' => '/instances/templates',
                'operation_id' => 'list-instance-templates',
                'name' => 'List Instance Templates',
                'description' => 'List Instance Templates',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'instance-templates'
                ]
            ],
            'vultr_create_instance_template' => [
                'class' => 'VultrCreateInstanceTemplate',
                'method' => 'POST',
                'path' => '/instances/templates',
                'operation_id' => 'create-instance-template',
                'name' => 'Create Instance Template',
                'description' => 'Create Instance Template',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instance-templates'
                ]
            ],
            'vultr_get_instance_template' => [
                'class' => 'VultrGetInstanceTemplate',
                'method' => 'GET',
                'path' => '/instances/templates/{instancetemplate-id}',
                'operation_id' => 'get-instance-template',
                'name' => 'Get Instance Template',
                'description' => 'Get Instance Template',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'instancetemplate-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance Template IDoperation/list-instance-templates.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instancetemplate_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instance-templates'
                ]
            ],
            'vultr_update_instance_template' => [
                'class' => 'VultrUpdateInstanceTemplate',
                'method' => 'PUT',
                'path' => '/instances/templates/{instancetemplate-id}',
                'operation_id' => 'update-instance-template',
                'name' => 'Update Instance Template',
                'description' => 'Update Instance Template',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instancetemplate-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance Template IDoperation/list-instance-templates.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instancetemplate_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Include a JSON object in the request body with a content type of application/json.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'instance-templates'
                ]
            ],
            'vultr_delete_instance_template' => [
                'class' => 'VultrDeleteInstanceTemplate',
                'method' => 'DELETE',
                'path' => '/instances/templates/{instancetemplate-id}',
                'operation_id' => 'delete-instance-template',
                'name' => 'Delete Instance Template',
                'description' => 'Delete Instance Template',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'instancetemplate-id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Instance Template IDoperation/list-instance-templates.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'instancetemplate_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'instance-templates'
                ]
            ]
        ];
    }
}
