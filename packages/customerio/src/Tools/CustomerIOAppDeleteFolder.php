<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Delete a folder **including subfolders and all file (components, templates, and emails)**.
 */
class CustomerIOAppDeleteFolder extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_delete_folder';
}
