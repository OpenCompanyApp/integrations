<?php
namespace OpenCompany\Integrations\Pocket\Tools;
/** Rename a Pocket tag. */
class PocketRenameTag extends AbstractPocketActionTool { protected const NAME = 'pocket_rename_tag'; protected const DESCRIPTION = 'Rename a Pocket tag across the account from old_tag to new_tag.'; protected const ACTION = 'tag_rename'; protected const REQUIRED = ['old_tag', 'new_tag']; }
