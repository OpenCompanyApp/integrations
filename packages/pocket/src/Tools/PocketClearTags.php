<?php
namespace OpenCompany\Integrations\Pocket\Tools;
/** Clear tags from a Pocket item. */
class PocketClearTags extends AbstractPocketActionTool { protected const NAME = 'pocket_clear_tags'; protected const DESCRIPTION = 'Remove all tags from a Pocket item by item_id.'; protected const ACTION = 'tags_clear'; }
