<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Tax Settings accounts/:account_id/tax_settings.
 */
class XAdsPutAccountsAccountIdTaxSettings extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_put_accounts_account_id_tax_settings';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Tax Settings accounts/:account_id/tax_settings.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'address_city' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'address_country' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'address_email' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'address_first_name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'address_last_name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'address_name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'address_postal_code' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'address_region' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'address_street1' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'address_street2' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'bill_to' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'business_relationship' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'client_address_city' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'client_address_country' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'client_address_email' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'client_address_first_name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'client_address_last_name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'client_address_name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'client_address_postal_code' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'client_address_region' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'client_address_street1' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'client_address_street2' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'invoice_jurisdiction' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'tax_category' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'tax_exemption_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'tax_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'put_accounts_account_id_tax_settings',
        'method' => 'PUT',
        'path' => '/{version}/accounts/{account_id}/tax_settings',
        'parameters' => [
            [
                'name' => 'version',
                'in' => 'path',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'account_id',
                'in' => 'path',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'address_city',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'address_country',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'address_email',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'address_first_name',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'address_last_name',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'address_name',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'address_postal_code',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'address_region',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'address_street1',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'address_street2',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'bill_to',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'business_relationship',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'client_address_city',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'client_address_country',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'client_address_email',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'client_address_first_name',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'client_address_last_name',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'client_address_name',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'client_address_postal_code',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'client_address_region',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'client_address_street1',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'client_address_street2',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'invoice_jurisdiction',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'tax_category',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'tax_exemption_id',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'tax_id',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
        ],
        'has_body' => false,
        'body_mode' => 'form',
        'auth_modes' => [
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'ads_api_access',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Campaign Management',
            'Tax Settings',
        ],
    ];
}
