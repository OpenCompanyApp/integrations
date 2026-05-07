<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List folder collaborations.
 *
 * Executes the official Box API operation get_folders_id_collaborations.
 */
class BoxGetFoldersIdCollaborations extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_folders_id_collaborations';
}
