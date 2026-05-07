<?php
namespace OpenCompany\Integrations\Pocket\Tools;
/** Delete a Pocket tag. */
class PocketDeleteTag extends AbstractPocketActionTool { protected const NAME = 'pocket_delete_tag'; protected const DESCRIPTION = 'Delete a Pocket tag across the account.'; protected const ACTION = 'tag_delete'; protected const REQUIRED = ['tag']; }
