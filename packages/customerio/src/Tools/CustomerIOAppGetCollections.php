<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns a list of all of your collections, including the name and schema for each collection.
 */
class CustomerIOAppGetCollections extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_collections';
}
