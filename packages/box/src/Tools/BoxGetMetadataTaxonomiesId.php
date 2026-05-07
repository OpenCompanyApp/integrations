<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get metadata taxonomies for namespace.
 *
 * Executes the official Box API operation get_metadata_taxonomies_id.
 */
class BoxGetMetadataTaxonomiesId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_metadata_taxonomies_id';
}
