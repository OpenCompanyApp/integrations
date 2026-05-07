<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List metadata cascade policies.
 *
 * Executes the official Box API operation get_metadata_cascade_policies.
 */
class BoxGetMetadataCascadePolicies extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_metadata_cascade_policies';
}
