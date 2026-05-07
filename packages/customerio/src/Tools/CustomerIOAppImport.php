<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * This endpoint lets you upload a CSV file containing people, events, objects, or relationships.
 */
class CustomerIOAppImport extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_import';
}
