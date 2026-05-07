<?php
namespace OpenCompany\Integrations\Pocket\Tools;
/** Add tags to a Pocket item. */
class PocketAddTags extends AbstractPocketActionTool { protected const NAME = 'pocket_add_tags'; protected const DESCRIPTION = 'Add comma-delimited tags to a Pocket item.'; protected const ACTION = 'tags_add'; protected const REQUIRED = ['item_id', 'tags']; }
