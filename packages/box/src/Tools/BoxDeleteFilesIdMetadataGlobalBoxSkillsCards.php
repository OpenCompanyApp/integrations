<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove Box Skill cards from file.
 *
 * Executes the official Box API operation delete_files_id_metadata_global_boxSkillsCards.
 */
class BoxDeleteFilesIdMetadataGlobalBoxSkillsCards extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_files_id_metadata_global_box_skills_cards';
}
