<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove metadata cascade policy.
 *
 * Executes the official Box API operation delete_metadata_cascade_policies_id.
 */
class BoxDeleteMetadataCascadePoliciesId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_metadata_cascade_policies_id';
}
