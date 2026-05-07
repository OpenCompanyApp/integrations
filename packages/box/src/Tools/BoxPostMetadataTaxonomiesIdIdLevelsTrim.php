<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Delete metadata taxonomy level.
 *
 * Executes the official Box API operation post_metadata_taxonomies_id_id_levels:trim.
 */
class BoxPostMetadataTaxonomiesIdIdLevelsTrim extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_metadata_taxonomies_id_id_levels_trim';
}
