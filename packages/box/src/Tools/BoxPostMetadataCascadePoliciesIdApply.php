<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Force-apply metadata cascade policy to folder.
 *
 * Executes the official Box API operation post_metadata_cascade_policies_id_apply.
 */
class BoxPostMetadataCascadePoliciesIdApply extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_metadata_cascade_policies_id_apply';
}
