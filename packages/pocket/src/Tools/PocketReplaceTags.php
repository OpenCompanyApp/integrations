<?php
namespace OpenCompany\Integrations\Pocket\Tools;
/** Replace tags on a Pocket item. */
class PocketReplaceTags extends AbstractPocketActionTool { protected const NAME = 'pocket_replace_tags'; protected const DESCRIPTION = 'Replace all tags on a Pocket item with comma-delimited tags.'; protected const ACTION = 'tags_replace'; protected const REQUIRED = ['item_id', 'tags']; }
