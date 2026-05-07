<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List storage policies.
 *
 * Executes the official Box API operation get_storage_policies.
 */
class BoxGetStoragePolicies extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_storage_policies';
}
