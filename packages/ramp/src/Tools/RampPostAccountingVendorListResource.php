<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Upload vendors.
 *
 * Maps to the official Ramp endpoint post /developer/v1/accounting/vendors.
 */
class RampPostAccountingVendorListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_accounting_vendor_list_resource';
    protected const DESCRIPTION = 'Upload vendors

Official Ramp endpoint: POST /developer/v1/accounting/vendors

You can upload up to 500 vendors in an all-or-nothing fashion. If a vendors within a batch is malformed or violates a database constraint, the entire batch containing that vendors will be disregarded. To have a successful upload, please sanitize the data and ensure the vendors that you are trying to upload do not already exist on Ramp. If a vendors is already on Ramp but you want to update its attributes, please use the PATCH developer/v1/accounting/vendors/{id} endpoint instead.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/accounting/vendors';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
