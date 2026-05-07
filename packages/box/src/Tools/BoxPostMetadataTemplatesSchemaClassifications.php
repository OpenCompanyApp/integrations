<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Add initial classifications.
 *
 * Executes the official Box API operation post_metadata_templates_schema#classifications.
 */
class BoxPostMetadataTemplatesSchemaClassifications extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_metadata_templates_schema_classifications';
}
