<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Soft-deletes a file asset by setting its deleted_at timestamp.
 */
class CustomerIOAppDeleteAsset extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_delete_asset';
}
