<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Add metadata taxonomy level.
 *
 * Executes the official Box API operation post_metadata_taxonomies_id_id_levels:append.
 */
class BoxPostMetadataTaxonomiesIdIdLevelsAppend extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_metadata_taxonomies_id_id_levels_append';
}
