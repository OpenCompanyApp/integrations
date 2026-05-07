<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Create metadata template.
 *
 * Executes the official Box API operation post_metadata_templates_schema.
 */
class BoxPostMetadataTemplatesSchema extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_metadata_templates_schema';
}
