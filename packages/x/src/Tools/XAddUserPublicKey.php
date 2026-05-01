<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Add public key
 */
class XAddUserPublicKey extends XGeneratedTool
{
    protected const SLUG = 'x_add_user_public_key';

    protected const DESCRIPTION = 'Add public key';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the requesting user.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
            'properties' => [
                'generate_version' => [
                    'type' => 'boolean',
                    'description' => 'When true, the server generates a new version.',
                    'required' => false,
                ],
                'public_key' => [
                    'type' => 'object',
                    'description' => 'Public key registration payload.',
                    'properties' => [
                        'identity_public_key_signature' => [
                            'type' => 'string',
                            'description' => 'Signature over the identity public key.',
                            'required' => false,
                        ],
                        'public_key' => [
                            'type' => 'string',
                            'description' => 'Identity public key (base64 encoded).',
                            'required' => false,
                        ],
                        'public_key_fingerprint' => [
                            'type' => 'string',
                            'description' => 'Fingerprint of the identity public key.',
                            'required' => false,
                        ],
                        'registration_method' => [
                            'type' => 'string',
                            'description' => 'Registration method for the public key.',
                            'required' => false,
                        ],
                        'signing_public_key' => [
                            'type' => 'string',
                            'description' => 'Signing public key (base64 encoded).',
                            'required' => false,
                        ],
                        'signing_public_key_signature' => [
                            'type' => 'string',
                            'description' => 'Signature over the signing public key.',
                            'required' => false,
                        ],
                    ],
                    'required' => true,
                ],
                'version' => [
                    'type' => 'string',
                    'description' => 'Public key version.',
                    'required' => true,
                ],
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'addUserPublicKey',
        'method' => 'POST',
        'path' => '/2/users/{id}/public_keys',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
        ],
        'has_body' => true,
        'body_mode' => 'json',
        'auth_modes' => [
            'oauth2_pkce',
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'dm.write',
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Chat',
        ],
    ];
}
