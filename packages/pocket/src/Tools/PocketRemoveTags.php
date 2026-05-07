<?php
namespace OpenCompany\Integrations\Pocket\Tools;
/** Remove tags from a Pocket item. */
class PocketRemoveTags extends AbstractPocketActionTool { protected const NAME = 'pocket_remove_tags'; protected const DESCRIPTION = 'Remove comma-delimited tags from a Pocket item.'; protected const ACTION = 'tags_remove'; protected const REQUIRED = ['item_id', 'tags']; }
