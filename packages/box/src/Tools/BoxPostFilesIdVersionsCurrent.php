<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Promote file version.
 *
 * Executes the official Box API operation post_files_id_versions_current.
 */
class BoxPostFilesIdVersionsCurrent extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_files_id_versions_current';
}
