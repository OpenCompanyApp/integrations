<?php
namespace OpenCompany\Integrations\Pocket\Tools;
/** Re-add an archived Pocket item. */
class PocketReaddItem extends AbstractPocketActionTool { protected const NAME = 'pocket_readd_item'; protected const DESCRIPTION = 'Move an archived Pocket item back to unread by item_id.'; protected const ACTION = 'readd'; }
