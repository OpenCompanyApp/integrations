<?php

namespace OpenCompany\Integrations\Avalara;

/**
 * Official Avalara AvaTax REST API operation metadata.
 *
 * Source: https://rest.avatax.com/swagger/v2/swagger.json (AvaTax API v2).
 */
class AvalaraOperations
{
    /**
     * Return all supported AvaTax REST API operations.
     *
     * @return list<array<string, mixed>>
     */
    public static function all(): array
    {
        return [
  0 =>
  [
    'operation' => 'CreateAPConfigSetting',
    'slug' => 'avalara_create_ap_config_setting',
    'class' => 'AvalaraCreateAPConfigSetting',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyid}/apconfigsetting',
    'name' => 'Create new rule',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateAPConfigSetting`.

Endpoint: POST /api/v2/companies/{companyid}/apconfigsetting.',
    'type' => 'write',
    'tag' => 'APConfigSetting',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyid',
        'param' => 'companyid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this AP Config Setting object',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'The AP Config Setting you wish to create.',
      ],
    ],
  ],
  1 =>
  [
    'operation' => 'GetAPConfigSettingByCompany',
    'slug' => 'avalara_get_ap_config_setting_by_company',
    'class' => 'AvalaraGetAPConfigSettingByCompany',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyid}/apconfigsetting',
    'name' => 'Retrieve rule for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetAPConfigSettingByCompany`.

Endpoint: GET /api/v2/companies/{companyid}/apconfigsetting.',
    'type' => 'read',
    'tag' => 'APConfigSetting',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyid',
        'param' => 'companyid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that defined this rule',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* meta, amount, amountToMarkForReview, ignoreThresholdWhenVCTZero, varianceForIgnore, varianceForAccrue, variancePercent, apConfigToleranceType, payAsBilledNoAccrual, payAsBilledAccrueUndercharge, shortPayItemsAccrueUndercharge, markForReviewUndercharge, rejectUndercharge, payAsBilledOvercharge, shortPayAvalaraCalculated, shortPayItemsAccrueOvercharge, markForReviewOvercharge, rejectOvercharge, isActive',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  2 =>
  [
    'operation' => 'QueryAPConfigSetting',
    'slug' => 'avalara_query_ap_config_setting',
    'class' => 'AvalaraQueryAPConfigSetting',
    'method' => 'GET',
    'path' => '/api/v2/apconfigsetting',
    'name' => 'Retrieve all rules',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryAPConfigSetting`.

Endpoint: GET /api/v2/apconfigsetting.',
    'type' => 'read',
    'tag' => 'APConfigSetting',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* meta, amount, amountToMarkForReview, ignoreThresholdWhenVCTZero, varianceForIgnore, varianceForAccrue, variancePercent, apConfigToleranceType, payAsBilledNoAccrual, payAsBilledAccrueUndercharge, shortPayItemsAccrueUndercharge, markForReviewUndercharge, rejectUndercharge, payAsBilledOvercharge, shortPayAvalaraCalculated, shortPayItemsAccrueOvercharge, markForReviewOvercharge, rejectOvercharge, isActive',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  3 =>
  [
    'operation' => 'UpdateAPConfigSetting',
    'slug' => 'avalara_update_ap_config_setting',
    'class' => 'AvalaraUpdateAPConfigSetting',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyid}/apconfigsetting',
    'name' => 'Update a AP config setting',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateAPConfigSetting`.

Endpoint: PUT /api/v2/companies/{companyid}/apconfigsetting.',
    'type' => 'write',
    'tag' => 'APConfigSetting',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyid',
        'param' => 'companyid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this AP config setting object',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'The AP config setting object you wish to update.',
      ],
    ],
  ],
  4 =>
  [
    'operation' => 'AccountResetLicenseKey',
    'slug' => 'avalara_account_reset_license_key',
    'class' => 'AvalaraAccountResetLicenseKey',
    'method' => 'POST',
    'path' => '/api/v2/accounts/{id}/resetlicensekey',
    'name' => 'Reset this account\'s license key',
    'description' => 'Execute official Avalara AvaTax REST API operation `AccountResetLicenseKey`.

Endpoint: POST /api/v2/accounts/{id}/resetlicensekey.',
    'type' => 'write',
    'tag' => 'Accounts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account you wish to update.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'A request confirming that you wish to reset the license key of this account.',
      ],
    ],
  ],
  5 =>
  [
    'operation' => 'ActivateAccount',
    'slug' => 'avalara_activate_account',
    'class' => 'AvalaraActivateAccount',
    'method' => 'POST',
    'path' => '/api/v2/accounts/{id}/activate',
    'name' => 'Activate an account by accepting terms and conditions',
    'description' => 'Execute official Avalara AvaTax REST API operation `ActivateAccount`.

Endpoint: POST /api/v2/accounts/{id}/activate.',
    'type' => 'write',
    'tag' => 'Accounts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account to activate',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The activation request',
      ],
    ],
  ],
  6 =>
  [
    'operation' => 'AuditAccount',
    'slug' => 'avalara_audit_account',
    'class' => 'AvalaraAuditAccount',
    'method' => 'GET',
    'path' => '/api/v2/accounts/{id}/audit',
    'name' => 'Retrieve audit history for an account.',
    'description' => 'Execute official Avalara AvaTax REST API operation `AuditAccount`.

Endpoint: GET /api/v2/accounts/{id}/audit.',
    'type' => 'read',
    'tag' => 'Accounts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account you wish to audit.',
      ],
      1 =>
      [
        'name' => 'start',
        'param' => 'start',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The start datetime of audit history you with to retrieve, e.g. "2018-06-08T17:00:00Z". Defaults to the past 15 minutes.',
      ],
      2 =>
      [
        'name' => 'end',
        'param' => 'end',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The end datetime of audit history you with to retrieve, e.g. "2018-06-08T17:15:00Z. Defaults to the current time. Maximum of an hour after the start time.',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
    ],
  ],
  7 =>
  [
    'operation' => 'CreateLicenseKey',
    'slug' => 'avalara_create_license_key',
    'class' => 'AvalaraCreateLicenseKey',
    'method' => 'POST',
    'path' => '/api/v2/accounts/{id}/licensekey',
    'name' => 'Create license key for this account',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateLicenseKey`.

Endpoint: POST /api/v2/accounts/{id}/licensekey.',
    'type' => 'write',
    'tag' => 'Accounts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account you wish to update.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  8 =>
  [
    'operation' => 'DeleteLicenseKey',
    'slug' => 'avalara_delete_license_key',
    'class' => 'AvalaraDeleteLicenseKey',
    'method' => 'DELETE',
    'path' => '/api/v2/accounts/{id}/licensekey/{licensekeyname}',
    'name' => 'Delete license key for this account by license key name',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteLicenseKey`.

Endpoint: DELETE /api/v2/accounts/{id}/licensekey/{licensekeyname}.',
    'type' => 'write',
    'tag' => 'Accounts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account you wish to update.',
      ],
      1 =>
      [
        'name' => 'licensekeyname',
        'param' => 'licensekeyname',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The license key name you wish to update.',
      ],
    ],
  ],
  9 =>
  [
    'operation' => 'GetAccount',
    'slug' => 'avalara_get_account',
    'class' => 'AvalaraGetAccount',
    'method' => 'GET',
    'path' => '/api/v2/accounts/{id}',
    'name' => 'Retrieve a single account',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetAccount`.

Endpoint: GET /api/v2/accounts/{id}.',
    'type' => 'read',
    'tag' => 'Accounts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account to retrieve',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of special fetch options',
      ],
    ],
  ],
  10 =>
  [
    'operation' => 'GetAccountConfiguration',
    'slug' => 'avalara_get_account_configuration',
    'class' => 'AvalaraGetAccountConfiguration',
    'method' => 'GET',
    'path' => '/api/v2/accounts/{id}/configuration',
    'name' => 'Get configuration settings for this account',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetAccountConfiguration`.

Endpoint: GET /api/v2/accounts/{id}/configuration.',
    'type' => 'read',
    'tag' => 'Accounts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'Avalara path parameter id.',
      ],
    ],
  ],
  11 =>
  [
    'operation' => 'GetLicenseKey',
    'slug' => 'avalara_get_license_key',
    'class' => 'AvalaraGetLicenseKey',
    'method' => 'GET',
    'path' => '/api/v2/accounts/{id}/licensekey/{licensekeyname}',
    'name' => 'Retrieve license key by license key name',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetLicenseKey`.

Endpoint: GET /api/v2/accounts/{id}/licensekey/{licensekeyname}.',
    'type' => 'read',
    'tag' => 'Accounts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account to retrieve',
      ],
      1 =>
      [
        'name' => 'licensekeyname',
        'param' => 'licensekeyname',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The license key name to be retrieved',
      ],
    ],
  ],
  12 =>
  [
    'operation' => 'GetLicenseKeys',
    'slug' => 'avalara_get_license_keys',
    'class' => 'AvalaraGetLicenseKeys',
    'method' => 'GET',
    'path' => '/api/v2/accounts/{id}/licensekeys',
    'name' => 'Retrieve all license keys for this account',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetLicenseKeys`.

Endpoint: GET /api/v2/accounts/{id}/licensekeys.',
    'type' => 'read',
    'tag' => 'Accounts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account to retrieve',
      ],
    ],
  ],
  13 =>
  [
    'operation' => 'ListMrsAccounts',
    'slug' => 'avalara_list_mrs_accounts',
    'class' => 'AvalaraListMrsAccounts',
    'method' => 'GET',
    'path' => '/api/v2/accounts/mrs',
    'name' => 'Retrieve a list of MRS Accounts',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListMrsAccounts`.

Endpoint: GET /api/v2/accounts/mrs.',
    'type' => 'read',
    'tag' => 'Accounts',
    'parameters' =>
    [
    ],
  ],
  14 =>
  [
    'operation' => 'QueryAccounts',
    'slug' => 'avalara_query_accounts',
    'class' => 'AvalaraQueryAccounts',
    'method' => 'GET',
    'path' => '/api/v2/accounts',
    'name' => 'Retrieve all accounts',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryAccounts`.

Endpoint: GET /api/v2/accounts.',
    'type' => 'read',
    'tag' => 'Accounts',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of objects to fetch underneath this account. Any object with a URL path underneath this account can be fetched by specifying its name.',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* subscriptions, users',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  15 =>
  [
    'operation' => 'SetAccountConfiguration',
    'slug' => 'avalara_set_account_configuration',
    'class' => 'AvalaraSetAccountConfiguration',
    'method' => 'POST',
    'path' => '/api/v2/accounts/{id}/configuration',
    'name' => 'Change configuration settings for this account',
    'description' => 'Execute official Avalara AvaTax REST API operation `SetAccountConfiguration`.

Endpoint: POST /api/v2/accounts/{id}/configuration.',
    'type' => 'write',
    'tag' => 'Accounts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'Avalara path parameter id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'Avalara body parameter body.',
      ],
    ],
  ],
  16 =>
  [
    'operation' => 'ResolveAddress',
    'slug' => 'avalara_resolve_address',
    'class' => 'AvalaraResolveAddress',
    'method' => 'GET',
    'path' => '/api/v2/addresses/resolve',
    'name' => 'Retrieve geolocation information for a specified US or Canadian address',
    'description' => 'Execute official Avalara AvaTax REST API operation `ResolveAddress`.

Endpoint: GET /api/v2/addresses/resolve.',
    'type' => 'read',
    'tag' => 'Addresses',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'line1',
        'param' => 'line1',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Line 1',
      ],
      1 =>
      [
        'name' => 'line2',
        'param' => 'line2',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Line 2',
      ],
      2 =>
      [
        'name' => 'line3',
        'param' => 'line3',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Line 3',
      ],
      3 =>
      [
        'name' => 'city',
        'param' => 'city',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'City',
      ],
      4 =>
      [
        'name' => 'region',
        'param' => 'region',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'State / Province / Region',
      ],
      5 =>
      [
        'name' => 'postalCode',
        'param' => 'postal_code',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Postal Code / Zip Code',
      ],
      6 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Two character ISO 3166 Country Code (see /api/v2/definitions/countries for a full list]',
      ],
      7 =>
      [
        'name' => 'textCase',
        'param' => 'text_case',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'selectable text case for address validation',
      ],
    ],
  ],
  17 =>
  [
    'operation' => 'ResolveAddressPost',
    'slug' => 'avalara_resolve_address_post',
    'class' => 'AvalaraResolveAddressPost',
    'method' => 'POST',
    'path' => '/api/v2/addresses/resolve',
    'name' => 'Retrieve geolocation information for a specified US or Canadian address',
    'description' => 'Execute official Avalara AvaTax REST API operation `ResolveAddressPost`.

Endpoint: POST /api/v2/addresses/resolve.',
    'type' => 'write',
    'tag' => 'Addresses',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The address to resolve',
      ],
    ],
  ],
  18 =>
  [
    'operation' => 'CreateAvaFileForms',
    'slug' => 'avalara_create_ava_file_forms',
    'class' => 'AvalaraCreateAvaFileForms',
    'method' => 'POST',
    'path' => '/api/v2/avafileforms',
    'name' => 'Create a new AvaFileForm',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateAvaFileForms`.

Endpoint: POST /api/v2/avafileforms.',
    'type' => 'write',
    'tag' => 'AvaFileForms',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The AvaFileForm you wish to create.',
      ],
    ],
  ],
  19 =>
  [
    'operation' => 'DeleteAvaFileForm',
    'slug' => 'avalara_delete_ava_file_form',
    'class' => 'AvalaraDeleteAvaFileForm',
    'method' => 'DELETE',
    'path' => '/api/v2/avafileforms/{id}',
    'name' => 'Delete a single AvaFileForm',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteAvaFileForm`.

Endpoint: DELETE /api/v2/avafileforms/{id}.',
    'type' => 'write',
    'tag' => 'AvaFileForms',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the AvaFileForm you wish to delete.',
      ],
    ],
  ],
  20 =>
  [
    'operation' => 'GetAvaFileForm',
    'slug' => 'avalara_get_ava_file_form',
    'class' => 'AvalaraGetAvaFileForm',
    'method' => 'GET',
    'path' => '/api/v2/avafileforms/{id}',
    'name' => 'Retrieve a single AvaFileForm',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetAvaFileForm`.

Endpoint: GET /api/v2/avafileforms/{id}.',
    'type' => 'read',
    'tag' => 'AvaFileForms',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this AvaFileForm',
      ],
    ],
  ],
  21 =>
  [
    'operation' => 'QueryAvaFileForms',
    'slug' => 'avalara_query_ava_file_forms',
    'class' => 'AvalaraQueryAvaFileForms',
    'method' => 'GET',
    'path' => '/api/v2/avafileforms',
    'name' => 'Retrieve all AvaFileForms',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryAvaFileForms`.

Endpoint: GET /api/v2/avafileforms.',
    'type' => 'read',
    'tag' => 'AvaFileForms',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* outletTypeId',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  22 =>
  [
    'operation' => 'UpdateAvaFileForm',
    'slug' => 'avalara_update_ava_file_form',
    'class' => 'AvalaraUpdateAvaFileForm',
    'method' => 'PUT',
    'path' => '/api/v2/avafileforms/{id}',
    'name' => 'Update a AvaFileForm',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateAvaFileForm`.

Endpoint: PUT /api/v2/avafileforms/{id}.',
    'type' => 'write',
    'tag' => 'AvaFileForms',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the AvaFileForm you wish to update',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The AvaFileForm model you wish to update.',
      ],
    ],
  ],
  23 =>
  [
    'operation' => 'CancelBatch',
    'slug' => 'avalara_cancel_batch',
    'class' => 'AvalaraCancelBatch',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/batches/{id}/cancel',
    'name' => 'Cancel an in progress batch',
    'description' => 'Execute official Avalara AvaTax REST API operation `CancelBatch`.

Endpoint: POST /api/v2/companies/{companyId}/batches/{id}/cancel.',
    'type' => 'write',
    'tag' => 'Batches',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this batch.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the batch to cancel.',
      ],
    ],
  ],
  24 =>
  [
    'operation' => 'CreateAdvancedRulesBatch',
    'slug' => 'avalara_create_advanced_rules_batch',
    'class' => 'AvalaraCreateAdvancedRulesBatch',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/batches/advancedrules',
    'name' => 'Create a new Advanced Rules batch',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateAdvancedRulesBatch`.

Endpoint: POST /api/v2/companies/{companyId}/batches/advancedrules.',
    'type' => 'write',
    'tag' => 'Batches',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this batch.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The Advanced Rules batch you wish to create.',
      ],
    ],
  ],
  25 =>
  [
    'operation' => 'CreateBatches',
    'slug' => 'avalara_create_batches',
    'class' => 'AvalaraCreateBatches',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/batches',
    'name' => 'Create a new batch',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateBatches`.

Endpoint: POST /api/v2/companies/{companyId}/batches.',
    'type' => 'write',
    'tag' => 'Batches',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this batch.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The batch you wish to create.',
      ],
    ],
  ],
  26 =>
  [
    'operation' => 'CreateItemImportBatch',
    'slug' => 'avalara_create_item_import_batch',
    'class' => 'AvalaraCreateItemImportBatch',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/batches/items',
    'name' => 'Create item import batch.',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateItemImportBatch`.

Endpoint: POST /api/v2/companies/{companyId}/batches/items.',
    'type' => 'write',
    'tag' => 'Batches',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this batch.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The item import batch you wish to create.',
      ],
    ],
  ],
  27 =>
  [
    'operation' => 'CreateTransactionBatch',
    'slug' => 'avalara_create_transaction_batch',
    'class' => 'AvalaraCreateTransactionBatch',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/batches/transactions',
    'name' => 'Create a new transaction batch',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateTransactionBatch`.

Endpoint: POST /api/v2/companies/{companyId}/batches/transactions.',
    'type' => 'write',
    'tag' => 'Batches',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this batch.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The transaction batch you wish to create.',
      ],
    ],
  ],
  28 =>
  [
    'operation' => 'DeleteBatch',
    'slug' => 'avalara_delete_batch',
    'class' => 'AvalaraDeleteBatch',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/batches/{id}',
    'name' => 'Delete a single batch',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteBatch`.

Endpoint: DELETE /api/v2/companies/{companyId}/batches/{id}.',
    'type' => 'write',
    'tag' => 'Batches',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this batch.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the batch to delete.',
      ],
    ],
  ],
  29 =>
  [
    'operation' => 'DownloadBatch',
    'slug' => 'avalara_download_batch',
    'class' => 'AvalaraDownloadBatch',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/batches/{batchId}/files/{id}/attachment',
    'name' => 'Download a single batch file',
    'description' => 'Execute official Avalara AvaTax REST API operation `DownloadBatch`.

Endpoint: GET /api/v2/companies/{companyId}/batches/{batchId}/files/{id}/attachment.',
    'type' => 'read',
    'tag' => 'Batches',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this batch',
      ],
      1 =>
      [
        'name' => 'batchId',
        'param' => 'batch_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the batch object',
      ],
      2 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this batch file object',
      ],
    ],
  ],
  30 =>
  [
    'operation' => 'GetBatch',
    'slug' => 'avalara_get_batch',
    'class' => 'AvalaraGetBatch',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/batches/{id}',
    'name' => 'Retrieve a single batch',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetBatch`.

Endpoint: GET /api/v2/companies/{companyId}/batches/{id}.',
    'type' => 'read',
    'tag' => 'Batches',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this batch',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this batch',
      ],
    ],
  ],
  31 =>
  [
    'operation' => 'ListBatchesByCompany',
    'slug' => 'avalara_list_batches_by_company',
    'class' => 'AvalaraListBatchesByCompany',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/batches',
    'name' => 'Retrieve all batches for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListBatchesByCompany`.

Endpoint: GET /api/v2/companies/{companyId}/batches.',
    'type' => 'read',
    'tag' => 'Batches',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns these batches',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* files',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  32 =>
  [
    'operation' => 'QueryBatches',
    'slug' => 'avalara_query_batches',
    'class' => 'AvalaraQueryBatches',
    'method' => 'GET',
    'path' => '/api/v2/batches',
    'name' => 'Retrieve all batches',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryBatches`.

Endpoint: GET /api/v2/batches.',
    'type' => 'read',
    'tag' => 'Batches',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* files',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  33 =>
  [
    'operation' => 'CreateCertExpressInvitation',
    'slug' => 'avalara_create_cert_express_invitation',
    'class' => 'AvalaraCreateCertExpressInvitation',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/customers/{customerCode}/certexpressinvites',
    'name' => 'Create a CertExpress invitation',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateCertExpressInvitation`.

Endpoint: POST /api/v2/companies/{companyId}/customers/{customerCode}/certexpressinvites.',
    'type' => 'write',
    'tag' => 'CertExpressInvites',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that will record certificates',
      ],
      1 =>
      [
        'name' => 'customerCode',
        'param' => 'customer_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The number of the customer where the request is sent to',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'the requests to send out to customers',
      ],
    ],
  ],
  34 =>
  [
    'operation' => 'GetCertExpressInvitation',
    'slug' => 'avalara_get_cert_express_invitation',
    'class' => 'AvalaraGetCertExpressInvitation',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/customers/{customerCode}/certexpressinvites/{id}',
    'name' => 'Retrieve a single CertExpress invitation',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetCertExpressInvitation`.

Endpoint: GET /api/v2/companies/{companyId}/customers/{customerCode}/certexpressinvites/{id}.',
    'type' => 'read',
    'tag' => 'CertExpressInvites',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that issued this invitation',
      ],
      1 =>
      [
        'name' => 'customerCode',
        'param' => 'customer_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The number of the customer where the request is sent to',
      ],
      2 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of this CertExpress invitation',
      ],
      3 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'OPTIONAL: A comma separated list of special fetch options. No options are defined at this time.',
      ],
    ],
  ],
  35 =>
  [
    'operation' => 'ListCertExpressInvitations',
    'slug' => 'avalara_list_cert_express_invitations',
    'class' => 'AvalaraListCertExpressInvitations',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/certexpressinvites',
    'name' => 'List CertExpress invitations',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCertExpressInvitations`.

Endpoint: GET /api/v2/companies/{companyId}/certexpressinvites.',
    'type' => 'read',
    'tag' => 'CertExpressInvites',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that issued this invitation',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'OPTIONAL: A comma separated list of special fetch options. No options are defined at this time.',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* companyId, customer, coverLetter, exposureZones, exemptReasons, requestLink',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  36 =>
  [
    'operation' => 'CreateCertificates',
    'slug' => 'avalara_create_certificates',
    'class' => 'AvalaraCreateCertificates',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/certificates',
    'name' => 'Create certificates for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateCertificates`.

Endpoint: POST /api/v2/companies/{companyId}/certificates.',
    'type' => 'write',
    'tag' => 'Certificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID number of the company recording this certificate',
      ],
      1 =>
      [
        'name' => '$preValidatedExemptionReason',
        'param' => 'pre_validated_exemption_reason',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If set to true, the certificate will bypass the human verification process.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'Certificates to be created',
      ],
    ],
  ],
  37 =>
  [
    'operation' => 'DeleteCertificate',
    'slug' => 'avalara_delete_certificate',
    'class' => 'AvalaraDeleteCertificate',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/certificates/{id}',
    'name' => 'Revoke and delete a certificate',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteCertificate`.

Endpoint: DELETE /api/v2/companies/{companyId}/certificates/{id}.',
    'type' => 'write',
    'tag' => 'Certificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this certificate',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of this certificate',
      ],
    ],
  ],
  38 =>
  [
    'operation' => 'DeleteCertificateCustomFields',
    'slug' => 'avalara_delete_certificate_custom_fields',
    'class' => 'AvalaraDeleteCertificateCustomFields',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/certificates/{id}/custom-fields',
    'name' => 'Delete Certificate Custom Fields',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteCertificateCustomFields`.

Endpoint: DELETE /api/v2/companies/{companyId}/certificates/{id}/custom-fields.',
    'type' => 'write',
    'tag' => 'Certificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this certificate',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of this certificate',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => false,
        'description' => 'Delete custom fields request model',
      ],
    ],
  ],
  39 =>
  [
    'operation' => 'DownloadCertificateImage',
    'slug' => 'avalara_download_certificate_image',
    'class' => 'AvalaraDownloadCertificateImage',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/certificates/{id}/attachment',
    'name' => 'Download an image for this certificate',
    'description' => 'Execute official Avalara AvaTax REST API operation `DownloadCertificateImage`.

Endpoint: GET /api/v2/companies/{companyId}/certificates/{id}/attachment.',
    'type' => 'read',
    'tag' => 'Certificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this certificate',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of this certificate',
      ],
      2 =>
      [
        'name' => '$page',
        'param' => 'page',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If you choose `$type`=`Jpeg`, you must specify which page number to retrieve.',
      ],
      3 =>
      [
        'name' => '$type',
        'param' => 'type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The data format in which to retrieve the certificate image',
      ],
    ],
  ],
  40 =>
  [
    'operation' => 'GetCertificate',
    'slug' => 'avalara_get_certificate',
    'class' => 'AvalaraGetCertificate',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/certificates/{id}',
    'name' => 'Retrieve a single certificate',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetCertificate`.

Endpoint: GET /api/v2/companies/{companyId}/certificates/{id}.',
    'type' => 'read',
    'tag' => 'Certificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID number of the company that recorded this certificate',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of this certificate',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'OPTIONAL: A comma separated list of special fetch options. You can specify one or more of the following: * customers - Retrieves the list of customers linked to the certificate. * po_numbers - Retrieves all PO numbers tied to the certificate. * attributes - Retrieves all attributes applied to the certificate. * histories - Retrieves the certificate update history * jobs - Retrieves the jobs for this certificate * logs - Retrieves the certificate log * invalid_reasons - Retrieves invalid reasons for this certificate if the certificate is invalid * custom_fields - Retrieves custom fields set for this certificate',
      ],
    ],
  ],
  41 =>
  [
    'operation' => 'GetCertificateSetup',
    'slug' => 'avalara_get_certificate_setup',
    'class' => 'AvalaraGetCertificateSetup',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/certificates/setup',
    'name' => 'Check a company\'s exemption certificate status.',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetCertificateSetup`.

Endpoint: GET /api/v2/companies/{companyId}/certificates/setup.',
    'type' => 'read',
    'tag' => 'Certificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company ID to check',
      ],
    ],
  ],
  42 =>
  [
    'operation' => 'LinkAttributesToCertificate',
    'slug' => 'avalara_link_attributes_to_certificate',
    'class' => 'AvalaraLinkAttributesToCertificate',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/certificates/{id}/attributes/link',
    'name' => 'Link attributes to a certificate',
    'description' => 'Execute official Avalara AvaTax REST API operation `LinkAttributesToCertificate`.

Endpoint: POST /api/v2/companies/{companyId}/certificates/{id}/attributes/link.',
    'type' => 'write',
    'tag' => 'Certificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this certificate',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of this certificate',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The list of attributes to link to this certificate.',
      ],
    ],
  ],
  43 =>
  [
    'operation' => 'LinkCustomersToCertificate',
    'slug' => 'avalara_link_customers_to_certificate',
    'class' => 'AvalaraLinkCustomersToCertificate',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/certificates/{id}/customers/link',
    'name' => 'Link customers to a certificate',
    'description' => 'Execute official Avalara AvaTax REST API operation `LinkCustomersToCertificate`.

Endpoint: POST /api/v2/companies/{companyId}/certificates/{id}/customers/link.',
    'type' => 'write',
    'tag' => 'Certificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this certificate',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of this certificate',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The list of customers needed be added to the Certificate for exemption',
      ],
    ],
  ],
  44 =>
  [
    'operation' => 'ListAttributesForCertificate',
    'slug' => 'avalara_list_attributes_for_certificate',
    'class' => 'AvalaraListAttributesForCertificate',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/certificates/{id}/attributes',
    'name' => 'List all attributes applied to this certificate',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListAttributesForCertificate`.

Endpoint: GET /api/v2/companies/{companyId}/certificates/{id}/attributes.',
    'type' => 'read',
    'tag' => 'Certificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this certificate',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of this certificate',
      ],
    ],
  ],
  45 =>
  [
    'operation' => 'ListCustomFieldsForCertificate',
    'slug' => 'avalara_list_custom_fields_for_certificate',
    'class' => 'AvalaraListCustomFieldsForCertificate',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/certificates/{id}/custom-fields',
    'name' => 'Retrieve Certificate Custom Fields',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCustomFieldsForCertificate`.

Endpoint: GET /api/v2/companies/{companyId}/certificates/{id}/custom-fields.',
    'type' => 'read',
    'tag' => 'Certificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this certificate',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of this certificate',
      ],
    ],
  ],
  46 =>
  [
    'operation' => 'ListCustomersForCertificate',
    'slug' => 'avalara_list_customers_for_certificate',
    'class' => 'AvalaraListCustomersForCertificate',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/certificates/{id}/customers',
    'name' => 'List customers linked to this certificate',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCustomersForCertificate`.

Endpoint: GET /api/v2/companies/{companyId}/certificates/{id}/customers.',
    'type' => 'read',
    'tag' => 'Certificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this certificate',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of this certificate',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'OPTIONAL: A comma separated list of special fetch options. No options are currently available when fetching customers.',
      ],
    ],
  ],
  47 =>
  [
    'operation' => 'QueryCertificates',
    'slug' => 'avalara_query_certificates',
    'class' => 'AvalaraQueryCertificates',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/certificates',
    'name' => 'List all certificates for a company',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryCertificates`.

Endpoint: GET /api/v2/companies/{companyId}/certificates.',
    'type' => 'read',
    'tag' => 'Certificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID number of the company to search',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'OPTIONAL: A comma separated list of special fetch options. You can specify one or more of the following: * customers - Retrieves the list of customers linked to the certificate. * po_numbers - Retrieves all PO numbers tied to the certificate. * attributes - Retrieves all attributes applied to the certificate. * histories - Retrieves the certificate update history * jobs - Retrieves the jobs for this certificate * logs - Retrieves the certificate log * invalid_reasons - Retrieves invalid reasons for this certificate if the certificate is invalid * custom_fields - Retrieves custom fields set for this certificate',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* exemptionNumber, ecmsId, ecmsStatus, pdf, pages',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  48 =>
  [
    'operation' => 'RequestCertificateSetup',
    'slug' => 'avalara_request_certificate_setup',
    'class' => 'AvalaraRequestCertificateSetup',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/certificates/setup',
    'name' => 'Request setup of exemption certificates for this company.',
    'description' => 'Execute official Avalara AvaTax REST API operation `RequestCertificateSetup`.

Endpoint: POST /api/v2/companies/{companyId}/certificates/setup.',
    'type' => 'write',
    'tag' => 'Certificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  49 =>
  [
    'operation' => 'UnlinkAttributesFromCertificate',
    'slug' => 'avalara_unlink_attributes_from_certificate',
    'class' => 'AvalaraUnlinkAttributesFromCertificate',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/certificates/{id}/attributes/unlink',
    'name' => 'Unlink attributes from a certificate',
    'description' => 'Execute official Avalara AvaTax REST API operation `UnlinkAttributesFromCertificate`.

Endpoint: POST /api/v2/companies/{companyId}/certificates/{id}/attributes/unlink.',
    'type' => 'write',
    'tag' => 'Certificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this certificate',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of this certificate',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The list of attributes to unlink from this certificate.',
      ],
    ],
  ],
  50 =>
  [
    'operation' => 'UnlinkCustomersFromCertificate',
    'slug' => 'avalara_unlink_customers_from_certificate',
    'class' => 'AvalaraUnlinkCustomersFromCertificate',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/certificates/{id}/customers/unlink',
    'name' => 'Unlink customers from a certificate',
    'description' => 'Execute official Avalara AvaTax REST API operation `UnlinkCustomersFromCertificate`.

Endpoint: POST /api/v2/companies/{companyId}/certificates/{id}/customers/unlink.',
    'type' => 'write',
    'tag' => 'Certificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this certificate',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of this certificate',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The list of customers to unlink from this certificate',
      ],
    ],
  ],
  51 =>
  [
    'operation' => 'UpdateCertificate',
    'slug' => 'avalara_update_certificate',
    'class' => 'AvalaraUpdateCertificate',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/certificates/{id}',
    'name' => 'Update a single certificate',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateCertificate`.

Endpoint: PUT /api/v2/companies/{companyId}/certificates/{id}.',
    'type' => 'write',
    'tag' => 'Certificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID number of the company that recorded this certificate',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of this certificate',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The new certificate object that will replace the existing one',
      ],
    ],
  ],
  52 =>
  [
    'operation' => 'UpdateCertificateCustomFields',
    'slug' => 'avalara_update_certificate_custom_fields',
    'class' => 'AvalaraUpdateCertificateCustomFields',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/certificates/{id}/custom-fields',
    'name' => 'Update Certificate Custom Fields',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateCertificateCustomFields`.

Endpoint: PUT /api/v2/companies/{companyId}/certificates/{id}/custom-fields.',
    'type' => 'write',
    'tag' => 'Certificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this certificate',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of this certificate',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'The request model containing updated custom field values',
      ],
    ],
  ],
  53 =>
  [
    'operation' => 'UploadCertificateImage',
    'slug' => 'avalara_upload_certificate_image',
    'class' => 'AvalaraUploadCertificateImage',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/certificates/{id}/attachment',
    'name' => 'Upload an image or PDF attachment for this certificate',
    'description' => 'Execute official Avalara AvaTax REST API operation `UploadCertificateImage`.

Endpoint: POST /api/v2/companies/{companyId}/certificates/{id}/attachment.',
    'type' => 'write',
    'tag' => 'Certificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this certificate',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of this certificate',
      ],
      2 =>
      [
        'name' => 'file',
        'param' => 'file',
        'in' => 'formData',
        'type' => 'string',
        'required' => true,
        'description' => 'The exemption certificate file you wanted to upload. Accepted formats are: PDF, JPEG, TIFF, PNG.',
      ],
    ],
  ],
  54 =>
  [
    'operation' => 'ListLocationByAccount',
    'slug' => 'avalara_list_location_by_account',
    'class' => 'AvalaraListLocationByAccount',
    'method' => 'GET',
    'path' => '/api/v2/companies/{accountId}/clerk/locations',
    'name' => 'Retrieves a list of location records associated with the specified account. This endpoint is secured and requires appropriate subscription and permission levels.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListLocationByAccount`.

Endpoint: GET /api/v2/companies/{accountId}/clerk/locations.',
    'type' => 'read',
    'tag' => 'Clerk',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'accountId',
        'param' => 'account_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique identifier of the account whose locations are being requested.',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'OPTIONAL: A comma separated list of special fetch options. You can specify one or more of the following:',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* id',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  55 =>
  [
    'operation' => 'GetCommunicationCertificate',
    'slug' => 'avalara_get_communication_certificate',
    'class' => 'AvalaraGetCommunicationCertificate',
    'method' => 'GET',
    'path' => '/companies/{companyId}/communication-certificates/{certificateId}',
    'name' => 'Retrieve a single communication certificate.',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetCommunicationCertificate`.

Endpoint: GET /companies/{companyId}/communication-certificates/{certificateId}.',
    'type' => 'read',
    'tag' => 'CommunicationCertificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID number of the company to search',
      ],
      1 =>
      [
        'name' => 'certificateId',
        'param' => 'certificate_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID number of the certificate to search',
      ],
    ],
  ],
  56 =>
  [
    'operation' => 'ListCommunicationCertificates',
    'slug' => 'avalara_list_communication_certificates',
    'class' => 'AvalaraListCommunicationCertificates',
    'method' => 'GET',
    'path' => '/companies/{companyId}/communication-certificates',
    'name' => 'Retrieve all communication certificates.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCommunicationCertificates`.

Endpoint: GET /companies/{companyId}/communication-certificates.',
    'type' => 'read',
    'tag' => 'CommunicationCertificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* EffectiveDate, ExpirationDate, TaxNumber, Exemptions',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
      4 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID number of the company to search',
      ],
    ],
  ],
  57 =>
  [
    'operation' => 'CertifyIntegration',
    'slug' => 'avalara_certify_integration',
    'class' => 'AvalaraCertifyIntegration',
    'method' => 'GET',
    'path' => '/api/v2/companies/{id}/certify',
    'name' => 'Checks whether the integration being used to set up this company and run transactions onto this company is compliant to all requirements.',
    'description' => 'Execute official Avalara AvaTax REST API operation `CertifyIntegration`.

Endpoint: GET /api/v2/companies/{id}/certify.',
    'type' => 'read',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company to check if its integration is certified.',
      ],
    ],
  ],
  58 =>
  [
    'operation' => 'ChangeFilingStatus',
    'slug' => 'avalara_change_filing_status',
    'class' => 'AvalaraChangeFilingStatus',
    'method' => 'POST',
    'path' => '/api/v2/companies/{id}/filingstatus',
    'name' => 'Change the filing status of this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ChangeFilingStatus`.

Endpoint: POST /api/v2/companies/{id}/filingstatus.',
    'type' => 'write',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'Avalara path parameter id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Avalara body parameter body.',
      ],
    ],
  ],
  59 =>
  [
    'operation' => 'CompanyInitialize',
    'slug' => 'avalara_company_initialize',
    'class' => 'AvalaraCompanyInitialize',
    'method' => 'POST',
    'path' => '/api/v2/companies/initialize',
    'name' => 'Quick setup for a company with a single physical address',
    'description' => 'Execute official Avalara AvaTax REST API operation `CompanyInitialize`.

Endpoint: POST /api/v2/companies/initialize.',
    'type' => 'write',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Information about the company you wish to create.',
      ],
    ],
  ],
  60 =>
  [
    'operation' => 'CreateCompanies',
    'slug' => 'avalara_create_companies',
    'class' => 'AvalaraCreateCompanies',
    'method' => 'POST',
    'path' => '/api/v2/companies',
    'name' => 'Create new companies',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateCompanies`.

Endpoint: POST /api/v2/companies.',
    'type' => 'write',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'Either a single company object or an array of companies to create',
      ],
    ],
  ],
  61 =>
  [
    'operation' => 'CreateCompanyParameters',
    'slug' => 'avalara_create_company_parameters',
    'class' => 'AvalaraCreateCompanyParameters',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/parameters',
    'name' => 'Add parameters to a company.',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateCompanyParameters`.

Endpoint: POST /api/v2/companies/{companyId}/parameters.',
    'type' => 'write',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this company parameter.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The company parameters you wish to create.',
      ],
    ],
  ],
  62 =>
  [
    'operation' => 'CreateFundingRequest',
    'slug' => 'avalara_create_funding_request',
    'class' => 'AvalaraCreateFundingRequest',
    'method' => 'POST',
    'path' => '/api/v2/companies/{id}/funding/setup',
    'name' => 'Request managed returns funding setup for a company',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateFundingRequest`.

Endpoint: POST /api/v2/companies/{id}/funding/setup.',
    'type' => 'write',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique identifier of the company',
      ],
      1 =>
      [
        'name' => 'businessUnit',
        'param' => 'business_unit',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The company\'s business unit',
      ],
      2 =>
      [
        'name' => 'subscriptionType',
        'param' => 'subscription_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The company\'s subscription type',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The funding initialization request',
      ],
    ],
  ],
  63 =>
  [
    'operation' => 'DeleteCompany',
    'slug' => 'avalara_delete_company',
    'class' => 'AvalaraDeleteCompany',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{id}',
    'name' => 'Delete a single company',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteCompany`.

Endpoint: DELETE /api/v2/companies/{id}.',
    'type' => 'write',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company you wish to delete.',
      ],
    ],
  ],
  64 =>
  [
    'operation' => 'DeleteCompanyParameter',
    'slug' => 'avalara_delete_company_parameter',
    'class' => 'AvalaraDeleteCompanyParameter',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/parameters/{id}',
    'name' => 'Delete a single company parameter',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteCompanyParameter`.

Endpoint: DELETE /api/v2/companies/{companyId}/parameters/{id}.',
    'type' => 'write',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The parameter id',
      ],
    ],
  ],
  65 =>
  [
    'operation' => 'FundingConfigurationByCompany',
    'slug' => 'avalara_funding_configuration_by_company',
    'class' => 'AvalaraFundingConfigurationByCompany',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/funding/configuration',
    'name' => 'Check the funding configuration of a company',
    'description' => 'Execute official Avalara AvaTax REST API operation `FundingConfigurationByCompany`.

Endpoint: GET /api/v2/companies/{companyId}/funding/configuration.',
    'type' => 'read',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique identifier of the company',
      ],
    ],
  ],
  66 =>
  [
    'operation' => 'FundingConfigurationsByCompanyAndCurrency',
    'slug' => 'avalara_funding_configurations_by_company_and_currency',
    'class' => 'AvalaraFundingConfigurationsByCompanyAndCurrency',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/funding/configurations',
    'name' => 'Check the funding configuration of a company',
    'description' => 'Execute official Avalara AvaTax REST API operation `FundingConfigurationsByCompanyAndCurrency`.

Endpoint: GET /api/v2/companies/{companyId}/funding/configurations.',
    'type' => 'read',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique identifier of the company',
      ],
      1 =>
      [
        'name' => 'currency',
        'param' => 'currency',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The currency of the funding. USD and CAD are the only valid currencies',
      ],
    ],
  ],
  67 =>
  [
    'operation' => 'GetAllCustomersAndSuppliersWithCountryParams',
    'slug' => 'avalara_get_all_customers_and_suppliers_with_country_params',
    'class' => 'AvalaraGetAllCustomersAndSuppliersWithCountryParams',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/supplierandcustomers/withcountryparams',
    'name' => 'Retrieve all customers and suppliers with their country parameters for a company',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetAllCustomersAndSuppliersWithCountryParams`.

Endpoint: GET /api/v2/companies/{companyId}/supplierandcustomers/withcountryparams.',
    'type' => 'read',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'Company Id',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* CustomerId, CompanyId, CustomerTypeId, CustomerSupplierCountryParamId, Country, IsEstablished, IsRegisteredThroughFiscalRep, VatNumberStatus',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  68 =>
  [
    'operation' => 'GetCompany',
    'slug' => 'avalara_get_company',
    'class' => 'AvalaraGetCompany',
    'method' => 'GET',
    'path' => '/api/v2/companies/{id}',
    'name' => 'Retrieve a single company',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetCompany`.

Endpoint: GET /api/v2/companies/{id}.',
    'type' => 'read',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company to retrieve.',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'OPTIONAL: A comma separated list of special fetch options. * Child objects - Specify one or more of the following to retrieve objects related to each company: "Contacts", "FilingCalendars", "Items", "Locations", "Nexus", "TaxCodes", "NonReportingChildren" or "TaxRules". * Deleted objects - Specify "FetchDeleted" to retrieve information about previously deleted objects.',
      ],
    ],
  ],
  69 =>
  [
    'operation' => 'GetCompanyConfiguration',
    'slug' => 'avalara_get_company_configuration',
    'class' => 'AvalaraGetCompanyConfiguration',
    'method' => 'GET',
    'path' => '/api/v2/companies/{id}/configuration',
    'name' => 'Get configuration settings for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetCompanyConfiguration`.

Endpoint: GET /api/v2/companies/{id}/configuration.',
    'type' => 'read',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'Avalara path parameter id.',
      ],
    ],
  ],
  70 =>
  [
    'operation' => 'GetCompanyParameterDetail',
    'slug' => 'avalara_get_company_parameter_detail',
    'class' => 'AvalaraGetCompanyParameterDetail',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/parameters/{id}',
    'name' => 'Retrieve a single company parameter',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetCompanyParameterDetail`.

Endpoint: GET /api/v2/companies/{companyId}/parameters/{id}.',
    'type' => 'read',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => '',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  71 =>
  [
    'operation' => 'GetFilingStatus',
    'slug' => 'avalara_get_filing_status',
    'class' => 'AvalaraGetFilingStatus',
    'method' => 'GET',
    'path' => '/api/v2/companies/{id}/filingstatus',
    'name' => 'Get this company\'s filing status',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetFilingStatus`.

Endpoint: GET /api/v2/companies/{id}/filingstatus.',
    'type' => 'read',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'Avalara path parameter id.',
      ],
    ],
  ],
  72 =>
  [
    'operation' => 'ListACHEntryDetailsForCompany',
    'slug' => 'avalara_list_ach_entry_details_for_company',
    'class' => 'AvalaraListACHEntryDetailsForCompany',
    'method' => 'GET',
    'path' => '/api/v2/companies/{id}/paymentdetails/{periodyear}/{periodmonth}',
    'name' => 'Get ACH entry detail report for company and period',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListACHEntryDetailsForCompany`.

Endpoint: GET /api/v2/companies/{id}/paymentdetails/{periodyear}/{periodmonth}.',
    'type' => 'read',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique identifier of the company',
      ],
      1 =>
      [
        'name' => 'periodyear',
        'param' => 'periodyear',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The period year',
      ],
      2 =>
      [
        'name' => 'periodmonth',
        'param' => 'periodmonth',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The period month',
      ],
    ],
  ],
  73 =>
  [
    'operation' => 'ListCompanyParameterDetails',
    'slug' => 'avalara_list_company_parameter_details',
    'class' => 'AvalaraListCompanyParameterDetails',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/parameters',
    'name' => 'Retrieve parameters for a company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCompanyParameterDetails`.

Endpoint: GET /api/v2/companies/{companyId}/parameters.',
    'type' => 'read',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* name, unit',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  74 =>
  [
    'operation' => 'ListFundingRequestsByCompany',
    'slug' => 'avalara_list_funding_requests_by_company',
    'class' => 'AvalaraListFundingRequestsByCompany',
    'method' => 'GET',
    'path' => '/api/v2/companies/{id}/funding',
    'name' => 'Check managed returns funding status for a company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListFundingRequestsByCompany`.

Endpoint: GET /api/v2/companies/{id}/funding.',
    'type' => 'read',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique identifier of the company',
      ],
    ],
  ],
  75 =>
  [
    'operation' => 'ListMrsCompanies',
    'slug' => 'avalara_list_mrs_companies',
    'class' => 'AvalaraListMrsCompanies',
    'method' => 'GET',
    'path' => '/api/v2/companies/mrs',
    'name' => 'Retrieve a list of MRS Companies with account',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListMrsCompanies`.

Endpoint: GET /api/v2/companies/mrs.',
    'type' => 'read',
    'tag' => 'Companies',
    'parameters' =>
    [
    ],
  ],
  76 =>
  [
    'operation' => 'ListVatNumbers',
    'slug' => 'avalara_list_vat_numbers',
    'class' => 'AvalaraListVatNumbers',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/vatnumbers',
    'name' => 'Retrieve VAT Numbers for a company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListVatNumbers`.

Endpoint: GET /api/v2/companies/{companyId}/vatnumbers.',
    'type' => 'read',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* createdDate, modifiedDate',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  77 =>
  [
    'operation' => 'QueryCompanies',
    'slug' => 'avalara_query_companies',
    'class' => 'AvalaraQueryCompanies',
    'method' => 'GET',
    'path' => '/api/v2/companies',
    'name' => 'Retrieve all companies',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryCompanies`.

Endpoint: GET /api/v2/companies.',
    'type' => 'read',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of objects to fetch underneath this company. Any object with a URL path underneath this company can be fetched by specifying its name.',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* IsFein, contacts, items, locations, nexus, settings, taxCodes, taxRules, upcs, nonReportingChildCompanies, exemptCerts, parameters, supplierandcustomers, isAdvSave, companyUrl, companyDescription',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  78 =>
  [
    'operation' => 'SetCompanyConfiguration',
    'slug' => 'avalara_set_company_configuration',
    'class' => 'AvalaraSetCompanyConfiguration',
    'method' => 'POST',
    'path' => '/api/v2/companies/{id}/configuration',
    'name' => 'Change configuration settings for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `SetCompanyConfiguration`.

Endpoint: POST /api/v2/companies/{id}/configuration.',
    'type' => 'write',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'Avalara path parameter id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'Avalara body parameter body.',
      ],
    ],
  ],
  79 =>
  [
    'operation' => 'UpdateCompany',
    'slug' => 'avalara_update_company',
    'class' => 'AvalaraUpdateCompany',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{id}',
    'name' => 'Update a single company',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateCompany`.

Endpoint: PUT /api/v2/companies/{id}.',
    'type' => 'write',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company you wish to update.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'The company object you wish to update.',
      ],
    ],
  ],
  80 =>
  [
    'operation' => 'UpdateCompanyParameterDetail',
    'slug' => 'avalara_update_company_parameter_detail',
    'class' => 'AvalaraUpdateCompanyParameterDetail',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/parameters/{id}',
    'name' => 'Update a company parameter',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateCompanyParameterDetail`.

Endpoint: PUT /api/v2/companies/{companyId}/parameters/{id}.',
    'type' => 'write',
    'tag' => 'Companies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company parameter id',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'The company parameter object you wish to update.',
      ],
    ],
  ],
  81 =>
  [
    'operation' => 'QueryJurisNames',
    'slug' => 'avalara_query_juris_names',
    'class' => 'AvalaraQueryJurisNames',
    'method' => 'GET',
    'path' => '/api/v2/compliance/jurisnames/{country}/{region}',
    'name' => 'Retrieve all unique jurisnames based on filter.',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryJurisNames`.

Endpoint: GET /api/v2/compliance/jurisnames/{country}/{region}.',
    'type' => 'read',
    'tag' => 'Compliance',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The two-character ISO-3166 code for the country.',
      ],
      1 =>
      [
        'name' => 'region',
        'param' => 'region',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The two or three character region code for the region.',
      ],
      2 =>
      [
        'name' => 'effectiveDate',
        'param' => 'effective_date',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Used to limit the jurisnames returned.',
      ],
      3 =>
      [
        'name' => 'endDate',
        'param' => 'end_date',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Used to limit the jurisnames returned.',
      ],
      4 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      5 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      6 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      7 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  82 =>
  [
    'operation' => 'QueryRateOptions',
    'slug' => 'avalara_query_rate_options',
    'class' => 'AvalaraQueryRateOptions',
    'method' => 'GET',
    'path' => '/api/v2/compliance/rateOptions/{country}/{region}',
    'name' => 'Retrieve all RateOptions.',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryRateOptions`.

Endpoint: GET /api/v2/compliance/rateOptions/{country}/{region}.',
    'type' => 'read',
    'tag' => 'Compliance',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The two-character ISO-3166 code for the country.',
      ],
      1 =>
      [
        'name' => 'region',
        'param' => 'region',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The two or three character region code for the region.',
      ],
      2 =>
      [
        'name' => 'effectiveDate',
        'param' => 'effective_date',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Used to limit the jurisdictions or rates returned.',
      ],
      3 =>
      [
        'name' => 'endDate',
        'param' => 'end_date',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Used to limit the jurisdictions or rates returned.',
      ],
      4 =>
      [
        'name' => 'aggregationOption',
        'param' => 'aggregation_option',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Aggregation method used.',
      ],
      5 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      6 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      7 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* taxRegionId, taxTypeCodeName, taxSubTypeCode, taxSubTypeCodeName, rateTypeCodeName, componentRate, taxAuthorityId, cityName, countyName, effDate, endDate',
      ],
      8 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  83 =>
  [
    'operation' => 'QueryStateConfig',
    'slug' => 'avalara_query_state_config',
    'class' => 'AvalaraQueryStateConfig',
    'method' => 'GET',
    'path' => '/api/v2/compliance/stateconfig',
    'name' => 'Retrieve StateConfig information',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryStateConfig`.

Endpoint: GET /api/v2/compliance/stateconfig.',
    'type' => 'read',
    'tag' => 'Compliance',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* effDate, endDate, hasBoundary, hasRates, isLocalAdmin, isLocalNexus, isSerState, minBoundaryLevelId, sstStatusId, state, stateFips, boundaryTableBaseName, stjCount, tsStateId, isJaasEnabled, hasSSTBoundary',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  84 =>
  [
    'operation' => 'QueryStateReportingCodes',
    'slug' => 'avalara_query_state_reporting_codes',
    'class' => 'AvalaraQueryStateReportingCodes',
    'method' => 'GET',
    'path' => '/api/v2/compliance/stateReportingCodes/{country}/{region}',
    'name' => 'Retrieve all State Reporting Codes based on filter.',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryStateReportingCodes`.

Endpoint: GET /api/v2/compliance/stateReportingCodes/{country}/{region}.',
    'type' => 'read',
    'tag' => 'Compliance',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The two-character ISO-3166 code for the country.',
      ],
      1 =>
      [
        'name' => 'region',
        'param' => 'region',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The two or three character region code for the region.',
      ],
      2 =>
      [
        'name' => 'effectiveDate',
        'param' => 'effective_date',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Used to limit the StateReportingCodes or rates returned.',
      ],
      3 =>
      [
        'name' => 'endDate',
        'param' => 'end_date',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Used to limit the StateReportingCodes or rates returned.',
      ],
      4 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* label',
      ],
      5 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      6 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      7 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  85 =>
  [
    'operation' => 'QueryTaxTypeMappings',
    'slug' => 'avalara_query_tax_type_mappings',
    'class' => 'AvalaraQueryTaxTypeMappings',
    'method' => 'GET',
    'path' => '/api/v2/compliance/taxtypemappings',
    'name' => 'Retrieve all tax type mappings based on filter.',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryTaxTypeMappings`.

Endpoint: GET /api/v2/compliance/taxtypemappings.',
    'type' => 'read',
    'tag' => 'Compliance',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* taxTypeGroupIdSK, taxTypeIdSK, taxSubTypeIdSK, generalOrStandardRateTypeIdSK, taxTypeGroupId, taxTypeId, country, generalOrStandardRateTypeId, isCustomContent',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  86 =>
  [
    'operation' => 'CreateContacts',
    'slug' => 'avalara_create_contacts',
    'class' => 'AvalaraCreateContacts',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/contacts',
    'name' => 'Create a new contact',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateContacts`.

Endpoint: POST /api/v2/companies/{companyId}/contacts.',
    'type' => 'write',
    'tag' => 'Contacts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this contact.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The contacts you wish to create.',
      ],
    ],
  ],
  87 =>
  [
    'operation' => 'DeleteContact',
    'slug' => 'avalara_delete_contact',
    'class' => 'AvalaraDeleteContact',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/contacts/{id}',
    'name' => 'Delete a single contact',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteContact`.

Endpoint: DELETE /api/v2/companies/{companyId}/contacts/{id}.',
    'type' => 'write',
    'tag' => 'Contacts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this contact.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the contact you wish to delete.',
      ],
    ],
  ],
  88 =>
  [
    'operation' => 'GetContact',
    'slug' => 'avalara_get_contact',
    'class' => 'AvalaraGetContact',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/contacts/{id}',
    'name' => 'Retrieve a single contact',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetContact`.

Endpoint: GET /api/v2/companies/{companyId}/contacts/{id}.',
    'type' => 'read',
    'tag' => 'Contacts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company for this contact',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this contact',
      ],
    ],
  ],
  89 =>
  [
    'operation' => 'ListContactsByCompany',
    'slug' => 'avalara_list_contacts_by_company',
    'class' => 'AvalaraListContactsByCompany',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/contacts',
    'name' => 'Retrieve contacts for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListContactsByCompany`.

Endpoint: GET /api/v2/companies/{companyId}/contacts.',
    'type' => 'read',
    'tag' => 'Contacts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns these contacts',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* scsContactId',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  90 =>
  [
    'operation' => 'QueryContacts',
    'slug' => 'avalara_query_contacts',
    'class' => 'AvalaraQueryContacts',
    'method' => 'GET',
    'path' => '/api/v2/contacts',
    'name' => 'Retrieve all contacts',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryContacts`.

Endpoint: GET /api/v2/contacts.',
    'type' => 'read',
    'tag' => 'Contacts',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* scsContactId',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  91 =>
  [
    'operation' => 'UpdateContact',
    'slug' => 'avalara_update_contact',
    'class' => 'AvalaraUpdateContact',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/contacts/{id}',
    'name' => 'Update a single contact',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateContact`.

Endpoint: PUT /api/v2/companies/{companyId}/contacts/{id}.',
    'type' => 'write',
    'tag' => 'Contacts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that this contact belongs to.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the contact you wish to update',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The contact you wish to update.',
      ],
    ],
  ],
  92 =>
  [
    'operation' => 'BulkUploadCostCenters',
    'slug' => 'avalara_bulk_upload_cost_centers',
    'class' => 'AvalaraBulkUploadCostCenters',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyid}/costcenters/$upload',
    'name' => 'Bulk upload cost centers',
    'description' => 'Execute official Avalara AvaTax REST API operation `BulkUploadCostCenters`.

Endpoint: POST /api/v2/companies/{companyid}/costcenters/$upload.',
    'type' => 'write',
    'tag' => 'CostCenter',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyid',
        'param' => 'companyid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this cost center object',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'The cost center bulk upload model.',
      ],
    ],
  ],
  93 =>
  [
    'operation' => 'CreateCostCenter',
    'slug' => 'avalara_create_cost_center',
    'class' => 'AvalaraCreateCostCenter',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyid}/costcenters',
    'name' => 'Create new cost center',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateCostCenter`.

Endpoint: POST /api/v2/companies/{companyid}/costcenters.',
    'type' => 'write',
    'tag' => 'CostCenter',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyid',
        'param' => 'companyid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this cost center object',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'The cost center you wish to create.',
      ],
    ],
  ],
  94 =>
  [
    'operation' => 'DeleteCostCenter',
    'slug' => 'avalara_delete_cost_center',
    'class' => 'AvalaraDeleteCostCenter',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyid}/costcenters/{costcenterid}',
    'name' => 'Delete cost center for the given id',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteCostCenter`.

Endpoint: DELETE /api/v2/companies/{companyid}/costcenters/{costcenterid}.',
    'type' => 'write',
    'tag' => 'CostCenter',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyid',
        'param' => 'companyid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this cost center object',
      ],
      1 =>
      [
        'name' => 'costcenterid',
        'param' => 'costcenterid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this cost center',
      ],
    ],
  ],
  95 =>
  [
    'operation' => 'GetCostCenterById',
    'slug' => 'avalara_get_cost_center_by_id',
    'class' => 'AvalaraGetCostCenterById',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyid}/costcenters/{costcenterid}',
    'name' => 'Retrieve a single cost center',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetCostCenterById`.

Endpoint: GET /api/v2/companies/{companyid}/costcenters/{costcenterid}.',
    'type' => 'read',
    'tag' => 'CostCenter',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyid',
        'param' => 'companyid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this cost center object',
      ],
      1 =>
      [
        'name' => 'costcenterid',
        'param' => 'costcenterid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this cost center',
      ],
    ],
  ],
  96 =>
  [
    'operation' => 'ListCostCentersByCompany',
    'slug' => 'avalara_list_cost_centers_by_company',
    'class' => 'AvalaraListCostCentersByCompany',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyid}/costcenters',
    'name' => 'Retrieve cost centers for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCostCentersByCompany`.

Endpoint: GET /api/v2/companies/{companyid}/costcenters.',
    'type' => 'read',
    'tag' => 'CostCenter',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyid',
        'param' => 'companyid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that defined these cost centers',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* companyId, meta, defaultItem',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of objects to fetch underneath this company. Any object with a URL path underneath this company can be fetched by specifying its name.',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  97 =>
  [
    'operation' => 'QueryCostCenters',
    'slug' => 'avalara_query_cost_centers',
    'class' => 'AvalaraQueryCostCenters',
    'method' => 'GET',
    'path' => '/api/v2/costcenters',
    'name' => 'Retrieve all cost centers',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryCostCenters`.

Endpoint: GET /api/v2/costcenters.',
    'type' => 'read',
    'tag' => 'CostCenter',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* companyId, meta, defaultItem',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of objects to fetch underneath this company. Any object with a URL path underneath this company can be fetched by specifying its name.',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  98 =>
  [
    'operation' => 'UpdateCostCenter',
    'slug' => 'avalara_update_cost_center',
    'class' => 'AvalaraUpdateCostCenter',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyid}/costcenters/{costcenterid}',
    'name' => 'Update a single cost center',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateCostCenter`.

Endpoint: PUT /api/v2/companies/{companyid}/costcenters/{costcenterid}.',
    'type' => 'write',
    'tag' => 'CostCenter',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyid',
        'param' => 'companyid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this cost center object',
      ],
      1 =>
      [
        'name' => 'costcenterid',
        'param' => 'costcenterid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this cost center',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'The cost center object you wish to update.',
      ],
    ],
  ],
  99 =>
  [
    'operation' => 'CreateCustomers',
    'slug' => 'avalara_create_customers',
    'class' => 'AvalaraCreateCustomers',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/customers',
    'name' => 'Create customers for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateCustomers`.

Endpoint: POST /api/v2/companies/{companyId}/customers.',
    'type' => 'write',
    'tag' => 'Customers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this customer',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The list of customer objects to be created',
      ],
    ],
  ],
  100 =>
  [
    'operation' => 'DeleteCustomFields',
    'slug' => 'avalara_delete_custom_fields',
    'class' => 'AvalaraDeleteCustomFields',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/customers/{customerCode}/custom-fields',
    'name' => 'Delete custom fields',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteCustomFields`.

Endpoint: DELETE /api/v2/companies/{companyId}/customers/{customerCode}/custom-fields.',
    'type' => 'write',
    'tag' => 'Customers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this customer',
      ],
      1 =>
      [
        'name' => 'customerCode',
        'param' => 'customer_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique code representing this customer',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => false,
        'description' => 'Delete custom fields request model',
      ],
    ],
  ],
  101 =>
  [
    'operation' => 'DeleteCustomer',
    'slug' => 'avalara_delete_customer',
    'class' => 'AvalaraDeleteCustomer',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/customers/{customerCode}',
    'name' => 'Delete a customer record',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteCustomer`.

Endpoint: DELETE /api/v2/companies/{companyId}/customers/{customerCode}.',
    'type' => 'write',
    'tag' => 'Customers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this customer',
      ],
      1 =>
      [
        'name' => 'customerCode',
        'param' => 'customer_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique code representing this customer',
      ],
    ],
  ],
  102 =>
  [
    'operation' => 'GetCustomer',
    'slug' => 'avalara_get_customer',
    'class' => 'AvalaraGetCustomer',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/customers/{customerCode}',
    'name' => 'Retrieve a single customer',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetCustomer`.

Endpoint: GET /api/v2/companies/{companyId}/customers/{customerCode}.',
    'type' => 'read',
    'tag' => 'Customers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this customer',
      ],
      1 =>
      [
        'name' => 'customerCode',
        'param' => 'customer_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique code representing this customer',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specify optional additional objects to include in this fetch request',
      ],
    ],
  ],
  103 =>
  [
    'operation' => 'LinkAttributesToCustomer',
    'slug' => 'avalara_link_attributes_to_customer',
    'class' => 'AvalaraLinkAttributesToCustomer',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/customers/{customerCode}/attributes/link',
    'name' => 'Link attributes to a customer',
    'description' => 'Execute official Avalara AvaTax REST API operation `LinkAttributesToCustomer`.

Endpoint: PUT /api/v2/companies/{companyId}/customers/{customerCode}/attributes/link.',
    'type' => 'write',
    'tag' => 'Customers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded the provided customer',
      ],
      1 =>
      [
        'name' => 'customerCode',
        'param' => 'customer_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique code representing the current customer',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The list of attributes to link to the customer.',
      ],
    ],
  ],
  104 =>
  [
    'operation' => 'LinkCertificatesToCustomer',
    'slug' => 'avalara_link_certificates_to_customer',
    'class' => 'AvalaraLinkCertificatesToCustomer',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/customers/{customerCode}/certificates/link',
    'name' => 'Link certificates to a customer',
    'description' => 'Execute official Avalara AvaTax REST API operation `LinkCertificatesToCustomer`.

Endpoint: POST /api/v2/companies/{companyId}/customers/{customerCode}/certificates/link.',
    'type' => 'write',
    'tag' => 'Customers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this customer',
      ],
      1 =>
      [
        'name' => 'customerCode',
        'param' => 'customer_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique code representing this customer',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The list of certificates to link to this customer',
      ],
    ],
  ],
  105 =>
  [
    'operation' => 'LinkShipToCustomersToBillCustomer',
    'slug' => 'avalara_link_ship_to_customers_to_bill_customer',
    'class' => 'AvalaraLinkShipToCustomersToBillCustomer',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/customers/billto/{code}/shipto/link',
    'name' => 'Link two customer records together',
    'description' => 'Execute official Avalara AvaTax REST API operation `LinkShipToCustomersToBillCustomer`.

Endpoint: POST /api/v2/companies/{companyId}/customers/billto/{code}/shipto/link.',
    'type' => 'write',
    'tag' => 'Customers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company defining customers.',
      ],
      1 =>
      [
        'name' => 'code',
        'param' => 'code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The code of the bill-to customer to link.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'A list of information about ship-to customers to link to this bill-to customer.',
      ],
    ],
  ],
  106 =>
  [
    'operation' => 'ListActiveCertificatesForCustomer',
    'slug' => 'avalara_list_active_certificates_for_customer',
    'class' => 'AvalaraListActiveCertificatesForCustomer',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/customers/{customerCode}/certificates/active',
    'name' => 'Retrieves a list of active certificates for a specified customer within a company.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListActiveCertificatesForCustomer`.

Endpoint: GET /api/v2/companies/{companyId}/customers/{customerCode}/certificates/active.',
    'type' => 'read',
    'tag' => 'Customers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this customer',
      ],
      1 =>
      [
        'name' => 'customerCode',
        'param' => 'customer_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique code representing this customer',
      ],
    ],
  ],
  107 =>
  [
    'operation' => 'ListAttributesForCustomer',
    'slug' => 'avalara_list_attributes_for_customer',
    'class' => 'AvalaraListAttributesForCustomer',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/customers/{customerCode}/attributes',
    'name' => 'Retrieve a customer\'s attributes',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListAttributesForCustomer`.

Endpoint: GET /api/v2/companies/{companyId}/customers/{customerCode}/attributes.',
    'type' => 'read',
    'tag' => 'Customers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded the provided customer',
      ],
      1 =>
      [
        'name' => 'customerCode',
        'param' => 'customer_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique code representing the current customer',
      ],
    ],
  ],
  108 =>
  [
    'operation' => 'ListCertificatesForCustomer',
    'slug' => 'avalara_list_certificates_for_customer',
    'class' => 'AvalaraListCertificatesForCustomer',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/customers/{customerCode}/certificates',
    'name' => 'List certificates linked to a customer',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCertificatesForCustomer`.

Endpoint: GET /api/v2/companies/{companyId}/customers/{customerCode}/certificates.',
    'type' => 'read',
    'tag' => 'Customers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this customer',
      ],
      1 =>
      [
        'name' => 'customerCode',
        'param' => 'customer_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique code representing this customer',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'OPTIONAL: A comma separated list of special fetch options. You can specify one or more of the following: * customers - Retrieves the list of customers linked to the certificate. * po_numbers - Retrieves all PO numbers tied to the certificate. * attributes - Retrieves all attributes applied to the certificate. * histories - Retrieves the certificate update history * jobs - Retrieves the jobs for this certificate * logs - Retrieves the certificate log * invalid_reasons - Retrieves invalid reasons for this certificate if the certificate is invalid * custom_fields - Retrieves custom fields set for this certificate',
      ],
      3 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* exemptionNumber, ecmsId, ecmsStatus, pdf, pages',
      ],
      4 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      5 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      6 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  109 =>
  [
    'operation' => 'ListCustomFieldsForCustomer',
    'slug' => 'avalara_list_custom_fields_for_customer',
    'class' => 'AvalaraListCustomFieldsForCustomer',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/customers/{customerCode}/custom-fields',
    'name' => 'Retrieves a list of custom fields for a specified customer within a company.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCustomFieldsForCustomer`.

Endpoint: GET /api/v2/companies/{companyId}/customers/{customerCode}/custom-fields.',
    'type' => 'read',
    'tag' => 'Customers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this customer',
      ],
      1 =>
      [
        'name' => 'customerCode',
        'param' => 'customer_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique code representing this customer',
      ],
    ],
  ],
  110 =>
  [
    'operation' => 'ListInActiveCertificatesForCustomer',
    'slug' => 'avalara_list_in_active_certificates_for_customer',
    'class' => 'AvalaraListInActiveCertificatesForCustomer',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/customers/{customerCode}/certificates/inactive',
    'name' => 'Retrieves a list of inactive certificates for a specified customer within a company.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListInActiveCertificatesForCustomer`.

Endpoint: GET /api/v2/companies/{companyId}/customers/{customerCode}/certificates/inactive.',
    'type' => 'read',
    'tag' => 'Customers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this customer',
      ],
      1 =>
      [
        'name' => 'customerCode',
        'param' => 'customer_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique code representing this customer',
      ],
    ],
  ],
  111 =>
  [
    'operation' => 'ListValidCertificatesForCustomer',
    'slug' => 'avalara_list_valid_certificates_for_customer',
    'class' => 'AvalaraListValidCertificatesForCustomer',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/customers/{customerCode}/certificates/{country}/{region}',
    'name' => 'List valid certificates for a location',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListValidCertificatesForCustomer`.

Endpoint: GET /api/v2/companies/{companyId}/customers/{customerCode}/certificates/{country}/{region}.',
    'type' => 'read',
    'tag' => 'Customers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this customer',
      ],
      1 =>
      [
        'name' => 'customerCode',
        'param' => 'customer_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique code representing this customer',
      ],
      2 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Search for certificates matching this country. Uses the ISO 3166 two character country code.',
      ],
      3 =>
      [
        'name' => 'region',
        'param' => 'region',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Search for certificates matching this region. Uses the ISO 3166 two or three character state, region, or province code.',
      ],
    ],
  ],
  112 =>
  [
    'operation' => 'QueryCustomers',
    'slug' => 'avalara_query_customers',
    'class' => 'AvalaraQueryCustomers',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/customers',
    'name' => 'List all customers for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryCustomers`.

Endpoint: GET /api/v2/companies/{companyId}/customers.',
    'type' => 'read',
    'tag' => 'Customers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this customer',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'OPTIONAL - You can specify any of the values in `certificates`, `attributes`, `active_certificates`, `histories`, `logs`, `jobs`, `billTos`, `shipTos`, `shipToStates`, and `custom_fields` to fetch additional information for this certificate.',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  113 =>
  [
    'operation' => 'UnlinkAttributesFromCustomer',
    'slug' => 'avalara_unlink_attributes_from_customer',
    'class' => 'AvalaraUnlinkAttributesFromCustomer',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/customers/{customerCode}/attributes/unlink',
    'name' => 'Unlink attributes from a customer',
    'description' => 'Execute official Avalara AvaTax REST API operation `UnlinkAttributesFromCustomer`.

Endpoint: PUT /api/v2/companies/{companyId}/customers/{customerCode}/attributes/unlink.',
    'type' => 'write',
    'tag' => 'Customers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded the customer',
      ],
      1 =>
      [
        'name' => 'customerCode',
        'param' => 'customer_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique code representing the current customer',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The list of attributes to unlink from the customer.',
      ],
    ],
  ],
  114 =>
  [
    'operation' => 'UnlinkCertificatesFromCustomer',
    'slug' => 'avalara_unlink_certificates_from_customer',
    'class' => 'AvalaraUnlinkCertificatesFromCustomer',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/customers/{customerCode}/certificates/unlink',
    'name' => 'Unlink certificates from a customer',
    'description' => 'Execute official Avalara AvaTax REST API operation `UnlinkCertificatesFromCustomer`.

Endpoint: POST /api/v2/companies/{companyId}/customers/{customerCode}/certificates/unlink.',
    'type' => 'write',
    'tag' => 'Customers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this customer',
      ],
      1 =>
      [
        'name' => 'customerCode',
        'param' => 'customer_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique code representing this customer',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The list of certificates to link to this customer',
      ],
    ],
  ],
  115 =>
  [
    'operation' => 'UpdateCustomFields',
    'slug' => 'avalara_update_custom_fields',
    'class' => 'AvalaraUpdateCustomFields',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/customers/{customerCode}/custom-fields',
    'name' => 'Update custom fields',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateCustomFields`.

Endpoint: PUT /api/v2/companies/{companyId}/customers/{customerCode}/custom-fields.',
    'type' => 'write',
    'tag' => 'Customers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this customer',
      ],
      1 =>
      [
        'name' => 'customerCode',
        'param' => 'customer_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique code representing this customer',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'Update custom fields request model',
      ],
    ],
  ],
  116 =>
  [
    'operation' => 'UpdateCustomer',
    'slug' => 'avalara_update_customer',
    'class' => 'AvalaraUpdateCustomer',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/customers/{customerCode}',
    'name' => 'Update a single customer',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateCustomer`.

Endpoint: PUT /api/v2/companies/{companyId}/customers/{customerCode}.',
    'type' => 'write',
    'tag' => 'Customers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this customer',
      ],
      1 =>
      [
        'name' => 'customerCode',
        'param' => 'customer_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique code representing this customer',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The new customer model that will replace the existing record at this URL',
      ],
    ],
  ],
  117 =>
  [
    'operation' => 'CreateDataSources',
    'slug' => 'avalara_create_data_sources',
    'class' => 'AvalaraCreateDataSources',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/datasources',
    'name' => 'Create and store new datasources for the respective companies.',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateDataSources`.

Endpoint: POST /api/v2/companies/{companyId}/datasources.',
    'type' => 'write',
    'tag' => 'DataSources',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The id of the company you which to create the datasources',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  118 =>
  [
    'operation' => 'DeleteDataSource',
    'slug' => 'avalara_delete_data_source',
    'class' => 'AvalaraDeleteDataSource',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/datasources/{id}',
    'name' => 'Delete a datasource by datasource id for a company.',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteDataSource`.

Endpoint: DELETE /api/v2/companies/{companyId}/datasources/{id}.',
    'type' => 'write',
    'tag' => 'DataSources',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The id of the company the datasource belongs to.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The id of the datasource you wish to delete.',
      ],
    ],
  ],
  119 =>
  [
    'operation' => 'GetDataSourceById',
    'slug' => 'avalara_get_data_source_by_id',
    'class' => 'AvalaraGetDataSourceById',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/datasources/{id}',
    'name' => 'Get data source by data source id',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetDataSourceById`.

Endpoint: GET /api/v2/companies/{companyId}/datasources/{id}.',
    'type' => 'read',
    'tag' => 'DataSources',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => '',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'data source id',
      ],
    ],
  ],
  120 =>
  [
    'operation' => 'ListDataSources',
    'slug' => 'avalara_list_data_sources',
    'class' => 'AvalaraListDataSources',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/datasources',
    'name' => 'Retrieve all datasources for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListDataSources`.

Endpoint: GET /api/v2/companies/{companyId}/datasources.',
    'type' => 'read',
    'tag' => 'DataSources',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The id of the company you wish to retrieve the datasources.',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* isEnabled, isSynced, isAuthorized, name, externalState',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  121 =>
  [
    'operation' => 'QueryDataSources',
    'slug' => 'avalara_query_data_sources',
    'class' => 'AvalaraQueryDataSources',
    'method' => 'GET',
    'path' => '/api/v2/datasources',
    'name' => 'Retrieve all datasources',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryDataSources`.

Endpoint: GET /api/v2/datasources.',
    'type' => 'read',
    'tag' => 'DataSources',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* isEnabled, isSynced, isAuthorized, name, externalState',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  122 =>
  [
    'operation' => 'UpdateDataSource',
    'slug' => 'avalara_update_data_source',
    'class' => 'AvalaraUpdateDataSource',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/datasources/{id}',
    'name' => 'Update a datasource identified by id for a company',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateDataSource`.

Endpoint: PUT /api/v2/companies/{companyId}/datasources/{id}.',
    'type' => 'write',
    'tag' => 'DataSources',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The id of the company the datasource belongs to.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The id of the datasource you wish to delete.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  123 =>
  [
    'operation' => 'GetCrossBorderCode',
    'slug' => 'avalara_get_cross_border_code',
    'class' => 'AvalaraGetCrossBorderCode',
    'method' => 'GET',
    'path' => '/api/v2/definitions/crossborder/{country}/{hsCode}/hierarchy',
    'name' => 'Lists all parents of an HS Code.',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetCrossBorderCode`.

Endpoint: GET /api/v2/definitions/crossborder/{country}/{hsCode}/hierarchy.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The name or code of the destination country.',
      ],
      1 =>
      [
        'name' => 'hsCode',
        'param' => 'hs_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The partial or full HS Code for which you would like to view all of the parents.',
      ],
    ],
  ],
  124 =>
  [
    'operation' => 'ListAllMarketplaceLocations',
    'slug' => 'avalara_list_all_marketplace_locations',
    'class' => 'AvalaraListAllMarketplaceLocations',
    'method' => 'GET',
    'path' => '/api/v2/definitions/listallmarketplacelocations',
    'name' => 'List all market place locations.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListAllMarketplaceLocations`.

Endpoint: GET /api/v2/definitions/listallmarketplacelocations.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  125 =>
  [
    'operation' => 'ListAllUnitOfBasis',
    'slug' => 'avalara_list_all_unit_of_basis',
    'class' => 'AvalaraListAllUnitOfBasis',
    'method' => 'GET',
    'path' => '/api/v2/definitions/unitofbasis',
    'name' => 'Retrieve the list of all valid unit of basis',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListAllUnitOfBasis`.

Endpoint: GET /api/v2/definitions/unitofbasis.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* attributesUsed',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  126 =>
  [
    'operation' => 'ListAvaFileForms',
    'slug' => 'avalara_list_ava_file_forms',
    'class' => 'AvalaraListAvaFileForms',
    'method' => 'GET',
    'path' => '/api/v2/definitions/avafileforms',
    'name' => 'Retrieve the full list of the AvaFile Forms available',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListAvaFileForms`.

Endpoint: GET /api/v2/definitions/avafileforms.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* outletTypeId',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  127 =>
  [
    'operation' => 'ListCertificateAttributes',
    'slug' => 'avalara_list_certificate_attributes',
    'class' => 'AvalaraListCertificateAttributes',
    'method' => 'GET',
    'path' => '/api/v2/definitions/certificateattributes',
    'name' => 'List certificate attributes used by a company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCertificateAttributes`.

Endpoint: GET /api/v2/definitions/certificateattributes.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyid',
        'param' => 'companyid',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Id of the company the user wish to fetch the certificates\' attributes from. If not specified the API will use user\'s default company.',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  128 =>
  [
    'operation' => 'ListCertificateExemptReasons',
    'slug' => 'avalara_list_certificate_exempt_reasons',
    'class' => 'AvalaraListCertificateExemptReasons',
    'method' => 'GET',
    'path' => '/api/v2/definitions/certificateexemptreasons',
    'name' => 'List the certificate exempt reasons defined by a company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCertificateExemptReasons`.

Endpoint: GET /api/v2/definitions/certificateexemptreasons.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  129 =>
  [
    'operation' => 'ListCertificateExposureZones',
    'slug' => 'avalara_list_certificate_exposure_zones',
    'class' => 'AvalaraListCertificateExposureZones',
    'method' => 'GET',
    'path' => '/api/v2/definitions/certificateexposurezones',
    'name' => 'List certificate exposure zones used by a company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCertificateExposureZones`.

Endpoint: GET /api/v2/definitions/certificateexposurezones.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* id, companyId, name, tag, description, created, modified, region, country',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  130 =>
  [
    'operation' => 'ListClassificationParametersUsage',
    'slug' => 'avalara_list_classification_parameters_usage',
    'class' => 'AvalaraListClassificationParametersUsage',
    'method' => 'GET',
    'path' => '/api/v2/definitions/classification/parametersusage',
    'name' => 'Retrieve the full list of Avalara-supported usage of extra parameters for classification of a item.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListClassificationParametersUsage`.

Endpoint: GET /api/v2/definitions/classification/parametersusage.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* attributeSubType, values',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  131 =>
  [
    'operation' => 'ListCommunicationsServiceTypes',
    'slug' => 'avalara_list_communications_service_types',
    'class' => 'AvalaraListCommunicationsServiceTypes',
    'method' => 'GET',
    'path' => '/api/v2/definitions/communications/transactiontypes/{id}/servicetypes',
    'name' => 'Retrieve the full list of communications service types',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCommunicationsServiceTypes`.

Endpoint: GET /api/v2/definitions/communications/transactiontypes/{id}/servicetypes.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The transaction type ID to examine',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* requiredParameters',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  132 =>
  [
    'operation' => 'ListCommunicationsTSPairs',
    'slug' => 'avalara_list_communications_ts_pairs',
    'class' => 'AvalaraListCommunicationsTSPairs',
    'method' => 'GET',
    'path' => '/api/v2/definitions/communications/tspairs',
    'name' => 'Retrieve the full list of communications transaction/service type pairs',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCommunicationsTSPairs`.

Endpoint: GET /api/v2/definitions/communications/tspairs.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* requiredParameters',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  133 =>
  [
    'operation' => 'ListCommunicationsTransactionTypes',
    'slug' => 'avalara_list_communications_transaction_types',
    'class' => 'AvalaraListCommunicationsTransactionTypes',
    'method' => 'GET',
    'path' => '/api/v2/definitions/communications/transactiontypes',
    'name' => 'Retrieve the full list of communications transactiontypes',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCommunicationsTransactionTypes`.

Endpoint: GET /api/v2/definitions/communications/transactiontypes.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  134 =>
  [
    'operation' => 'ListCountries',
    'slug' => 'avalara_list_countries',
    'class' => 'AvalaraListCountries',
    'method' => 'GET',
    'path' => '/api/v2/definitions/countries',
    'name' => 'List all ISO 3166 countries',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCountries`.

Endpoint: GET /api/v2/definitions/countries.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* alpha3Code, isEuropeanUnion, localizedNames, addressesRequireRegion',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
      4 =>
      [
        'name' => '$scope',
        'param' => 'scope',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optional query parameter to filter by Custom or All countries (default: All]',
      ],
    ],
  ],
  135 =>
  [
    'operation' => 'ListCoverLetters',
    'slug' => 'avalara_list_cover_letters',
    'class' => 'AvalaraListCoverLetters',
    'method' => 'GET',
    'path' => '/api/v2/definitions/coverletters',
    'name' => 'List certificate exposure zones used by a company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCoverLetters`.

Endpoint: GET /api/v2/definitions/coverletters.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* id, companyId, subject, description, createdDate, modifiedDate, pageCount, templateFilename, version',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  136 =>
  [
    'operation' => 'ListCrossBorderCodes',
    'slug' => 'avalara_list_cross_border_codes',
    'class' => 'AvalaraListCrossBorderCodes',
    'method' => 'GET',
    'path' => '/api/v2/definitions/crossborder/{country}/{hsCode}',
    'name' => 'Lists the next level of HS Codes given a destination country and HS Code prefix.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCrossBorderCodes`.

Endpoint: GET /api/v2/definitions/crossborder/{country}/{hsCode}.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The name or code of the destination country.',
      ],
      1 =>
      [
        'name' => 'hsCode',
        'param' => 'hs_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The Section or partial HS Code for which you would like to view the next level of HS Code detail, if more detail is available.',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* hsCodeSource, system, destinationCountry, isDecisionNode, zeroPaddingCount, isSystemDefined, isTaxable, effDate, endDate, hsCodeSourceLength',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  137 =>
  [
    'operation' => 'ListCrossBorderSections',
    'slug' => 'avalara_list_cross_border_sections',
    'class' => 'AvalaraListCrossBorderSections',
    'method' => 'GET',
    'path' => '/api/v2/definitions/crossborder/sections',
    'name' => 'List top level HS Code Sections.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCrossBorderSections`.

Endpoint: GET /api/v2/definitions/crossborder/sections.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
    ],
  ],
  138 =>
  [
    'operation' => 'ListCurrencies',
    'slug' => 'avalara_list_currencies',
    'class' => 'AvalaraListCurrencies',
    'method' => 'GET',
    'path' => '/api/v2/definitions/currencies',
    'name' => 'List all ISO 4217 currencies supported by AvaTax.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCurrencies`.

Endpoint: GET /api/v2/definitions/currencies.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  139 =>
  [
    'operation' => 'ListEntityUseCodes',
    'slug' => 'avalara_list_entity_use_codes',
    'class' => 'AvalaraListEntityUseCodes',
    'method' => 'GET',
    'path' => '/api/v2/definitions/entityusecodes',
    'name' => 'Retrieve the full list of Avalara-supported entity use codes',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListEntityUseCodes`.

Endpoint: GET /api/v2/definitions/entityusecodes.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* validCountries',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  140 =>
  [
    'operation' => 'ListFilingFrequencies',
    'slug' => 'avalara_list_filing_frequencies',
    'class' => 'AvalaraListFilingFrequencies',
    'method' => 'GET',
    'path' => '/api/v2/definitions/filingfrequencies',
    'name' => 'Retrieve the full list of Avalara-supported filing frequencies.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListFilingFrequencies`.

Endpoint: GET /api/v2/definitions/filingfrequencies.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  141 =>
  [
    'operation' => 'ListItemHSCodeClassificationStatus',
    'slug' => 'avalara_list_item_hs_code_classification_status',
    'class' => 'AvalaraListItemHSCodeClassificationStatus',
    'method' => 'GET',
    'path' => '/api/v2/definitions/items/hscode-classification-status',
    'name' => 'List of all HS code classification statuses that can be assigned to an Item.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListItemHSCodeClassificationStatus`.

Endpoint: GET /api/v2/definitions/items/hscode-classification-status.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
    ],
  ],
  142 =>
  [
    'operation' => 'ListItemsRecommendationsStatus',
    'slug' => 'avalara_list_items_recommendations_status',
    'class' => 'AvalaraListItemsRecommendationsStatus',
    'method' => 'GET',
    'path' => '/api/v2/definitions/items/recommendationstatus',
    'name' => 'List of all recommendation status which can be assigned to an item',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListItemsRecommendationsStatus`.

Endpoint: GET /api/v2/definitions/items/recommendationstatus.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
    ],
  ],
  143 =>
  [
    'operation' => 'ListItemsStatus',
    'slug' => 'avalara_list_items_status',
    'class' => 'AvalaraListItemsStatus',
    'method' => 'GET',
    'path' => '/api/v2/definitions/items/status',
    'name' => 'List of all possible status which can be assigned to an item',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListItemsStatus`.

Endpoint: GET /api/v2/definitions/items/status.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
    ],
  ],
  144 =>
  [
    'operation' => 'ListJurisdictionTypesByRateTypeTaxTypeMapping',
    'slug' => 'avalara_list_jurisdiction_types_by_rate_type_tax_type_mapping',
    'class' => 'AvalaraListJurisdictionTypesByRateTypeTaxTypeMapping',
    'method' => 'GET',
    'path' => '/api/v2/definitions/jurisdictionTypes/countries/{country}/taxtypes/{taxTypeId}/taxsubtypes/{taxSubTypeId}',
    'name' => 'List jurisdiction types based on the provided taxTypeId, taxSubTypeId, country, and rateTypeId',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListJurisdictionTypesByRateTypeTaxTypeMapping`.

Endpoint: GET /api/v2/definitions/jurisdictionTypes/countries/{country}/taxtypes/{taxTypeId}/taxsubtypes/{taxSubTypeId}.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The country for which you want to retrieve the jurisdiction information',
      ],
      1 =>
      [
        'name' => 'taxTypeId',
        'param' => 'tax_type_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The taxtype for which you want to retrieve the jurisdiction information',
      ],
      2 =>
      [
        'name' => 'taxSubTypeId',
        'param' => 'tax_sub_type_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The taxsubtype for which you want to retrieve the jurisdiction information',
      ],
      3 =>
      [
        'name' => 'rateTypeId',
        'param' => 'rate_type_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The ratetype for which you want to retrieve the jurisdiction information',
      ],
      4 =>
      [
        'name' => '$includeCustomContent',
        'param' => 'include_custom_content',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Optional query parameter to include custom content jurisdiction types (default: false]',
      ],
    ],
  ],
  145 =>
  [
    'operation' => 'ListJurisdictions',
    'slug' => 'avalara_list_jurisdictions',
    'class' => 'AvalaraListJurisdictions',
    'method' => 'GET',
    'path' => '/api/v2/definitions/jurisdictions',
    'name' => 'List jurisdictions based on the filter provided',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListJurisdictions`.

Endpoint: GET /api/v2/definitions/jurisdictions.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* rate, salesRate, signatureCode, useRate, isAcm, isSst, createDate, isLocalAdmin, taxAuthorityTypeId',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  146 =>
  [
    'operation' => 'ListJurisdictionsByAddress',
    'slug' => 'avalara_list_jurisdictions_by_address',
    'class' => 'AvalaraListJurisdictionsByAddress',
    'method' => 'GET',
    'path' => '/api/v2/definitions/jurisdictionsnearaddress',
    'name' => 'List jurisdictions near a specific address',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListJurisdictionsByAddress`.

Endpoint: GET /api/v2/definitions/jurisdictionsnearaddress.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'line1',
        'param' => 'line1',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The first address line portion of this address.',
      ],
      1 =>
      [
        'name' => 'line2',
        'param' => 'line2',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The second address line portion of this address.',
      ],
      2 =>
      [
        'name' => 'line3',
        'param' => 'line3',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The third address line portion of this address.',
      ],
      3 =>
      [
        'name' => 'city',
        'param' => 'city',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The city portion of this address.',
      ],
      4 =>
      [
        'name' => 'region',
        'param' => 'region',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The region, state, or province code portion of this address.',
      ],
      5 =>
      [
        'name' => 'postalCode',
        'param' => 'postal_code',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The postal code or zip code portion of this address.',
      ],
      6 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The two-character ISO-3166 code of the country portion of this address.',
      ],
      7 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* country, Jurisdictions',
      ],
      8 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      9 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      10 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  147 =>
  [
    'operation' => 'ListJurisdictionsByRateTypeTaxTypeMapping',
    'slug' => 'avalara_list_jurisdictions_by_rate_type_tax_type_mapping',
    'class' => 'AvalaraListJurisdictionsByRateTypeTaxTypeMapping',
    'method' => 'GET',
    'path' => '/api/v2/definitions/jurisdictions/countries/{country}/taxtypes/{taxTypeId}/taxsubtypes/{taxSubTypeId}',
    'name' => 'List jurisdictions based on the provided taxTypeId, taxSubTypeId, country, and rateTypeId',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListJurisdictionsByRateTypeTaxTypeMapping`.

Endpoint: GET /api/v2/definitions/jurisdictions/countries/{country}/taxtypes/{taxTypeId}/taxsubtypes/{taxSubTypeId}.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The country for which you want to retrieve the jurisdiction information',
      ],
      1 =>
      [
        'name' => 'taxTypeId',
        'param' => 'tax_type_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The taxtype for which you want to retrieve the jurisdiction information',
      ],
      2 =>
      [
        'name' => 'taxSubTypeId',
        'param' => 'tax_sub_type_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The taxsubtype for which you want to retrieve the jurisdiction information',
      ],
      3 =>
      [
        'name' => 'rateTypeId',
        'param' => 'rate_type_id',
        'in' => 'query',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ratetype for which you want to retrieve the jurisdiction information',
      ],
      4 =>
      [
        'name' => 'region',
        'param' => 'region',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The region for which you want to retrieve the jurisdiction information',
      ],
      5 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* id, country, state, jurisdictionCode, longName, taxTypeId, taxSubTypeId, taxTypeGroupId, rateTypeId, stateFips',
      ],
      6 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      7 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      8 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
      9 =>
      [
        'name' => '$includeCustomContent',
        'param' => 'include_custom_content',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Optional query parameter to include custom content jurisdictions (default: false]',
      ],
    ],
  ],
  148 =>
  [
    'operation' => 'ListJurisdictionsHierarchy',
    'slug' => 'avalara_list_jurisdictions_hierarchy',
    'class' => 'AvalaraListJurisdictionsHierarchy',
    'method' => 'GET',
    'path' => '/api/v2/definitions/jurisdictions/hierarchy',
    'name' => 'List jurisdictions hierarchy based on the filter provided',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListJurisdictionsHierarchy`.

Endpoint: GET /api/v2/definitions/jurisdictions/hierarchy.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* parentId, nexus, rate, salesRate, signatureCode, useRate, isAcm, isSst, createDate, isLocalAdmin, taxAuthorityTypeId',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  149 =>
  [
    'operation' => 'ListLocationQuestionsByAddress',
    'slug' => 'avalara_list_location_questions_by_address',
    'class' => 'AvalaraListLocationQuestionsByAddress',
    'method' => 'GET',
    'path' => '/api/v2/definitions/locationquestions',
    'name' => 'Retrieve the list of questions that are required for a tax location',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListLocationQuestionsByAddress`.

Endpoint: GET /api/v2/definitions/locationquestions.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'line1',
        'param' => 'line1',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The first line of this location\'s address.',
      ],
      1 =>
      [
        'name' => 'line2',
        'param' => 'line2',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The second line of this location\'s address.',
      ],
      2 =>
      [
        'name' => 'line3',
        'param' => 'line3',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The third line of this location\'s address.',
      ],
      3 =>
      [
        'name' => 'city',
        'param' => 'city',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The city part of this location\'s address.',
      ],
      4 =>
      [
        'name' => 'region',
        'param' => 'region',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The region, state, or province part of this location\'s address.',
      ],
      5 =>
      [
        'name' => 'postalCode',
        'param' => 'postal_code',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The postal code of this location\'s address.',
      ],
      6 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The country part of this location\'s address.',
      ],
      7 =>
      [
        'name' => 'latitude',
        'param' => 'latitude',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Optionally identify the location via latitude/longitude instead of via address.',
      ],
      8 =>
      [
        'name' => 'longitude',
        'param' => 'longitude',
        'in' => 'query',
        'type' => 'number',
        'required' => false,
        'description' => 'Optionally identify the location via latitude/longitude instead of via address.',
      ],
      9 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      10 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      11 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      12 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  150 =>
  [
    'operation' => 'ListMarketplaceLocations',
    'slug' => 'avalara_list_marketplace_locations',
    'class' => 'AvalaraListMarketplaceLocations',
    'method' => 'GET',
    'path' => '/api/v2/definitions/marketplacelocations',
    'name' => 'Retrieve the list of locations for a marketplace.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListMarketplaceLocations`.

Endpoint: GET /api/v2/definitions/marketplacelocations.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'marketplaceId',
        'param' => 'marketplace_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'MarketplaceId of a marketplace',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  151 =>
  [
    'operation' => 'ListNexus',
    'slug' => 'avalara_list_nexus',
    'class' => 'AvalaraListNexus',
    'method' => 'GET',
    'path' => '/api/v2/definitions/nexus',
    'name' => 'Retrieve the full list of Avalara-supported nexus for all countries and regions.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNexus`.

Endpoint: GET /api/v2/definitions/nexus.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* streamlinedSalesTax, isSSTActive, taxTypeGroup, taxAuthorityId, taxName, parameters',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  152 =>
  [
    'operation' => 'ListNexusByAddress',
    'slug' => 'avalara_list_nexus_by_address',
    'class' => 'AvalaraListNexusByAddress',
    'method' => 'GET',
    'path' => '/api/v2/definitions/nexus/byaddress',
    'name' => 'List all nexus that apply to a specific address.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNexusByAddress`.

Endpoint: GET /api/v2/definitions/nexus/byaddress.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'line1',
        'param' => 'line1',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The first address line portion of this address.',
      ],
      1 =>
      [
        'name' => 'line2',
        'param' => 'line2',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The first address line portion of this address.',
      ],
      2 =>
      [
        'name' => 'line3',
        'param' => 'line3',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The first address line portion of this address.',
      ],
      3 =>
      [
        'name' => 'city',
        'param' => 'city',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The city portion of this address.',
      ],
      4 =>
      [
        'name' => 'region',
        'param' => 'region',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Name or ISO 3166 code identifying the region portion of the address. This field supports many different region identifiers: * Two and three character ISO 3166 region codes * Fully spelled out names of the region in ISO supported languages * Common alternative spellings for many regions For a full list of all supported codes and names, please see the Definitions API `ListRegions`.',
      ],
      5 =>
      [
        'name' => 'postalCode',
        'param' => 'postal_code',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The postal code or zip code portion of this address.',
      ],
      6 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Name or ISO 3166 code identifying the country portion of this address. This field supports many different country identifiers: * Two character ISO 3166 codes * Three character ISO 3166 codes * Fully spelled out names of the country in ISO supported languages * Common alternative spellings for many countries For a full list of all supported codes and names, please see the Definitions API `ListCountries`.',
      ],
      7 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* streamlinedSalesTax, isSSTActive, taxTypeGroup, taxAuthorityId, taxName, parameters',
      ],
      8 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      9 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      10 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  153 =>
  [
    'operation' => 'ListNexusByCountry',
    'slug' => 'avalara_list_nexus_by_country',
    'class' => 'AvalaraListNexusByCountry',
    'method' => 'GET',
    'path' => '/api/v2/definitions/nexus/{country}',
    'name' => 'Retrieve the full list of Avalara-supported nexus for a country.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNexusByCountry`.

Endpoint: GET /api/v2/definitions/nexus/{country}.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The country in which you want to fetch the system nexus',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* streamlinedSalesTax, isSSTActive, taxTypeGroup, taxAuthorityId, taxName, parameters',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  154 =>
  [
    'operation' => 'ListNexusByCountryAndRegion',
    'slug' => 'avalara_list_nexus_by_country_and_region',
    'class' => 'AvalaraListNexusByCountryAndRegion',
    'method' => 'GET',
    'path' => '/api/v2/definitions/nexus/{country}/{region}',
    'name' => 'Retrieve the full list of Avalara-supported nexus for a country and region.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNexusByCountryAndRegion`.

Endpoint: GET /api/v2/definitions/nexus/{country}/{region}.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The two-character ISO-3166 code for the country.',
      ],
      1 =>
      [
        'name' => 'region',
        'param' => 'region',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The two or three character region code for the region.',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* streamlinedSalesTax, isSSTActive, taxTypeGroup, taxAuthorityId, taxName, parameters',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  155 =>
  [
    'operation' => 'ListNexusByFormCode',
    'slug' => 'avalara_list_nexus_by_form_code',
    'class' => 'AvalaraListNexusByFormCode',
    'method' => 'GET',
    'path' => '/api/v2/definitions/nexus/byform/{formCode}',
    'name' => 'List nexus related to a tax form',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNexusByFormCode`.

Endpoint: GET /api/v2/definitions/nexus/byform/{formCode}.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'formCode',
        'param' => 'form_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The form code that we are looking up the nexus for',
      ],
    ],
  ],
  156 =>
  [
    'operation' => 'ListNexusByTaxTypeGroup',
    'slug' => 'avalara_list_nexus_by_tax_type_group',
    'class' => 'AvalaraListNexusByTaxTypeGroup',
    'method' => 'GET',
    'path' => '/api/v2/definitions/nexus/bytaxtypegroup/{taxTypeGroup}',
    'name' => 'Retrieve the full list of Avalara-supported nexus for a tax type group.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNexusByTaxTypeGroup`.

Endpoint: GET /api/v2/definitions/nexus/bytaxtypegroup/{taxTypeGroup}.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'taxTypeGroup',
        'param' => 'tax_type_group',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The tax type group to fetch the supporting system nexus for.',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* streamlinedSalesTax, isSSTActive, taxTypeGroup, taxAuthorityId, taxName, parameters',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  157 =>
  [
    'operation' => 'ListNexusTaxTypeGroups',
    'slug' => 'avalara_list_nexus_tax_type_groups',
    'class' => 'AvalaraListNexusTaxTypeGroups',
    'method' => 'GET',
    'path' => '/api/v2/definitions/nexustaxtypegroups',
    'name' => 'Retrieve the full list of nexus tax type groups',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNexusTaxTypeGroups`.

Endpoint: GET /api/v2/definitions/nexustaxtypegroups.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* subscriptionTypeId, subscriptionDescription, tabName, showColumn',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  158 =>
  [
    'operation' => 'ListNoticeCustomerFundingOptions',
    'slug' => 'avalara_list_notice_customer_funding_options',
    'class' => 'AvalaraListNoticeCustomerFundingOptions',
    'method' => 'GET',
    'path' => '/api/v2/definitions/noticecustomerfundingoptions',
    'name' => 'Retrieve the full list of Avalara-supported tax notice customer funding options.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNoticeCustomerFundingOptions`.

Endpoint: GET /api/v2/definitions/noticecustomerfundingoptions.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* activeFlag, sortOrder',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  159 =>
  [
    'operation' => 'ListNoticeCustomerTypes',
    'slug' => 'avalara_list_notice_customer_types',
    'class' => 'AvalaraListNoticeCustomerTypes',
    'method' => 'GET',
    'path' => '/api/v2/definitions/noticecustomertypes',
    'name' => 'Retrieve the full list of Avalara-supported tax notice customer types.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNoticeCustomerTypes`.

Endpoint: GET /api/v2/definitions/noticecustomertypes.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* activeFlag, sortOrder',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  160 =>
  [
    'operation' => 'ListNoticeFilingtypes',
    'slug' => 'avalara_list_notice_filingtypes',
    'class' => 'AvalaraListNoticeFilingtypes',
    'method' => 'GET',
    'path' => '/api/v2/definitions/noticefilingtypes',
    'name' => 'Retrieve the full list of Avalara-supported tax notice filing types.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNoticeFilingtypes`.

Endpoint: GET /api/v2/definitions/noticefilingtypes.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* description, activeFlag, sortOrder',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  161 =>
  [
    'operation' => 'ListNoticePriorities',
    'slug' => 'avalara_list_notice_priorities',
    'class' => 'AvalaraListNoticePriorities',
    'method' => 'GET',
    'path' => '/api/v2/definitions/noticepriorities',
    'name' => 'Retrieve the full list of Avalara-supported tax notice priorities.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNoticePriorities`.

Endpoint: GET /api/v2/definitions/noticepriorities.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* activeFlag, sortOrder',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  162 =>
  [
    'operation' => 'ListNoticeReasons',
    'slug' => 'avalara_list_notice_reasons',
    'class' => 'AvalaraListNoticeReasons',
    'method' => 'GET',
    'path' => '/api/v2/definitions/noticereasons',
    'name' => 'Retrieve the full list of Avalara-supported tax notice reasons.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNoticeReasons`.

Endpoint: GET /api/v2/definitions/noticereasons.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* description, activeFlag, sortOrder',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  163 =>
  [
    'operation' => 'ListNoticeResponsibilities',
    'slug' => 'avalara_list_notice_responsibilities',
    'class' => 'AvalaraListNoticeResponsibilities',
    'method' => 'GET',
    'path' => '/api/v2/definitions/noticeresponsibilities',
    'name' => 'Retrieve the full list of Avalara-supported tax notice responsibility ids',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNoticeResponsibilities`.

Endpoint: GET /api/v2/definitions/noticeresponsibilities.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* sortOrder',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  164 =>
  [
    'operation' => 'ListNoticeRootCauses',
    'slug' => 'avalara_list_notice_root_causes',
    'class' => 'AvalaraListNoticeRootCauses',
    'method' => 'GET',
    'path' => '/api/v2/definitions/noticerootcauses',
    'name' => 'Retrieve the full list of Avalara-supported tax notice root causes',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNoticeRootCauses`.

Endpoint: GET /api/v2/definitions/noticerootcauses.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* sortOrder',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  165 =>
  [
    'operation' => 'ListNoticeStatuses',
    'slug' => 'avalara_list_notice_statuses',
    'class' => 'AvalaraListNoticeStatuses',
    'method' => 'GET',
    'path' => '/api/v2/definitions/noticestatuses',
    'name' => 'Retrieve the full list of Avalara-supported tax notice statuses.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNoticeStatuses`.

Endpoint: GET /api/v2/definitions/noticestatuses.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* isOpen, sortOrder, activeFlag',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  166 =>
  [
    'operation' => 'ListNoticeTypes',
    'slug' => 'avalara_list_notice_types',
    'class' => 'AvalaraListNoticeTypes',
    'method' => 'GET',
    'path' => '/api/v2/definitions/noticetypes',
    'name' => 'Retrieve the full list of Avalara-supported tax notice types.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNoticeTypes`.

Endpoint: GET /api/v2/definitions/noticetypes.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* activeFlag, sortOrder',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  167 =>
  [
    'operation' => 'ListParameters',
    'slug' => 'avalara_list_parameters',
    'class' => 'AvalaraListParameters',
    'method' => 'GET',
    'path' => '/api/v2/definitions/parameters',
    'name' => 'Retrieve the full list of Avalara-supported extra parameters for creating transactions.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListParameters`.

Endpoint: GET /api/v2/definitions/parameters.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* serviceTypes, regularExpression, attributeSubType, values',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  168 =>
  [
    'operation' => 'ListParametersByAccount',
    'slug' => 'avalara_list_parameters_by_account',
    'class' => 'AvalaraListParametersByAccount',
    'method' => 'GET',
    'path' => '/api/v2/definitions/accounts/{accountId}/parameters',
    'name' => 'Retrieve the list of Avalara-supported parameters based on account subscriptions.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListParametersByAccount`.

Endpoint: GET /api/v2/definitions/accounts/{accountId}/parameters.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'accountId',
        'param' => 'account_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account to retrieve the parameters.',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* serviceTypes, regularExpression, attributeSubType, values',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  169 =>
  [
    'operation' => 'ListParametersByItem',
    'slug' => 'avalara_list_parameters_by_item',
    'class' => 'AvalaraListParametersByItem',
    'method' => 'GET',
    'path' => '/api/v2/definitions/parameters/byitem/{companyCode}/{itemCode}',
    'name' => 'Retrieve the parameters by companyCode and itemCode.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListParametersByItem`.

Endpoint: GET /api/v2/definitions/parameters/byitem/{companyCode}/{itemCode}.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Company code.',
      ],
      1 =>
      [
        'name' => 'itemCode',
        'param' => 'item_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Item code.',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* serviceTypes, regularExpression, attributeSubType, values',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  170 =>
  [
    'operation' => 'ListParametersUsage',
    'slug' => 'avalara_list_parameters_usage',
    'class' => 'AvalaraListParametersUsage',
    'method' => 'GET',
    'path' => '/api/v2/definitions/parametersusage',
    'name' => 'Retrieve the full list of Avalara-supported usage of extra parameters for creating transactions.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListParametersUsage`.

Endpoint: GET /api/v2/definitions/parametersusage.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* attributeSubType, values, valueDescriptions',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  171 =>
  [
    'operation' => 'ListPermissions',
    'slug' => 'avalara_list_permissions',
    'class' => 'AvalaraListPermissions',
    'method' => 'GET',
    'path' => '/api/v2/definitions/permissions',
    'name' => 'Retrieve the full list of Avalara-supported permissions',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListPermissions`.

Endpoint: GET /api/v2/definitions/permissions.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      1 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
    ],
  ],
  172 =>
  [
    'operation' => 'ListPostalCodes',
    'slug' => 'avalara_list_postal_codes',
    'class' => 'AvalaraListPostalCodes',
    'method' => 'GET',
    'path' => '/api/v2/definitions/postalcodes',
    'name' => 'Retrieve the full list of Avalara-supported postal codes.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListPostalCodes`.

Endpoint: GET /api/v2/definitions/postalcodes.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
      4 =>
      [
        'name' => 'includeExpiredPostalCodes',
        'param' => 'include_expired_postal_codes',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If set to true, returns expired postal codes. Defaults to false',
      ],
    ],
  ],
  173 =>
  [
    'operation' => 'ListPreferredPrograms',
    'slug' => 'avalara_list_preferred_programs',
    'class' => 'AvalaraListPreferredPrograms',
    'method' => 'GET',
    'path' => '/api/v2/definitions/preferredprograms',
    'name' => 'List all customs duty programs recognized by AvaTax',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListPreferredPrograms`.

Endpoint: GET /api/v2/definitions/preferredprograms.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* effectiveDate, endDate',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  174 =>
  [
    'operation' => 'ListProductClassificationSystems',
    'slug' => 'avalara_list_product_classification_systems',
    'class' => 'AvalaraListProductClassificationSystems',
    'method' => 'GET',
    'path' => '/api/v2/definitions/productclassificationsystems',
    'name' => 'List all available product classification systems.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListProductClassificationSystems`.

Endpoint: GET /api/v2/definitions/productclassificationsystems.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* countries',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
      4 =>
      [
        'name' => '$countryCode',
        'param' => 'country_code',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'If not null, return all records with this code.',
      ],
    ],
  ],
  175 =>
  [
    'operation' => 'ListProductClassificationSystemsByCompany',
    'slug' => 'avalara_list_product_classification_systems_by_company',
    'class' => 'AvalaraListProductClassificationSystemsByCompany',
    'method' => 'GET',
    'path' => '/api/v2/definitions/productclassificationsystems/bycompany/{companyCode}',
    'name' => 'List all product classification systems available to a company based on its nexus.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListProductClassificationSystemsByCompany`.

Endpoint: GET /api/v2/definitions/productclassificationsystems/bycompany/{companyCode}.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The company code.',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* countries',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
      5 =>
      [
        'name' => '$countryCode',
        'param' => 'country_code',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'If not null, return all records with this code.',
      ],
    ],
  ],
  176 =>
  [
    'operation' => 'ListRateTypesByCountry',
    'slug' => 'avalara_list_rate_types_by_country',
    'class' => 'AvalaraListRateTypesByCountry',
    'method' => 'GET',
    'path' => '/api/v2/definitions/countries/{country}/ratetypes',
    'name' => 'Retrieve the full list of rate types for each country',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListRateTypesByCountry`.

Endpoint: GET /api/v2/definitions/countries/{country}/ratetypes.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The country to examine for rate types',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* country',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  177 =>
  [
    'operation' => 'ListRateTypesByCountryTaxTypeTaxSubType',
    'slug' => 'avalara_list_rate_types_by_country_tax_type_tax_sub_type',
    'class' => 'AvalaraListRateTypesByCountryTaxTypeTaxSubType',
    'method' => 'GET',
    'path' => '/api/v2/definitions/countries/{country}/taxtypes/{taxTypeId}/taxsubtypes/{taxSubTypeId}/ratetypes',
    'name' => 'Retrieve the list of rate types by country, TaxType and by TaxSubType',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListRateTypesByCountryTaxTypeTaxSubType`.

Endpoint: GET /api/v2/definitions/countries/{country}/taxtypes/{taxTypeId}/taxsubtypes/{taxSubTypeId}/ratetypes.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The country to examine for rate types',
      ],
      1 =>
      [
        'name' => 'taxTypeId',
        'param' => 'tax_type_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The taxType for the country to examine for rate types',
      ],
      2 =>
      [
        'name' => 'taxSubTypeId',
        'param' => 'tax_sub_type_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The taxSubType for the country and taxType to examine for rate types',
      ],
      3 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* id, rateType, description',
      ],
      4 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      5 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      6 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
      7 =>
      [
        'name' => '$includeCustomContent',
        'param' => 'include_custom_content',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Optional query parameter to include custom content rate types (default: false]',
      ],
    ],
  ],
  178 =>
  [
    'operation' => 'ListRegions',
    'slug' => 'avalara_list_regions',
    'class' => 'AvalaraListRegions',
    'method' => 'GET',
    'path' => '/api/v2/definitions/regions',
    'name' => 'List all ISO 3166 regions',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListRegions`.

Endpoint: GET /api/v2/definitions/regions.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* localizedNames',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  179 =>
  [
    'operation' => 'ListRegionsByCountry',
    'slug' => 'avalara_list_regions_by_country',
    'class' => 'AvalaraListRegionsByCountry',
    'method' => 'GET',
    'path' => '/api/v2/definitions/countries/{country}/regions',
    'name' => 'List all ISO 3166 regions for a country',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListRegionsByCountry`.

Endpoint: GET /api/v2/definitions/countries/{country}/regions.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The country of which you want to fetch ISO 3166 regions',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* localizedNames',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  180 =>
  [
    'operation' => 'ListRegionsByCountryAndTaxTypeAndTaxSubTypeAndRateType',
    'slug' => 'avalara_list_regions_by_country_and_tax_type_and_tax_sub_type_and_rate_type',
    'class' => 'AvalaraListRegionsByCountryAndTaxTypeAndTaxSubTypeAndRateType',
    'method' => 'GET',
    'path' => '/api/v2/definitions/companies/{companyId}/countries/{country}/regions/taxtypes/{taxTypeId}/taxsubtypes/{taxSubTypeId}/rateTypeId/{rateTypeId}/jurisdictionTypeId/{jurisdictionTypeId}',
    'name' => 'Retrieve the list of applicable regions by country tax type, tax sub type, and rate type for a given JurisdictionTypeId',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListRegionsByCountryAndTaxTypeAndTaxSubTypeAndRateType`.

Endpoint: GET /api/v2/definitions/companies/{companyId}/countries/{country}/regions/taxtypes/{taxTypeId}/taxsubtypes/{taxSubTypeId}/rateTypeId/{rateTypeId}/jurisdictionTypeId/{jurisdictionTypeId}.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company for which you want to retrieve the applicable regions',
      ],
      1 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The country for which you want to retrieve the regions',
      ],
      2 =>
      [
        'name' => 'taxTypeId',
        'param' => 'tax_type_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The taxTypeId for which you want to retrieve the regions. Example values include Autimotive, tires, Lodging, S, U, I, O, All, etc. Run the "/api/v2/definitions/taxtypes/countries/{country}?companyId=" endpoint for a list of taxTypeId values.',
      ],
      3 =>
      [
        'name' => 'taxSubTypeId',
        'param' => 'tax_sub_type_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The taxSubType for which you want to retrieve the regions. Example values include Accommodations, BikeTax, IGST, S, U, All, etc. Run the "api/v2/definitions/taxsubtypes" endpoint for a list of taxSubTypes values.',
      ],
      4 =>
      [
        'name' => 'rateTypeId',
        'param' => 'rate_type_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The rateTypeId for which you want to retrieve the regions. Note: The rateTypeId is an integer. Run the "/api/v2/definitions/countries/{country}/taxtypes/{taxTypeId}/taxsubtypes/{taxSubTypeId}/ratetypes" endpoint for a list of rateTypeId values."',
      ],
      5 =>
      [
        'name' => 'jurisdictionTypeId',
        'param' => 'jurisdiction_type_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The JurisdictionTypeId for which you want to retrieve the regions. This is a three-character string. Accepted values are ```CNT``` (country], ```STA``` (state], ```CTY``` (county], ```CIT``` (city], or ```STJ``` (special jurisdiction].',
      ],
      6 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      7 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      8 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
      9 =>
      [
        'name' => '$scope',
        'param' => 'scope',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optional query parameter to filter system, custom content or all regions (default: System]',
      ],
    ],
  ],
  181 =>
  [
    'operation' => 'ListReturnsParametersUsage',
    'slug' => 'avalara_list_returns_parameters_usage',
    'class' => 'AvalaraListReturnsParametersUsage',
    'method' => 'GET',
    'path' => '/api/v2/definitions/returns/parametersusage',
    'name' => 'Retrieve the full list of Avalara-supported usage of parameters used for returns.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListReturnsParametersUsage`.

Endpoint: GET /api/v2/definitions/returns/parametersusage.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* attributeSubType, values',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  182 =>
  [
    'operation' => 'ListSecurityRoles',
    'slug' => 'avalara_list_security_roles',
    'class' => 'AvalaraListSecurityRoles',
    'method' => 'GET',
    'path' => '/api/v2/definitions/securityroles',
    'name' => 'Retrieve the full list of Avalara-supported permissions',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListSecurityRoles`.

Endpoint: GET /api/v2/definitions/securityroles.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  183 =>
  [
    'operation' => 'ListSubscriptionTypes',
    'slug' => 'avalara_list_subscription_types',
    'class' => 'AvalaraListSubscriptionTypes',
    'method' => 'GET',
    'path' => '/api/v2/definitions/subscriptiontypes',
    'name' => 'Retrieve the full list of Avalara-supported subscription types',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListSubscriptionTypes`.

Endpoint: GET /api/v2/definitions/subscriptiontypes.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* system, taxTypeGroupIdSK',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  184 =>
  [
    'operation' => 'ListTags',
    'slug' => 'avalara_list_tags',
    'class' => 'AvalaraListTags',
    'method' => 'GET',
    'path' => '/api/v2/definitions/tags',
    'name' => 'Retrieve the list all tags supported by avalara',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListTags`.

Endpoint: GET /api/v2/definitions/tags.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  185 =>
  [
    'operation' => 'ListTaxAuthorities',
    'slug' => 'avalara_list_tax_authorities',
    'class' => 'AvalaraListTaxAuthorities',
    'method' => 'GET',
    'path' => '/api/v2/definitions/taxauthorities',
    'name' => 'Retrieve the full list of Avalara-supported tax authorities.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListTaxAuthorities`.

Endpoint: GET /api/v2/definitions/taxauthorities.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  186 =>
  [
    'operation' => 'ListTaxAuthorityForms',
    'slug' => 'avalara_list_tax_authority_forms',
    'class' => 'AvalaraListTaxAuthorityForms',
    'method' => 'GET',
    'path' => '/api/v2/definitions/taxauthorityforms',
    'name' => 'Retrieve the full list of Avalara-supported forms for each tax authority.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListTaxAuthorityForms`.

Endpoint: GET /api/v2/definitions/taxauthorityforms.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  187 =>
  [
    'operation' => 'ListTaxAuthorityTypes',
    'slug' => 'avalara_list_tax_authority_types',
    'class' => 'AvalaraListTaxAuthorityTypes',
    'method' => 'GET',
    'path' => '/api/v2/definitions/taxauthoritytypes',
    'name' => 'Retrieve the full list of Avalara-supported tax authority types.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListTaxAuthorityTypes`.

Endpoint: GET /api/v2/definitions/taxauthoritytypes.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  188 =>
  [
    'operation' => 'ListTaxCodeTypes',
    'slug' => 'avalara_list_tax_code_types',
    'class' => 'AvalaraListTaxCodeTypes',
    'method' => 'GET',
    'path' => '/api/v2/definitions/taxcodetypes',
    'name' => 'Retrieve the full list of Avalara-supported tax code types.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListTaxCodeTypes`.

Endpoint: GET /api/v2/definitions/taxcodetypes.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      1 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
    ],
  ],
  189 =>
  [
    'operation' => 'ListTaxCodes',
    'slug' => 'avalara_list_tax_codes',
    'class' => 'AvalaraListTaxCodes',
    'method' => 'GET',
    'path' => '/api/v2/definitions/taxcodes',
    'name' => 'Retrieve the full list of Avalara-supported tax codes.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListTaxCodes`.

Endpoint: GET /api/v2/definitions/taxcodes.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  190 =>
  [
    'operation' => 'ListTaxForms',
    'slug' => 'avalara_list_tax_forms',
    'class' => 'AvalaraListTaxForms',
    'method' => 'GET',
    'path' => '/api/v2/definitions/taxforms',
    'name' => 'Retrieve the full list of the Tax Forms available',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListTaxForms`.

Endpoint: GET /api/v2/definitions/taxforms.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  191 =>
  [
    'operation' => 'ListTaxSubTypes',
    'slug' => 'avalara_list_tax_sub_types',
    'class' => 'AvalaraListTaxSubTypes',
    'method' => 'GET',
    'path' => '/api/v2/definitions/taxsubtypes',
    'name' => 'Retrieve the full list of tax sub types',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListTaxSubTypes`.

Endpoint: GET /api/v2/definitions/taxsubtypes.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  192 =>
  [
    'operation' => 'ListTaxSubTypesByCountryAndTaxType',
    'slug' => 'avalara_list_tax_sub_types_by_country_and_tax_type',
    'class' => 'AvalaraListTaxSubTypesByCountryAndTaxType',
    'method' => 'GET',
    'path' => '/api/v2/definitions/taxsubtypes/countries/{country}/taxtypes/{taxTypeId}',
    'name' => 'Retrieve the full list of tax sub types by Country and TaxType',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListTaxSubTypesByCountryAndTaxType`.

Endpoint: GET /api/v2/definitions/taxsubtypes/countries/{country}/taxtypes/{taxTypeId}.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The country to examine for taxsubtype',
      ],
      1 =>
      [
        'name' => 'taxTypeId',
        'param' => 'tax_type_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The taxType for the country to examine for taxsubtype',
      ],
      2 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'query',
        'type' => 'integer',
        'required' => true,
        'description' => 'Id of the company the user wish to fetch the applicable tax sub types',
      ],
      3 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      4 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      5 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      6 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
      7 =>
      [
        'name' => '$scope',
        'param' => 'scope',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optional query parameter to filter by System, Custom or All tax sub types (default: System]',
      ],
    ],
  ],
  193 =>
  [
    'operation' => 'ListTaxSubTypesByJurisdictionAndRegion',
    'slug' => 'avalara_list_tax_sub_types_by_jurisdiction_and_region',
    'class' => 'AvalaraListTaxSubTypesByJurisdictionAndRegion',
    'method' => 'GET',
    'path' => '/api/v2/definitions/taxsubtypes/{jurisdictionCode}/{region}',
    'name' => 'Retrieve the full list of tax sub types by jurisdiction code and region',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListTaxSubTypesByJurisdictionAndRegion`.

Endpoint: GET /api/v2/definitions/taxsubtypes/{jurisdictionCode}/{region}.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'jurisdictionCode',
        'param' => 'jurisdiction_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The jurisdiction code of the tax sub type.',
      ],
      1 =>
      [
        'name' => 'region',
        'param' => 'region',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The region of the tax sub type.',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  194 =>
  [
    'operation' => 'ListTaxTypeGroups',
    'slug' => 'avalara_list_tax_type_groups',
    'class' => 'AvalaraListTaxTypeGroups',
    'method' => 'GET',
    'path' => '/api/v2/definitions/taxtypegroups',
    'name' => 'Retrieve the full list of tax type groups',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListTaxTypeGroups`.

Endpoint: GET /api/v2/definitions/taxtypegroups.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* subscriptionTypeId, subscriptionDescription, tabName, showColumn, displaySequence',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  195 =>
  [
    'operation' => 'ListTaxTypesByNexusAndCountry',
    'slug' => 'avalara_list_tax_types_by_nexus_and_country',
    'class' => 'AvalaraListTaxTypesByNexusAndCountry',
    'method' => 'GET',
    'path' => '/api/v2/definitions/taxtypes/countries/{country}',
    'name' => 'Retrieve the list of applicable TaxTypes',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListTaxTypesByNexusAndCountry`.

Endpoint: GET /api/v2/definitions/taxtypes/countries/{country}.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The country for which you want to retrieve the unitofbasis information',
      ],
      1 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'query',
        'type' => 'integer',
        'required' => true,
        'description' => 'Your companyId to retrieve the applicable taxtypes',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
      5 =>
      [
        'name' => '$scope',
        'param' => 'scope',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optional query parameter to filter by System, Custom or All tax types (default: System]',
      ],
    ],
  ],
  196 =>
  [
    'operation' => 'ListUnitOfBasisByCountryAndTaxTypeAndTaxSubTypeAndRateType',
    'slug' => 'avalara_list_unit_of_basis_by_country_and_tax_type_and_tax_sub_type_and_rate_type',
    'class' => 'AvalaraListUnitOfBasisByCountryAndTaxTypeAndTaxSubTypeAndRateType',
    'method' => 'GET',
    'path' => '/api/v2/definitions/unitofbasis/countries/{country}/taxtypes/{taxTypeId}/taxsubtypes/{taxSubTypeId}',
    'name' => 'Retrieve the list of applicable UnitOfBasis',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListUnitOfBasisByCountryAndTaxTypeAndTaxSubTypeAndRateType`.

Endpoint: GET /api/v2/definitions/unitofbasis/countries/{country}/taxtypes/{taxTypeId}/taxsubtypes/{taxSubTypeId}.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The country for which you want to retrieve the unitofbasis information',
      ],
      1 =>
      [
        'name' => 'taxTypeId',
        'param' => 'tax_type_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The taxtype for which you want to retrieve the unitofbasis information',
      ],
      2 =>
      [
        'name' => 'taxSubTypeId',
        'param' => 'tax_sub_type_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The taxsubtype for which you want to retrieve the unitofbasis information',
      ],
      3 =>
      [
        'name' => 'rateTypeId',
        'param' => 'rate_type_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The ratetype for which you want to retrieve the unitofbasis information',
      ],
      4 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      5 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      6 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  197 =>
  [
    'operation' => 'ListUnitOfMeasurement',
    'slug' => 'avalara_list_unit_of_measurement',
    'class' => 'AvalaraListUnitOfMeasurement',
    'method' => 'GET',
    'path' => '/api/v2/definitions/unitofmeasurements',
    'name' => 'List all defined units of measurement',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListUnitOfMeasurement`.

Endpoint: GET /api/v2/definitions/unitofmeasurements.',
    'type' => 'read',
    'tag' => 'Definitions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* id',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  198 =>
  [
    'operation' => 'CreateDistanceThreshold',
    'slug' => 'avalara_create_distance_threshold',
    'class' => 'AvalaraCreateDistanceThreshold',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/distancethresholds',
    'name' => 'Create one or more DistanceThreshold objects',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateDistanceThreshold`.

Endpoint: POST /api/v2/companies/{companyId}/distancethresholds.',
    'type' => 'write',
    'tag' => 'DistanceThresholds',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that owns this DistanceThreshold',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The DistanceThreshold object or objects you wish to create.',
      ],
    ],
  ],
  199 =>
  [
    'operation' => 'DeleteDistanceThreshold',
    'slug' => 'avalara_delete_distance_threshold',
    'class' => 'AvalaraDeleteDistanceThreshold',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/distancethresholds/{id}',
    'name' => 'Delete a single DistanceThreshold object',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteDistanceThreshold`.

Endpoint: DELETE /api/v2/companies/{companyId}/distancethresholds/{id}.',
    'type' => 'write',
    'tag' => 'DistanceThresholds',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that owns this DistanceThreshold',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the DistanceThreshold object you wish to delete.',
      ],
    ],
  ],
  200 =>
  [
    'operation' => 'GetDistanceThreshold',
    'slug' => 'avalara_get_distance_threshold',
    'class' => 'AvalaraGetDistanceThreshold',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/distancethresholds/{id}',
    'name' => 'Retrieve a single DistanceThreshold',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetDistanceThreshold`.

Endpoint: GET /api/v2/companies/{companyId}/distancethresholds/{id}.',
    'type' => 'read',
    'tag' => 'DistanceThresholds',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this DistanceThreshold object',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number referring to this DistanceThreshold object',
      ],
    ],
  ],
  201 =>
  [
    'operation' => 'ListDistanceThresholds',
    'slug' => 'avalara_list_distance_thresholds',
    'class' => 'AvalaraListDistanceThresholds',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/distancethresholds',
    'name' => 'Retrieve all DistanceThresholds for this company.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListDistanceThresholds`.

Endpoint: GET /api/v2/companies/{companyId}/distancethresholds.',
    'type' => 'read',
    'tag' => 'DistanceThresholds',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company whose DistanceThreshold objects you wish to list.',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  202 =>
  [
    'operation' => 'QueryDistanceThresholds',
    'slug' => 'avalara_query_distance_thresholds',
    'class' => 'AvalaraQueryDistanceThresholds',
    'method' => 'GET',
    'path' => '/api/v2/distancethresholds',
    'name' => 'Retrieve all DistanceThreshold objects',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryDistanceThresholds`.

Endpoint: GET /api/v2/distancethresholds.',
    'type' => 'read',
    'tag' => 'DistanceThresholds',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  203 =>
  [
    'operation' => 'UpdateDistanceThreshold',
    'slug' => 'avalara_update_distance_threshold',
    'class' => 'AvalaraUpdateDistanceThreshold',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/distancethresholds/{id}',
    'name' => 'Update a DistanceThreshold object',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateDistanceThreshold`.

Endpoint: PUT /api/v2/companies/{companyId}/distancethresholds/{id}.',
    'type' => 'write',
    'tag' => 'DistanceThresholds',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that owns this DistanceThreshold object.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the DistanceThreshold object to replace.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The new DistanceThreshold object to store.',
      ],
    ],
  ],
  204 =>
  [
    'operation' => 'CreateDcv',
    'slug' => 'avalara_create_dcv',
    'class' => 'AvalaraCreateDcv',
    'method' => 'POST',
    'path' => '/api/v2/domain-control-verifications',
    'name' => 'Create Domain control verification',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateDcv`.

Endpoint: POST /api/v2/domain-control-verifications.',
    'type' => 'write',
    'tag' => 'DomainControlVerification',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => '',
      ],
    ],
  ],
  205 =>
  [
    'operation' => 'FilterDcv',
    'slug' => 'avalara_filter_dcv',
    'class' => 'AvalaraFilterDcv',
    'method' => 'GET',
    'path' => '/api/v2/domain-control-verifications',
    'name' => 'Get domain control verifications by logged in user/domain name.',
    'description' => 'Execute official Avalara AvaTax REST API operation `FilterDcv`.

Endpoint: GET /api/v2/domain-control-verifications.',
    'type' => 'read',
    'tag' => 'DomainControlVerification',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* Id, Context, Token, Status, EmailId',
      ],
    ],
  ],
  206 =>
  [
    'operation' => 'GetDcvById',
    'slug' => 'avalara_get_dcv_by_id',
    'class' => 'AvalaraGetDcvById',
    'method' => 'GET',
    'path' => '/api/v2/domain-control-verifications/{domainControlVerificationId}',
    'name' => 'Get domain control verification by domainControlVerificationId',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetDcvById`.

Endpoint: GET /api/v2/domain-control-verifications/{domainControlVerificationId}.',
    'type' => 'read',
    'tag' => 'DomainControlVerification',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'domainControlVerificationId',
        'param' => 'domain_control_verification_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  207 =>
  [
    'operation' => 'CreateECommerceToken',
    'slug' => 'avalara_create_e_commerce_token',
    'class' => 'AvalaraCreateECommerceToken',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/ecommercetokens',
    'name' => 'Create a new ecommerce token.',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateECommerceToken`.

Endpoint: POST /api/v2/companies/{companyId}/ecommercetokens.',
    'type' => 'write',
    'tag' => 'ECommerceToken',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company ID that will be issued this certificate.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  208 =>
  [
    'operation' => 'RefreshECommerceToken',
    'slug' => 'avalara_refresh_e_commerce_token',
    'class' => 'AvalaraRefreshECommerceToken',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/ecommercetokens',
    'name' => 'Refresh an eCommerce token.',
    'description' => 'Execute official Avalara AvaTax REST API operation `RefreshECommerceToken`.

Endpoint: PUT /api/v2/companies/{companyId}/ecommercetokens.',
    'type' => 'write',
    'tag' => 'ECommerceToken',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company ID that the refreshed certificate belongs to.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  209 =>
  [
    'operation' => 'DeleteAfcEventNotifications',
    'slug' => 'avalara_delete_afc_event_notifications',
    'class' => 'AvalaraDeleteAfcEventNotifications',
    'method' => 'DELETE',
    'path' => '/api/v2/event-notifications/afc',
    'name' => 'Delete AFC event notifications.',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteAfcEventNotifications`.

Endpoint: DELETE /api/v2/event-notifications/afc.',
    'type' => 'write',
    'tag' => 'EcmEventNotifications',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'isDlq',
        'param' => 'is_dlq',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Specify `true` to delete event notifications from the dead letter queue; otherwise, specify `false`.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Details of the event you want to delete.',
      ],
    ],
  ],
  210 =>
  [
    'operation' => 'DeleteEventNotifications',
    'slug' => 'avalara_delete_event_notifications',
    'class' => 'AvalaraDeleteEventNotifications',
    'method' => 'DELETE',
    'path' => '/api/v2/event-notifications/companies/{companyId}',
    'name' => 'Delete company event notifications',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteEventNotifications`.

Endpoint: DELETE /api/v2/event-notifications/companies/{companyId}.',
    'type' => 'write',
    'tag' => 'EcmEventNotifications',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded these event notifications.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Details of the event you want to delete.',
      ],
    ],
  ],
  211 =>
  [
    'operation' => 'GetEventNotifications',
    'slug' => 'avalara_get_event_notifications',
    'class' => 'AvalaraGetEventNotifications',
    'method' => 'GET',
    'path' => '/api/v2/event-notifications/companies/{companyId}',
    'name' => 'Retrieve company event notifications.',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetEventNotifications`.

Endpoint: GET /api/v2/event-notifications/companies/{companyId}.',
    'type' => 'read',
    'tag' => 'EcmEventNotifications',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded these event notifications.',
      ],
    ],
  ],
  212 =>
  [
    'operation' => 'ListAfcEventNotifications',
    'slug' => 'avalara_list_afc_event_notifications',
    'class' => 'AvalaraListAfcEventNotifications',
    'method' => 'GET',
    'path' => '/api/v2/event-notifications/afc',
    'name' => 'Retrieve AFC event notifications',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListAfcEventNotifications`.

Endpoint: GET /api/v2/event-notifications/afc.',
    'type' => 'read',
    'tag' => 'EcmEventNotifications',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'isDlq',
        'param' => 'is_dlq',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Specify `true` to retrieve event notifications from the dead letter queue; otherwise, specify `false`.',
      ],
    ],
  ],
  213 =>
  [
    'operation' => 'GetEcoNexusThresholdStatuses',
    'slug' => 'avalara_get_eco_nexus_threshold_statuses',
    'class' => 'AvalaraGetEcoNexusThresholdStatuses',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/econexusthreshold/statuses',
    'name' => 'List economic nexus threshold statuses for a company',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetEcoNexusThresholdStatuses`.

Endpoint: GET /api/v2/companies/{companyId}/econexusthreshold/statuses.',
    'type' => 'read',
    'tag' => 'EcoNexusThreshold',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The Avalara company identifier.',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Standard Avalara `$include` query option (see other v2 list APIs].',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  214 =>
  [
    'operation' => 'ApproveFirmClientLinkage',
    'slug' => 'avalara_approve_firm_client_linkage',
    'class' => 'AvalaraApproveFirmClientLinkage',
    'method' => 'POST',
    'path' => '/api/v2/firmclientlinkages/{id}/approve',
    'name' => 'Approves linkage to a firm for a client account',
    'description' => 'Execute official Avalara AvaTax REST API operation `ApproveFirmClientLinkage`.

Endpoint: POST /api/v2/firmclientlinkages/{id}/approve.',
    'type' => 'write',
    'tag' => 'FirmClientLinkages',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  215 =>
  [
    'operation' => 'CreateAndLinkNewFirmClientAccount',
    'slug' => 'avalara_create_and_link_new_firm_client_account',
    'class' => 'AvalaraCreateAndLinkNewFirmClientAccount',
    'method' => 'POST',
    'path' => '/api/v2/firmclientlinkages/createandlinkclient',
    'name' => 'Request a new FirmClient account and create an approved linkage to it',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateAndLinkNewFirmClientAccount`.

Endpoint: POST /api/v2/firmclientlinkages/createandlinkclient.',
    'type' => 'write',
    'tag' => 'FirmClientLinkages',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Information about the account you wish to create.',
      ],
    ],
  ],
  216 =>
  [
    'operation' => 'CreateFirmClientLinkage',
    'slug' => 'avalara_create_firm_client_linkage',
    'class' => 'AvalaraCreateFirmClientLinkage',
    'method' => 'POST',
    'path' => '/api/v2/firmclientlinkages',
    'name' => 'Links a firm account with the client account',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateFirmClientLinkage`.

Endpoint: POST /api/v2/firmclientlinkages.',
    'type' => 'write',
    'tag' => 'FirmClientLinkages',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'FirmClientLinkageInputModel',
      ],
    ],
  ],
  217 =>
  [
    'operation' => 'DeleteFirmClientLinkage',
    'slug' => 'avalara_delete_firm_client_linkage',
    'class' => 'AvalaraDeleteFirmClientLinkage',
    'method' => 'DELETE',
    'path' => '/api/v2/firmclientlinkages/{id}',
    'name' => 'Delete a linkage',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteFirmClientLinkage`.

Endpoint: DELETE /api/v2/firmclientlinkages/{id}.',
    'type' => 'write',
    'tag' => 'FirmClientLinkages',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  218 =>
  [
    'operation' => 'GetFirmClientLinkage',
    'slug' => 'avalara_get_firm_client_linkage',
    'class' => 'AvalaraGetFirmClientLinkage',
    'method' => 'GET',
    'path' => '/api/v2/firmclientlinkages/{id}',
    'name' => 'Get linkage between a firm and client by id',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetFirmClientLinkage`.

Endpoint: GET /api/v2/firmclientlinkages/{id}.',
    'type' => 'read',
    'tag' => 'FirmClientLinkages',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  219 =>
  [
    'operation' => 'InsertFirmClientLinkage',
    'slug' => 'avalara_insert_firm_client_linkage',
    'class' => 'AvalaraInsertFirmClientLinkage',
    'method' => 'POST',
    'path' => '/api/v2/firmclientlinkages/insert',
    'name' => 'Insert a full FirmClientLinkage record',
    'description' => 'Execute official Avalara AvaTax REST API operation `InsertFirmClientLinkage`.

Endpoint: POST /api/v2/firmclientlinkages/insert.',
    'type' => 'write',
    'tag' => 'FirmClientLinkages',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'FirmClientLinkage record',
      ],
    ],
  ],
  220 =>
  [
    'operation' => 'ListFirmClientLinkage',
    'slug' => 'avalara_list_firm_client_linkage',
    'class' => 'AvalaraListFirmClientLinkage',
    'method' => 'GET',
    'path' => '/api/v2/firmclientlinkages',
    'name' => 'List client linkages for a firm or client',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListFirmClientLinkage`.

Endpoint: GET /api/v2/firmclientlinkages.',
    'type' => 'read',
    'tag' => 'FirmClientLinkages',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* firmAccountName, clientAccountName',
      ],
    ],
  ],
  221 =>
  [
    'operation' => 'RejectFirmClientLinkage',
    'slug' => 'avalara_reject_firm_client_linkage',
    'class' => 'AvalaraRejectFirmClientLinkage',
    'method' => 'POST',
    'path' => '/api/v2/firmclientlinkages/{id}/reject',
    'name' => 'Rejects linkage to a firm for a client account',
    'description' => 'Execute official Avalara AvaTax REST API operation `RejectFirmClientLinkage`.

Endpoint: POST /api/v2/firmclientlinkages/{id}/reject.',
    'type' => 'write',
    'tag' => 'FirmClientLinkages',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  222 =>
  [
    'operation' => 'ResetFirmClientLinkage',
    'slug' => 'avalara_reset_firm_client_linkage',
    'class' => 'AvalaraResetFirmClientLinkage',
    'method' => 'POST',
    'path' => '/api/v2/firmclientlinkages/{id}/reset',
    'name' => 'Reset linkage status between a client and firm back to requested',
    'description' => 'Execute official Avalara AvaTax REST API operation `ResetFirmClientLinkage`.

Endpoint: POST /api/v2/firmclientlinkages/{id}/reset.',
    'type' => 'write',
    'tag' => 'FirmClientLinkages',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  223 =>
  [
    'operation' => 'RevokeFirmClientLinkage',
    'slug' => 'avalara_revoke_firm_client_linkage',
    'class' => 'AvalaraRevokeFirmClientLinkage',
    'method' => 'POST',
    'path' => '/api/v2/firmclientlinkages/{id}/revoke',
    'name' => 'Revokes previously approved linkage to a firm for a client account',
    'description' => 'Execute official Avalara AvaTax REST API operation `RevokeFirmClientLinkage`.

Endpoint: POST /api/v2/firmclientlinkages/{id}/revoke.',
    'type' => 'write',
    'tag' => 'FirmClientLinkages',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  224 =>
  [
    'operation' => 'UpdateFirmClientLinkage',
    'slug' => 'avalara_update_firm_client_linkage',
    'class' => 'AvalaraUpdateFirmClientLinkage',
    'method' => 'PUT',
    'path' => '/api/v2/firmclientlinkages',
    'name' => 'Update a full FirmClientLinkage record',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateFirmClientLinkage`.

Endpoint: PUT /api/v2/firmclientlinkages.',
    'type' => 'write',
    'tag' => 'FirmClientLinkages',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'FirmClientLinkage record',
      ],
    ],
  ],
  225 =>
  [
    'operation' => 'ActivateFundingRequest',
    'slug' => 'avalara_activate_funding_request',
    'class' => 'AvalaraActivateFundingRequest',
    'method' => 'GET',
    'path' => '/api/v2/fundingrequests/{id}/widget',
    'name' => 'Request the javascript for a funding setup widget',
    'description' => 'Execute official Avalara AvaTax REST API operation `ActivateFundingRequest`.

Endpoint: GET /api/v2/fundingrequests/{id}/widget.',
    'type' => 'read',
    'tag' => 'FundingRequests',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of this funding request',
      ],
      1 =>
      [
        'name' => 'businessUnit',
        'param' => 'business_unit',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The company\'s business unit',
      ],
      2 =>
      [
        'name' => 'subscriptionType',
        'param' => 'subscription_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The company\'s subscription type',
      ],
      3 =>
      [
        'name' => 'currency',
        'param' => 'currency',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Currency',
      ],
      4 =>
      [
        'name' => 'agreementType',
        'param' => 'agreement_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Agreement Type',
      ],
    ],
  ],
  226 =>
  [
    'operation' => 'FundingRequestStatus',
    'slug' => 'avalara_funding_request_status',
    'class' => 'AvalaraFundingRequestStatus',
    'method' => 'GET',
    'path' => '/api/v2/fundingrequests/{id}',
    'name' => 'Retrieve status about a funding setup request',
    'description' => 'Execute official Avalara AvaTax REST API operation `FundingRequestStatus`.

Endpoint: GET /api/v2/fundingrequests/{id}.',
    'type' => 'read',
    'tag' => 'FundingRequests',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of this funding request',
      ],
      1 =>
      [
        'name' => 'businessUnit',
        'param' => 'business_unit',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The company\'s business unit',
      ],
      2 =>
      [
        'name' => 'subscriptionType',
        'param' => 'subscription_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The company\'s subscription type',
      ],
    ],
  ],
  227 =>
  [
    'operation' => 'BulkUploadGLAccounts',
    'slug' => 'avalara_bulk_upload_gl_accounts',
    'class' => 'AvalaraBulkUploadGLAccounts',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyid}/glaccounts/$upload',
    'name' => 'Bulk upload GL accounts',
    'description' => 'Execute official Avalara AvaTax REST API operation `BulkUploadGLAccounts`.

Endpoint: POST /api/v2/companies/{companyid}/glaccounts/$upload.',
    'type' => 'write',
    'tag' => 'GLAccount',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyid',
        'param' => 'companyid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this GL account object',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'The GL account bulk upload model.',
      ],
    ],
  ],
  228 =>
  [
    'operation' => 'CreateGLAccount',
    'slug' => 'avalara_create_gl_account',
    'class' => 'AvalaraCreateGLAccount',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyid}/glaccounts',
    'name' => 'Create a new GL account',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateGLAccount`.

Endpoint: POST /api/v2/companies/{companyid}/glaccounts.',
    'type' => 'write',
    'tag' => 'GLAccount',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyid',
        'param' => 'companyid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this GL Account object',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'The GL Account you want to create',
      ],
    ],
  ],
  229 =>
  [
    'operation' => 'DeleteGLAccount',
    'slug' => 'avalara_delete_gl_account',
    'class' => 'AvalaraDeleteGLAccount',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyid}/glaccounts/{glaccountid}',
    'name' => 'Delete the GL account associated with the given company ID and GL account ID',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteGLAccount`.

Endpoint: DELETE /api/v2/companies/{companyid}/glaccounts/{glaccountid}.',
    'type' => 'write',
    'tag' => 'GLAccount',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyid',
        'param' => 'companyid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this GL account object',
      ],
      1 =>
      [
        'name' => 'glaccountid',
        'param' => 'glaccountid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this GL account',
      ],
    ],
  ],
  230 =>
  [
    'operation' => 'GetGLAccountById',
    'slug' => 'avalara_get_gl_account_by_id',
    'class' => 'AvalaraGetGLAccountById',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyid}/glaccounts/{glaccountid}',
    'name' => 'Retrieve a single GL account',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetGLAccountById`.

Endpoint: GET /api/v2/companies/{companyid}/glaccounts/{glaccountid}.',
    'type' => 'read',
    'tag' => 'GLAccount',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyid',
        'param' => 'companyid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this GL account object',
      ],
      1 =>
      [
        'name' => 'glaccountid',
        'param' => 'glaccountid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this GL account',
      ],
    ],
  ],
  231 =>
  [
    'operation' => 'ListGLAccountsByCompany',
    'slug' => 'avalara_list_gl_accounts_by_company',
    'class' => 'AvalaraListGLAccountsByCompany',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyid}/glaccounts',
    'name' => 'Retrieve GL accounts for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListGLAccountsByCompany`.

Endpoint: GET /api/v2/companies/{companyid}/glaccounts.',
    'type' => 'read',
    'tag' => 'GLAccount',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyid',
        'param' => 'companyid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns these GL accounts',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* companyId, meta, defaultItem',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of objects to fetch underneath this company. Any object with a URL path underneath this company can be fetched by specifying its name.',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  232 =>
  [
    'operation' => 'UpdateGLAccount',
    'slug' => 'avalara_update_gl_account',
    'class' => 'AvalaraUpdateGLAccount',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyid}/glaccounts/{glaccountid}',
    'name' => 'Update a single GL account',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateGLAccount`.

Endpoint: PUT /api/v2/companies/{companyid}/glaccounts/{glaccountid}.',
    'type' => 'write',
    'tag' => 'GLAccount',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyid',
        'param' => 'companyid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this GL Account object',
      ],
      1 =>
      [
        'name' => 'glaccountid',
        'param' => 'glaccountid',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this GL Account',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'The GL account object you want to update',
      ],
    ],
  ],
  233 =>
  [
    'operation' => 'AIsearch',
    'slug' => 'avalara_a_isearch',
    'class' => 'AvalaraAIsearch',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/items/nlq/$parse',
    'name' => 'Parse natural language query into structured filters',
    'description' => 'Execute official Avalara AvaTax REST API operation `AIsearch`.

Endpoint: POST /api/v2/companies/{companyId}/items/nlq/$parse.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns these items',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'Natural language search request',
      ],
    ],
  ],
  234 =>
  [
    'operation' => 'BatchDeleteItemClassifications',
    'slug' => 'avalara_batch_delete_item_classifications',
    'class' => 'AvalaraBatchDeleteItemClassifications',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/classifications',
    'name' => 'Delete all classifications for an item',
    'description' => 'Execute official Avalara AvaTax REST API operation `BatchDeleteItemClassifications`.

Endpoint: DELETE /api/v2/companies/{companyId}/items/{itemId}/classifications.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this item.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the item you wish to delete the classifications.',
      ],
    ],
  ],
  235 =>
  [
    'operation' => 'BatchDeleteItemCustomParameters',
    'slug' => 'avalara_batch_delete_item_custom_parameters',
    'class' => 'AvalaraBatchDeleteItemCustomParameters',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/custom-parameters',
    'name' => 'Delete all custom parameters for an item',
    'description' => 'Execute official Avalara AvaTax REST API operation `BatchDeleteItemCustomParameters`.

Endpoint: DELETE /api/v2/companies/{companyId}/items/{itemId}/custom-parameters.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this item.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the item you wish to delete the custom parameters.',
      ],
    ],
  ],
  236 =>
  [
    'operation' => 'BatchDeleteItemParameters',
    'slug' => 'avalara_batch_delete_item_parameters',
    'class' => 'AvalaraBatchDeleteItemParameters',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/parameters',
    'name' => 'Delete all parameters for an item',
    'description' => 'Execute official Avalara AvaTax REST API operation `BatchDeleteItemParameters`.

Endpoint: DELETE /api/v2/companies/{companyId}/items/{itemId}/parameters.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this item.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the item you wish to delete the parameters.',
      ],
    ],
  ],
  237 =>
  [
    'operation' => 'BulkUploadItems',
    'slug' => 'avalara_bulk_upload_items',
    'class' => 'AvalaraBulkUploadItems',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/items/upload',
    'name' => 'Bulk upload items from a product catalog',
    'description' => 'Execute official Avalara AvaTax REST API operation `BulkUploadItems`.

Endpoint: POST /api/v2/companies/{companyId}/items/upload.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this items.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The items you wish to upload.',
      ],
    ],
  ],
  238 =>
  [
    'operation' => 'CreateItemClassifications',
    'slug' => 'avalara_create_item_classifications',
    'class' => 'AvalaraCreateItemClassifications',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/classifications',
    'name' => 'Add classifications to an item.',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateItemClassifications`.

Endpoint: POST /api/v2/companies/{companyId}/items/{itemId}/classifications.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item id.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The item classifications you wish to create.',
      ],
    ],
  ],
  239 =>
  [
    'operation' => 'CreateItemCustomParameters',
    'slug' => 'avalara_create_item_custom_parameters',
    'class' => 'AvalaraCreateItemCustomParameters',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/custom-parameters',
    'name' => 'Add custom parameters to an item.',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateItemCustomParameters`.

Endpoint: POST /api/v2/companies/{companyId}/items/{itemId}/custom-parameters.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this item custom parameter.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item id.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => false,
        'description' => 'The item custom parameters you wish to create.',
      ],
    ],
  ],
  240 =>
  [
    'operation' => 'CreateItemParameters',
    'slug' => 'avalara_create_item_parameters',
    'class' => 'AvalaraCreateItemParameters',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/parameters',
    'name' => 'Add parameters to an item.',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateItemParameters`.

Endpoint: POST /api/v2/companies/{companyId}/items/{itemId}/parameters.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this item parameter.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item id.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The item parameters you wish to create.',
      ],
    ],
  ],
  241 =>
  [
    'operation' => 'CreateItemTags',
    'slug' => 'avalara_create_item_tags',
    'class' => 'AvalaraCreateItemTags',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/tags',
    'name' => 'Create tags for a item',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateItemTags`.

Endpoint: POST /api/v2/companies/{companyId}/items/{itemId}/tags.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that defined these items',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the item as defined by the company that owns this tag.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'Tags you wish to associate with the Item',
      ],
    ],
  ],
  242 =>
  [
    'operation' => 'CreateItems',
    'slug' => 'avalara_create_items',
    'class' => 'AvalaraCreateItems',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/items',
    'name' => 'Create a new item',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateItems`.

Endpoint: POST /api/v2/companies/{companyId}/items.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this item.',
      ],
      1 =>
      [
        'name' => 'processRecommendationsSynchronously',
        'param' => 'process_recommendations_synchronously',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If true then Indix api will be called synchronously to get tax code recommendations.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The item you wish to create.',
      ],
    ],
  ],
  243 =>
  [
    'operation' => 'CreateTaxCodeClassificationRequest',
    'slug' => 'avalara_create_tax_code_classification_request',
    'class' => 'AvalaraCreateTaxCodeClassificationRequest',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/classificationrequests/taxcode',
    'name' => 'Create a new tax code classification request',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateTaxCodeClassificationRequest`.

Endpoint: POST /api/v2/companies/{companyId}/classificationrequests/taxcode.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that creates this request.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'The request you wish to create.',
      ],
    ],
  ],
  244 =>
  [
    'operation' => 'DeleteCatalogueItem',
    'slug' => 'avalara_delete_catalogue_item',
    'class' => 'AvalaraDeleteCatalogueItem',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/itemcatalogue/{itemCode}',
    'name' => 'Delete a single item',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteCatalogueItem`.

Endpoint: DELETE /api/v2/companies/{companyId}/itemcatalogue/{itemCode}.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this item.',
      ],
      1 =>
      [
        'name' => 'itemCode',
        'param' => 'item_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The code of the item you want to delete.',
      ],
    ],
  ],
  245 =>
  [
    'operation' => 'DeleteHSCodeClassificationStatus',
    'slug' => 'avalara_delete_hs_code_classification_status',
    'class' => 'AvalaraDeleteHSCodeClassificationStatus',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/hscode-classifications-status/{id}',
    'name' => 'Deletes HS Code classification status for the item by status id.',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteHSCodeClassificationStatus`.

Endpoint: DELETE /api/v2/companies/{companyId}/items/{itemId}/hscode-classifications-status/{id}.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company to which this item belongs',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the item',
      ],
      2 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The HS Code classification status id.',
      ],
    ],
  ],
  246 =>
  [
    'operation' => 'DeleteItem',
    'slug' => 'avalara_delete_item',
    'class' => 'AvalaraDeleteItem',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/items/{id}',
    'name' => 'Delete a single item',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteItem`.

Endpoint: DELETE /api/v2/companies/{companyId}/items/{id}.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this item.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the item you wish to delete.',
      ],
    ],
  ],
  247 =>
  [
    'operation' => 'DeleteItemClassification',
    'slug' => 'avalara_delete_item_classification',
    'class' => 'AvalaraDeleteItemClassification',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/classifications/{id}',
    'name' => 'Delete a single item classification.',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteItemClassification`.

Endpoint: DELETE /api/v2/companies/{companyId}/items/{itemId}/classifications/{id}.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item id.',
      ],
      2 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item classification id.',
      ],
    ],
  ],
  248 =>
  [
    'operation' => 'DeleteItemCustomParameter',
    'slug' => 'avalara_delete_item_custom_parameter',
    'class' => 'AvalaraDeleteItemCustomParameter',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/custom-parameters/{id}',
    'name' => 'Delete a single item custom parameter',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteItemCustomParameter`.

Endpoint: DELETE /api/v2/companies/{companyId}/items/{itemId}/custom-parameters/{id}.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item id',
      ],
      2 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The custom parameter id',
      ],
    ],
  ],
  249 =>
  [
    'operation' => 'DeleteItemImage',
    'slug' => 'avalara_delete_item_image',
    'class' => 'AvalaraDeleteItemImage',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/images/{imageId}',
    'name' => 'Delete the image associated with an item.',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteItemImage`.

Endpoint: DELETE /api/v2/companies/{companyId}/items/{itemId}/images/{imageId}.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID of the company.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID of the item.',
      ],
      2 =>
      [
        'name' => 'imageId',
        'param' => 'image_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique ID of the image to delete.',
      ],
    ],
  ],
  250 =>
  [
    'operation' => 'DeleteItemParameter',
    'slug' => 'avalara_delete_item_parameter',
    'class' => 'AvalaraDeleteItemParameter',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/parameters/{id}',
    'name' => 'Delete a single item parameter',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteItemParameter`.

Endpoint: DELETE /api/v2/companies/{companyId}/items/{itemId}/parameters/{id}.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item id',
      ],
      2 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The parameter id',
      ],
    ],
  ],
  251 =>
  [
    'operation' => 'DeleteItemTag',
    'slug' => 'avalara_delete_item_tag',
    'class' => 'AvalaraDeleteItemTag',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/tags/{itemTagDetailId}',
    'name' => 'Delete item tag by id',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteItemTag`.

Endpoint: DELETE /api/v2/companies/{companyId}/items/{itemId}/tags/{itemTagDetailId}.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that defined these items',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the item as defined by the company that owns this tag.',
      ],
      2 =>
      [
        'name' => 'itemTagDetailId',
        'param' => 'item_tag_detail_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the item tag detail you wish to delete.',
      ],
    ],
  ],
  252 =>
  [
    'operation' => 'DeleteItemTags',
    'slug' => 'avalara_delete_item_tags',
    'class' => 'AvalaraDeleteItemTags',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/tags',
    'name' => 'Delete all item tags',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteItemTags`.

Endpoint: DELETE /api/v2/companies/{companyId}/items/{itemId}/tags.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that defined these items.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the item as defined by the company that owns this tag.',
      ],
    ],
  ],
  253 =>
  [
    'operation' => 'DismissHSCodeClassificationStatus',
    'slug' => 'avalara_dismiss_hs_code_classification_status',
    'class' => 'AvalaraDismissHSCodeClassificationStatus',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/hscode-classifications-status/$dismiss',
    'name' => 'Dismiss the `Status` and `Details` values of the given ItemHSCodeClassificationStatus.',
    'description' => 'Execute official Avalara AvaTax REST API operation `DismissHSCodeClassificationStatus`.

Endpoint: PUT /api/v2/companies/{companyId}/items/{itemId}/hscode-classifications-status/$dismiss.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company to which this item belongs.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the item whose classification status you want to update.',
      ],
      2 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The country of the HS code classification request status record that is to be updated.',
      ],
    ],
  ],
  254 =>
  [
    'operation' => 'FetchAdditionalHSCodeDutyDetails',
    'slug' => 'avalara_fetch_additional_hs_code_duty_details',
    'class' => 'AvalaraFetchAdditionalHSCodeDutyDetails',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/hsdutydetails/$fetch-additional-hsdutydetails',
    'name' => 'Fetch Additional HS Duty Details for items',
    'description' => 'Execute official Avalara AvaTax REST API operation `FetchAdditionalHSCodeDutyDetails`.

Endpoint: POST /api/v2/companies/{companyId}/items/{itemId}/hsdutydetails/$fetch-additional-hsdutydetails.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company for which you want to get additional HS Duty Details.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID of the item for which you want to get additional HS Duty Details.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => false,
        'description' => 'Additional HS Code Duty Details input Model',
      ],
    ],
  ],
  255 =>
  [
    'operation' => 'GetHSCodeClassificationSLA',
    'slug' => 'avalara_get_hs_code_classification_sla',
    'class' => 'AvalaraGetHSCodeClassificationSLA',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/items/hscode-classification/$get-sla',
    'name' => 'Retrieve the HS code classification SLA details for a company.',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetHSCodeClassificationSLA`.

Endpoint: GET /api/v2/companies/{companyId}/items/hscode-classification/$get-sla.',
    'type' => 'read',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company for which to retrieve the SLA details.',
      ],
    ],
  ],
  256 =>
  [
    'operation' => 'GetItem',
    'slug' => 'avalara_get_item',
    'class' => 'AvalaraGetItem',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/items/{id}',
    'name' => 'Retrieve a single item',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetItem`.

Endpoint: GET /api/v2/companies/{companyId}/items/{id}.',
    'type' => 'read',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this item object',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this item',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
    ],
  ],
  257 =>
  [
    'operation' => 'GetItemClassification',
    'slug' => 'avalara_get_item_classification',
    'class' => 'AvalaraGetItemClassification',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/classifications/{id}',
    'name' => 'Retrieve a single item classification.',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetItemClassification`.

Endpoint: GET /api/v2/companies/{companyId}/items/{itemId}/classifications/{id}.',
    'type' => 'read',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item id.',
      ],
      2 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item classification id.',
      ],
    ],
  ],
  258 =>
  [
    'operation' => 'GetItemCustomParameter',
    'slug' => 'avalara_get_item_custom_parameter',
    'class' => 'AvalaraGetItemCustomParameter',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/custom-parameters/{id}',
    'name' => 'Retrieve a single item custom parameter',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetItemCustomParameter`.

Endpoint: GET /api/v2/companies/{companyId}/items/{itemId}/custom-parameters/{id}.',
    'type' => 'read',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item id',
      ],
      2 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The custom parameter id',
      ],
    ],
  ],
  259 =>
  [
    'operation' => 'GetItemParameter',
    'slug' => 'avalara_get_item_parameter',
    'class' => 'AvalaraGetItemParameter',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/parameters/{id}',
    'name' => 'Retrieve a single item parameter',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetItemParameter`.

Endpoint: GET /api/v2/companies/{companyId}/items/{itemId}/parameters/{id}.',
    'type' => 'read',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item id',
      ],
      2 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The parameter id',
      ],
    ],
  ],
  260 =>
  [
    'operation' => 'GetItemTags',
    'slug' => 'avalara_get_item_tags',
    'class' => 'AvalaraGetItemTags',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/tags',
    'name' => 'Retrieve tags for an item',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetItemTags`.

Endpoint: GET /api/v2/companies/{companyId}/items/{itemId}/tags.',
    'type' => 'read',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that defined these items',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the item as defined by the company that owns this tag.',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* tagName',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
    ],
  ],
  261 =>
  [
    'operation' => 'GetItemTaxCodeRecommendations',
    'slug' => 'avalara_get_item_tax_code_recommendations',
    'class' => 'AvalaraGetItemTaxCodeRecommendations',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/taxcoderecommendations',
    'name' => 'Get Item TaxCode Recommendations',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetItemTaxCodeRecommendations`.

Endpoint: GET /api/v2/companies/{companyId}/items/{itemId}/taxcoderecommendations.',
    'type' => 'read',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => '',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  262 =>
  [
    'operation' => 'GetPremiumClassification',
    'slug' => 'avalara_get_premium_classification',
    'class' => 'AvalaraGetPremiumClassification',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/items/{itemCode}/premiumClassification/{systemCode}',
    'name' => 'Retrieve premium classification for a company\'s item based on its ItemCode and SystemCode.',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetPremiumClassification`.

Endpoint: GET /api/v2/companies/{companyId}/items/{itemCode}/premiumClassification/{systemCode}.',
    'type' => 'read',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this item object',
      ],
      1 =>
      [
        'name' => 'itemCode',
        'param' => 'item_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ItemCode of the item for which you want to retrieve premium classification',
      ],
      2 =>
      [
        'name' => 'systemCode',
        'param' => 'system_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The SystemCode for which you want to retrieve premium classification',
      ],
      3 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optional: Provide the country for which you want to retrieve the premium classification.',
      ],
    ],
  ],
  263 =>
  [
    'operation' => 'GetProductImage',
    'slug' => 'avalara_get_product_image',
    'class' => 'AvalaraGetProductImage',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/images/{imageId}',
    'name' => 'Get the image associated with an item.',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetProductImage`.

Endpoint: GET /api/v2/companies/{companyId}/items/{itemId}/images/{imageId}.',
    'type' => 'read',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID of the company.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID of the item.',
      ],
      2 =>
      [
        'name' => 'imageId',
        'param' => 'image_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique ID of the image to retrieve.',
      ],
    ],
  ],
  264 =>
  [
    'operation' => 'GetSyncTaxCodeRecommendations',
    'slug' => 'avalara_get_sync_tax_code_recommendations',
    'class' => 'AvalaraGetSyncTaxCodeRecommendations',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/$taxcode-recommendations',
    'name' => 'Get the real-time tax code recommendations for the specified items without saving item data.',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetSyncTaxCodeRecommendations`.

Endpoint: POST /api/v2/companies/{companyId}/$taxcode-recommendations.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID of the company.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The list of items to analyze for tax code recommendations (maximum 50].',
      ],
    ],
  ],
  265 =>
  [
    'operation' => 'InitiateHSCodeClassification',
    'slug' => 'avalara_initiate_hs_code_classification',
    'class' => 'AvalaraInitiateHSCodeClassification',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/items/$initiate-hscode-classification',
    'name' => 'Create an HS code classification request.',
    'description' => 'Execute official Avalara AvaTax REST API operation `InitiateHSCodeClassification`.

Endpoint: POST /api/v2/companies/{companyId}/items/$initiate-hscode-classification.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company for which you want to create this HS code classification request.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => false,
        'description' => 'Item HSCodeClassification input Model',
      ],
    ],
  ],
  266 =>
  [
    'operation' => 'ListImportRestrictions',
    'slug' => 'avalara_list_import_restrictions',
    'class' => 'AvalaraListImportRestrictions',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/items/{itemCode}/restrictions/import/{countryOfImport}',
    'name' => 'Retrieve Restrictions for Item by CountryOfImport',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListImportRestrictions`.

Endpoint: GET /api/v2/companies/{companyId}/items/{itemCode}/restrictions/import/{countryOfImport}.',
    'type' => 'read',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this item object',
      ],
      1 =>
      [
        'name' => 'itemCode',
        'param' => 'item_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ItemCode for the item',
      ],
      2 =>
      [
        'name' => 'countryOfImport',
        'param' => 'country_of_import',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Country for which you want the restrictions for the Item.',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  267 =>
  [
    'operation' => 'ListItemClassifications',
    'slug' => 'avalara_list_item_classifications',
    'class' => 'AvalaraListItemClassifications',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/classifications',
    'name' => 'Retrieve classifications for an item.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListItemClassifications`.

Endpoint: GET /api/v2/companies/{companyId}/items/{itemId}/classifications.',
    'type' => 'read',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item id.',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* productCode, systemCode, country, IsPremium, ClassificationEvent',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  268 =>
  [
    'operation' => 'ListItemCustomParameters',
    'slug' => 'avalara_list_item_custom_parameters',
    'class' => 'AvalaraListItemCustomParameters',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/custom-parameters',
    'name' => 'Retrieve custom parameters for an item',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListItemCustomParameters`.

Endpoint: GET /api/v2/companies/{companyId}/items/{itemId}/custom-parameters.',
    'type' => 'read',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item id',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* id, name, value',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  269 =>
  [
    'operation' => 'ListItemParameters',
    'slug' => 'avalara_list_item_parameters',
    'class' => 'AvalaraListItemParameters',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/parameters',
    'name' => 'Retrieve parameters for an item',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListItemParameters`.

Endpoint: GET /api/v2/companies/{companyId}/items/{itemId}/parameters.',
    'type' => 'read',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item id',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* name, unit, isNeededForCalculation, isNeededForReturns, isNeededForClassification',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  270 =>
  [
    'operation' => 'ListItemPremiumClassifications',
    'slug' => 'avalara_list_item_premium_classifications',
    'class' => 'AvalaraListItemPremiumClassifications',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/items/{itemCode}/premiumClassifications',
    'name' => 'Retrieve premium classification for an item based on its `companyId` and `itemCode`.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListItemPremiumClassifications`.

Endpoint: GET /api/v2/companies/{companyId}/items/{itemCode}/premiumClassifications.',
    'type' => 'read',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this item object.',
      ],
      1 =>
      [
        'name' => 'itemCode',
        'param' => 'item_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The item code of the item for which you want to retrieve premium classification.',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* HsCode, justification, createdDate, createdUserId',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
      5 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
    ],
  ],
  271 =>
  [
    'operation' => 'ListItemsByCompany',
    'slug' => 'avalara_list_items_by_company',
    'class' => 'AvalaraListItemsByCompany',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/items',
    'name' => 'Retrieve items for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListItemsByCompany`.

Endpoint: GET /api/v2/companies/{companyId}/items.',
    'type' => 'read',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that defined these items',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* taxCode, source, sourceEntityId, itemType, upc, summary, classifications, parameters, customParameters, tags, properties, itemStatus, taxCodeRecommendationStatus, taxCodeRecommendations, taxCodeDetails, hsCodeClassificationStatus, image',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
      6 =>
      [
        'name' => 'tagName',
        'param' => 'tag_name',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Tag Name on the basis of which you want to filter Items',
      ],
      7 =>
      [
        'name' => 'itemStatus',
        'param' => 'item_status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of item status on the basis of which you want to filter Items',
      ],
      8 =>
      [
        'name' => 'taxCodeRecommendationStatus',
        'param' => 'tax_code_recommendation_status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Tax code recommendation status on the basis of which you want to filter Items',
      ],
      9 =>
      [
        'name' => 'hsCodeClassificationStatus',
        'param' => 'hs_code_classification_status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'HS code classification status on the basis of which you want to filter items.',
      ],
      10 =>
      [
        'name' => 'hsCodeExistsInCountries',
        'param' => 'hs_code_exists_in_countries',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of countries for which the HS code is assigned and based on which you want to filter the items.',
      ],
      11 =>
      [
        'name' => 'hsCodeDoesNotExistsInCountries',
        'param' => 'hs_code_does_not_exists_in_countries',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma-separated list of countries for which the HS code is not assigned and based on which you want to filter the items.',
      ],
    ],
  ],
  272 =>
  [
    'operation' => 'ListRecommendedParameterByCompanyIdAndItemId',
    'slug' => 'avalara_list_recommended_parameter_by_company_id_and_item_id',
    'class' => 'AvalaraListRecommendedParameterByCompanyIdAndItemId',
    'method' => 'GET',
    'path' => '/api/v2/definitions/companies/{companyId}/items/{itemId}/parameters',
    'name' => 'Retrieve the parameters by companyId and itemId.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListRecommendedParameterByCompanyIdAndItemId`.

Endpoint: GET /api/v2/definitions/companies/{companyId}/items/{itemId}/parameters.',
    'type' => 'read',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'Company Identifier.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'Item Identifier.',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* serviceTypes, regularExpression, attributeSubType, values',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  273 =>
  [
    'operation' => 'PatchItem',
    'slug' => 'avalara_patch_item',
    'class' => 'AvalaraPatchItem',
    'method' => 'PATCH',
    'path' => '/api/v2/companies/{companyId}/items/{id}',
    'name' => 'Patch a single item',
    'description' => 'Execute official Avalara AvaTax REST API operation `PatchItem`.

Endpoint: PATCH /api/v2/companies/{companyId}/items/{id}.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that this item belongs to.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the item you want to update.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => false,
        'description' => 'A JSON patch (refer to https://datatracker.ietf.org/doc/html/rfc6902].',
      ],
    ],
  ],
  274 =>
  [
    'operation' => 'QueryItems',
    'slug' => 'avalara_query_items',
    'class' => 'AvalaraQueryItems',
    'method' => 'GET',
    'path' => '/api/v2/items',
    'name' => 'Retrieve all items',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryItems`.

Endpoint: GET /api/v2/items.',
    'type' => 'read',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* taxCode, source, sourceEntityId, itemType, upc, summary, classifications, parameters, customParameters, tags, properties, itemStatus, taxCodeRecommendationStatus, taxCodeRecommendations, taxCodeDetails, hsCodeClassificationStatus, image',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  275 =>
  [
    'operation' => 'QueryItemsBySystemCode',
    'slug' => 'avalara_query_items_by_system_code',
    'class' => 'AvalaraQueryItemsBySystemCode',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/items/internal/bySystemCode/{systemCode}',
    'name' => 'Retrieve items for this company based on System Code and filter criteria(optional] provided',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryItemsBySystemCode`.

Endpoint: POST /api/v2/companies/{companyId}/items/internal/bySystemCode/{systemCode}.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that defined these items',
      ],
      1 =>
      [
        'name' => 'systemCode',
        'param' => 'system_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'System code on the basis of which you want to filter Items',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
      5 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'A filter statement to select specific records, as defined by https://github.com/Microsoft/api-guidelines/blob/master/Guidelines.md#97-filtering .',
      ],
    ],
  ],
  276 =>
  [
    'operation' => 'QueryItemsByTag',
    'slug' => 'avalara_query_items_by_tag',
    'class' => 'AvalaraQueryItemsByTag',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/items/bytags/{tag}',
    'name' => 'Retrieve all items associated with given tag',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryItemsByTag`.

Endpoint: GET /api/v2/companies/{companyId}/items/bytags/{tag}.',
    'type' => 'read',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that defined these items.',
      ],
      1 =>
      [
        'name' => 'tag',
        'param' => 'tag',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The master tag to be associated with item.',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* taxCode, source, sourceEntityId, itemType, upc, summary, classifications, parameters, customParameters, tags, properties, itemStatus, taxCodeRecommendationStatus, taxCodeRecommendations, taxCodeDetails, hsCodeClassificationStatus, image',
      ],
      3 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      4 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      5 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      6 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  277 =>
  [
    'operation' => 'SyncItemCatalogue',
    'slug' => 'avalara_sync_item_catalogue',
    'class' => 'AvalaraSyncItemCatalogue',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/itemcatalogue',
    'name' => 'Create or update items from a product catalog.',
    'description' => 'Execute official Avalara AvaTax REST API operation `SyncItemCatalogue`.

Endpoint: POST /api/v2/companies/{companyId}/itemcatalogue.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this item.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The items you want to create or update.',
      ],
    ],
  ],
  278 =>
  [
    'operation' => 'SyncItems',
    'slug' => 'avalara_sync_items',
    'class' => 'AvalaraSyncItems',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/items/sync',
    'name' => 'Sync items from a product catalog',
    'description' => 'Execute official Avalara AvaTax REST API operation `SyncItems`.

Endpoint: POST /api/v2/companies/{companyId}/items/sync.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this item.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The request object.',
      ],
    ],
  ],
  279 =>
  [
    'operation' => 'UpdateImage',
    'slug' => 'avalara_update_image',
    'class' => 'AvalaraUpdateImage',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/images/{imageId}',
    'name' => 'Update an existing image for an item.',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateImage`.

Endpoint: PUT /api/v2/companies/{companyId}/items/{itemId}/images/{imageId}.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID of the company.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID of the item.',
      ],
      2 =>
      [
        'name' => 'imageId',
        'param' => 'image_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique ID of the image to update.',
      ],
      3 =>
      [
        'name' => 'imageFile',
        'param' => 'image_file',
        'in' => 'formData',
        'type' => 'string',
        'required' => true,
        'description' => 'Avalara formData parameter imageFile.',
      ],
    ],
  ],
  280 =>
  [
    'operation' => 'UpdateItem',
    'slug' => 'avalara_update_item',
    'class' => 'AvalaraUpdateItem',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/items/{id}',
    'name' => 'Update a single item',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateItem`.

Endpoint: PUT /api/v2/companies/{companyId}/items/{id}.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that this item belongs to.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the item you wish to update',
      ],
      2 =>
      [
        'name' => 'isRecommendationSelected',
        'param' => 'is_recommendation_selected',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If true then Set recommendation status to RecommendationSelected',
      ],
      3 =>
      [
        'name' => 'isRecommendationRejected',
        'param' => 'is_recommendation_rejected',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If true then Set recommendation status to RecommendationRejected, When the taxCode recommendation status is RecommendationAvailable. Else will be thrown as error',
      ],
      4 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The item object you wish to update.',
      ],
    ],
  ],
  281 =>
  [
    'operation' => 'UpdateItemClassification',
    'slug' => 'avalara_update_item_classification',
    'class' => 'AvalaraUpdateItemClassification',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/classifications/{id}',
    'name' => 'Update an item classification.',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateItemClassification`.

Endpoint: PUT /api/v2/companies/{companyId}/items/{itemId}/classifications/{id}.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item id.',
      ],
      2 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item classification id.',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The item object you wish to update.',
      ],
    ],
  ],
  282 =>
  [
    'operation' => 'UpdateItemCustomParameter',
    'slug' => 'avalara_update_item_custom_parameter',
    'class' => 'AvalaraUpdateItemCustomParameter',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/custom-parameters/{id}',
    'name' => 'Update an item custom parameter',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateItemCustomParameter`.

Endpoint: PUT /api/v2/companies/{companyId}/items/{itemId}/custom-parameters/{id}.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item id',
      ],
      2 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item custom parameter id',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'The item custom parameter object you wish to update.',
      ],
    ],
  ],
  283 =>
  [
    'operation' => 'UpdateItemParameter',
    'slug' => 'avalara_update_item_parameter',
    'class' => 'AvalaraUpdateItemParameter',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/parameters/{id}',
    'name' => 'Update an item parameter',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateItemParameter`.

Endpoint: PUT /api/v2/companies/{companyId}/items/{itemId}/parameters/{id}.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item id',
      ],
      2 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item parameter id',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The item object you wish to update.',
      ],
    ],
  ],
  284 =>
  [
    'operation' => 'UploadImage',
    'slug' => 'avalara_upload_image',
    'class' => 'AvalaraUploadImage',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/images',
    'name' => 'Upload an image for an item.',
    'description' => 'Execute official Avalara AvaTax REST API operation `UploadImage`.

Endpoint: POST /api/v2/companies/{companyId}/items/{itemId}/images.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID of the company.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID of the item.',
      ],
      2 =>
      [
        'name' => 'imageFile',
        'param' => 'image_file',
        'in' => 'formData',
        'type' => 'string',
        'required' => true,
        'description' => 'Avalara formData parameter imageFile.',
      ],
    ],
  ],
  285 =>
  [
    'operation' => 'UpsertItemClassifications',
    'slug' => 'avalara_upsert_item_classifications',
    'class' => 'AvalaraUpsertItemClassifications',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/classifications',
    'name' => 'Add/update item classifications.',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpsertItemClassifications`.

Endpoint: PUT /api/v2/companies/{companyId}/items/{itemId}/classifications.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company ID.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item ID.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => false,
        'description' => 'The item classifications you want to create.',
      ],
    ],
  ],
  286 =>
  [
    'operation' => 'UpsertItemCustomParameter',
    'slug' => 'avalara_upsert_item_custom_parameter',
    'class' => 'AvalaraUpsertItemCustomParameter',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/custom-parameters',
    'name' => 'Add/update an item custom parameter',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpsertItemCustomParameter`.

Endpoint: PUT /api/v2/companies/{companyId}/items/{itemId}/custom-parameters.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The item id',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => false,
        'description' => 'The item custom parameter object you wish to Upsert.',
      ],
    ],
  ],
  287 =>
  [
    'operation' => 'UpsertItemParameter',
    'slug' => 'avalara_upsert_item_parameter',
    'class' => 'AvalaraUpsertItemParameter',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/items/{itemId}/parameters',
    'name' => 'Add/update an item parameter.',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpsertItemParameter`.

Endpoint: PUT /api/v2/companies/{companyId}/items/{itemId}/parameters.',
    'type' => 'write',
    'tag' => 'Items',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that this item belongs to.',
      ],
      1 =>
      [
        'name' => 'itemId',
        'param' => 'item_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the item you want to update.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => false,
        'description' => 'The item parameter object you want to upsert.',
      ],
    ],
  ],
  288 =>
  [
    'operation' => 'CreateJurisdictionOverrides',
    'slug' => 'avalara_create_jurisdiction_overrides',
    'class' => 'AvalaraCreateJurisdictionOverrides',
    'method' => 'POST',
    'path' => '/api/v2/accounts/{accountId}/jurisdictionoverrides',
    'name' => 'Create one or more overrides',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateJurisdictionOverrides`.

Endpoint: POST /api/v2/accounts/{accountId}/jurisdictionoverrides.',
    'type' => 'write',
    'tag' => 'JurisdictionOverrides',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'accountId',
        'param' => 'account_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account that owns this override',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The jurisdiction override objects to create',
      ],
    ],
  ],
  289 =>
  [
    'operation' => 'DeleteJurisdictionOverride',
    'slug' => 'avalara_delete_jurisdiction_override',
    'class' => 'AvalaraDeleteJurisdictionOverride',
    'method' => 'DELETE',
    'path' => '/api/v2/accounts/{accountId}/jurisdictionoverrides/{id}',
    'name' => 'Delete a single override',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteJurisdictionOverride`.

Endpoint: DELETE /api/v2/accounts/{accountId}/jurisdictionoverrides/{id}.',
    'type' => 'write',
    'tag' => 'JurisdictionOverrides',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'accountId',
        'param' => 'account_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account that owns this override',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the override you wish to delete',
      ],
    ],
  ],
  290 =>
  [
    'operation' => 'GetJurisdictionOverride',
    'slug' => 'avalara_get_jurisdiction_override',
    'class' => 'AvalaraGetJurisdictionOverride',
    'method' => 'GET',
    'path' => '/api/v2/accounts/{accountId}/jurisdictionoverrides/{id}',
    'name' => 'Retrieve a single override',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetJurisdictionOverride`.

Endpoint: GET /api/v2/accounts/{accountId}/jurisdictionoverrides/{id}.',
    'type' => 'read',
    'tag' => 'JurisdictionOverrides',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'accountId',
        'param' => 'account_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account that owns this override',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this override',
      ],
    ],
  ],
  291 =>
  [
    'operation' => 'ListJurisdictionOverridesByAccount',
    'slug' => 'avalara_list_jurisdiction_overrides_by_account',
    'class' => 'AvalaraListJurisdictionOverridesByAccount',
    'method' => 'GET',
    'path' => '/api/v2/accounts/{accountId}/jurisdictionoverrides',
    'name' => 'Retrieve overrides for this account',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListJurisdictionOverridesByAccount`.

Endpoint: GET /api/v2/accounts/{accountId}/jurisdictionoverrides.',
    'type' => 'read',
    'tag' => 'JurisdictionOverrides',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'accountId',
        'param' => 'account_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account that owns this override',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* country, Jurisdictions',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  292 =>
  [
    'operation' => 'QueryJurisdictionOverrides',
    'slug' => 'avalara_query_jurisdiction_overrides',
    'class' => 'AvalaraQueryJurisdictionOverrides',
    'method' => 'GET',
    'path' => '/api/v2/jurisdictionoverrides',
    'name' => 'Retrieve all overrides',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryJurisdictionOverrides`.

Endpoint: GET /api/v2/jurisdictionoverrides.',
    'type' => 'read',
    'tag' => 'JurisdictionOverrides',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* country, Jurisdictions',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  293 =>
  [
    'operation' => 'UpdateJurisdictionOverride',
    'slug' => 'avalara_update_jurisdiction_override',
    'class' => 'AvalaraUpdateJurisdictionOverride',
    'method' => 'PUT',
    'path' => '/api/v2/accounts/{accountId}/jurisdictionoverrides/{id}',
    'name' => 'Update a single jurisdictionoverride',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateJurisdictionOverride`.

Endpoint: PUT /api/v2/accounts/{accountId}/jurisdictionoverrides/{id}.',
    'type' => 'write',
    'tag' => 'JurisdictionOverrides',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'accountId',
        'param' => 'account_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account that this jurisdictionoverride belongs to.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the jurisdictionoverride you wish to update',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The jurisdictionoverride object you wish to update.',
      ],
    ],
  ],
  294 =>
  [
    'operation' => 'CreateLocationParameters',
    'slug' => 'avalara_create_location_parameters',
    'class' => 'AvalaraCreateLocationParameters',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/locations/{locationId}/parameters',
    'name' => 'Add parameters to a location.',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateLocationParameters`.

Endpoint: POST /api/v2/companies/{companyId}/locations/{locationId}/parameters.',
    'type' => 'write',
    'tag' => 'Locations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this location parameter.',
      ],
      1 =>
      [
        'name' => 'locationId',
        'param' => 'location_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The location id.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The location parameters you wish to create.',
      ],
    ],
  ],
  295 =>
  [
    'operation' => 'CreateLocations',
    'slug' => 'avalara_create_locations',
    'class' => 'AvalaraCreateLocations',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/locations',
    'name' => 'Create a new location',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateLocations`.

Endpoint: POST /api/v2/companies/{companyId}/locations.',
    'type' => 'write',
    'tag' => 'Locations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this location.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The location you wish to create.',
      ],
    ],
  ],
  296 =>
  [
    'operation' => 'DeleteLocation',
    'slug' => 'avalara_delete_location',
    'class' => 'AvalaraDeleteLocation',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/locations/{id}',
    'name' => 'Delete a single location',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteLocation`.

Endpoint: DELETE /api/v2/companies/{companyId}/locations/{id}.',
    'type' => 'write',
    'tag' => 'Locations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this location.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the location you wish to delete.',
      ],
    ],
  ],
  297 =>
  [
    'operation' => 'DeleteLocationParameter',
    'slug' => 'avalara_delete_location_parameter',
    'class' => 'AvalaraDeleteLocationParameter',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/locations/{locationId}/parameters/{id}',
    'name' => 'Delete a single location parameter',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteLocationParameter`.

Endpoint: DELETE /api/v2/companies/{companyId}/locations/{locationId}/parameters/{id}.',
    'type' => 'write',
    'tag' => 'Locations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id',
      ],
      1 =>
      [
        'name' => 'locationId',
        'param' => 'location_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The location id',
      ],
      2 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The parameter id',
      ],
    ],
  ],
  298 =>
  [
    'operation' => 'GetLocation',
    'slug' => 'avalara_get_location',
    'class' => 'AvalaraGetLocation',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/locations/{id}',
    'name' => 'Retrieve a single location',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetLocation`.

Endpoint: GET /api/v2/companies/{companyId}/locations/{id}.',
    'type' => 'read',
    'tag' => 'Locations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this location',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this location',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
    ],
  ],
  299 =>
  [
    'operation' => 'GetLocationParameter',
    'slug' => 'avalara_get_location_parameter',
    'class' => 'AvalaraGetLocationParameter',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/locations/{locationId}/parameters/{id}',
    'name' => 'Retrieve a single company location parameter',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetLocationParameter`.

Endpoint: GET /api/v2/companies/{companyId}/locations/{locationId}/parameters/{id}.',
    'type' => 'read',
    'tag' => 'Locations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id',
      ],
      1 =>
      [
        'name' => 'locationId',
        'param' => 'location_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The location id',
      ],
      2 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The parameter id',
      ],
    ],
  ],
  300 =>
  [
    'operation' => 'ListLocationParameters',
    'slug' => 'avalara_list_location_parameters',
    'class' => 'AvalaraListLocationParameters',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/locations/{locationId}/parameters',
    'name' => 'Retrieve parameters for a location',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListLocationParameters`.

Endpoint: GET /api/v2/companies/{companyId}/locations/{locationId}/parameters.',
    'type' => 'read',
    'tag' => 'Locations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id',
      ],
      1 =>
      [
        'name' => 'locationId',
        'param' => 'location_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the location',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* name, unit',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  301 =>
  [
    'operation' => 'ListLocationsByCompany',
    'slug' => 'avalara_list_locations_by_company',
    'class' => 'AvalaraListLocationsByCompany',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/locations',
    'name' => 'Retrieve locations for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListLocationsByCompany`.

Endpoint: GET /api/v2/companies/{companyId}/locations.',
    'type' => 'read',
    'tag' => 'Locations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns these locations',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* isMarketplaceOutsideUsa, settings, parameters',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  302 =>
  [
    'operation' => 'QueryLocations',
    'slug' => 'avalara_query_locations',
    'class' => 'AvalaraQueryLocations',
    'method' => 'GET',
    'path' => '/api/v2/locations',
    'name' => 'Retrieve all locations',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryLocations`.

Endpoint: GET /api/v2/locations.',
    'type' => 'read',
    'tag' => 'Locations',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* isMarketplaceOutsideUsa, settings, parameters',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve. You may specify `LocationSettings` to retrieve location settings.',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  303 =>
  [
    'operation' => 'UpdateLocation',
    'slug' => 'avalara_update_location',
    'class' => 'AvalaraUpdateLocation',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/locations/{id}',
    'name' => 'Update a single location',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateLocation`.

Endpoint: PUT /api/v2/companies/{companyId}/locations/{id}.',
    'type' => 'write',
    'tag' => 'Locations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that this location belongs to.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the location you wish to update',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The location you wish to update.',
      ],
    ],
  ],
  304 =>
  [
    'operation' => 'UpdateLocationParameter',
    'slug' => 'avalara_update_location_parameter',
    'class' => 'AvalaraUpdateLocationParameter',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/locations/{locationId}/parameters/{id}',
    'name' => 'Update a location parameter',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateLocationParameter`.

Endpoint: PUT /api/v2/companies/{companyId}/locations/{locationId}/parameters/{id}.',
    'type' => 'write',
    'tag' => 'Locations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id.',
      ],
      1 =>
      [
        'name' => 'locationId',
        'param' => 'location_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The location id',
      ],
      2 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The location parameter id',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The location parameter object you wish to update.',
      ],
    ],
  ],
  305 =>
  [
    'operation' => 'ValidateLocation',
    'slug' => 'avalara_validate_location',
    'class' => 'AvalaraValidateLocation',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/locations/{id}/validate',
    'name' => 'Validate the location against local requirements',
    'description' => 'Execute official Avalara AvaTax REST API operation `ValidateLocation`.

Endpoint: GET /api/v2/companies/{companyId}/locations/{id}/validate.',
    'type' => 'read',
    'tag' => 'Locations',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this location',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this location',
      ],
    ],
  ],
  306 =>
  [
    'operation' => 'AdjustMultiDocumentTransaction',
    'slug' => 'avalara_adjust_multi_document_transaction',
    'class' => 'AvalaraAdjustMultiDocumentTransaction',
    'method' => 'POST',
    'path' => '/api/v2/transactions/multidocument/{code}/type/{type}/adjust',
    'name' => 'Adjust a MultiDocument transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `AdjustMultiDocumentTransaction`.

Endpoint: POST /api/v2/transactions/multidocument/{code}/type/{type}/adjust.',
    'type' => 'write',
    'tag' => 'MultiDocument',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'code',
        'param' => 'code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction code for this MultiDocument transaction',
      ],
      1 =>
      [
        'name' => 'type',
        'param' => 'type',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction type for this MultiDocument transaction',
      ],
      2 =>
      [
        'name' => 'include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in this fetch call',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The adjust request you wish to execute',
      ],
    ],
  ],
  307 =>
  [
    'operation' => 'AuditMultiDocumentTransaction',
    'slug' => 'avalara_audit_multi_document_transaction',
    'class' => 'AvalaraAuditMultiDocumentTransaction',
    'method' => 'GET',
    'path' => '/api/v2/transactions/multidocument/{code}/type/{type}/audit',
    'name' => 'Get audit information about a MultiDocument transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `AuditMultiDocumentTransaction`.

Endpoint: GET /api/v2/transactions/multidocument/{code}/type/{type}/audit.',
    'type' => 'read',
    'tag' => 'MultiDocument',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'code',
        'param' => 'code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction code for this MultiDocument transaction',
      ],
      1 =>
      [
        'name' => 'type',
        'param' => 'type',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction type for this MultiDocument transaction',
      ],
    ],
  ],
  308 =>
  [
    'operation' => 'CommitMultiDocumentTransaction',
    'slug' => 'avalara_commit_multi_document_transaction',
    'class' => 'AvalaraCommitMultiDocumentTransaction',
    'method' => 'POST',
    'path' => '/api/v2/transactions/multidocument/commit',
    'name' => 'Commit a MultiDocument transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `CommitMultiDocumentTransaction`.

Endpoint: POST /api/v2/transactions/multidocument/commit.',
    'type' => 'write',
    'tag' => 'MultiDocument',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The commit request you wish to execute',
      ],
    ],
  ],
  309 =>
  [
    'operation' => 'CreateMultiDocumentTransaction',
    'slug' => 'avalara_create_multi_document_transaction',
    'class' => 'AvalaraCreateMultiDocumentTransaction',
    'method' => 'POST',
    'path' => '/api/v2/transactions/multidocument',
    'name' => 'Create a new MultiDocument transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateMultiDocumentTransaction`.

Endpoint: POST /api/v2/transactions/multidocument.',
    'type' => 'write',
    'tag' => 'MultiDocument',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in the response after transaction is created',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'the multi document transaction model',
      ],
    ],
  ],
  310 =>
  [
    'operation' => 'GetMultiDocumentTransactionByCodeAndType',
    'slug' => 'avalara_get_multi_document_transaction_by_code_and_type',
    'class' => 'AvalaraGetMultiDocumentTransactionByCodeAndType',
    'method' => 'GET',
    'path' => '/api/v2/transactions/multidocument/{code}/type/{type}',
    'name' => 'Retrieve a MultiDocument transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetMultiDocumentTransactionByCodeAndType`.

Endpoint: GET /api/v2/transactions/multidocument/{code}/type/{type}.',
    'type' => 'read',
    'tag' => 'MultiDocument',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'code',
        'param' => 'code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The multidocument code to retrieve',
      ],
      1 =>
      [
        'name' => 'type',
        'param' => 'type',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction type to retrieve',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in the response after transaction is created',
      ],
    ],
  ],
  311 =>
  [
    'operation' => 'GetMultiDocumentTransactionById',
    'slug' => 'avalara_get_multi_document_transaction_by_id',
    'class' => 'AvalaraGetMultiDocumentTransactionById',
    'method' => 'GET',
    'path' => '/api/v2/transactions/multidocument/{id}',
    'name' => 'Retrieve a MultiDocument transaction by ID',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetMultiDocumentTransactionById`.

Endpoint: GET /api/v2/transactions/multidocument/{id}.',
    'type' => 'read',
    'tag' => 'MultiDocument',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the MultiDocument transaction to retrieve',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in the response after transaction is created',
      ],
    ],
  ],
  312 =>
  [
    'operation' => 'ListMultiDocumentTransactions',
    'slug' => 'avalara_list_multi_document_transactions',
    'class' => 'AvalaraListMultiDocumentTransactions',
    'method' => 'GET',
    'path' => '/api/v2/transactions/multidocument',
    'name' => 'Retrieve all MultiDocument transactions',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListMultiDocumentTransactions`.

Endpoint: GET /api/v2/transactions/multidocument.',
    'type' => 'read',
    'tag' => 'MultiDocument',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* documents',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in the response after transaction is created',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  313 =>
  [
    'operation' => 'RefundMultiDocumentTransaction',
    'slug' => 'avalara_refund_multi_document_transaction',
    'class' => 'AvalaraRefundMultiDocumentTransaction',
    'method' => 'POST',
    'path' => '/api/v2/transactions/multidocument/{code}/type/{type}/refund',
    'name' => 'Create a refund for a MultiDocument transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `RefundMultiDocumentTransaction`.

Endpoint: POST /api/v2/transactions/multidocument/{code}/type/{type}/refund.',
    'type' => 'write',
    'tag' => 'MultiDocument',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'code',
        'param' => 'code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The code of this MultiDocument transaction',
      ],
      1 =>
      [
        'name' => 'type',
        'param' => 'type',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The type of this MultiDocument transaction',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in the response after transaction is created',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Information about the refund to create',
      ],
    ],
  ],
  314 =>
  [
    'operation' => 'VerifyMultiDocumentTransaction',
    'slug' => 'avalara_verify_multi_document_transaction',
    'class' => 'AvalaraVerifyMultiDocumentTransaction',
    'method' => 'POST',
    'path' => '/api/v2/transactions/multidocument/verify',
    'name' => 'Verify a MultiDocument transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `VerifyMultiDocumentTransaction`.

Endpoint: POST /api/v2/transactions/multidocument/verify.',
    'type' => 'write',
    'tag' => 'MultiDocument',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Information from your accounting system to verify against this MultiDocument transaction as it is stored in AvaTax',
      ],
    ],
  ],
  315 =>
  [
    'operation' => 'VoidMultiDocumentTransaction',
    'slug' => 'avalara_void_multi_document_transaction',
    'class' => 'AvalaraVoidMultiDocumentTransaction',
    'method' => 'POST',
    'path' => '/api/v2/transactions/multidocument/{code}/type/{type}/void',
    'name' => 'Void a MultiDocument transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `VoidMultiDocumentTransaction`.

Endpoint: POST /api/v2/transactions/multidocument/{code}/type/{type}/void.',
    'type' => 'write',
    'tag' => 'MultiDocument',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'code',
        'param' => 'code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction code for this MultiDocument transaction',
      ],
      1 =>
      [
        'name' => 'type',
        'param' => 'type',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction type for this MultiDocument transaction',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The void request you wish to execute',
      ],
    ],
  ],
  316 =>
  [
    'operation' => 'CreateNexus',
    'slug' => 'avalara_create_nexus',
    'class' => 'AvalaraCreateNexus',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/nexus',
    'name' => 'Create a new nexus',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateNexus`.

Endpoint: POST /api/v2/companies/{companyId}/nexus.',
    'type' => 'write',
    'tag' => 'Nexus',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this nexus.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The nexus you wish to create.',
      ],
    ],
  ],
  317 =>
  [
    'operation' => 'CreateNexusParameters',
    'slug' => 'avalara_create_nexus_parameters',
    'class' => 'AvalaraCreateNexusParameters',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/nexus/{nexusId}/parameters',
    'name' => 'Add parameters to a nexus.',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateNexusParameters`.

Endpoint: POST /api/v2/companies/{companyId}/nexus/{nexusId}/parameters.',
    'type' => 'write',
    'tag' => 'Nexus',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this nexus parameter.',
      ],
      1 =>
      [
        'name' => 'nexusId',
        'param' => 'nexus_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The nexus id.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The nexus parameters you wish to create.',
      ],
    ],
  ],
  318 =>
  [
    'operation' => 'DeclareNexusByAddress',
    'slug' => 'avalara_declare_nexus_by_address',
    'class' => 'AvalaraDeclareNexusByAddress',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/nexus/byaddress',
    'name' => 'Creates nexus for a list of addresses.',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeclareNexusByAddress`.

Endpoint: POST /api/v2/companies/{companyId}/nexus/byaddress.',
    'type' => 'write',
    'tag' => 'Nexus',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that will own this nexus.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The nexus you wish to create.',
      ],
    ],
  ],
  319 =>
  [
    'operation' => 'DeleteNexus',
    'slug' => 'avalara_delete_nexus',
    'class' => 'AvalaraDeleteNexus',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/nexus/{id}',
    'name' => 'Delete a single nexus',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteNexus`.

Endpoint: DELETE /api/v2/companies/{companyId}/nexus/{id}.',
    'type' => 'write',
    'tag' => 'Nexus',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this nexus.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the nexus you wish to delete.',
      ],
      2 =>
      [
        'name' => 'cascadeDelete',
        'param' => 'cascade_delete',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If true, deletes all the child nexus if they exist along with parent nexus',
      ],
    ],
  ],
  320 =>
  [
    'operation' => 'DeleteNexusParameter',
    'slug' => 'avalara_delete_nexus_parameter',
    'class' => 'AvalaraDeleteNexusParameter',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/nexus/{nexusId}/parameters/{id}',
    'name' => 'Delete a single nexus parameter',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteNexusParameter`.

Endpoint: DELETE /api/v2/companies/{companyId}/nexus/{nexusId}/parameters/{id}.',
    'type' => 'write',
    'tag' => 'Nexus',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id',
      ],
      1 =>
      [
        'name' => 'nexusId',
        'param' => 'nexus_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The nexus id',
      ],
      2 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The parameter id',
      ],
    ],
  ],
  321 =>
  [
    'operation' => 'DeleteNexusParameters',
    'slug' => 'avalara_delete_nexus_parameters',
    'class' => 'AvalaraDeleteNexusParameters',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/nexus/{nexusId}/parameters',
    'name' => 'Delete all parameters for a nexus',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteNexusParameters`.

Endpoint: DELETE /api/v2/companies/{companyId}/nexus/{nexusId}/parameters.',
    'type' => 'write',
    'tag' => 'Nexus',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this nexus.',
      ],
      1 =>
      [
        'name' => 'nexusId',
        'param' => 'nexus_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the nexus you wish to delete the parameters.',
      ],
    ],
  ],
  322 =>
  [
    'operation' => 'GetNexus',
    'slug' => 'avalara_get_nexus',
    'class' => 'AvalaraGetNexus',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/nexus/{id}',
    'name' => 'Retrieve a single nexus',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetNexus`.

Endpoint: GET /api/v2/companies/{companyId}/nexus/{id}.',
    'type' => 'read',
    'tag' => 'Nexus',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this nexus object',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this nexus',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '',
      ],
    ],
  ],
  323 =>
  [
    'operation' => 'GetNexusByFormCode',
    'slug' => 'avalara_get_nexus_by_form_code',
    'class' => 'AvalaraGetNexusByFormCode',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/nexus/byform/{formCode}',
    'name' => 'List company nexus related to a tax form',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetNexusByFormCode`.

Endpoint: GET /api/v2/companies/{companyId}/nexus/byform/{formCode}.',
    'type' => 'read',
    'tag' => 'Nexus',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this nexus object',
      ],
      1 =>
      [
        'name' => 'formCode',
        'param' => 'form_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The form code that we are looking up the nexus for',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '',
      ],
    ],
  ],
  324 =>
  [
    'operation' => 'GetNexusParameter',
    'slug' => 'avalara_get_nexus_parameter',
    'class' => 'AvalaraGetNexusParameter',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/nexus/{nexusId}/parameters/{id}',
    'name' => 'Retrieve a single nexus parameter',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetNexusParameter`.

Endpoint: GET /api/v2/companies/{companyId}/nexus/{nexusId}/parameters/{id}.',
    'type' => 'read',
    'tag' => 'Nexus',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id',
      ],
      1 =>
      [
        'name' => 'nexusId',
        'param' => 'nexus_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The nexus id',
      ],
      2 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The parameter id',
      ],
    ],
  ],
  325 =>
  [
    'operation' => 'ListNexusByCompany',
    'slug' => 'avalara_list_nexus_by_company',
    'class' => 'AvalaraListNexusByCompany',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/nexus',
    'name' => 'Retrieve nexus for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNexusByCompany`.

Endpoint: GET /api/v2/companies/{companyId}/nexus.',
    'type' => 'read',
    'tag' => 'Nexus',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns these nexus objects',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* streamlinedSalesTax, isSSTActive, taxTypeGroup, taxAuthorityId, taxName, parameters',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  326 =>
  [
    'operation' => 'ListNexusByCompanyAndTaxTypeGroup',
    'slug' => 'avalara_list_nexus_by_company_and_tax_type_group',
    'class' => 'AvalaraListNexusByCompanyAndTaxTypeGroup',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/nexus/byTaxTypeGroup/{taxTypeGroup}',
    'name' => 'Retrieve nexus for this company By TaxTypeGroup',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNexusByCompanyAndTaxTypeGroup`.

Endpoint: GET /api/v2/companies/{companyId}/nexus/byTaxTypeGroup/{taxTypeGroup}.',
    'type' => 'read',
    'tag' => 'Nexus',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns these nexus objects',
      ],
      1 =>
      [
        'name' => 'taxTypeGroup',
        'param' => 'tax_type_group',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Name of TaxTypeGroup to filter by',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* streamlinedSalesTax, isSSTActive, taxTypeGroup, taxAuthorityId, taxName, parameters',
      ],
      3 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      4 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      5 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      6 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  327 =>
  [
    'operation' => 'ListNexusParameters',
    'slug' => 'avalara_list_nexus_parameters',
    'class' => 'AvalaraListNexusParameters',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/nexus/{nexusId}/parameters',
    'name' => 'Retrieve parameters for a nexus',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNexusParameters`.

Endpoint: GET /api/v2/companies/{companyId}/nexus/{nexusId}/parameters.',
    'type' => 'read',
    'tag' => 'Nexus',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id',
      ],
      1 =>
      [
        'name' => 'nexusId',
        'param' => 'nexus_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The nexus id',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* name, unit',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  328 =>
  [
    'operation' => 'QueryNexus',
    'slug' => 'avalara_query_nexus',
    'class' => 'AvalaraQueryNexus',
    'method' => 'GET',
    'path' => '/api/v2/nexus',
    'name' => 'Retrieve all nexus',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryNexus`.

Endpoint: GET /api/v2/nexus.',
    'type' => 'read',
    'tag' => 'Nexus',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* streamlinedSalesTax, isSSTActive, taxTypeGroup, taxAuthorityId, taxName, parameters',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  329 =>
  [
    'operation' => 'UpdateNexus',
    'slug' => 'avalara_update_nexus',
    'class' => 'AvalaraUpdateNexus',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/nexus/{id}',
    'name' => 'Update a single nexus',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateNexus`.

Endpoint: PUT /api/v2/companies/{companyId}/nexus/{id}.',
    'type' => 'write',
    'tag' => 'Nexus',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that this nexus belongs to.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the nexus you wish to update',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The nexus object you wish to update.',
      ],
    ],
  ],
  330 =>
  [
    'operation' => 'UpdateNexusParameter',
    'slug' => 'avalara_update_nexus_parameter',
    'class' => 'AvalaraUpdateNexusParameter',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/nexus/{nexusId}/parameters/{id}',
    'name' => 'Update a nexus parameter',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateNexusParameter`.

Endpoint: PUT /api/v2/companies/{companyId}/nexus/{nexusId}/parameters/{id}.',
    'type' => 'write',
    'tag' => 'Nexus',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The company id.',
      ],
      1 =>
      [
        'name' => 'nexusId',
        'param' => 'nexus_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The nexus id',
      ],
      2 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The nexus parameter id',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The nexus object you wish to update.',
      ],
    ],
  ],
  331 =>
  [
    'operation' => 'CreateNoticeResponsibilityType',
    'slug' => 'avalara_create_notice_responsibility_type',
    'class' => 'AvalaraCreateNoticeResponsibilityType',
    'method' => 'POST',
    'path' => '/api/v2/notices/responsibilities',
    'name' => 'Creates a new tax notice responsibility type.',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateNoticeResponsibilityType`.

Endpoint: POST /api/v2/notices/responsibilities.',
    'type' => 'write',
    'tag' => 'Notices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The responsibility type to create',
      ],
    ],
  ],
  332 =>
  [
    'operation' => 'CreateNoticeRootCauseType',
    'slug' => 'avalara_create_notice_root_cause_type',
    'class' => 'AvalaraCreateNoticeRootCauseType',
    'method' => 'POST',
    'path' => '/api/v2/notices/rootcauses',
    'name' => 'Creates a new tax notice root cause type.',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateNoticeRootCauseType`.

Endpoint: POST /api/v2/notices/rootcauses.',
    'type' => 'write',
    'tag' => 'Notices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The root cause type to create',
      ],
    ],
  ],
  333 =>
  [
    'operation' => 'DeleteNoticeResponsibilityType',
    'slug' => 'avalara_delete_notice_responsibility_type',
    'class' => 'AvalaraDeleteNoticeResponsibilityType',
    'method' => 'DELETE',
    'path' => '/api/v2/notices/responsibilities/{responsibilityId}',
    'name' => 'Delete a tax notice responsibility type.',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteNoticeResponsibilityType`.

Endpoint: DELETE /api/v2/notices/responsibilities/{responsibilityId}.',
    'type' => 'write',
    'tag' => 'Notices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'responsibilityId',
        'param' => 'responsibility_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID of the responsibility type',
      ],
    ],
  ],
  334 =>
  [
    'operation' => 'DeleteNoticeRootCauseType',
    'slug' => 'avalara_delete_notice_root_cause_type',
    'class' => 'AvalaraDeleteNoticeRootCauseType',
    'method' => 'DELETE',
    'path' => '/api/v2/notices/rootcauses/{rootCauseId}',
    'name' => 'Delete a tax notice root cause type.',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteNoticeRootCauseType`.

Endpoint: DELETE /api/v2/notices/rootcauses/{rootCauseId}.',
    'type' => 'write',
    'tag' => 'Notices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'rootCauseId',
        'param' => 'root_cause_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID of the root cause type',
      ],
    ],
  ],
  335 =>
  [
    'operation' => 'DismissNotification',
    'slug' => 'avalara_dismiss_notification',
    'class' => 'AvalaraDismissNotification',
    'method' => 'PUT',
    'path' => '/api/v2/notifications/{id}/dismiss',
    'name' => 'Mark a single notification as dismissed.',
    'description' => 'Execute official Avalara AvaTax REST API operation `DismissNotification`.

Endpoint: PUT /api/v2/notifications/{id}/dismiss.',
    'type' => 'write',
    'tag' => 'Notifications',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The id of the notification you wish to mark as dismissed.',
      ],
    ],
  ],
  336 =>
  [
    'operation' => 'GetNotification',
    'slug' => 'avalara_get_notification',
    'class' => 'AvalaraGetNotification',
    'method' => 'GET',
    'path' => '/api/v2/notifications/{id}',
    'name' => 'Retrieve a single notification.',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetNotification`.

Endpoint: GET /api/v2/notifications/{id}.',
    'type' => 'read',
    'tag' => 'Notifications',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The id of the notification to retrieve.',
      ],
    ],
  ],
  337 =>
  [
    'operation' => 'ListNotifications',
    'slug' => 'avalara_list_notifications',
    'class' => 'AvalaraListNotifications',
    'method' => 'GET',
    'path' => '/api/v2/notifications',
    'name' => 'List all notifications.',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListNotifications`.

Endpoint: GET /api/v2/notifications.',
    'type' => 'read',
    'tag' => 'Notifications',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  338 =>
  [
    'operation' => 'RequestNewAccount',
    'slug' => 'avalara_request_new_account',
    'class' => 'AvalaraRequestNewAccount',
    'method' => 'POST',
    'path' => '/api/v2/accounts/request',
    'name' => 'Request a new Avalara account',
    'description' => 'Execute official Avalara AvaTax REST API operation `RequestNewAccount`.

Endpoint: POST /api/v2/accounts/request.',
    'type' => 'write',
    'tag' => 'Provisioning',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Information about the account you wish to create and the selected product offerings.',
      ],
    ],
  ],
  339 =>
  [
    'operation' => 'RequestNewEntitlement',
    'slug' => 'avalara_request_new_entitlement',
    'class' => 'AvalaraRequestNewEntitlement',
    'method' => 'POST',
    'path' => '/api/v2/accounts/{id}/entitlements/{offer}',
    'name' => 'Request a new entitilement to an existing customer',
    'description' => 'Execute official Avalara AvaTax REST API operation `RequestNewEntitlement`.

Endpoint: POST /api/v2/accounts/{id}/entitlements/{offer}.',
    'type' => 'write',
    'tag' => 'Provisioning',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The avatax account id of the customer',
      ],
      1 =>
      [
        'name' => 'offer',
        'param' => 'offer',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The offer to be added to an already existing customer',
      ],
    ],
  ],
  340 =>
  [
    'operation' => 'CreateAccount',
    'slug' => 'avalara_create_account',
    'class' => 'AvalaraCreateAccount',
    'method' => 'POST',
    'path' => '/api/v2/accounts',
    'name' => 'Create a new account',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateAccount`.

Endpoint: POST /api/v2/accounts.',
    'type' => 'write',
    'tag' => 'Registrar',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The account you wish to create.',
      ],
    ],
  ],
  341 =>
  [
    'operation' => 'CreateNotifications',
    'slug' => 'avalara_create_notifications',
    'class' => 'AvalaraCreateNotifications',
    'method' => 'POST',
    'path' => '/api/v2/notifications',
    'name' => 'Create new notifications.',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateNotifications`.

Endpoint: POST /api/v2/notifications.',
    'type' => 'write',
    'tag' => 'Registrar',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The notifications you wish to create.',
      ],
    ],
  ],
  342 =>
  [
    'operation' => 'CreateSubscriptions',
    'slug' => 'avalara_create_subscriptions',
    'class' => 'AvalaraCreateSubscriptions',
    'method' => 'POST',
    'path' => '/api/v2/accounts/{accountId}/subscriptions',
    'name' => 'Create a new subscription',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateSubscriptions`.

Endpoint: POST /api/v2/accounts/{accountId}/subscriptions.',
    'type' => 'write',
    'tag' => 'Registrar',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'accountId',
        'param' => 'account_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account that owns this subscription.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The subscription you wish to create.',
      ],
    ],
  ],
  343 =>
  [
    'operation' => 'DeleteAccount',
    'slug' => 'avalara_delete_account',
    'class' => 'AvalaraDeleteAccount',
    'method' => 'DELETE',
    'path' => '/api/v2/accounts/{id}',
    'name' => 'Delete a single account',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteAccount`.

Endpoint: DELETE /api/v2/accounts/{id}.',
    'type' => 'write',
    'tag' => 'Registrar',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account you wish to delete.',
      ],
    ],
  ],
  344 =>
  [
    'operation' => 'DeleteNotification',
    'slug' => 'avalara_delete_notification',
    'class' => 'AvalaraDeleteNotification',
    'method' => 'DELETE',
    'path' => '/api/v2/notifications/{id}',
    'name' => 'Delete a single notification.',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteNotification`.

Endpoint: DELETE /api/v2/notifications/{id}.',
    'type' => 'write',
    'tag' => 'Registrar',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The id of the notification you wish to delete.',
      ],
    ],
  ],
  345 =>
  [
    'operation' => 'DeleteSubscription',
    'slug' => 'avalara_delete_subscription',
    'class' => 'AvalaraDeleteSubscription',
    'method' => 'DELETE',
    'path' => '/api/v2/accounts/{accountId}/subscriptions/{id}',
    'name' => 'Delete a single subscription',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteSubscription`.

Endpoint: DELETE /api/v2/accounts/{accountId}/subscriptions/{id}.',
    'type' => 'write',
    'tag' => 'Registrar',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'accountId',
        'param' => 'account_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account that owns this subscription.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the subscription you wish to delete.',
      ],
    ],
  ],
  346 =>
  [
    'operation' => 'ListServiceTypes',
    'slug' => 'avalara_list_service_types',
    'class' => 'AvalaraListServiceTypes',
    'method' => 'GET',
    'path' => '/api/v2/servicetypes/servicetypes',
    'name' => 'Retrieve the full list of Avalara-supported subscription (ServiceTypes]',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListServiceTypes`.

Endpoint: GET /api/v2/servicetypes/servicetypes.',
    'type' => 'read',
    'tag' => 'Registrar',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* system, taxTypeGroupIdSK',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  347 =>
  [
    'operation' => 'ResetPassword',
    'slug' => 'avalara_reset_password',
    'class' => 'AvalaraResetPassword',
    'method' => 'POST',
    'path' => '/api/v2/passwords/{userId}/reset',
    'name' => 'Reset a user\'s password programmatically',
    'description' => 'Execute official Avalara AvaTax REST API operation `ResetPassword`.

Endpoint: POST /api/v2/passwords/{userId}/reset.',
    'type' => 'write',
    'tag' => 'Registrar',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'userId',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID of the user whose password will be changed',
      ],
      1 =>
      [
        'name' => 'isUndoMigrateRequest',
        'param' => 'is_undo_migrate_request',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If user\'s password was migrated to AI, undo this.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The new password for this user',
      ],
    ],
  ],
  348 =>
  [
    'operation' => 'UpdateAccount',
    'slug' => 'avalara_update_account',
    'class' => 'AvalaraUpdateAccount',
    'method' => 'PUT',
    'path' => '/api/v2/accounts/{id}',
    'name' => 'Update a single account',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateAccount`.

Endpoint: PUT /api/v2/accounts/{id}.',
    'type' => 'write',
    'tag' => 'Registrar',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account you wish to update.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The account object you wish to update.',
      ],
    ],
  ],
  349 =>
  [
    'operation' => 'UpdateNotification',
    'slug' => 'avalara_update_notification',
    'class' => 'AvalaraUpdateNotification',
    'method' => 'PUT',
    'path' => '/api/v2/notifications/{id}',
    'name' => 'Update a single notification.',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateNotification`.

Endpoint: PUT /api/v2/notifications/{id}.',
    'type' => 'write',
    'tag' => 'Registrar',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The id of the notification you wish to update.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The notification object you wish to update.',
      ],
    ],
  ],
  350 =>
  [
    'operation' => 'UpdateSubscription',
    'slug' => 'avalara_update_subscription',
    'class' => 'AvalaraUpdateSubscription',
    'method' => 'PUT',
    'path' => '/api/v2/accounts/{accountId}/subscriptions/{id}',
    'name' => 'Update a single subscription',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateSubscription`.

Endpoint: PUT /api/v2/accounts/{accountId}/subscriptions/{id}.',
    'type' => 'write',
    'tag' => 'Registrar',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'accountId',
        'param' => 'account_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account that this subscription belongs to.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the subscription you wish to update',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The subscription you wish to update.',
      ],
    ],
  ],
  351 =>
  [
    'operation' => 'DownloadReport',
    'slug' => 'avalara_download_report',
    'class' => 'AvalaraDownloadReport',
    'method' => 'GET',
    'path' => '/api/v2/reports/{id}/attachment',
    'name' => 'Download a report',
    'description' => 'Execute official Avalara AvaTax REST API operation `DownloadReport`.

Endpoint: GET /api/v2/reports/{id}/attachment.',
    'type' => 'read',
    'tag' => 'Reports',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of this report',
      ],
    ],
  ],
  352 =>
  [
    'operation' => 'GetReport',
    'slug' => 'avalara_get_report',
    'class' => 'AvalaraGetReport',
    'method' => 'GET',
    'path' => '/api/v2/reports/{id}',
    'name' => 'Retrieve a single report',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetReport`.

Endpoint: GET /api/v2/reports/{id}.',
    'type' => 'read',
    'tag' => 'Reports',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the report to retrieve',
      ],
    ],
  ],
  353 =>
  [
    'operation' => 'InitiateExportDocumentLineReport',
    'slug' => 'avalara_initiate_export_document_line_report',
    'class' => 'AvalaraInitiateExportDocumentLineReport',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/reports/exportdocumentline/initiate',
    'name' => 'Initiate an ExportDocumentLine report task',
    'description' => 'Execute official Avalara AvaTax REST API operation `InitiateExportDocumentLineReport`.

Endpoint: POST /api/v2/companies/{companyId}/reports/exportdocumentline/initiate.',
    'type' => 'write',
    'tag' => 'Reports',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company to report on.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Options that may be configured to customize the report.',
      ],
    ],
  ],
  354 =>
  [
    'operation' => 'ListReports',
    'slug' => 'avalara_list_reports',
    'class' => 'AvalaraListReports',
    'method' => 'GET',
    'path' => '/api/v2/reports',
    'name' => 'List all report tasks for account',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListReports`.

Endpoint: GET /api/v2/reports.',
    'type' => 'read',
    'tag' => 'Reports',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The id of the company for which to get reports.',
      ],
      1 =>
      [
        'name' => 'pageKey',
        'param' => 'page_key',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Provide a page key to retrieve the next page of results.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
    ],
  ],
  355 =>
  [
    'operation' => 'CreateSettings',
    'slug' => 'avalara_create_settings',
    'class' => 'AvalaraCreateSettings',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/settings',
    'name' => 'Create a new setting',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateSettings`.

Endpoint: POST /api/v2/companies/{companyId}/settings.',
    'type' => 'write',
    'tag' => 'Settings',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this setting.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The setting you wish to create.',
      ],
    ],
  ],
  356 =>
  [
    'operation' => 'DeleteSetting',
    'slug' => 'avalara_delete_setting',
    'class' => 'AvalaraDeleteSetting',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/settings/{id}',
    'name' => 'Delete a single setting',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteSetting`.

Endpoint: DELETE /api/v2/companies/{companyId}/settings/{id}.',
    'type' => 'write',
    'tag' => 'Settings',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this setting.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the setting you wish to delete.',
      ],
    ],
  ],
  357 =>
  [
    'operation' => 'GetSetting',
    'slug' => 'avalara_get_setting',
    'class' => 'AvalaraGetSetting',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/settings/{id}',
    'name' => 'Retrieve a single setting',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetSetting`.

Endpoint: GET /api/v2/companies/{companyId}/settings/{id}.',
    'type' => 'read',
    'tag' => 'Settings',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this setting',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this setting',
      ],
    ],
  ],
  358 =>
  [
    'operation' => 'ListSettingsByCompany',
    'slug' => 'avalara_list_settings_by_company',
    'class' => 'AvalaraListSettingsByCompany',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/settings',
    'name' => 'Retrieve all settings for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListSettingsByCompany`.

Endpoint: GET /api/v2/companies/{companyId}/settings.',
    'type' => 'read',
    'tag' => 'Settings',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns these settings',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* modifiedDate, ModifiedUserId',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  359 =>
  [
    'operation' => 'QuerySettings',
    'slug' => 'avalara_query_settings',
    'class' => 'AvalaraQuerySettings',
    'method' => 'GET',
    'path' => '/api/v2/settings',
    'name' => 'Retrieve all settings',
    'description' => 'Execute official Avalara AvaTax REST API operation `QuerySettings`.

Endpoint: GET /api/v2/settings.',
    'type' => 'read',
    'tag' => 'Settings',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* modifiedDate, ModifiedUserId',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  360 =>
  [
    'operation' => 'UpdateSetting',
    'slug' => 'avalara_update_setting',
    'class' => 'AvalaraUpdateSetting',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/settings/{id}',
    'name' => 'Update a single setting',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateSetting`.

Endpoint: PUT /api/v2/companies/{companyId}/settings/{id}.',
    'type' => 'write',
    'tag' => 'Settings',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that this setting belongs to.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the setting you wish to update',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The setting you wish to update.',
      ],
    ],
  ],
  361 =>
  [
    'operation' => 'GetSubscription',
    'slug' => 'avalara_get_subscription',
    'class' => 'AvalaraGetSubscription',
    'method' => 'GET',
    'path' => '/api/v2/accounts/{accountId}/subscriptions/{id}',
    'name' => 'Retrieve a single subscription',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetSubscription`.

Endpoint: GET /api/v2/accounts/{accountId}/subscriptions/{id}.',
    'type' => 'read',
    'tag' => 'Subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'accountId',
        'param' => 'account_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account that owns this subscription',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this subscription',
      ],
    ],
  ],
  362 =>
  [
    'operation' => 'ListSubscriptionsByAccount',
    'slug' => 'avalara_list_subscriptions_by_account',
    'class' => 'AvalaraListSubscriptionsByAccount',
    'method' => 'GET',
    'path' => '/api/v2/accounts/{accountId}/subscriptions',
    'name' => 'Retrieve subscriptions for this account',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListSubscriptionsByAccount`.

Endpoint: GET /api/v2/accounts/{accountId}/subscriptions.',
    'type' => 'read',
    'tag' => 'Subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'accountId',
        'param' => 'account_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the account that owns these subscriptions',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* subscriptionDescription',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  363 =>
  [
    'operation' => 'QuerySubscriptions',
    'slug' => 'avalara_query_subscriptions',
    'class' => 'AvalaraQuerySubscriptions',
    'method' => 'GET',
    'path' => '/api/v2/subscriptions',
    'name' => 'Retrieve all subscriptions',
    'description' => 'Execute official Avalara AvaTax REST API operation `QuerySubscriptions`.

Endpoint: GET /api/v2/subscriptions.',
    'type' => 'read',
    'tag' => 'Subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* subscriptionDescription',
      ],
      1 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      2 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      3 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  364 =>
  [
    'operation' => 'CreateTaxCodes',
    'slug' => 'avalara_create_tax_codes',
    'class' => 'AvalaraCreateTaxCodes',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/taxcodes',
    'name' => 'Create a new tax code',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateTaxCodes`.

Endpoint: POST /api/v2/companies/{companyId}/taxcodes.',
    'type' => 'write',
    'tag' => 'TaxCodes',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this tax code.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The tax code you wish to create.',
      ],
    ],
  ],
  365 =>
  [
    'operation' => 'DeleteTaxCode',
    'slug' => 'avalara_delete_tax_code',
    'class' => 'AvalaraDeleteTaxCode',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/taxcodes/{id}',
    'name' => 'Delete a single tax code',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteTaxCode`.

Endpoint: DELETE /api/v2/companies/{companyId}/taxcodes/{id}.',
    'type' => 'write',
    'tag' => 'TaxCodes',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this tax code.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the tax code you wish to delete.',
      ],
    ],
  ],
  366 =>
  [
    'operation' => 'GetTaxCode',
    'slug' => 'avalara_get_tax_code',
    'class' => 'AvalaraGetTaxCode',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/taxcodes/{id}',
    'name' => 'Retrieve a single tax code',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetTaxCode`.

Endpoint: GET /api/v2/companies/{companyId}/taxcodes/{id}.',
    'type' => 'read',
    'tag' => 'TaxCodes',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this tax code',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this tax code',
      ],
    ],
  ],
  367 =>
  [
    'operation' => 'ListTaxCodesByCompany',
    'slug' => 'avalara_list_tax_codes_by_company',
    'class' => 'AvalaraListTaxCodesByCompany',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/taxcodes',
    'name' => 'Retrieve tax codes for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListTaxCodesByCompany`.

Endpoint: GET /api/v2/companies/{companyId}/taxcodes.',
    'type' => 'read',
    'tag' => 'TaxCodes',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns these tax codes',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  368 =>
  [
    'operation' => 'QueryTaxCodes',
    'slug' => 'avalara_query_tax_codes',
    'class' => 'AvalaraQueryTaxCodes',
    'method' => 'GET',
    'path' => '/api/v2/taxcodes',
    'name' => 'Retrieve all tax codes',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryTaxCodes`.

Endpoint: GET /api/v2/taxcodes.',
    'type' => 'read',
    'tag' => 'TaxCodes',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  369 =>
  [
    'operation' => 'UpdateTaxCode',
    'slug' => 'avalara_update_tax_code',
    'class' => 'AvalaraUpdateTaxCode',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/taxcodes/{id}',
    'name' => 'Update a single tax code',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateTaxCode`.

Endpoint: PUT /api/v2/companies/{companyId}/taxcodes/{id}.',
    'type' => 'write',
    'tag' => 'TaxCodes',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that this tax code belongs to.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the tax code you wish to update',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The tax code you wish to update.',
      ],
    ],
  ],
  370 =>
  [
    'operation' => 'BuildTaxContentFile',
    'slug' => 'avalara_build_tax_content_file',
    'class' => 'AvalaraBuildTaxContentFile',
    'method' => 'POST',
    'path' => '/api/v2/pointofsaledata/build',
    'name' => 'Build a multi-location tax content file',
    'description' => 'Execute official Avalara AvaTax REST API operation `BuildTaxContentFile`.

Endpoint: POST /api/v2/pointofsaledata/build.',
    'type' => 'write',
    'tag' => 'TaxContent',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Parameters about the desired file format and report format, specifying which company, locations and TaxCodes to include.',
      ],
    ],
  ],
  371 =>
  [
    'operation' => 'BuildTaxContentFileForLocation',
    'slug' => 'avalara_build_tax_content_file_for_location',
    'class' => 'AvalaraBuildTaxContentFileForLocation',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/locations/{id}/pointofsaledata',
    'name' => 'Build a tax content file for a single location',
    'description' => 'Execute official Avalara AvaTax REST API operation `BuildTaxContentFileForLocation`.

Endpoint: GET /api/v2/companies/{companyId}/locations/{id}/pointofsaledata.',
    'type' => 'read',
    'tag' => 'TaxContent',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID number of the company that owns this location.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID number of the location to retrieve point-of-sale data.',
      ],
      2 =>
      [
        'name' => 'date',
        'param' => 'date',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The date for which point-of-sale data would be calculated (today by default]',
      ],
      3 =>
      [
        'name' => 'format',
        'param' => 'format',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The format of the file (JSON by default]',
      ],
      4 =>
      [
        'name' => 'partnerId',
        'param' => 'partner_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'If specified, requests a custom partner-formatted version of the file.',
      ],
      5 =>
      [
        'name' => 'includeJurisCodes',
        'param' => 'include_juris_codes',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'When true, the file will include jurisdiction codes in the result.',
      ],
    ],
  ],
  372 =>
  [
    'operation' => 'DownloadTaxRatesByZipCode',
    'slug' => 'avalara_download_tax_rates_by_zip_code',
    'class' => 'AvalaraDownloadTaxRatesByZipCode',
    'method' => 'GET',
    'path' => '/api/v2/taxratesbyzipcode/download/{date}',
    'name' => 'Download a file listing tax rates by postal code',
    'description' => 'Execute official Avalara AvaTax REST API operation `DownloadTaxRatesByZipCode`.

Endpoint: GET /api/v2/taxratesbyzipcode/download/{date}.',
    'type' => 'read',
    'tag' => 'TaxContent',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'date',
        'param' => 'date',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The date for which point-of-sale data would be calculated (today by default]. Example input: 2016-12-31',
      ],
      1 =>
      [
        'name' => 'region',
        'param' => 'region',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A two character region code which limits results to a specific region.',
      ],
    ],
  ],
  373 =>
  [
    'operation' => 'GetVATRatesByCountry',
    'slug' => 'avalara_get_vat_rates_by_country',
    'class' => 'AvalaraGetVATRatesByCountry',
    'method' => 'GET',
    'path' => '/api/v2/taxcontent/rates/{country}',
    'name' => 'Get VAT rates for a country',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetVATRatesByCountry`.

Endpoint: GET /api/v2/taxcontent/rates/{country}.',
    'type' => 'read',
    'tag' => 'TaxContent',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Country code (e.g., "CA", "BE"]',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* displayName, jurisCode, jurisdictionTypeId, country, taxTypeGroupId',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  374 =>
  [
    'operation' => 'TaxRatesByAddress',
    'slug' => 'avalara_tax_rates_by_address',
    'class' => 'AvalaraTaxRatesByAddress',
    'method' => 'GET',
    'path' => '/api/v2/taxrates/byaddress',
    'name' => 'Sales tax rates for a specified address',
    'description' => 'Execute official Avalara AvaTax REST API operation `TaxRatesByAddress`.

Endpoint: GET /api/v2/taxrates/byaddress.',
    'type' => 'read',
    'tag' => 'TaxContent',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'line1',
        'param' => 'line1',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The street address of the location.',
      ],
      1 =>
      [
        'name' => 'line2',
        'param' => 'line2',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The street address of the location.',
      ],
      2 =>
      [
        'name' => 'line3',
        'param' => 'line3',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The street address of the location.',
      ],
      3 =>
      [
        'name' => 'city',
        'param' => 'city',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The city name of the location.',
      ],
      4 =>
      [
        'name' => 'region',
        'param' => 'region',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Name or ISO 3166 code identifying the region within the country. This field supports many different region identifiers: * Two and three character ISO 3166 region codes * Fully spelled out names of the region in ISO supported languages * Common alternative spellings for many regions For a full list of all supported codes and names, please see the Definitions API `ListRegions`.',
      ],
      5 =>
      [
        'name' => 'postalCode',
        'param' => 'postal_code',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The postal code of the location.',
      ],
      6 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Name or ISO 3166 code identifying the country. This field supports many different country identifiers: * Two character ISO 3166 codes * Three character ISO 3166 codes * Fully spelled out names of the country in ISO supported languages * Common alternative spellings for many countries For a full list of all supported codes and names, please see the Definitions API `ListCountries`.',
      ],
    ],
  ],
  375 =>
  [
    'operation' => 'TaxRatesByPostalCode',
    'slug' => 'avalara_tax_rates_by_postal_code',
    'class' => 'AvalaraTaxRatesByPostalCode',
    'method' => 'GET',
    'path' => '/api/v2/taxrates/bypostalcode',
    'name' => 'Sales tax rates for a specified country and postal code. This API is only available for US postal codes.',
    'description' => 'Execute official Avalara AvaTax REST API operation `TaxRatesByPostalCode`.

Endpoint: GET /api/v2/taxrates/bypostalcode.',
    'type' => 'read',
    'tag' => 'TaxContent',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Name or ISO 3166 code identifying the country. This field supports many different country identifiers: * Two character ISO 3166 codes * Three character ISO 3166 codes * Fully spelled out names of the country in ISO supported languages * Common alternative spellings for many countries For a full list of all supported codes and names, please see the Definitions API `ListCountries`.',
      ],
      1 =>
      [
        'name' => 'postalCode',
        'param' => 'postal_code',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The postal code of the location.',
      ],
    ],
  ],
  376 =>
  [
    'operation' => 'CreateCountryCoefficients',
    'slug' => 'avalara_create_country_coefficients',
    'class' => 'AvalaraCreateCountryCoefficients',
    'method' => 'PUT',
    'path' => '/api/v2/countryCoefficients',
    'name' => 'Create new Country Coefficients. If already exist update them.',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateCountryCoefficients`.

Endpoint: PUT /api/v2/countryCoefficients.',
    'type' => 'write',
    'tag' => 'TaxRules',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'The Country Coefficients for specific country you wish to create.',
      ],
    ],
  ],
  377 =>
  [
    'operation' => 'CreateTaxRules',
    'slug' => 'avalara_create_tax_rules',
    'class' => 'AvalaraCreateTaxRules',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/taxrules',
    'name' => 'Create a new tax rule',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateTaxRules`.

Endpoint: POST /api/v2/companies/{companyId}/taxrules.',
    'type' => 'write',
    'tag' => 'TaxRules',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this tax rule.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The tax rule you wish to create.',
      ],
    ],
  ],
  378 =>
  [
    'operation' => 'DeleteTaxRule',
    'slug' => 'avalara_delete_tax_rule',
    'class' => 'AvalaraDeleteTaxRule',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/taxrules/{id}',
    'name' => 'Delete a single tax rule',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteTaxRule`.

Endpoint: DELETE /api/v2/companies/{companyId}/taxrules/{id}.',
    'type' => 'write',
    'tag' => 'TaxRules',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this tax rule.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the tax rule you wish to delete.',
      ],
    ],
  ],
  379 =>
  [
    'operation' => 'GetTaxRule',
    'slug' => 'avalara_get_tax_rule',
    'class' => 'AvalaraGetTaxRule',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/taxrules/{id}',
    'name' => 'Retrieve a single tax rule',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetTaxRule`.

Endpoint: GET /api/v2/companies/{companyId}/taxrules/{id}.',
    'type' => 'read',
    'tag' => 'TaxRules',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this tax rule',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this tax rule',
      ],
    ],
  ],
  380 =>
  [
    'operation' => 'ListCountryCoefficients',
    'slug' => 'avalara_list_country_coefficients',
    'class' => 'AvalaraListCountryCoefficients',
    'method' => 'GET',
    'path' => '/api/v2/{country}/CountryCoefficients',
    'name' => 'Retrieve country coefficients for specific country',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCountryCoefficients`.

Endpoint: GET /api/v2/{country}/CountryCoefficients.',
    'type' => 'read',
    'tag' => 'TaxRules',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country',
        'param' => 'country',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Country for which data need to be pulled for.',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* CoefficientsId, AccountId, ModifiedUserId, CreatedUserId',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  381 =>
  [
    'operation' => 'ListTaxRules',
    'slug' => 'avalara_list_tax_rules',
    'class' => 'AvalaraListTaxRules',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/taxrules',
    'name' => 'Retrieve tax rules for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListTaxRules`.

Endpoint: GET /api/v2/companies/{companyId}/taxrules.',
    'type' => 'read',
    'tag' => 'TaxRules',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns these tax rules',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* taxCode, taxTypeCode, taxRuleProductDetail, rateTypeCode, taxTypeGroup, taxSubType, unitOfBasis',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  382 =>
  [
    'operation' => 'QueryTaxRules',
    'slug' => 'avalara_query_tax_rules',
    'class' => 'AvalaraQueryTaxRules',
    'method' => 'GET',
    'path' => '/api/v2/taxrules',
    'name' => 'Retrieve all tax rules',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryTaxRules`.

Endpoint: GET /api/v2/taxrules.',
    'type' => 'read',
    'tag' => 'TaxRules',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* taxCode, taxTypeCode, taxRuleProductDetail, rateTypeCode, taxTypeGroup, taxSubType, unitOfBasis',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  383 =>
  [
    'operation' => 'UpdateTaxRule',
    'slug' => 'avalara_update_tax_rule',
    'class' => 'AvalaraUpdateTaxRule',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/taxrules/{id}',
    'name' => 'Update a single tax rule',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateTaxRule`.

Endpoint: PUT /api/v2/companies/{companyId}/taxrules/{id}.',
    'type' => 'write',
    'tag' => 'TaxRules',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that this tax rule belongs to.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the tax rule you wish to update',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The tax rule you wish to update.',
      ],
    ],
  ],
  384 =>
  [
    'operation' => 'AddLines',
    'slug' => 'avalara_add_lines',
    'class' => 'AvalaraAddLines',
    'method' => 'POST',
    'path' => '/api/v2/companies/transactions/lines/add',
    'name' => 'Add lines to an existing unlocked transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `AddLines`.

Endpoint: POST /api/v2/companies/transactions/lines/add.',
    'type' => 'write',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in the response after transaction is created',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'information about the transaction and lines to be added',
      ],
    ],
  ],
  385 =>
  [
    'operation' => 'AdjustTransaction',
    'slug' => 'avalara_adjust_transaction',
    'class' => 'AvalaraAdjustTransaction',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyCode}/transactions/{transactionCode}/adjust',
    'name' => 'Correct a previously created transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `AdjustTransaction`.

Endpoint: POST /api/v2/companies/{companyCode}/transactions/{transactionCode}/adjust.',
    'type' => 'write',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The company code of the company that recorded this transaction',
      ],
      1 =>
      [
        'name' => 'transactionCode',
        'param' => 'transaction_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction code to adjust',
      ],
      2 =>
      [
        'name' => 'documentType',
        'param' => 'document_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '(Optional]: The document type of the transaction to adjust.',
      ],
      3 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in this fetch call',
      ],
      4 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The adjustment you wish to make',
      ],
    ],
  ],
  386 =>
  [
    'operation' => 'AuditTransaction',
    'slug' => 'avalara_audit_transaction',
    'class' => 'AvalaraAuditTransaction',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyCode}/transactions/{transactionCode}/audit',
    'name' => 'Get audit information about a transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `AuditTransaction`.

Endpoint: GET /api/v2/companies/{companyCode}/transactions/{transactionCode}/audit.',
    'type' => 'read',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The code identifying the company that owns this transaction',
      ],
      1 =>
      [
        'name' => 'transactionCode',
        'param' => 'transaction_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The code identifying the transaction',
      ],
    ],
  ],
  387 =>
  [
    'operation' => 'AuditTransactionWithType',
    'slug' => 'avalara_audit_transaction_with_type',
    'class' => 'AvalaraAuditTransactionWithType',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyCode}/transactions/{transactionCode}/types/{documentType}/audit',
    'name' => 'Get audit information about a transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `AuditTransactionWithType`.

Endpoint: GET /api/v2/companies/{companyCode}/transactions/{transactionCode}/types/{documentType}/audit.',
    'type' => 'read',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The code identifying the company that owns this transaction',
      ],
      1 =>
      [
        'name' => 'transactionCode',
        'param' => 'transaction_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The code identifying the transaction',
      ],
      2 =>
      [
        'name' => 'documentType',
        'param' => 'document_type',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The document type of the original transaction',
      ],
    ],
  ],
  388 =>
  [
    'operation' => 'BulkLockTransaction',
    'slug' => 'avalara_bulk_lock_transaction',
    'class' => 'AvalaraBulkLockTransaction',
    'method' => 'POST',
    'path' => '/api/v2/transactions/lock',
    'name' => 'Lock a set of documents',
    'description' => 'Execute official Avalara AvaTax REST API operation `BulkLockTransaction`.

Endpoint: POST /api/v2/transactions/lock.',
    'type' => 'write',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'bulk lock request',
      ],
    ],
  ],
  389 =>
  [
    'operation' => 'ChangeTransactionCode',
    'slug' => 'avalara_change_transaction_code',
    'class' => 'AvalaraChangeTransactionCode',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyCode}/transactions/{transactionCode}/changecode',
    'name' => 'Change a transaction\'s code',
    'description' => 'Execute official Avalara AvaTax REST API operation `ChangeTransactionCode`.

Endpoint: POST /api/v2/companies/{companyCode}/transactions/{transactionCode}/changecode.',
    'type' => 'write',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The company code of the company that recorded this transaction',
      ],
      1 =>
      [
        'name' => 'transactionCode',
        'param' => 'transaction_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction code to change',
      ],
      2 =>
      [
        'name' => 'documentType',
        'param' => 'document_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '(Optional]: The document type of the transaction to change document code. If not provided, the default is SalesInvoice.',
      ],
      3 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in this fetch call',
      ],
      4 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The code change request you wish to execute',
      ],
    ],
  ],
  390 =>
  [
    'operation' => 'CommitTransaction',
    'slug' => 'avalara_commit_transaction',
    'class' => 'AvalaraCommitTransaction',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyCode}/transactions/{transactionCode}/commit',
    'name' => 'Commit a transaction for reporting',
    'description' => 'Execute official Avalara AvaTax REST API operation `CommitTransaction`.

Endpoint: POST /api/v2/companies/{companyCode}/transactions/{transactionCode}/commit.',
    'type' => 'write',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The company code of the company that recorded this transaction',
      ],
      1 =>
      [
        'name' => 'transactionCode',
        'param' => 'transaction_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction code to commit',
      ],
      2 =>
      [
        'name' => 'documentType',
        'param' => 'document_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '(Optional]: The document type of the transaction to commit. If not provided, the default is SalesInvoice.',
      ],
      3 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in this fetch call',
      ],
      4 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The commit request you wish to execute',
      ],
    ],
  ],
  391 =>
  [
    'operation' => 'CreateOrAdjustTransaction',
    'slug' => 'avalara_create_or_adjust_transaction',
    'class' => 'AvalaraCreateOrAdjustTransaction',
    'method' => 'POST',
    'path' => '/api/v2/transactions/createoradjust',
    'name' => 'Create or adjust a transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateOrAdjustTransaction`.

Endpoint: POST /api/v2/transactions/createoradjust.',
    'type' => 'write',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in the response after transaction is created',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The transaction you wish to create or adjust',
      ],
    ],
  ],
  392 =>
  [
    'operation' => 'CreateTransaction',
    'slug' => 'avalara_create_transaction',
    'class' => 'AvalaraCreateTransaction',
    'method' => 'POST',
    'path' => '/api/v2/transactions/create',
    'name' => 'Create a new transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateTransaction`.

Endpoint: POST /api/v2/transactions/create.',
    'type' => 'write',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in the response after transaction is created',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The transaction you wish to create',
      ],
    ],
  ],
  393 =>
  [
    'operation' => 'DeleteLines',
    'slug' => 'avalara_delete_lines',
    'class' => 'AvalaraDeleteLines',
    'method' => 'POST',
    'path' => '/api/v2/companies/transactions/lines/delete',
    'name' => 'Remove lines from an existing unlocked transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteLines`.

Endpoint: POST /api/v2/companies/transactions/lines/delete.',
    'type' => 'write',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in the response after transaction is created',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'information about the transaction and lines to be removed',
      ],
    ],
  ],
  394 =>
  [
    'operation' => 'GetAllVarianceReportByCompanyCode',
    'slug' => 'avalara_get_all_variance_report_by_company_code',
    'class' => 'AvalaraGetAllVarianceReportByCompanyCode',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyCode}/AllVariance',
    'name' => 'Fetches the Variance data generated for all the transactions done by Company.',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetAllVarianceReportByCompanyCode`.

Endpoint: GET /api/v2/companies/{companyCode}/AllVariance.',
    'type' => 'read',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  395 =>
  [
    'operation' => 'GetTransactionByCode',
    'slug' => 'avalara_get_transaction_by_code',
    'class' => 'AvalaraGetTransactionByCode',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyCode}/transactions/{transactionCode}',
    'name' => 'Retrieve a single transaction by code',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetTransactionByCode`.

Endpoint: GET /api/v2/companies/{companyCode}/transactions/{transactionCode}.',
    'type' => 'read',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The company code of the company that recorded this transaction',
      ],
      1 =>
      [
        'name' => 'transactionCode',
        'param' => 'transaction_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction code to retrieve',
      ],
      2 =>
      [
        'name' => 'documentType',
        'param' => 'document_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '(Optional]: The document type of the transaction to retrieve',
      ],
      3 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in this fetch call',
      ],
    ],
  ],
  396 =>
  [
    'operation' => 'GetTransactionByCodeAndType',
    'slug' => 'avalara_get_transaction_by_code_and_type',
    'class' => 'AvalaraGetTransactionByCodeAndType',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyCode}/transactions/{transactionCode}/types/{documentType}',
    'name' => 'Retrieve a single transaction by code',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetTransactionByCodeAndType`.

Endpoint: GET /api/v2/companies/{companyCode}/transactions/{transactionCode}/types/{documentType}.',
    'type' => 'read',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The company code of the company that recorded this transaction',
      ],
      1 =>
      [
        'name' => 'transactionCode',
        'param' => 'transaction_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction code to retrieve',
      ],
      2 =>
      [
        'name' => 'documentType',
        'param' => 'document_type',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction type to retrieve',
      ],
      3 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in this fetch call',
      ],
    ],
  ],
  397 =>
  [
    'operation' => 'GetTransactionById',
    'slug' => 'avalara_get_transaction_by_id',
    'class' => 'AvalaraGetTransactionById',
    'method' => 'GET',
    'path' => '/api/v2/transactions/{id}',
    'name' => 'Retrieve a single transaction by ID',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetTransactionById`.

Endpoint: GET /api/v2/transactions/{id}.',
    'type' => 'read',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the transaction to retrieve',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in this fetch call',
      ],
    ],
  ],
  398 =>
  [
    'operation' => 'GetVarianceReportByCompanyCodeByTransactionId',
    'slug' => 'avalara_get_variance_report_by_company_code_by_transaction_id',
    'class' => 'AvalaraGetVarianceReportByCompanyCodeByTransactionId',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyCode}/transactions/{transactionId}/variance',
    'name' => 'Fetches the Variance data generated for particular Company by transaction ID',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetVarianceReportByCompanyCodeByTransactionId`.

Endpoint: GET /api/v2/companies/{companyCode}/transactions/{transactionId}/variance.',
    'type' => 'read',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => '',
      ],
      1 =>
      [
        'name' => 'transactionId',
        'param' => 'transaction_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  399 =>
  [
    'operation' => 'ListTransactionsByCompany',
    'slug' => 'avalara_list_transactions_by_company',
    'class' => 'AvalaraListTransactionsByCompany',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyCode}/transactions',
    'name' => 'Retrieve all transactions',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListTransactionsByCompany`.

Endpoint: GET /api/v2/companies/{companyCode}/transactions.',
    'type' => 'read',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The company code of the company that recorded this transaction',
      ],
      1 =>
      [
        'name' => 'dataSourceId',
        'param' => 'data_source_id',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Optionally filter transactions to those from a specific data source.',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in this fetch call',
      ],
      3 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* exchangeRateCurrencyCode, totalDiscount, lines, addresses, locationTypes, summary, taxDetailsByTaxType, parameters, userDefinedFields, messages, invoiceMessages, isFakeTransaction, deliveryTerms, apStatusCode, apStatus, vendorName, varianceAmount',
      ],
      4 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      5 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      6 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  400 =>
  [
    'operation' => 'LockTransaction',
    'slug' => 'avalara_lock_transaction',
    'class' => 'AvalaraLockTransaction',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyCode}/transactions/{transactionCode}/lock',
    'name' => 'Lock a single transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `LockTransaction`.

Endpoint: POST /api/v2/companies/{companyCode}/transactions/{transactionCode}/lock.',
    'type' => 'write',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The company code of the company that recorded this transaction',
      ],
      1 =>
      [
        'name' => 'transactionCode',
        'param' => 'transaction_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction code to lock',
      ],
      2 =>
      [
        'name' => 'documentType',
        'param' => 'document_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '(Optional]: The document type of the transaction to lock. If not provided, the default is SalesInvoice.',
      ],
      3 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in this fetch call',
      ],
      4 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The lock request you wish to execute',
      ],
    ],
  ],
  401 =>
  [
    'operation' => 'RefundTransaction',
    'slug' => 'avalara_refund_transaction',
    'class' => 'AvalaraRefundTransaction',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyCode}/transactions/{transactionCode}/refund',
    'name' => 'Create a refund for a transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `RefundTransaction`.

Endpoint: POST /api/v2/companies/{companyCode}/transactions/{transactionCode}/refund.',
    'type' => 'write',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The code of the company that made the original sale',
      ],
      1 =>
      [
        'name' => 'transactionCode',
        'param' => 'transaction_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction code of the original sale',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in the response after transaction is created',
      ],
      3 =>
      [
        'name' => 'documentType',
        'param' => 'document_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '(Optional]: The document type of the transaction to refund. If not provided, the default is SalesInvoice.',
      ],
      4 =>
      [
        'name' => 'useTaxDateOverride',
        'param' => 'use_tax_date_override',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => '(Optional]: If set to true, processes refund using taxDateOverride rather than taxAmountOverride (Note: taxAmountOverride is not allowed for SST states].',
      ],
      5 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'Information about the refund to create',
      ],
    ],
  ],
  402 =>
  [
    'operation' => 'SettleTransaction',
    'slug' => 'avalara_settle_transaction',
    'class' => 'AvalaraSettleTransaction',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyCode}/transactions/{transactionCode}/settle',
    'name' => 'Perform multiple actions on a transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `SettleTransaction`.

Endpoint: POST /api/v2/companies/{companyCode}/transactions/{transactionCode}/settle.',
    'type' => 'write',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The company code of the company that recorded this transaction',
      ],
      1 =>
      [
        'name' => 'transactionCode',
        'param' => 'transaction_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction code to settle',
      ],
      2 =>
      [
        'name' => 'documentType',
        'param' => 'document_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '(Optional]: The document type of the transaction to settle. If not provided, the default is SalesInvoice.',
      ],
      3 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in this fetch call',
      ],
      4 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The data from an external system to reconcile against AvaTax',
      ],
    ],
  ],
  403 =>
  [
    'operation' => 'UncommitTransaction',
    'slug' => 'avalara_uncommit_transaction',
    'class' => 'AvalaraUncommitTransaction',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyCode}/transactions/{transactionCode}/uncommit',
    'name' => 'Uncommit a transaction for reporting',
    'description' => 'Execute official Avalara AvaTax REST API operation `UncommitTransaction`.

Endpoint: POST /api/v2/companies/{companyCode}/transactions/{transactionCode}/uncommit.',
    'type' => 'write',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The company code of the company that recorded this transaction',
      ],
      1 =>
      [
        'name' => 'transactionCode',
        'param' => 'transaction_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction code to Uncommit',
      ],
      2 =>
      [
        'name' => 'documentType',
        'param' => 'document_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '(Optional]: The document type of the transaction to Uncommit. If not provided, the default is SalesInvoice.',
      ],
      3 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in this fetch call',
      ],
    ],
  ],
  404 =>
  [
    'operation' => 'UnvoidTransaction',
    'slug' => 'avalara_unvoid_transaction',
    'class' => 'AvalaraUnvoidTransaction',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyCode}/transactions/{transactionCode}/unvoid',
    'name' => 'Unvoids a transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `UnvoidTransaction`.

Endpoint: POST /api/v2/companies/{companyCode}/transactions/{transactionCode}/unvoid.',
    'type' => 'write',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The company code of the company that recorded this transaction',
      ],
      1 =>
      [
        'name' => 'transactionCode',
        'param' => 'transaction_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction code to commit',
      ],
      2 =>
      [
        'name' => 'documentType',
        'param' => 'document_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '(Optional]: The document type of the transaction to commit. If not provided, the default is SalesInvoice.',
      ],
      3 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in this fetch call',
      ],
    ],
  ],
  405 =>
  [
    'operation' => 'VarianceReport',
    'slug' => 'avalara_variance_report',
    'class' => 'AvalaraVarianceReport',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyCode}/variance',
    'name' => 'Generates the Variance report which will capture the difference between "Tax Calculated by Avalara" Vs "Actual Tax" paid at custom clearance at line / header level.',
    'description' => 'Execute official Avalara AvaTax REST API operation `VarianceReport`.

Endpoint: POST /api/v2/companies/{companyCode}/variance.',
    'type' => 'write',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => '',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  406 =>
  [
    'operation' => 'VerifyTransaction',
    'slug' => 'avalara_verify_transaction',
    'class' => 'AvalaraVerifyTransaction',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyCode}/transactions/{transactionCode}/verify',
    'name' => 'Verify a transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `VerifyTransaction`.

Endpoint: POST /api/v2/companies/{companyCode}/transactions/{transactionCode}/verify.',
    'type' => 'write',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The company code of the company that recorded this transaction',
      ],
      1 =>
      [
        'name' => 'transactionCode',
        'param' => 'transaction_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction code to settle',
      ],
      2 =>
      [
        'name' => 'documentType',
        'param' => 'document_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '(Optional]: The document type of the transaction to verify. If not provided, the default is SalesInvoice.',
      ],
      3 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in this fetch call',
      ],
      4 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The data from an external system to reconcile against AvaTax',
      ],
    ],
  ],
  407 =>
  [
    'operation' => 'VoidTransaction',
    'slug' => 'avalara_void_transaction',
    'class' => 'AvalaraVoidTransaction',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyCode}/transactions/{transactionCode}/void',
    'name' => 'Void a transaction',
    'description' => 'Execute official Avalara AvaTax REST API operation `VoidTransaction`.

Endpoint: POST /api/v2/companies/{companyCode}/transactions/{transactionCode}/void.',
    'type' => 'write',
    'tag' => 'Transactions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyCode',
        'param' => 'company_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The company code of the company that recorded this transaction',
      ],
      1 =>
      [
        'name' => 'transactionCode',
        'param' => 'transaction_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The transaction code to void',
      ],
      2 =>
      [
        'name' => 'documentType',
        'param' => 'document_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => '(Optional]: The document type of the transaction to void. If not provided, the default is SalesInvoice.',
      ],
      3 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specifies objects to include in this fetch call',
      ],
      4 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The void request you wish to execute. To void a transaction the code must be set to \'DocVoided\'',
      ],
    ],
  ],
  408 =>
  [
    'operation' => 'CreateUPCs',
    'slug' => 'avalara_create_up_cs',
    'class' => 'AvalaraCreateUPCs',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/upcs',
    'name' => 'Create a new UPC',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateUPCs`.

Endpoint: POST /api/v2/companies/{companyId}/upcs.',
    'type' => 'write',
    'tag' => 'Upcs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this UPC.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The UPC you wish to create.',
      ],
    ],
  ],
  409 =>
  [
    'operation' => 'DeleteUPC',
    'slug' => 'avalara_delete_upc',
    'class' => 'AvalaraDeleteUPC',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/upcs/{id}',
    'name' => 'Delete a single UPC',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteUPC`.

Endpoint: DELETE /api/v2/companies/{companyId}/upcs/{id}.',
    'type' => 'write',
    'tag' => 'Upcs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this UPC.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the UPC you wish to delete.',
      ],
    ],
  ],
  410 =>
  [
    'operation' => 'GetUPC',
    'slug' => 'avalara_get_upc',
    'class' => 'AvalaraGetUPC',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/upcs/{id}',
    'name' => 'Retrieve a single UPC',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetUPC`.

Endpoint: GET /api/v2/companies/{companyId}/upcs/{id}.',
    'type' => 'read',
    'tag' => 'Upcs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns this UPC',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The primary key of this UPC',
      ],
    ],
  ],
  411 =>
  [
    'operation' => 'ListUPCsByCompany',
    'slug' => 'avalara_list_up_cs_by_company',
    'class' => 'AvalaraListUPCsByCompany',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/upcs',
    'name' => 'Retrieve UPCs for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListUPCsByCompany`.

Endpoint: GET /api/v2/companies/{companyId}/upcs.',
    'type' => 'read',
    'tag' => 'Upcs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that owns these UPCs',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  412 =>
  [
    'operation' => 'QueryUPCs',
    'slug' => 'avalara_query_up_cs',
    'class' => 'AvalaraQueryUPCs',
    'method' => 'GET',
    'path' => '/api/v2/upcs',
    'name' => 'Retrieve all UPCs',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryUPCs`.

Endpoint: GET /api/v2/upcs.',
    'type' => 'read',
    'tag' => 'Upcs',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/].',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of additional data to retrieve.',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  413 =>
  [
    'operation' => 'UpdateUPC',
    'slug' => 'avalara_update_upc',
    'class' => 'AvalaraUpdateUPC',
    'method' => 'PUT',
    'path' => '/api/v2/companies/{companyId}/upcs/{id}',
    'name' => 'Update a single UPC',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateUPC`.

Endpoint: PUT /api/v2/companies/{companyId}/upcs/{id}.',
    'type' => 'write',
    'tag' => 'Upcs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the company that this UPC belongs to.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the UPC you wish to update',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The UPC you wish to update.',
      ],
    ],
  ],
  414 =>
  [
    'operation' => 'DeleteUserDefinedField',
    'slug' => 'avalara_delete_user_defined_field',
    'class' => 'AvalaraDeleteUserDefinedField',
    'method' => 'DELETE',
    'path' => '/api/v2/companies/{companyId}/userdefinedfields/{id}',
    'name' => 'Delete a User Defined Field by User Defined Field id for a company.',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteUserDefinedField`.

Endpoint: DELETE /api/v2/companies/{companyId}/userdefinedfields/{id}.',
    'type' => 'write',
    'tag' => 'UserDefinedFields',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The id of the company the User Defined Field belongs to.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The id of the User Defined Field you wish to delete.',
      ],
    ],
  ],
  415 =>
  [
    'operation' => 'ListUserDefinedFieldsByCompanyId',
    'slug' => 'avalara_list_user_defined_fields_by_company_id',
    'class' => 'AvalaraListUserDefinedFieldsByCompanyId',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/userdefinedfields',
    'name' => 'List User Defined Fields By Company Id',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListUserDefinedFieldsByCompanyId`.

Endpoint: GET /api/v2/companies/{companyId}/userdefinedfields.',
    'type' => 'read',
    'tag' => 'UserDefinedFields',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => '',
      ],
      1 =>
      [
        'name' => 'udfType',
        'param' => 'udf_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Document or Line level UDF',
      ],
      2 =>
      [
        'name' => 'allowDefaults',
        'param' => 'allow_defaults',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If true this will add defaulted UDFs to the list that are not named yet',
      ],
    ],
  ],
  416 =>
  [
    'operation' => 'UpdateUserDefinedField',
    'slug' => 'avalara_update_user_defined_field',
    'class' => 'AvalaraUpdateUserDefinedField',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/userdefinedfields',
    'name' => 'Update a User Defined Field identified by id for a company',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateUserDefinedField`.

Endpoint: POST /api/v2/companies/{companyId}/userdefinedfields.',
    'type' => 'write',
    'tag' => 'UserDefinedFields',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The id of the company the user defined field belongs to.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => '',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => '',
      ],
    ],
  ],
  417 =>
  [
    'operation' => 'ChangePassword',
    'slug' => 'avalara_change_password',
    'class' => 'AvalaraChangePassword',
    'method' => 'PUT',
    'path' => '/api/v2/passwords',
    'name' => 'Change Password',
    'description' => 'Execute official Avalara AvaTax REST API operation `ChangePassword`.

Endpoint: PUT /api/v2/passwords.',
    'type' => 'write',
    'tag' => 'Users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'An object containing your current password and the new password.',
      ],
    ],
  ],
  418 =>
  [
    'operation' => 'CreateUsers',
    'slug' => 'avalara_create_users',
    'class' => 'AvalaraCreateUsers',
    'method' => 'POST',
    'path' => '/api/v2/accounts/{accountId}/users',
    'name' => 'Create new users',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateUsers`.

Endpoint: POST /api/v2/accounts/{accountId}/users.',
    'type' => 'write',
    'tag' => 'Users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'accountId',
        'param' => 'account_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the account where these users will be created.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The user or array of users you wish to create.',
      ],
    ],
  ],
  419 =>
  [
    'operation' => 'DeleteUser',
    'slug' => 'avalara_delete_user',
    'class' => 'AvalaraDeleteUser',
    'method' => 'DELETE',
    'path' => '/api/v2/accounts/{accountId}/users/{id}',
    'name' => 'Delete a single user',
    'description' => 'Execute official Avalara AvaTax REST API operation `DeleteUser`.

Endpoint: DELETE /api/v2/accounts/{accountId}/users/{id}.',
    'type' => 'write',
    'tag' => 'Users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the user you wish to delete.',
      ],
      1 =>
      [
        'name' => 'accountId',
        'param' => 'account_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The accountID of the user you wish to delete.',
      ],
    ],
  ],
  420 =>
  [
    'operation' => 'GetUser',
    'slug' => 'avalara_get_user',
    'class' => 'AvalaraGetUser',
    'method' => 'GET',
    'path' => '/api/v2/accounts/{accountId}/users/{id}',
    'name' => 'Retrieve a single user',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetUser`.

Endpoint: GET /api/v2/accounts/{accountId}/users/{id}.',
    'type' => 'read',
    'tag' => 'Users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the user to retrieve.',
      ],
      1 =>
      [
        'name' => 'accountId',
        'param' => 'account_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The accountID of the user you wish to get.',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optional fetch commands.',
      ],
    ],
  ],
  421 =>
  [
    'operation' => 'GetUserEntitlements',
    'slug' => 'avalara_get_user_entitlements',
    'class' => 'AvalaraGetUserEntitlements',
    'method' => 'GET',
    'path' => '/api/v2/accounts/{accountId}/users/{id}/entitlements',
    'name' => 'Retrieve all entitlements for a single user',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetUserEntitlements`.

Endpoint: GET /api/v2/accounts/{accountId}/users/{id}/entitlements.',
    'type' => 'read',
    'tag' => 'Users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the user to retrieve.',
      ],
      1 =>
      [
        'name' => 'accountId',
        'param' => 'account_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The accountID of the user you wish to get.',
      ],
    ],
  ],
  422 =>
  [
    'operation' => 'ListUsersByAccount',
    'slug' => 'avalara_list_users_by_account',
    'class' => 'AvalaraListUsersByAccount',
    'method' => 'GET',
    'path' => '/api/v2/accounts/{accountId}/users',
    'name' => 'Retrieve users for this account',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListUsersByAccount`.

Endpoint: GET /api/v2/accounts/{accountId}/users.',
    'type' => 'read',
    'tag' => 'Users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'accountId',
        'param' => 'account_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The accountID of the user you wish to list.',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optional fetch commands.',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* SuppressNewUserEmail',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  423 =>
  [
    'operation' => 'QueryUsers',
    'slug' => 'avalara_query_users',
    'class' => 'AvalaraQueryUsers',
    'method' => 'GET',
    'path' => '/api/v2/users',
    'name' => 'Retrieve all users',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryUsers`.

Endpoint: GET /api/v2/users.',
    'type' => 'read',
    'tag' => 'Users',
    'parameters' =>
    [
      0 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optional fetch commands.',
      ],
      1 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* SuppressNewUserEmail',
      ],
      2 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      3 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      4 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  424 =>
  [
    'operation' => 'UpdateUser',
    'slug' => 'avalara_update_user',
    'class' => 'AvalaraUpdateUser',
    'method' => 'PUT',
    'path' => '/api/v2/accounts/{accountId}/users/{id}',
    'name' => 'Update a single user',
    'description' => 'Execute official Avalara AvaTax REST API operation `UpdateUser`.

Endpoint: PUT /api/v2/accounts/{accountId}/users/{id}.',
    'type' => 'write',
    'tag' => 'Users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID of the user you wish to update.',
      ],
      1 =>
      [
        'name' => 'accountId',
        'param' => 'account_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The accountID of the user you wish to update.',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => true,
        'description' => 'The user object you wish to update.',
      ],
    ],
  ],
  425 =>
  [
    'operation' => 'GetMySubscription',
    'slug' => 'avalara_get_my_subscription',
    'class' => 'AvalaraGetMySubscription',
    'method' => 'GET',
    'path' => '/api/v2/utilities/subscriptions/{serviceTypeId}',
    'name' => 'Checks if the current user is subscribed to a specific service',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetMySubscription`.

Endpoint: GET /api/v2/utilities/subscriptions/{serviceTypeId}.',
    'type' => 'read',
    'tag' => 'Utilities',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'serviceTypeId',
        'param' => 'service_type_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The service to check',
      ],
    ],
  ],
  426 =>
  [
    'operation' => 'ListMySubscriptions',
    'slug' => 'avalara_list_my_subscriptions',
    'class' => 'AvalaraListMySubscriptions',
    'method' => 'GET',
    'path' => '/api/v2/utilities/subscriptions',
    'name' => 'List all services to which the current user is subscribed',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListMySubscriptions`.

Endpoint: GET /api/v2/utilities/subscriptions.',
    'type' => 'read',
    'tag' => 'Utilities',
    'parameters' =>
    [
    ],
  ],
  427 =>
  [
    'operation' => 'Ping',
    'slug' => 'avalara_ping',
    'class' => 'AvalaraPing',
    'method' => 'GET',
    'path' => '/api/v2/utilities/ping',
    'name' => 'Tests connectivity and version of the service',
    'description' => 'Execute official Avalara AvaTax REST API operation `Ping`.

Endpoint: GET /api/v2/utilities/ping.',
    'type' => 'read',
    'tag' => 'Utilities',
    'parameters' =>
    [
    ],
  ],
  428 =>
  [
    'operation' => 'QueryVendorCertificates',
    'slug' => 'avalara_query_vendor_certificates',
    'class' => 'AvalaraQueryVendorCertificates',
    'method' => 'GET',
    'path' => '/{companyId}/vendor-certificates',
    'name' => 'List all vendor certificates for a company',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryVendorCertificates`.

Endpoint: GET /{companyId}/vendor-certificates.',
    'type' => 'read',
    'tag' => 'VendorCertificates',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The ID number of the company to search',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'OPTIONAL: A comma separated list of special fetch options. You can specify one or more of the following: * customers - Retrieves the list of vendors linked to the certificate. * po_numbers - Retrieves all PO numbers tied to the certificate. * attributes - Retrieves all attributes applied to the certificate. * histories - Retrieves the certificate update history * jobs - Retrieves the jobs for this certificate * logs - Retrieves the certificate log * invalid_reasons - Retrieves invalid reasons for this certificate if the certificate is invalid * custom_fields - Retrieves custom fields set for this certificate',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* documentTypeId, documentTypeDescription, exemptionNumber, ecmsId, ecmsStatus, pdf, pages',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  429 =>
  [
    'operation' => 'CreateVendors',
    'slug' => 'avalara_create_vendors',
    'class' => 'AvalaraCreateVendors',
    'method' => 'POST',
    'path' => '/api/v2/companies/{companyId}/vendors',
    'name' => 'Create vendors for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `CreateVendors`.

Endpoint: POST /api/v2/companies/{companyId}/vendors.',
    'type' => 'write',
    'tag' => 'Vendors',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this vendor',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'array',
        'required' => true,
        'description' => 'The list of vendor objects to be created',
      ],
    ],
  ],
  430 =>
  [
    'operation' => 'GetVendor',
    'slug' => 'avalara_get_vendor',
    'class' => 'AvalaraGetVendor',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/vendors/{vendorCode}',
    'name' => 'Retrieve a single vendor',
    'description' => 'Execute official Avalara AvaTax REST API operation `GetVendor`.

Endpoint: GET /api/v2/companies/{companyId}/vendors/{vendorCode}.',
    'type' => 'read',
    'tag' => 'Vendors',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this vendor',
      ],
      1 =>
      [
        'name' => 'vendorCode',
        'param' => 'vendor_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => '',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Specify optional additional objects to include in this fetch request',
      ],
    ],
  ],
  431 =>
  [
    'operation' => 'ListCertificatesForVendor',
    'slug' => 'avalara_list_certificates_for_vendor',
    'class' => 'AvalaraListCertificatesForVendor',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/vendors/{vendorCode}/certificates',
    'name' => 'List certificates linked to a vendor',
    'description' => 'Execute official Avalara AvaTax REST API operation `ListCertificatesForVendor`.

Endpoint: GET /api/v2/companies/{companyId}/vendors/{vendorCode}/certificates.',
    'type' => 'read',
    'tag' => 'Vendors',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this vendor',
      ],
      1 =>
      [
        'name' => 'vendorCode',
        'param' => 'vendor_code',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The unique code representing this vendor',
      ],
      2 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'OPTIONAL: A comma separated list of special fetch options. You can specify one or more of the following: * vendors - Retrieves the list of vendors linked to the certificate. * po_numbers - Retrieves all PO numbers tied to the certificate. * attributes - Retrieves all attributes applied to the certificate. * histories - Retrieves the certificate update history * jobs - Retrieves the jobs for this certificate * logs - Retrieves the certificate log * invalid_reasons - Retrieves invalid reasons for this certificate if the certificate is invalid * custom_fields - Retrieves custom fields set for this certificate',
      ],
      3 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* documentTypeId, documentTypeDescription, exemptionNumber, ecmsId, ecmsStatus, pdf, pages',
      ],
      4 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      5 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      6 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
  432 =>
  [
    'operation' => 'QueryVendors',
    'slug' => 'avalara_query_vendors',
    'class' => 'AvalaraQueryVendors',
    'method' => 'GET',
    'path' => '/api/v2/companies/{companyId}/vendors',
    'name' => 'List all vendors for this company',
    'description' => 'Execute official Avalara AvaTax REST API operation `QueryVendors`.

Endpoint: GET /api/v2/companies/{companyId}/vendors.',
    'type' => 'read',
    'tag' => 'Vendors',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'companyId',
        'param' => 'company_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The unique ID number of the company that recorded this vendor',
      ],
      1 =>
      [
        'name' => '$include',
        'param' => 'include',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'OPTIONAL - You can specify any of the values in `certificates`, `attributes`, `active_certificates`, `histories`, `logs`, `jobs`, `billTos`, `shipTos`, `shipToStates`, and `custom_fields` to fetch additional information for this certificate.',
      ],
      2 =>
      [
        'name' => '$filter',
        'param' => 'filter',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A filter statement to identify specific records to retrieve. For more information on filtering, see [Filtering in REST](http://developer.avalara.com/avatax/filtering-in-rest/]. *Not filterable:* VendorAdditionalInfo',
      ],
      3 =>
      [
        'name' => '$top',
        'param' => 'top',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, return no more than this number of results. Used with `$skip` to provide pagination for large datasets. Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records.',
      ],
      4 =>
      [
        'name' => '$skip',
        'param' => 'skip',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'If nonzero, skip this number of results before returning data. Used with `$top` to provide pagination for large datasets.',
      ],
      5 =>
      [
        'name' => '$orderBy',
        'param' => 'order_by',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A comma separated list of sort statements in the format `(fieldname] [ASC|DESC]`, for example `id ASC`.',
      ],
    ],
  ],
];
    }
}