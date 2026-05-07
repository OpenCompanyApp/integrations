<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Find metadata template by instance ID.
 *
 * Executes the official Box API operation get_metadata_templates.
 */
class BoxGetMetadataTemplates extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_metadata_templates';
}
