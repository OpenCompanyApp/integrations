<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Create metadata cascade policy.
 *
 * Executes the official Box API operation post_metadata_cascade_policies.
 */
class BoxPostMetadataCascadePolicies extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_metadata_cascade_policies';
}
