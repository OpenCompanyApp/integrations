<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * This endpoint returns information about an "import"a CSV file containing a group of people or events you uploaded to using v1/imports endpoint.
 */
class CustomerIOAppGetImport extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_import';
}
