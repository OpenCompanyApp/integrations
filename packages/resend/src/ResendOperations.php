<?php

namespace OpenCompany\Integrations\Resend;

/**
 * Generated Resend OpenAPI operation catalog.
 *
 * Metadata is extracted from Resend's official OpenAPI document and is used
 * by generated tools plus the shared service executor.
 */
class ResendOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return [
            'resend_send_email' => [
                'class' => 'ResendSendEmail',
                'method' => 'POST',
                'path' => '/emails',
                'operation_id' => '',
                'name' => 'Send an email',
                'description' => 'Send an email',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'Idempotency-Key',
                        'argument_name' => 'idempotency_key',
                        'in' => 'header',
                        'required' => false,
                        'description' => 'A unique identifier for the request to ensure emails are only sent once. Learn morehttps://resend.com/docs/dashboard/emails/idempotency-keys',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Emails'
                ]
            ],
            'resend_list_emails' => [
                'class' => 'ResendListEmails',
                'method' => 'GET',
                'path' => '/emails',
                'operation_id' => '',
                'name' => 'Retrieve a list of emails',
                'description' => 'Retrieve a list of emails',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items after this cursor.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items before this cursor.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Emails'
                ]
            ],
            'resend_get_email' => [
                'class' => 'ResendGetEmail',
                'method' => 'GET',
                'path' => '/emails/{email_id}',
                'operation_id' => '',
                'name' => 'Retrieve a single email',
                'description' => 'Retrieve a single email',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'email_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the email.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'email_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Emails'
                ]
            ],
            'resend_update_emails' => [
                'class' => 'ResendUpdateEmails',
                'method' => 'PATCH',
                'path' => '/emails/{email_id}',
                'operation_id' => '',
                'name' => 'Update a single email',
                'description' => 'Update a single email',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'email_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the email.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'email_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Emails'
                ]
            ],
            'resend_cancel_email' => [
                'class' => 'ResendCancelEmail',
                'method' => 'POST',
                'path' => '/emails/{email_id}/cancel',
                'operation_id' => '',
                'name' => 'Cancel the schedule of the e-mail.',
                'description' => 'Cancel the schedule of the e-mail.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'email_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the email.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'email_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Emails'
                ]
            ],
            'resend_send_batch_emails' => [
                'class' => 'ResendSendBatchEmails',
                'method' => 'POST',
                'path' => '/emails/batch',
                'operation_id' => '',
                'name' => 'Trigger up to 100 batch emails at once.',
                'description' => 'Trigger up to 100 batch emails at once.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'Idempotency-Key',
                        'argument_name' => 'idempotency_key',
                        'in' => 'header',
                        'required' => false,
                        'description' => 'A unique identifier for the request to ensure emails are only sent once. Learn morehttps://resend.com/docs/dashboard/emails/idempotency-keys',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'array',
                    'items' => [
                        'type' => 'object'
                    ]
                ],
                'tags' => [
                    'Emails'
                ]
            ],
            'resend_list_attachments' => [
                'class' => 'ResendListAttachments',
                'method' => 'GET',
                'path' => '/emails/{email_id}/attachments',
                'operation_id' => '',
                'name' => 'Retrieve a list of attachments for a sent email',
                'description' => 'Retrieve a list of attachments for a sent email',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'email_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the email.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'email_id'
                        ]
                    ],
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Maximum number of attachments to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination cursor to fetch results after this attachment ID. Cannot be used with \'before\'.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination cursor to fetch results before this attachment ID. Cannot be used with \'after\'.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Emails'
                ]
            ],
            'resend_get_attachments' => [
                'class' => 'ResendGetAttachments',
                'method' => 'GET',
                'path' => '/emails/{email_id}/attachments/{attachment_id}',
                'operation_id' => '',
                'name' => 'Retrieve a single attachment for a sent email',
                'description' => 'Retrieve a single attachment for a sent email',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'email_id',
                        'argument_name' => 'email_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the email.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'attachment_id',
                        'argument_name' => 'attachment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the attachment.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Emails'
                ]
            ],
            'resend_list_receiving' => [
                'class' => 'ResendListReceiving',
                'method' => 'GET',
                'path' => '/emails/receiving',
                'operation_id' => '',
                'name' => 'Retrieve a list of received emails',
                'description' => 'Retrieve a list of received emails',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Maximum number of received emails to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination cursor to fetch results after this email ID. Cannot be used with \'before\'.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination cursor to fetch results before this email ID. Cannot be used with \'after\'.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Receiving Emails'
                ]
            ],
            'resend_get_receiving' => [
                'class' => 'ResendGetReceiving',
                'method' => 'GET',
                'path' => '/emails/receiving/{email_id}',
                'operation_id' => '',
                'name' => 'Retrieve a single received email',
                'description' => 'Retrieve a single received email',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'email_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the received email.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'email_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Receiving Emails'
                ]
            ],
            'resend_list_attachments_receiving_email_id_attachments' => [
                'class' => 'ResendListAttachmentsReceivingEmailIdAttachments',
                'method' => 'GET',
                'path' => '/emails/receiving/{email_id}/attachments',
                'operation_id' => '',
                'name' => 'Retrieve a list of attachments for a received email',
                'description' => 'Retrieve a list of attachments for a received email',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'email_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the received email.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'email_id'
                        ]
                    ],
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Maximum number of attachments to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination cursor to fetch results after this attachment ID. Cannot be used with \'before\'.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination cursor to fetch results before this attachment ID. Cannot be used with \'after\'.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Receiving Emails'
                ]
            ],
            'resend_get_attachments_email_id_attachments_attachment_id' => [
                'class' => 'ResendGetAttachmentsEmailIdAttachmentsAttachmentId',
                'method' => 'GET',
                'path' => '/emails/receiving/{email_id}/attachments/{attachment_id}',
                'operation_id' => '',
                'name' => 'Retrieve a single attachment for a received email',
                'description' => 'Retrieve a single attachment for a received email',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'email_id',
                        'argument_name' => 'email_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the received email.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'attachment_id',
                        'argument_name' => 'attachment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the attachment.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Receiving Emails'
                ]
            ],
            'resend_create_domain' => [
                'class' => 'ResendCreateDomain',
                'method' => 'POST',
                'path' => '/domains',
                'operation_id' => '',
                'name' => 'Create a new domain',
                'description' => 'Create a new domain',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Domains'
                ]
            ],
            'resend_list_domains' => [
                'class' => 'ResendListDomains',
                'method' => 'GET',
                'path' => '/domains',
                'operation_id' => '',
                'name' => 'Retrieve a list of domains',
                'description' => 'Retrieve a list of domains',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items after this cursor.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items before this cursor.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Domains'
                ]
            ],
            'resend_get_domain' => [
                'class' => 'ResendGetDomain',
                'method' => 'GET',
                'path' => '/domains/{domain_id}',
                'operation_id' => '',
                'name' => 'Retrieve a single domain',
                'description' => 'Retrieve a single domain',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'domain_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the domain.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'domain_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Domains'
                ]
            ],
            'resend_update_domains' => [
                'class' => 'ResendUpdateDomains',
                'method' => 'PATCH',
                'path' => '/domains/{domain_id}',
                'operation_id' => '',
                'name' => 'Update an existing domain',
                'description' => 'Update an existing domain',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'domain_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the domain.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'domain_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Domains'
                ]
            ],
            'resend_delete_domains' => [
                'class' => 'ResendDeleteDomains',
                'method' => 'DELETE',
                'path' => '/domains/{domain_id}',
                'operation_id' => '',
                'name' => 'Remove an existing domain',
                'description' => 'Remove an existing domain',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'domain_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the domain.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'domain_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Domains'
                ]
            ],
            'resend_verify_domain' => [
                'class' => 'ResendVerifyDomain',
                'method' => 'POST',
                'path' => '/domains/{domain_id}/verify',
                'operation_id' => '',
                'name' => 'Verify an existing domain',
                'description' => 'Triggers verification of the domain\'s DNS records including DKIM, SPF, and the tracking CNAME if a tracking subdomain is configured.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'domain_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the domain.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'domain_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Domains'
                ]
            ],
            'resend_create_api_key' => [
                'class' => 'ResendCreateApiKey',
                'method' => 'POST',
                'path' => '/api-keys',
                'operation_id' => '',
                'name' => 'Create a new API key',
                'description' => 'Create a new API key',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'API Keys'
                ]
            ],
            'resend_list_api_keys' => [
                'class' => 'ResendListApiKeys',
                'method' => 'GET',
                'path' => '/api-keys',
                'operation_id' => '',
                'name' => 'Retrieve a list of API keys',
                'description' => 'Retrieve a list of API keys',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items after this cursor.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items before this cursor.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'API Keys'
                ]
            ],
            'resend_delete_api_keys' => [
                'class' => 'ResendDeleteApiKeys',
                'method' => 'DELETE',
                'path' => '/api-keys/{api_key_id}',
                'operation_id' => '',
                'name' => 'Remove an existing API key',
                'description' => 'Remove an existing API key',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'api_key_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The API key ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'api_key_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'API Keys'
                ]
            ],
            'resend_create_templates' => [
                'class' => 'ResendCreateTemplates',
                'method' => 'POST',
                'path' => '/templates',
                'operation_id' => '',
                'name' => 'Create a template',
                'description' => 'Create a template',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Templates'
                ]
            ],
            'resend_list_templates' => [
                'class' => 'ResendListTemplates',
                'method' => 'GET',
                'path' => '/templates',
                'operation_id' => '',
                'name' => 'Retrieve a list of templates',
                'description' => 'Retrieve a list of templates',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items after this cursor.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items before this cursor.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Templates'
                ]
            ],
            'resend_get_templates' => [
                'class' => 'ResendGetTemplates',
                'method' => 'GET',
                'path' => '/templates/{id}',
                'operation_id' => '',
                'name' => 'Retrieve a single template',
                'description' => 'Retrieve a single template',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Template ID or alias.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Templates'
                ]
            ],
            'resend_update_templates' => [
                'class' => 'ResendUpdateTemplates',
                'method' => 'PATCH',
                'path' => '/templates/{id}',
                'operation_id' => '',
                'name' => 'Update an existing template',
                'description' => 'Update an existing template',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Template ID or alias.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Templates'
                ]
            ],
            'resend_delete_templates' => [
                'class' => 'ResendDeleteTemplates',
                'method' => 'DELETE',
                'path' => '/templates/{id}',
                'operation_id' => '',
                'name' => 'Remove an existing template',
                'description' => 'Remove an existing template',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Template ID or alias.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Templates'
                ]
            ],
            'resend_publish_template' => [
                'class' => 'ResendPublishTemplate',
                'method' => 'POST',
                'path' => '/templates/{id}/publish',
                'operation_id' => '',
                'name' => 'Publish a template',
                'description' => 'Publish a template',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Template ID or alias.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Templates'
                ]
            ],
            'resend_duplicate_template' => [
                'class' => 'ResendDuplicateTemplate',
                'method' => 'POST',
                'path' => '/templates/{id}/duplicate',
                'operation_id' => '',
                'name' => 'Duplicate a template',
                'description' => 'Duplicate a template',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Template ID or alias.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Templates'
                ]
            ],
            'resend_create_audiences' => [
                'class' => 'ResendCreateAudiences',
                'method' => 'POST',
                'path' => '/audiences',
                'operation_id' => '',
                'name' => 'Create a list of contacts',
                'description' => 'Deprecated: Use Segments instead. These endpoints still work, but will be removed in the future.',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Audiences'
                ]
            ],
            'resend_list_audiences' => [
                'class' => 'ResendListAudiences',
                'method' => 'GET',
                'path' => '/audiences',
                'operation_id' => '',
                'name' => 'Retrieve a list of audiences',
                'description' => 'Deprecated: Use Segments instead. These endpoints still work, but will be removed in the future.',
                'type' => 'read',
                'parameters' => [],
                'request_body' => null,
                'tags' => [
                    'Audiences'
                ]
            ],
            'resend_delete_audiences' => [
                'class' => 'ResendDeleteAudiences',
                'method' => 'DELETE',
                'path' => '/audiences/{id}',
                'operation_id' => '',
                'name' => 'Remove an existing audience',
                'description' => 'Deprecated: Use Segments instead. These endpoints still work, but will be removed in the future.',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Audience ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Audiences'
                ]
            ],
            'resend_get_audiences' => [
                'class' => 'ResendGetAudiences',
                'method' => 'GET',
                'path' => '/audiences/{id}',
                'operation_id' => '',
                'name' => 'Retrieve a single audience',
                'description' => 'Deprecated: Use Segments instead. These endpoints still work, but will be removed in the future.',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Audience ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Audiences'
                ]
            ],
            'resend_create_contact' => [
                'class' => 'ResendCreateContact',
                'method' => 'POST',
                'path' => '/contacts',
                'operation_id' => '',
                'name' => 'Create a new contact',
                'description' => 'Create a new contact',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Contacts'
                ]
            ],
            'resend_list_contacts' => [
                'class' => 'ResendListContacts',
                'method' => 'GET',
                'path' => '/contacts',
                'operation_id' => '',
                'name' => 'Retrieve a list of contacts',
                'description' => 'Retrieve a list of contacts',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'segment_id',
                        'argument_name' => 'segment_id',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter contacts by segment ID.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items after this cursor.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items before this cursor.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Contacts'
                ]
            ],
            'resend_get_contacts' => [
                'class' => 'ResendGetContacts',
                'method' => 'GET',
                'path' => '/contacts/{id}',
                'operation_id' => '',
                'name' => 'Retrieve a single contact by ID or email',
                'description' => 'Retrieve a single contact by ID or email',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Contact ID or email address.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Contacts'
                ]
            ],
            'resend_update_contacts' => [
                'class' => 'ResendUpdateContacts',
                'method' => 'PATCH',
                'path' => '/contacts/{id}',
                'operation_id' => '',
                'name' => 'Update a single contact by ID or email',
                'description' => 'Update a single contact by ID or email',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Contact ID or email address.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Contacts'
                ]
            ],
            'resend_delete_contacts' => [
                'class' => 'ResendDeleteContacts',
                'method' => 'DELETE',
                'path' => '/contacts/{id}',
                'operation_id' => '',
                'name' => 'Remove an existing contact by ID or email',
                'description' => 'Remove an existing contact by ID or email',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Contact ID or email address.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Contacts'
                ]
            ],
            'resend_create_broadcasts' => [
                'class' => 'ResendCreateBroadcasts',
                'method' => 'POST',
                'path' => '/broadcasts',
                'operation_id' => '',
                'name' => 'Create a broadcast',
                'description' => 'Create a broadcast',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Broadcasts'
                ]
            ],
            'resend_list_broadcasts' => [
                'class' => 'ResendListBroadcasts',
                'method' => 'GET',
                'path' => '/broadcasts',
                'operation_id' => '',
                'name' => 'Retrieve a list of broadcasts',
                'description' => 'Retrieve a list of broadcasts',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items after this cursor.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items before this cursor.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Broadcasts'
                ]
            ],
            'resend_delete_broadcasts' => [
                'class' => 'ResendDeleteBroadcasts',
                'method' => 'DELETE',
                'path' => '/broadcasts/{id}',
                'operation_id' => '',
                'name' => 'Remove an existing broadcast that is in the draft status',
                'description' => 'Remove an existing broadcast that is in the draft status',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Broadcast ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Broadcasts'
                ]
            ],
            'resend_get_broadcasts' => [
                'class' => 'ResendGetBroadcasts',
                'method' => 'GET',
                'path' => '/broadcasts/{id}',
                'operation_id' => '',
                'name' => 'Retrieve a single broadcast',
                'description' => 'Retrieve a single broadcast',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Broadcast ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Broadcasts'
                ]
            ],
            'resend_update_broadcasts' => [
                'class' => 'ResendUpdateBroadcasts',
                'method' => 'PATCH',
                'path' => '/broadcasts/{id}',
                'operation_id' => '',
                'name' => 'Update an existing broadcast',
                'description' => 'Update an existing broadcast',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Broadcast ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Broadcasts'
                ]
            ],
            'resend_send_broadcasts' => [
                'class' => 'ResendSendBroadcasts',
                'method' => 'POST',
                'path' => '/broadcasts/{id}/send',
                'operation_id' => '',
                'name' => 'Send or schedule a broadcast',
                'description' => 'Send or schedule a broadcast',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Broadcast ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Broadcasts'
                ]
            ],
            'resend_create_webhooks' => [
                'class' => 'ResendCreateWebhooks',
                'method' => 'POST',
                'path' => '/webhooks',
                'operation_id' => '',
                'name' => 'Create a new webhook',
                'description' => 'Create a new webhook',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Webhooks'
                ]
            ],
            'resend_list_webhooks' => [
                'class' => 'ResendListWebhooks',
                'method' => 'GET',
                'path' => '/webhooks',
                'operation_id' => '',
                'name' => 'Retrieve a list of webhooks',
                'description' => 'Retrieve a list of webhooks',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Maximum number of webhooks to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination cursor to fetch results after this webhook ID. Cannot be used with \'before\'.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Pagination cursor to fetch results before this webhook ID. Cannot be used with \'after\'.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Webhooks'
                ]
            ],
            'resend_get_webhooks' => [
                'class' => 'ResendGetWebhooks',
                'method' => 'GET',
                'path' => '/webhooks/{webhook_id}',
                'operation_id' => '',
                'name' => 'Retrieve a single webhook',
                'description' => 'Retrieve a single webhook',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'webhook_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Webhook ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'webhook_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Webhooks'
                ]
            ],
            'resend_update_webhooks' => [
                'class' => 'ResendUpdateWebhooks',
                'method' => 'PATCH',
                'path' => '/webhooks/{webhook_id}',
                'operation_id' => '',
                'name' => 'Update an existing webhook',
                'description' => 'Update an existing webhook',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'webhook_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Webhook ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'webhook_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Webhooks'
                ]
            ],
            'resend_delete_webhooks' => [
                'class' => 'ResendDeleteWebhooks',
                'method' => 'DELETE',
                'path' => '/webhooks/{webhook_id}',
                'operation_id' => '',
                'name' => 'Remove an existing webhook',
                'description' => 'Remove an existing webhook',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'webhook_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Webhook ID.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'webhook_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Webhooks'
                ]
            ],
            'resend_create_segments' => [
                'class' => 'ResendCreateSegments',
                'method' => 'POST',
                'path' => '/segments',
                'operation_id' => '',
                'name' => 'Create a new segment',
                'description' => 'Create a new segment',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Segments'
                ]
            ],
            'resend_list_segments' => [
                'class' => 'ResendListSegments',
                'method' => 'GET',
                'path' => '/segments',
                'operation_id' => '',
                'name' => 'Retrieve a list of segments',
                'description' => 'Retrieve a list of segments',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items after this cursor.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items before this cursor.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Segments'
                ]
            ],
            'resend_get_segments' => [
                'class' => 'ResendGetSegments',
                'method' => 'GET',
                'path' => '/segments/{id}',
                'operation_id' => '',
                'name' => 'Retrieve a single segment',
                'description' => 'Retrieve a single segment',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Segment ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Segments'
                ]
            ],
            'resend_delete_segments' => [
                'class' => 'ResendDeleteSegments',
                'method' => 'DELETE',
                'path' => '/segments/{id}',
                'operation_id' => '',
                'name' => 'Remove an existing segment',
                'description' => 'Remove an existing segment',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Segment ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Segments'
                ]
            ],
            'resend_create_topics' => [
                'class' => 'ResendCreateTopics',
                'method' => 'POST',
                'path' => '/topics',
                'operation_id' => '',
                'name' => 'Create a new topic',
                'description' => 'Create a new topic',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Topics'
                ]
            ],
            'resend_list_topics' => [
                'class' => 'ResendListTopics',
                'method' => 'GET',
                'path' => '/topics',
                'operation_id' => '',
                'name' => 'Retrieve a list of topics',
                'description' => 'Retrieve a list of topics',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items after this cursor.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items before this cursor.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Topics'
                ]
            ],
            'resend_get_topics' => [
                'class' => 'ResendGetTopics',
                'method' => 'GET',
                'path' => '/topics/{id}',
                'operation_id' => '',
                'name' => 'Retrieve a single topic',
                'description' => 'Retrieve a single topic',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Topic ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Topics'
                ]
            ],
            'resend_update_topics' => [
                'class' => 'ResendUpdateTopics',
                'method' => 'PATCH',
                'path' => '/topics/{id}',
                'operation_id' => '',
                'name' => 'Update an existing topic',
                'description' => 'Update an existing topic',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Topic ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Topics'
                ]
            ],
            'resend_delete_topics' => [
                'class' => 'ResendDeleteTopics',
                'method' => 'DELETE',
                'path' => '/topics/{id}',
                'operation_id' => '',
                'name' => 'Remove an existing topic',
                'description' => 'Remove an existing topic',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Topic ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Topics'
                ]
            ],
            'resend_create_contact_properties' => [
                'class' => 'ResendCreateContactProperties',
                'method' => 'POST',
                'path' => '/contact-properties',
                'operation_id' => '',
                'name' => 'Create a new contact property',
                'description' => 'Create a new contact property',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Contact Properties'
                ]
            ],
            'resend_list_contact_properties' => [
                'class' => 'ResendListContactProperties',
                'method' => 'GET',
                'path' => '/contact-properties',
                'operation_id' => '',
                'name' => 'Retrieve a list of contact properties',
                'description' => 'Retrieve a list of contact properties',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items after this cursor.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items before this cursor.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Contact Properties'
                ]
            ],
            'resend_get_contact_properties' => [
                'class' => 'ResendGetContactProperties',
                'method' => 'GET',
                'path' => '/contact-properties/{id}',
                'operation_id' => '',
                'name' => 'Retrieve a single contact property',
                'description' => 'Retrieve a single contact property',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Contact Property ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Contact Properties'
                ]
            ],
            'resend_update_contact_properties' => [
                'class' => 'ResendUpdateContactProperties',
                'method' => 'PATCH',
                'path' => '/contact-properties/{id}',
                'operation_id' => '',
                'name' => 'Update an existing contact property',
                'description' => 'Update an existing contact property',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Contact Property ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Contact Properties'
                ]
            ],
            'resend_delete_contact_properties' => [
                'class' => 'ResendDeleteContactProperties',
                'method' => 'DELETE',
                'path' => '/contact-properties/{id}',
                'operation_id' => '',
                'name' => 'Remove an existing contact property',
                'description' => 'Remove an existing contact property',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Contact Property ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Contact Properties'
                ]
            ],
            'resend_list_segments_contacts_contact_id_segments' => [
                'class' => 'ResendListSegmentsContactsContactIdSegments',
                'method' => 'GET',
                'path' => '/contacts/{contact_id}/segments',
                'operation_id' => '',
                'name' => 'Retrieve a list of segments for a contact',
                'description' => 'Retrieve a list of segments for a contact',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'contact_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Contact ID or email address.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'contact_id'
                        ]
                    ],
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items after this cursor.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items before this cursor.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Contacts'
                ]
            ],
            'resend_create_segments_contact_id_segments_segment_id' => [
                'class' => 'ResendCreateSegmentsContactIdSegmentsSegmentId',
                'method' => 'POST',
                'path' => '/contacts/{contact_id}/segments/{segment_id}',
                'operation_id' => '',
                'name' => 'Add a contact to a segment',
                'description' => 'Add a contact to a segment',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'contact_id',
                        'argument_name' => 'contact_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Contact ID or email address.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'segment_id',
                        'argument_name' => 'segment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Segment ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Contacts'
                ]
            ],
            'resend_delete_segments_contact_id_segments_segment_id' => [
                'class' => 'ResendDeleteSegmentsContactIdSegmentsSegmentId',
                'method' => 'DELETE',
                'path' => '/contacts/{contact_id}/segments/{segment_id}',
                'operation_id' => '',
                'name' => 'Remove a contact from a segment',
                'description' => 'Remove a contact from a segment',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'contact_id',
                        'argument_name' => 'contact_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Contact ID or email address.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'segment_id',
                        'argument_name' => 'segment_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Segment ID.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Contacts'
                ]
            ],
            'resend_get_topics_contacts_contact_id_topics' => [
                'class' => 'ResendGetTopicsContactsContactIdTopics',
                'method' => 'GET',
                'path' => '/contacts/{contact_id}/topics',
                'operation_id' => '',
                'name' => 'Retrieve topics for a contact',
                'description' => 'Retrieve topics for a contact',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'contact_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Contact ID or email address.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'contact_id'
                        ]
                    ],
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items after this cursor.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items before this cursor.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Contacts'
                ]
            ],
            'resend_update_topics_contacts_contact_id_topics' => [
                'class' => 'ResendUpdateTopicsContactsContactIdTopics',
                'method' => 'PATCH',
                'path' => '/contacts/{contact_id}/topics',
                'operation_id' => '',
                'name' => 'Update topics for a contact',
                'description' => 'Update topics for a contact',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'contact_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The Contact ID or email address.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'contact_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Contacts'
                ]
            ],
            'resend_list_logs' => [
                'class' => 'ResendListLogs',
                'method' => 'GET',
                'path' => '/logs',
                'operation_id' => '',
                'name' => 'Retrieve a list of logs',
                'description' => 'Retrieve a list of logs',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items after this cursor.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items before this cursor.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Logs'
                ]
            ],
            'resend_get_logs' => [
                'class' => 'ResendGetLogs',
                'method' => 'GET',
                'path' => '/logs/{log_id}',
                'operation_id' => '',
                'name' => 'Retrieve a single log',
                'description' => 'Retrieve a single log',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'log_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the log.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'log_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Logs'
                ]
            ],
            'resend_create_automations' => [
                'class' => 'ResendCreateAutomations',
                'method' => 'POST',
                'path' => '/automations',
                'operation_id' => '',
                'name' => 'Create an automation',
                'description' => 'Create an automation',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Automations'
                ]
            ],
            'resend_list_automations' => [
                'class' => 'ResendListAutomations',
                'method' => 'GET',
                'path' => '/automations',
                'operation_id' => '',
                'name' => 'Retrieve a list of automations',
                'description' => 'Retrieve a list of automations',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'status',
                        'argument_name' => 'status',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter automations by status.',
                        'schema_type' => 'string',
                        'enum' => [
                            'enabled',
                            'disabled'
                        ]
                    ],
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items after this cursor.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items before this cursor.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Automations'
                ]
            ],
            'resend_get_automations' => [
                'class' => 'ResendGetAutomations',
                'method' => 'GET',
                'path' => '/automations/{automation_id}',
                'operation_id' => '',
                'name' => 'Retrieve a single automation',
                'description' => 'Retrieve a single automation',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'automation_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the automation.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'automation_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Automations'
                ]
            ],
            'resend_update_automations' => [
                'class' => 'ResendUpdateAutomations',
                'method' => 'PATCH',
                'path' => '/automations/{automation_id}',
                'operation_id' => '',
                'name' => 'Update an automation',
                'description' => 'Update an automation',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'automation_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the automation.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'automation_id'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Automations'
                ]
            ],
            'resend_delete_automations' => [
                'class' => 'ResendDeleteAutomations',
                'method' => 'DELETE',
                'path' => '/automations/{automation_id}',
                'operation_id' => '',
                'name' => 'Delete an automation',
                'description' => 'Delete an automation',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'automation_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the automation.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'automation_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Automations'
                ]
            ],
            'resend_stop_automations' => [
                'class' => 'ResendStopAutomations',
                'method' => 'POST',
                'path' => '/automations/{automation_id}/stop',
                'operation_id' => '',
                'name' => 'Stop an automation',
                'description' => 'Stop an automation',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'automation_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the automation.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'automation_id'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Automations'
                ]
            ],
            'resend_list_runs' => [
                'class' => 'ResendListRuns',
                'method' => 'GET',
                'path' => '/automations/{automation_id}/runs',
                'operation_id' => '',
                'name' => 'Retrieve a list of automation runs',
                'description' => 'Retrieve a list of automation runs',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'automation_id',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the automation.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'automation_id'
                        ]
                    ],
                    [
                        'name' => 'status',
                        'argument_name' => 'status',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Filter runs by status. Comma-separated list of: running, completed, failed, cancelled.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items after this cursor.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items before this cursor.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Automations'
                ]
            ],
            'resend_get_runs' => [
                'class' => 'ResendGetRuns',
                'method' => 'GET',
                'path' => '/automations/{automation_id}/runs/{run_id}',
                'operation_id' => '',
                'name' => 'Retrieve a single automation run',
                'description' => 'Retrieve a single automation run',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'automation_id',
                        'argument_name' => 'automation_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the automation.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'run_id',
                        'argument_name' => 'run_id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The ID of the automation run.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Automations'
                ]
            ],
            'resend_create_events' => [
                'class' => 'ResendCreateEvents',
                'method' => 'POST',
                'path' => '/events',
                'operation_id' => '',
                'name' => 'Create an event',
                'description' => 'Create an event',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Events'
                ]
            ],
            'resend_list_events' => [
                'class' => 'ResendListEvents',
                'method' => 'GET',
                'path' => '/events',
                'operation_id' => '',
                'name' => 'Retrieve a list of events',
                'description' => 'Retrieve a list of events',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'limit',
                        'argument_name' => 'limit',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Number of items to return.',
                        'schema_type' => 'number'
                    ],
                    [
                        'name' => 'after',
                        'argument_name' => 'after',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items after this cursor.',
                        'schema_type' => 'string'
                    ],
                    [
                        'name' => 'before',
                        'argument_name' => 'before',
                        'in' => 'query',
                        'required' => false,
                        'description' => 'Return items before this cursor.',
                        'schema_type' => 'string'
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Events'
                ]
            ],
            'resend_send_events' => [
                'class' => 'ResendSendEvents',
                'method' => 'POST',
                'path' => '/events/send',
                'operation_id' => '',
                'name' => 'Send an event',
                'description' => 'Send an event',
                'type' => 'write',
                'parameters' => [],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Events'
                ]
            ],
            'resend_get_events' => [
                'class' => 'ResendGetEvents',
                'method' => 'GET',
                'path' => '/events/{identifier}',
                'operation_id' => '',
                'name' => 'Retrieve a single event',
                'description' => 'Retrieve a single event',
                'type' => 'read',
                'parameters' => [
                    [
                        'name' => 'identifier',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The event ID UUID or event name.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'identifier'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Events'
                ]
            ],
            'resend_update_events' => [
                'class' => 'ResendUpdateEvents',
                'method' => 'PATCH',
                'path' => '/events/{identifier}',
                'operation_id' => '',
                'name' => 'Update an event',
                'description' => 'Update an event',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'identifier',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The event ID UUID or event name.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'identifier'
                        ]
                    ]
                ],
                'request_body' => [
                    'required' => false,
                    'description' => 'Request body for the Resend API operation.',
                    'schema_type' => 'object'
                ],
                'tags' => [
                    'Events'
                ]
            ],
            'resend_delete_events' => [
                'class' => 'ResendDeleteEvents',
                'method' => 'DELETE',
                'path' => '/events/{identifier}',
                'operation_id' => '',
                'name' => 'Delete an event',
                'description' => 'Delete an event',
                'type' => 'write',
                'parameters' => [
                    [
                        'name' => 'identifier',
                        'argument_name' => 'id',
                        'in' => 'path',
                        'required' => true,
                        'description' => 'The event ID UUID or event name.',
                        'schema_type' => 'string',
                        'aliases' => [
                            'identifier'
                        ]
                    ]
                ],
                'request_body' => null,
                'tags' => [
                    'Events'
                ]
            ]
        ];
    }
}
